@extends('layouts.dashboard.print')
@section('content')
<div class="row">
    <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between" style="font-family: Arial">
                        <div>
                            <div class="d-flex align-items-end">
                                <h1 class="text-black my-0">{{$data['report_name']}}</h1>

                                @if($data['report_type'])

                                <div class="lead ml-2">({{$data['report_type']}})</div>

                                @endif
                            </div>
                            <h2 class="my-0">{{$data['date_inspected']}}</h2>
                        </div>

                        <div class="bg-gray py-1 px-2">
                            <img src="{{asset('assets/images/logo.png')}}" alt="" width="110">
                        </div>
                    </div>


                    <div class="mt-1 d-flex flex-row-reverse pt-1" style="border-top: 20px black solid">
                        <div>
                            <span><b>Client: </b>{{$data['client_name']}}</span>
                            <span>|</span>
                            <span><b>Address: </b>{{$data['address']}}</span>
                        </div>
                    </div>

                    <div class="mt-3 my-2 bg-gray">
                        <div class="row my-1 p-2">
                            @for($i = 1; $i < 4; $i++)
                                @if(isset($data['photo'.$i]) && trim($data['photo'.$i]) != '')
                                    <div class="col-print-6 p-2">
                                        <img class="m-1 img-fluid"
                                            width="200"
                                            src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['photo'.$i])}}">
                                    </div>
                                @endif
                            @endfor
                        </div>
                        <div class="row my-1 p-2">
                            @for($i = 4; $i < 7; $i++)
                                @if(isset($data['photo'.$i]) && trim($data['photo'.$i]) != '')
                                    <div class="col-print-6 p-2">
                                        <img class="m-1 img-fluid"
                                            width="200"
                                            src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['photo'.$i])}}">
                                    </div>
                                @endif
                            @endfor
                        </div>
                        <div class="row my-1 p-2">
                            @for($i = 7; $i < 10; $i++)
                                @if(isset($data['photo'.$i]) && trim($data['photo'.$i]) != '')
                                    <div class="col-print-6 p-2">
                                        <img class="m-1 img-fluid"
                                            width="200"
                                            src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_photo/'.$data['photo'.$i])}}">
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </div>

                    <div class="row px-2">
                        <div class="col-sm-12 bg-gray">
                            <h4 class="text-decoration-underline text-black">Notes</h4>
                            <p>{{$data['note']}}</p>
                        </div>
                    </div>


                    <div class="mt-2 p-3 d-flex justify-content-between bg-gray">
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="">
                                <div class="d-flex">
                                    <h4 class="text-black my-1">Date: </h4><h4
                                        class="ml-1 my-1">{{$data['date_inspected']}}</h4>
                                </div>
                                <div class="d-flex">
                                    <h4 class="text-black my-0">Signed: </h4><h4
                                        class="ml-1 my-0">{{$data['surveyed_by']}}</h4>
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
