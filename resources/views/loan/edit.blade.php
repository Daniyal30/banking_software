@extends('adminlte::page')

@section('title', 'Lenders')


@section('content')


    <div class="pt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Lenders</h4>
        <a href="{{ route('lenders.index') }}" class="btn btn-primary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('loan.update', $loan->id) }}" method="post" id="editData" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Select Person <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" id="lenderId" name="lenderId">
                                <option>Select One</option>
                                @foreach ($lenders as $lender)
                                    <option value="{{ $lender->id }}" @selected($lender->id == $loan->lenderId)>
                                        {{ $lender->name }}
                                    </option>
                                @endforeach
                            </select>
                        <div class="text-danger error-msg" id="createErrlenderId"></div>
                    </div>
                </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="number" name="amount" class="form-control" id="amount" value="{{ $loan->amount }}" placeholder="Enter Amount">
                            <div class="text-danger error-msg" id="createErrAmount"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Loan Date <span class="text-danger">*</span></label>
                            <input type="date" name="loanDate" class="form-control" id="loanDate" value="{{ $loan->loanDate }}" placeholder="Enter Loan Date">
                            <div class="text-danger error-msg" id="createErrloanDate"></div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5">{{ $loan->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

@push('js')
    <script>
        $('#editData').on('submit', function (e) {

            e.preventDefault();

            $.ajax({
                url: "{{ route('loan.update', $loan->id) }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content'),
                },
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location.href = "{{ route('loan.index') }}?success=" + encodeURIComponent(response.message);
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    console.log(errors);
                    $('.error-msg').text('');
                    if (errors.name) {
                        $('#editErrName').text(errors.name[0]);
                    }
                    if (errors.email) {
                        $('#editErrEmail').text(errors.email[0]);
                    }
                    if (errors.phone) {
                        $('#editErrPhone').text(errors.phone[0]);
                    }
                    if (errors.gender) {
                        $('#editErrGender').text(errors.gender[0]);
                    }
                    if (errors.profile) {
                        $('#editErrProfile').text(errors.profile[0]);
                    }
                }
            })
        })
    </script>
@endpush
@stop
