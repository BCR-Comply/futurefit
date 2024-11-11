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
    .remove-profile {
        background-color: #fff;
        color: #df3e5f;
        border: 2px solid #df3e5f;
        border-radius: 36px;
        padding: 8px 20px;
        font-weight: 600;
        cursor: pointer;
    }
    @media (min-width: 992px) {
        .b-right {
            border-right: 1px solid #000000;
        }
    }
    .link-input,.link-input::before,.link-input::after,.link-input:focus-visible {
        border: 0 !important;
        outline: unset !important;
        color: #6C757D !important;
        width: 95%;
        cursor: pointer !important;
    }
</style>
<h4 class="page-title">APPLICATION CONFIG</h4>

<div class="row">
    <div class="col-12">
        <div class="card _shadow-1">
            <div class="card-body">
                <form method="POST" action="{{ route('config.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-xs-6 col-sm-6">
                            <label for="company_logo">Company Logo</label>
                            <div class="col-md-12 mt-2 mb-2 d-flex justify-content-center">
                              @if($config->company_logo == null)
                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" id="img-prev" class="rounded-circle" style="height: 200px;width: 200px;">
                              @else
                                <img src="{{ asset('assets/images/company_logo/'.$config->company_logo) }}" alt="user-image" id="img-prev" class="rounded-circle" style="height: 200px;width: 200px;">
                              @endif
                            </div>
                            <div class="col-md-12 mt-2 mb-2 d-flex justify-content-around">
                              <input type="hidden" name="company_logo_filename" id="company_logo_filename" value="{{ $config->company_logo }}">
                              <input type="file" name="company_logo" id="company_logo" style="display: none;" accept="image/*">
                              <label for="company_logo" class="change-profile">Change</label>
                              <a href="#" class="remove-profile">Remove</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Company Name*</label>
                                        <input value="{{  $config->name ?? old('name') }}" type="text" name="name"
                                            id="name" class="form-control  @error('name') is-invalid @enderror"
                                            placeholder="Enter Company Name">
                                        @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email*</label>
                                        <input value="{{  $config->email ?? old('email') }}" type="email" name="email"
                                            id="email" class="form-control  @error('email') is-invalid @enderror"
                                            placeholder="Enter Email">
                                        @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone*</label>
                                        <input value="{{  $config->phone ?? old('phone') }}" type="tel" name="phone"
                                            id="phone" class="form-control  @error('phone') is-invalid @enderror"
                                            pattern="^\d+$"
                                            placeholder="Enter Phone Number">
                                        @error('phone')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="mobile" class="form-label">Mobile</label>
                                        <input value="{{  $config->mobile ?? old('mobile') }}" type="tel" name="mobile"
                                            id="mobile" class="form-control  @error('mobile') is-invalid @enderror"
                                            pattern="^\d{10,15}$"
                                            placeholder="Enter Mobile Number">
                                        @error('mobile')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="website" class="form-label">Website</label>
                                        <input value="{{  $config->website ?? old('website') }}" type="tel" name="website"
                                            id="website" class="form-control  @error('website') is-invalid @enderror"
                                            placeholder="Enter Website">
                                        @error('website')
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
                                        <label for="android_path" class="form-label">Android Login Path</label>
                                        <input value="{{  $config->android_path ?? old('android_path') }}" type="text" name="android_path"
                                            id="android_path" class="form-control  @error('android_path') is-invalid @enderror"
                                            placeholder="Enter Android Login Path">
                                        @error('android_path')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="ios_path" class="form-label">IOS Login Path</label>
                                        <input value="{{  $config->ios_path ?? old('ios_path') }}" type="text" name="ios_path"
                                            id="ios_path" class="form-control  @error('ios_path') is-invalid @enderror"
                                            placeholder="Enter IOS Login Path">
                                        @error('ios_path')
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
                                        <label for="android_lite_path" class="form-label">Android Lite Login Path</label>
                                        <input value="{{  $config->android_lite_path ?? old('android_lite_path') }}" type="text" name="android_lite_path"
                                            id="android_lite_path" class="form-control  @error('android_lite_path') is-invalid @enderror"
                                            placeholder="Enter Android Login Path">
                                        @error('android_lite_path')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="ios_lite_path" class="form-label">IOS Lite Login Path</label>
                                        <input value="{{  $config->ios_lite_path ?? old('ios_lite_path') }}" type="text" name="ios_lite_path"
                                            id="ios_lite_path" class="form-control  @error('ios_lite_path') is-invalid @enderror"
                                            placeholder="Enter IOS Login Path">
                                        @error('ios_lite_path')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-lg-12">
                                    <label for="name" class="form-label">Social Media</label>
                                </div>
                                <div class="col-lg-6 b-right">
                                    <div class="d-flex align-items-center">
                                        <svg class="m-1 me-2" width="35" height="35" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.8 0H14.2C17.4 0 20 2.6 20 5.8V14.2C20 15.7383 19.3889 17.2135 18.3012 18.3012C17.2135 19.3889 15.7383 20 14.2 20H5.8C2.6 20 0 17.4 0 14.2V5.8C0 4.26174 0.61107 2.78649 1.69878 1.69878C2.78649 0.61107 4.26174 0 5.8 0ZM5.6 2C4.64522 2 3.72955 2.37928 3.05442 3.05442C2.37928 3.72955 2 4.64522 2 5.6V14.4C2 16.39 3.61 18 5.6 18H14.4C15.3548 18 16.2705 17.6207 16.9456 16.9456C17.6207 16.2705 18 15.3548 18 14.4V5.6C18 3.61 16.39 2 14.4 2H5.6ZM15.25 3.5C15.5815 3.5 15.8995 3.6317 16.1339 3.86612C16.3683 4.10054 16.5 4.41848 16.5 4.75C16.5 5.08152 16.3683 5.39946 16.1339 5.63388C15.8995 5.8683 15.5815 6 15.25 6C14.9185 6 14.6005 5.8683 14.3661 5.63388C14.1317 5.39946 14 5.08152 14 4.75C14 4.41848 14.1317 4.10054 14.3661 3.86612C14.6005 3.6317 14.9185 3.5 15.25 3.5ZM10 5C11.3261 5 12.5979 5.52678 13.5355 6.46447C14.4732 7.40215 15 8.67392 15 10C15 11.3261 14.4732 12.5979 13.5355 13.5355C12.5979 14.4732 11.3261 15 10 15C8.67392 15 7.40215 14.4732 6.46447 13.5355C5.52678 12.5979 5 11.3261 5 10C5 8.67392 5.52678 7.40215 6.46447 6.46447C7.40215 5.52678 8.67392 5 10 5ZM10 7C9.20435 7 8.44129 7.31607 7.87868 7.87868C7.31607 8.44129 7 9.20435 7 10C7 10.7956 7.31607 11.5587 7.87868 12.1213C8.44129 12.6839 9.20435 13 10 13C10.7956 13 11.5587 12.6839 12.1213 12.1213C12.6839 11.5587 13 10.7956 13 10C13 9.20435 12.6839 8.44129 12.1213 7.87868C11.5587 7.31607 10.7956 7 10 7Z" fill="#1A47A3"/>
                                        </svg>
                                        <div class="d-flex flex-wrap" style="width: 100%;">
                                            <label for="name" class="form-label mb-0 col-12">Instagram</label>
                                            <input type="text" class="link-input elbtn" name="instagram_link" value="{{ $config->instagram_link }}" data-name="instagram_link" data-lname="Instagram" data-bs-toggle="modal" data-bs-target="#editlinkModal" placeholder="Add Link of Instagram" readonly>
                                        </div>
                                        <svg role="button" class="me-1 elbtn" data-name="instagram_link" data-lname="Instagram" data-bs-toggle="modal" data-bs-target="#editlinkModal" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#1A47A3"/>
                                            <path d="M6.99512 15.2828V16.6933C6.99512 16.7749 7.02752 16.8531 7.0852 16.9108C7.14288 16.9685 7.22112 17.0009 7.30269 17.0009H8.7163C8.79771 17.0009 8.8758 16.9686 8.93344 16.9111L14.7453 11.0992L12.8999 9.25372L7.08554 15.0656C7.02782 15.1232 6.9953 15.2013 6.99512 15.2828ZM13.6615 8.49155L15.5069 10.337L16.405 9.43888C16.5203 9.32352 16.5851 9.16708 16.5851 9.00397C16.5851 8.84085 16.5203 8.68442 16.405 8.56906L15.43 7.59344C15.3146 7.47811 15.1582 7.41333 14.9951 7.41333C14.832 7.41333 14.6755 7.47811 14.5602 7.59344L13.6615 8.49155Z" fill="white"/>
                                        </svg>
                                        <svg role="button" class="dlbtn" data-name="instagram_link" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#D5244C"/>
                                            <path d="M9.1875 17.0625C8.87812 17.0625 8.61337 16.9524 8.39325 16.7323C8.17312 16.5122 8.06287 16.2472 8.0625 15.9375V8.625H7.5V7.5H10.3125V6.9375H13.6875V7.5H16.5V8.625H15.9375V15.9375C15.9375 16.2469 15.8274 16.5118 15.6073 16.7323C15.3872 16.9528 15.1223 17.0629 14.8125 17.0625H9.1875ZM10.3125 14.8125H11.4375V9.75H10.3125V14.8125ZM12.5625 14.8125H13.6875V9.75H12.5625V14.8125Z" fill="white"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <svg class="m-1 me-2" width="35" height="35" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 10C2.00014 8.46045 2.44451 6.95364 3.27979 5.66038C4.11506 4.36712 5.30576 3.34234 6.70901 2.70901C8.11225 2.07568 9.66844 1.8607 11.1908 2.08987C12.7132 2.31904 14.1372 2.98262 15.2918 4.00099C16.4464 5.01936 17.2826 6.34926 17.7002 7.83111C18.1177 9.31296 18.0988 10.8838 17.6457 12.3552C17.1926 13.8265 16.3246 15.1359 15.1458 16.1262C13.967 17.1165 12.5275 17.7456 11 17.938V12H13C13.2652 12 13.5196 11.8946 13.7071 11.7071C13.8946 11.5196 14 11.2652 14 11C14 10.7348 13.8946 10.4804 13.7071 10.2929C13.5196 10.1054 13.2652 10 13 10H11V8C11 7.73478 11.1054 7.48043 11.2929 7.29289C11.4804 7.10536 11.7348 7 12 7H12.5C12.7652 7 13.0196 6.89464 13.2071 6.70711C13.3946 6.51957 13.5 6.26522 13.5 6C13.5 5.73478 13.3946 5.48043 13.2071 5.29289C13.0196 5.10536 12.7652 5 12.5 5H12C11.2044 5 10.4413 5.31607 9.87868 5.87868C9.31607 6.44129 9 7.20435 9 8V10H7C6.73478 10 6.48043 10.1054 6.29289 10.2929C6.10536 10.4804 6 10.7348 6 11C6 11.2652 6.10536 11.5196 6.29289 11.7071C6.48043 11.8946 6.73478 12 7 12H9V17.938C7.0667 17.6942 5.28882 16.7533 4 15.2917C2.71119 13.8302 2.00003 11.9486 2 10ZM10 20C15.523 20 20 15.523 20 10C20 4.477 15.523 0 10 0C4.477 0 0 4.477 0 10C0 15.523 4.477 20 10 20Z" fill="#1A47A3"/>
                                        </svg>
                                        <div class="d-flex flex-wrap" style="width: 100%;">
                                            <label for="name" class="form-label mb-0 col-12">Facebook</label>
                                            <input type="text" class="link-input elbtn" name="facebook_link" value="{{ $config->facebook_link }}" data-name="facebook_link" data-lname="Facebook" data-bs-toggle="modal" data-bs-target="#editlinkModal" placeholder="Add Link of Facebook" readonly>
                                        </div>
                                        <svg role="button" class="me-1 elbtn" data-name="facebook_link" data-lname="Facebook" data-bs-toggle="modal" data-bs-target="#editlinkModal" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#1A47A3"/>
                                            <path d="M6.99512 15.2828V16.6933C6.99512 16.7749 7.02752 16.8531 7.0852 16.9108C7.14288 16.9685 7.22112 17.0009 7.30269 17.0009H8.7163C8.79771 17.0009 8.8758 16.9686 8.93344 16.9111L14.7453 11.0992L12.8999 9.25372L7.08554 15.0656C7.02782 15.1232 6.9953 15.2013 6.99512 15.2828ZM13.6615 8.49155L15.5069 10.337L16.405 9.43888C16.5203 9.32352 16.5851 9.16708 16.5851 9.00397C16.5851 8.84085 16.5203 8.68442 16.405 8.56906L15.43 7.59344C15.3146 7.47811 15.1582 7.41333 14.9951 7.41333C14.832 7.41333 14.6755 7.47811 14.5602 7.59344L13.6615 8.49155Z" fill="white"/>
                                        </svg>
                                        <svg role="button" class="dlbtn" data-name="facebook_link" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#D5244C"/>
                                            <path d="M9.1875 17.0625C8.87812 17.0625 8.61337 16.9524 8.39325 16.7323C8.17312 16.5122 8.06287 16.2472 8.0625 15.9375V8.625H7.5V7.5H10.3125V6.9375H13.6875V7.5H16.5V8.625H15.9375V15.9375C15.9375 16.2469 15.8274 16.5118 15.6073 16.7323C15.3872 16.9528 15.1223 17.0629 14.8125 17.0625H9.1875ZM10.3125 14.8125H11.4375V9.75H10.3125V14.8125ZM12.5625 14.8125H13.6875V9.75H12.5625V14.8125Z" fill="white"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-lg-6 b-right">
                                    <div class="d-flex align-items-center">
                                        <svg class="m-1 me-2" width="35" height="35" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 0C15.7956 0 16.5587 0.316071 17.1213 0.87868C17.6839 1.44129 18 2.20435 18 3V15C18 15.7956 17.6839 16.5587 17.1213 17.1213C16.5587 17.6839 15.7956 18 15 18H3C2.20435 18 1.44129 17.6839 0.87868 17.1213C0.316071 16.5587 0 15.7956 0 15V3C0 2.20435 0.316071 1.44129 0.87868 0.87868C1.44129 0.316071 2.20435 0 3 0H15ZM15 2H3C2.73478 2 2.48043 2.10536 2.29289 2.29289C2.10536 2.48043 2 2.73478 2 3V15C2 15.2652 2.10536 15.5196 2.29289 15.7071C2.48043 15.8946 2.73478 16 3 16H15C15.2652 16 15.5196 15.8946 15.7071 15.7071C15.8946 15.5196 16 15.2652 16 15V3C16 2.73478 15.8946 2.48043 15.7071 2.29289C15.5196 2.10536 15.2652 2 15 2ZM5 7C5.24493 7.00003 5.48134 7.08996 5.66437 7.25272C5.84741 7.41547 5.96434 7.63975 5.993 7.883L6 8V13C5.99972 13.2549 5.90212 13.5 5.72715 13.6854C5.55218 13.8707 5.31305 13.9822 5.05861 13.9972C4.80416 14.0121 4.55362 13.9293 4.35817 13.7657C4.16271 13.6021 4.0371 13.3701 4.007 13.117L4 13V8C4 7.73478 4.10536 7.48043 4.29289 7.29289C4.48043 7.10536 4.73478 7 5 7ZM8 6C8.23419 5.99996 8.46097 6.08213 8.6408 6.23216C8.82062 6.3822 8.94208 6.59059 8.984 6.821C9.18523 6.70431 9.39327 6.59979 9.607 6.508C10.274 6.223 11.273 6.066 12.175 6.349C12.648 6.499 13.123 6.779 13.475 7.256C13.79 7.681 13.96 8.198 13.994 8.779L14 9V13C13.9997 13.2549 13.9021 13.5 13.7272 13.6854C13.5522 13.8707 13.313 13.9822 13.0586 13.9972C12.8042 14.0121 12.5536 13.9293 12.3582 13.7657C12.1627 13.6021 12.0371 13.3701 12.007 13.117L12 13V9C12 8.67 11.92 8.516 11.868 8.445C11.7934 8.35215 11.6905 8.28615 11.575 8.257C11.227 8.147 10.726 8.205 10.393 8.347C9.893 8.561 9.435 8.897 9.123 9.208L9 9.34V13C8.99972 13.2549 8.90212 13.5 8.72715 13.6854C8.55218 13.8707 8.31305 13.9822 8.05861 13.9972C7.80416 14.0121 7.55362 13.9293 7.35817 13.7657C7.16271 13.6021 7.0371 13.3701 7.007 13.117L7 13V7C7 6.73478 7.10536 6.48043 7.29289 6.29289C7.48043 6.10536 7.73478 6 8 6ZM5 4C5.26522 4 5.51957 4.10536 5.70711 4.29289C5.89464 4.48043 6 4.73478 6 5C6 5.26522 5.89464 5.51957 5.70711 5.70711C5.51957 5.89464 5.26522 6 5 6C4.73478 6 4.48043 5.89464 4.29289 5.70711C4.10536 5.51957 4 5.26522 4 5C4 4.73478 4.10536 4.48043 4.29289 4.29289C4.48043 4.10536 4.73478 4 5 4Z" fill="#1A47A3"/>
                                        </svg>
                                        <div class="d-flex flex-wrap" style="width: 100%;">
                                            <label for="name" class="form-label mb-0 col-12">LinkedIn</label>
                                            <input type="text" class="link-input elbtn" name="linkedin_link" value="{{ $config->linkedin_link }}" data-name="linkedin_link" data-lname="LinkedIn" data-bs-toggle="modal" data-bs-target="#editlinkModal" placeholder="Add Link of LinkedIn" readonly>
                                        </div>
                                        <svg role="button" class="me-1 elbtn" data-name="linkedin_link" data-lname="LinkedIn" data-bs-toggle="modal" data-bs-target="#editlinkModal" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#1A47A3"/>
                                            <path d="M6.99512 15.2828V16.6933C6.99512 16.7749 7.02752 16.8531 7.0852 16.9108C7.14288 16.9685 7.22112 17.0009 7.30269 17.0009H8.7163C8.79771 17.0009 8.8758 16.9686 8.93344 16.9111L14.7453 11.0992L12.8999 9.25372L7.08554 15.0656C7.02782 15.1232 6.9953 15.2013 6.99512 15.2828ZM13.6615 8.49155L15.5069 10.337L16.405 9.43888C16.5203 9.32352 16.5851 9.16708 16.5851 9.00397C16.5851 8.84085 16.5203 8.68442 16.405 8.56906L15.43 7.59344C15.3146 7.47811 15.1582 7.41333 14.9951 7.41333C14.832 7.41333 14.6755 7.47811 14.5602 7.59344L13.6615 8.49155Z" fill="white"/>
                                        </svg>
                                        <svg role="button" class="dlbtn" data-name="linkedin_link" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#D5244C"/>
                                            <path d="M9.1875 17.0625C8.87812 17.0625 8.61337 16.9524 8.39325 16.7323C8.17312 16.5122 8.06287 16.2472 8.0625 15.9375V8.625H7.5V7.5H10.3125V6.9375H13.6875V7.5H16.5V8.625H15.9375V15.9375C15.9375 16.2469 15.8274 16.5118 15.6073 16.7323C15.3872 16.9528 15.1223 17.0629 14.8125 17.0625H9.1875ZM10.3125 14.8125H11.4375V9.75H10.3125V14.8125ZM12.5625 14.8125H13.6875V9.75H12.5625V14.8125Z" fill="white"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <svg class="m-1 me-2" width="35" height="35" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19 6V14C19 15.3261 18.4732 16.5979 17.5355 17.5355C16.5979 18.4732 15.3261 19 14 19H6C4.67392 19 3.40215 18.4732 2.46447 17.5355C1.52678 16.5979 1 15.3261 1 14V6C1 4.67392 1.52678 3.40215 2.46447 2.46447C3.40215 1.52678 4.67392 1 6 1H14C15.3261 1 16.5979 1.52678 17.5355 2.46447C18.4732 3.40215 19 4.67392 19 6Z" stroke="#1A47A3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8 10C7.40666 10 6.82664 10.1759 6.33329 10.5056C5.83994 10.8352 5.45543 11.3038 5.22836 11.8519C5.0013 12.4001 4.94189 13.0033 5.05765 13.5853C5.1734 14.1672 5.45912 14.7018 5.87868 15.1213C6.29824 15.5409 6.83279 15.8266 7.41473 15.9424C7.99667 16.0581 8.59987 15.9987 9.14805 15.7716C9.69623 15.5446 10.1648 15.1601 10.4944 14.6667C10.8241 14.1734 11 13.5933 11 13V4C11.333 5 12.6 7 15 7" stroke="#1A47A3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div class="d-flex flex-wrap" style="width: 100%;">
                                            <label for="name" class="form-label mb-0 col-12">TikTok</label>
                                            <input type="text" class="link-input elbtn" name="tiktok_link" value="{{ $config->tiktok_link }}" data-name="tiktok_link" data-lname="TikTok" data-bs-toggle="modal" data-bs-target="#editlinkModal" placeholder="Add Link of TikTok" readonly>
                                        </div>
                                        <svg role="button" class="me-1 elbtn" data-name="tiktok_link" data-lname="TikTok" data-bs-toggle="modal" data-bs-target="#editlinkModal" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#1A47A3"/>
                                            <path d="M6.99512 15.2828V16.6933C6.99512 16.7749 7.02752 16.8531 7.0852 16.9108C7.14288 16.9685 7.22112 17.0009 7.30269 17.0009H8.7163C8.79771 17.0009 8.8758 16.9686 8.93344 16.9111L14.7453 11.0992L12.8999 9.25372L7.08554 15.0656C7.02782 15.1232 6.9953 15.2013 6.99512 15.2828ZM13.6615 8.49155L15.5069 10.337L16.405 9.43888C16.5203 9.32352 16.5851 9.16708 16.5851 9.00397C16.5851 8.84085 16.5203 8.68442 16.405 8.56906L15.43 7.59344C15.3146 7.47811 15.1582 7.41333 14.9951 7.41333C14.832 7.41333 14.6755 7.47811 14.5602 7.59344L13.6615 8.49155Z" fill="white"/>
                                        </svg>
                                        <svg role="button" class="dlbtn" data-name="tiktok_link" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#D5244C"/>
                                            <path d="M9.1875 17.0625C8.87812 17.0625 8.61337 16.9524 8.39325 16.7323C8.17312 16.5122 8.06287 16.2472 8.0625 15.9375V8.625H7.5V7.5H10.3125V6.9375H13.6875V7.5H16.5V8.625H15.9375V15.9375C15.9375 16.2469 15.8274 16.5118 15.6073 16.7323C15.3872 16.9528 15.1223 17.0629 14.8125 17.0625H9.1875ZM10.3125 14.8125H11.4375V9.75H10.3125V14.8125ZM12.5625 14.8125H13.6875V9.75H12.5625V14.8125Z" fill="white"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-lg-6 b-right">
                                    <div class="d-flex align-items-center">
                                        <svg class="m-1 me-2" width="35" height="35" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 0C10.855 0 11.732 0.0220001 12.582 0.0580001L13.586 0.106L14.547 0.163L15.447 0.224L16.269 0.288C17.161 0.356278 18.0004 0.736947 18.6395 1.36304C19.2786 1.98913 19.6764 2.82054 19.763 3.711L19.803 4.136L19.878 5.046C19.948 5.989 20 7.017 20 8C20 8.983 19.948 10.011 19.878 10.954L19.803 11.864C19.79 12.01 19.777 12.151 19.763 12.289C19.6764 13.1796 19.2784 14.0112 18.6391 14.6373C17.9999 15.2634 17.1602 15.6439 16.268 15.712L15.448 15.775L14.548 15.837L13.586 15.894L12.582 15.942C11.7218 15.9794 10.861 15.9987 10 16C9.13902 15.9987 8.27817 15.9794 7.418 15.942L6.414 15.894L5.453 15.837L4.553 15.775L3.731 15.712C2.83895 15.6437 1.99955 15.2631 1.36047 14.637C0.721394 14.0109 0.323574 13.1795 0.237 12.289L0.197 11.864L0.122 10.954C0.0455376 9.97114 0.00484402 8.98582 0 8C0 7.017 0.052 5.989 0.122 5.046L0.197 4.136C0.21 3.99 0.223 3.849 0.237 3.711C0.323541 2.8207 0.721217 1.98942 1.36009 1.36334C1.99897 0.737271 2.83813 0.356503 3.73 0.288L4.551 0.224L5.451 0.163L6.413 0.106L7.417 0.0580001C8.2775 0.0206329 9.13869 0.00129529 10 0ZM10 2C9.175 2 8.326 2.022 7.5 2.056L6.522 2.103L5.583 2.158L4.701 2.218L3.893 2.281C3.46833 2.31113 3.06804 2.49065 2.76309 2.78773C2.45814 3.08481 2.26822 3.48026 2.227 3.904C2.11 5.113 2 6.618 2 8C2 9.382 2.11 10.887 2.227 12.096C2.312 12.968 3.004 13.646 3.893 13.719L4.701 13.781L5.583 13.841L6.522 13.897L7.5 13.944C8.326 13.978 9.175 14 10 14C10.825 14 11.674 13.978 12.5 13.944L13.478 13.897L14.417 13.842L15.299 13.782L16.107 13.719C16.5317 13.6889 16.932 13.5094 17.2369 13.2123C17.5419 12.9152 17.7318 12.5197 17.773 12.096C17.89 10.887 18 9.382 18 8C18 6.618 17.89 5.113 17.773 3.904C17.7318 3.48026 17.5419 3.08481 17.2369 2.78773C16.932 2.49065 16.5317 2.31113 16.107 2.281L15.299 2.219L14.417 2.159L13.478 2.103L12.5 2.056C11.6671 2.02017 10.8336 2.0015 10 2ZM8 5.575C7.99994 5.47726 8.02375 5.38099 8.06937 5.29455C8.11498 5.20812 8.18103 5.13413 8.26175 5.07903C8.34248 5.02394 8.43544 4.98939 8.53256 4.97841C8.62968 4.96742 8.72801 4.98033 8.819 5.016L8.9 5.056L13.1 7.48C13.1836 7.52826 13.2544 7.59599 13.3063 7.67744C13.3581 7.75889 13.3896 7.85165 13.3979 7.94785C13.4062 8.04405 13.3912 8.14084 13.3542 8.23C13.3171 8.31916 13.2591 8.39806 13.185 8.46L13.1 8.52L8.9 10.945C8.81536 10.994 8.72003 11.0216 8.62229 11.0253C8.52456 11.0291 8.4274 11.0089 8.33926 10.9665C8.25112 10.9241 8.17468 10.8608 8.1166 10.7821C8.05851 10.7034 8.02054 10.6117 8.006 10.515L8 10.425V5.575Z" fill="#1A47A3"/>
                                        </svg>
                                        <div class="d-flex flex-wrap" style="width: 100%;">
                                            <label for="name" class="form-label mb-0 col-12">YouTube</label>
                                            <input type="text" class="link-input elbtn" name="youtube_link" value="{{ $config->youtube_link }}" data-name="youtube_link" data-lname="YouTube" data-bs-toggle="modal" data-bs-target="#editlinkModal" placeholder="Add Link of YouTube" readonly>
                                        </div>
                                        <svg role="button" class="me-1 elbtn" data-name="youtube_link" data-lname="YouTube" data-bs-toggle="modal" data-bs-target="#editlinkModal" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#1A47A3"/>
                                            <path d="M6.99512 15.2828V16.6933C6.99512 16.7749 7.02752 16.8531 7.0852 16.9108C7.14288 16.9685 7.22112 17.0009 7.30269 17.0009H8.7163C8.79771 17.0009 8.8758 16.9686 8.93344 16.9111L14.7453 11.0992L12.8999 9.25372L7.08554 15.0656C7.02782 15.1232 6.9953 15.2013 6.99512 15.2828ZM13.6615 8.49155L15.5069 10.337L16.405 9.43888C16.5203 9.32352 16.5851 9.16708 16.5851 9.00397C16.5851 8.84085 16.5203 8.68442 16.405 8.56906L15.43 7.59344C15.3146 7.47811 15.1582 7.41333 14.9951 7.41333C14.832 7.41333 14.6755 7.47811 14.5602 7.59344L13.6615 8.49155Z" fill="white"/>
                                        </svg>
                                        <svg role="button" class="dlbtn" data-name="youtube_link" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#D5244C"/>
                                            <path d="M9.1875 17.0625C8.87812 17.0625 8.61337 16.9524 8.39325 16.7323C8.17312 16.5122 8.06287 16.2472 8.0625 15.9375V8.625H7.5V7.5H10.3125V6.9375H13.6875V7.5H16.5V8.625H15.9375V15.9375C15.9375 16.2469 15.8274 16.5118 15.6073 16.7323C15.3872 16.9528 15.1223 17.0629 14.8125 17.0625H9.1875ZM10.3125 14.8125H11.4375V9.75H10.3125V14.8125ZM12.5625 14.8125H13.6875V9.75H12.5625V14.8125Z" fill="white"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <svg class="m-1 me-2" width="35" height="35" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1755_18876)">
                                            <mask id="mask0_1755_18876" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">
                                            <path d="M0 0H14V14H0V0Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask0_1755_18876)">
                                            <path d="M11.025 0.655762H13.172L8.482 6.02976L14 13.3438H9.68L6.294 8.90876L2.424 13.3438H0.275L5.291 7.59376L0 0.656762H4.43L7.486 4.70976L11.025 0.655762ZM10.27 12.0558H11.46L3.78 1.87676H2.504L10.27 12.0558Z" fill="#1A47A3"/>
                                            </g>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_1755_18876">
                                            <rect width="14" height="14" fill="white"/>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                        <div class="d-flex flex-wrap" style="width: 100%;">
                                            <label for="name" class="form-label mb-0 col-12">X (Twitter)</label>
                                            <input type="text" class="link-input elbtn" name="x_link" value="{{ $config->x_link }}" data-name="x_link" data-lname="X (Twitter)" data-bs-toggle="modal" data-bs-target="#editlinkModal" placeholder="Add Link of X (Twitter)" readonly>
                                        </div>
                                        <svg role="button" class="me-1 elbtn" data-name="x_link" data-lname="X (Twitter)" data-bs-toggle="modal" data-bs-target="#editlinkModal" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#1A47A3"/>
                                            <path d="M6.99512 15.2828V16.6933C6.99512 16.7749 7.02752 16.8531 7.0852 16.9108C7.14288 16.9685 7.22112 17.0009 7.30269 17.0009H8.7163C8.79771 17.0009 8.8758 16.9686 8.93344 16.9111L14.7453 11.0992L12.8999 9.25372L7.08554 15.0656C7.02782 15.1232 6.9953 15.2013 6.99512 15.2828ZM13.6615 8.49155L15.5069 10.337L16.405 9.43888C16.5203 9.32352 16.5851 9.16708 16.5851 9.00397C16.5851 8.84085 16.5203 8.68442 16.405 8.56906L15.43 7.59344C15.3146 7.47811 15.1582 7.41333 14.9951 7.41333C14.832 7.41333 14.6755 7.47811 14.5602 7.59344L13.6615 8.49155Z" fill="white"/>
                                        </svg>
                                        <svg role="button" class="dlbtn" data-name="x_link" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#D5244C"/>
                                            <path d="M9.1875 17.0625C8.87812 17.0625 8.61337 16.9524 8.39325 16.7323C8.17312 16.5122 8.06287 16.2472 8.0625 15.9375V8.625H7.5V7.5H10.3125V6.9375H13.6875V7.5H16.5V8.625H15.9375V15.9375C15.9375 16.2469 15.8274 16.5118 15.6073 16.7323C15.3872 16.9528 15.1223 17.0629 14.8125 17.0625H9.1875ZM10.3125 14.8125H11.4375V9.75H10.3125V14.8125ZM12.5625 14.8125H13.6875V9.75H12.5625V14.8125Z" fill="white"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn _btn-primary float-end">UPDATE CONFIG</button>
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
<!--Edit Link Modal -->
<div class="modal fade" id="editlinkModal" tabindex="-1" aria-labelledby="editlinkLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title" id="exampleModalLabel">Edit Link</h1>
                <svg class="modal-cls-btn" data-bs-dismiss="modal" aria-label="Close" width="18"
                    height="17" viewBox="0 0 18 17" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path id="Arrow Left" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.99335 14.6187C8.38758 15.0511 8.39331 15.7459 8.00006 16.1773C7.60954 16.6056 6.98129 16.611 6.58171 16.1727L0.29715 9.27933C-0.0956605 8.84846 -0.102425 8.15731 0.29715 7.71902L6.58171 0.825611C6.97453 0.394745 7.60682 0.389723 8.00006 0.821065C8.39059 1.24942 8.39192 1.94245 7.99335 2.37964L3.41431 7.4023L16.9975 7.4023C17.5512 7.4023 18 7.88916 18 8.49917C18 9.10496 17.5475 9.59605 16.9975 9.59605L3.41431 9.59605L7.99335 14.6187Z"
                        fill="#2A2D34" />
                </svg>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="link" class="form-label l-lable"></label>
                    <input value="" type="text" name="link" id="link" class="form-control" placeholder="Add Link">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="ulink-btn" data-name="" class="btn _btn-primary w-100 mt-0 mb-0">Update</button>
            </div>
        </div>
    </div>
