@extends('layouts.app')

@section('title', 'New Loan')

@section('content')
    <h3 class="mb-3">New Loan</h3>
    <div class="card p-4" style="max-width: 600px;">
        <form action="{{ route('loans.store') }}" method="POST">
            @csrf
            @include('loans._form')
            <button type="submit" class="btn btn-primary mt-2">Save</button>
        </form>
    </div>
@endsection
