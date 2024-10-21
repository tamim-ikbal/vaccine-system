<?php


use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', function () {
        return request(['email', 'password']);
    });
});
