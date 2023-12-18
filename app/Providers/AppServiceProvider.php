<?php

namespace App\Providers;

use App\Contracts\Repositories\ArticleRepositoryInterface;
use App\Contracts\Repositories\SubscriptionRepositoryInterface;
use App\Contracts\Services\AddUserSubscriptionInterface;
use App\Repositories\ArticleRepository;
use App\Repositories\SubscriptionRepository;
use App\Services\UserSubscriptionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        AddUserSubscriptionInterface::class => UserSubscriptionService::class,
        SubscriptionRepositoryInterface::class => SubscriptionRepository::class,
        ArticleRepositoryInterface::class => ArticleRepository::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
