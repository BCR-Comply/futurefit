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

                    <?php

                    function clean($string)
                    {
                        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                        return preg_replace('/[^A-Za-z0-9, \-]/', '', $string); // Removes special chars.
                    }

                    ?>

                    <div class="row px-2">
                        <div class="col-12 bg-gray">

                            @if(isset($data['sir_preparation_complete']))

                                <h3 class="text-info">Preparation Complete</h3>

                                <h4>Weather Conditions</h4>
                                <small>{{$data['sir_preparation_complete']['weather_conditions']}}</small>


                                <h4>Temperature</h4>
                                <small>{{$data['sir_preparation_complete']['temperature']}}</small>


                                <h4>Temperature Photo</h4>
                                @if(isset($data['sir_preparation_complete']['temperature_image']))

                                    <img
                                        class="m-1"
                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_preparation_complete']['temperature_image'])}}"
                                        width="200"
                                    >
                                @endif

                                <h4>Time of day</h4>
                                <small>{{$data['sir_preparation_complete']['temperature_imagetime_of_day']}}</small>

                                <h4>Health & Safety</h4>

                                    <?php
                                    $health_safety = explode(",", clean($data['sir_preparation_complete']['health_safety']));
                                    ?>

                                <ul>
                                    @foreach($health_safety as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>

                                <h4>Building services</h4>

                                    <?php
                                    $building_services = explode(",", clean($data['sir_preparation_complete']['building_services']));
                                    ?>

                                <ul>
                                    @foreach($building_services as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>

                                {{--                                    <small>{{$data['sir_preparation_complete']['building_services']}}</small>--}}

                                <h4>Materials Check</h4>

                                    <?php
                                    $material_check = explode(",", clean($data['sir_preparation_complete']['materials_check']));
                                    ?>

                                <ul>
                                    @foreach($material_check as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>




                                <h4>Contractor Performance Rating</h4>

                                    <?php
                                    $contractor_performance_rating = explode(",", clean($data['sir_preparation_complete']['contractor_performance_rating']));
                                    ?>

                                <ul>
                                    @foreach($contractor_performance_rating as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>

                                <h4>Photos</h4>
                                <div class="row p-2">
                                    @for($i=1; $i <= 5; $i++)
                                        @if(isset($data['sir_preparation_complete']['photos'.$i]) && trim($data['sir_preparation_complete']['photos'.$i]) != '')
                                            <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                                                <img
                                                    class="m-1 img-fluid"
                                                    width="200"
                                                    src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_preparation_complete']['photos'.$i])}}"
                                                >
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            @endif



                            @if(isset($data['sir_boarding_complete']))

                                <h3 class="text-info">Bording / Stress Patches Complete</h3>

                                <h4>Weather Conditions</h4>
                                <small>{{$data['sir_boarding_complete']['weather_conditions']}}</small>


                                <h4>Temperature</h4>
                                <small>{{$data['sir_boarding_complete']['temperature']}}</small>


                                <h4>Temperature Photo</h4>
                                @if(isset($data['sir_boarding_complete']['temperature_image']) && trim($data['sir_boarding_complete']['temperature_image']) != '')

                                    <img
                                        class="m-1"
                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_boarding_complete']['temperature_image'])}}"
                                        width="200"
                                    >
                                @endif

                                <h4>Time of day</h4>
                                <small>{{$data['sir_boarding_complete']['temperature_imagetime_of_day']}}</small>

                                <h4>Health & Safety</h4>

                                    <?php
                                    $health_safety = explode(",", clean($data['sir_boarding_complete']['health_safety']));
                                    ?>

                                <ul>
                                    @foreach($health_safety as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>

                                <h4>Workmanship</h4>

                                    <?php
                                    $workmanship = explode(",", clean($data['sir_boarding_complete']['workmanship']));
                                    ?>

                                <ul>
                                    @foreach($workmanship as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>

                                {{--                                    <small>{{$data['sir_boarding_complete']['building_services']}}</small>--}}

                                <h4>Ventilation</h4>

                                    <?php
                                    $ventilation = explode(",", clean($data['sir_boarding_complete']['ventilation']));
                                    ?>

                                <ul>
                                    @foreach($ventilation as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>


                                <h4>Contractor Performance Rating</h4>

                                    <?php
                                    $contractor_performance_rating = explode(",", clean($data['sir_boarding_complete']['contractor_performance_rating']));
                                    ?>

                                <ul>
                                    @foreach($contractor_performance_rating as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>

                                <h4>Photos</h4>
                                <div class="row p-2">
                                    @for($i=1; $i <= 5; $i++)
                                        @if(isset($data['sir_boarding_complete']['photos'.$i]) && trim($data['sir_boarding_complete']['photos'.$i]) != '')
                                            <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                                                <img
                                                    class="m-1 img-fluid"
                                                    width="200"
                                                    src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_boarding_complete']['photos'.$i])}}"
                                                >
                                            </div>
                                        @endif
                                    @endfor
                                </div>

                            @endif


                            @if(isset($data['sir_base_coat_complete']))

                                <h3 class="text-info">Base Coat Complete</h3>

                                <h4>Weather Conditions</h4>
                                <small>{{$data['sir_base_coat_complete']['weather_conditions']}}</small>


                                <h4>Temperature</h4>
                                <small>{{$data['sir_base_coat_complete']['temperature']}}</small>


                                <h4>Temperature Photo</h4>
                                @if(isset($data['sir_base_coat_complete']['temperature_image']) && trim($data['sir_base_coat_complete']['temperature_image']) != '')

                                    <img
                                        class="m-1"
                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_base_coat_complete']['temperature_image'])}}"
                                        width="200"
                                    >
                                @endif

                                <h4>Time of day</h4>
                                <small>{{$data['sir_base_coat_complete']['temperature_imagetime_of_day']}}</small>

                                <h4>Health & Safety</h4>

                                    <?php
                                    $health_safety = explode(",", clean($data['sir_base_coat_complete']['health_safety']));
                                    ?>

                                <ul>
                                    @foreach($health_safety as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>

                                <h4>Workmanship</h4>

                                    <?php
                                    $workmanship = explode(",", clean($data['sir_base_coat_complete']['workmanship']));
                                    ?>

                                <ul>
                                    @foreach($workmanship as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>

                                {{--                                    <small>{{$data['sir_base_coat_complete']['building_services']}}</small>--}}

                                <h4>Ventilation</h4>

                                    <?php
                                    $ventilation = explode(",", clean($data['sir_base_coat_complete']['ventilation']));
                                    ?>

                                <ul>
                                    @foreach($ventilation as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>


                                <h4>Contractor Performance Rating</h4>

                                    <?php
                                    $contractor_performance_rating = explode(",", clean($data['sir_base_coat_complete']['contractor_performance_rating']));
                                    ?>

                                <ul>
                                    @foreach($contractor_performance_rating as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>

                                <h4>Photos</h4>
                                <div class="row p-2">
                                    @for($i=1; $i <= 5; $i++)
                                        @if(isset($data['sir_base_coat_complete']['photos'.$i]) && trim($data['sir_base_coat_complete']['photos'.$i]) != '')
                                            <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                                                <img
                                                    class="m-1 img-fluid"
                                                    width="200"
                                                    src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_base_coat_complete']['photos'.$i])}}"
                                                >
                                            </div>
                                        @endif
                                    @endfor
                                </div>

                            @endif



                            @if(isset($data['sir_finish_coat_complete']))

                                <h3 class="text-info">Finish Coat Complete</h3>

                                <h4>Weather Conditions</h4>
                                <small>{{$data['sir_finish_coat_complete']['weather_conditions']}}</small>


                                <h4>Temperature</h4>
                                <small>{{$data['sir_finish_coat_complete']['temperature']}}</small>


                                <h4>Temperature Photo</h4>
                                @if(isset($data['sir_finish_coat_complete']['temperature_image']) && trim($data['sir_finish_coat_complete']['temperature_image']) != '')

                                    <img
                                        class="m-1"
                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_finish_coat_complete']['temperature_image'])}}"
                                        width="200"
                                    >
                                @endif

                                <h4>Time of day</h4>
                                <small>{{$data['sir_finish_coat_complete']['temperature_imagetime_of_day']}}</small>

                                <h4>Health & Safety</h4>

                                    <?php
                                    $health_safety = explode(",", clean($data['sir_finish_coat_complete']['health_safety']));
                                    ?>

                                <ul>
                                    @foreach($health_safety as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>

                                <h4>Workmanship</h4>

                                    <?php
                                    $workmanship = explode(",", clean($data['sir_finish_coat_complete']['workmanship']));
                                    ?>

                                <ul>
                                    @foreach($workmanship as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>

                                {{--                                    <small>{{$data['sir_finish_coat_complete']['building_services']}}</small>--}}

                                <h4>Ventilation</h4>

                                    <?php
                                    $ventilation = explode(",", clean($data['sir_finish_coat_complete']['ventilation']));
                                    ?>

                                <ul>
                                    @foreach($ventilation as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>


                                <h4>Contractor Performance Rating</h4>

                                    <?php
                                    $contractor_performance_rating = explode(",", clean($data['sir_finish_coat_complete']['contractor_performance_rating']));
                                    ?>

                                <ul>
                                    @foreach($contractor_performance_rating as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>

                                <h4>Photos</h4>
                                <div class="row p-2">
                                    @for($i=1; $i <= 5; $i++)
                                        @if(isset($data['sir_finish_coat_complete']['photos'.$i]) && trim($data['sir_finish_coat_complete']['photos'.$i]) != '')
                                            <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                                                <img
                                                    class="m-1 img-fluid"
                                                    width="200"
                                                    src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_finish_coat_complete']['photos'.$i])}}"
                                                >
                                            </div>
                                        @endif
                                    @endfor
                                </div>

                            @endif


                            @if(isset($data['sir_job_complete']))

                                <h3 class="text-info">Job Complete</h3>

                                <h4>Materials Records</h4>

                                    <?php
                                    $material_records = explode(",", clean($data['sir_job_complete']['material_records']));
                                    ?>

                                <ul>
                                    @foreach($material_records as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>


                                <h4>. Paperwork Records</h4>
                                    <?php
                                    $paperwork_records = explode(",", clean($data['sir_job_complete']['paperwork_records']));
                                    ?>

                                <ul>
                                    @foreach($paperwork_records as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>


                                <h4>Exceptional Items</h4>
                                <small>{{$data['sir_job_complete']['exceptional_items']}}</small>


                                <h4>Contractor Performance Rating</h4>

                                    <?php
                                    $contractor_performance_rating = explode(",", clean($data['sir_job_complete']['contractor_performance_rating']));
                                    ?>

                                <ul>
                                    @foreach($contractor_performance_rating as $entry)

                                        @if($entry)
                                            <li>{{$entry}}</li>
                                        @endif

                                    @endforeach
                                </ul>



                                <h4>Notes & Recommendations</h4>
                                <small>{{$data['sir_job_complete']['notes_recommendations']}}</small>

                                <h4>Photos</h4>

                                <div class="row p-2">
                                    @for($i=1; $i <= 5; $i++)
                                        @if(isset($data['sir_job_complete']['photos'.$i]) && trim($data['sir_job_complete']['photos'.$i]) != '')
                                            <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                                                <img
                                                    class="m-1 img-fluid"
                                                    width="200"
                                                    src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_job_complete']['photos'.$i])}}"
                                                >
                                            </div>
                                        @endif
                                    @endfor
                                </div>

                            @endif



                            @if(isset($data['sir_drawings_photographs']))

                                <h3 class="text-info">Drawings & Photographs</h3>

                                <h4>Have sketches been completed and attached?</h4>
                                <small>{{$data['sir_drawings_photographs']['exceptional_items']}}</small>

                                <h4>Have photographs been taken?</h4>
                                <small>{{$data['sir_drawings_photographs']['photographs_been_taken']}}</small>


                                <h4>Plan View</h4>
                                @if(isset($data['sir_drawings_photographs']['plan_view']) && trim($data['sir_drawings_photographs']['plan_view']) != '')

                                    <img
                                        class="m-1"
                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_drawings_photographs']['plan_view'])}}"
                                        width="200"
                                    >
                                @endif


                                <h4>Front elevations</h4>
                                @if(isset($data['sir_drawings_photographs']['front_elevations']) && trim($data['sir_drawings_photographs']['front_elevations']) != '')

                                    <img
                                        class="m-1"
                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_drawings_photographs']['front_elevations'])}}"
                                        width="200"
                                    >
                                @endif

                                <h4>Rear elevations</h4>
                                @if(isset($data['sir_drawings_photographs']['rear_elevations']) && trim($data['sir_drawings_photographs']['rear_elevations']) != '')

                                    <img
                                        class="m-1"
                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_drawings_photographs']['rear_elevations'])}}"
                                        width="200"
                                    >
                                @endif


                                <h4>Gable elevation 1</h4>
                                @if(isset($data['sir_drawings_photographs']['gable_elevations1']) && trim($data['sir_drawings_photographs']['gable_elevations1']) != '')

                                    <img
                                        class="m-1"
                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_drawings_photographs']['gable_elevations1'])}}"
                                        width="200"
                                    >
                                @endif


                                <h4>Gable elevation 2</h4>
                                @if(isset($data['sir_drawings_photographs']['gable_elevations2']) && trim($data['sir_drawings_photographs']['gable_elevations2']) != '')

                                    <img
                                        class="m-1"
                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_drawings_photographs']['gable_elevations2'])}}"
                                        width="200"
                                    >
                                @endif

                                <h4>Gable elevation 3</h4>
                                @if(isset($data['sir_drawings_photographs']['gable_elevations3']) && trim($data['sir_drawings_photographs']['gable_elevations3']) != '')

                                    <img
                                        class="m-1"
                                        src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['sir_drawings_photographs']['gable_elevations3'])}}"
                                        width="200"
                                    >
                                @endif


                                <h4>Additional Risks / Notes</h4>
                                <small>{{isset($data['sir_drawings_photographs']['addditional_risks_notes']) ? $data['sir_drawings_photographs']['addditional_risks_notes'] : ''}}</small>

                        </div>

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

@endsection
