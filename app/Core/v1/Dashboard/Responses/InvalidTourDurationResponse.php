<?php

namespace App\Core\v1\Dashboard\Responses;

use Illuminate\Http\JsonResponse;

class InvalidTourDurationResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct([
            'message' => 'The days between dates does not match the travel duration',
            'errors' => [
                'startDate' => 'The days between dates does not match the travel duration',
                'endDate' => 'The days between dates does not match the travel duration',
            ],
        ], 422);
    }

}
