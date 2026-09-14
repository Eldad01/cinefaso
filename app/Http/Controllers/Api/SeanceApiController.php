<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeanceResource;
use App\Models\Seance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SeanceApiController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $date = $request->filled('date')
            ? $request->date('date')
            : today();

        $seances = Seance::query()
            ->whereDate('date_heure', $date)
            ->where('active', true)
            ->with(['film', 'lieu'])
            ->orderBy('date_heure')
            ->get();

        return SeanceResource::collection($seances);
    }
}
