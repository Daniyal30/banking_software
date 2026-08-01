@extends('layouts.app')

@section('title', 'Loans')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Loans (Jo liye hain)</h3>
        <a href="{{ route('loans.create') }}" class="btn btn-primary">+ New Loan</a>
    </div>

    <div class="card p-3">
        {!! $dataTable->table(['class' => 'table table-striped w-100']) !!}
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
