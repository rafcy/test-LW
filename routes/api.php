<?php

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'leads'], function () {
    Route::get('/', [LeadController::class, 'index']);
    Route::post('/', [LeadController::class, 'store']);
    Route::post('/{id}', [LeadController::class, 'update']);
});
