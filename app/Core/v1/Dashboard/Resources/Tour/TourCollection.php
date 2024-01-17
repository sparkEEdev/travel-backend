<?php

namespace App\Core\v1\Dashboard\Resources\Tour;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TourCollection extends ResourceCollection
{
    public $collects = TourResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<TourResource>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
