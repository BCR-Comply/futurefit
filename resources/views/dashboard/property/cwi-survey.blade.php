@extends('layouts.dashboard.app')
@section('content')

    <div class="row mt-3">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between" style="font-family: Arial">
                        <div>
                            <h1 class="text-black my-0">{{$data['report_name']}}</h1>
                            <h2 class="my-0">{{date('d/m/Y', strtotime($data['date_inspected']))}}</h2>
                        </div>
                        <div class="bg-gray py-1 px-2">
                            <img src="{{asset('assets/images/logo.png')}}" alt="" width="110">
                        </div>
                    </div>

                    <div class="mt-1 d-flex justify-content-between pt-1" style="border-top: 20px black solid">
                        <div>
                            {{-- <p>Type: {{isset($data['property']['client']['type']) ? $data['property']['client']['type'] : ''}}</p> --}}
                        </div>
                        <div>
                            <span><b>Client: </b>{{isset($data['property']['client']['name']) ? $data['property']['client']['name'] : ''}}</span>
                            <span>|</span>
                            <span><b>Address: </b>{{format_address($data['property']['house_num'], $data['property']['address1'], $data['property']['address2'], $data['property']['address3'], $data['property']['county'], $data['property']['eircode']) }}</span>
                        </div>
                    </div>

                    <div class="row px-2">
                        <div class="col-12 bg-gray">


                            @if(isset($data['ws_building_details']))

                                <h4>Building Details</h4>

                                    <?php

                                    function clean($string)
                                    {
                                        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                                        return preg_replace('/[^A-Za-z0-9, \-]/', '', $string); // Removes special chars.
                                    }

                                    $building_details = explode(",", clean($data['ws_building_details']['appropriate_tick_box']));

                                    ?>

                                <ul>
                                    @foreach($building_details as $detail)
                                        <li>{{$detail}}</li>
                                    @endforeach
                                </ul>

                                @if(in_array("Other", $building_details))
                                    <p>
                                        {{$data['ws_building_details']['others_data']}}
                                    </p>
                                @endif

                            @endif


                            @if(isset($data['ws_building_details']))

                                <h4>Additional property detail</h4>

                                <p>
                                    {{isset($data['ws_building_details']['additional_note']) ? $data['ws_building_details']['additional_note'] : '--'}}
                                </p>

                            @endif


                            @if(isset($data['ws_building_type']))

                                <h4>Building Type</h4>

                                <ol>
                                    <li>External walls examined with borescope</li>
                                    <small>{{isset($data['ws_building_type']['examined_with_borescope']) ? $data['ws_building_type']['examined_with_borescope'] : '-'}}</small>

                                    <li>Cavity Type</li>
                                    <small>{{isset($data['ws_building_type']['cavity_type']) ? $data['ws_building_type']['cavity_type'] : '-'}}</small>

                                    <li>No. of holes drilled</li>
                                    <small>{{isset($data['ws_building_type']['no_of_holes_drilled']) ? $data['ws_building_type']['no_of_holes_drilled'] : '-'}}</small>

                                    <li>Cavity widths</li>
                                    <small>{{isset($data['ws_building_type']['cavity_widths']) ? $data['ws_building_type']['cavity_widths'] : '-'}}</small>

                                    <li>Notes on cavity</li>
                                    <small>{{isset($data['ws_building_type']['notes_on_cavity']) ? $data['ws_building_type']['notes_on_cavity'] : '-'}}</small>
                                </ol>

                            @endif



                            @if(isset($data['ws_condition_of_outer_leaf']))

                                <h4>Condition of outer leaf</h4>

                                <ol>
                                    <li>Is it in good condition</li>
                                    <small>{{$data['ws_condition_of_outer_leaf']['good_condition']}}</small>
                                    <li>Render free from cracks/gaps/holes</li>
                                    <small>{{$data['ws_condition_of_outer_leaf']['cracks_gaps_holes']}}</small>
                                    <li>Is brick jointing good</li>
                                    <small>{{$data['ws_condition_of_outer_leaf']['jointing_good']}}</small>
                                    <li>Are the cracks running vertically</li>
                                    <small>{{$data['ws_condition_of_outer_leaf']['running_vertically']}}</small>
                                    <li>Are the cracks running horizontally</li>
                                    <small>{{$data['ws_condition_of_outer_leaf']['running_horizontally']}}</small>
                                    <li>Are movement joints sealed</li>
                                    <small>{{$data['ws_condition_of_outer_leaf']['joints_sealed']}}</small>
                                    <li>Weep holes to linters</li>
                                    <small>{{$data['ws_condition_of_outer_leaf']['weep_holes_to_linters']}}</small>
                                    <li>Have sills adequate drip</li>
                                    <small>{{$data['ws_condition_of_outer_leaf']['have_sills_adequate_drip']}}</small>
                                    <li>Notes</li>
                                    <small>{{$data['ws_condition_of_outer_leaf']['notes']}}</small>
                                </ol>

                            @endif


                            @if(isset($data['ws_condition_of_inner_leaf']))

                                <h4>Condition of inner leaf</h4>

                                <ol>
                                    <li>Internal plaster free from cracks</li>
                                    <small>{{$data['ws_condition_of_inner_leaf']['cracks']}}</small>
                                    <li>Are the holes around the services sealed</li>
                                    <small>{{$data['ws_condition_of_inner_leaf']['services_sealed']}}</small>
                                    <li>Are roofs of bay windows airtight</li>
                                    <small>{{$data['ws_condition_of_inner_leaf']['airtight']}}</small>
                                    <li>Is there any sign of dampness</li>
                                    <small>{{$data['ws_condition_of_inner_leaf']['dampness']}}</small>
                                    <li>Are slabs dobbed</li>
                                    <small>{{$data['ws_condition_of_inner_leaf']['slabs_dobbed']}}</small>
                                    <li>Are conduits sealed</li>
                                    <small>{{$data['ws_condition_of_inner_leaf']['conduits_sealed']}}</small>
                                    <li>Are gables to be fitted</li>
                                    <small>{{$data['ws_condition_of_inner_leaf']['gables_to_be_fitted']}}</small>
                                </ol>

                            @endif


                            @if(isset($data['ws_insulation_present_in_cavity']))
                                <h4>Insulation Present in Cavity</h4>
                                <ol>
                                    <li>EPS White</li>
                                    <small>{{$data['ws_insulation_present_in_cavity']['eps_white']}}</small>
                                    <li>EPS Silver</li>
                                    <small>{{$data['ws_insulation_present_in_cavity']['eps_silver']}}</small>
                                    <li>Pir Board</li>
                                    <small>{{$data['ws_insulation_present_in_cavity']['pir_board']}}</small>
                                    <li>Mineral Board</li>
                                    <small>{{$data['ws_insulation_present_in_cavity']['mineral_board']}}</small>
                                    <li>Fsell Fill</li>
                                    <small>{{$data['ws_insulation_present_in_cavity']['fsell_fill']}}</small>
                                    <li>Condition of insulation Present</li>
                                    <small>{{$data['ws_insulation_present_in_cavity']['condition_of_insulation_present']}}</small>
                                    <li>Are the boards overlapping</li>
                                    <small>{{$data['ws_insulation_present_in_cavity']['boards_overlapping']}}</small>
                                    <li>Does Insulation bridge the cavity</li>
                                    <small>{{$data['ws_insulation_present_in_cavity']['insulation_bridge_the_cavity']}}</small>
                                    <li>DPC free from significant mortar</li>
                                    <small>{{$data['ws_insulation_present_in_cavity']['significant_mortar']}}</small>
                                </ol>

                            @endif



                            @if(isset($data['ws_new_build_cavity']))

                                <h4>New build cavity</h4>

                                <ol>
                                    <li>Are wall ties free from mortar</li>
                                    <small>{{$data['ws_new_build_cavity']['wall_ties_free_from_mortar']}}</small>
                                    <li>Are details adequate</li>
                                    <small>{{$data['ws_new_build_cavity']['window_details_adequate']}}</small>
                                    <li>Photos</li>

                                    <div class="row p-2">
                                        @for($i=1; $i <= 5; $i++)
                                            @if(isset($data['ws_new_build_cavity']['pictures'.$i]) && trim($data['ws_new_build_cavity']['pictures'.$i]) != '')
                                                <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                                                    <img
                                                        class="m-1 img-fluid"
                                                        width="200"
                                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['ws_new_build_cavity']['pictures'.$i])}}"
                                                    >
                                                </div>
                                            @endif
                                        @endfor
                                    </div>

                                    <li>Comment</li>
                                    <small>{{$data['ws_new_build_cavity']['comments']}}</small>
                                    <li>Is wall plate open</li>
                                    <small>{{$data['ws_new_build_cavity']['plate_open']}}</small>
                                    <li>Are DPCs in correct position</li>
                                    <small>{{$data['ws_new_build_cavity']['correct_position']}}</small>
                                </ol>

                            @endif


                            @if(isset($data['ws_services_in_the_cavity']))

                                <h4>Services in the cavity</h4>

                                <ol>
                                    <li>Are there any piped in the cavity</li>
                                    <small>{{$data['ws_services_in_the_cavity']['pipes_in_the_cavity']}}</small>
                                    <li>Photos</li>

                                    <div class="row p-2">
                                        @for($i=1; $i <= 5; $i++)
                                            @if(isset($data['ws_services_in_the_cavity']['pictures'.$i]) && trim($data['ws_services_in_the_cavity']['pictures'.$i]) != '')
                                                <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                                                    <img
                                                        class="m-1 img-fluid"
                                                        width="200"
                                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['ws_services_in_the_cavity']['pictures'.$i])}}"
                                                    >
                                                </div>
                                            @endif
                                        @endfor
                                    </div>

                                    <li>Are there any faces crossing the cavity</li>
                                    <small>{{$data['ws_services_in_the_cavity']['crossing_the_cavity']}}</small>
                                    <li>Are the roofs of the bay windows airtight</li>
                                    <small>{{$data['ws_services_in_the_cavity']['windows_airtight']}}</small>
                                    <li>Are there electrical cables in the cavity</li>
                                    <small>{{$data['ws_services_in_the_cavity']['cables_in_the_cavity']}}</small>
                                    <li>Are the flues isolated from the cavity</li>
                                    <small>{{$data['ws_services_in_the_cavity']['isolated_from_the_cavity']}}</small>
                                    <li>Additional Comments</li>
                                    <small>{{$data['ws_services_in_the_cavity']['additional_comments']}}</small>
                                </ol>

                            @endif


                            @if(isset($data['ws_ventilation_through_the_cavity']))

                                <h4>Ventilation through the cavity</h4>
                                <ol>
                                    <li>Are there vents to suspended floors</li>
                                    <small>{{$data['ws_ventilation_through_the_cavity']['suspended_floors']}}</small>
                                    <li>Are vents sleeved</li>
                                    <small>{{$data['ws_ventilation_through_the_cavity']['vents_sleeved']}}</small>
                                    <li>Comment</li>
                                    <small>{{$data['ws_ventilation_through_the_cavity']['comment']}}</small>
                                    <li>Are Cores needed</li>
                                    <small>{{$data['ws_ventilation_through_the_cavity']['cores_need']}}</small>
                                    <li>How many</li>
                                    <small>{{$data['ws_ventilation_through_the_cavity']['how_many']}}</small>
                                    <li>Types of vents needed</li>
                                    <small>{{$data['ws_ventilation_through_the_cavity']['types_of_vents_need']}}</small>
                                    <li>Is there adequate ventilation in rooms with burning appliances</li>
                                    <small>{{$data['ws_ventilation_through_the_cavity']['burning_appliances']}}</small>
                                    <li>Photos</li>

                                    <div class="row p-2">
                                        @for($i=1; $i <= 5; $i++)
                                            @if(isset($data['ws_ventilation_through_the_cavity']['pictures'.$i]) && trim($data['ws_ventilation_through_the_cavity']['pictures'.$i]) != '')
                                                <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                                                    <img
                                                        class="m-1 img-fluid"
                                                        width="200"
                                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['ws_ventilation_through_the_cavity']['pictures'.$i])}}"
                                                    >
                                                </div>
                                            @endif
                                        @endfor
                                    </div>

                                    <li>Notes</li>
                                    <small>{{isset($data['ws_ventilation_through_the_cavity']['notes']) ? $data['ws_ventilation_through_the_cavity']['notes'] : ''}}</small>
                                </ol>

                            @endif

                        </div>
                    </div>


                    <div class="mt-2 p-3 d-flex justify-content-between bg-gray">
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="">
                                <div class="d-flex">
                                    <h4 class="text-black my-1">Date: </h4><h4
                                        class="ml-1 my-1">{{date('d/m/Y', strtotime($data['date_inspected']))}}</h4>
                                </div>
                                <div class="d-flex">
                                    <h4 class="text-black my-0">Signed: </h4><h4
                                        class="ml-1 my-0">{{$data['name']}}</h4>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            @if($data['signature'])
                                <img class="bg-gray img-fluid bg-white float-end"
                                     src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_signature/'.$data['signature'])}}"
                                     width="200">
                            @endif
                        </div>
                    </div>


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
