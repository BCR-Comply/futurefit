@extends('layouts.dashboard.print')
@section('content')
<div class="row">
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
                        {{-- <p>Type: {{isset($data['property']['client']['type']) ?
                            $data['property']['client']['type']
                            : ''}}</p> --}}
                    </div>
                    <div>
                        <span><b>Client: </b>{{isset($data['property']['client']['name']) ?
                            $data['property']['client']['name'] : ''}}</span>
                        <span>|</span>
                        <span><b>Address: </b>{{format_address($data['property']['house_num'],
                            $data['property']['address1'], $data['property']['address2'],
                            $data['property']['address3'],
                            $data['property']['county'], $data['property']['eircode']) }}</span>
                    </div>
                </div>


                <div class="row px-2">
                    <div class="col-12">

                        @if(isset($data['rs_building_details']))
                            <div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="py-1" colspan="2">
                                                <h5>Building Details</h5>
                                            </th>
                                        </tr>

                                    @if(isset($data['rs_building_details']['appropriate_tick_box']))

                                        @foreach(json_decode($data['rs_building_details']['appropriate_tick_box']) as $item)

                                            <tr>
                                                <th>{{$item}}</th>
                                                <td>YES</td>
                                            </tr>

                                        @endforeach

                                    @endif
                                    </tbody>
                                </table>
                            </div>

                        @endif

                        @if(isset($data['rs_additional_property_detail']))
                            <div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="py-1" colspan="2">
                                                <h5>Additional Property Details</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Additional Note</th>
                                            <td>{{$data['rs_additional_property_detail']['additional_note']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        @endif

                        @if(isset($data['rs_roof_types']))
                            <div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="py-1" colspan="2">
                                                <h5>Roof Types</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Flat Roof (Warm)</th>
                                            <td>{{$data['rs_roof_types']['warm']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Flat Roof (Cold)</th>
                                            <td>{{$data['rs_roof_types']['cold']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Pitches Roof</th>
                                            <td>{{$data['rs_roof_types']['pitches']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Vaulted Roof</th>
                                            <td>{{$data['rs_roof_types']['vaulted']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Dormer Roof</th>
                                            <td>{{$data['rs_roof_types']['dormer']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        @if(isset($data['rs_roof_conditions']))
                            <div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="py-1" colspan="2">
                                                <h5>Roof Types</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Is felt existing</th>
                                            <td>{{$data['rs_roof_conditions']['existing']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Is it breathable</th>
                                            <td>{{$data['rs_roof_conditions']['breathable']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Is it non-breathable</th>
                                            <td>{{$data['rs_roof_conditions']['non_breathable']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Comment</th>
                                            <td>{{$data['rs_roof_conditions']['comments']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Is there holes in breather membrane</th>
                                            <td>{{$data['rs_roof_conditions']['comments']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Is there signs of rot</th>
                                            <td>{{$data['rs_roof_conditions']['comments']}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                               <div class="row">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if(isset($data['rs_roof_conditions']['pictures'.$i]) &&
                                                            trim($data['rs_roof_conditions']['pictures'.$i]) !='' )
                                                            <div class="col-sm-12 col-md-4">
                                                                <img class="m-1"
                                                                    src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['rs_roof_conditions']['pictures'.$i])}}"
                                                                    width="200">
                                                            </div>
                                                        @endif
                                                    @endfor
                                               </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Is there signs of mould</th>
                                            <td>{{$data['rs_roof_conditions']['signs_of_mould']}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                               <div class="row">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if(isset($data['rs_roof_conditions']['mould_pictures'.$i]) &&
                                                            trim($data['rs_roof_conditions']['mould_pictures'.$i]) !='' )
                                                            <div class="col-sm-12 col-md-4">
                                                                <img class="m-1"
                                                                    src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['rs_roof_conditions']['mould_pictures'.$i])}}"
                                                                    width="200">
                                                            </div>
                                                        @endif
                                                    @endfor
                                               </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>What centres are rafters</th>
                                            <td>
                                                @if(isset($data['rs_roof_conditions']['rafters']))
                                                    {{ join(", ", json_decode($data['rs_roof_conditions']['rafters'])) }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Other</th>
                                            <td>{{$data['rs_roof_conditions']['other']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif


                        @if(isset($data['rs_roof_ventilation']))
                            <div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="py-1" colspan="2">
                                                <h5>Roof Ventilation</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Are there ventilated ridges</th>
                                            <td>{{$data['rs_roof_ventilation']['ventilated_ridges']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Are there ventilated ridges on hips</th>
                                            <td>{{$data['rs_roof_ventilation']['ridges_on_hips']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Are there adequate ventilation at soffit</th>
                                            <td>{{$data['rs_roof_ventilation']['soffit']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Has the fascia and soffit been fitted</th>
                                            <td>{{$data['rs_roof_ventilation']['fitted']}}</td>
                                        </tr>
                                        <tr>
                                            <th>If no fascia and soffit is there another source of ventilation</th>
                                            <td>{{$data['rs_roof_ventilation']['source_of_ventilation']}}</td>
                                        </tr>
                                        <tr>
                                            <th>If cold deck is there allowance for cross ventilation</th>
                                            <td>{{$data['rs_roof_ventilation']['cross_ventilation']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Can the ridge be adequately ventilated</th>
                                            <td>{{$data['rs_roof_ventilation']['adequately_ventilated']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Is the roof counter battened</th>
                                            <td>{{$data['rs_roof_ventilation']['counter_battened']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif


                        @if(isset($data['rs_roof_services']))
                            <div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="py-1" colspan="2">
                                                <h5>Roof Services</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Are there any roof vents for services in roof</th>
                                            <td>{{$data['rs_roof_services']['vents_for_services']}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                               <div class="row">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if(isset($data['rs_roof_services']['pictures'.$i]) &&
                                                            trim($data['rs_roof_services']['pictures'.$i]) !='' )
                                                            <div class="col-sm-12 col-md-4">
                                                                <img class="m-1"
                                                                    src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['rs_roof_services']['pictures'.$i])}}"
                                                                    width="200">
                                                            </div>
                                                        @endif
                                                    @endfor
                                               </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Are there any electrical cables in roof</th>
                                            <td>{{$data['rs_roof_services']['electical_cables']}}</td>
                                        </tr>

                                        <tr>
                                            <th>Is there ductwork in roof</th>
                                            <td>{{$data['rs_roof_services']['ductwork']}}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                               <div class="row">
                                                    @for($i = 6; $i <= 10; $i++)
                                                        @if(isset($data['rs_roof_services']['pictures'.$i]) &&
                                                            trim($data['rs_roof_services']['pictures'.$i]) !='' )
                                                            <div class="col-sm-12 col-md-4">
                                                                <img class="m-1"
                                                                    src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['rs_roof_services']['pictures'.$i])}}"
                                                                    width="200">
                                                            </div>
                                                        @endif
                                                    @endfor
                                               </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Comments</th>
                                            <td>{{$data['rs_roof_services']['comments']}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        @endif


                        @if(isset($data['rs_spray_plan_for_roof']))
                            <div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="py-1" colspan="2">
                                                <h5>Spray Plan for Roof</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Spraying flat roof cold deck</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['cold_deck']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Air sealing flat warm deck</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['warm_deck']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Air sealing perimeter of ceiling ground floor</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['ceiling_ground_floor']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Spraying from wall plate to top of stud</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['top_of_stud']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Ventcard</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['ventcard1']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Depth</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['depth1']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Does it need to be shaved</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['shaved']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Spraying from top of stud to collar</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['stud_to_collar']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Ventcard</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['ventcard2']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Depth</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['depth2']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Does it need to be shaved</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['need_to_be_shaved']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Spraying from top of collar to ridge</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['collar_to_ridge']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Ventcard</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['ventcard3']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Depth</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['depth3']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Spraying from wall plate accross</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['plate_across']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Ceilling to stud</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['ceiling_to_stud']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Depth</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['depth4']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Spraying back of stud</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['spraying']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Depth</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['depth5']}}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                               <div class="row">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if(isset($data['rs_spray_plan_for_roof']['pictures'.$i]) &&
                                                            trim($data['rs_spray_plan_for_roof']['pictures'.$i]) !='' )
                                                            <div class="col-sm-12 col-md-4">
                                                                <img class="m-1"
                                                                    src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['rs_spray_plan_for_roof']['pictures'.$i])}}"
                                                                    width="200">
                                                            </div>
                                                        @endif
                                                    @endfor
                                               </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Comment</th>
                                            <td>{{$data['rs_spray_plan_for_roof']['comments']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif


                        @if(isset($data['rs_coomments_photographs']))
                            <div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="py-1" colspan="2">
                                                <h5>Comments & Photographs</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Additional Comments</th>
                                            <td>{{$data['rs_coomments_photographs']['comments']}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                               <div class="row">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if(isset($data['rs_coomments_photographs']['photos'.$i]) &&
                                                            trim($data['rs_coomments_photographs']['photos'.$i]) !='' )
                                                            <div class="col-sm-12 col-md-4">
                                                                <img class="m-1"
                                                                    src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['rs_coomments_photographs']['photos'.$i])}}"
                                                                    width="200">
                                                            </div>
                                                        @endif
                                                    @endfor
                                               </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>

                </div>

                <div class="mt-2 p-3 d-flex justify-content-between bg-gray">
                    <div class="col-sm-6 d-flex align-items-center">
                        <div class="">
                            <div class="d-flex">
                                <h4 class="text-black my-1">Date: </h4>
                                <h4 class="ml-1 my-1">{{date('d/m/Y', strtotime($data['date_inspected']))}}</h4>
                            </div>
                            <div class="d-flex">
                                <h4 class="text-black my-0">Signed: </h4>
                                <h4 class="ml-1 my-0">{{$data['name']}}</h4>
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
            </div>


        </div> <!-- end card-body -->
    </div> <!-- end card -->
</div><!-- end col -->
@endsection
