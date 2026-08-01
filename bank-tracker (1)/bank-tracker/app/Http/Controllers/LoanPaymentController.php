<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Repositories\Contracts\LoanPaymentRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoanPaymentController extends Controller
{
    public function __construct(protected LoanPaymentRepositoryInterface $payments)
    {
    }

    public function store(Request $request, int $loanId): RedirectResponse
    {
        $loan = Loan::findOrFail($loanId);

        $data = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'min:0.01', 'max:' . $loan->remaining_amount],
            'payment_date' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ])->validate();

        $data['loan_id'] = $loan->id;

        $this->payments->create($data);

        return redirect()
            ->route('loans.show', $loan->id)
            ->with('success', 'Payment record ho gaya. Baaqi amount update ho gaya hai.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $payment = $this->payments->find($id);
        $loanId = $payment->loan_id;

        $this->payments->delete($id);

        return redirect()
            ->route('loans.show', $loanId)
            ->with('success', 'Payment delete ho gaya.');
    }
}
