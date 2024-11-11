@extends('layouts.dashboard.print')
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
        tbody, td, tfoot, th, thead, tr{
            border-style: none !important;
        }
        .text-info {
            color: #6c757d !important;
        }
        .bg-grasy .p-1{
            color: #333;
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
        tr td:not(:last-child), tr th:not(:last-child){
            border-right: 1px solid #eaf1ff !important;
        }
        tr td,tr th{
            border-bottom: 1px solid #eaf1ff !important;
        }
        .mytabls tr td:first-child{
            width: 80%;
        }
        .newtab1 tr td:not(:last-child),.newtab1 tr th:not(:last-child){
            width: 50%;
        }
        .newtab2 tr td:not(:last-child),.newtab2 tr th:not(:last-child){
            width: 33.33%;
        }
        h4,h3 {
            color: #1A47A3;
        }
        tr td, tr th{
            color: #333;
            font-size: 14px !important;
        }
        table thead tr th:first-child{
            border-top-left-radius: 0px !important;
        }
        table thead tr th:last-child{
            border-top-right-radius: 0px !important;
        }
        ul#marks > .marks::marker {
        color: #1A47A3 !important;
        font-size: 1.5em !important;
        list-style-type: disc !important !important;
        }
        .bg-grasy{
            border-radius: 0px !important;
            font-size: 12px !important;
        }
        .f14 {
            font-size: 14px !important;
        }
        .f12 {
            font-size: 12px !important;
        }
        table th,
        table td {
            padding: 1px 8px !important;
            color: #333 !important;
            font-size: 12px !important;
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
                            </div>
                            <h6 class="main-header-date my-0">{{ date('d/m/Y', strtotime($data['date_inspected'])) }}</h6>
                        </div>

                        <div>
                            <img src="{{ asset('assets/images/new_logo.svg') }}" class="main-logo img-fluid">
                        </div>
                    </div>
                    <div style="border: 1px solid #e0e9fc;">

                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">Risk Assessment</h3>
                        <div class="col-md-12 mb-1">
                            <div class="bg-grasy">
                                <div class="ml-2 f12">Detail the key hazards and risks associated with your proposed activities on this project. Append specific risk assessments where required.</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class=" mb-1 table table-bordered newtab1">
                                <tbody>
                                    <tr>
                                        <th><b>Project Name</b></th>
                                        <td>{{$data->rams_core_ventilation['p_name'] != null && $data->rams_core_ventilation['p_name'] != '' ? $data->rams_core_ventilation['p_name'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Project Id</b></th>
                                        <td>{{$data->rams_core_ventilation['project_id'] != null && $data->rams_core_ventilation['project_id'] != '' ? $data->rams_core_ventilation['project_id'] : "N/A"}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @php
                            $hazardMeasure = [];
                            if($data->rams_core_ventilation['measure_hazard'] != null && sizeOf(json_decode($data->rams_core_ventilation['measure_hazard'],TRUE))){
                            $hazardMeasureM = json_decode($data->rams_core_ventilation['measure_hazard'],TRUE);
                            $hazardMeasure = array();
                            foreach ($hazardMeasureM as $element) {
                                $hazardMeasure[$element['activity']][] = $element;
                            }
                            }
                            // dd($hazardMeasure);
                        @endphp
                        @foreach($hazardMeasure as $key => $hazardV)

                            <div class="col-md-12">
                                <table class=" mb-1 table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="9" style="text-align: center;">{{$key}}</th>
                                        </tr>
                                        <tr>
                                            <th style="width: 15% !important;">Hazard</th>
                                            <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Likelihood</th>
                                            <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Severity</th>
                                            <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Risk</th>
                                            <th style="width: 10% !important;">Who Might be harmed</th>
                                            <th style="width: 15% !important;">Existing control measures</th>
                                            <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Likelihood</th>
                                            <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Severity</th>
                                            <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Risk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hazardV as $hazard)
                                       <tr>
                                        <th>{{$hazard['hazard'] != '' && $hazard['hazard'] != null ? $hazard['hazard'] : "N/A"}}</th>
                                        <th>{{$hazard['liklihood'] != '' && $hazard['liklihood'] != null ? $hazard['liklihood'] : "N/A"}}</th>
                                        <th>{{$hazard['severity'] != '' && $hazard['severity'] != null ? $hazard['severity'] : "N/A"}}</th>
                                        <th>{{$hazard['risk'] != '' && $hazard['risk'] != null ? $hazard['risk'] : "N/A"}}</th>
                                        <th>{{$hazard['who_might'] != '' && $hazard['who_might'] != null ? $hazard['who_might'] : "N/A"}}</th>
                                        <th>
                                            {{$hazard['existing_control'] != '' && $hazard['existing_control'] != null ? $hazard['existing_control'] : "N/A"}}
                                        </th>
                                        <th>{{$hazard['with_liklyhood'] != '' && $hazard['with_liklyhood'] != null ? $hazard['with_liklyhood'] : "N/A"}}</th>
                                        <th>{{$hazard['with_severity'] != '' && $hazard['with_severity'] != null ? $hazard['with_severity'] : "N/A"}}</th>
                                        <th>{{$hazard['with_risk'] != '' && $hazard['with_risk'] != null ? $hazard['with_risk'] : "N/A"}}</th>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @endforeach
                        {{-- <div class="col-md-12">
                            <table class=" mb-1 table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="9" style="text-align: center;">Use of power tools</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 15% !important;">Hazard</th>
                                        <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Likelihood</th>
                                        <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Severity</th>
                                        <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Risk</th>
                                        <th style="width: 10% !important;">Who Might be harmed</th>
                                        <th style="width: 15% !important;">Existing control measures</th>
                                        <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Likelihood</th>
                                        <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Severity</th>
                                        <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Risk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                   </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <table class=" mb-1 table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="9" style="text-align: center;">EWI/Render</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 15% !important;">Hazard</th>
                                        <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Likelihood</th>
                                        <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Severity</th>
                                        <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Risk</th>
                                        <th style="width: 10% !important;">Who Might be harmed</th>
                                        <th style="width: 15% !important;">Existing control measures</th>
                                        <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Likelihood</th>
                                        <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Severity</th>
                                        <th style="color: #333 !important;background-color:#fff !important;width:10% !important;">Risk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                   </tr>
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">1. PROJECT DETAILS</h3>
                        <div class="col-md-12">
                                <table class=" mb-1 table table-bordered newtab1">
                                    <tbody>
                                        <tr>
                                            <th><b>Project Name</b></th>
                                            <td>{{$data->rams_core_ventilation['p_name'] != '' && $data->rams_core_ventilation['p_name'] != null ? $data->rams_core_ventilation['p_name'] : "N/A"}}</td>
                                        </tr>
                                        <tr>
                                            <th><b>Brief description of activity</b></th>
                                            <td>{{$data->rams_core_ventilation['desc_activity'] != '' && $data->rams_core_ventilation['desc_activity'] != null ? $data->rams_core_ventilation['desc_activity'] : "N/A"}}</td>
                                        </tr>
                                        <tr>
                                            <th><b>Site Location</b></th>
                                            <td>{{$data->rams_core_ventilation['site_location'] != '' && $data->rams_core_ventilation['site_location'] != null ? $data->rams_core_ventilation['site_location'] : "N/A"}}</td>
                                        </tr>
                                        <tr>
                                            <th><b>Duration of Works</b></th>
                                            <td>{{$data->rams_core_ventilation['work_duration'] != '' && $data->rams_core_ventilation['work_duration'] != null ? $data->rams_core_ventilation['work_duration'] : "N/A"}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                        <div class="col-md-12">
                                <table class=" mb-1 table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th><b>Project manager</b></th>
                                            <td>{{$data->rams_core_ventilation['proj_manager'] != '' && $data->rams_core_ventilation['proj_manager'] != null ? $data->rams_core_ventilation['proj_manager'] : "N/A"}}</td>
                                            <th><b>Contact Number</b></th>
                                            <td>{{$data->rams_core_ventilation['proj_contact'] != '' && $data->rams_core_ventilation['proj_contact'] != null ? $data->rams_core_ventilation['proj_contact'] : "N/A"}}</td>
                                        </tr>
                                        <tr>
                                            <th><b>Site supervisor</b></th>
                                            <td>{{$data->rams_core_ventilation['site_supervisor'] != '' && $data->rams_core_ventilation['site_supervisor'] != null ? $data->rams_core_ventilation['site_supervisor'] : "N/A"}}</td>
                                            <th><b>Contact Number</b></th>
                                            <td>{{$data->rams_core_ventilation['site_contact'] != '' && $data->rams_core_ventilation['site_contact'] != null ? $data->rams_core_ventilation['site_contact'] : "N/A"}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                        <div class="col-md-12">
                                <table class=" mb-1 table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>RAMS Ref No.</th>
                                            <th>Rev No.</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(sizeOf(json_decode($data->rams_core_ventilation['rams_ref_no'])))
                                        @foreach(json_decode($data->rams_core_ventilation['rams_ref_no']) as $rams_ref_no)
                                        <tr>
                                            <td>{{$rams_ref_no->rams_ref != '' && $rams_ref_no->rams_ref != null ? $rams_ref_no->rams_ref : "N/A"}}</td>
                                            <td>{{$rams_ref_no->rev_no != '' && $rams_ref_no->rev_no != null ? $rams_ref_no->rev_no : "N/A"}}</td>
                                            <td>{{$rams_ref_no->date != '' && $rams_ref_no->date != null ? date('d/m/Y',strtotime($rams_ref_no->date)) : "N/A"}}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">2. Personnel and Equipment Details</h3>
                        <div class="col-md-12">
                                    <table class=" mb-1 table table-bordered newtab1">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Personnel involved</th>
                                            </tr>
                                            <tr>
                                                <td><b>Name</b></td>
                                                <td><b>Role/Trade</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(sizeOf(json_decode($data->rams_core_ventilation['person_involve'])))
                                            @foreach(json_decode($data->rams_core_ventilation['person_involve']) as $person_involve)
                                            <tr>
                                                <td>{{$person_involve->name != '' && $person_involve->name != null ? $person_involve->name : "N/A"}}</td>
                                                <td>{{$person_involve->role != '' && $person_involve->role != null ? $person_involve->role : "N/A"}}</td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                        </div>
                        <div class="col-md-12">
                                    <table class=" mb-1 table table-bordered newtab2">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Subcontractors to be used</th>
                                            </tr>
                                            <tr>
                                                <td><b>Company name</b></td>
                                                <td><b>Employee Name</b></td>
                                                <td><b>Role/Trade</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(sizeOf(json_decode($data->rams_core_ventilation['subcontractor_data'])))
                                            @foreach(json_decode($data->rams_core_ventilation['subcontractor_data']) as $subcontractor_data)
                                            <tr>
                                                <td>{{$subcontractor_data->company_name !='' && $subcontractor_data->company_name ? $subcontractor_data->company_name : "N/A"}}</td>
                                                <td>{{$subcontractor_data->employee_name !='' && $subcontractor_data->employee_name ? $subcontractor_data->employee_name : "N/A"}}</td>
                                                <td>{{$subcontractor_data->role !='' && $subcontractor_data->role ? $subcontractor_data->role : "N/A"}}</td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                        </div>
                        <div class="col-md-12">
                                <table class=" mb-1 table table-bordered newtab1">
                                        <tbody>
                                            <tr>
                                                <th><b>Site specific training requirements</b></th>
                                                <td>{{$data->rams_core_ventilation['training_require'] != '' && $data->rams_core_ventilation['training_require'] != null ? $data->rams_core_ventilation['training_require'] : "N/A"}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Other site-specific requirements e.g. permits etc</b></th>
                                                <td>{{$data->rams_core_ventilation['other_spec_require'] != '' && $data->rams_core_ventilation['other_spec_require'] != null ? $data->rams_core_ventilation['other_spec_require'] : "N/A"}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Key Plant and equipment</b></th>
                                                <td>{{$data->rams_core_ventilation['key_plant'] != '' && $data->rams_core_ventilation['key_plant'] != null ? $data->rams_core_ventilation['key_plant'] : "N/A"}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Key materials</b></th>
                                                <td>{{$data->rams_core_ventilation['key_material'] != '' && $data->rams_core_ventilation['key_material'] != null ? $data->rams_core_ventilation['key_material'] : "N/A"}}</td>
                                            </tr>
                                        </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">3. Personal Protective Equipment (tick as appropriate)</h3>
                        @php
                            $arr = [];
                            $arr = explode(',',$data->rams_core_ventilation['pp_equipment'])
                        @endphp
                        <div class="row d-flex justify-content-start" style="page-break-inside: avoid !important;">
                            @for($i = 1; $i <=7 ; $i++)
                            <div class="col mt-1 mb-1 pe-0" style="position:relative;pointer-events:none;max-width: max-content;height: max-content;">
                                <div style="border: 1px solid #333; border-radius: 3px;width:92px;height:92px; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 0px 10px;">
                                    <input type="checkbox" class="inputcheck" id="inputcheck_{{$i}}" name="inputcheck" style="position: absolute;top: 5px;left: 17px;accent-color: #1A47A3;"
                                    @if(in_array($i, $arr)) checked @endif/>
                                    <img src="{{asset('assets/images/rams/equip/'.$i.'.svg')}}"  alt=""
                                    style="width:60px;height:60px;"/>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <div class="col-md-12">
                            <table class=" mt-1 mb-2 table table-bordered newtab1">
                                <tbody>
                                    <tr>
                                        <th><b>Other PPR requirements</b></th>
                                        <td>{{$data->rams_core_ventilation['other_pp_require'] != '' && $data->rams_core_ventilation['other_pp_require'] != null ? $data->rams_core_ventilation['other_pp_require'] : "N/A"}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">4. Emergency Arrangements</h3>
                        <div class="col-md-12 mb-2">
                            <table class=" mb-1 table table-bordered newtab1">
                                <tbody>
                                    <tr>
                                        <th><b>Emergency Procedure</b></th>
                                        <td>{{$data->rams_core_ventilation['emergency_procedure'] != '' && $data->rams_core_ventilation['emergency_procedure'] != null ? $data->rams_core_ventilation['emergency_procedure'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Location of Assembly point</b></th>
                                        <td>{{$data->rams_core_ventilation['assembly_location'] != '' && $data->rams_core_ventilation['assembly_location'] != null ? $data->rams_core_ventilation['assembly_location'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>On-site first aider(s)</b></th>
                                        <td>{{$data->rams_core_ventilation['first_aider'] != '' && $data->rams_core_ventilation['first_aider'] != null ? $data->rams_core_ventilation['first_aider'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>First aid box location</b></th>
                                        <td>{{$data->rams_core_ventilation['first_aid_box'] != '' && $data->rams_core_ventilation['first_aid_box'] != null ? $data->rams_core_ventilation['first_aid_box'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Location of nearest hospital</b></th>
                                        <td>{{$data->rams_core_ventilation['hospital_location'] != '' && $data->rams_core_ventilation['hospital_location'] != null ? $data->rams_core_ventilation['hospital_location'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Location of fire extinguisher</b></th>
                                        <td>{{$data->rams_core_ventilation['fire_exsting_location'] != '' && $data->rams_core_ventilation['fire_exsting_location'] != null ? $data->rams_core_ventilation['fire_exsting_location'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Emergency contact details</b></th>
                                        <td>{{$data->rams_core_ventilation['emergency_contact'] != '' && $data->rams_core_ventilation['emergency_contact'] != null ? $data->rams_core_ventilation['emergency_contact'] : "N/A"}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">5. Personal Protective Equipment (tick as appropriate)</h3>
                        @php
                            $arr = [];
                            $arr = explode(',',$data->rams_core_ventilation['hazard_substance'])
                        @endphp
                        <div class="row d-flex justify-content-start" style="page-break-inside: avoid !important;">
                            @for($i = 1; $i <=9 ; $i++)
                            <div class="col mt-1 mb-1 pe-0" style="position:relative;pointer-events:none;max-width: max-content;height: max-content;">
                                <div style="border: 1px solid #333; border-radius: 3px;width:133px;height:133px; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 0px 10px;">


                                    <input type="checkbox" class="inputcheck" id="inputcheck_{{$i}}" name="inputcheck" style="position: absolute;top: 5px;left: 17px;accent-color: #1A47A3;"
                                    @if(in_array($i, $arr)) checked @endif/>
                                        <img src="{{asset('assets/images/rams/hazard/'.$i.'.svg')}}"  alt="" style="width:62px;height:62px;margin-bottom:12px;"/>
                                        <span class="f12" style="text-align:center;">@if($i == 1) Harmful/Irritant @elseif($i == 2) Very Toxic @elseif($i == 3) Corrosive @elseif($i == 4) Oxidising
                                    @elseif($i == 5) Highly <br> Flammable @elseif($i == 6) Harmful/Irritant @elseif($i == 7) Explosive @elseif($i == 8) Compressed gas @elseif($i == 9) Hazardous to </br> environment @endif</span>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <div class="col-md-12 mb-2">
                            <table class=" mt-1 mb-2 table table-bordered newtab1">
                                <tbody>
                                    <tr>
                                        <th><b>Details of SDS on file/available</b></th>
                                        <td>{{$data->rams_core_ventilation['sds_deail'] != '' && $data->rams_core_ventilation['sds_deail'] != null ? $data->rams_core_ventilation['sds_deail'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Chemical storage arrangements</b></th>
                                        <td>{{$data->rams_core_ventilation['chemical_storage'] != '' && $data->rams_core_ventilation['chemical_storage'] != null ? $data->rams_core_ventilation['chemical_storage'] : "N/A"}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">6. On-Site Arrangements</h3>
                        <div class="col-md-12 mb-2">
                            <table class=" mb-1 table table-bordered newtab1">
                                <tbody>
                                    <tr>
                                        <th><b>Access/egress arrangements from site</b></th>
                                        <td>{{$data->rams_core_ventilation['site_access'] != '' && $data->rams_core_ventilation['site_access'] != null ? $data->rams_core_ventilation['site_access'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Welfare arrangements</b></th>
                                        <td>{{$data->rams_core_ventilation['welfare_arrange'] != '' && $data->rams_core_ventilation['welfare_arrange'] != null ? $data->rams_core_ventilation['welfare_arrange'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Deliveries/parking arrangements</b></th>
                                        <td>{{$data->rams_core_ventilation['parking_arrange'] != '' && $data->rams_core_ventilation['parking_arrange'] != null ? $data->rams_core_ventilation['parking_arrange'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Set down/storage arrangements</b></th>
                                        <td>{{$data->rams_core_ventilation['storage_arrange'] != '' && $data->rams_core_ventilation['storage_arrange'] != null ? $data->rams_core_ventilation['storage_arrange'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Site times (working hours)</b></th>
                                        <td>{{$data->rams_core_ventilation['site_times'] != '' && $data->rams_core_ventilation['site_times'] != null ? $data->rams_core_ventilation['site_times'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Waste management arrangements</b></th>
                                        <td>{{$data->rams_core_ventilation['waste_arrange'] != '' && $data->rams_core_ventilation['waste_arrange'] != null ? $data->rams_core_ventilation['waste_arrange'] : "N/A"}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">7. Site Safety Rules</h3>
                        <div class="col-md-12 mb-2">
                            <div class="bg-grasy">
                                @if($data['fk_forms_id'] == 56 || $data['fk_forms_id'] == 59)
                                <div class="ml-2">1. Assess work area and cordon off.</div>
                                <div class="ml-2">2. Access platforms to be erected/inspected by competent persons, secure footing.</div>
                                <div class="ml-2">3. Assess wall inside and out prior to coring avoiding any electrical cables/utility pipes.</div>
                                <div class="ml-2">4. Inform homeowners re noise and dust and re possible impacts on pets.</div>
                                <div class="ml-2">5. Noise and dust control and advise other workers in vicinity if applicable.</div>
                                <div class="ml-2">6. Appropriate PPE.</div>
                                <div class="ml-2">7. Clean and bag waste and remove off site at end of day.</div>
                                <div class="ml-2">8. Inform homeowners of areas being worked on and to keep away from work areas.</div>
                                <div class="ml-2">9. Working at height areas to be secured.</div>
                                <div class="ml-2">10. Wear appropriate PPE to tasks being performed.</div>
                                @elseif($data['fk_forms_id'] == 58 || $data['fk_forms_id'] == 60)
                                <div class="ml-2">1. Install proper access to work areas.</div>
                                <div class="ml-2">2. Access platforms to be erected/inspected by competent persons.</div>
                                <div class="ml-2">3. No unauthorised access during and outside work hours.</div>
                                <div class="ml-2">4. Stack and store materials securely and remove all loose/small items at end of each day.</div>
                                <div class="ml-2">5. Electrical fittings to be removed and relocated by qualified electrical contractor.</div>
                                <div class="ml-2">6. Noise and dust control.</div>
                                <div class="ml-2">7. Clean and store/bag waste and remove to main compound regularly.</div>
                                <div class="ml-2">8. Inform homeowners of areas being worked on and keep away from work areas, but maintain access.</div>
                                <div class="ml-2">9. Barrier off work areas for wet works/work at height.</div>
                                <div class="ml-2">10. Wear appropriate PPE to tasks being performed.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">8. Detailed Description and Sequence of Proposed Works</h3>
                        <div class="col-md-12 mb-2">
                            <div class="bg-grasy">
                                @if($data['fk_forms_id'] == 56 || $data['fk_forms_id'] == 59)
                                <div class="ml-2">1. Identify works to HO and agree sequence/areas of work/areas to be barriered off as required. Advise re trailing cables and hoses.</div>
                                <div class="ml-2">2. Mark area for core and ensure no cables /pipes present. Note location of Lintols also.</div>
                                <div class="ml-2">3. Set up access platforms as required by competent persons.</div>
                                <div class="ml-2">4. Drill pilot/fixing holes and mount core drill.</div>
                                <div class="ml-2">5. Drill Main Core.</div>
                                <div class="ml-2">6. Remove cored material and remove core drill and fixings.</div>
                                <div class="ml-2">7. Clean and bag all waste/debris for removal off site.</div>
                                <div class="ml-2">8. Remove access and barriers and leave area clean.</div>
                                <div class="ml-2">9. Electrical work by electrician only.</div>
                                @elseif($data['fk_forms_id'] == 58 || $data['fk_forms_id'] == 60)
                                <div class="ml-2">1. Identity works to HO and agree sequence/areas of work/areas to be barriered off as required.</div>
                                <div class="ml-2">2. Remove fixtures from external walls to facilitate installation of insulation boards.</div>
                                <div class="ml-2">3. Electrical items removed by electrician.</div>
                                <div class="ml-2">4. Cut back existing cills as necessary.</div>
                                <div class="ml-2">5. Fix insulated panels as per suppliers instructions, including drilling for fixings.</div>
                                <div class="ml-2">6. Core for vents as required, timing to minimise noise disturbance.</div>
                                <div class="ml-2">7. Apply render in layers as per suppliers instructions.</div>
                                <div class="ml-2">8. Fit vent fittings and secure.</div>
                                <div class="ml-2">9. Replace external fixtures, electrical items by electrician only.</div>
                                <div class="ml-2">10. Clean all waste/debris from site to main compound for disposal Iregulari.</div>
                                <div class="ml-2">11. Draughtproofing as required.</div>
                                <div class="ml-2">12. Remove access platforms/barriers and clean site.</div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">9. Specific Identified Hazards</h3>
                        <div class="col-md-12 mb-2">
                            <div class="bg-grasy">
                                @if($data['fk_forms_id'] == 56 || $data['fk_forms_id'] == 59)
                                <div class="ml-2">1. Falling from height-high level cores.</div>
                                <div class="ml-2">2. Asbestos-older construction, presence possible but not confirmed. Awareness.</div>
                                <div class="ml-2">3. Occupied dwelling, noise, dust, trip hazards, work overhead, trailing cables, disruption to access and services.</div>
                                <div class="ml-2">4. Noise and impact on pets.</div>
                                <div class="ml-2">5. Electrical-overhead cables-external fittings(lights etc)-meter cabinet.</div>
                                @elseif($data['fk_forms_id'] == 58 || $data['fk_forms_id'] == 60)
                                <div class="ml-2">1. Falling from height-installing EWI/vender/fitting vents.</div>
                                <div class="ml-2">2. Asbestos-older construction, presence possible but not confirmed, Awareness.</div>
                                <div class="ml-2">3. Occupied dwelling, noise, dust, trip hazards, work overhead, trailing cables, disruption to acress and services.</div>
                                <div class="ml-2">4. Work in aftict, access/egress.</div>
                                <div class="ml-2">5. Noise.</div>
                                <div class="ml-2">6. Electrical-overhead cables-external finingslights etc-meter cabinet.</div>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">Approval</h3>
                        <div class="col-md-12 mb-2">
                            <table class=" mb-1 table table-bordered">
                                <tbody>
                                    <tr>
                                        <th><b>Prepared By</b></th>
                                        <td>{{$data->rams_core_ventilation['appr_prep_by'] != '' && $data->rams_core_ventilation['appr_prep_by'] != null ? $data->rams_core_ventilation['appr_prep_by'] : "N/A"}}</td>
                                        <th><b>Position</b></th>
                                        <td>{{$data->rams_core_ventilation['appr_prep_position'] != '' && $data->rams_core_ventilation['appr_prep_position'] != null ? $data->rams_core_ventilation['appr_prep_position'] : "N/A"}}</td>
                                        <th><b>Date</b></th>
                                        <td>{{$data->rams_core_ventilation['appr_prep_date'] != '' && $data->rams_core_ventilation['appr_prep_date'] != null ? date('d/m/Y',strtotime($data->rams_core_ventilation['appr_prep_date'])) : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Approved By</b></th>
                                        <td>{{$data->rams_core_ventilation['appr_aprove_by'] != '' && $data->rams_core_ventilation['appr_aprove_by'] != null ? $data->rams_core_ventilation['appr_aprove_by'] : "N/A"}}</td>
                                        <th><b>Position</b></th>
                                        <td>{{$data->rams_core_ventilation['appr_aprove_position'] != '' && $data->rams_core_ventilation['appr_aprove_position'] != null ? $data->rams_core_ventilation['appr_aprove_position'] : "N/A"}}</td>
                                        <th><b>Date</b></th>
                                        <td>{{$data->rams_core_ventilation['appr_aprove_date'] != '' && $data->rams_core_ventilation['appr_aprove_date'] != null ? date('d/m/Y',strtotime($data->rams_core_ventilation['appr_aprove_date'])) : "N/A"}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">Communication and Sign Off</h3>
                        <div class="col-md-12 mb-2">
                            <div class="bg-grasy">
                                <div class="ml-2">We (the undersigned) understand the method statement and risk assessment and agree to comply with the specified requirements and control measures.
                                    We have been afforded an opportunity to make comments on the agreed methodology. If the work activity changes or deviates from that originally envisaged,
                                    we will seek further advice and request an amended risk assessment and method statement, as necessary.</div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <table class=" mb-1 table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Signature</th>
                                        <th>Company</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(sizeOf(json_decode($data->rams_core_ventilation['communi_signoff'])))
                                        @foreach (json_decode($data->rams_core_ventilation['communi_signoff']) as $communi_signoff)
                                            <tr>
                                                <td>{{$communi_signoff->name != '' && $communi_signoff->name != null ? $communi_signoff->name : "N/A"}}</td>
                                                <td>
                                                    @if($communi_signoff->signature != '' && $communi_signoff->signature != null)
                                                        <img class="m-0 img-fluid bg-grasy1" style="width: 50px;height:50px;" src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $communi_signoff->signature) }}">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{$communi_signoff->company != '' && $communi_signoff->company != null ? $communi_signoff->company : "N/A"}}</td>
                                                <td>{{$communi_signoff->date != '' && $communi_signoff->date != null ? date('d/m/Y',strtotime($communi_signoff->date)) : "N/A"}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="cm my-1">
                        <h3 class="text-theme f14 mb-1 mt-0">Appendices</h3>
                        <div class="col-md-12 mb-2">
                            <table class=" mb-1 table table-bordered mytabls">
                                <thead>
                                    <tr>
                                        <th>Items attached</th>
                                        <th>Response</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sketches/drawings</td>
                                        <td>{{$data->rams_core_ventilation['appn_sketch'] != '' && $data->rams_core_ventilation['appn_sketch'] != null ? $data->rams_core_ventilation['appn_sketch'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <td>Plant and equipment certification</td>
                                        <td>{{$data->rams_core_ventilation['appn_plant_equip'] != '' && $data->rams_core_ventilation['appn_plant_equip'] != null ? $data->rams_core_ventilation['appn_plant_equip'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <td>Programme of work</td>
                                        <td>{{$data->rams_core_ventilation['appn_prog_work'] != '' && $data->rams_core_ventilation['appn_prog_work'] != null ? $data->rams_core_ventilation['appn_prog_work'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <td>Training records</td>
                                        <td>{{$data->rams_core_ventilation['appn_training'] != '' && $data->rams_core_ventilation['appn_training'] != null ? $data->rams_core_ventilation['appn_training'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <td>Permits</td>
                                        <td>{{$data->rams_core_ventilation['appn_permit'] != '' && $data->rams_core_ventilation['appn_permit'] != null ? $data->rams_core_ventilation['appn_permit'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <td>Safety data sheets (SDS)</td>
                                        <td>{{$data->rams_core_ventilation['appn_sds'] != '' && $data->rams_core_ventilation['appn_sds'] != null ? $data->rams_core_ventilation['appn_sds'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <td>Specific risk assessments</td>
                                        <td>{{$data->rams_core_ventilation['appn_specific_risk'] != '' && $data->rams_core_ventilation['appn_specific_risk'] != null ? $data->rams_core_ventilation['appn_specific_risk'] : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <td>Other (specify)</td>
                                        <td>{{$data->rams_core_ventilation['appn_other'] != '' && $data->rams_core_ventilation['appn_other'] != null ? $data->rams_core_ventilation['appn_other'] : "N/A"}}</td>
                                    </tr>
                                    @if($data->rams_core_ventilation['appn_other_text'] != '' && $data->rams_core_ventilation['appn_other_text'] != null)
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>{{$data->rams_core_ventilation['appn_other_text'] != '' && $data->rams_core_ventilation['appn_other_text'] != null ? $data->rams_core_ventilation['appn_other_text'] : "N/A"}}</td>
                                    </tr>
                                    @endif
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
            </div>
        </div>
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rows = document.querySelectorAll('tr');

            rows.forEach(function(row) {
                // Check if the second td exists and is empty
                var secondTd = row.querySelector('td:nth-child(2)');
                console.log(secondTd);
                if (secondTd && secondTd.textContent.trim() === '') {
                    // If empty, hide the entire tr
                    row.classList.add('d-none');
                }
            });
        });
    </script> --}}
@endsection
