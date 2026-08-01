<?php

namespace App\Repositories\Eloquent;

use App\Models\Loan;
use App\Models\LoanPayment;
use App\Repositories\Contracts\LoanRepositoryInterface;

class LoanRepository extends BaseRepository implements LoanRepositoryInterface
{
    public function __construct(Loan $model)
    {
        parent::__construct($model);
    }

    public function totalTaken(): float
    {
        return (float) $this->model->sum('amount');
    }

    public function totalPaid(): float
    {
        return (float) LoanPayment::sum('amount');
    }

    public function totalRemaining(): float
    {
        return $this->totalTaken() - $this->totalPaid();
    }
}
