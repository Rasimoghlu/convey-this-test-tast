<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\DomainRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\PlanRepositoryInterface;
use App\Repositories\DomainRepository;
use App\Repositories\UserRepository;
use App\Repositories\PlanRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DomainRepositoryInterface::class, DomainRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PlanRepositoryInterface::class, PlanRepository::class);
    }

    public function boot(): void
    {
        //
    }
} 