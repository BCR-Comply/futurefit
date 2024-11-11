@extends('layouts.dashboard.app')
@section('content')
    <style>
        .mybody {
            background-color: #eaf1ff !important;
        }
        .editSafty,.editSafty:hover{
            background: #1A47A3;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 0px 20px;
            border-radius: 6px;
            cursor: pointer;
        }
        .d-none {
            display: none;
        }
        /* #gen_dec tbody tr:first-child {
        background-color: #1A47A3 !important;
        border: 1px solid #1A47A3;
        border-radius: 10px;
        } */
        #gen_dec tbody tr:first-child th,#gen_dec2 tbody tr:first-child th {
        background-color: #1A47A3 !important;
        border-top-left-radius: 4px !important;
        outline: 1px solid #1A47A3;
        border-bottom : 1px solid #1A47A3 !important;
        color: #fff !important;
        }
        #gen_dec tbody tr:first-child td,#gen_dec2 tbody tr:first-child td {
        background-color: #1A47A3 !important;
        border-top-right-radius: 4px !important;
        outline: 1px solid #1A47A3;
        border-bottom : 1px solid #1A47A3 !important; 
        color: #fff !important;
        }
        #gen_dec tbody tr:not(:first-child) td:nth-child(2),#gen_dec2 tbody tr:not(:first-child) td:nth-child(2) {
        border-right: 1px solid #eaf1ff !important;
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
        #gen_dec2 table tr:not(:first-child) th{
            width: 15%;
        } 
        #gen_dec2 table tr:not(:first-child) td:nth-child(2){
            width: 25%;
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
            border-radius: 6px !important;
        }

        h4 {
            color: #1A47A3;
        }

        .mybody table>tbody>tr>th {
            border-right: 1px solid #eaf1ff !important;
            width: 4%;
        }
        .mybody table>tbody>tr>td:nth-child(3){
            width: 25%;
        }
        .mybody #gen_dec2>tbody>tr>td:nth-child(3){
            width: 50%;
        }
        .mybody table>tbody>tr>th,
        .mybody table>tbody>tr>td {
            font-size: 15px;
        }
        th,td{
            color: #333;
        }
        .bg-grasy,.card,table,#gen_dec tbody tr:first-child th, #gen_dec2 tbody tr:first-child th,#gen_dec tbody tr:first-child td, #gen_dec2 tbody tr:first-child td{
            border-radius: 0px !important;
        }
        .bg-grasy h4 {
            font-size: 12px !important;
        }
        table th,
        table td {
            padding: 1px 8px !important;
            font-size: 12px !important;
        }
        .main-logo {
            width: 100px;
        }
        .f12 {
            font-size: 12px !important;
        }
        .footer-sign {
            height: 120px;
            width: 160px;
        }
        .text-gray {
            color: gray;
        }
        .cm {
            margin-top: 16px !important;
        }
        .bg-grasy1 {
            background: #fff;
            border: 1px solid lightgray;
        }
    </style>
    <div class="col-md-12 mt-3 d-flex justify-content-between">
        <a href="{{ url()->previous() }}">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="mdi mdi-menu cliclef mr-3">
                <rect width="32" height="32" rx="16" fill="#E2E8ED" />
                <path
                    d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
                    fill="black" />
            </svg>
        </a>
        {{-- <a href="{{url('/dashboard/property/report/report-edit/'.$data['id'])}}" class="editSafty">Edit</a> --}}
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body mybody">
                    <div class="d-flex justify-content-between" style="font-family: Arial">
                        <div style="color: #1A47A3 !important;">
                            <div class="d-flex align-items-end">
                                <h4 class="main-header my-0" style="color: #1A47A3 !important;padding-bottom: 2px;">
                                    {{ $data['report_name'] }}</h4>
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
                    <div class="cm mt-1">
                        <div class="col-md-12 mb-2 card" style="border-radius: 10px;border: 1px solid #1A47A3;">
                            <span class="f12 my-1 px-1">The Safety & Health Plan has been prepared on a preliminary basis in accordance with the Safety Health and Welfare at Work (Construction) Regulations 2013 and is based on project information available at this time.</span>
                        </div>

                            <table class=" mb-2 table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Project/Client Name</th>
                                        <td>{{$data->pre_risk_safety_form['p_name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Location of Works</th>
                                        <td>{{$data->pre_risk_safety_form['p_address']}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class=" mb-2 table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 25% !important;"><b>PSHP REF NO:</b></th>
                                        <td style="width: 25% !important;">{{$data->pre_risk_safety_form['pshp_ref']}}</td>
                                        <th style="width: 25% !important;"><b>Rev No.</b></th>
                                        <td style="width: 25% !important;">{{$data->pre_risk_safety_form['rev_no']}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25% !important;"><b>PDSP</b></th>
                                        <td style="width: 25% !important;">{{$data->pre_risk_safety_form['pdsp']}}</td>
                                        <th style="width: 25% !important;"><b>Date</b></th>
                                        <td style="width: 25% !important;">{{date('d/m/Y',strtotime($data->pre_risk_safety_form['p_date']))}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>1.0</th>
                                        <td colspan="2">General description of the project:</td>
                                    </tr>
                                    <tr>
                                        <th>1.1</th>
                                        <td>Description of site / property:</td>
                                        <td>{{$data->pre_risk_safety_form['desc_site']}}</td>
                                    </tr>
                                    @if($data->pre_risk_safety_form['desc_site'] == "other")
                                    <tr>
                                        <th></th>
                                        <td></td>
                                        <td>{{$data->pre_risk_safety_form['desc_site_other']}}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>1.2</th>
                                        <td>General description of the works:</td>
                                        <td>{{$data->pre_risk_safety_form['gen_desc']}}</td>
                                    </tr>
                                    <tr>
                                        <th>1.3</th>
                                        <td>Proposed start date</td>
                                        <td>{{date('d/m/Y',strtotime($data->pre_risk_safety_form['prop_start']))}}</td>
                                    </tr>
                                    <tr>
                                        <th>1.4</th>
                                        <td>Proposed completion date</td>
                                        <td>{{date('d/m/Y',strtotime($data->pre_risk_safety_form['prop_end']))}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>2.0</th>
                                        <td colspan="2">Information on other activities taking place on site</td>
                                    </tr>
                                    <tr>
                                        <th>2.1</th>
                                        <td>The dwelling will remain occupied while the above works are on hand</td>
                                        <td>{{$data->pre_risk_safety_form['dwell_remain']}}</td>
                                    </tr>
                                    <tr>
                                        <th>2.2</th>
                                        <td>Other than 2.01 above will there be further activities on site while the above works are on hand. If Yes, list activities:</td>
                                        <td>{{$data->pre_risk_safety_form['work_on_hand']}}</td>
                                    </tr>
                                    @if($data->pre_risk_safety_form['work_on_hand'] == "Yes")
                                    <tr>
                                        <th></th>
                                        <td>If Yes, list activities:</td>
                                        <td>{{$data->pre_risk_safety_form['work_on_hand_other']}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>3.0</th>
                                        <td colspan="2">Work related to the project which will involve Particular Risks or Safety Critical Risks</td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td colspan="2">Note: Safety Critical Risks are those risks whose outcome will result in a fatality, near fatality, serious injury, damage to property and/or damage to the environment.</td>
                                    </tr>
                                    <tr>
                                        <th>3.1</th>
                                        <td>Having taken account of the Principles of Prevention, Particular / Safety Critical. Risks as listed on the attached Risk Register have been identified.</td>
                                        <td>{{$data->pre_risk_safety_form['work_prev_princy']}}</td>
                                    </tr>
                    
                                </tbody>
                            </table>
                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>4.0</th>
                                        <td colspan="2">The basis upon which time was established</td>
                                    </tr>
                                    <tr>
                                        <th>4.1</th>
                                        <td>Project program time as noted under 1.03 above is estimated from other similar projects undertaken by the company with a similar allocation of resources. The estimated project time assumes reasonable weather conditions for the time of year and for continuity of access. We confirm that the works can be safely undertaken in this time.</td>
                                        <td>{{$data->pre_risk_safety_form['proj_prog']}}</td>
                                    </tr>
                    
                                </tbody>
                            </table>
                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>5.0</th>
                                        <td colspan="2">Conclusions drawn by Designers and Project Supervisors as regards the taking account of the Principles of Prevention and any relevant Health and Safety Plan or Safety File.</td>
                                    </tr>
                                    <tr>
                                        <th>5.1</th>
                                        <td>After inquiry to the homeowner, we confirm that there is a Safety File / Safety Plan in respect of this dwelling.</td>
                                        <td>{{$data->pre_risk_safety_form['after_inquiry']}}</td>
                                    </tr>
                                    <tr>
                                        <th>5.2</th>
                                        <td>Following the taking account of the Principles of Prevention, Particular / Safety Critical Risks still remaining are noted in the attached Risk Register. These risks are noted by the PSCS in the Safety Plan and the Contractor has prepared a Risk Assessment Method Statement (RAMS) to provide for their safe execution. Collective protective measures should be provided as an absolute priority over individual protective measures. RAMS are attached.</td>
                                        <td>{{$data->pre_risk_safety_form['conc_prev_princy']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>6.0</th>
                                        <td colspan="3">The location of electricity, water and sewage connection where appropriate to facilitate adequate welfare facilities</td>
                                    </tr>
                                    <tr>
                                        <th>6.1</th>
                                        <td>Location of Electricity</td>
                                        <td>Location of Water</td>
                                        <td>Location of Sewage</td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>{{$data->pre_risk_safety_form['elec_loc']}}</td>
                                        <td>{{$data->pre_risk_safety_form['water_loc']}}</td>
                                        <td>{{$data->pre_risk_safety_form['sewage_loc']}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="col-md-12 mb-0 card" style="border-radius: 10px;border: 1px solid #1A47A3;">
                                <span class="f12 my-1">We confirm that the above Preliminary Safety and Health Plan has been prepared taking account of the Principles of Prevention as
                                    outlined in Schedule 3 of the SHWW Act 2005 and in accordance with Regulation 12 of the SHWW (Construction) Regulations 2013.</span>
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

                </div>


            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rows = document.querySelectorAll('tr');

            rows.forEach(function(row) {
                // Check if the second td exists and is empty
                var secondTd = row.querySelector('td:nth-child(2)');
                if (secondTd && secondTd.textContent.trim() === '') {
                    // If empty, hide the entire tr
                    row.classList.add('d-none');
                }
            });
        });
    </script>
@endsection
