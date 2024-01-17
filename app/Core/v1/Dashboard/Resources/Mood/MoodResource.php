<?php

namespace App\Core\v1\Dashboard\Resources\Mood;

use App\Enums\Moods;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var array<string> $moods */
        $moods = Moods::valuesToArray();

        $data = [];

        foreach ($moods as $mood) {
            $data[$mood] = $this->{$mood} ?? 0;
        }

        return $data;
    }
}
