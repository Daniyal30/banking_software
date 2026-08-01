@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Transactions (Debit / Credit)</h3>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">+ New Transaction</a>
    </div>

    <div class="card p-3">
        {!! $dataTable->table(['class' => 'table table-striped w-100']) !!}
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
