<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Enums\Roles;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTravelTest extends TestCase
{
    use RefreshDatabase;

    private Role $adminRole;
    private Role $editorRole;
    private Role $userRole;

    private array $payload = [
        'name' => 'Travel name',
        'description' => 'Travel description',
        'numberOfDays' => 5,
        'shouldPublish' => true,
        'moods' => [
            'nature' => 10,
            'relax' => 10,
            'history' => 10,
            'culture' => 10,
            'party' => 10,
        ]
    ];

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleSeeder::class);

        $this->adminRole = Role::where('name', Roles::ADMIN->value)->first();
        $this->editorRole = Role::where('name', Roles::EDITOR->value)->first();
        $this->userRole = Role::where('name', Roles::USER->value)->first();
    }

    public function test_admin_can_create_a_travel(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach($this->adminRole);

        $response = $this->actingAs($user)->post('/v1/dashboard/travels', $this->payload);

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
    }

    public function test_editor_or_user_cannot_create_a_travel(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach($this->editorRole);
        $user->roles()->attach($this->userRole);

        $response = $this->actingAs($user)->post('/v1/dashboard/travels', $this->payload);

        $response->assertForbidden();
    }
}
