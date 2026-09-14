<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FestivalResource;
use App\Models\Festival;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FestivalApiController extends Controller
{
    public function actif(): FestivalResource
    {
        $festival = Festival::where('actif', true)->first();

        if (! $festival) {
            throw new NotFoundHttpException('Aucun festival actif.');
        }

        return new FestivalResource($festival);
    }
}
