@extends('adminlte::page')

@section('title', 'Transaction Details')

@section('content')

    <div class="pt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Transaction Details</h4>
            <div>
                <a href="{{ route('transaction.edit', $transaction->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('transaction.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

            <div class="card p-4">
        <table class="table table-borderless mb-0">
            <tr>
                <th>Type</th>
                    @if ($transaction->type == 'credit')
                        <td><span class="badge text-bg-success">{{ $transaction->type }}</span></td>
                    @else
                        <td><span class="badge text-bg-danger">{{ $transaction->type }}</span></td>
                    @endif
            </tr>
            <tr>
                <th>Amount</th>
                <td><span class="fs-4 fw-bold text-success">{{ number_format($transaction->amount) }}</span></td>
            </tr>
            <tr>
                <th>Payment Date</th>
                <td>{{ \Carbon\Carbon::parse($transaction->transactionDate)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>{{ $transaction->notes ?? 'N/A' }}</td>
            </tr>

        </table>
    </div>
    </div>

@stop
