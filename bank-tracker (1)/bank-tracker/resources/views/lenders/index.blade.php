@extends('layouts.app')

@section('title', 'Lenders')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Lenders (Jin se loan liya)</h3>
        <a href="{{ route('lenders.create') }}" class="btn btn-primary">+ New Lender</a>
    </div>

    <div class="card p-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>CNIC</th>
                    <th>City</th>
                    <th>Total Loan</th>
                    <th>Total Paid</th>
                    <th>Remaining</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lenders as $lender)
                    <tr>
                        <td>{{ $lender->name }}</td>
                        <td>{{ $lender->phone ?? '-' }}</td>
                        <td>{{ $lender->detail->cnic ?? '-' }}</td>
                        <td>{{ $lender->detail->city ?? '-' }}</td>
                        <td>{{ number_format($lender->total_loan, 2) }}</td>
                        <td>{{ number_format($lender->total_paid, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $lender->total_remaining > 0 ? 'warning' : 'success' }}">
                                {{ number_format($lender->total_remaining, 2) }}
                            </span>
                        </td>
                        <td class="d-flex gap-1">
                            <a href="{{ route('lenders.edit', $lender->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('lenders.destroy', $lender->id) }}" method="POST" onsubmit="return confirm('Delete karna hai?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted">Koi lender abhi tak add nahi hua.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
