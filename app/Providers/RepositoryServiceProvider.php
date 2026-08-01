<?php

namespace App\Providers;

use App\Repositories\Repository\LoanRepository;
use App\Repositories\Interface\LenderInterface;
use App\Repositories\Interface\LoanInterface;
use App\Repositories\Interface\LoanPaymentInterface;
use App\Repositories\Interface\TransactionInterface;
use App\Repositories\Repository\LenderRepository;
use App\Repositories\Repository\LoanPaymentsRepository;
use App\Repositories\Repository\TransactionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            LenderInterface::class,
            LenderRepository::class
        );

        $this->app->bind(
            LoanInterface::class,
            LoanRepository::class
        );

        $this->app->bind(
            LoanPaymentInterface::class,
            LoanPaymentsRepository::class
        );

        $this->app->bind(
            TransactionInterface::class,
            TransactionRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
