<?php

namespace App\Core\v1\Dashboard\Actions\Travel;

use Carbon\Carbon;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\DatabaseManager;
use App\Core\v1\Dashboard\Resources\Travel\TravelResource;
use App\Core\v1\Dashboard\Requests\Travel\UpdateTravelRequest;

class UpdateTravelAction
{
    private DatabaseManager $db;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    public function execute(UpdateTravelRequest $request, string $id): JsonResponse
    {
        try {
            $this->db->beginTransaction();

            $travel = Travel::find($id);

            if (!$travel) {
                return response()->json([
                    'message' => 'Travel not found'
                ], 404);
            }

            $data = $request->safe(['name', 'description', 'numberOfDays']);

            $shouldPublish = $request->safe(['shouldPublish']);

            if ($shouldPublish) {
                $data = array_merge($data, [
                    'publishedAt' => $shouldPublish['shouldPublish'] ? Carbon::now() : null
                ]);
            }


            $travel->update($data);

            /** @var array $moodsData */
            $moodsData = $request->safe(['moods']);

            if ($moodsData && count($moodsData['moods']) > 0) {
                $travel->moods()->update($moodsData['moods']);
            }

            $travel->load('moods');

            $this->db->commit();

            return response()->json([
                'message' => 'Travel updated successfully',
                'data' => new TravelResource($travel),
            ], 201);

        } catch (\Exception $e) {

            $this->db->rollBack();

            Log::info($e->getMessage());

            return response()->json([
                'message' => 'Something went wrong'
            ], 400);
        }
    }
}
