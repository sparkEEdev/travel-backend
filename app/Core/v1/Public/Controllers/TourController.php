<?php

namespace App\Core\v1\Public\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Core\v1\Public\Actions\Tour\GetToursAction;
use App\Core\v1\Public\Requests\Tour\GetToursRequest;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetToursRequest $request, GetToursAction $action): JsonResponse
    {
        return $action->execute($request);
    }
}
