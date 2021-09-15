<?php

use App\Http\Api\Controllers\HorseController;
use App\Http\Api\Controllers\RaceController;

Route::middleware(['api'])->group(function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::group(['prefix' => 'horse'], function() {
            Route::get('/', [HorseController::class, 'getHorses']);
            Route::get('/{horse}', [HorseController::class, 'get']);
            Route::post('/', [HorseController::class, 'post']);
            Route::put('/{horse}', [HorseController::class, 'put']);
            Route::delete('/{horse}', [HorseController::class, 'delete']);
        });

        Route::group(['prefix' => 'race'], function() {
            Route::get('/', [RaceController::class, 'getRaces']);
            Route::get('/{race}', [RaceController::class, 'get']);
            Route::post('/', [RaceController::class, 'post']);
            Route::put('/{race}', [RaceController::class, 'put']);
            Route::delete('/{race}', [RaceController::class, 'delete']);
        });
    });
});
