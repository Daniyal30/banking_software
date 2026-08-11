@extends('adminlte::page')

@section('title', 'Lenders')

@section('content')

    @if(request('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ request('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="pt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Lenders List</h4>
            <a href="{{ route('lenders.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Lender
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th class="text-center" style="width: 180px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @forelse ($lenders as $lender)
                                <tr>
                                    <td class="text-center text-muted">{{ ++$i }}</td>
                                    <td class="fw-semibold">{{ $lender->name }}</td>
                                    <td>{{ $lender->email }}</td>
                                    <td>{{ $lender->phone }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('lenders.show', $lender->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('lenders.edit', $lender->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"
                                            data-id="{{ $lender->id }}" data-url="{{ route('lenders.destroy', $lender->id) }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        No lenders found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-3">
            {{ $lenders->links() }}
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close btn-close-white" id="modalCloseBtn" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-trash-alt text-danger mb-3" style="font-size: 40px;"></i>
                <p class="mb-0 fs-6">Are you sure you want to delete this Record?</p>
                <small class="text-muted">This action cannot be undone.</small>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-secondary px-4" id="modalCancelBtn">Cancel</button>
                <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>
</div>

@push('js')
<script>
    var deleteUrl = "";

    var deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            deleteUrl = btn.getAttribute('data-url');
            $('#staticBackdrop').modal('show');
        });
    });

    document.getElementById('modalCloseBtn').addEventListener('click', function () {
        $('#staticBackdrop').modal('hide');
    });

    document.getElementById('modalCancelBtn').addEventListener('click', function () {
        $('#staticBackdrop').modal('hide');
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        $.ajax({
            url: deleteUrl,
            type: "POST",
            data: {
                _token: $("meta[name='csrf-token']").attr('content'),
                _method: 'DELETE'
            },
            success: function (response) {
                window.location.href = "{{ route('lenders.index') }}?success=" + response.message;
            },
            error: function () {
                alert('Something went wrong.');
                $('#staticBackdrop').modal('hide');
            }
        });
    });
</script>
@endpush
@stop
