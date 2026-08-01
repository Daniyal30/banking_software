@extends('layouts.app')

@section('title', 'Edit Loan')

@section('content')
    <h3 class="mb-3">Edit Loan</h3>
    <div class="card p-4" style="max-width: 600px;">
        <form action="{{ route('loans.update', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('loans._form')
            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
@endsection
