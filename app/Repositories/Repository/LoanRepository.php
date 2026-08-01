<?php

namespace App\Repositories\Repository;

use App\Models\Loan;
use App\Repositories\Interface\LoanInterface;
use Illuminate\Support\Facades\DB;

class LoanRepository implements LoanInterface
{
    /**
     * @return mixed
     */
    public function index(): mixed
    {
        return Loan::latest()->paginate(10);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        try {

            DB::beginTransaction();

            $loan = Loan::create([
                'lenderId' => $data['lenderId'],
                'amount' => $data['amount'],
                'loanDate' => $data['loanDate'],
                'description' => $data['description']
            ]);

            DB::commit();

            return $loan;

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * @param Loan $loan
     * @return mixed
     */
    public function show(Loan $loan): mixed
    {
        return $loan;
    }

    /**
     * @param Loan $loan
     * @return mixed
     */
    public function edit(Loan $loan): mixed
    {
        return $loan;
    }

    /**
     * @param array $data
     * @param Loan $loan
     * @return mixed
     */
    public function update(array $data, Loan $loan):  mixed
    {
        try {

            DB::beginTransaction();

            $loan->update([
                'lenderId' => $data['lenderId'] ?? $loan->lenderId,
                'amount' => $data['amount'] ?? $loan->amount,
                'loanDate' => $data['loanDate'] ?? $loan->loanDate,
                'description' => $data['description'] ?? $loan->description
            ]);

            DB::commit();

            return $loan;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * @param Loan $loan
     * @return mixed
     */
    public function destroy(Loan $loan): mixed
    {
        try {

            DB::beginTransaction();

            $loan->delete();

            DB::commit();

            return $loan;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
