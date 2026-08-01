@extends('adminlte::page')

@section('title', 'loans')


@section('content')


    <div class="pt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Create Loan</h4>
        <a href="{{ route('loan.index') }}" class="btn btn-primary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('loan.store') }}" method="post" id="storeData">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                       <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Select Person <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" id="lenderId" name="lenderId">
                                <option selected>Select One</option>
                                @foreach ($lenders as $lender)
                                    <option value="{{ $lender->id }}">{{ $lender->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger error-msg" id="createErrlenderId"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Amount">
                            <div class="text-danger error-msg" id="createErrAmount"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Loan Date <span class="text-danger">*</span></label>
                            <input type="date" name="loanDate" class="form-control" id="loanDate" placeholder="Enter Loan Date">
                            <div class="text-danger error-msg" id="createErrloanDate"></div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@push('js')
    <script>
        $('#storeData').on('submit', function (e) {

            e.preventDefault();

            $.ajax({
                url: "{{ route('loan.store') }}",
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
                    if (errors.lenderId) {
                        $('#createErrlenderId').text(errors.lenderId[0]);
                    }
                    if (errors.amount) {
                        $('#createErrAmount').text(errors.amount[0]);
                    }
                    if (errors.loanDate) {
                        $('#createErrloanDate').text(errors.loanDate[0]);
                    }
                }
            })
        })
    </script>
@endpush
@stop
