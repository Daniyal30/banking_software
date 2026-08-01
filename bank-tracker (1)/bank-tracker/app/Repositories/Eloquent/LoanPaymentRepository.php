<?php

namespace App\Repositories\Eloquent;

use App\Models\LoanPayment;
use App\Repositories\Contracts\LoanPaymentRepositoryInterface;

class LoanPaymentRepository extends BaseRepository implements LoanPaymentRepositoryInterface
{
    public function __construct(LoanPayment $model)
    {
        parent::__construct($model);
    }
}
