@extends('layouts.dashboard.app')

@section('content')
<div class="d-flex align-items-center">
    <a href="{{route('user')}}">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mdi mdi-menu cliclef mr-3">
        <rect width="32" height="32" rx="16" fill="#E2E8ED" />
        <path
            d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
            fill="black" />
    </svg>
    </a>
    @isset($user)
        <h4 class="page-title">UPDATE ADMIN</h4>
    @else
        <h4 class="page-title">NEW ADMIN</h4>
    @endisset
</div>
    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST" action="{{ isset($user) ? route('user.update') : route('user.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input value="{{  $user->firstname ?? old('firstname') }}" type="text"
                                           name="firstname" id="firstname"
                                           class="form-control  @error('firstname') is-invalid @enderror"
                                           placeholder="Enter first name"
                                    >
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
                                    <input value="{{  $user->lastname ?? old('lastname') }}"
                                           type="text" name="lastname" id="lastname"
                                           class="form-control  @error('lastname') is-invalid @enderror"
                                           placeholder="Enter last name"
                                    >
                                    @error('lastname')
                                    <span class="text-danger" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="hidden" name="id" value="{{ $user->id ?? '' }}">
                                    <label for="usertype" class="form-label">Type</label>
                                    <select name="usertype"
                                            class="form-select  @error('usertype') is-invalid @enderror"
                                            id="usertype">
                                        <option selected disabled>Choose</option>
                                        <option
                                            {{ ( isset($user) ? ($user->usertype == "Admin" ? 'Selected' : '') : '' ) ?? (old(usertype) == "Admin" ? 'selected': '' ) }}  value="Admin">
                                            Admin
                                        </option>
                                        <option
                                            {{ ( isset($user) ? ($user->usertype == "User" ? 'Selected' : '') : '' ) ?? (old(usertype) == "User" ? 'selected': '' ) }} value="User">
                                            User
                                        </option>

                                    </select>
                                    @error('usertype')
                                    <span class="text-danger" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>


                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input value="{{  $user->email ?? old('email') }}"
                                           type="email" id="email" name="email"
                                           class="form-control  @error('email') is-invalid @enderror"
                                           placeholder="Enter email"
                                    >
                                    @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" autocomplete="false" name="password"
                                           id="password"
                                           class="form-control  @error('password') is-invalid @enderror"
                                           autocomplete="false"
                                           placeholder="Enter password"
                                        {{ isset($user) ? '' : 'required' }}
                                    >
                                    @error('password')
                                    <span class="text-danger" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('user')}}" type="submit"
                                   class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                @isset($user)
                                    <button type="submit" class="btn _btn-primary float-end">UPDATE ADMIN</button>
                                @else
                                    <button type="submit" class="btn _btn-primary float-end">ADD ADMIN</button>
                                @endisset

                            </div>
                        </div>

                    </form>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->


    </div>


@endsection
