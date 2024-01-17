<?php

namespace App\Core\v1\Dashboard\Actions\Travel;

use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use App\Core\v1\Dashboard\Resources\Travel\TravelResource;

class GetTravelAction
{

    public function execute(string $id): JsonResponse
    {
        $travel = Travel::with('moods')->find($id);

        if (!$travel) {
            return response()->json([
                'message' => 'Travel not found'
            ], 404);

        }

        return response()->json([
            'message' => 'Travel retrieved successfully',
            'data' => new TravelResource($travel),
        ], 200);
    }
}
