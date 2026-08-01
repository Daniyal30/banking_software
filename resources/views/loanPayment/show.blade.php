@extends('adminlte::page')

@section('title', 'Loan Payment Details')

@section('content')

    <div class="pt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Loan Payment Details</h4>
            <div>
                <a href="{{ route('loanPayment.edit', $loanPayment->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('loanPayment.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

            <div class="card p-4">
        <table class="table table-borderless mb-0">
            <tr>
                <th style="width: 220px;">Payment ID</th>
                <td>#{{ $loanPayment->id }}</td>
            </tr>
            <tr>
                <th>Lender</th>
                <td>
                    <a href="{{ route('lenders.show', $loanPayment->lenderId) }}">{{ $loanPayment->lender->name }}</a>
                </td>
            </tr>
            <tr>
                <th>Amount Paid</th>
                <td><span class="fs-4 fw-bold text-success">{{ number_format($loanPayment->amount) }}</span></td>
            </tr>
            <tr>
                <th>Payment Date</th>
                <td>{{ $loanPayment->paymentDate->format('d-M-Y') }}</td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>{{ $loanPayment->notes ?? '-' }}</td>
            </tr>
            <tr>
                <th>Lender Remaining</th>
                <td>
                    <span class="badge bg-{{ $loanPayment->lender->total_remaining <= 0 ? 'success' : 'warning' }}">
                        {{ number_format($loanPayment->lender->total_remaining) }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Recorded On</th>
                <td>{{ $loanPayment->created_at->format('d-M-Y h:i A') }}</td>
            </tr>
        </table>
    </div>
    </div>

@stop
