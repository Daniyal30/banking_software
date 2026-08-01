@extends('adminlte::page')

@section('title', 'Transaction')


@section('content')


    <div class="pt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Transaction</h4>
        <a href="{{ route('transaction.index') }}" class="btn btn-primary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('transaction.update', $transaction->id) }}" method="post" id="updateDate">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                       <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Select Transaction <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" id="type" name="type">
                                <option selected>Select One</option>
                                <option value="credit" @selected($transaction->type == 'credit')>Credit</option>
                                <option value="debit" @selected($transaction->type == 'debit')>Debit</option>
                            </select>
                            <div class="text-danger error-msg" id="updateErrtype"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="number" name="amount" class="form-control" id="amount" value="{{ $transaction->amount }}" placeholder="Enter Amount">
                            <div class="text-danger error-msg" id="updateErrAmount"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Transaction Date <span class="text-danger">*</span></label>
                            <input type="date" name="transactionDate" class="form-control" id="transactionDate" value="{{ $transaction->transactionDate }}" placeholder="Enter Loan Date">
                            <div class="text-danger error-msg" id="updateErrtransactionDate"></div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5">{{ $transaction->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

@push('js')
    <script>
        $('#updateDate').on('submit', function (e) {

            e.preventDefault();

            $.ajax({
                url: "{{ route('transaction.update', $transaction->id) }}",
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
                        $('#updateErrtype').text(errors.type[0]);
                    }
                    if (errors.amount) {
                        $('#updateErrAmount').text(errors.amount[0]);
                    }
                    if (errors.transactionDate) {
                        $('#updateErrtransactionDate').text(errors.transactionDate[0]);
                    }
                }
            })
        })
    </script>
@endpush
@stop
