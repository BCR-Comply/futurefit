@extends('layouts.dashboard.app')
@section('content')
    <style>
        #main-container {
            color: #333;
        }

        #gen_dec tbody tr:first-child {
            background-color: #1A47A3 !important;
            outline: 1px solid #1A47A3;
            border-bottom: 1px solid #1A47A3 !important;
            border-right: 1px solid #1A47A3 !important;
            color: #fff !important;
        }

        .mybody #gen_dec.table>tbody>tr th:first-child {
            border-right: 1px solid #fff !important;
            color: #fff !important;
        }

        .mybody #gen_dec.table>tbody>tr:nth-child(2) td:first-child {
            border-right: 1px solid #1A47A3 !important;
            /* color: #fff !important; */
        }

        .mybody #gen_dec.table>tbody>tr>th {
            border-right: 1px solid #1A47A3 !important;
            color: #fff !important;
        }

        .mybody {
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
            background: #E0E9FC;
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

        th,
        td {
            color: #333;
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
            font-size: 14px !important;
        }

        .f12 {
            font-size: 12px !important;
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

        h3 {
            margin: 0 0 6px;
        }

        .text-black p {
            margin: 0 0 5px 0;
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

        .border-card {
            background-color: #fff !important;
            border: 0.5px solid #1A47A3 !important;
        }

        ul {
            padding-left: 24px;
            margin-bottom: 0 !important;
            font-size: 12px !important;
        }

        .card-body ul>li {
            margin-top: -10px;
        }

        p {
            margin-bottom: 0rem;
        }

        .bg-grasy1 {
            background: #fff;
            border: 1px solid lightgray;
        }

        table thead tr th:last-child {
            border-top-right-radius: unset !important;
        }

        table thead tr th:first-child {
            border-top-left-radius: unset !important;
        }

        h2 {
            font-size: 14px !important;
            margin: 0 0 4px;
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
                            <p style="font-size: 12px !important;">{{ date('d/m/Y', strtotime($data->contract_forms->insert_date)) }}</p>
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
                                        <th>Ammount</th>
                                        <th>Date</th>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">{{ $data->contract_forms->milestone1 }} €</td>
                                        <td style="width: 50%;">{{ date('d/m/Y', strtotime($data->contract_forms->milestone1_date)) }}</td>
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
                                        <th>Ammount</th>
                                        <th>Date</th>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">{{ $data->contract_forms->milestone2 }} €</td>
                                        <td style="width: 50%;">{{ date('d/m/Y', strtotime($data->contract_forms->milestone2_date)) }}</td>
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
                                        <th>Ammount</th>
                                        <th>Date</th>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">{{ $data->contract_forms->milestone3 }} €</td>
                                        <td style="width: 50%;">{{ date('d/m/Y', strtotime($data->contract_forms->milestone3_date)) }}</td>
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
