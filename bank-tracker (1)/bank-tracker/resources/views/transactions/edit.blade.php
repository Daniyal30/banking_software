@extends('layouts.app')

@section('title', 'Edit Transaction')

@section('content')
    <h3 class="mb-3">Edit Transaction</h3>
    <div class="card p-4" style="max-width: 600px;">
        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('transactions._form')
            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
@endsection
