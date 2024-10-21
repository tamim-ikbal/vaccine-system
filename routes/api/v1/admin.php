<?php

use App\Http\Controllers\Api\V1\Admin\DiseaseController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/admin')->group(function () {
    Route::apiResource('diseases', DiseaseController::class);
});
