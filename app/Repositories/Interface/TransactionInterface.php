<?php

namespace App\Repositories\Interface;

use App\Models\Transaction;

interface TransactionInterface
{
    /**
     * @return mixed
     */
    public function index(): mixed;

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed;

    /**
     * @param Transaction $transaction
     * @return mixed
     */
    public function show(Transaction $transaction): mixed;

    /**
     * @param Transaction $transaction
     * @return mixed
     */
    public function edit(Transaction $transaction): mixed;

    /**
     * @param Transaction $transaction
     * @param array $data
     * @return mixed
     */
    public function update(array $data, Transaction $transaction): mixed;

    /**
     * @param Transaction $transaction
     * @return mixed
     */
    public function destroy(Transaction $transaction): mixed;
}
