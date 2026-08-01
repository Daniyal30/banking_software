<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Models\Lender;
use App\Models\Loan;
use App\Repositories\Interface\LoanInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanController extends Controller
{
    protected LoanInterface $loanRepository;

    /**
     * @param LoanInterface $loanRepository
     */
    public function __construct(LoanInterface $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = $this->loanRepository->index();
        return view('loan.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lenders = Lender::all();
        return view('loan.create', compact('lenders'));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreLoanRequest $request
     * @return JsonResponse
     */
    public function store(StoreLoanRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $this->loanRepository->store($data);
            return response()->json([
                'success' => true,
                'message' => 'Loan Created successfully',
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
     * @param Loan $loan
     * @param View
     * @return RedirectResponse
     */
    public function show(Loan $loan): View|RedirectResponse
    {
        try {
            return view('loan.show', compact('loan'));
        } catch (\Throwable $th) {
           return redirect()->back()->with('error', 'Error Occur')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param Loan $loan
     * @param View
     * @return RedirectResponse
     */
    public function edit(Loan $loan): View|RedirectResponse
    {
        try {
            $lenders = Lender::all();
            return view('loan.edit', compact('loan', 'lenders'));
        } catch (\Throwable $th) {
             return redirect()->back()->with('error', 'Error Occur')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Loan $loan
     * @param UpdateLoanRequest $request
     * @return JsonResponse
     */
    public function update(UpdateLoanRequest $request, Loan $loan): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->loanRepository->update($data, $loan);
        return response()->json([
                'success' => true,
                'message' => 'Loan Updated successfully',
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
     * @param Loan $loan
     * @return JsonResponse
     */
    public function destroy(Loan $loan): JsonResponse
    {
        try {
            $this->loanRepository->destroy($loan);
        return response()->json([
                'success' => true,
                'message' => 'Loan Deleted successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
