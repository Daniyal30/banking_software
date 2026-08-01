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
            <form action="{{ route('lenders.store', $lender->id) }}" method="post" id="editData" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $lender->name }}" placeholder="Enter Name">
                            <div class="text-danger error-msg" id="editErrName"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $lender->email }}" placeholder="Enter Email">
                            <div class="text-danger error-msg" id="editErrEmail"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" id="phone" value="{{ $lender->phone }}" placeholder="Enter Phone">
                            <div class="text-danger error-msg" id="editErrPhone"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Select Gender <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" id="gender" name="gender">
                                <option selected>Select One</option>
                                <option value="male" @selected($lender->gender == 'male')>Male</option>
                                <option value="female" @selected($lender->gender == 'female')>Female</option>
                            </select>
                            <div class="text-danger error-msg" id="editErrGender"></div>
                        </div>
                    </div>
                   <div class="col-md-6">
                        <label for="profile" class="form-label">Profile <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="profile" id="profile">
                        @if($lender->profile)
                            <img src="{{ asset('storage/' . $lender->profile) }}"
                            alt="{{ $lender->name }}"
                            id="currentProfileImg"
                            width="80" height="80"
                            class="rounded border object-fit-cover d-block">
                        @else
                            <img src="" alt="" id="currentProfileImg" width="80" height="80" class="rounded border object-fit-cover d-none">
                        @endif
                        <div class="text-danger error-msg" id="editErrProfile"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="6">{{ $lender->notes }}</textarea>
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
                url: "{{ route('lenders.update', $lender->id) }}",
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
