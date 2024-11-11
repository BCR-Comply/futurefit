@extends('layouts.dashboard.print')
@section('content')
    <style>
        .mybody {
            background-color: #eaf1ff !important;
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
        outline: 1px solid #1A47A3;
        border-bottom : 1px solid #1A47A3 !important;
        color: #fff !important;
        border-top : 1px solid #1A47A3 !important;
        }
        #gen_dec tbody tr:first-child td,#gen_dec2 tbody tr:first-child td {
        background-color: #1A47A3 !important;
        outline: 1px solid #1A47A3;
        border-bottom : 1px solid #1A47A3 !important; 
        color: #fff !important;
        border-top : 1px solid #1A47A3 !important;
        border-right : 1px solid #1A47A3 !important;

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

        #get_dec tr:first-child,#get_dec2 tr:first-child{
            border-top: 1px solid #1A47A3 !important;
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
            background: #fff;
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
        table th,
        table td {
            padding: 1px 8px !important;
            font-size: 12px !important;
        }
        .bg-grasy1 {
            background: #fff;
            border: 1px solid lightgray;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="">
                <div class="">
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
                            <span class="f12 my-1 px-1">The Safety & Health Plan has been prepared in accordance with the Safety Health and Welfare at Work (Construction) Regulations 2013 and is based on project information available at this time.</span>
                        </div>

                            <table class=" mb-2 table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Project Title</th>
                                        <td>{{$data->risk_safety_form['p_name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        <td>{{$data->risk_safety_form['p_address']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <td>{{date('d/m/Y',strtotime($data->risk_safety_form['p_date']))}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th style="width:3%;">1.0</th>
                                        <td colspan="2">General description of the project:</td>
                                    </tr>
                                    <tr>
                                        <th>1.1</th>
                                        <td>Description of site / property:</td>
                                        <td>{{$data->risk_safety_form['desc_site']}}</td>
                                    </tr>
                                    <tr>
                                        <th>1.2</th>
                                        <td>General description of the works:</td>
                                        <td>{{$data->risk_safety_form['work_desc']}}</td>
                                    </tr>
                                    <tr>
                                        <th>1.3</th>
                                        <td>Proposed start date</td>
                                        <td>{{date('d/m/Y',strtotime($data->risk_safety_form['prop_start']))}}</td>
                                    </tr>
                                    <tr>
                                        <th>1.4</th>
                                        <td>Proposed completion date</td>
                                        <td>{{date('d/m/Y',strtotime($data->risk_safety_form['prop_end']))}}</td>
                                    </tr>
                                    <tr>
                                        <th>1.5</th>
                                        <td>Measures / Activity</td>
                                        <td>{{$data->risk_safety_form['measure_activity']}}</td>
                                    </tr>
                                    @php
                                    $arr[] =$data->property->contract[0];
                                    $cons = $data->risk_safety_form['contractors_avail'];
                                             $arrs = array_values(array_filter($arr, function($item) use($cons){
                                                    return $item->contractor->id == $cons;
                                                }));
                                                if(sizeOf($arrs)){
                                                    $conts = $arrs[0];
                                                    $fname = $conts->contractor->firstname;
                                                    $lname = $conts->contractor->lastname;
                                                }else{
                                                    $fname = "Not";
                                                    $lname = "Available";
                                                }
                                    @endphp
                                    <tr>
                                        <th>1.6</th>
                                        <td>Contractors</td>
                                        <td>{{$fname.' '.$lname}}</td>
                                    </tr>
                                    <tr>
                                        <th>1.7</th>
                                        <td>RAMS</td>
                                        <td>{{$data->risk_safety_form['rams']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th style="width:3%;">2.0</th>
                                        <td colspan="2">Information on other activities taking place on site</td>
                                    </tr>
                                    <tr>
                                        <th>2.1</th>
                                        <td>The dwelling will remain occupied while the above works are on hand</td>
                                        <td style="width:5%;">{{$data->risk_safety_form['dwell_occu']}}</td>
                                    </tr>
                                    <tr>
                                        <th>2.2</th>
                                        <td>Other than 2.1 above will there be further activities on site while the above works are on hand</td>
                                        <td style="width:5%;">{{$data->risk_safety_form['further_activity']}}</td>
                                    </tr>
                                    @if($data->risk_safety_form['further_activity'] == "Yes")
                                    <tr>
                                        <th></th>
                                        <td>If Yes, list activities:</td>
                                        <td style="width:5%;">{{$data->risk_safety_form['list_activity']}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th style="width:3%;">3.0</th>
                                        <td colspan="2">Work related to the project which will involve Particular Risks or Safety Critical Risks</td>
                                    </tr>
                                    <tr>
                                        <th>3.1</th>
                                        <td>Having taken account of the Principles of Prevention, Particular / Safety Critical. Risks as listed on the attached Risk Register have been identified.</td>
                                        <td style="width:5%;">{{$data->risk_safety_form['having_taken']}}</td>
                                    </tr>
                    
                                </tbody>
                            </table>
                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th style="width:3%;">4.0</th>
                                        <td colspan="2">The basis upon which time was established</td>
                                    </tr>
                                    <tr>
                                        <th>4.1</th>
                                        <td>Project program time as noted under 1.03 above is estimated from other similar projects undertaken by the company with a similar allocation of resources. The estimated project time assumes reasonable weather conditions for the time of year and for continuity of access. We confirm that the works can be safely undertaken at this time.</td>
                                        <td style="width:5%;">{{$data->risk_safety_form['prog_time']}}</td>
                                    </tr>
                    
                                </tbody>
                            </table>
                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th style="width:3%;">5.0</th>
                                        <td colspan="2">Conclusions drawn by Designers and Project Supervisors as regards the taking account of the Principles of Prevention and any relevant Health and Safety Plan or Safety File.</td>
                                    </tr>
                                    <tr>
                                        <th>5.1</th>
                                        <td>After inquiry to the homeowner, we confirm that there is a Safety File / Safety Plan in respect of this dwelling.</td>
                                        <td style="width:5%;">{{$data->risk_safety_form['after_inquiry']}}</td>
                                    </tr>
                                    <tr>
                                        <th>5.2</th>
                                        <td>Following the taking account of the Principles of Prevention, Particular / Safety Critical Risks still remaining are noted in the attached Risk Register. These risks are noted by the PSCS in the Safety Plan and the Contractor has prepared a Risk Assessment Method Statement (RAMS) to provide for their safe execution. Collective protective measures should be provided as an absolute priority over individual protective measures. RAMS are attached.</td>
                                        <td style="width:5%;">{{$data->risk_safety_form['princy_prevent']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th style="width:3%;">6.0</th>
                                        <td>The location of electricity, water and sewage connection where appropriate to facilitate adequate welfare facilities</td>
                                    </tr>
                                    <tr>
                                        <th>6.1</th>
                                        <td>Works of short duration. No Welfare facilities provided. Do not use Homeowner facilities.</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class=" mb-2 table table-bordered" id="gen_dec2">
                                <tbody>
                                    <tr>
                                        <th style="width:3%;">7.0</th>
                                        <td colspan="2">Control Measures for Specific risks identified in 3.0 above</td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td><b>RISK</b></td>
                                        <td><b>CONTROL MEASURE</b></td>
                                    </tr>
                                    @php
                                    $decoded = [];
                                        if($data->risk_safety_form != null){
                                            $decoded = json_decode($data->risk_safety_form['risk_control'],TRUE);
                                        }
                                        $i = 1;
                                    @endphp
                                    @if(sizeOf($decoded))
                                  
                                    @foreach($decoded as $dkey => $dData)
                                    <tr>
                                        <th>7.{{$i++}}</th>
                                        <td>{{$dData['risk']}}</td>
                                        <td>{{$dData['control']}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    
                                </tbody>
                            </table>
                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th style="width:3%;">8.0</th>
                                        <td>Site Safety Rules.</td>
                                    </tr>
                                    <tr>
                                        <th>8.1</th>
                                        <td>No unauthorized entry to site allowed.</td>
                                    </tr>
                                    <tr>
                                        <th>8.2</th>
                                        <td>All general and craft workers and on-site security to have completed Safe Pass Training.</td>
                                    </tr>
                                    <tr>
                                        <th>8.3</th>
                                        <td>Appropriate PPE to be worn.</td>
                                    </tr>
                                    <tr>
                                        <th>8.4</th>
                                        <td>All work areas to be kept clean and tidy.</td>
                                    </tr>
                                    <tr>
                                        <th>8.5</th>
                                        <td>Access platforms erected and inspected by competent persons.</td>
                                    </tr>
                                    <tr>
                                        <th>8.6</th>
                                        <td>No Smoking on site or immediate vicinity.</td>
                                    </tr>
                                    <tr>
                                        <th>8.7</th>
                                        <td>Unauthorized access during and outside working hours / Define work zone/ Remove ladders and secure overnight.</td>
                                    </tr>
                                    <tr>
                                        <th>8.8</th>
                                        <td>Electrical connections by suitably qualified registered Electricians only.</td>
                                    </tr>
                                    <tr>
                                        <th>8.9</th>
                                        <td>Segregate Waste on site where possible and remove to main compound for disposal.</td>
                                    </tr>
                                    <tr>
                                        <th>8.10</th>
                                        <td>Maintain Safe access for Homeowner.</td>
                                    </tr>
                                    <tr>
                                        <th>8.11</th>
                                        <td>Noise and dust to be kept to a minimum and consideration to be given to the homeowner with regard to timing of noisy works.</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <table class=" mb-2 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th style="width:3%;">9.0</th>
                                        <td colspan="2">Emergency Contacts:</td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>{{$data->risk_safety_form['emmer_name']}}</td>
                                        <td>{{$data->risk_safety_form['emmer_contact']}}</td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>Emergency Services:</td>
                                        <td>999 / 112</td>
                                    </tr>
                                </tbody>
                            </table>
                            <span class="f12 mt-2 mb-2">Construction Stage Health and Safety Plan Prepared by:</span>
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
