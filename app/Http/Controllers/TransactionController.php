<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Repositories\Interface\TransactionInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{

    protected TransactionInterface $transactionRepository;

    /**
     * @param TransactionInterface $transactionRepository
     */
    public function __construct(TransactionInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = $this->transactionRepository->index();
        return view('transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreTransactionRequest $request
     * @return JsonResponse
     */
    public function store(StoreTransactionRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->transactionRepository->store($data);
            return response()->json([
                'status' => true,
                'message' => 'Transaction Created Successfully',
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
     * @param Transaction $transaction
     * @param View
     * @return RedirectResponse
     */
    public function show(Transaction $transaction): View|RedirectResponse
    {
        try {
           return view('transaction.show', compact('transaction'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error Occur')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param Transaction $transaction
     * @param View
     * @return RedirectResponse
     */
    public function edit(Transaction $transaction): View|RedirectResponse
    {
        try {
            return view('transaction.edit', compact('transaction'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error Occur')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateTransactionRequest $request
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction): JsonResponse
    {
        try {

            $data = $request->validated();

            $this->transactionRepository->update($data, $transaction);

            return response()->json([
                'status' => true,
                'message' => 'Transaction Updated Successfully'
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
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        try {

            $this->transactionRepository->destroy($transaction);

            return response()->json([
                'status' => true,
                'message' => 'Transaction Deleted Successfully'
            ], JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
