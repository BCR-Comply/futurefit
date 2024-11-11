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
                        {{-- <p>Type: {{isset($data['property']['client']['type']) ? $data['property']['client']['type'] : ''}}</p> --}}
                    </div>
                    <div>
                        <span><b>Client: </b>{{$data['property']['client']['name'] ?? ''}}</span>
                        <span>|</span>
                        <span><b>Address: </b>{{format_address($data['property']['house_num'], $data['property']['address1'], $data['property']['address2'], $data['property']['address3'], $data['property']['county'], $data['property']['eircode']) }}</span>
                    </div>
                </div>


                @foreach($data['bre_photo_inspection_items'] as $type => $bre_photo_inspection_items)

                    <div class="mt-3 my-1 border px-2">

                        <div>
                            <h2 class="text-black text-decoration-underline">{{$type}}</h2>
                        </div>

                        @foreach ($bre_photo_inspection_items as $bre_photo_inspection_item)
                            @if ($bre_photo_inspection_item['option_value'] == 'Yes' || $bre_photo_inspection_item['option_value'] == 'No')
                                <h5 class="text-black">{{$bre_photo_inspection_item['bre_item']['item'] ?? ''}}</h5>
                                <div>
                                    <span>
                                            {{$bre_photo_inspection_item['bre_question']['item'] ?? ''}}
                                    </span>
                                    <span class="bg-light p-1">
                                        <b class="text-black">
                                            {{$bre_photo_inspection_item['option_value']}}
                                        </b>
                                    </span>
                                </div>

                                <div class="row p-2">
                                    @for($i=1; $i <= 5; $i++)
                                        @if(trim($bre_photo_inspection_item['image'.$i] ?? '') != '')
                                            <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                                                <img
                                                    class="m-1 img-fluid"
                                                    width="200"
                                                    src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$bre_photo_inspection_item['image'.$i])}}"
                                                >
                                            </div>
                                        @endif
                                    @endfor
                                </div>

                                @if(trim($bre_photo_inspection_item['comments'] ?? ''))
                                    <div class="mt-1">
                                        <div class="mt-1">
                                            <p><b>Comment: </b>{{$bre_photo_inspection_item['comments']}}</p>
                                        </div>
                                    </div>
                                @endif

                            @endif

                        @endforeach
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
    </div><!-- end col -->
</div><!-- end row -->
@endsection


