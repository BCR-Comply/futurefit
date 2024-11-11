@extends('layouts.dashboard.print')
@section('content')
    <style>
        #main-container {
            color: #333;
        }

        #gen_dec tbody tr:first-child {
            background-color: #1A47A3 !important;
            outline: 1px solid #1A47A3;
            border: 1px solid #1A47A3 !important;
            color: #fff !important;
        }

        #gen_dec.table>tbody>tr th:first-child {
            border-right: 1px solid #fff !important;
            color: #fff !important;
        }

        #gen_dec.table>tbody>tr:nth-child(2) td:first-child {
            border-right: 1px solid #1A47A3 !important;
            /* color: #fff !important; */
        }

        #gen_dec.table>tbody>tr>th {
            border-right: 1px solid #1A47A3 !important;
            color: #fff !important;
        }

            {
            background-color: #eaf1ff !important;
        }

        .d-none {
            display: none;
        }

        ul li::marker {
            color: #1A47A3 !important;
            font-size: 20px;
        }

        .f20 {
            font-size: 20px;
        }

        .text-info {
            color: #6c757d !important;
        }

        .f16 {
            font-size: 16px;
        }

        .brright {
            border-right: 1px solid #1A47A3;
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

        .bg-grasy {
            background: #fff;
        }

        h4 {
            color: #1A47A3;
            margin-top: 20px !important;
        }

        h2 {
            color: #1A47A3;
        }

        .mybody table>tbody>tr>th {
            border-right: 1px solid #eaf1ff !important;
        }

        .mybody table>tbody>tr>th,
        .mybody table>tbody>tr>td {
            font-size: 15px;
        }

        .table {
            border-color: var(--ct-table-border-color) !important;
            border-radius: 0 0 0 0 !important;
        }

        table th,
        table td {
            font-size: 12px !important;
            padding-block: 1px !important;
            padding-inline: 8px !important;
        }

        h5 {
            font-size: 12px;
            margin: 0 0 4px;
        }

        h2 {
            font-size: 14px !important;
            margin: 0 0 4px;
        }

        ul {
            padding-left: 24px;
            margin-bottom: 0 !important;
            font-size: 12px !important;
        }

        p {
            margin-bottom: 0rem;
        }

        .mybody table>tbody>tr>th {
            border-right: 1px solid #eaf1ff !important;
        }
    </style>
    @php
        $style['tbl-padding'] = 'font-size:12px !important;padding: 1px 8px !important;';
    @endphp
    <div class="row mt-3">
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
                            <span
                                class="f12">{{ isset($data['property']['client']['name']) ? $data['property']['client']['name'] : '' }}</span>
                        </div>
                        <div class="col-9 d-grid">
                            <span class="f14 text-black"><b>Address: </b></span>
                            <span
                                class="f12">{{ format_address($data['property']['house_num'], $data['property']['address1'], $data['property']['address2'], $data['property']['address3'], $data['property']['county'], $data['property']['eircode']) }}</span>
                        </div>
                    </div>
                    <div style="border: 1px solid #e0e9fc;">

                    </div>

                    <div class="cm">
                        <div class="col-12 bg-grasy p-1">
                            <h5>Please Select the relevant works that this contract relates to:</h5>
                            <ul>
                                @if (sizeOf(json_decode($data->contract_forms->contract_relates_tick_mark)))
                                    @foreach (json_decode($data->contract_forms->contract_relates_tick_mark) as $lddata)
                                        <li>{{ $lddata }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <span class="f12">{{$data->contract_forms->contract_relates_tick_mark_other}}</span>
                        </div>
                    </div>

                    <div class="cm">
                        <div class="col-12 mt-3 bg-grasy p-1">
                            <h5>The contractor shall begin installation of the measures on</h5>
                            <p style="font-size: 12px !important;">
                                {{ date('d/m/Y', strtotime($data->contract_forms->insert_date)) }}</p>
                        </div>
                    </div>
                    <div class="cm">
                        <div class="col-12 mt-3 bg-grasy p-1">
                            <h5>Contract Related Schema</h5>
                            <p style="font-size: 12px !important;">{{ $data->contract_forms->contract_relates_schema }}</p>
                        </div>
                    </div>
                    <div class="cm">
                        <div class="col-12 mt-3 bg-grasy p-1 @if ($data->contract_forms->milestone1 == '') d-none @endif">
                            <h2>Milestone 1</h2>
                            <h5>Deposit to order sills/equipment</h5>
                            <table class="table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th style="{{ $style['tbl-padding'] }}">Ammount</th>
                                        <th style="{{ $style['tbl-padding'] }}">Date</th>
                                    </tr>
                                    <tr>
                                        <td style="{{ $style['tbl-padding'] }}width: 50%;">
                                            {{ $data->contract_forms->milestone1 }} €</td>
                                        <td style="{{ $style['tbl-padding'] }}width: 50%;">
                                            {{ date('d/m/Y', strtotime($data->contract_forms->milestone1_date)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <span><b>Description:</b><span>{{$data->contract_forms->milestone1_description}}</span></span>
                        </div>
                    </div>

                    <div class="cm">
                        <div class="col-12 mt-3 bg-grasy p-1 @if ($data->contract_forms->milestone2 == '') d-none @endif">
                            <h2>Milestone 2</h2>
                            <h5>Delivery of materials</h5>
                            <table class="table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th style="{{ $style['tbl-padding'] }}">Ammount</th>
                                        <th style="{{ $style['tbl-padding'] }}">Date</th>
                                    </tr>
                                    <tr>
                                        <td style="{{ $style['tbl-padding'] }}width: 50%;">
                                            {{ $data->contract_forms->milestone2 }} €</td>
                                        <td style="{{ $style['tbl-padding'] }}width: 50%;">
                                            {{ date('d/m/Y', strtotime($data->contract_forms->milestone2_date)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <span><b>Description:</b><span>{{$data->contract_forms->milestone2_description}}</span></span>
                        </div>
                    </div>

                    <div class="cm">
                        <div class="col-12 mt-3 bg-grasy p-1 @if ($data->contract_forms->milestone3 == '') d-none @endif">
                            <h2>Milestone 3</h2>
                            <h5>Balance due when works are competed</h5>
                            <table class="table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th style="{{ $style['tbl-padding'] }}">Ammount</th>
                                        <th style="{{ $style['tbl-padding'] }}">Date</th>
                                    </tr>
                                    <tr>
                                        <td style="{{ $style['tbl-padding'] }}width: 50%;">
                                            {{ $data->contract_forms->milestone3 }} €</td>
                                        <td style="{{ $style['tbl-padding'] }}width: 50%;">
                                            {{ date('d/m/Y', strtotime($data->contract_forms->milestone3_date)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <span><b>Description:</b><span>{{$data->contract_forms->milestone3_description}}</span></span>
                        </div>
                    </div>
                    <div class="mt-2 px-1 py-1 d-flex justify-content-between bg-grasy"
                        style="page-break-inside: avoid !important;">
                        <div class="col-md-6 d-flex" style="justify-content: start;">
                            <div class="">
                                <div class="d-flex">
                                    <h4 class="text-black my-1">Date: </h4>
                                    <h4 class="ml-1 my-1 text-gray">
                                        @if ($data['date_inspected'] != '0000-00-00')
                                            {{ date('d/m/Y', strtotime($data['date_inspected'])) }}
                                        @else
                                            {{ date('d/m/Y', strtotime($data['created_date'])) }}
                                        @endif
                                    </h4>
                                </div>
                                <div class="d-flex">
                                    <h4 class="text-black my-0">Signed by Grantee: </h4>
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
                    <div class="mt-2 px-1 py-1 d-flex justify-content-between bg-grasy"
                        style="page-break-inside: avoid !important;">
                        <div class="col-md-6 d-flex" style="justify-content: start;">
                            <div class="">
                                <div class="d-flex">
                                    <h4 class="text-black my-1">Date: </h4>
                                    <h4 class="ml-1 my-1 text-gray">
                                        @if ($data['date_inspected'] != '0000-00-00')
                                            {{ date('d/m/Y', strtotime($data['date_inspected'])) }}
                                        @else
                                            {{ date('d/m/Y', strtotime($data['created_date'])) }}
                                        @endif
                                    </h4>
                                </div>
                                <div class="d-flex">
                                    <h4 class="text-black my-0">Signed by Contractor: </h4>
                                    <h4 class="ml-1 my-0 text-black">{{ $data['contractor_name'] }}</h4>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6" style="justify-content: end;">
                            @if ($data['signature'])
                                <img class="footer-sign bg-grasy1 img-fluid bg-white float-end"
                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_signature/' . $data['contractor_signature']) }}"
                                    width="200">
                            @endif
                        </div>
                    </div>
                </div>


            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
@endsection
