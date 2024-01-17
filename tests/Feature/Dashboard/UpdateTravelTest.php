<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Enums\Roles;
use App\Models\Mood;
use App\Models\Role;
use App\Models\User;
use App\Models\Travel;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTravelTest extends TestCase
{
    use RefreshDatabase;

    private Role $adminRole;
    private Role $editorRole;
    private Role $userRole;

    private Travel $travel;

    private array $payload = [
        'name' => 'Updated name',
        'description' => 'Travel description',
        'numberOfDays' => 5,
        'price' => 100,
    ];

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleSeeder::class);

        $this->adminRole = Role::where('name', Roles::ADMIN->value)->first();
        $this->editorRole = Role::where('name', Roles::EDITOR->value)->first();
        $this->userRole = Role::where('name', Roles::USER->value)->first();

        $this->travel = Travel::factory()->create();
        Mood::factory()->for($this->travel)->create();
    }

    public function test_editor_can_update_a_travel(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach($this->editorRole);

        $response = $this->actingAs($user)->patch("/v1/dashboard/travels/{$this->travel->id}", $this->payload);

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'slug',
                'name',
                'description',
                'numberOfDays',
                'numberOfNights',
                'isPublic',
                'publishedAt',
                'moods' => [
                    'nature',
                    'relax',
                    'history',
                    'culture',
                    'party',
                ],
            ],
        ]);
        $response->assertJsonFragment([
            'name' => $this->payload['name'],
            'description' => $this->payload['description'],
            'numberOfDays' => $this->payload['numberOfDays'],
        ]);
    }
}
