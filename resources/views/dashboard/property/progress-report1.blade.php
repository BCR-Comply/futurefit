@extends('layouts.dashboard.app')
@section('content')
    <style>
        .mybody {
            background-color: #fff !important;
        }

        .f20 {
            font-size: 20px;
        }

        .f16 {
            font-size: 16px;
        }

        .brright {
            border-right: 1px solid #1A47A3;
        }

        .bg-grays {
            border: 0.5px solid #1A47A3 !important;
            background-color: #fff !important;
            border-radius: 6px;
        }
        .bg-grasy1 {
            background: #fff;
            border: 1px solid lightgray;
        }

        .cm {
            margin-top: 16px !important;
            page-break-inside: avoid !important;
        }
        .main-header {
            font-size: 22px !important;
        }
        .main-header-date {
            color: gray;
            font-weight:500;
        }
        .main-logo {
            width: 100px;
        }
        .f14 {
            font-size: 14px;
        }
        .f12 {
            font-size: 12px;
        }
        .bg-grasy h4 {
            font-size: 12px !important;
        }
        .footer-sign {
            height: 120px;
            width:160px;
        }
        .text-gray {
            color: gray;
        }
        h5 {
            font-size: 12px;
            margin: 0 0 4px;
        }
        .lead {
            font-size: 14px !important;
        }
        .f12 {
            font-size: 12px !important;
        }
    </style>
    <div class="col-md-12 mt-3 d-flex justify-content-start">
        <a href="{{ url()->previous() }}">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="mdi mdi-menu cliclef mr-3">
                <rect width="32" height="32" rx="16" fill="#E2E8ED" />
                <path
                    d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
                    fill="black" />
            </svg>
        </a>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body mybody">
                    <div class="d-flex justify-content-between" style="font-family: Arial">
                        <div style="color: #1A47A3 !important;">
                            <div class="d-flex align-items-end">
                                <h4 class="main-header my-0">{{ $data['report_name'] }}</h4>

                                @if ($data['report_type'])
                                    <div class="lead ml-2">({{ $data['report_type'] }})</div>
                                @endif
                            </div>
                            <h6 class="main-header-date my-0" style="margin-top: 2px !important;">{{ date('d/m/Y', strtotime($data['date_inspected'])) }}</h6>
                        </div>

                        <div>
                            <img src="{{ asset('assets/images/new_logo.svg') }}" class="main-logo img-fluid">
                        </div>
                    </div>
                    <div style="border: 1px solid #e0e9fc;">

                    </div>
                    <div class="row mt-1 mb-1">
                        <div class="col-3 d-grid brright">
                            <span class="f14 text-black"><b>Client: </b></span>
                            <span class="f12">{{ $data['client_name'] }}</span>
                        </div>
                        <div class="col-9 d-grid">
                            <span class="f14 text-black"><b>Address: </b></span>
                            <span
                                class="f12">{{ $data['address'] }}</span>
                        </div>
                    </div>
                    <div style="border: 1px solid #e0e9fc;">

                    </div>
                    <div class="col-12 mt-2 py-1 px-1 bg-grasy">
                        <h4 class="text-black mb-1 mt-0" style="margin: 0 0 10px !important;">Inspection Photos</h4>
                        <div>
                            @php
                                $sum = 0;
                                for ($i = 1; $i < 13; $i++) {
                                    if (isset($data['photo' . $i]) && trim($data['photo' . $i]) != '') {
                                        $sum++;
                                    }
                                }
                            @endphp

                            <div class="row bg-messi mx-0 @if ($sum == 0) d-none @endif">
                                @for ($i = 1; $i < 13; $i++)
                                    @if (isset($data['photo' . $i]) && trim($data['photo' . $i]) != '')
                                        <div class="col-sm-12 col-md-4 col-lg-4 py-0 px-0 d-flex justify-content-start"
                                            style="max-width:fit-content;">
                                            <img class="me-1 mb-1 img-fluid"
                                                style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;"
                                                src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['photo' . $i]) }}">
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="mt-2 mb-1 @if ($sum == 0) d-none @endif" style="border: 1px solid #e0e9fc;">

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="text-black mb-0 mt-0">Notes</h4>
                                <span class="m-0 f12">{{ $data['note'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 px-1 py-1 d-flex justify-content-between bg-grasy" style="page-break-inside: avoid !important;">
                        <div class="col-md-6 d-flex" style="justify-content: start;">
                            <div class="">
                                <div class="d-flex">
                                    <h4 class="text-black my-1">Date: </h4>
                                    <h4 class="ml-1 my-1 text-gray">
                                        {{ date('d/m/Y', strtotime($data['date_inspected'])) }}</h4>
                                </div>
                                <div class="d-flex">
                                    <h4 class="text-black my-0">Signed: </h4>
                                    <h4 class="ml-1 my-0 text-black">{{ $data['surveyed_by'] }}</h4>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6" style="justify-content: end;">
                            @if ($data['signature'])
                                <img class="footer-sign bg-grasy1 img-fluid bg-white float-end"
                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_signature/' . $data['signature']) }}"
                                    width="200" >
                            @endif
                        </div>
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
@endsection
