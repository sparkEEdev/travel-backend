<?php

namespace Tests\Feature\Dashboard;

use Carbon\Carbon;
use Tests\TestCase;
use App\Enums\Roles;
use App\Models\Mood;
use App\Models\Role;
use App\Models\User;
use App\Models\Travel;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTourTest extends TestCase
{
    use RefreshDatabase;

    private Role $adminRole;
    private Role $editorRole;
    private Role $userRole;

    private Collection $travels;
    private array $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleSeeder::class);

        $this->adminRole = Role::where('name', Roles::ADMIN->value)->first();
        $this->editorRole = Role::where('name', Roles::EDITOR->value)->first();
        $this->userRole = Role::where('name', Roles::USER->value)->first();

        $this->travels = Travel::factory(20)->create();

        foreach ($this->travels as $travel) {
            Mood::factory()->for($travel)->create();
        }

        $travel = $this->travels[rand(0, count($this->travels))];

        $startDate = Carbon::parse('2021-10-10');
        $endDate = $startDate->copy()->addDays($travel->numberOfDays);

        $this->payload = [
            'travelId' => $travel->id,
            'name' => 'Tour name',
            'startDate' => $startDate->toDateString(),
            'endDate' => $endDate->toDateString(),
            'price' => 100,
            'numberOfPeople' => 10,
        ];
    }

    public function test_admin_can_create_a_tour(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach($this->adminRole);

        $response = $this->actingAs($user)->post('/v1/dashboard/tours', $this->payload);

        $response->assertSuccessful();

        $response->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'name',
                'numberOfPeople',
                'startDate',
                'endDate',
                'price',
            ],
        ]);
    }

    public function test_editor_or_user_cannot_create_a_tour(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach($this->editorRole);
        $user->roles()->attach($this->userRole);

        $response = $this->actingAs($user)->post('/v1/dashboard/tours', $this->payload);

        $response->assertForbidden();
    }
}
