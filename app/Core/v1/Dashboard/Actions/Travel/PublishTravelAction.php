<?php

namespace App\Core\v1\Dashboard\Actions\Travel;

use Carbon\Carbon;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use App\Core\v1\Dashboard\Requests\Travel\PublishTravelRequest;

class PublishTravelAction
{
    public function execute(PublishTravelRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();

        $updated = Travel::where('id', $id)
            ->update([
                'publishedAt' => $data['shouldPublish'] ? Carbon::now() : null
            ]);

        return response()->json([
            'message' => 'Travel updated successfully',
            'data' => $updated,
        ], 200);
    }
}
