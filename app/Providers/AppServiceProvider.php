<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //WeekDays
        RedirectResponse::macro('success', function (string $message) {
            return $this->with('toast', [
                'type'    => 'success',
                'message' => $message,
            ]);
        });

        RedirectResponse::macro('error', function (string $message) {
            return $this->with('toast', [
                'type'    => 'error',
                'message' => $message,
            ]);
        });

        JsonResource::withoutWrapping();
    }
}
