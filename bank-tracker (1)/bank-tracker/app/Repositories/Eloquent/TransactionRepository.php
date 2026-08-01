<?php

namespace App\Repositories\Eloquent;

use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }

    public function totalCredit(): float
    {
        return (float) $this->model->credit()->sum('amount');
    }

    public function totalDebit(): float
    {
        return (float) $this->model->debit()->sum('amount');
    }

    public function balance(): float
    {
        return $this->totalCredit() - $this->totalDebit();
    }
}
