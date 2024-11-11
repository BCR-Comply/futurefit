<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="dashboard" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/plugins/dhtmlxgantt/dhtmlxgantt.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    {{-- <link href="{{asset('assets/css/customcss.css')}}" rel="stylesheet" /> --}}
    <link href="{{ asset('assets/css/color.css') }}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">



    <style>
        th,
        td {
            font-size: 12px;
        }

        * {
            font-family: Roboto;
        }
        .gantt_message_area{
            display: none;
        }
        html,
        body {
            height: 100%;
        }

        .gantt_grid_head_cell {
            font-weight: bold;
        }

        .gantt_scale_cell {
            font-weight: bold;
        }

        .bold-class {
            font-weight: bold;
        }

        .gantt-fullscreen {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 30px;
            height: 30px;
            padding: 2px;
            font-size: 32px;
            background: transparent;
            cursor: pointer;
            opacity: 0.5;
            text-align: center;
            -webkit-transition: background-color 0.5s, opacity 0.5s;
            transition: background-color 0.5s, opacity 0.5s;
        }

        .gantt-fullscreen:hover {
            background: rgba(150, 150, 150, 0.5);
            opacity: 1;
        }

        .badge-warning {
            background-color: #f68500 !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            color: #fff !important;
            font-size: 8px !important;
        }

        .badge-success {
            background-color: #0eb50b !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            color: #fff !important;
            font-size: 8px !important;
        }

        .badge-success-light {
            background-color: #ffd600 !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            color: #333 !important;
            font-size: 8px !important;
        }

        .badge-danger {
            background-color: #FF3636 !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            color: #fff !important;
            font-size: 8px !important;
        }

        .badge-infos {
            background-color: #e2e8ed !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            color: #333 !important;
            font-size: 8px !important;
        }

        .badge-info {
            background-color: #0d187c !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            color: #fff !important;
            font-size: 8px !important;
        }

        .badge-warning-light {
            background-color: #ffa70f !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            color: #fff !important;
            font-size: 8px !important;
        }

        .gantt_task_scale>.gantt_scale_line:nth-child(2) .gantt_scale_cell {
            font-size: 8px !important;
        }

        /* .gantt_scale_cell span {
            position: absolute;
            bottom: 0px !important;
            left: 8px !important;
            }
            .gantt_task_scale > .gantt_scale_line:nth-child(2) .gantt_scale_cell {
                position: absolute !important;
                width: 30px !important;
                height: 31px !important;
            }
            .gantt_task_scale, .gantt_grid_scale {
            height: 50px !important;
        }
        .gantt_layout_content,.gantt_container,.gantt_task,.gantt_grid{
            min-height: 227px !important;
        } */
        .gantt_tree_icon.gantt_folder_open,
        .gantt_tree_icon.gantt_folder_closed {
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAGvSURBVHgB5VS9TgJBEJ7dO4w2eokxMdHibJROSkroTDQRn4BHMDwB8AT4BsITaIGJHccbaIfEYgtMLDTZGCu52/HbwyOAQJDQOcnc7s3PtzO7M0O0YhLJZjd94rvsXmObAXtgDQ7YmGqqv6YnHTVprVWgpwJasBSnWkysWJiGIKmEIc9ILggWRZoZjVB90c+/du5VInPtxyGnbNjol+5dfsLndj99pojpEgeVUrQWJIq+/PIokmUbCH4PErljP1vbR3VDpvT5/tyZjOLjrRts7hxuINIabDLMbDknjMwixHWYZKFvw05Ze/nj5znS0bNS63WaFTjb6B9/KZkewDfIJDdMeRECaIAlmKbbS5/WkUHZ6hcGjKsgdP1RWeiGavAgHOAhy3+KECVVw40XxmTkVrFUpJGaBfsD2YLUe2pezNKxQVk6g72kFdN/BYx7ODI+LUnsGt/29RAQRalJCo+WJIcdD22ph4BoqzZOOKclyTAX4xakkfGFU1oA1Ui/AQstWKp5IJg+vs3KBgIfPxJRPMbGBizGWEUYcYyqt4b+XEDce3xVyC4U4dXoTFwpfQNAzbRnvQOWLQAAAABJRU5ErkJggg==) !important;
        }

        .gantt_tree_icon.gantt_file {
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAEySURBVHgBjVPdTcMwGLykBfroDQgbwAawASMEISR+XowYoGUCzAtU4qFmAsQELROQDcgI5Q0EaXp2m8pxk7onWXac++47W+cIDlIpBX4g3D30MNVKTdGCyBZeyoSrEZeHHD454VD6Wd22C1zJMUp86KEa+AT+++KUkymwixPfTWxtA8dNxRU6cSfFDO/4xad16wosz5wjANugxCudjF2RGGFkxV9xtBIBHl2RbrD8H/dkvfEuHpxdYUQ4HwQF9IvKDNE/uxE4v7nbDzuohIYqd7/pyM41AXZJqdxfq44w0U/qDA3oel00RSZrrD20JrHu4EKaJJ7WGD2mcEOUY5N1wMu/66q9OCl2iu9FZ0Y5vZZ9bAnDtfFHdYQS5oJG3BwgnEpBfrasWTymlXLTc/bhPe85cK1sWot4oEsAAAAASUVORK5CYII=) !important;
        }

        .gantt_tree_icon.gantt_open {
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAABfSURBVHgB7c5bCQAhEIVhI2yEjbARNopNrGADIxnFCHoQBRFxvL2IHvjfho9h7O7MfehtvP3RQx1pZAJcm0AWceLOQ4ZAI6ZbPqTQbqyGDmMlVM1iOboES1G5CrvbfQ5MphqWGuKF1wAAAABJRU5ErkJggg==) !important;
            right: 5px;
            position: absolute;
        }

        .gantt_tree_icon.gantt_close {
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAWCAYAAAAvg9c4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAABsSURBVHgB7dLBCcAgDIXh5wYdoSM4QkfpKN2gI3QkR+kIaQQPUkojJniQ/PAuIh8eBDxPauGdvAijMph4xLst4Bq8CqqCa/AoZ1EDf4HQwH9gN7wL4BtOaCi/dENbKwy/mTdrgYiCdInvYGgPWlEglblOL68AAAAASUVORK5CYII=) !important;
            right: 5px;
            position: absolute;
        }

        .gantt_grid_scale,
        .gantt_task_scale {
            background-color: #1A47A3 !important;
        }

        .gantt_grid_scale .gantt_grid_head_cell,
        .gantt_task .gantt_task_scale .gantt_scale_cell {
            color: #fff;
        }

        .gantt_task_line {
            border-radius: 3px !important;
        }

        .gantt_row.gantt_row_task {
            background-color: #e2e8ed !important;
        }

        .gantt_layout_cell {
            border-radius: 10px !important;
        }

        .gantt_scale_cell div.today-column {
            border-left:1px solid #FF4539 !important;

        }
        .gantt_task_cell.today-column {
            border-left:1px solid #FF4539 !important;
        }
        .weekend-column {
            background-color: #F4F6F8 !important;
            color: #1A47A3 !important
        }
        #overlay2 {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        }
        .loading-overlay2 {
        background: #ffffff;
        z-index: 9998;
        border: 10px solid #f3f3f3;
        border-radius: 50%;
        border-top: 10px solid #1A47A3;
        width: 80px;
        height: 80px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        }
        /* Safari */
        @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
        }

        @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
        }
    </style>

