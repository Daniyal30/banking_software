<?php

namespace App\Http\Controllers;

use App\DataTables\TransactionsDataTable;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function __construct(protected TransactionRepositoryInterface $transactions)
    {
    }

    public function index(TransactionsDataTable $dataTable)
    {
        return $dataTable->render('transactions.index');
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        $this->transactions->create($data);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction save ho gaya.');
    }

    public function edit(int $id)
    {
        $transaction = $this->transactions->find($id);

        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $this->validateData($request);

        $this->transactions->update($id, $data);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction update ho gaya.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->transactions->delete($id);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction delete ho gaya.');
    }

    protected function validateData(Request $request): array
    {
        return Validator::make($request->all(), [
            'type' => ['required', 'in:debit,credit'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'transaction_date' => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:1000'],
        ])->validate();
    }
}
