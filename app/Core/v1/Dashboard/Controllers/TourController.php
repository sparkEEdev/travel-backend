<?php

namespace App\Core\v1\Dashboard\Controllers;

use App\Core\v1\Dashboard\Actions\Tour\CreateTourAction;
use App\Core\v1\Dashboard\Requests\Tour\CreateTourRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TourController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTourRequest $request, CreateTourAction $action): JsonResponse
    {
        return $action->execute($request);
    }
}
