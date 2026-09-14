<?php

use App\Http\Controllers\Api\AgendaApiController;
use App\Http\Controllers\Api\FestivalApiController;
use App\Http\Controllers\Api\FilmApiController;
use App\Http\Controllers\Api\LieuApiController;
use App\Http\Controllers\Api\RappelApiController;
use App\Http\Controllers\Api\SeanceApiController;
use Illuminate\Support\Facades\Route;

Route::get('/seances', [SeanceApiController::class, 'index']);
Route::get('/films/{film}', [FilmApiController::class, 'show']);
Route::get('/lieux', [LieuApiController::class, 'index']);
Route::get('/lieux/{lieu}', [LieuApiController::class, 'show']);
Route::get('/agenda', [AgendaApiController::class, 'index']);
Route::get('/festival/actif', [FestivalApiController::class, 'actif']);
Route::post('/rappels', [RappelApiController::class, 'store']);
