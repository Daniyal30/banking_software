<?php

namespace App\Repositories\Repository;

use App\Models\Transaction;
use App\Repositories\Interface\TransactionInterface;
use Illuminate\Support\Facades\DB;


class TransactionRepository implements TransactionInterface
{
    /**
     * @return mixed
     */
    public function index(): mixed
    {
        return Transaction::latest()->paginate(10);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        try {

            DB::beginTransaction();

            $transaction = Transaction::create([
                'type' => $data['type'],
                'amount' => $data['amount'],
                'transactionDate' => $data['transactionDate'],
                'description' => $data['description']
            ]);

            DB::commit();

            return $transaction;
        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }
    }

    /**
     * @param Transaction $transaction
     * @return mixed
     */
    public function show(Transaction $transaction): mixed
    {
        return $transaction;
    }

    /**
     * @param Transaction $transaction
     * @return mixed
     */
    public function edit(Transaction $transaction): mixed
    {
        return $transaction;
    }

    /**
     * @param Transaction $transaction
     * @param array $data
     * @return mixed
     */
    public function update(array $data, Transaction $transaction): mixed
    {
        try {

            DB::beginTransaction();

            $transaction->update([
                'type' => $data['type'] ?? $transaction->type,
                'amount' => $data['amount'] ?? $transaction->amount,
                'transactionDate' => $data['transactionDate'] ?? $transaction->transactionDate,
                'description' => $data['description'] ?? $transaction->description
            ]);

            DB::commit();

            return $transaction;
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }
    }

    /**
     * @param Transaction $transaction
     * @return mixed
     */
    public function destroy(Transaction $transaction): mixed
    {
        try {

            DB::beginTransaction();

            $transaction->delete();

            DB::commit();

            return $transaction;
        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }
    }
}
