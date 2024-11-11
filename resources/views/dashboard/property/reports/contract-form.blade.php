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

        #gen_dec.table>tbody>tr:first-child th:not(:last-child) {
            border-right: 1px solid #fff !important;
            color: #fff !important;
        }

        /* #gen_dec.table>tbody>tr:nth-child(2) td:first-child {
            border-right: 1px solid #1A47A3 !important;
        } */

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
            font-size: 12px;
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
            list-style: lower-alpha;
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
    <div class="row">
        <div class="col-12">
            <div class="">
                <div class="">
                    <div class="d-flex justify-content-between" style="font-family: Arial">
                        <div style="color: #1A47A3 !important;">
                            <div class="d-flex align-items-end">
                                <h4 class="main-header my-0">BCR Comply</h4>
                                {{-- @if ($data['report_type']) --}}
                                    {{-- <div class="lead ml-2"></div> --}}
                                {{-- @endif --}}
                            </div>
                            <h6 class="main-header-date my-0"></h6>
                        </div>

                        <div>
                            <img src="{{ asset('assets/images/new_logo.svg') }}" class="main-logo img-fluid">
                        </div>
                    </div>
                    <div style="border: 1px solid #e0e9fc;">

                    </div>
                    <div class="row mt-1 mb-1">
                        <div class="col-3 d-grid">
                            <span class="f14 text-black"><b>Name of Grantee </b></span>
                        </div>
                        <div class="col-9 d-grid mb-1">
                            <span class="f14">Jon Lomax</span>
                        </div>
                        <div class="col-3 d-grid">
                            <span class="f14 text-black"><b>Property address </b></span>
                        </div>
                        <div class="col-9 d-grid mb-1">
                            <span class="f14">1A, Test Address One, Test address two, Test address threem Sligo, F91 H578</span>
                        </div>
                        <div class="col-3 d-grid">
                            <span class="f14 text-black"><b>Measures </b></span>
                        </div>
                        <div class="col-9 d-grid">
                            <span class="f14">External insulation / Cavity wall insulation / Drylining internal wall insulation / Earthwool ceiling  insulation / Spray foam between rafters insulation / Heating and plumbing works / Property renovation / Retro roof spray foam insulation</span>
                        </div>
                    </div>
                    <div style="border: 1px solid #e0e9fc;">

                    </div>

                    <div class="cm">
                        <h2>INSTALLATION TERMS</h2>
                        <div class="col-12 bg-grasy p-1">
                            <p class="text-black" style="font-size: 12px !important;">These Installation Terms (“Terms”) set out under which a registered contractor BCR Comply &
                                Energy Upgrades Limited (the “Contractor”) for the purpose of the Better Energy Homes (BEH) scheme (the “Scheme”) will install certain home energy efficiency measures (“Measure”) in the home of an individual (“Grantee”) who has successfully applied for a grant under the Scheme. By signing below, The Grantee and the Contractor agree to be bound by these Terms. </p>
                        </div>
                    </div>

                    <div class="cm">
                        <div class="col-12 bg-grasy p-1">
                            <h5 class="text-black">1. The Contractor shall</h5>
                            <ul>
                                <li>Begin installation of the measure on ……………………………………………………………... and ensure that  such installation is completed between 4-6 WEEKS AFTER THE COMMENCEMENT. These dates may  only be varied by agreement of the parties and subject to suitable weather conditions.</li>
                                <li>Install the Measure with all due skill, care and diligence, and in accordance with these Terms and  relevant law and regulation, including, without limitation, health and safety law and regulation and  in accordance with any applicable manufacturer’s guidelines and instructions.</li>
                                <li>Only use appropriately qualified, experienced, skilled and trained personnel, and who are also either registered with SEAI as registered contractor or as nominated personnel, in supervising and  signing off on the satisfactory completion of the measure.</li>
                                <li>Only install such Measure as is appropriate having regard to the Grantee’s requirements and the  optimal energy efficiency of the Grantee’s home.</li>
                                <li>Ensure that, after installation of the Measure has completed, the Grantee’s home is in the same  state of repair, condition and cleanliness as it was before installation began.</li>
                                <li>Provide the Grantee with a signed and legible Scheme “Declaration of Works” on completion of  the installation.</li>
                                <li>Maintain such adequate insurances as required under the terms of registration under the Scheme  to cover all loss or damage that may arise either in relation to installation of the Measure or in  connection with these Terms.</li>
                                <li>Not assign these Terms or subcontract installation of the Measure without the Grantee’s consent</li>
                            </ul>
                        </div>
                    </div>
                    <div class="cm">
                        <div class="col-12 bg-grasy p-1">
                            <h5 class="text-black">2. The Grantee shall provide safe access to their home as is necessary to allow the Contractor to  install the Measure and will also provide all relevant electricity and other utilities necessary to  facilitate such installation.</h5>
                        </div>
                    </div>
                    <div class="cm">
                        <div class="col-12 bg-grasy p-1">
                            <h5 class="text-black">3. Unless otherwise agreed between the parties, the Grantee shall pay the Contractor</h5>
                            <p class="text-black mb-1" style="font-size: 12px !important;">Total €………………..…. (inclusive of VAT) (the “fee”) for and on the provision and installation of the Measure  and any specified ancillary works which have been agreed between the parties. Where the Fee is to  be paid in instalments, it shall be paid as follows:
                               <br> Instalment Milestone</p>
                                <table class="table table-bordered" id="gen_dec">
                                    <tbody>
                                        <tr>
                                            <th style="{{ $style['tbl-padding'] }}">Instalment Milestones</th>
                                            <th style="{{ $style['tbl-padding'] }}">Description</th>
                                            <th style="{{ $style['tbl-padding'] }}">Amount</th>
                                            <th style="{{ $style['tbl-padding'] }}">Date</th>
                                        </tr>
                                        <tr>
                                            <td style="{{ $style['tbl-padding'] }}">Milestone 1</td>
                                            <td style="{{ $style['tbl-padding'] }}">Deposit</td>
                                            <td style="{{ $style['tbl-padding'] }}">€ -</td>
                                            <td style="{{ $style['tbl-padding'] }}">-</td>
                                        </tr>
                                        <tr>
                                            <td style="{{ $style['tbl-padding'] }}">Milestone 2</td>
                                            <td style="{{ $style['tbl-padding'] }}">All Material on site</td>
                                            <td style="{{ $style['tbl-padding'] }}">€ -</td>
                                            <td style="{{ $style['tbl-padding'] }}">-</td>
                                        </tr>
                                        <tr>
                                            <td style="{{ $style['tbl-padding'] }}">Milestone 3</td>
                                            <td style="{{ $style['tbl-padding'] }}">Completion of works</td>
                                            <td style="{{ $style['tbl-padding'] }}">€ -</td>
                                            <td style="{{ $style['tbl-padding'] }}">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="mt-2 px-1 py-1 d-flex justify-content-between bg-grasy"
                        style="page-break-inside: avoid !important;">
                        <div class="col-md-6 d-flex" style="justify-content: start;">
                            <div class="">
                                <div class="d-flex">
                                    <h4 class="text-black my-1">Date: </h4>
                                    <h4 class="ml-1 my-1 text-gray">
                                        06-09-2023
                                    </h4>
                                </div>
                                <div class="d-flex">
                                    <h4 class="text-black my-0">Signed by: </h4>
                                    <h4 class="ml-1 my-0 text-black">Jon Lomax</h4>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6" style="justify-content: end;">
                            <svg class="footer-sign bg-grasy1 img-fluid bg-white float-end p-3" height="120" viewBox="0 0 98 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.00438 10.9457C0.17105 18.1679 2.17105 31.4457 16.8377 26.779C35.171 20.9457 39.3378 5.52902 29.7545 1.36235C20.1711 -2.80432 -6.07886 28.8624 14.3378 36.779C30.6711 43.1124 52.5323 15.8068 61.4211 1.36235C53.6434 15.9457 39.5937 39.7363 46.8378 45.1123C53.8643 50.3268 77.9271 32.2363 82.2545 7.6123C83.3948 1.12371 75.0104 24.279 80.1711 30.9456C88.1721 41.2813 99.1771 30.9456 96.8378 24.279" stroke="black" stroke-width="0.833333"/>
                            </svg>
                        </div>
                    </div>
                </div>


            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
@endsection
