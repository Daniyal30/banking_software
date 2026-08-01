<?php

namespace App\Http\Controllers;

use App\DataTables\LoansDataTable;
use App\Models\Loan;
use App\Repositories\Contracts\LenderRepositoryInterface;
use App\Repositories\Contracts\LoanRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function __construct(
        protected LoanRepositoryInterface $loans,
        protected LenderRepositoryInterface $lenders,
    ) {
    }

    public function index(LoansDataTable $dataTable)
    {
        return $dataTable->render('loans.index');
    }

    public function create()
    {
        $lenders = $this->lenders->all();

        return view('loans.create', compact('lenders'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        $this->loans->create($data);

        return redirect()
            ->route('loans.index')
            ->with('success', 'Loan add ho gaya.');
    }

    public function show(int $id)
    {
        $loan = Loan::with(['lender', 'payments'])->findOrFail($id);

        return view('loans.show', compact('loan'));
    }

    public function edit(int $id)
    {
        $loan = $this->loans->find($id);
        $lenders = $this->lenders->all();

        return view('loans.edit', compact('loan', 'lenders'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $this->validateData($request);

        $this->loans->update($id, $data);

        return redirect()
            ->route('loans.index')
            ->with('success', 'Loan update ho gaya.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->loans->delete($id);

        return redirect()
            ->route('loans.index')
            ->with('success', 'Loan delete ho gaya.');
    }

    protected function validateData(Request $request): array
    {
        return Validator::make($request->all(), [
            'lender_id' => ['required', 'exists:lenders,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'loan_date' => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:1000'],
        ])->validate();
    }
}
