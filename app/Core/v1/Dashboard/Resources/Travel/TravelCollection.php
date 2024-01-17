<?php

namespace App\Core\v1\Dashboard\Resources\Travel;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TravelCollection extends ResourceCollection
{
    public $collects = TravelResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
