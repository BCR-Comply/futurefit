@extends('layouts.dashboard.app')
@push('styles')
    <link href="{{ asset('assets/plugins/dhtmlxgantt/dhtmlxgantt.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/color.css') }}" rel="stylesheet" />
@endpush

@section('content')

    <style>
        table {
            outline-offset: -1px !important;
        }
        .table.table-bordered.dataTable td:first-child{
            max-width: 16pc;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        tr td:not(:last-child),
        tr th:not(:last-child) {
            border-right: 1px solid #e6e6e6 !important;
        }

        .bg-dark-navy {
            background: #313A46;
        }

        .gantt_task_scale>.gantt_scale_line:nth-child(2) .gantt_scale_cell {
            font-size: 8px !important;
        }

        /* .propcart{
                                            background-color: #e2e8ed;
                                        } */
        .dataTables_scrollHeadInner {
            width: auto !important;
        }

        .conjcart {
            background-color: #fff;
            border-radius: 10px !important;
        }

        .conjcart>div>table,
        .conjcart>div>table>th {
            background-color: #fff !important;
            border-radius: 10px !important;
        }

        .propcart {
            background-color: #fff;
            border-radius: 10px !important;
        }

        /* .conjcart > div > table, .conjcart > div > table > th{
                                background-color: #fff !important;
                                border-radius: 10px !important;
                            } */
        .filtercart {
            background-color: #fff;
            border-radius: 10px !important;
        }

        .gantt_task_line {
            /* height: 30px !important;
                            line-height: 30px !important; */
            border-radius: 3px !important;
        }

        .gantt_row.gantt_row_task {
            background-color: #e2e8ed !important;
        }

        .gantt_layout_cell {
            border-radius: 10px !important;
        }

        /*.filtercart > div > table, .filtercart > div > table > th{
                                background-color: #fff !important;
                                border-radius: 10px !important;
                            } */
        .ipwlcart {
            background-color: #fff;
            border-radius: 10px !important;
        }

        .ipwlcart>div>table,
        .ipwlcart>div>table>th {
            background-color: #fff !important;
            border-radius: 10px !important;
        }

        .actioncart {
            background-color: #fff;
            border-radius: 10px !important;
        }

        .actioncart>div>table,
        .actioncart>div>table>th {
            background-color: #fff !important;
            border-radius: 8px !important;
        }

        .dt-button {
            background-color: #fff !important;
            padding: 0.45rem 0.65rem !important;
        }

        .propcsv,
        .conjcsv,
        .actioncsv,
        .filtercsv,
        .ipwlcsv,
        .propcsv1,
        .conjcsv1,
        .actioncsv1,
        .filtercsv1,
        .ipwlcsv1 {
            cursor: pointer;
        }

        #contractor-properties-gantt {
            padding-left: unset;
        }

        .borderBottomRedius {
            /* border-radius: 10px !important; */
            border-bottom-left-radius: 5px !important;
            border-bottom-right-radius: 5px !important;
        }

        .dataTables_scrollBody {
            max-height: 500px;
        }

        .trans180 {
            transform: rotate(180deg) !important;
        }

        /* temp fix */
        .h-33px {
            height: 33px;
        }

        .select2-selection__rendered {
            line-height: 31px !important;
        }

        .select2-container .select2-selection--single {
            height: 35px !important;
        }

        .select2-selection__arrow {
            height: 34px !important;
        }

        .gantt_grid_head_cell {
            font-weight: bold;
        }

        /* .gantt_layout_cell.grid_cell.gantt_layout_outer_scroll.gantt_layout_outer_scroll_vertical.gantt_layout_outer_scroll.gantt_layout_outer_scroll_horizontal.gantt_layout_cell_border_right{
                            width: 300px !important;
                        }
                        .gantt_layout_cell.timeline_cell.gantt_layout_outer_scroll.gantt_layout_outer_scroll_vertical.gantt_layout_outer_scroll.gantt_layout_outer_scroll_horizontal{
                            width: -webkit-fill-available !important;
                        } */
        /* .gantt_cell.gantt_cell_tree{
                            width: 240px !important;
                        }
                        .gantt_cell.gantt_last_cell{
                            width: 60px !important;
                        } */
        .gantt_scale_cell div.today-column {
            border-left: 1px solid #FF4539 !important;
        }

        .gantt_task_cell.today-column {
            border-left: 1px solid #FF4539 !important;
        }

        .gantt_scale_cell {
            font-weight: bold;
        }

        .bold-class {
            font-weight: bold;
        }

        #logs-datatable> :not(caption)>*>* {
            padding: 0.5rem 0.5rem !important;
        }

        #post-work-logs-datatable> :not(caption)>*>* {
            padding: 0.5rem 0.5rem !important;
        }

        .dashrbtn,
        .dashrbtn:hover {
            color: #D33737;
            font-size: 16px;
            left: 2px;
            top: 4px;
        }
    </style>

    @php
        $colors = [
            '#ece9fe',
            // '#8EF7C9', //(Light Green)
            '#fee9e9',
            // '#DAC8FF',
            '#e9fefa',
            // '#80CFFF', //(Light Blue)
            '#e9f7fe',
            // '#FFFA92', //(Light Yellow)
            '#fef8e9',
            // '#FF9C6E', //(Light Orange)
            '#fbe9fe',
            // '#FF7D86', //(Light Red)
            '#BDBDBD', //(Light Gray)
            '#66FFFF', //(Light Aqua)
            '#FF6852', //(Light Vermilion)
            '#FF77A9', //(Light Fuchsia)
            '#80FF91', //(Light Lime Green)
            '#FF6852', //(Light Deep Orange)
            '#80E8FF', //(Light Cyan)
            '#DA91FF', //(Light Lavender)
            '#FFA040', //(Light Dark Orange)
            '#FF7570', //(Light Crimson)
            '#DCE775', //(Light Lime)
            '#64B5F6', //(Light Dodger Blue)
            '#FF9600', //(Light Amber)
            '#AED581', //(Light Green)
            '#FF6852', //(Light Tomato)
            '#8D6E63', //(Light Brown)
            '#80F8FF', //(Light Turquoise)
            '#DFB8FF', //(Light Purple)
            '#CFF1D1',
            '#EC407A', //(Light Raspberry)
            '#80F8FF', //(Light Sky Blue)
            '#FFD95E', //(Light Sunflower)
            '#FF7575', //(Light Watermelon)
            '#26A69A', //(Light Teal)
            '#B2D7F7',
            '#FFB2D9',
            '#FFECB3',
            '#B2E5E5',
            '#FFD9B3',
            '#FFB2B2',
            '#C6FFC6',
            '#A669A6',
            '#E5FFB2',
            '#C7A275',
            '#FFB2FF',
            '#A8A3C6',
            '#A3FFA3',
            '#FFA68B',
            '#662121',
            '#669999',
            '#FFD2E1',
            '#CFCFCF',
            '#FFEDB2',
            '#96E5E5',
            '#FFC6B2',
            '#B8AED1',
            '#808B8D',
            '#FF77A9', //(Light Pink)
            '#FFE863', //(Light Gold)
        ];

    @endphp


    <h4 class="mt-4 hex-black">Overview</h4>
    @if (Auth::user()->role == 'admin')
        <div class="row mt-2 g-3">

            @php
                $batches_count = 0;
                function hexToRgba($hex, $opacity = 1)
                {
                    // Remove the leading '#' if present
                    $hex = ltrim($hex, '#');

                    // Convert shorthand to full form (e.g., "abc" to "aabbcc")
                    if (strlen($hex) === 3) {
                        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
                    }

                    // Get RGB values
                    $r = hexdec(substr($hex, 0, 2));
                    $g = hexdec(substr($hex, 2, 2));
                    $b = hexdec(substr($hex, 4, 2));

                    // Convert to RGBA
                    $rgba = "rgba($r, $g, $b, $opacity)";

                    return $rgba;
                }
            @endphp

            @foreach (array_values($batch_schemes) as $kst => $scheme)
                @php
                    if ($scheme['logo'] != null) {
                        $imgC = asset('assets/images/schemes/' . $scheme['logo']);
                        $svgContent = file_get_contents($imgC);
                        $newFillColor = $scheme['color'];
                        $svgContent = str_replace('#333333', $newFillColor, $svgContent);
                        header('Content-Type: image/svg+xml');
                    } else {
                        $svgContent = '';
                    }

                @endphp
                <div class="col-sm-6 col-md-4 col-lg-4 m-0">
                    {{-- <a href="{{ route('property', $scheme['id']) }}"> --}}
                        <a href="@if($scheme['scheme'] != "Leads") {{ route('property', $scheme['id']) }} @else {{ route('lead', $scheme['id']) }}@endif">
                        <div class="card widget-flat _shadow-1"
                            style="background: {{ $rgbaColor = hexToRgba($scheme['color'], 0.1) }}">
                            <div class="card-body text-black">
                                <div class="float-end">
                                </div>
                                <div class="d-flex justify-content-between mt-2 mb-2">
                                    <div class="d-flex">
                                        <h4 class="fw-normal mt-0" title="{{ $scheme['scheme'] }}">{{ $scheme['scheme'] }}<small style="margin-top: 2px" class="ml-1">scheme</small></h4>
                                    </div>

                                    <div>
                                        {!! $svgContent !!}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 mb-2 pr-2"><span
                                        class="">Batches</span>
                                    <span>{{ $scheme['batch_count'] }}</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2 mb-2 pr-2"><span
                                        class="">Properties</span>
                                    <span>{{ $scheme['property_count'] }}</span>
                                </div>
                            </div> <!-- end card-body text-white-->
                        </div> <!-- end card-->
                    </a>
                </div> <!-- end col-->
            @endforeach

        </div> <!-- end row -->


        <div class="row">

            <div class="col-md-12">

                <div class="mt-2 mb-2 porelative">

                    <div class="card-header mb-2 _shadow-1 d-flex justify-content-between align-items-center propcsv1">
                        <h4 class="my-0">Properties</h4>

                        <svg class="propcsv trans180" width="15" height="9" viewBox="0 0 15 9" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.293016 2.20711L6.65698 8.57107C7.0475 8.96159 7.68067 8.96159 8.07119 8.57107L14.4352 2.2071C14.8257 1.81658 14.8257 1.18342 14.4352 0.792892C14.0446 0.402368 13.4115 0.402368 13.0209 0.792892L8.36408 5.44975L7.36414 6.36426L6.36408 5.44975L1.70723 0.792893C1.3167 0.402369 0.68354 0.402369 0.293015 0.792893C-0.097509 1.18342 -0.0975089 1.81658 0.293016 2.20711Z"
                                fill="black" />
                        </svg>

                    </div>
                    <div class="card-body _shadow-1 propcart">

                        <div class="row cs-mrgn">
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <select class="form-control h-33px" name="properties_scheme" id="properties_scheme">
                                        <option value="">Select Scheme</option>
                                        @foreach ($batch_schemes as $batch_scheme)
                                            <option value="{{ $batch_scheme['id'] }}">{{ $batch_scheme['scheme'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4 px-0">
                                <div class="form-group">
                                    <select class="form-control h-33px" id="properties_batch" name="properties_batch">
                                        <option value="">Select Batch</option>
                                        @foreach ($batches as $batch)
                                            <option value="{{ $batch->id }}">{{ $batch->our_ref }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <select class="form-control h-33px" name="jobs[]" title="Select Jobs"
                                        id="properties_jobs" multiple>
                                        @foreach ($jobs as $job)
                                            <option value="{{ $job->title }}">{{ $job->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered text-nowrap w-100" id="dashboard_properties_with_statuses"
                            style="max-height: 500px !important">
                            <thead>
                                <tr>
                                    <th class="text-uppercase"
                                        style="background: #1A47A3 !important; opacity: 1; z-index: 1;min-width:16pc;">
                                        Address</th>
                                    <th class="text-uppercase" style="min-width: 5pc;">Status</th>
                                    @foreach ($jobs as $key => $entry)
                                        <th class="text-uppercase" style="min-width: 4.5pc;">
                                            {{ shortName($entry['title']) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                        </table>

                    </div>

                </div>
            </div>
        </div>
        <div class="row">

            {{-- <div class="col-md-12">

                <div class="mt-2 mb-2 porelative">

                    <div class="card-header mb-2 _shadow-1 d-flex justify-content-between align-items-center conjcsv1">
                        <h4 class="my-0">Contractor Jobs</h4>
                        <svg class="conjcsv" width="15" height="9" viewBox="0 0 15 9" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.293016 2.20711L6.65698 8.57107C7.0475 8.96159 7.68067 8.96159 8.07119 8.57107L14.4352 2.2071C14.8257 1.81658 14.8257 1.18342 14.4352 0.792892C14.0446 0.402368 13.4115 0.402368 13.0209 0.792892L8.36408 5.44975L7.36414 6.36426L6.36408 5.44975L1.70723 0.792893C1.3167 0.402369 0.68354 0.402369 0.293015 0.792893C-0.097509 1.18342 -0.0975089 1.81658 0.293016 2.20711Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div class="card-body _shadow-1 conjcart d-none">

                        <div class="row mb-2">
                            <div class="col-sm-6 col-md-4 col-lg-2">
                                <div class="form-group">
                                    <div>
                                    </div>
                                    <select id="dashboard_job_filter_select" class="form-control">
                                        <option value="">Select Job</option>
                                        @foreach ($jobs as $job)
                                            <option value="{{ $job->title }}">{{ $job->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <table id="dashboard-contractor-jobs-datatable"
                            class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>OCCUPIER</th>
                                    <th>ADDRESS</th>
                                    <th>EIRCODE</th>
                                    <th>PHONE</th>
                                    <th>PROPERTY ADDED</th>
                                    <th>MPRN</th>
                                    <th>SCHEME</th>
                                    <th>BATCH REF</th>
                                    <th>JOB</th>
                                    <th>CONTRACTOR</th>
                                    <th>START DATE</th>
                                    <th>END DATE</th>
                                    <th>STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>

            </div> --}}


            <div class="col-md-12">

                <div class="mt-2 mb-2 porelative">

                    <div class="card-header mb-2 _shadow-1 d-flex justify-content-between align-items-center actioncsv1">

                        <h4 class="my-0">Action Logs</h4>

                        <svg class="actioncsv" width="15" height="9" viewBox="0 0 15 9" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.293016 2.20711L6.65698 8.57107C7.0475 8.96159 7.68067 8.96159 8.07119 8.57107L14.4352 2.2071C14.8257 1.81658 14.8257 1.18342 14.4352 0.792892C14.0446 0.402368 13.4115 0.402368 13.0209 0.792892L8.36408 5.44975L7.36414 6.36426L6.36408 5.44975L1.70723 0.792893C1.3167 0.402369 0.68354 0.402369 0.293015 0.792893C-0.097509 1.18342 -0.0975089 1.81658 0.293016 2.20711Z"
                                fill="black" />
                        </svg>

                    </div>
                    <div class="card-body _shadow-1 actioncart d-none">

                        <table id="logs-datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>AUTHOR</th>
                                    <th>TYPE</th>
                                    <th>FIRST NAME</th>
                                    <th>LAST NAME</th>
                                    <th>ADDRESS</th>
                                    <th style="width: 70px">ACTION</th>
                                </tr>
                            </thead>
                        </table>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->

            </div>
            <div class="col-md-12">

                <div class="mt-2 mb-2 porelative">

                    <div class="card-header mb-2 _shadow-1 d-flex justify-content-between align-items-center ipwlcsv1">
                        <h4 class="my-0">Incomplete Post Work Log(s)</h4>
                        <svg class="ipwlcsv" width="15" height="9" viewBox="0 0 15 9" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.293016 2.20711L6.65698 8.57107C7.0475 8.96159 7.68067 8.96159 8.07119 8.57107L14.4352 2.2071C14.8257 1.81658 14.8257 1.18342 14.4352 0.792892C14.0446 0.402368 13.4115 0.402368 13.0209 0.792892L8.36408 5.44975L7.36414 6.36426L6.36408 5.44975L1.70723 0.792893C1.3167 0.402369 0.68354 0.402369 0.293015 0.792893C-0.097509 1.18342 -0.0975089 1.81658 0.293016 2.20711Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div class="card-body _shadow-1 ipwlcart d-none">

                        <table id="post-work-logs-datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="text-uppercase">Id</th>
                                    <th class="text-uppercase">Address</th>
                                    <th class="text-uppercase">Notes</th>
                                    <th class="text-uppercase">Status</th>
                                    <th class="text-uppercase">Date Added</th>
                                    <th class="text-uppercase">Action</th>
                                </tr>
                            </thead>
                        </table>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->

            </div>
            <div id="allrf" class="col-md-12">

                <div class="mt-2 mb-2 porelative">

                    <div class="card-header mb-2 _shadow-1 d-flex justify-content-between align-items-center ipwlcsv12">
                        <h4 class="my-0">Reminders</h4>
                        <svg class="ipwlcsv11" width="15" height="9" viewBox="0 0 15 9" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.293016 2.20711L6.65698 8.57107C7.0475 8.96159 7.68067 8.96159 8.07119 8.57107L14.4352 2.2071C14.8257 1.81658 14.8257 1.18342 14.4352 0.792892C14.0446 0.402368 13.4115 0.402368 13.0209 0.792892L8.36408 5.44975L7.36414 6.36426L6.36408 5.44975L1.70723 0.792893C1.3167 0.402369 0.68354 0.402369 0.293015 0.792893C-0.097509 1.18342 -0.0975089 1.81658 0.293016 2.20711Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div class="card-body _shadow-1 ipwlcart2 d-none">
                        <li class="d-flex align-items-center mb-2">
                            <span class="pl-1 mr-1 me-2 text-blue"><b>Show</b></span>
                            <div id="reportrangedash"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;border-radius:8px;">
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </li>
                        <div class="d-flex flex-row flex-sm-row flex-column flex-wrap appnedLisdash">
                            @if (sizeOf($reminders))
                                @foreach ($reminders as $reminder)
                                    <div class="myremListD checkHide dashremlis">
                                        <div class="dropdown-item myremList myremListdash"
                                            data-pid="{{ Crypt::encrypt($reminder->property_id) }}"
                                            data-id="{{ $reminder->id }}" style="color:#1A47A3;">
                                            {{-- <div class="dropdown-item myremList" data-id="{{ $reminder->id }}" style="color:#1A47A3;"> --}}
                                            <div class="d-flex justify-content-between">
                                                <h5 class=" mb-0"
                                                    style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;max-width: 50%;">
                                                    <b>{{ $reminder['title'] }}</b>
                                                </h5>
                                                <a aria-hidden="true" class="text-bluess rdbtn dashrbtn"
                                                    data-href="{{ route('property.deleteReminder', $reminder['id']) }}"><i
                                                        class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="parent" style="text-overflow: ellipsis;overflow: hidden;">
                                                <p class="mb-0" style="text-overflow: ellipsis;overflow: hidden;">
                                                    {{ $reminder['notes'] ? $reminder['notes'] : 'N/A' }}</p>
                                                <b class="">Property: </b>
                                                <span>{{ $reminder['address'] }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class=""><b class="">Due:
                                                    </b>{{ date('d/m/Y', strtotime($reminder['due_date'])) . ' ' . date('h:i A', strtotime($reminder['due_time'])) }}
                                                </div>
                                                <div>
                                                    <small>
                                                        <span
                                                            class="clickStatusChange @if ($reminder['status'] == 'Complete') compl @else inprog @endif"
                                                            data-id="{{ $reminder['id'] }}"
                                                            data-status="{{ $reminder['status'] }}"
                                                            style="padding: 2px 8px;" data-toggle="modal"
                                                            data-target="#changeRemModal">
                                                            @if ($reminder['status'] == 'Complete')
                                                                Complete
                                                            @else
                                                                Pending
                                                            @endif
                                                        </span>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <span style="margin: 15px auto;">Reminders Not available</span>
                            @endif
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->

            </div>
        </div>
    @endif


    @if (Auth::user()->role == 'contractor')
        <div class="row mt-3">
            <div class="col-12 card _shadow-1">
                <div class="d-flex align-items-center">
                    <h4 class="text-info">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h4>
                    <span class="text-secondary"> &nbsp | {{ Auth::user()->email }}</span>
                    <span class="text-secondary"> &nbsp | {{ Auth::user()->phone }}</span>
                </div>

                <form method="POST" action="{{ route('contractor.updateEmergencyDetail') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <u>Cost: €{{ $contractCost }}</u>
                    <div>
                        <h5 class="text-info">Emergency Details</h5>

                        @if (trim(Auth::user()->contractor_next_of_kin_name) == '' ||
                                trim(Auth::user()->contractor_next_of_kin_phone) == '' ||
                                trim(Auth::user()->contractor_safe_pass_photo) == '' ||
                                trim(Auth::user()->contractor_safe_pass_expiry) == '' ||
                                trim(Auth::user()->contractor_agree_to_health_and_safety_procedure == ''))
                            <div class="alert alert-danger">
                                <p class="my-0"><b>Action Required: </b> Please complete your profile.</p>
                            </div>
                        @endif

                        @if (trim(Auth::user()->contractor_safe_pass_expiry) != '' && Auth::user()->contractor_safe_pass_expiry < NOW())
                            <div class="alert alert-danger">
                                <p class="my-0"><b>Please Note: </b> Safepass has expired.</p>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="contractor_next_of_kin_name" class="form-label">Next of Kin</label>
                                    <input
                                        value="{{ Auth::user()->contractor_next_of_kin_name ?? old('contractor_next_of_kin_name') }}"
                                        type="text" name="contractor_next_of_kin_name"
                                        id="contractor_next_of_kin_name"
                                        class="form-control  @error('contractor_next_of_kin_name') is-invalid @enderror"
                                        placeholder="Enter Name">
                                    @error('contractor_next_of_kin_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="contractor_next_of_kin_phone" class="form-label">Next of Kin
                                        Phone/Mobile</label>
                                    <input
                                        value="{{ Auth::user()->contractor_next_of_kin_phone ?? old('contractor_next_of_kin_phone') }}"
                                        type="text" name="contractor_next_of_kin_phone"
                                        id="contractor_next_of_kin_phone"
                                        class="form-control  @error('contractor_next_of_kin_phone') is-invalid @enderror"
                                        placeholder="Enter Phone/Mobile">
                                    @error('contractor_next_of_kin_phone')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="contractor_safe_pass_photo" class="form-label">Safepass Photo (Max
                                        1mb)</label>
                                    <input type="file" name="contractor_safe_pass_photo"
                                        id="contractor_safe_pass_photo"
                                        class="form-control  @error('contractor_safe_pass_photo') is-invalid @enderror"
                                        placeholder="Upload Photo" accept="image/*">
                                    @error('contractor_safe_pass_photo')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @if (Auth::user()->contractor_safe_pass_photo != '')
                                        <div class="p-2">
                                            <img class="img-fluid"
                                                src="{{ asset('/files/' . Auth::user()->contractor_safe_pass_photo) }}"
                                                width="300">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="contractor_safe_pass_expiry" class="form-label">Safepass Expiry</label>
                                    <input
                                        value="{{ Auth::user()->contractor_safe_pass_expiry ?? old('contractor_safe_pass_expiry') }}"
                                        type="date" name="contractor_safe_pass_expiry"
                                        id="contractor_safe_pass_expiry"
                                        class="form-control  @error('contractor_safe_pass_expiry') is-invalid @enderror"
                                        placeholder="Pick Safepass Expiry">
                                    @error('contractor_safe_pass_expiry')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label for="contractor_medical_issue" class="form-label">Medical Issue(s)</label>
                                    <textarea name="contractor_medical_issue" id="contractor_medical_issue" rows="3" class="form-control"
                                        placeholder="Enter Health Issue(s)">{{ Auth::user()->contractor_medical_issue ?? '' }}</textarea>

                                    @error('contractor_medical_issue')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <p class="px-1">* Only authorised staff will access these details.</p>

                                <div class="d-flex align-items-center px-1">
                                    <input name="contractor_agree_to_health_and_safety_procedure" value="1"
                                        type="checkbox"
                                        {{ Auth::user()->contractor_agree_to_health_and_safety_procedure == '1' ? 'checked' : '' }}>
                                    <div class="pl-2">
                                        I agree to <a href="#">health and safety procedures</a>
                                    </div>
                                </div>

                                @error('contractor_agree_to_health_and_safety_procedure')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="form-group">
                                <button type="submit" class="btn _btn-primary float-end">UPDATE DETAIL</button>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    @endif

    {{-- Calendar Modal:: start here --}}
    {{-- <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendar_modal_title">Modal title</h5>
                    <span onclick="closeModal();" class="pointer" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </span>
                </div>
                <div class="modal-body" id="calendar-modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal();">Close</button>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- Calendar Modal:: end here --}}

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/_vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dhtmlxgantt/dhtmlxgantt.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script>
        function CountGantt() {
            var ganttScaleLines = $('.gantt_task_scale > .gantt_scale_line:nth-child(2) .gantt_scale_cell > div');
            var weekendColumnIndexes = [];
            var weekendColumnIndexes2 = [];

            ganttScaleLines.each(function(index, element) {
                if ($(element).hasClass('weekend-column')) {
                    weekendColumnIndexes.push(index);
                }
                if ($(element).hasClass('today-column')) {
                    weekendColumnIndexes2.push(index);
                }
            });

            $('.gantt_task_row').each(function(rowIndex, rowElement) {
                $(rowElement).find('.gantt_task_cell > div').removeClass('weekend-column');
                $(rowElement).find('.gantt_task_cell > div').removeClass('today-column');
                // Iterate over .gantt_task_cell elements inside each .gantt_task_row
                $(rowElement).find('.gantt_task_cell').each(function(cellIndex, cellElement) {
                    // Check if the current .gantt_task_cell index is in the weekendColumnIndexes
                    if (weekendColumnIndexes.includes(cellIndex)) {
                        // If yes, add the class to the current .gantt_task_cell
                        $(cellElement).addClass('weekend-column');
                    }
                    if (weekendColumnIndexes2.includes(cellIndex)) {
                        // If yes, add the class to the current .gantt_task_cell
                        $(cellElement).addClass('today-column');
                    }
                });
            });
        }

        $(document).ready(function() {

            CountGantt();
            $(document).on('click', '.view-actionlog-btn', function(e) {
                localStorage.setItem('selectedFilter', 'timesheet');
            });
            $(document).on('mousedown', '.view-actionlog-btn', function(e) {
                if (e.which === 2) {
                    localStorage.setItem('selectedFilter', 'timesheet');
                }
            });
            $(document).on('click', '.view-post-property', function(e) {
                localStorage.setItem('selectedFilter', 'con_l');
            });
            $(document).on('mousedown', '.view-post-property', function(e) {
                if (e.which === 2) {
                    localStorage.setItem('selectedFilter', 'con_l');
                }
            });
            $('.propcsv1').css({
                'color': '#1A47A3'
            });
            $('.conjcsv').addClass('trans180');
            // $('.propcsv').addClass('trans180');
            // $('.actioncsv').addClass('trans180');
            // $('.filtercsv').addClass('trans180');
            // $('.ipwlcsv').addClass('trans180');
            // $('.conjcsv').parent('.card-header').addClass('borderBottomRedius');
            // $('.propcsv').parent('.card-header').addClass('borderBottomRedius');
            // $('.actioncsv').parent('.card-header').addClass('borderBottomRedius');
            // $('.filtercsv').parent('.card-header').addClass('borderBottomRedius');
            // $('.ipwlcsv').parent('.card-header').addClass('borderBottomRedius');

            function formatDate(dateStr) {
                const date = new Date(dateStr);
                const dayAbbr = date.toLocaleDateString("en-US", {
                    weekday: "short"
                }).slice(0, 1);
                const dayNum = date.getDate().toString().padStart(2, "0");
                return `${dayAbbr}-${dayNum}`;
            }

            $('#logs-datatable_filter').css('top', 'unset');
            $('button[aria-controls="logs-datatable"]').css('top', '0');
            $('#post-work-logs-datatable_filter').css('top', 'unset');
            $('button[aria-controls="post-work-logs-datatable"]').css('top', '0');
        });

        $(document).on('click', '.propcsv1', function() {
            if (!$('.propcart').hasClass('d-none')) {
                $('.propcart').addClass('d-none');
                $(this).parent('.card-header').addClass('borderBottomRedius');
                $('.propcsv').removeClass('trans180');
                $('.propcsv1').css({
                    'color': '#6c757d'
                });
            } else {
                $(this).parent('.card-header').removeClass('borderBottomRedius');
                $('.propcart').removeClass('d-none');
                $('.propcsv').addClass('trans180');
                $('.propcsv1').css({
                    'color': '#1A47A3'
                });

            }
        });
        $(document).on('click', '.conjcsv1', function() {
            if (!$('.conjcart').hasClass('d-none')) {
                $('.conjcart').addClass('d-none');
                $(this).parent('.card-header').addClass('borderBottomRedius');
                $('.conjcsv').addClass('trans180');
                $('.conjcsv1').css({
                    'color': '#6c757d'
                });

            } else {
                $(this).parent('.card-header').removeClass('borderBottomRedius');
                $('.conjcart').removeClass('d-none');
                $('.conjcsv').removeClass('trans180');
                $('.conjcsv1').css({
                    'color': '#1A47A3'
                });

            }
        });
        $(document).on('click', '.actioncsv1', function() {
            if (!$('.actioncart').hasClass('d-none')) {
                $('.actioncart').addClass('d-none');
                $(this).parent('.card-header').addClass('borderBottomRedius');
                $('.actioncsv').removeClass('trans180');
                $('.actioncsv1').css({
                    'color': '#6c757d'
                });

            } else {
                $(this).parent('.card-header').removeClass('borderBottomRedius');
                $('.actioncart').removeClass('d-none');
                $('.actioncsv').addClass('trans180');
                $('.actioncsv1').css({
                    'color': '#1A47A3'
                });

            }
        });
        $(document).on('click', '.filtercsv1', function() {
            if (!$('.filtercart').hasClass('d-none')) {
                $('.filtercart').addClass('d-none');
                $(this).parent('.card-header').addClass('borderBottomRedius');
                $('.filtercsv').removeClass('trans180');
                $('.filtercsv1').css({
                    'color': '#6c757d'
                });

            } else {
                $(this).parent('.card-header').removeClass('borderBottomRedius');
                $('.filtercart').removeClass('d-none');
                $('.filtercsv').addClass('trans180');
                $('.filtercsv1').css({
                    'color': '#1A47A3'
                });

            }
        });
        $(document).on('click', '.ipwlcsv1', function() {
            if (!$('.ipwlcart').hasClass('d-none')) {
                $('.ipwlcart').addClass('d-none');
                $(this).parent('.card-header').addClass('borderBottomRedius');
                $('.ipwlcsv').removeClass('trans180');
                $('.ipwlcsv1').css({
                    'color': '#6c757d'
                });

            } else {
                $(this).parent('.card-header').removeClass('borderBottomRedius');
                $('.ipwlcart').removeClass('d-none');
                $('.ipwlcsv').addClass('trans180');
                $('.ipwlcsv1').css({
                    'color': '#1A47A3'
                });

            }
        });
        $(document).on('click', '.ipwlcsv12', function() {
            if (!$('.ipwlcart2').hasClass('d-none')) {
                $('.ipwlcart2').addClass('d-none');
                $(this).parent('.card-header').addClass('borderBottomRedius');
                $('.ipwlcsv11').removeClass('trans180');
                $('.ipwlcsv12').css({
                    'color': '#6c757d'
                });

            } else {
                $(this).parent('.card-header').removeClass('borderBottomRedius');
                $('.ipwlcart2').removeClass('d-none');
                $('.ipwlcsv11').addClass('trans180');
                $('.ipwlcsv12').css({
                    'color': '#1A47A3'
                });

            }
        });

        $(function() {
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end, label) {
                var rangeText = 'Select Filter';
                if (label != null && end != null && start.isValid() && end.isValid()) {
                    rangeText = start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY');
                }
                $('#reportrangedash span').html(rangeText);
                var sdate = start.format('YYYY-MM-DD');
                var edate = end.format('YYYY-MM-DD');
                var range = label;
                var from = 'dash';
                if (label != null) {
                    $.ajax({
                        url: "{{ route('filterReminder') }}",
                        type: 'POST',
                        data: {
                            sdate: sdate,
                            edate: edate,
                            range: range,
                            from: from,
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: 'json',
                        success: function(response) {
                            var data = response.data;
                            if (response.success == true) {
                                $('.appnedLisdash').empty();
                                var html2 = '';
                                var sumIsRead = 0;
                                $.each(data, function(i, v) {
                                    html2 += '<div class="myremListD checkHide" data-when="' + v
                                        .when_time + '" style="background:#eaf1ff;">';
                                    html2 +=
                                        '<div class="dropdown-item myremListM myremList" data-id="' +
                                        v.id + '" style="color:#1A47A3;">';
                                    html2 += '<div class="d-flex justify-content-between">';
                                    html2 +=
                                        '<h5 class=" mb-0" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;max-width: 50%;"><b>' +
                                        v.title + '</b></h5>';
                                    html2 +=
                                        '<a aria-hidden="true" class="text-bluess rdbtn dashrbtn" data-href="' +
                                        '{{ route('property.deleteReminder', '') }}/' + v.id +
                                        '"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                                    html2 += '</div>';
                                    html2 +=
                                        '<div class="parent" style="text-overflow: ellipsis;overflow: hidden;">';
                                    if (v.notes != null) {
                                        html2 +=
                                            '<p class="mb-0 " style="text-overflow: ellipsis;overflow: hidden;">' +
                                            v.notes + '</p>';
                                    } else {
                                        html2 += '<p class="mb-0 ">N/A</p>';
                                    }
                                    html2 += '<b class="">Property: </b>';
                                    html2 += '<span>' + v.address + '</span>';
                                    html2 += '</div>';
                                    html2 += '<div class="d-flex justify-content-between">';
                                    html2 += '<div class=""><b class="">Due: </b>' +
                                        formatDate33(v.due_date, 'd/m/Y') + ' ' +
                                        convertTo12Hour(v.due_time) + '</div>';
                                    html2 += '<div><small><span class="' + (v.status ==
                                            'Complete' ? 'compl' : 'inprog') +
                                        '" style="padding: 2px 8px;">' + (v.status ==
                                            'Complete' ? 'Complete' : 'Pending') +
                                        '</span></small></div>';
                                    html2 += '</div>';
                                    html2 += '</div>';
                                    html2 += '</div>';
                                });
                                $('.appnedLisdash').prepend(html2);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', status, error);
                        }
                    });
                }
            }

            $('#reportrangedash').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    '1 Week': [moment(), moment().add(1, 'weeks')],
                    '2 Weeks': [moment(), moment().add(2, 'weeks')],
                    '1 Month': [moment(), moment().add(1, 'months')],
                    'All Reminders': [moment().startOf('year'), moment().endOf(
                            'year'
                            )] // Set start date to beginning of the year and end date to end of the year
                }
            }, function(start, end, label) {
                if (label === 'All Reminders') {
                    start = moment().startOf('year');
                    end = moment().endOf('year');
                    cb(start, end, label);
                } else {
                    cb(start, end, label);
                }
            });

            cb(start, end, null);
        });
    </script>
@endpush
