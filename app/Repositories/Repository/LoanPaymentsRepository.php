<?php

namespace App\Repositories\Repository;

use App\Models\LoanPayment;
use App\Repositories\Interface\LoanPaymentInterface;
use Illuminate\Support\Facades\DB;

class LoanPaymentsRepository implements LoanPaymentInterface
{
    /**
     * @return mixed
     */
    public function index(): mixed
    {
        return LoanPayment::latest()->paginate(10);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        try {

            DB::beginTransaction();

            $loanPayment = LoanPayment::create([
                'lenderId' => $data['lenderId'],
                'amount' => $data['amount'],
                'paymentDate' => $data['paymentDate'],
                'notes' => $data['notes']
            ]);

            DB::commit();

            return $loanPayment;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * @param LoanPayment $loanPayment
     * @return mixed
     */
    public function show(LoanPayment $loanPayment): mixed
    {
        return $loanPayment;
    }

    /**
     * @param LoanPayment $loanPayment
     * @return mixed
     */
    public function edit(LoanPayment $loanPayment): mixed
    {
        return $loanPayment;
    }

    /**
     * @param array $data
     * @param LoanPayment $loanPayment
     * @return mixed
     */
    public function update(array $data, LoanPayment $loanPayment): mixed
    {
        try {

            DB::beginTransaction();

            $loanPayment->update([
                'lenderId' => $data['lenderId'] ?? $loanPayment->lenderId,
                'amount' => $data['amount'] ?? $loanPayment->amount,
                'paymentDate' => $data['paymentDate'] ?? $loanPayment->paymentDate,
                'notes' => $data['notes'] ?? $loanPayment->notes
            ]);

            DB::commit();

            return $loanPayment;

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * @param LoanPayment $loanPayment
     * @return mixed
     */
    public function destroy(LoanPayment $loanPayment): mixed
    {
        try {

            DB::beginTransaction();

            $loanPayment->delete();

            return $loanPayment;

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
