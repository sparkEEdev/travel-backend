<?php

namespace App\Core\v1\Dashboard\Actions\Travel;

use Carbon\Carbon;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\DatabaseManager;
use App\Core\v1\Dashboard\Resources\Travel\TravelResource;
use App\Core\v1\Dashboard\Requests\Travel\CreateTravelRequest;

class CreateTravelAction
{

    private DatabaseManager $db;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    public function execute(CreateTravelRequest $request): JsonResponse
    {
        try {
            $this->db->beginTransaction();

            $data = $request->safe(['name', 'description', 'numberOfDays']);

            $shouldPublish = $request->safe(['shouldPublish'])['shouldPublish'];

            $data = array_merge($data, [
                'publishedAt' => $shouldPublish ? Carbon::now() : null
            ]);

            $travel = Travel::create($data);

            /** @var array<string, int> $moodsData */
            $moodsData = $request->safe(['moods'])['moods'];

            $travel->moods()->create($moodsData);

            $travel->load('moods');

            $this->db->commit();

            return response()->json([
                'message' => 'Travel created successfully',
                'data' => new TravelResource($travel),
            ], 201);

        } catch (\Exception $e) {

            $this->db->rollBack();

            return response()->json([
                'message' => 'Something went wrong'
            ], 400);
        }
    }
}
