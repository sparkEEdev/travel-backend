<?php

namespace Tests\Feature\Dashboard;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Mood;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetToursTest extends TestCase
{
    use RefreshDatabase;

    private Collection $travels;
    private array $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->travels = Travel::factory(20)->create();

        foreach ($this->travels as $travel) {
            Mood::factory()->for($travel)->create();

            $startDate = Carbon::now();
            $endDate = $startDate->copy()->addDays($travel->numberOfDays);

            Tour::factory(10)->for($travel)->create([
                'startDate' => $startDate->toDateString(),
                'endDate' => $endDate->toDateString(),
            ]);
        }
    }

    public function test_get_all_tours_by_travel_slug(): void
    {
        $travel = $this->travels->first();

        $response = $this->get('/v1/tours', [
            'travel' => $travel->slug,
        ]);

        $response->assertSuccessful();

        $response->assertJsonFragment([
            'slug' => $travel->slug,
        ]);

        $response->assertJsonMissing([
            'slug' => $this->travels->last()->slug,
        ]);

        $response->assertJsonCount(10, 'data.data');

        $response->assertJsonStructure([
            'message',
            'data' => [
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'startDate',
                        'endDate',
                        'numberOfPeople',
                        'price',
                        'travel' => [
                            'id',
                            'name',
                            'slug',
                            'description',
                            'numberOfDays',
                            'moods',
                        ],
                    ],
                ],
            ],
        ]);

    }
}
