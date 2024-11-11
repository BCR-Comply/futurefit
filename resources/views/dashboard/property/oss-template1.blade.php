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

        .card-body.mybody  ul>li {
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

                    <div class="col-sm-12 border-card cm text-black p-1"
                        style="border-radius: 0px !important;margin-bottom: unset !important;">
                        <h3 class="f14" align="start">Hi, {{ $data['property']['client']['name'] }}</h3>
                        <p class="f12" style="word-break: break-word;">Thank you once again for having our team in your
                            home to carry out the assessment for your Generation Green Home Upgrade.</p>
                        <p class="f12" style="word-break: break-word;">As mentioned earlier our dedicated financial
                            partner, An Post, is now offering low cost green lending for energy efficient, home improvement
                            projects such as yours. To find out more about low cost green lending from An Post, please visit
                            An <a
                                href="https://urldefense.com/v3/__https:/anpost.com/greenhub__;!!KLAX!z3hdm0HhLrJ8Do5KO3q00rVhqZ8HOInX8e8afBqKh18R2Xjog5WBAR714FzD_PLP$"
                                target="_blank">&nbsp;Post Green Money Loans.</a></p>
                        <p class="f12 mb-1" style="word-break: break-word;">Following the initial assessment, we&rsquo;re
                            pleased to offer you the estimated quotation below based on your requirements, together with
                            costings and relevant grants:</p>
                        <div style="border-top: 1px solid #e0e9fc;">

                        </div>
                        <h5 class="mt-1 f12">Address:</h5>
                        <span class="f12">
                            {{ format_address(
                                $data['property']['client']['name'],
                                $data['property']['client']['address1'],
                                $data['property']['client']['address2'],
                                $data['property']['client']['address3'],
                                $data['property']['client']['county'],
                                $data['property']['client']['eircode'],
                            ) }}
                        </span>
                    </div>

                    <div class="row cm">
                        <div class="col-sm-12">

                            <table class="table table-bordered">
                                <thead>
                                    <th>Description of Works (Supply & Fit)</th>
                                    <th>Cost</th>
                                </thead>
                                <tbody>
                                    @php
                                        if ($data->fk_forms_id == 22) {
                                            $arr = $data['oss_template'];
                                        } elseif ($data->fk_forms_id == 24) {
                                            $arr = $data['fuel_template'];
                                        } elseif ($data->fk_forms_id == 23) {
                                            $arr = $data['housing_template'];
                                        }

                                    @endphp
                                    @if (sizeof($arr))
                                        @foreach ($arr as $oss_template)
                                            <tr>
                                                <td>
                                                    <span
                                                        class="text-black fw-bold">{{ $oss_template['measure_name'] }}</span>
                                                    <br>
                                                    <span>Grant: €
                                                        {{ number_format($oss_template['grant_cost'], 2) }}</span>
                                                </td>
                                                <td>€ {{ number_format($oss_template['cost_works'], 2) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    @php
                                        if ($data->fk_forms_id == 22) {
                                            $arr2 = $data['oss_cost'];
                                        } elseif ($data->fk_forms_id == 24) {
                                            $arr2 = $data['fuel_cost'];
                                        } elseif ($data->fk_forms_id == 23) {
                                            $arr2 = $data['housing_cost'];
                                        }

                                    @endphp
                                    <tr>
                                        <td style="text-align: left"><span class="text-black fw-bold">Total cost of
                                                Works:</span></td>
                                        <td>€ {{ $arr2 ? number_format($arr2['total_cost_works'], 2) : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><span class="text-black fw-bold">VAT @13.5%:</span>
                                        </td>
                                        <td>€ {{ $arr2 ? number_format($arr2['vatcost'], 2) : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><span class="text-black fw-bold">Total cost of Works
                                                Including VAT @13.5%:</span></td>
                                        <td>€
                                            {{ $arr2 ? number_format($arr2['total_client_cost_work_contribution'], 2) : '' }}
                                        </td>

                                    </tr>
                                </tbody>
                            </table>


                        </div>
                    </div>

                    <div class="col-12 cm border-card p-1">
                        <h5 style="color:#333;">Surveyor Comments – </h5>
                        <ul type="disc" class="f12">
                            <li><em>Please note a Pre &amp; Post BER is required for the SEAI OSS/NHR Grant Scheme. </em>
                            </li>
                            <li><em>Completion of the Pre BER will confirm approval to the SEAI OSS Grant Scheme. </em></li>
                            <li><em><strong>Please note:</strong> <strong>if your home qualifies for the SEAI OSS/NHR Grant
                                        Scheme there will be an additional discount for energy credits
                                        applicable.</strong></em></li>
                            <li><em>The Discount for energy credits will be indicated on completion of the pre BER and
                                    confirmed on completion of the post BER. </em></li>
                            <li><em>Please note to qualify for the grant all external doors will need to be upgraded.
                                </em><em></em></li>
                        </ul>
                    </div>
                    <div class="col-12 cm border-card p-1">
                        <h5 style="color:#333;">Next Steps:</h5>
                        <ul type="disc" class="f12">
                            <li>If you are satisfied with our quotation and wish to proceed, please contact us on the
                                details listed below and we can take a booking deposit. </li>
                            <li>As discussed with your energy consultant, this quotation is an estimate and may be subject
                                to change on completion of the final technical installer checks. Should there be a variance
                                in cost, this will be fully explained in your final quotation. </li>
                            <li>Pre &amp; Post BER required for the SEAI OSS Grant Scheme. </li>
                            <li>Completion of the HEA will determine the homes suitability to qualify for the scheme/SEAI
                                OSS Grants. </li>
                            <li>Please note if your home qualifies for the SEAI OSS Grant Scheme there will be an additional
                                discount for energy credits applicable. </li>
                            <li>The Discount for energy credits will be confirmed on completion of the pre BER. </li>
                            <li>Once we have a booking deposit we will arrange final installer checks to finalise your
                                quote. </li>
                            <li>On completion of final installer checks, we will issue a final quote, a contract for the
                                works and documentation to allow us apply for your grant and carbon credits. </li>
                            <li>Once all documentation is signed, we will assign a project manager and schedule in dates to
                                commence your work. </li>
                            <li>If you would like to discuss this quote or, if you would like to proceed with the works,
                                please contact your Sales Consultant Adrian Harrison on (087 273 2382) or e-mail us on <a
                                    href="mailto:homeupgrades@sse.com" target="_blank">homeupgrades@sse.com</a></li>
                            <li>Adrian will also contact you in the coming days to ensure you have received your quote and
                                to confirm how you wish to proceed. </li>
                        </ul>
                    </div>
                    <div class="col-12 cm border-card p-1" style="color: #333; font-size: 16px;">
                        <p class="f12" style="text-align: center">Thank you again for your interest in our Generation
                            Green Home
                            Upgrade.</p>
                        <p class="f12" style="text-align: end"><strong>Kind Regards</strong><strong><br>
                                <strong>Adrian Harrison</strong><br>
                                <strong>Energy Services Team&nbsp;</strong><br>
                                <strong>SSE Airtricity</strong></strong></p>
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
