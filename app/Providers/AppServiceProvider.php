<?php

namespace App\Providers;

use App\Domain\Repositories\UserRepositoryInterface;
use App\UseCase\TransactionUseCase;
use Illuminate\Support\ServiceProvider;
// use App\Infrastructure\Repositories\UserRepository;
// use App\Domain\Repositories\UserRepositoryInterface;
use App\UseCase\UserUseCase;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserUseCase::class, function ($app) {
            $userRepository = new \App\Infrastructure\Repositories\UserRepository();
            return new UserUseCase($userRepository);
        });


        $this->app->bind(TransactionUseCase::class, function ($app) {
            $transactionRepository = new \App\Infrastructure\Repositories\TransactionRepository();
            $userRepository = new \App\Infrastructure\Repositories\UserRepository();
            return new TransactionUseCase($userRepository,$transactionRepository);
        });
    
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
