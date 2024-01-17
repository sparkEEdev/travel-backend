<?php

namespace App\Core\v1\Public\Actions\Tour;

use App\Models\Tour;
use App\Concerns\FormatMoney;
use App\Core\v1\Public\Requests\Tour\GetToursRequest;
use App\Core\v1\Public\Resources\Tour\TourCollection;
use Illuminate\Http\JsonResponse;

class GetToursAction
{
    public function execute(GetToursRequest $request): JsonResponse
    {
        $tours = Tour::with(['travel', 'travel.moods'])
            ->when($request->filled('travel'), function ($query) use ($request) {
                $query->whereTravelSlug($request->get('travel'));
            })
            ->when($request->filled('priceFrom'), function ($query) use ($request) {
                $query->where('price', '>=', FormatMoney::toDatabase($request->get('priceFrom')));
            })
            ->when($request->filled('priceTo'), function ($query) use ($request) {
                $query->where('price', '<=', FormatMoney::toDatabase($request->get('priceTo')));
            })
            ->when($request->filled('dateFrom'), function ($query) use ($request) {
                $query->where('startDate', '>=', $request->get('dateFrom'));
            })
            ->when($request->filled('dateTo'), function ($query) use ($request) {
                $query->where('startDate', '<=', $request->get('dateTo'));
            })
            ->when($request->filled('sort'), function ($query) use ($request) {
                $query->orderBy($request->get('sort'), $request->get('order', null) ?? 'ASC');
            })
            ->orderBy('startDate', 'ASC')
            ->paginate($request->get('per_page', 10));

        return response()->json([
            'message' => 'Successfully retrieved tours.',
            'data' => $tours,
        ]);
    }
}
