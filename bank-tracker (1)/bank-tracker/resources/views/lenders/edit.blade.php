@extends('layouts.app')

@section('title', 'Edit Lender')

@section('content')
    <h3 class="mb-3">Edit Lender</h3>
    <div class="card p-4" style="max-width: 600px;">
        <form action="{{ route('lenders.update', $lender->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('lenders._form')
            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
@endsection
