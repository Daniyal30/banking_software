@extends('adminlte::page')

@section('title', 'Lenders')


@section('content')


    <div class="pt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Create Lenders</h4>
        <a href="{{ route('lenders.index') }}" class="btn btn-primary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('lenders.store') }}" method="post" id="storeData" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
                            <div class="text-danger error-msg" id="createErrName"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                            <div class="text-danger error-msg" id="createErrEmail"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone">
                            <div class="text-danger error-msg" id="createErrPhone"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Select Gender <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" id="gender" name="gender">
                                <option selected>Select One</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div class="text-danger error-msg" id="createErrGender"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <label for="" class="form-label">Profile <span class="text-danger">*</span></label>
                         <input type="file" class="form-control" name="profile">
                         <div class="text-danger error-msg" id="createErrProfile"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="5"></textarea>
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
                url: "{{ route('lenders.store') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content'),
                },
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location.href = "{{ route('lenders.index') }}?success=" + encodeURIComponent(response.message);
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    console.log(errors);
                    $('.error-msg').text('');
                    if (errors.name) {
                        $('#createErrName').text(errors.name[0]);
                    }
                    if (errors.email) {
                        $('#createErrEmail').text(errors.email[0]);
                    }
                    if (errors.phone) {
                        $('#createErrPhone').text(errors.phone[0]);
                    }
                    if (errors.gender) {
                        $('#createErrGender').text(errors.gender[0]);
                    }
                    if (errors.profile) {
                        $('#createErrProfile').text(errors.profile[0]);
                    }
                }
            })
        })
    </script>
@endpush
@stop
