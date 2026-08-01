<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\LoanRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;

class DashboardController extends Controller
{
    public function __construct(
        protected TransactionRepositoryInterface $transactions,
        protected LoanRepositoryInterface $loans,
    ) {
    }

    public function index()
    {
        $summary = [
            'total_credit' => $this->transactions->totalCredit(),
            'total_debit' => $this->transactions->totalDebit(),
            'balance' => $this->transactions->balance(),
            'total_loan_taken' => $this->loans->totalTaken(),
            'total_loan_paid' => $this->loans->totalPaid(),
            'total_loan_remaining' => $this->loans->totalRemaining(),
        ];

        return view('dashboard.index', compact('summary'));
    }
}
