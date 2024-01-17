<?php

namespace App\Core\v1\Dashboard\Resources\Tour;

use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Core\v1\Dashboard\Resources\Mood\MoodResource;

class TourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Tour $this */

        return [
            'id' => $this->id,
            'name' => $this->name,
            'numberOfPeople' => $this->numberOfPeople,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'price' => $this->formattedPrice,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
