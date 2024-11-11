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
            font-size: 12px !important;
        } 
        table tbody tr {
            vertical-align: middle !important;
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
                            <span class="f12">{{ $data['property']['client']['name'] }}</span>
                        </div>
                        <div class="col-9 d-grid">
                            <span class="f14 text-black"><b>Address: </b></span>
                            <span class="f12">{{ format_address($data['property']['house_num'], $data['property']['address1'], $data['property']['address2'], $data['property']['address3'], $data['property']['county'], $data['property']['eircode']) }}</span>
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
                            @php
                            $sum = 0;
                            for ($i = 1; $i <= 10; $i++) {
                                if (isset($tbox_save->{'image'.$i}) && trim($tbox_save->{'image'.$i}) != '') {
                                    $sum++;
                                }
                            }
                            @endphp
                            <h4 class="text-black mb-1 mt-0 f14" style="margin: 8px 0 4px !important;">{{$tbox_save->toolbox_item}}</h4>
                            <small class="@if($tbox_save->option_value == 'Yes') clrYes @else clrNo @endif" style="margin-bottom:10px !important;">{{ $tbox_save->option_value }}</small>
                            <div class="bg-messi my-1 mx-0 @if ($sum == 0) d-none @endif">
                                <div class="masonry-grid">
                                    @for ($i = 1; $i < 10; $i++)
                                        @if (isset($tbox_save->{'image'.$i}) && trim($tbox_save->{'image'.$i}) != '')
                                            <div>
                                                <img class="mb-1 img-fluid"
                                                style="border-radius:6px; page-break-inside: avoid !important;"
                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $tbox_save->{'image'.$i}) }}">
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="text-black mb-0 mt-0">Comments</h4>
                                <span class="m-0 f12">{{ $tbox_save->comments }}</span>
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
