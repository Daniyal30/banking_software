<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLenderRequest;
use App\Http\Requests\UpdateLenderRequest;
use App\Models\Lender;
use App\Repositories\Interface\LenderInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LenderController extends Controller
{
    protected LenderInterface $lenderRepository;

    /**
     * @param LenderInterface $lenderRepository
     */
    public function __construct(LenderInterface $lenderRepository)
    {
        $this->lenderRepository = $lenderRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lenders =$this->lenderRepository->index();
        return view('lender.index', compact('lenders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lender.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreLenderRequest $request
     * @return JsonResponse
     */
    public function store(StoreLenderRequest $request): JsonResponse
{
    try {
        $data = $request->validated();

        $this->lenderRepository->store($data);

        return response()->json([
            'success' => true,
            'message' => 'Lender Created successfully',
        ], JsonResponse::HTTP_OK);
    } catch (\Throwable $th) {
        return response()->json([
            'success' => false,
            'message' => $th->getMessage(),
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}

    /**
     * Display the specified resource.
     * @param Lender $lender
     * @return View
     * @return RedirectResponse
     */
    public function show(Lender $lender): View|RedirectResponse
    {
        try {
            $lender->load('loans');
            $totalLoanAmount = $lender->loans->sum('amount');

            return view('lender.show', compact('lender', 'totalLoanAmount'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error Occur')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param Lender $lender
     * @return View
     * @return RedirectResponse
     */
    public function edit(Lender $lender): View|RedirectResponse
    {
        try {
            return view('lender.edit', compact('lender'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error Occur')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateLenderRequest $request
     * @param Lender $lender
     * @return JsonResponse
     */
    public function update(UpdateLenderRequest $request, Lender $lender): JsonResponse
    {
        try {

            $data = $request->validated();

            $this->lenderRepository->update($data, $lender);
        return response()->json([
                'success' => true,
                'message' => 'Lender Updated successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Lender $lender
     * @return JsonResponse
     */
    public function destroy(Lender $lender): JsonResponse
    {
        try {
            $this->lenderRepository->destroy($lender);
        return response()->json([
                'success' => true,
                'message' => 'Lender Deleted successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
