<?php

namespace App\Core\v1\Public\Resources\Travel;

use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Core\v1\Public\Resources\Mood\MoodResource;

class TravelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Travel $this */

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'numberOfDays' => $this->numberOfDays,
            'numberOfNights' => $this->numberOfNights,

            'moods' => new MoodResource($this->whenLoaded('moods')),
        ];
    }
}
