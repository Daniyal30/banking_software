@extends('layouts.app')

@section('title', 'New Lender')

@section('content')
    <h3 class="mb-3">New Lender</h3>
    <div class="card p-4" style="max-width: 600px;">
        <form action="{{ route('lenders.store') }}" method="POST">
            @csrf
            @include('lenders._form')
            <button type="submit" class="btn btn-primary mt-2">Save</button>
        </form>
    </div>
@endsection