</div>
<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 85px; right: 0;z-index:1;border:unset;">
    <div class="toast-header" style="background-color:#fee5e5;border-bottom:unset;border-radius:8px;">
      <strong class="mr-auto" style="color: #F10000;">Image Deleted Successfully</strong>
      <button type="button" class="close toast-cls" data-dismiss="toast" aria-label="Close" style="border: unset;background:unset;">
        <span aria-hidden="true" style="font-size: 18px;">&times;</span>
      </button>
    </div>
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
        $('#company_logo').change(function(e) {
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
            $('#company_logo').val('');
            $('#company_logo_filename').val('');
        });

        $('.change-profile').click(function(e) {
            e.preventDefault();
            $('#company_logo').click();
        });

        $('#editlinkModal').on('hidden.bs.modal', function() {
            $(this).find("input,textarea").val('').end().find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
        });

        $('.elbtn').click(function() {
            var name = $(this).attr('data-name');
            var lname = $(this).attr('data-lname');
            var value = $('input[name='+ name +']').val();

            $('.l-lable').html(lname);
            $('#link').val(value);
            $('#ulink-btn').attr('data-name',name);
        });

        $('#ulink-btn').click(function() {
            var val = $('#link').val();
            var name = $(this).attr('data-name');
            $('input[name='+ name +']').val(val);
            $('#editlinkModal').modal('hide');
        });

        $('.dlbtn').click(function() {
            var name = $(this).attr('data-name');
            $('input[name='+ name +']').val(null);
        });
    });
    </script>
@endsection
