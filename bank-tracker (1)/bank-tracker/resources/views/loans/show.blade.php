@extends('layouts.app')

@section('title', 'Loan Detail')

@section('content')
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h3>{{ $loan->lender->name }} - Loan Detail</h3>
            <p class="text-muted mb-0">Liya gaya: {{ $loan->loan_date->format('d-M-Y') }}</p>
        </div>
        <a href="{{ route('loans.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card summary-card p-3">
                <h6>Total Loan</h6>
                <h3>{{ number_format($loan->amount, 2) }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card summary-card p-3">
                <h6>Total Paid</h6>
                <h3 class="text-success">{{ number_format($loan->paid_amount, 2) }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card summary-card p-3">
                <h6>Remaining</h6>
                <h3 class="{{ $loan->is_cleared ? 'text-success' : 'text-warning' }}">
                    {{ number_format($loan->remaining_amount, 2) }}
                </h3>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-7">
            <div class="card p-3">
                <h5 class="mb-3">Payment History</h5>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Notes</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($loan->payments->sortByDesc('payment_date') as $payment)
                            <tr>
                                <td>{{ $payment->payment_date->format('d-M-Y') }}</td>
                                <td>{{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->notes ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('loan-payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Delete karna hai?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted">Abhi tak koi payment nahi ki gayi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-5">
            @if (! $loan->is_cleared)
                <div class="card p-3">
                    <h5 class="mb-3">Add Payment</h5>
                    <form action="{{ route('loan-payments.store', $loan->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Amount (max {{ number_format($loan->remaining_amount, 2) }})</label>
                            <input type="number" step="0.01" name="amount" class="form-control"
                                   max="{{ $loan->remaining_amount }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Payment Date</label>
                            <input type="date" name="payment_date" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes (optional)</label>
                            <textarea name="notes" class="form-control" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Payment</button>
                    </form>
                </div>
            @else
                <div class="alert alert-success">Ye loan pura clear ho chuka hai. 🎉</div>
            @endif
        </div>
    </div>
@endsection
