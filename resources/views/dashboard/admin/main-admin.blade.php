@extends('layouts.dashboard.app')

@section('content')
    <style>
        .change-profile {
            background-color: #fff;
            color: #1A47A3;
            border: 2px solid #1A47A3;
            border-radius: 36px;
            padding: 8px 20px;
            font-weight: 600;
            cursor: pointer;
        }
        .form-check-input{
            margin-right: 6px;
        }
        .form-check-input:checked{
            background-color: #1A47A3;
            border-color: #1A47A3;
        }
        .remove-profile {
            background-color: #fff;
            color: #df3e5f;
            border: 2px solid #df3e5f;
            border-radius: 36px;
            padding: 8px 20px;
            font-weight: 600;
            cursor: pointer;
        }

        button.btn._btn-primary.float-end {
            background-color: #1A47A3 !important;
            color: #fff !important;
            border: 1px solid #1A47A3 !important;
            border-radius: 36px;
            padding: 8px 28px;
            font-weight: 600;
        }

        a.btn.btn-secondary.px-2.float-end.ml-1 {
            background-color: #fff;
            color: #1A47A3;
            border: 1px solid #1A47A3;
            border-radius: 36px;
            padding: 8px 28px;
            font-weight: 600;
        }
    </style>
    <h4 class="page-title">My Profile</h4>

    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin-update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-xs-6 col-sm-6">
                                <label for="profile_img">Profile Photo</label>
                                <div class="col-md-12 mt-2 mb-2 d-flex justify-content-center">
                                  @if($user->profile_img == null)
                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" id="img-prev" class="rounded-circle" style="height: 200px;width: 200px;">
                                  @else
                                    <img src="{{ asset('assets/images/admin/'.$user->profile_img) }}" alt="user-image" id="img-prev" class="rounded-circle" style="height: 200px;width: 200px;">
                                  @endif
                                </div>
                                <div class="col-md-12 mt-2 mb-2 d-flex justify-content-around">
                                  <input type="hidden" name="profile_img_filename" id="profile_img_filename" value="{{$user->profile_img}}">
                                  <input type="file" name="profile_img" id="profile_img" style="display: none;">
                                  <label for="profile_img" class="change-profile">Change</label>
                                  <a href="#" class="remove-profile">Remove</a>
                                </div>
                                
                              </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input value="{{ $user->firstname ?? old('firstname') }}" type="text"
                                                name="firstname" id="firstname"
                                                class="form-control  @error('firstname') is-invalid @enderror"
                                                placeholder="Enter first name">
                                            @error('firstname')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Last Name</label>
                                            <input value="{{ $user->lastname ?? old('lastname') }}" type="text"
                                                name="lastname" id="lastname"
                                                class="form-control  @error('lastname') is-invalid @enderror"
                                                placeholder="Enter last name">
                                            @error('lastname')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                </div>

                                <div class="row ">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input value="{{ $user->email ?? old('email') }}" type="email" id="email"
                                                 class="form-control  @error('email') is-invalid @enderror"
                                                placeholder="Enter email" readonly>
                                            @error('email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" autocomplete="false" name="password" id="password"
                                                class="form-control password  @error('password') is-invalid @enderror"
                                                autocomplete="false" placeholder="Enter password"
                                                 readonly>
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-5">
                                    <input type="hidden" name="change_pass" value="0">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input change_pass" name="change_pass" id="change_pass" value="1">Change Password
                                      </label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <a href="{{ route('dashboard') }}" type="submit"
                                            class="btn btn-secondary px-2 float-end ml-1">Cancel</a>
                                        <button type="submit" class="btn _btn-primary float-end">Update Profile</button>

                                    </div>
                                </div>
                            </div>
                            
                        </div>


                    </form>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->


    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
       $(document).ready(function() {
        $(document).on('click','.change_pass',function(){
            var isChecked = $(this).is(':checked');
            if (isChecked) {
                $('.password').removeAttr('readonly');
            } else {
                $('.password').attr('readonly','readonly');
            }
        });
        $('#profile_img').change(function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img-prev').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        $('.remove-profile').click(function(e) {
            e.preventDefault();
            $('#img-prev').attr('src', '{{ asset('assets/images/users/avatar-1.jpg') }}');
            $('#profile_img').val('');
            $('#profile_img_filename').val('');
        });

        $('.change-profile').click(function(e) {
            e.preventDefault();
            $('#profile_img').click();
        });
    });
    </script>
@endsection
