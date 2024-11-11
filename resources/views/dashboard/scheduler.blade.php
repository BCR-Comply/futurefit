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
{{-- <div> --}}
    <div id="overlay2">
        <div class="loading-overlay2"></div>
    </div>
    <div class=" mt-3 mb-3 filtercart">
        <div class="row mb-2">
            <div class="col-md-4 pe-0">
                <div class="form-group">
                    <label for="gantt-date-filter" class="mr-1">Filter by date</label>
                    <input class="form-control" name="gantt-date-filter" id="gantt-date-filter">
                </div>
            </div>
            <div class="col-md-4">
                <a class="btn _btn-primary btn-block view_in_full"
                    style="margin-top:21px;border-radius:6px;"
                    href="{{ url('dashboard/contractor-properties-gantt') }}" target="_blank">View in
                    full screen</a>
            </div>
        </div>
    </div>
            
    <div class="col-sm-12" id="contractor-properties-gantt" style='overflow:hidden;'></div>
{{-- </div> --}}
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

            CountGantt();
            var weekStart = moment().subtract(7, 'days');
            var monthEnd = moment().endOf('month');
            gantt.plugins({
                tooltip: true
            });


            gantt.config.min_column_width = 20;
            gantt.config.readonly = true;
            gantt.config.autosize = "y";
            gantt.config.scales = [{
                    unit: "month",
                    step: 1,
                    format: "%F - %Y"
                },
                {
                    unit: "day",
                    step: 1,
                    // format: headDateFormat
                    template: function(date) {
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
                    width: 80,
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
            gantt.templates.task_class = function(start, end, task) {
                if (task.eventColor)
                    return task.eventColor;
            };

            gantt.templates.tooltip_text = function(start, end, task) {
                if (task.address) {
                    return "<b>Property : </b>" + task.address + "<br/><b>Contractor Name: " + task.contractor +
                        "</b><br><b>Start Date :<b> " + start.toLocaleDateString('en-GB') +
                        "<br><b>End Date : <b>" + end.toLocaleDateString('en-GB');
                } else {
                    return "<b>Property : </b>" + task.text + "<br><b>Start Date :<b> " + (new Date(task
                        .property_start_date)).toLocaleDateString('en-GB') + "<br><b>End Date : <b>" + (
                        new Date(task.property_end_date)).toLocaleDateString('en-GB');
                }
            };

            function formatDate2(date) {
                return date.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: '2-digit',
                    year: '2-digit'
                });
            }

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


            //filter
            function filterDate(start, end) {
                gantt.config.start_date = new Date(start.format('YYYY-MM-DD'));
                gantt.config.end_date = new Date(end.format('YYYY-MM-DD'));
                gantt.render()
                gantt.attachEvent("onGanttRender", function() {
                    checkAndAddClass();
                    CountGantt();
                    var endt = moment(end, 'YYYY-MM-DD').format('YYYY-MM-DD');
                    var startt = moment(start, 'YYYY-MM-DD').format('YYYY-MM-DD');
                    var url = '{{ url('/dashboard/contractor-properties-gantt') }}?start=' + startt +
                        '&end=' + endt;
                    $('.view_in_full').attr('href', url);
                });
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

            $('#logs-datatable_filter').css('top', 'unset');
            $('button[aria-controls="logs-datatable"]').css('top', '0');
            $('#post-work-logs-datatable_filter').css('top', 'unset');
            $('button[aria-controls="post-work-logs-datatable"]').css('top', '0');
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
