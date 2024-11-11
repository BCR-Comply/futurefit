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
        table tbody tr:nth-child(even) {
            background-color: #fff !important;
        }

        table tbody tr:nth-child(odd) {
            background-color: #fff !important;
        }

        tbody tr:not(:last-child) {
            border-bottom: 1px solid #eaf1ff;
        }

        table {
            outline: 1px solid #1A47A3 !important;
            border-radius: 0 !important;
        }
        #gen_dec tbody tr:first-child th {
        background-color: #1A47A3 !important;
        /* border-top-left-radius: 4px !important; */
        outline: 1px solid #1A47A3;
        border-bottom : 1px solid #1A47A3 !important;
        color: #fff !important;
        border-top: 1px solid #1A47A3 !important;
        }
        /* tr:last-child td:first-child,.tr:last-child td:last-child{
            border-radius: unset !important;
        } */
        #gen_dec tbody tr:first-child td{
        background-color: #1A47A3 !important;
        /* border-top-right-radius: 4px !important; */
        outline: 1px solid #1A47A3;
        border-bottom : 1px solid #1A47A3 !important; 
        color: #fff !important;
        }
        #gen_dec tbody tr:not(:first-child) td:nth-child(1){
        border-right: 1px solid #1A47A3 !important;
        }
        .f20 {
            font-size: 20px;
        }
        #gen_dec table tr:not(:first-child) th{
            width: 15%;
        } 
        #gen_dec table tr:not(:first-child) td:nth-child(2){
            width: 25%;
        } 
        .brright {
            border-right: 1px solid #1A47A3;
        }
        
        .bg-grays {
            border: 0.5px solid #1A47A3 !important;
            background-color: #fff !important;
            /* border-radius: 6px; */
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
        .clrYes {
            background: #E4F3EA !important;
            color: #3A9B7A !important;
            padding: 3px 6px 3px 9px;
            border-radius: 36px;
            margin-bottom: 5px;
        }
        .clrNo {
            background: #FDE6E6 !important;
            color: #FF1919 !important;
            padding: 3px 6px 3px 9px;
            border-radius: 36px;
            margin-bottom: 5px;
        }
        .table > :not(caption) > * > * {
            padding: 1px 8px !important;
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

                    @foreach($data['toolbox_saved_data'] as $sks => $tbox_saves)
                    <h4 class="text-black mb-1 mt-0 f14" style="margin: 16px 0 0.375rem !important;color: #1A47A3 !important;">{{$sks}}</h4>
                    <div class="col-12 p-1 py-0 bg-grasy">
                        @php
                            $count = 0;
                            $count = count($tbox_saves);
                        @endphp
                        @foreach($tbox_saves as $kv =>  $tbox_save)
                        @if($tbox_save->option_value != "N/A" && $tbox_save->option_value != "")
                        <h4 class="text-black mb-1 mt-0 f14" style="margin: 8px 0 4px !important;">{{$tbox_save->toolbox_item}}</h4>
                        <small class="@if($tbox_save->option_value == 'Yes') clrYes @else clrNo @endif" style="margin-bottom:10px !important;">{{ $tbox_save->option_value }}</small>
                        <div>
                            @php
                                $sum = 0;
                                for ($i = 1; $i <= 10; $i++) {
                                    if (isset($tbox_save->{'image'.$i}) && trim($tbox_save->{'image'.$i}) != '') {
                                        $sum++;
                                    }
                                }
                            @endphp

                            <div class="row bg-messi my-1 mx-0 @if ($sum == 0) d-none @endif">
                                @for ($i = 1; $i <= 10; $i++)
                                    @if (isset($tbox_save->{'image'.$i}) && trim($tbox_save->{'image'.$i}) != '')
                                        <div class="col-sm-12 col-md-4 col-lg-4 py-0 px-0 d-flex justify-content-start"
                                            style="max-width:fit-content;">
                                            <img class="me-1 mb-1 img-fluid"
                                                style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;"
                                                src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $tbox_save->{'image'.$i}) }}">
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        {{-- <div class="mt-2 mb-1 @if ($sum == 0) d-none @endif" style="border: 1px solid #e0e9fc;">

                        </div> --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="text-black mb-1 mt-0 f14" style="margin: 0 0 4px !important;">Comments</h4>
                                <small class="f12">{{ $tbox_save->comments }}</small>
                            </div>
                        </div>
                        <div class="mt-2" style="border-top: 1px solid #e0e9fc;"></div>
                        @endif
                        @endforeach
                    </div>
                   
                    @endforeach
                    <table class="mt-3 mb-3 table" id="gen_dec">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Signature</th>
                            </tr>
                            @foreach($data['toolbox_person'] as $tbxperson)
                            <tr>
                                <td>{{$tbxperson->person_name}}</td>
                                <td>
                                    <img class="m-1 ms-0 img-fluid" style="width: 50px;height:50px;" src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $tbxperson->signature) }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
