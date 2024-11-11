@extends('layouts.dashboard.app')
@section('content')
    <style>
        .mybody {
            background-color: #fff !important;
        }

        .f20 {
            font-size: 20px;
        }

        .bg-grays {
            border: 0.5px solid #1A47A3 !important;
            background-color: #fff !important;
            border-radius: 6px;
        }

        .f16 {
            font-size: 16px;
        }

        .brright {
            border-right: 1px solid #1A47A3;
        }

        .text-theme {
            color: #1A47A3;
        }

        .plunset {
            padding-left: unset !important;
        }

        .clrYes {
            background: #E4F3EA !important;
            color: #3A9B7A !important;
            padding: 3px 6px 3px 9px;
            border-radius: 4px;
            margin-right: 0.375rem;
        }

        .clrNo {
            background: #FDE6E6 !important;
            color: #FF1919 !important;
            padding: 3px 6px 3px 9px;
            border-radius: 4px;
            margin-right: 0.375rem;
        }

        .mtborder {
            border-top: 2px solid #F7F7F7;
            width: 99%;
        }

        .clrNA {
            background: #eef2f7 !important;
            color: #000;
            padding: 3px 6px 3px 9px;
            border-radius: 4px;
            margin-right: 0.375rem;
        }

        .bg-graycard {
            background: #E0E9FC !important;
            border-radius: 6px;
        }

        .cm {
            margin-top: 16px !important;
            page-break-inside: avoid !important;
        }

        .main-header {
            font-size: 22px !important;
        }

        .main-header-date {
            color: gray;
            font-weight: 500;
        }

        .main-logo {
            width: 100px;
        }

        .f14 {
            font-size: 14px;
        }

        .f12 {
            font-size: 12px;
        }

        .bg-grasy h4 {
            font-size: 12px !important;
        }

        .footer-sign {
            height: 120px;
            width: 160px;
        }

        .text-gray {
            color: gray;
        }

        h5 {
            font-size: 12px;
            margin: 0 0 4px;
        }

        .lead {
            font-size: 14px !important;
        }

        .f12 {
            font-size: 12px !important;
        }
        .bg-grasy .mb-2:last-child {
            display: none;
        }
        .bg-grasy1 {
            background: #fff;
            border: 1px solid lightgray;
        }
        .f20 {
            font-size: 20px;
        }
        #gen_dec > tbody > tr > th{
            width: 45% !important;
            border-right: 1px solid #e2e8ed !important;
        }
        #gen_dec tbody tr:nth-child(even) {
        background-color: #fff !important;
        }
        #gen_dec tr:last-child th{
            border-bottom: unset !important;
        }
        #gen_dec tr td{
            border-bottom: 1px solid #e2e8ed;
        }
        #gen_dec tr:last-child td{
            border-bottom: unset !important;
        }
        #gen_dec{
            outline: 1px solid #1A47A3 !important;
            border-radius: unset !important;
            border-color: #eaf1ff !important;
        }
        #gen_dec > tbody > tr > th,
        #gen_dec > tbody > tr > td,
        #gen_dec > thead > tr > th,
        #gen_dec > thead > tr > th {
            padding: 1px 8px !important;
        }
        .snagReported{
            background-color: #FFF7CE;
            color: #A88300;
            padding: 2px 10px;
            border-radius: 5px;
        }
        .snagResolved{
            background-color: #D9FFCC;
            color: #00A141;
            padding: 2px 10px;
            border-radius: 5px;
        }
    </style>
    <div class="col-md-12 mt-3 d-flex justify-content-start">
        <a href="{{ url()->previous() }}">
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
                            <div class="d-flex align-items-end">
                                <h4 class="main-header my-0">{{ $data['report_name'] }}</h4>

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


                    @foreach ($data['bre_photo_inspection_items'] as $type => $bre_photo_inspection_items)
                    @php
                    $bre_photo_inspection_items = $bre_photo_inspection_items->toArray();
                    $bre_photo_inspection_items = array_filter($bre_photo_inspection_items, function($item){
                        return $item['option_value'] !== "NA";
                        // dd($item);
                    });
                    @endphp
                    @if(sizeOf($bre_photo_inspection_items))
                        <div class="cm my-1 borders">

                            <div>
                                <h3 class="text-theme f14 mb-1 mt-0">{{ $type }}</h3>
                            </div>
                            <div class="border-card px-1 pt-1 bg-grasy">
                                @foreach ($bre_photo_inspection_items as $bre_photo_inspection_item)
                                @php
                                    $bre_snag = $data['bre_snag']->toArray();
                                    $phid = $bre_photo_inspection_item['id'];
                                    $bre_snag = array_values(array_filter($bre_snag, function($item) use ($phid){
                                        return $item['fk_photo_inspection_id'] == $phid;
                                    }));
                                    if(sizeOf($bre_snag)){
                                        $breSnag = $bre_snag[0];
                                    }else{
                                        $breSnag = null;
                                    }
                                @endphp
                                    @if ($bre_photo_inspection_item['option_value'] == 'Yes' || $bre_photo_inspection_item['option_value'] == 'No')
                                        <h5 class="text-black">{{ $bre_photo_inspection_item['bre_item']['item'] ?? '' }}
                                        </h5>
                                        <div class="mb-1">
                                            <span>
                                                <b
                                                    class="text-black f12 @if ($bre_photo_inspection_item['option_value'] == 'Yes') clrYes @elseif($bre_photo_inspection_item['option_value'] == 'No') clrNo @else clrNA @endif">
                                                    {{ $bre_photo_inspection_item['option_value'] }}
                                                </b>
                                            </span>
                                            <span class="f12">
                                                {{ $bre_photo_inspection_item['bre_question']['item'] ?? '' }}
                                            </span>

                                        </div>
                                        <div class="row mx-0">
                                            @for ($i = 1; $i <= 10; $i++)
                                                @if (trim($bre_photo_inspection_item['image' . $i] ?? '') != '')
                                                    <div class="col-sm-12 col-md-4 px-0 py-0 col-lg-4 d-flex justify-content-start"
                                                        style="max-width:fit-content;">
                                                        <img class="me-1 mb-1 img-fluid"
                                                            style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;"
                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $bre_photo_inspection_item['image' . $i]) }}">
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>

                                        @if (trim($bre_photo_inspection_item['comments'] ?? ''))
                                            <div>
                                                <div>
                                                    <p class="mb-1 f12"><b class="text-black f12">Comment:
                                                        </b>{{ $bre_photo_inspection_item['comments'] }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        @if($breSnag != null)
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h5 class="text-black m-0">Snag Item</h5>
                                            @if($breSnag['status'] == "Open")
                                            <span class="snagReported f12">Snag Reported!</span>
                                            @else
                                            <span class="snagResolved f12">Snag Resolved!</span>
                                            @endif
                                        </div>
                                        <table class="table mb-2" id="gen_dec">
                                            <tbody>
                                                <tr>
                                                    <th>Item Name</th>
                                                    <td>{{ $breSnag['item_name'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Priority</th>
                                                    <td>{{ $breSnag['priority'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Measure</th>
                                                    <td>{{ $breSnag['is_measure'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>{{ $breSnag['status'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>General Comment</th>
                                                    <td>{{ $breSnag['general_comment'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tagged Contractor</th>
                                                    <td>{{ $breSnag['contractor_name'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        @if(sizeOf($breSnag['comments']))
                                        @foreach($breSnag['comments'] as $comment)
                                        @if(trim($comment['comment']) != "")
                                        <h5 class="text-black m-0">Comment</h5>
                                        <span>{{$comment['comment']}}</span>
                                        @endif
                                        <div class="row mx-0">
                                            @for ($i = 1; $i <= 5; $i++)
                                            @if (trim($comment['image' . $i] ?? '') != '')
                                            @php
                                                        $dataCheks = 1;
                                                        if($bre_photo_inspection_item['image'. $i] != "" && $comment['image'.$i] != ""){
                                                            $dataCheks = compareFiles(asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $bre_photo_inspection_item['image'. $i]),
                                                            asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/snag_photo/' . $comment['image'.$i]));
                                                        }
                                                    @endphp
                                                @if($dataCheks == 1)
                                                    <div class="col-sm-12 col-md-4 px-0 py-0 col-lg-4 d-flex justify-content-start"
                                                        style="max-width:fit-content;">
                                                        <img class="me-1 mb-1 img-fluid"
                                                            style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;"
                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/snag_photo/' . $comment['image' . $i]) }}">
                                                    </div>
                                                @endif
                                                @endif
                                            @endfor
                                        </div>
                                        
                                            @if (sizeof($comment['comment_reply']))
                                            @foreach ($comment['comment_reply'] as $reply)
                                            @if(trim($reply['comment']) != "")
                                            <h5 class="text-black m-0">Comment Reply:</h5>
                                            <span>{{$reply['comment']}}</span>
                                            @endif
                                            <div class="row mx-0">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if (trim($reply['image' . $i] ?? '') != '')
                                                        <div class="col-sm-12 col-md-4 px-0 py-0 col-lg-4 d-flex justify-content-start"
                                                            style="max-width:fit-content;">
                                                            <img class="me-1 mb-1 img-fluid"
                                                                style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;"
                                                                src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/snag_photo/' . $reply['image' . $i]) }}">
                                                        </div>
                                                    @endif
                                                @endfor
                                            </div>
                                            @endforeach
                                            @endif
                                        @endforeach
                                        @endif
                                        <div class="mb-2" style="border: 1px solid #e0e9fc;">
                                        </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @endforeach

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

    </div> <!-- end card-body -->
    </div> <!-- end card -->
    </div><!-- end col -->
    </div><!-- end row -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all elements with class .borders
            var bordersElements = document.querySelectorAll('.borders');

            bordersElements.forEach(function(bordersElement) {
                // Select the .card element inside .borders
                var cardElement = bordersElement.querySelector('.card');

                // Check if the .card element has an empty string as its content after trimming
                if (cardElement.innerHTML.trim() === '') {
                    // Add the d-none class to the current .borders element in the iteration
                    bordersElement.classList.add('d-none');
                }
            });
        });
    </script>
@endsection