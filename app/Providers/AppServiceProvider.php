<?php

namespace App\Providers;

use App\Models\Client;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        JsonResource::withoutWrapping();
        Passport::useClientModel(Client::class);
        Passport::hashClientSecrets();
        Passport::tokensCan([
            'openid' => 'Get user information',
            'profile' => 'Get user profile',
            'name' => 'Get user name',
            'email' => 'Get user email',
        ]);
    }
}
