@extends('adminlte::page')

@section('title', 'Lender Details')

@section('content')

    <div class="pt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Lender Details</h4>
            <div>
                <a href="{{ route('lenders.edit', $lender->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('lenders.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center mb-3">
                        @if($lender->profile)
                            <img src="{{ asset('storage/' . $lender->profile) }}" alt="{{ $lender->name }}" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                    </div>

                    <div class="col-md-9">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 200px;">Name</th>
                                <td> {{ $lender->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td> {{ $lender->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td> {{ $lender->phone }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td> {{ ucfirst($lender->gender) }}</td>
                            </tr>
                            <tr>
                                <th>Notes</th>
                                <td> {{ $lender->notes ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="m-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Loan History</h5>
                <span class="badge bg-success fs-6">Total: {{ number_format($totalLoanAmount) }}</span>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Loan Date</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lender->loans as $loan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ number_format($loan->amount) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($loan->loanDate)->format('d-m-Y') }}</td>
                                    <td>{{ $loan->description ?? '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">No loans yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
