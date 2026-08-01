@extends('adminlte::page')

@section('title', 'Transaction')


@section('content')


    <div class="pt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Create Transaction</h4>
        <a href="{{ route('transaction.index') }}" class="btn btn-primary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('transaction.store') }}" method="post" id="storeData">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                       <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Select Transaction <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" id="type" name="type">
                                <option selected>Select One</option>
                                <option value="credit">Credit</option>
                                <option value="debit">Debit</option>
                            </select>
                            <div class="text-danger error-msg" id="createErrtype"></div>
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
                            <label for="exampleFormControlInput1" class="form-label">Transaction Date <span class="text-danger">*</span></label>
                            <input type="date" name="transactionDate" class="form-control" id="transactionDate" placeholder="Enter Loan Date">
                            <div class="text-danger error-msg" id="createErrtransactionDate"></div>
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
                url: "{{ route('transaction.store') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content'),
                },
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location.href = "{{ route('transaction.index') }}?success=" + encodeURIComponent(response.message);
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    console.log(errors);
                    $('.error-msg').text('');
                    if (errors.type) {
                        $('#createErrtype').text(errors.type[0]);
                    }
                    if (errors.amount) {
                        $('#createErrAmount').text(errors.amount[0]);
                    }
                    if (errors.transactionDate) {
                        $('#createErrtransactionDate').text(errors.transactionDate[0]);
                    }
                }
            })
        })
    </script>
@endpush
@stop
