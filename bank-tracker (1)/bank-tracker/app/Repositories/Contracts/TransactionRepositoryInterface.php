<?php

namespace App\Repositories\Contracts;

interface TransactionRepositoryInterface extends BaseRepositoryInterface
{
    public function totalCredit(): float;

    public function totalDebit(): float;

    public function balance(): float;
}
