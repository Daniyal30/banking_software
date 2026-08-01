<?php

namespace App\Repositories\Interface;

use App\Models\Lender;

interface LenderInterface
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
     * @param Lender $lender
     * @return mixed
     */
    public function show(Lender $lender): mixed;

    /**
     * @param Lender $lender
     * @return mixed
     */
    public function edit(Lender $lender): mixed;

    /**
     * @param array $data
     * @param Lender $lender
     * @return mixed
     */
    public function update(array $data, Lender $lender): mixed;

    /**
     * @param Lender $lender
     * @return mixed
     */
    public function destroy(Lender $lender): mixed;
}
