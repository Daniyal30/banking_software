@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h3 class="mb-4">Dashboard</h3>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card summary-card p-3">
                <h6>Total Credit (Aya hua paisa)</h6>
                <h3 class="text-success">{{ number_format($summary['total_credit'], 2) }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card summary-card p-3">
                <h6>Total Debit (Gaya hua paisa)</h6>
                <h3 class="text-danger">{{ number_format($summary['total_debit'], 2) }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card summary-card p-3">
                <h6>Current Balance</h6>
                <h3 class="{{ $summary['balance'] >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ number_format($summary['balance'], 2) }}
                </h3>
            </div>
        </div>
    </div>

    <h5 class="mb-3">Loans Summary</h5>
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card summary-card p-3">
                <h6>Total Loan Liya Gaya</h6>
                <h3>{{ number_format($summary['total_loan_taken'], 2) }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card summary-card p-3">
                <h6>Total Loan Paid</h6>
                <h3 class="text-success">{{ number_format($summary['total_loan_paid'], 2) }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card summary-card p-3">
                <h6>Total Loan Remaining</h6>
                <h3 class="text-warning">{{ number_format($summary['total_loan_remaining'], 2) }}</h3>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">+ New Transaction</a>
        <a href="{{ route('loans.create') }}" class="btn btn-outline-primary">+ New Loan</a>
        <a href="{{ route('lenders.create') }}" class="btn btn-outline-secondary">+ New Lender</a>
    </div>
@endsection
