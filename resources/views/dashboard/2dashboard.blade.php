@extends('layouts.dashboard.app')
@push('styles')
    <link href="{{asset('assets/plugins/dhtmlxgantt/dhtmlxgantt.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/color.css')}}" rel="stylesheet" />
@endpush

@section('content')

    <style>
        .bg-dark-navy {
            background: #313A46;
        }

        .dataTables_scrollBody {
            max-height: 500px;
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
        .gantt_scale_cell{
            font-weight: bold;
        }
        .bold-class{
            font-weight: bold;
        }
    </style>

        @php
            $colors = [
                '#8EF7C9', //(Light Green)
                '#DAC8FF',
                '#80CFFF', //(Light Blue)
                '#FFFA92', //(Light Yellow)
                '#FF9C6E', //(Light Orange)
                '#FF7D86', //(Light Red)
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



    @if(Auth::user()->role == 'admin')

        <div class="row mt-3 g-3">

            @php
                $batches_count = 0
            @endphp

            @foreach($batch_schemes as $scheme)

                <div class="col-sm-6 col-md-3 col-lg-3 m-0">
                    <a href="{{route('property', $scheme['id'])}}">
                        <div class="card widget-flat _shadow-1"
                             style="background: {{$colors[$batches_count++]}}"
                        >
                            <div class="card-body text-black">
                                <div class="float-end">
                                </div>
                                <div class="d-flex">
                                    <h4 class="fw-normal mt-0" title="Number of Admins">{{$scheme['scheme']}}</h4>
                                    <small style="margin-top: 2px" class="ml-1">scheme</small>
                                </div>
                                <div class="d-flex justify-content-between"><span class="">Batches</span>
                                    <span>{{$scheme['batch_count']}}</span></div>
                                <div class="d-flex justify-content-between"><span class="">Properties</span>
                                    <span>{{$scheme['property_count']}}</span></div>
                            </div> <!-- end card-body text-white-->
                        </div> <!-- end card-->
                    </a>
                </div> <!-- end col-->

            @endforeach

        </div> <!-- end row -->


        <div class="row">

            <div class="col-md-12">

                <div class="card _shadow-1">

                    <div class="card-header">
                        <h4 class="my-0">Properties</h4>
                    </div>
                    <div class="card-body">

                        <div class="row mb-2">
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div>
                                        <label for="properties_batch">Batch</label>
                                    </div>
                                    <select class="form-control h-33px" id="properties_batch" name="properties_batch" >
                                        <option value=""></option>
                                        @foreach($batches as $batch)
                                            <option value="{{$batch->id}}">{{$batch->our_ref}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="properties_scheme" class="mr-1">Scheme</label>
                                    <select class="form-control h-33px" name="properties_scheme" id="properties_scheme">
                                        <option value=""></option>
                                        @foreach($batch_schemes as $batch_scheme)
                                            <option value="{{$batch_scheme['id']}}">{{$batch_scheme['scheme']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="jobs" class="mr-1">Jobs</label>
                                    <select class="form-control h-33px" name="jobs[]" id="properties_jobs" multiple="true">
                                        @foreach($jobs as $job)
                                            <option value="{{$job->title}}">{{$job->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered text-nowrap w-100" id="dashboard_properties_with_statuses" style="max-height: 500px !important">
                            <thead>
                                <tr>
                                    <th class="text-uppercase" style="background: white !important; opacity: 1; z-index: 1">Address</th>
                                    <th class="text-uppercase">Status</th>
                                    @foreach ($jobs as $key => $entry)
                                    <th class="text-uppercase">{{shortName($entry['title'])}}</th>
                                @endforeach
                                </tr>
                            </thead>
                        </table>

                    </div>

                </div>
            </div>
        </div>


        {{-- Calendar::start here --}}
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="card _shadow-1">
                    <div class="card-header">
                        <h4 class="my-0">Calendar</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2 pt-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jobs" class="mr-1">Jobs</label>
                                    <select class="form-control h-33px" name="jobs[]" id="calendar_jobs" multiple="true">
                                        @foreach($jobs as $job)
                                            <option value="{{$job->title}}">{{$job->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date" class="mr-1">Start Date</label>
                                    <input class="form-control" name="start_date" id="calendar_start_date" type="date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end_date" class="mr-1">End Date</label>
                                    <input class="form-control" name="end_date" id="calendar_end_date" type="date">
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row mb-2 pt-2">
                            <div class="col-sm-12" id="job-calendar"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div> -->
        {{-- Calendar::end here --}}


        {{-- Gantt Chart::start here --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card _shadow-1">
                    <div class="card-body">
                        <div class="row mb-2 pt-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gantt-date-filter" class="mr-1">Filter by date</label>
                                    <input class="form-control" name="gantt-date-filter" id="gantt-date-filter">
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <a class="btn _btn-primary btn-block" style="margin-top:21px;" href="{{ route('dashboard.contractor-properties-gantt') }}" target="_blank">View in full screen</a>
                            </div>
                        </div>
                        <hr/>

                        <div class="row mb-2 pt-2">
                            <div class="col-sm-12" id="contractor-properties-gantt"  style='overflow:hidden;'></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- Gantt Chart::end here --}}

        <div class="row">

            <div class="col-md-12">

                <div class="card _shadow-1">

                    <div class="card-header">
                        <h4 class="my-0">Contractor Jobs</h4>
                    </div>
                    <div class="card-body">

                        <div class="row mb-2">
                            <div class="col-sm-6 col-md-4 col-lg-2">
                                <div class="form-group">
                                    <div>
                                        <label for="dashboard_job_filter_select">Jobs</label>
                                    </div>
                                    <select id="dashboard_job_filter_select" class="form-control">
                                        <option value=""></option>
                                        @foreach($jobs as $job)
                                            <option value="{{$job->title}}">{{$job->title}}</option>
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

                    </div> <!-- end card-body -->
                </div> <!-- end card -->

            </div>


            <div class="col-md-12">

                <div class="card _shadow-1">

                    <div class="card-header">

                        <h4 class="my-0">Action Logs</h4>

                    </div>
                    <div class="card-body">

                        <table id="logs-datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>DATE</th>
                                <th>AUTHOR</th>
                                <th>TYPE</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th style="width: 70px">ACTION</th>
                            </tr>
                            </thead>
                        </table>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->

            </div>
            <div class="col-md-12">

                <div class="card _shadow-1">

                    <div class="card-header">
                        <h4 class="my-0">Incomplete Post Work Log(s)</h4>
                    </div>
                    <div class="card-body">

                        <table id="post-work-logs-datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th class="text-uppercase">Id</th>
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
        </div>

    @endif


    @if(Auth::user()->role == 'contractor')

            <div class="row mt-3">
                <div class="col-12 card _shadow-1">
                    <div class="d-flex align-items-center">
                        <h4 class="text-info">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h4>
                        <span class="text-secondary"> &nbsp | {{Auth::user()->email}}</span>
                        <span class="text-secondary"> &nbsp | {{Auth::user()->phone}}</span>
                    </div>

                    <form method="POST" action="{{ route('contractor.updateEmergencyDetail')}}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <h5 class="text-info">Emergency Details</h5>

                            @if(trim(Auth::user()->contractor_next_of_kin_name) == '' ||
                                trim(Auth::user()->contractor_next_of_kin_phone) == '' ||
                                trim(Auth::user()->contractor_safe_pass_photo) == '' ||
                                trim(Auth::user()->contractor_safe_pass_expiry) == '' ||
                                trim(Auth::user()->contractor_agree_to_health_and_safety_procedure == '')
                            )
                                <div class="alert alert-danger">
                                    <p class="my-0"><b>Action Required: </b> Please complete your profile.</p>
                                </div>
                            @endif

                            @if(trim(Auth::user()->contractor_safe_pass_expiry) != '' && Auth::user()->contractor_safe_pass_expiry < NOW())
                                <div class="alert alert-danger">
                                    <p class="my-0"><b>Please Note: </b> Safepass has expired.</p>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="contractor_next_of_kin_name" class="form-label">Next of Kin</label>
                                        <input
                                            value="{{  Auth::user()->contractor_next_of_kin_name ?? old('contractor_next_of_kin_name') }}"
                                            type="text" name="contractor_next_of_kin_name" id="contractor_next_of_kin_name"
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
                                            value="{{  Auth::user()->contractor_next_of_kin_phone ?? old('contractor_next_of_kin_phone') }}"
                                            type="text" name="contractor_next_of_kin_phone" id="contractor_next_of_kin_phone"
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
                                        <label for="contractor_safe_pass_photo" class="form-label">Safepass Photo (Max 1mb)</label>
                                        <input type="file" name="contractor_safe_pass_photo" id="contractor_safe_pass_photo"
                                            class="form-control  @error('contractor_safe_pass_photo') is-invalid @enderror"
                                            placeholder="Upload Photo" accept="image/*">
                                        @error('contractor_safe_pass_photo')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                        @if(Auth::user()->contractor_safe_pass_photo != '')
                                        <div class="p-2">
                                            <img class="img-fluid" src="{{asset('/files/'.Auth::user()->contractor_safe_pass_photo)}}" width="300">
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="contractor_safe_pass_expiry" class="form-label">Safepass Expiry</label>
                                        <input
                                            value="{{  Auth::user()->contractor_safe_pass_expiry ?? old('contractor_safe_pass_expiry') }}"
                                            type="date" name="contractor_safe_pass_expiry" id="contractor_safe_pass_expiry"
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
                                        <textarea name="contractor_medical_issue" id="contractor_medical_issue" rows="3"
                                            class="form-control"
                                            placeholder="Enter Health Issue(s)">{{Auth::user()->contractor_medical_issue ?? ''}}</textarea>

                                        @error('contractor_medical_issue')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <p class="px-1">* Only authorised staff will access these details.</p>

                                    <div class="d-flex align-items-center px-1">
                                        <input name="contractor_agree_to_health_and_safety_procedure" value="1" type="checkbox" {{Auth::user()->contractor_agree_to_health_and_safety_procedure == '1' ? 'checked': ''}}>
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
    <script src="{{asset('assets/plugins/dhtmlxgantt/dhtmlxgantt.js')}}"></script>
    <script src="{{asset('assets/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    
    <script>
        $(document).ready(function () {
            var weekStart = moment().startOf('week').add(1, 'days');;
            var monthEnd = moment().endOf('month');
            gantt.plugins({
                tooltip: true
            });

           
            gantt.config.min_column_width = 38;
            gantt.config.readonly = true;
            gantt.config.autosize = "y";


            // Top Scale
            gantt.config.scales = [
                {unit: "month", step: 1, format: "%F - %Y"},
                {unit: "day", step: 1, format: headDateFormat}
            ];

            function headDateFormat(date){
                return `${moment(date).format('dd').substring(0,1)} - ${moment(date).format('DD')}`;
            };

            //Columns
            gantt.config.columns = [
                {
                    name: "text", label: "Properties",  tree: true, width: '*', template: boldParent},
                {
                    name: "progress", label: "", width: 80, align: "center",
                    template: function (item) {
                        if (item.status)
                            return item.status;
                        return "";
                    }
                }
            ];

            function boldParent(task){
                if(task.parent == 0)
                    return "<div class='bold-class'>"+task.text+"</div>";
                return task.text;
            };

            gantt.attachEvent("onBeforeLightbox", function(id) {
                return false;
            });

            gantt.templates.tooltip_text = function(start,end,task){

                if(task.address){
                    return "<b>Property : </b>"+task.address+"<br/><b>Contractor Name: "+task.contractor+"</b>";
                }else{
                    return "<b>Property : </b>"+task.text;
                }


            };

            gantt.attachEvent("onTaskClick", function(id, e) {
                var task = gantt.getTask(id);
                if(task.url){
                    window.open(task.url, '_blank');
                }
                return true;
            });

            gantt.config.date_format = "%Y-%m-%d";
            gantt.config.drag_resize = false;
            gantt.config.drag_move = false;
            gantt.config.open_tree_initially = true;
            gantt.config.bar_height = 18;
            gantt.config.row_height = 20;
            gantt.config.scroll_size = 30;

            @if(Auth::user()->role == 'admin')
                gantt.init("contractor-properties-gantt");
            @endif

            $.ajax({
                url: "{{route('dashboard.properties-jobs')}}",
                type: "POST",
                success: function (response) {
                    gantt.parse(response);
                    filterDate(weekStart,monthEnd);
                }
            });

            // task class
            gantt.templates.task_class  = function(start, end, task){
                if (task.eventColor)
                    return task.eventColor;
            };


            //filter
            function filterDate(start, end) {
                gantt.config.start_date = new Date(start.format('YYYY-MM-DD'));
                gantt.config.end_date =  new Date(end.format('YYYY-MM-DD'));
                gantt.render()
            }


            $('#gantt-date-filter').daterangepicker({
                alwaysShowCalendars: true,
                opens: "left",
                startDate: weekStart,
                endDate: monthEnd,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                ranges: {
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')],
                    'Next 3 Months': [moment(),moment().add(3, 'month').startOf('month')],
                    'Next 6 Months': [moment(),moment().add(6, 'month').startOf('month')]
                }
            }, filterDate);

        });


    </script>
@endpush
