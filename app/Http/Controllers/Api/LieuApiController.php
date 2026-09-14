<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LieuResource;
use App\Models\Lieu;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LieuApiController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $lieux = Lieu::where('active', true)->orderBy('nom')->get();

        return LieuResource::collection($lieux);
    }

    public function show(Lieu $lieu): LieuResource
    {
        return new LieuResource($lieu);
    }
}
