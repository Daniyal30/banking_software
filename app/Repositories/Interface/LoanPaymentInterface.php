<?php

namespace App\Repositories\Interface;

use App\Models\LoanPayment;

interface LoanPaymentInterface
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
     * @param LoanPayment $loanPayment
     * @return mixed
     */
    public function show(LoanPayment $loanPayment): mixed;

    /**
     * @param LoanPayment $loanPayment
     * @return mixed
     */
    public function edit(LoanPayment $loanPayment): mixed;

    /**
     * @param array $data
     * @param LoanPayment $loanPayment
     * @return mixed
     */
    public function update(array $data, LoanPayment $loanPayment): mixed;

    /**
     * @param LoanPayment $loanPayment
     * @return mixed
     */
    public function destroy(LoanPayment $loanPayment): mixed;
}
