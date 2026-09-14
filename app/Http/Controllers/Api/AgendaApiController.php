<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EvenementResource;
use App\Models\Evenement;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AgendaApiController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $evenements = Evenement::query()
            ->where('date_heure', '>=', now())
            ->with('lieu')
            ->orderBy('date_heure')
            ->get();

        return EvenementResource::collection($evenements);
    }
}
