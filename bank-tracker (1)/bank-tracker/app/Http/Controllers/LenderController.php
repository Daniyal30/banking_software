<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\LenderDetailRepositoryInterface;
use App\Repositories\Contracts\LenderRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LenderController extends Controller
{
    public function __construct(
        protected LenderRepositoryInterface $lenders,
        protected LenderDetailRepositoryInterface $lenderDetails,
    ) {
    }

    public function index()
    {
        $lenders = $this->lenders->all()->load('detail');

        return view('lenders.index', compact('lenders'));
    }

    public function create()
    {
        return view('lenders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        [$lenderData, $detailData] = $this->validateData($request);

        $detail = $this->lenderDetails->create($detailData);
        $lenderData['lender_detail_id'] = $detail->id;

        $this->lenders->create($lenderData);

        return redirect()
            ->route('lenders.index')
            ->with('success', 'Lender add ho gaya.');
    }

    public function edit(int $id)
    {
        $lender = $this->lenders->find($id)->load('detail');

        return view('lenders.edit', compact('lender'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        [$lenderData, $detailData] = $this->validateData($request);

        $lender = $this->lenders->find($id);

        if ($lender->lender_detail_id) {
            $this->lenderDetails->update($lender->lender_detail_id, $detailData);
        } else {
            $detail = $this->lenderDetails->create($detailData);
            $lenderData['lender_detail_id'] = $detail->id;
        }

        $this->lenders->update($id, $lenderData);

        return redirect()
            ->route('lenders.index')
            ->with('success', 'Lender update ho gaya.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->lenders->delete($id);

        return redirect()
            ->route('lenders.index')
            ->with('success', 'Lender delete ho gaya.');
    }

    /**
     * @return array{0: array, 1: array} [lenderData, detailData]
     */
    protected function validateData(Request $request): array
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'cnic' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'relationship' => ['nullable', 'string', 'max:100'],
        ])->validate();

        $lenderData = collect($validated)->only(['name', 'phone', 'notes'])->toArray();
        $detailData = collect($validated)->only(['cnic', 'address', 'email', 'city', 'relationship'])->toArray();

        return [$lenderData, $detailData];
    }
}
