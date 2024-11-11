@extends('layouts.dashboard.app')
@section('content')
    <style>
        .mybody {
            background-color: #eaf1ff !important;
        }
        .addriskControll{
            border: 1px dashed #1A47A3;
            width: 100%;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            font-weight: 600;
            border-radius: 5px;
        }
        input[type="radio"]:checked,input[type="radio"] {
        accent-color: #1A47A3;
        margin-right: 8px;
        }
        .updateSafty,.updateSafty:hover{
            background: #1A47A3;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 8px 20px;
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
            width: 50%;
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
    </style>
    <div class="col-md-12 mt-3 d-flex justify-content-between">
        <a href="{{ url('/dashboard/property/report/'.$data['id'].'/'.$data['fk_forms_id'].'/view') }}">
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
                            <div class="d-flex align-items-end mt-2">
                                <h1 class=" my-0">CONSTRUCTION STAGE
                                    SAFETY & HEALTH PLAN</h1>
                                    {{-- <div class="lead ml-2">(Safty)</div> --}}
                            </div>
                            <h2 class="my-0">{{date('d/m/Y',strtotime($data['date_inspected']))}}</h2>
                        </div>

                        <div class= "py-1 px-2">
                            <img src="{{ asset('assets/images/new_logo.svg') }}" class="img-fluid"
                            style="width: 200px">
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-3 d-grid brright">
                            <span class="f20 mt-1 mb-1 text-black"><b>Client: </b></span>
                            <span
                                class="f16 mt-1 mb-1">{{$data['name']}}</span>
                        </div>
                        <div class="col-9 d-grid">
                            <span class="f20 mt-1 mb-1 text-black"><b>Address: </b></span>
                            <span
                                class="f16 mt-1 mb-1">{{$data->risk_safety_form['p_address']}}</span>
                        </div>
                    </div>
                    <div style="border: 1px solid #e0e9fc;">

                    </div>
                    <form action="{{route('safetyHealthUpdate')}}" method="POST">
                        @csrf
                    <div class="row px-2">
                        <div class="col-md-12 mt-2 mb-2 card" style="border-radius: 10px;border: 1px solid #1A47A3;">
                            <span class="mt-3 mb-3">The Safety & Health Plan has been prepared in accordance with the Safety Health and Welfare at Work (Construction) Regulations 2013 and is based on project information available at this time.</span>
                        </div>
                        
                        <input type="hidden" name="id" value="{{$data->risk_safety_form['id']}}">
                            <table class=" mb-3 table table-bordered">
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
                                        <td><input type="date" class="form-control" name="p_date" id="p_date" value="{{date('Y-m-d',strtotime($data->risk_safety_form['p_date']))}}"></td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class=" mb-3 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>1.0</th>
                                        <td colspan="2">General description of the project:</td>
                                    </tr>
                                    <tr>
                                        <th>1.1</th>
                                        <td>Description of site / property:</td>
                                        <td><select name="desc_site" id="desc_site" class="form-control">
                                        <option value="Detached" @if($data->risk_safety_form['desc_site'] == "Detached") selected @endif>Detached</option>    
                                        <option value="Semi-detached" @if($data->risk_safety_form['desc_site'] == "Semi-detached") selected @endif>Semi-detached</option>    
                                        <option value="Terraced" @if($data->risk_safety_form['desc_site'] == "Terraced") selected @endif>Terraced</option>    
                                        <option value="Bungalow" @if($data->risk_safety_form['desc_site'] == "Bungalow") selected @endif>Bungalow</option>    
                                        <option value="Two Story" @if($data->risk_safety_form['desc_site'] == "Two Story") selected @endif>Two Story</option>    
                                        <option value="Dormer" @if($data->risk_safety_form['desc_site'] == "Dormer") selected @endif>Dormer</option>   
                                        <option value="Story & Half" @if($data->risk_safety_form['desc_site'] == "Story & Half") selected @endif>Story & Half</option>   
                                        <option value="Other" @if($data->risk_safety_form['desc_site'] == "Other") selected @endif>Other</option>   
                                        </select>
                                        <input type="text" name="desc_site_other" id="desc_site_other" class="form-control mt-2 @if($data->risk_safety_form['desc_site'] != "Other") d-none @endif" value="{{$data->risk_safety_form['desc_site_other']}}">
                                    </td>
                                    </tr>
                                    <tr>
                                        <th>1.2</th>
                                        <td>General description of the works:</td>
                                        <td><input type="text" class="form-control" name="work_desc" id="work_desc" value="{{$data->risk_safety_form['work_desc']}}">
                                            </td>
                                    </tr>
                                    <tr>
                                        <th>1.3</th>
                                        <td>Proposed start date</td>
                                        <td><input type="date" class="form-control" name="prop_start" id="prop_start" value="{{date('Y-m-d',strtotime($data->risk_safety_form['prop_start']))}}"></td>
                                    </tr>
                                    <tr>
                                        <th>1.4</th>
                                        <td>Proposed completion date</td>
                                        <td><input type="date" class="form-control" name="prop_end" id="prop_end" value="{{date('Y-m-d',strtotime($data->risk_safety_form['prop_end']))}}"></td>
                                    </tr>
                                    {{-- @php
                                        dd($data->property->measures);
                                    @endphp --}}
                                    <tr>
                                        <th>1.5</th>
                                        <td>Measures / Activity</td>
                                        <td>
                                            <select name="measure_activity" id="measure_activity" class="form-control">
                                                @if(sizeOf($data->property->measures))
                                                @foreach($data->property->measures as $mkey => $measure)
                                                <option value="{{$measure['job_lookup']['title']}}" @if($data->risk_safety_form['measure_activity'] == $measure['job_lookup']['title']) selected @endif>{{$measure['job_lookup']['title']}}</option> 
                                                @endforeach
                                                @endif
                                                {{-- <option value="Open" @if($data->risk_safety_form['measure_activity'] == "Open") selected @endif>Open</option> 
                                                <option value="Closed" @if($data->risk_safety_form['measure_activity'] == "Closed") selected @endif>Closed</option>     --}}
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>1.6</th>
                                        <td>Contractors</td>
                                        <td>
                                            <select name="contractors_avail" id="contractors_avail" class="form-control">
                                                @if(sizeOf($contractors))
                                                @foreach($contractors as $mkey => $contractor)
                                                <option value="{{$contractor->contractor->id}}" @if($data->risk_safety_form['contractors_avail'] == $contractor->contractor->id) selected @endif>{{$contractor->contractor->firstname.' '.$contractor->contractor->lastname}}</option>    
                                                @endforeach
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>1.7</th>
                                        <td>RAMS</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <label class="radio-inline">
                                                    <input type="radio" value="Yes" name="rams" @if($data->risk_safety_form['rams'] == "Yes") checked @endif>Yes
                                                  </label>
                                                  <label class="radio-inline">
                                                    <input type="radio" value="No" name="rams" @if($data->risk_safety_form['rams'] == "No") checked @endif>No
                                                  </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class=" mb-3 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>2.0</th>
                                        <td colspan="2">Information on other activities taking place on site</td>
                                    </tr>
                                    <tr>
                                        <th>2.1</th>
                                        <td>The dwelling will remain occupied while the above works are on hand</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <label class="radio-inline">
                                                    <input type="radio" value="Yes" name="dwell_occu" @if($data->risk_safety_form['dwell_occu'] == "Yes") checked @endif>Yes
                                                  </label>
                                                  <label class="radio-inline">
                                                    <input type="radio" value="No" name="dwell_occu" @if($data->risk_safety_form['dwell_occu'] == "No") checked @endif>No
                                                  </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>2.2</th>
                                        <td>Other than 2.1 above will there be further activities on site while the above works are on hand</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <label class="radio-inline">
                                                    <input type="radio" value="Yes" name="further_activity" @if($data->risk_safety_form['further_activity'] == "Yes") checked @endif>Yes
                                                  </label>
                                                  <label class="radio-inline">
                                                    <input type="radio" value="No" name="further_activity" @if($data->risk_safety_form['further_activity'] == "No") checked @endif>No
                                                  </label>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- @if($data->risk_safety_form['further_activity'] == "Yes") --}}
                                    <tr class="target @if($data->risk_safety_form['further_activity'] == "No") d-none @endif ">
                                        <th></th>
                                        <td>If Yes, list activities:</td>
                                        <td><input type="text" name="list_activity" id="list_activity" class="form-control" value="{{$data->risk_safety_form['list_activity']}}">
                                        </td>
                                    </tr>
                                    {{-- @endif --}}
                                </tbody>
                            </table>
                            <table class=" mb-3 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>3.0</th>
                                        <td colspan="2">Work related to the project which will involve Particular Risks or Safety Critical Risks</td>
                                    </tr>
                                    <tr>
                                        <th>3.1</th>
                                        <td>Having taken account of the Principles of Prevention, Particular / Safety Critical. Risks as listed on the attached Risk Register have been identified.</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <label class="radio-inline">
                                                    <input type="radio" value="Yes" name="having_taken" @if($data->risk_safety_form['having_taken'] == "Yes") checked @endif>Yes
                                                  </label>
                                                  <label class="radio-inline">
                                                    <input type="radio" value="No" name="having_taken" @if($data->risk_safety_form['having_taken'] == "No") checked @endif>No
                                                  </label>
                                            </div>
                                        </td>
                                    </tr>
                    
                                </tbody>
                            </table>
                            <table class=" mb-3 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>4.0</th>
                                        <td colspan="2">The basis upon which time was established</td>
                                    </tr>
                                    <tr>
                                        <th>4.1</th>
                                        <td>Project program time as noted under 1.03 above is estimated from other similar projects undertaken by the company with a similar allocation of resources. The estimated project time assumes reasonable weather conditions for the time of year and for continuity of access. We confirm that the works can be safely undertaken at this time.</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <label class="radio-inline">
                                                    <input type="radio" value="Yes" name="prog_time" @if($data->risk_safety_form['prog_time'] == "Yes") checked @endif>Yes
                                                  </label>
                                                  <label class="radio-inline">
                                                    <input type="radio" value="No" name="prog_time" @if($data->risk_safety_form['prog_time'] == "No") checked @endif>No
                                                  </label>
                                            </div>
                                        </td>
                                    </tr>
                    
                                </tbody>
                            </table>
                            <table class=" mb-3 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>5.0</th>
                                        <td colspan="2">Conclusions drawn by Designers and Project Supervisors as regards the taking account of the Principles of Prevention and any relevant Health and Safety Plan or Safety File.</td>
                                    </tr>
                                    <tr>
                                        <th>5.1</th>
                                        <td>After inquiry to the homeowner, we confirm that there is a Safety File / Safety Plan in respect of this dwelling.</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <label class="radio-inline">
                                                    <input type="radio" value="Yes" name="after_inquiry" @if($data->risk_safety_form['after_inquiry'] == "Yes") checked @endif>Yes
                                                  </label>
                                                  <label class="radio-inline">
                                                    <input type="radio" value="No" name="after_inquiry" @if($data->risk_safety_form['after_inquiry'] == "No") checked @endif>No
                                                  </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>5.2</th>
                                        <td>Following the taking account of the Principles of Prevention, Particular / Safety Critical Risks still remaining are noted in the attached Risk Register. These risks are noted by the PSCS in the Safety Plan and the Contractor has prepared a Risk Assessment Method Statement (RAMS) to provide for their safe execution. Collective protective measures should be provided as an absolute priority over individual protective measures. RAMS are attached.</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <label class="radio-inline">
                                                    <input type="radio" value="Yes" name="princy_prevent" @if($data->risk_safety_form['princy_prevent'] == "Yes") checked @endif>Yes
                                                  </label>
                                                  <label class="radio-inline">
                                                    <input type="radio" value="No" name="princy_prevent" @if($data->risk_safety_form['princy_prevent'] == "No") checked @endif>No
                                                  </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class=" mb-3 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>6.0</th>
                                        <td>The location of electricity, water and sewage connection where appropriate to facilitate adequate welfare facilities</td>
                                    </tr>
                                    <tr>
                                        <th>6.1</th>
                                        <td>Works of short duration. No Welfare facilities provided. Do not use Homeowner facilities.</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class=" mb-3 table table-bordered addMoreControl" id="gen_dec2">
                                <tbody>
                                    <tr>
                                        <th>7.0</th>
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
                                        <td><input class="form-control" type="text" name="specific_risk[]" id="specific_risk" value="{{$dData['risk']}}"></td>
                                        <td><input class="form-control" type="text" name="specific_control[]" id="specific_control" value="{{$dData['control']}}"></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="col-md-12 mb-3" style="padding: unset;">
                                <a href="javascript:void(0);" class="addriskControll">+ Add Risk & Control Measure</a>
                            </div>
                            <table class=" mb-3 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>8.0</th>
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
                            
                            <table class=" mb-3 table table-bordered" id="gen_dec">
                                <tbody>
                                    <tr>
                                        <th>9.0</th>
                                        <td colspan="2">Emergency Contacts:</td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td><input class="form-control" type="text" name="emmer_name" id="emmer_name" value="{{$data->risk_safety_form['emmer_name']}}"></td>
                                        <td><input class="form-control" type="text" name="emmer_contact" id="emmer_contact" value="{{$data->risk_safety_form['emmer_contact']}}"></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>Emergency Services:</td>
                                        <td>999 / 112</td>
                                    </tr>
                                </tbody>
                            </table>
                            <span class="mt-2 mb-2">Construction Stage Health and Safety Plan Prepared by:</span>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <button class="btn updateSafty" type="submit">Update</button>
                    </div>
                </form>
                    <div class="mt-2 p-3 d-flex justify-content-between bg-grasy">
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="">
                                <div class="d-flex">
                                    <h4 class="text-black my-1">Date: </h4>
                                    <h4 class="ml-1 my-1 text-black">
                                        {{ date('d/m/Y') }}</h4>
                                </div>
                                <div class="d-flex">
                                    <h4 class="text-black my-0">Signed: </h4>
                                    <h4 class="ml-1 my-0 text-black">Developer07</h4>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            @if (isset($data['signature']) && $data['signature'] != "")
                                <img class="bg-gray img-fluid bg-white float-end"
                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_signature/'.$data['signature']) }}"
                                    width="200">
                            @else
                            <img class="bg-gray img-fluid bg-white float-end"
                                    src="{{ asset('/assets/images/users/avatar-1.jpg') }}"
                                    width="200">
                            @endif
                        </div>
                    </div>

                </div>


            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        $(document).ready( function(){
        $(document).on('change','#desc_site', function(){
            var val = $(this).val();
            if(val == 'Other'){
                $('#desc_site_other').removeClass('d-none');
            }else{
                $('#desc_site_other').addClass('d-none');
            }
        });
        $(document).on('change','input[name="further_activity"]',function() {
            // Check the selected value
            if ($(this).val() === 'No') {
                // If 'No' is selected, add the class 'd-none' to #target
                $('.target').addClass('d-none');
            } else {
                // If 'Yes' is selected, remove the class 'd-none' from target
                $('.target').removeClass('d-none');
            }
        });
            $(document).on('click','.addriskControll', function(){
                // alert('in');
                var maxThValue = Math.max.apply(null, $('.addMoreControl th').map(function () {
            var value = parseFloat($(this).text());
            return isNaN(value) ? 0 : value;
        }).get());
        var nextValue = (maxThValue + 0.1).toFixed(1);
        var html = '';
                html+='<tr>';
                html+='<th>'+nextValue+'</th>';
                html+='<td><input class="form-control" type="text" name="specific_risk[]" id="specific_risk" value=""></td>';
                html+='<td><input class="form-control" type="text" name="specific_control[]" id="specific_control" value=""></td>';
                html+='</tr>';
                $('.addMoreControl').append(html);
            });
        });
    </script>
@endsection