</head>

<body>
    <div class="row">
        <div id="overlay2">
            <div class="loading-overlay2"></div>
        </div>
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
                    </div>
                    <hr />
                </div>

            </div>
        </div>
    </div>
    <div id="contractor-properties-gantt" style='width: 100%; height: 80vh !important;overflow: auto;'></div>

    <!-- bundle -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/plugins/dhtmlxgantt/dhtmlxgantt.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script>
        var startDate = '{{$start}}';
        var endDate = '{{$end}}';
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if(startDate == "" && endDate == ""){
                var weekStart = moment().subtract(7, 'days');
            var monthEnd = moment().endOf('month');
            }else{
                weekStart = moment(startDate).subtract(0, 'days');
                monthEnd = moment(endDate).subtract(0, 'days');
            }
            gantt.plugins({
                tooltip: true,
                fullscreen: true
            });


            gantt.config.min_column_width = 20;
            gantt.config.readonly = true;
            gantt.config.autosize = "y";
            // Top Scale
            gantt.config.scales = [{
                    unit: "month",
                    step: 1,
                    format: "%F - %Y"
                },
                {
                    unit: "day",
                    step: 1,
                    // format: headDateFormat
                    template: function (date) {
            var ymdFormat = moment(date).format('YYYY-MM-DD');
            return `<div data-date="${ymdFormat}">${moment(date).format('dd').substring(0, 1)}-${moment(date).format('DD')}</div>`;
        }
                }
            ];

            function headDateFormat(date) {
                return `${moment(date).format('dd').substring(0,1)}-${moment(date).format('DD')}`;
            };
            gantt.config.columns = [{
                    name: "text",
                    label: "Properties",
                    tree: true,
                    width: '*',
                    template: boldParent,
                    height: 80 // Adjust the height value as needed
                },
                {
                    name: "progress",
                    label: "",
                    width: 120,
                    align: "center",
                    template: function(item) {
                        if (item.status)
                            return item.status;
                        return "";
                    },
                    height: 80 // Adjust the height value as needed
                }
            ];

            function boldParent(task) {
                if (task.parent == 0)
                    return "<div class='bold-class'>" + task.text + "</div>";
                return task.text;
            };

            gantt.attachEvent("onBeforeLightbox", function(id) {
                return false;
            });
            var isScrolling;
            gantt.attachEvent("onGanttScroll", function(left, top) {
                clearTimeout(isScrolling);

                // Set a timeout to check if scrolling has stopped after 200 milliseconds
                isScrolling = setTimeout(function() {
                    gantt.render()
                    // Perform actions when scrolling stops
                    checkAndAddClass();
                    CountGantt();
                }, 10);
            });
            var allowClick = true;
            gantt.attachEvent("onTaskClick", function(id, e) {
                var task = gantt.getTask(id);
                if (task.url && task.parent != 0) {
                    window.open(task.url, '_blank');
                }
                return true;
            });
            gantt.attachEvent("onGanttRender", function() {
                checkAndAddClass();
                CountGantt();
            });
            gantt.config.date_format = "%Y-%m-%d";
            gantt.config.drag_resize = false;
            gantt.config.drag_move = false;
            gantt.config.open_tree_initially = true;
            gantt.config.bar_height = 18;
            gantt.config.row_height = 20;
            gantt.config.scroll_size = 10;

            @if (Auth::user()->role == 'admin')
                gantt.init("contractor-properties-gantt");
            @endif

            $.ajax({
                url: "{{ route('dashboard.properties-jobs') }}",
                type: "POST",
                success: function(response) {
                    const data = response.data;
                    function parseAllData() {
                        data.forEach(task => {
                            $('#overlay2').css('display','block');
                            gantt.addTask(task);
                        });
                        $('#overlay2').css('display','none');
                        filterDate(weekStart, monthEnd);
                    }
                    parseAllData();
                    filterDate(weekStart, monthEnd);
                }
            });

            // task class
            gantt.templates.task_class = function(start, end, task) {
                if (task.eventColor)
                    return task.eventColor;
            };

            //filter
            function filterDate(start, end) {
                gantt.config.start_date = new Date(start.format('YYYY-MM-DD'));
                gantt.config.end_date = new Date(end.format('YYYY-MM-DD'));
                gantt.render()
                gantt.attachEvent("onGanttRender", function() {
                    checkAndAddClass();
                    CountGantt();
                });
            }


        gantt.templates.tooltip_text = function(start,end,task){
                if(task.address){
                    return "<b>Property : </b>"+task.address+"<br/><b>Contractor Name: "+task.contractor+"</b><br><b>Start Date :<b> "+start.toLocaleDateString('en-GB')+"<br><b>End Date : <b>"+end.toLocaleDateString('en-GB');
                }else{
                    return "<b>Property : </b>"+task.text+"<br><b>Start Date :<b> "+(new Date(task.property_start_date)).toLocaleDateString('en-GB')+"<br><b>End Date : <b>"+(new Date(task.property_end_date)).toLocaleDateString('en-GB');
                }
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
                    'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month')
                        .endOf('month')
                    ],
                    'Next 3 Months': [moment(), moment().add(3, 'month').startOf('month')],
                    'Next 6 Months': [moment(), moment().add(6, 'month').startOf('month')]
                }
            }, filterDate);

        });

        function checkAndAddClass() {
    var today = new Date();
    const formattedDate1 = moment(today).format('YYYY-MM-DD');
    $('.gantt_scale_cell > div').each(function() {
        var dateAttribute = $(this).attr('data-date');
        if (dateAttribute) {
            var dateMoment = moment(dateAttribute);
            if (dateMoment.isoWeekday() === 6 || dateMoment.isoWeekday() === 7) {
                // Saturday or Sunday (weekend)
                $(this).addClass('weekend-column');
                $(this).css('color', '#1A47A3');
            } else {
                $(this).css('color', '#fff');
            }

            if (dateAttribute === formattedDate1) {
                // Current date
                $(this).addClass('today-column');
            } else {
                $(this).removeClass('today-column');
            }
        }
    });
}
        function formatDate(dateStr) {
            const date = new Date(dateStr);
            const dayAbbr = date.toLocaleDateString("en-US", {
                weekday: "short"
            }).slice(0, 1);
            const dayNum = date.getDate().toString().padStart(2, "0");
            return `${dayAbbr}-${dayNum}`;
        }
    </script>
</body>

</html>
