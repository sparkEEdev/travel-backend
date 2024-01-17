<?php

namespace App\Core\v1\Dashboard\Actions\Tour;

use Carbon\Carbon;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\DatabaseManager;
use App\Core\v1\Dashboard\Resources\Tour\TourResource;
use App\Core\v1\Dashboard\Requests\Tour\CreateTourRequest;
use App\Core\v1\Dashboard\Responses\InvalidTourDurationResponse;

class CreateTourAction
{
    private DatabaseManager $db;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    public function execute(CreateTourRequest $request): JsonResponse
    {
        try {
            $this->db->beginTransaction();

            $data = $request->validated();

            /** @var Travel $travel */
            $travel = Travel::find($data['travelId']);

            /** @var string $startDateInput */
            $startDateInput = $data['startDate'];

            /** @var string $endDateInput */
            $endDateInput = $data['endDate'];

            /** @var string $nameInput */
            $nameInput = $data['name'];

            $startDate = Carbon::parse($startDateInput);

            if ($startDate->diffInDays($endDateInput) !== $travel->numberOfDays) {
                return new InvalidTourDurationResponse();
            }

            $data = array_merge($data, [
                'name' => strtoupper($nameInput) . str_replace('-', '', $startDateInput),
            ]);

            $tour = Tour::create($data);

            $this->db->commit();

            return response()->json([
                'message' => 'Tour created successfully',
                'data' => new TourResource($tour),
            ], 201);

        } catch (\Exception $e) {

            $this->db->rollBack();

            return response()->json([
                'message' => 'Something went wrong'
            ], 400);
        }
    }
}
