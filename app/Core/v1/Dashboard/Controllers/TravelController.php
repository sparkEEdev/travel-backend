<?php

namespace App\Core\v1\Dashboard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Core\v1\Dashboard\Actions\Travel\GetTravelAction;
use App\Core\v1\Dashboard\Actions\Travel\GetTravelsAction;
use App\Core\v1\Dashboard\Actions\Travel\CreateTravelAction;
use App\Core\v1\Dashboard\Actions\Travel\UpdateTravelAction;
use App\Core\v1\Dashboard\Actions\Travel\PublishTravelAction;
use App\Core\v1\Dashboard\Requests\Travel\CreateTravelRequest;
use App\Core\v1\Dashboard\Requests\Travel\UpdateTravelRequest;
use App\Core\v1\Dashboard\Requests\Travel\PublishTravelRequest;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, GetTravelsAction $action): JsonResponse
    {
        return $action->execute($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTravelRequest $request, CreateTravelAction $action): JsonResponse
    {
        return $action->execute($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, GetTravelAction $action): JsonResponse
    {
        return $action->execute($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTravelRequest $request, string $id, UpdateTravelAction $action): JsonResponse
    {
        return $action->execute($request, $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function publish(PublishTravelRequest $request, string $id, PublishTravelAction $action): JsonResponse
    {
        return $action->execute($request, $id);
    }
}
