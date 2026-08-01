@extends('adminlte::page')

@section('title', 'loan Payment')


@section('content')


    <div class="pt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Create Loan Payment</h4>
        <a href="{{ route('loanPayment.index') }}" class="btn btn-primary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('loanPayment.store') }}" method="post" id="storeData">
                @csrf
                <div class="row">
                    <div class="col-md-6">
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

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Remaining Loan</label>
                            <input type="text" class="form-control" id="remainingLoan" readonly>
                            <div class="text-success mt-1" id="loanClearedMsg" style="display:none;">
                                Loan Fully Paid
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Amount">
                            <div class="text-danger error-msg" id="createErrAmount"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Loan Date <span class="text-danger">*</span></label>
                            <input type="date" name="paymentDate" class="form-control" id="paymentDate" placeholder="Enter Loan Date">
                            <div class="text-danger error-msg" id="createErrpaymentDate"></div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="notes" rows="5"></textarea>
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
                url: "{{ route('loanPayment.store') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content'),
                },
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location.href = "{{ route('loanPayment.index') }}?success=" + encodeURIComponent(response.message);
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
                    if (errors.paymentDate) {
                        $('#createErrpaymentDate').text(errors.paymentDate[0]);
                    }
                }
            })
        })

       let originalRemainingLoan = 0;

function toggleClearedMsg(remaining) {
    if (remaining <= 0) {
        $('#loanClearedMsg').show();
    } else {
        $('#loanClearedMsg').hide();
    }
}

$('#lenderId').change(function () {
    let lenderId = $(this).val();
    $('#amount').val('');

    if (lenderId == '' || lenderId == 'Select One') {
        $('#remainingLoan').val('');
        $('#loanClearedMsg').hide();
        originalRemainingLoan = 0;
        return;
    }
    $.ajax({
        url: "/admin/loanPayment/get-lender-loan/" + lenderId,
        type: "GET",
        success: function(response){
            originalRemainingLoan = parseFloat(response.remainingLoan) || 0;
            $('#remainingLoan').val(originalRemainingLoan);
            toggleClearedMsg(originalRemainingLoan);
        }
    });
});

$('#amount').on('input', function () {
    let enteredAmount = parseFloat($(this).val()) || 0;

    if (enteredAmount > originalRemainingLoan) {
        enteredAmount = originalRemainingLoan;
        $(this).val(enteredAmount);
    }

    let updatedRemaining = originalRemainingLoan - enteredAmount;

    if (updatedRemaining < 0) {
        updatedRemaining = 0;
    }

    $('#remainingLoan').val(updatedRemaining);
    toggleClearedMsg(updatedRemaining);
});
</script>
@endpush
@stop
