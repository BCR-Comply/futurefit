@extends('layouts.dashboard.print')
@section('content')
    <style>
        .mybody {
            background-color: #eaf1ff !important;
        }

        .f20 {
            font-size: 20px;
        }

        .f16 {
            font-size: 16px;
        }

        .bg-grays {
            border: 0.5px solid #1A47A3 !important;
            background-color: #fff !important;
            border-radius: 6px;
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
            background: #fff !important;
            border-radius: 6px;
        }

        .bg-grasy .mb-2:last-child {
            display: none;
        }

        h5 {
            font-size: 12px;
            margin: 0 0 4px;
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
    <div class="row">
        <div class="col-12">
            <div class="">
                <div class="">
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
                                        <div class="row" style="page-break-inside: avoid !important;">
                                            <div class="masonry-grid">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    @if (trim($bre_photo_inspection_item['image' . $i] ?? '') != '')
                                                        <div>
                                                            <img class="mb-1 img-fluid"
                                                                style="border-radius:6px; page-break-inside: avoid !important;"
                                                                src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $bre_photo_inspection_item['image' . $i]) }}">
                                                        </div>
                                                    @endif
                                                @endfor
                                            </div>
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
                                                    <th style="font-size: 12px; padding: 1px 8px !important;width: 50%;">Item Name</th>
                                                    <td style="font-size: 12px; padding: 1px 8px !important;width: 50%;">{{ $breSnag['item_name'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size: 12px; padding: 1px 8px !important;width: 50%;">Priority</th>
                                                    <td style="font-size: 12px; padding: 1px 8px !important;width: 50%;">{{ $breSnag['priority'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size: 12px; padding: 1px 8px !important;width: 50%;">Measure</th>
                                                    <td style="font-size: 12px; padding: 1px 8px !important;width: 50%;">{{ $breSnag['is_measure'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size: 12px; padding: 1px 8px !important;width: 50%;">Status</th>
                                                    <td style="font-size: 12px; padding: 1px 8px !important;width: 50%;">{{ $breSnag['status'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size: 12px; padding: 1px 8px !important;width: 50%;">General Comment</th>
                                                    <td style="font-size: 12px; padding: 1px 8px !important;width: 50%;">{{ $breSnag['general_comment'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size: 12px; padding: 1px 8px !important;width: 50%;">Tagged Contractor</th>
                                                    <td style="font-size: 12px; padding: 1px 8px !important;width: 50%;">{{ $breSnag['contractor_name'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        @if(sizeOf($breSnag['comments']))
                                        @foreach($breSnag['comments'] as $comment)
                                        @if(trim($comment['comment']) != "")
                                        <h5 class="text-black m-0">Comment</h5>
                                        <span>{{$comment['comment']}}</span>
                                        @endif
                                        <div class="row" style="page-break-inside: avoid !important;">
                                            <div class="masonry-grid">
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
                                                        <div>
                                                            <img class="mb-1 img-fluid"
                                                                style="border-radius:6px; page-break-inside: avoid !important;"
                                                                src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/snag_photo/' . $comment['image' . $i]) }}">
                                                        </div>
                                                        @endif
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                            @if (sizeof($comment['comment_reply']))
                                            @foreach ($comment['comment_reply'] as $reply)
                                            @if(trim($reply['comment']) != "")
                                            <h5 class="text-black m-0">Comment Reply:</h5>
                                            <span>{{$reply['comment']}}</span>
                                            @endif
                                            <div class="row" style="page-break-inside: avoid !important;">
                                                <div class="masonry-grid">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if (trim($reply['image' . $i] ?? '') != '')
                                                            <div>
                                                                <img class="mb-1 img-fluid"
                                                                    style="border-radius:6px; page-break-inside: avoid !important;"
                                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/snag_photo/' . $reply['image' . $i]) }}">
                                                            </div>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        @endforeach
                                        @endif
                                        @endif
                                        <div class="mb-2" style="border: 1px solid #e0e9fc;">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
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