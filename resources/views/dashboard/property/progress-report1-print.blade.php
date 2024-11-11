@extends('layouts.dashboard.print')
@section('content')
    <style>
        body {
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
        .lead {
            font-size: 14px !important;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="">
                <div class="">
                    <div class="d-flex justify-content-between" style="font-family: Arial">
                        <div style="color: #1A47A3 !important;">
                            <div class="d-flex align-items-end">
                                <h4 class="main-header my-0">{{ $data['report_name'] }}</h4>

                                @if ($data['report_type'])
                                    <div class="lead ml-2">({{ $data['report_type'] }})</div>
                                @endif
                            </div>
                            <h6 class="main-header-date my-0" style="margin-top: 1px !important;">{{ date('d/m/Y', strtotime($data['date_inspected'])) }}</h6>
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
                            <span class="f12">{{ $data['address'] }}</span>
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

                            <div class="bg-messi mx-0 @if ($sum == 0) d-none @endif">
                                <div class="masonry-grid">
                                    @for ($i = 1; $i < 13; $i++)
                                        @if (isset($data['photo' . $i]) && trim($data['photo' . $i]) != '')
                                            <div>
                                                <img class="mb-1 img-fluid"
                                                style="border-radius:6px; page-break-inside: avoid !important;"
                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['photo' . $i]) }}">
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 mb-1 @if ($sum == 0) d-none @endif"
                            style="border: 1px solid #e0e9fc;">

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="text-black mb-0 mt-0">Notes</h4>
                                <span class="m-0 f12">{{ $data['note'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 px-1 py-1 d-flex justify-content-between bg-grasy"
                        style="page-break-inside: avoid !important;">
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
                                    width="200">
                            @endif
                        </div>
                    </div>


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
@endsection
