<?php

namespace App\Repositories\Repository;

use App\Models\Lender;
use App\Repositories\Interface\LenderInterface;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\DB;


class LenderRepository implements LenderInterface
{
    use FileUploadTrait;

    public function index(): mixed
    {
        return Lender::latest()->paginate(10);
    }

    public function store(array $data): mixed
{
    try {
        DB::beginTransaction();

        if (isset($data['profile'])) {
            $data['profile'] = $this->UploadFile($data['profile']);
        }

        $lender = Lender::create([
            'userId'  => auth()->id(),
            'name'    => $data['name'],
            'email'   => $data['email'],
            'gender'  => $data['gender'],
            'phone'   => $data['phone'],
            'profile' => $data['profile'] ?? null,
            'notes'   => $data['notes'] ?? null,
        ]);

        DB::commit();

        return $lender;

    } catch (\Throwable $th) {
        DB::rollBack();
        throw $th;
    }
}

    public function show(Lender $lender): mixed
    {
        return $lender;
    }

    public function edit(Lender $lender): mixed
    {
        return $lender;
    }

    public function update(array $data, Lender $lender): mixed
    {
        try {
            DB::beginTransaction();

            if (isset($data['profile'])) {
                $this->DeleteFile($lender->profile);
                $data['profile'] = $this->UploadFile($data['profile']);
            }

            $lender->update([
                'name'    => $data['name'] ?? $lender->name,
                'email'    => $data['email'] ?? $lender->email,
                'profile' => $data['profile'] ?? $lender->profile,
                'phone'   => $data['phone'] ?? $lender->phone,
                'notes'   => $data['notes'] ?? $lender->notes,
            ]);

            DB::commit();

            return $lender;

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy(Lender $lender): mixed
    {
        try {
            DB::beginTransaction();

            $lender->delete();

            DB::commit();

            return $lender;

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
