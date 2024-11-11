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
                        <div class="bg-gray m-1 py-1 px-2">
                            <img src="{{asset('assets/images/logo.png')}}" alt="" width="110">
                        </div>
                    </div>

                    <div class="mt-1 d-flex justify-content-between pt-1" style="border-top: 20px black solid">
                        <div>
                            {{-- <p>Type: {{isset($data['property']['client']['type']) ? $data['property']['client']['type'] : ''}}</p> --}}
                        </div>
                        <div>
                            <span><b>Client: </b>{{$data['property']['client']['name']}}</span>
                            <span>|</span>
                            <span><b>Address: </b>{{format_address($data['property']['house_num'], $data['property']['address1'], $data['property']['address2'], $data['property']['address3'], $data['property']['county'], $data['property']['eircode']) }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 px-3">

                            <?php
                            $area = '';
                            $item = '';
                            $type = '';
                            ?>

                            @foreach($data['photo_inspection_items'] as $photo_inspection_item)

                                @if($photo_inspection_item['item']['area']['area'] != $area)

                                        <?php
                                        $area = $photo_inspection_item['item']['area']['area'];

                                        ?>

                                    <h4 class="text-black">Area: {{$area}}</h4>

                                @endif

                                @if($photo_inspection_item['item']['item'] != $item)

                                        <?php

                                        $item = $photo_inspection_item['item']['item'];

                                        ?>

                                    <h4 class="text-black">Item: {{$item}}</h4>

                                @endif

                                @if($photo_inspection_item['question']['type'] != $type)

                                        <?php
                                        $type = $photo_inspection_item['question']['type'];

                                        ?>
                                    <h4 class="text-black">Type: {{$type}}</h4>

                                @endif


                                <div class="my-1">
                                    <h5>
                                        Q: {{$photo_inspection_item['question']['Item']}}
                                    </h5>

                                    @if($photo_inspection_item['question']['input'] == 'text')
                                        <p>{{$photo_inspection_item['comments']}}</p>
                                    @else

                                        <div class="row my-1 p-2">

                                            @for($i=1; $i <= 5; $i++)

                                                @if(isset($photo_inspection_item['image'.$i]) && trim($photo_inspection_item['image'.$i]) != '')

                                                    <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                                                        <img
                                                            class="m-1 img-fluid"
                                                            width="200"
                                                            src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$photo_inspection_item['image'.$i])}}"
                                                        >
                                                    </div>

                                                @endif

                                            @endfor

                                        </div>

                                    @endif
                                </div>

                            @endforeach

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
                                <img class="bg-gray m-1 img-fluid bg-white float-end"
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
