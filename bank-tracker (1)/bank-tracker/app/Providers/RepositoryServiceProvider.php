<?php

namespace App\Providers;

use App\Repositories\Contracts\LenderDetailRepositoryInterface;
use App\Repositories\Contracts\LenderRepositoryInterface;
use App\Repositories\Contracts\LoanPaymentRepositoryInterface;
use App\Repositories\Contracts\LoanRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Eloquent\LenderDetailRepository;
use App\Repositories\Eloquent\LenderRepository;
use App\Repositories\Eloquent\LoanPaymentRepository;
use App\Repositories\Eloquent\LoanRepository;
use App\Repositories\Eloquent\TransactionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(LenderRepositoryInterface::class, LenderRepository::class);
        $this->app->bind(LenderDetailRepositoryInterface::class, LenderDetailRepository::class);
        $this->app->bind(LoanRepositoryInterface::class, LoanRepository::class);
        $this->app->bind(LoanPaymentRepositoryInterface::class, LoanPaymentRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
