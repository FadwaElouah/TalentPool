<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\OfferPostRepositoryInterface;
use App\Repositories\Eloquent\OfferPostRepository;
use App\Repositories\Interfaces\CandidatureRepositoryInterface;
use App\Repositories\Eloquent\CandidatureRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OfferPostRepositoryInterface::class, OfferPostRepository::class);
        $this->app->bind(CandidatureRepositoryInterface::class, CandidatureRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
