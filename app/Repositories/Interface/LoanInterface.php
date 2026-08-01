<?php

namespace App\Repositories\Interface;

use App\Models\Loan;

interface LoanInterface
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
     * @param Loan $loan
     * @return mixed
     */
    public function show(Loan $loan): mixed;

    /**
     * @param Loan $loan
     * @return mixed
     */
    public function edit(Loan $loan): mixed;

    /**
     * @param array $data
     * @param Loan $loan
     * @return mixed
     */
    public function update(array $data, Loan $loan): mixed;

    /**
     * @param Loan $loan
     * @return mixed
     */
    public function destroy(Loan $loan): mixed;
}
