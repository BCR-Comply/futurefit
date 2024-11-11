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


                    @foreach($data['cqa_photo_inspection_items'] as $cqa_photo_inspection_item)

                        <div class="mt-3 my-1 border px-2">

                            <div>
                                <h2 class="text-black text-decoration-underline">{{isset($cqa_photo_inspection_item['cqa_area']['area']) ? $cqa_photo_inspection_item['cqa_area']['area'] : ''}}</h2>
                                <h5 class="text-black">{{$cqa_photo_inspection_item['type']}}</h5>
                            </div>

                            <div>

                                    <span class="bg-gray px-1">
                                        <b class="text-black">
                                            {{$cqa_photo_inspection_item['option_value']}}
                                        </b>
                                    </span>
                                <span>
                                        {{isset($cqa_photo_inspection_item['cqa_question']['item']) ? $cqa_photo_inspection_item['cqa_question']['item'] : ''}}
                                    </span>

                            </div>

                            <div class="row p-2">
                                @for($i=1; $i <= 5; $i++)
                                    @if(isset($cqa_photo_inspection_item['image'.$i]) && trim($cqa_photo_inspection_item['image'.$i]) != '')
                                        <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                                            <img
                                                class="m-1 img-fluid"
                                                width="200"
                                                src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$cqa_photo_inspection_item['image'.$i])}}"
                                            >
                                        </div>
                                    @endif
                                @endfor
                            </div>


                            @if(isset($cqa_photo_inspection_item['comments']))

                                <div class="mt-1">
                                    <div class="mt-1">
                                        <p><b>Comment: </b>{{$cqa_photo_inspection_item['comments']}}</p></div>

                                    @endif
                                </div>

                                @endforeach

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

                        </div>
                </div>
            </div>

        </div> <!-- end card-body -->
    </div> <!-- end card -->
@endsection
