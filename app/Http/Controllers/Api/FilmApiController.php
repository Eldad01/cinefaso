<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FilmResource;
use App\Models\Film;

class FilmApiController extends Controller
{
    public function show(Film $film): FilmResource
    {
        return new FilmResource($film);
    }
}
