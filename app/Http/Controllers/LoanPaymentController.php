<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanPaymentRequest;
use App\Http\Requests\UpdateLoanPaymentRequest;
use App\Models\Lender;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Repositories\Interface\LoanPaymentInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanPaymentController extends Controller
{

    protected LoanPaymentInterface $loanPaymentRepository;

    /**
     * @param LoanPaymentInterface $loanPaymentRepository
     */
    public function __construct(LoanPaymentInterface $loanPaymentRepository)
    {
        $this->loanPaymentRepository = $loanPaymentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loanPayments = $this->loanPaymentRepository->index();
        return view('loanPayment.index', compact('loanPayments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lenders = Lender::all();
        return view('loanPayment.create', compact('lenders'));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreLoanPaymentRequest $request
     * @return JsonResponse
     */
    public function store(StoreLoanPaymentRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->loanPaymentRepository->store($data);
            return response()->json([
                'status' => true,
                'message' => 'Loan Payment Created Successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
                return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     * @param LoanPayment $loanPayment
     * @param View
     * @return RedirectResponse
     */
    public function show(LoanPayment $loanPayment): View|RedirectResponse
    {
        try {
            return view('loanPayment.show', compact('loanPayment'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error Occur')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param LoanPayment $loanPayment
     * @param View
     * @return RedirectResponse
     */
    public function edit(LoanPayment $loanPayment): View|RedirectResponse
    {
        try {
            $lenders = Lender::all();
            return view('loanPayment.edit', compact('loanPayment', 'lenders'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error Occur')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateLoanPaymentRequest $request
     * @param LoanPayment $loanPayment
     * @return JsonResponse
     */
    public function update(UpdateLoanPaymentRequest $request, LoanPayment $loanPayment): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->loanPaymentRepository->update($data, $loanPayment);
            return response()->json([
                'status' => true,
                'message' => 'Loan Payment Updated Successfullu'
            ], JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param LoanPayment $loanPayment
     * @return JsonResponse
     */
    public function destroy(LoanPayment $loanPayment): JsonResponse
    {
        try {
            $this->loanPaymentRepository->destroy($loanPayment);
            return response()->json([
                'status' => true,
                'message' => 'Loan Payment Successfully'
            ], JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

   public function getLenderLoan(Lender $lender): JsonResponse
    {
        $totalLoan = $lender->loans()->sum('amount');

        $totalPayment = $lender->loanPayments()->sum('amount');

        $remainingLoan = $totalLoan - $totalPayment;

        return response()->json([
            'totalLoan' => $totalLoan,
            'totalPayment' => $totalPayment,
            'remainingLoan' => $remainingLoan
        ]);
    }
}
