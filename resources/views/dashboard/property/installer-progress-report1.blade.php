@extends('layouts.dashboard.app')
@section('content')
    <style>
        .mybody {
            background-color: #eaf1ff !important;
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

        .bg-grasy {
            background: #E0E9FC;
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
            font-weight: 500;
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
            width: 160px;
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

        .bg-grasy1 {
            background: #fff;
            border: 1px solid lightgray;
        }
        .border-card {
            background-color: #fff !important;
            border: 0.5px solid #1A47A3 !important;
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
                            </div>
                            <h6 class="main-header-date my-0">{{ date('d/m/Y', strtotime($data['date_inspected'])) }}</h6>
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
                            <span class="f12">{{ $data['property']['client']['name'] }}</span>
                        </div>
                        <div class="col-9 d-grid">
                            <span class="f14 text-black"><b>Address: </b></span>
                            <span
                                class="f12">{{ format_address($data['property']['house_num'], $data['property']['address1'], $data['property']['address2'], $data['property']['address3'], $data['property']['county'], $data['property']['eircode']) }}</span>
                        </div>
                    </div>
                    <div style="border: 1px solid #e0e9fc;">

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <?php
                                $area = '';
                                $item = '';
                                $type = '';
                            ?>
                            @foreach ($data['photo_inspection_items'] as $photo_inspection_item)
                                <div class="col-12 cm border-card @if ($photo_inspection_item['item']['area']['area'] == $area) d-none @endif">
                                    @if ($photo_inspection_item['item']['area']['area'] != $area)
                                        <div class="d-flex flex-column flex-start p-1 f12">
                                            @php
                                                $area = $photo_inspection_item['item']['area']['area'];
                                            @endphp
                                            <div class="text-black"><b>Area: </b></div>
                                            <div class="text-black">{{ $area }}</div>
                                        </div>
                                        <div style="border-top: 1px solid #e0e9fc;margin: 0px 10px;">

                                        </div>
                                    @endif
                                    @if ($photo_inspection_item['item']['item'] != $item)
                                        <div class="d-flex flex-column flex-start p-1 f12">
                                            @php
                                                $item = $photo_inspection_item['item']['item'];
                                            @endphp
                                            <div class="text-black"><b>Item: </b></div>
                                            <div class="text-black">{{ $item }}</div>
                                        </div>
                                        <div style="border-top: 1px solid #e0e9fc;margin: 0px 10px;">

                                        </div>
                                    @endif
                                    @if ($photo_inspection_item['question']['type'] != $type)
                                        <div class="d-flex flex-column flex-start p-1 f12">
                                            @php
                                                $type = $photo_inspection_item['question']['type'];
                                            @endphp
                                            <div class="text-black"><b>Type: </b></div>
                                            <div class="text-black">{{ $type }}</div>
                                        </div>
                                    @endif
                                </div>
                                @php
                                    if ($photo_inspection_item['question']['input'] == 'photo') {
                                        $sum = 0;
                                        for ($i = 1; $i <= 5; $i++) {
                                            if (isset($photo_inspection_item['image' . $i]) && trim($photo_inspection_item['image' . $i]) != '') {
                                                $sum++;
                                            }
                                        }
                                    }
                                @endphp
                                <div class="my-1 p-1 f12 cm border-card @if ($photo_inspection_item['question']['input'] == 'photo' && isset($sum) && $sum == 0) d-none @endif"
                                    style="color:#333;">
                                    <h5 style="margin: 0 0 10px !important;">
                                        Q: {{ $photo_inspection_item['question']['Item'] }}
                                    </h5>

                                    @if ($photo_inspection_item['question']['input'] == 'text')
                                        <p>{{ $photo_inspection_item['comments'] ? $photo_inspection_item['comments'] : '--' }}
                                        </p>
                                    @else
                                        <div class="row bg-messi mx-0 @if ($sum == 0) d-none @endif">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if (isset($photo_inspection_item['image' . $i]) && trim($photo_inspection_item['image' . $i]) != '')
                                                    <div class="col-sm-12 col-md-4 px-0 py-0 col-lg-4 d-flex justify-content-start"
                                                        style="max-width:fit-content;">
                                                        <img class="me-1 mb-1 img-fluid"
                                                            style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;"
                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $photo_inspection_item['image' . $i]) }}">
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
                                    @endif
                                </div>
                            @endforeach

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
                                    <h4 class="ml-1 my-0 text-black">{{ $data['name'] }}</h4>
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
