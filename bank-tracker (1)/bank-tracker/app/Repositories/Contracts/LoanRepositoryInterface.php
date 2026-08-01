<?php

namespace App\Repositories\Contracts;

interface LoanRepositoryInterface extends BaseRepositoryInterface
{
    public function totalTaken(): float;

    public function totalPaid(): float;

    public function totalRemaining(): float;
}
