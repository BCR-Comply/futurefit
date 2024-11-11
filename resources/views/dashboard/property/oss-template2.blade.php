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

        ul li::marker {
            color: #1A47A3 !important;
            font-size: 20px;
        }

        ul li {
            color: #333 !important;
        }

        .bg-grasy {
            background: #fff;
        }

        table th,
        table td {
            padding: 8px !important;
            color: #333 !important;
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
            border-radius: 0 0 0 0 !important;
        }

        table th,
        table td {
            font-size: 12px !important;
            padding-block: 1px !important;
            padding-inline: 8px !important;
            /* width: 50% !important; */
        }

        .border-card {
            background-color: #fff !important;
            border: 0.5px solid #1A47A3 !important;
        }

        ul {
            padding-left: 24px;
            margin-bottom: 0 !important;
        }

        ul>li {
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
            border-left: 1px solid #fff !important;
        }

        table thead tr th:first-child {
            border-top-left-radius: unset !important;
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
                @php
                $arr = $data['oss_template'];
            @endphp
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
                            <span class="f12">{{ isset($data['property']['client']) ? $data['property']['client']['name'] : "N/A" }}</span>
                        </div>
                        <div class="col-9 d-grid">
                            <span class="f14 text-black"><b>Address: </b></span>
                            <span
                                class="f12">{{ format_address($data['property']['house_num'], $data['property']['address1'], $data['property']['address2'], $data['property']['address3'], $data['property']['county'], $data['property']['eircode']) }}</span>
                        </div>
                    </div>
                    <div style="border: 1px solid #e0e9fc;">

                    </div>

                    <div class="col-12 my-3 text-center">
                        @if (isset($data->oss_cost['coverImg']) && $data->oss_cost['coverImg'] != null && trim($data->oss_cost['coverImg']) != '')
                                                <img src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data->oss_cost['coverImg']) }}"
                                                    style="max-width:100%;max-height: 37rem;">
                                            @else
                                                <img src="{{ asset('assets/images/new_logo.svg') }}"
                                                    style="max-width:100%;max-height: 37rem;">
                                            @endif
                    </div>
                    <div class="col-sm-12 border-card cm text-black p-1"
                        style="border-radius: 0px !important;margin-bottom: unset !important;">
                        <h3 class="f14" align="start">Dear {{isset($data['property']['client']) ? $data['property']['client']['name'] : "N/A"}},</h3>
                        <p class="f12" style="word-break: break-word;">Thank you for allowing us to quote for the
                            Proposed Works at your home. Following our site survey we have prepared a detailed Quotation for
                            the works as requested which are enclosed in this Quotation. </p>
                        <p class="f12" style="word-break: break-word;">Should you have any questions or queries what so
                            ever, please don't hesitate to give me a quick call.</p>
                        <div style="border-top: 1px solid #e0e9fc;">

                        </div>
                        <p class="f12 mt-1" style="word-break: break-word;">Kind Regards,</p>
                        <p class="f12" style="word-break: break-word;">{{$data['name']}}</p>
                        <p class="f12 mb-0" style="word-break: break-word;">{{ $data['report_config']->name }}</p>
                    </div>
                    <div class="row cm">
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Description of Works (Supply & Fit)</th>
                                    <th>Cost</th>
                                </thead>
                                <tbody>

                                    @if (sizeof($arr))
                                        @foreach ($arr as $oss_template)
                                            <tr>
                                                <td>
                                                    <span
                                                        class="text-black fw-bold">{{ $oss_template['measure_name'] }}</span>
                                                    <br>
                                                    <span>Grant: €
                                                        {{ number_format($oss_template['grant_cost'], 2) }}</span></br>
                                                        <span>Description of Works:&nbsp;@if($oss_template['comments'] != ""){{$oss_template['comments']}} @else N/A @endif</span>
                                                </td>
                                                <td>€ {{ number_format($oss_template['cost_works'], 2) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    @php
                                     $arr2 = $data['oss_cost'];
                                     $arr3 = $data['oss_additional'];
                                    //  dd($arr2,$arr3);
                                    @endphp
                                    @if($arr3 != null)
                                    <tr>
                                        <td style="text-align: left"><span class="text-black fw-bold">Additional Cost:</span></br>
                                                    <span>Description of Works:
                                                        {{ $arr3['additional_comments'] }}</span>
                                        </td>
                                        <td>€ {{ $arr3 ? number_format($arr3['additional_cost_works'], 2) : '' }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td style="text-align: left"><span class="text-black fw-bold">Total cost of
                                                Works:</span></br>
                                                <span>Total Grant: €
                                                    {{ number_format($arr2['total_grant'], 2) }}</span></span>
                                        </td>
                                        <td>€ {{ $arr2 ? number_format($arr2['total_cost_works'], 2) : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><span class="text-black fw-bold">Total cost excluding VAT:</span></td>
                                        <td>€ {{ $arr2 ? number_format($arr2['cost_work_contribution'], 2) : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><span class="text-black fw-bold">VAT @13.5%:</span>
                                        </td>
                                        <td>€ {{ $arr2 ? number_format($arr2['vatcost'], 2) : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><span class="text-black fw-bold">Total cost including VAT:</span></td>
                                        <td>€ {{ $arr2 ? number_format($arr2['total_client_cost_work_contribution'], 2) : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><span class="text-black fw-bold">Less Grant Amount:</span></td>
                                        <td>€ -{{ $arr2 ? number_format($arr2['final_total_client_contripution'], 2) : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><span class="text-black fw-bold">Cost for Customer to Pay:</span></td>
                                        <td>€ {{ $arr2 ? number_format($arr2['total_estimate_cost_for_customer'], 2) : '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @php
                        $descArr = [];
                        $addedNames = []; // Array to keep track of added names
                        if(isset($data['quot_desc']) && isset($data['oss_template'])){
                            foreach ($data['quot_desc'] as $key => $Ddata) {
                                foreach ($data['oss_template'] as $key => $oData) {
                                    if (trim($Ddata->name) == trim($oData->measure_name)) {
                                        if (!in_array($Ddata->name, $addedNames)) {
                                            $descArr[] = $Ddata;
                                            $addedNames[] = $Ddata->name; // Add name to the tracking array
                                        }
                                    }
                                }
                            }
                        }
                    @endphp
                    @foreach ($descArr as $descData)
                        <div class="col-12 cm border-card p-1">
                            <h5 style="color:#1A47A3;">{{ $descData->name }}:</h5>
                            {!! $descData->description !!}
                        </div>
                    @endforeach
                    {{-- @php
                    $myarrs = $data['oss_template'];
                    $nameArray = [];
                    $check = 0;
                    foreach ($data['oss_template'] as $obj) {
                        $nameArray[] = $obj;
                    }
                        $check = sizeOf(array_filter($nameArray, function($item){
                            return $item['measure_name'] === "External Wall Insulation & Render";
                        }));
                    @endphp --}}
                    {{-- @if($check > 0) --}}
                    {{-- <div class="col-12 cm border-card p-1">
                        <h5 style="color:#1A47A3;">External Insulation Works:</h5>
                        <h5 style="color:#333;">The Works are to include:</h5>
                        <ul type="disc" class="f12">
                            <li><em>The installation of <strong> Terracco External Insulation </strong> with Acrylic Render or dry dash finish to front and rear elevation walls</em>
                            </li>
                            <li><em>Supply and fit of New Pressed Aluminium, Powder Coated Overcills in accordance with NSAI Certificate. (Colour to be chosen by Client)</em>
                            </li>
                            <li><em>The main wall Insulation will be of <strong> 100mm </strong> EPS Platinum which will give a minimum U-Value of approximately <strong> 0.27 w/m²k. </strong></em></li>
                            <li><em>The reveal insulation will be a minimum of <strong> 20mm </strong> EPS Platinum,</em></li>
                            <li><em>Plinth Insulation will be <strong> 80mm </strong> Ultra High Density EPS 200.</em></li>
                            <li><em>New Room ventilators (100mm Diameter) must be installed as required and as per the SEAI's Better Energy Homes Scheme.</em></li>
                            <li><em>New Pressed Aluminium Flashing to be installed to areas without adequate overhang.</em></li>
                            <li><em>A BER must be conducted after the works are complete and this cost has also been included in this quotation.</em></li>
                        </ul>
                    </div>
                    <div class="col-12 cm border-card p-1">
                        <h5 style="color:#1A47A3;">Contractor Attendances:</h5>
                        <h5 style="color:#333;">The Works are to include:</h5>
                        <ul type="disc" class="f12">
                            <li>All associated external plumbing aterations included!</li>
                            <li>All associated extermal clectrical & ESB alterations, where required, included!</li>
                            <li>All associated scaffolding works included!</li>
                            <li>Site clean-up and skip/waste removal included!</li>
                            <li>We will completely manage the grant application process for you!</li>
                        </ul>
                    </div>
                    <div class="col-sm-12 border-card cm text-black p-1"
                        style="border-radius: 0px !important;margin-bottom: unset !important;">
                        <p class="f12" style="word-break: break-word;">All <strong> Complete Insulations </strong> projects are
                            inspected
                            by our Certificate Holders and Suppliers, Warm Living Ltd at regular intervals during the
                            project to ensure the highest quality of Installation.</p>
                        <p class="f12" style="word-break: break-word;">All <strong> Complete Insulations </strong> works carry a labour
                            warranty of 5 years from completion of works.</p>
                        <p class="f12" style="word-break: break-word;">All Terracco products carry a materials
                            warranty
                            for a period of 10 years.</p>
                        <p class="f12" style="word-break: break-word;">All <strong> Complete Insulations </strong> contracts are covered
                            by El and Pl Insurances</p>
                        <p class="f12" style="word-break: break-word;">Works to take approximately 3/4 weeks to
                            complete! (Weather Dependant)</p>
                    </div> --}}
                    {{-- @endif --}}
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
                    <div class="mt-2 px-1 py-1 d-flex" style="page-break-inside: avoid !important; border: unset !important;">
                        @if($data['report_config']->company_logo != null)
                        <img src="{{ asset('assets/images/report_company_logo/'.$data['report_config']->company_logo) }}" alt="OSS Logo"
                            style="object-fit: contain !important;max-width: 55px !important;max-height: 100% !important;width: auto !important;height: auto !important;">
                        @endif
                        <p style="text-align: center;font-size:12px;margin:auto; @if($data['report_config']->company_logo != null) padding-right: 55px; @endif">
                            {{ $data['report_config']->name }}, {{ $data['report_config']->address }} Tel: {{ $data['report_config']->phone }}
                            Website:
                            <a href="{{ $data['report_config']->website }}">{{ $data['report_config']->website }}</a>
                        </p>
                    </div>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
    </div><!-- end row -->
@endsection
