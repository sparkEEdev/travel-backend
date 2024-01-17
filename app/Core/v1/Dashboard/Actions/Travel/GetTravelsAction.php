<?php

namespace App\Core\v1\Dashboard\Actions\Travel;

use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetTravelsAction
{

    public function execute(Request $request): JsonResponse
    {
        /** @var int $perPage */
        $perPage = $request->get('per_page', 10);

        $travels = Travel::with('moods')->paginate($perPage);

        return response()->json([
            'message' => 'Travels retrieved successfully',
            'data' => $travels,
        ]);
    }
}
