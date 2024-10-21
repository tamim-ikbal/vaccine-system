<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//V1 Api
require __DIR__.'/api/v1/admin.php';
require __DIR__.'/api/v1/auth.php';
