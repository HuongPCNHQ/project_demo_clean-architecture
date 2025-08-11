<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Application\Services\MailServiceInterface;
use App\Core\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Repositories\UserRepositories;
use App\Infrastructure\Mail\MailService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MailServiceInterface::class, MailService::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepositories::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
