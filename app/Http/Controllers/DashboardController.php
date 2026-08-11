<?php

namespace App\Http\Controllers;

use App\Models\Lender;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
{
    try {
        $lendersCount = Lender::count();
       $totalCredit = Transaction::where('type', 'credit')->sum('amount');
$totalDebit = Transaction::where('type', 'debit')->sum('amount');
        $totalLoan = Loan::sum('amount');
        $totalLoanPaid = LoanPayment::sum('amount');
        $remainingLoan = $totalLoan - $totalLoanPaid;

        return view('admin.dashboard', compact(
            'lendersCount', 'totalCredit', 'totalDebit', 'totalLoan', 'remainingLoan'
        ));
    } catch (\Throwable $th) {
        \Log::error('Dashboard error: ' . $th->getMessage()); // temporarily add ye line
        dd($th->getMessage());
    }
    }
}
