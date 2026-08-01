@extends('layouts.app')

@section('title', 'New Transaction')

@section('content')
    <h3 class="mb-3">New Transaction</h3>
    <div class="card p-4" style="max-width: 600px;">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            @include('transactions._form')
            <button type="submit" class="btn btn-primary mt-2">Save</button>
        </form>
    </div>
@endsection
