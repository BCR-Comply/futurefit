@extends('layouts.dashboard.app')

@section('content')
{{-- <style>
    .dhx_cal_header{
        border:var(--dhx-scheduler-header-border) !important;
    }
    .dhx_scale_bar{
        /* left: -1px !important; */
        color: #fff !important;
    }
    .dhx_cal_header{
        background: #1A47A3;
        outline: 1px solid #1A47A3 !important;
        border: 1px solid #1A47A3 !important;
        width: -webkit-fill-available !important;
    }
    .dhx_cal_tab_segmented,.dhx_cal_today_button{
        background: #fff !important;
        color: #1A47A3 !important;
        border: 1px solid #1A47A3 !important;
    }
    .dhx_cal_prev_button:before, .dhx_cal_next_button:before,.dhx_month_head{
        color: #1A47A3 !important;
    }
    .dhx_cal_header{
        left: -2px !important;
    }
    .dhx_cal_tab_segmented.active{
        background: #1A47A3 !important;
        color: #fff !important;
        border: 1px solid #1A47A3 !important;
    }
</style> --}}
{{-- <link rel="stylesheet" href="https://cdn.dhtmlx.com/scheduler/edge/dhtmlxscheduler.css"> --}}
<link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet">
    <h4 class="page-title">APPOINTMENTS</h4>

    <div class="row">
        <div class="col-md-12">
            <div id="scheduler_here" class="dhx_cal_header" style="width:100%; height:75vh;"></div>
        </div>
    </div>
    
{{-- <script src="https://cdn.dhtmlx.com/scheduler/edge/dhtmlxscheduler.js"></script> --}}
<script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script>
        $(document).ready( function(){
            scheduler.config.xml_date="%Y-%m-%d %H:%i";
            scheduler.init('scheduler_here', new Date(), "month");
            scheduler.plugins({
                units: true
            });
            // Fetch initial events from backend
            // $.ajax({
            //     url: '/your-backend-endpoint', // Replace with your backend URL
            //     method: 'GET',
            //     success: function(data) {
            //         scheduler.parse(data, "json");
            //     },
            //     error: function(xhr, status, error) {
            //         console.error('Error fetching events:', error);
            //     }
            // });
            scheduler.parse([
                { id:1, start_date:"2024-09-01 09:00", end_date:"2024-09-02 12:00", text:"Meeting with John" },
                { id:2, start_date:"2024-09-02 14:00", end_date:"2024-09-05 16:00", text:"Conference Call" }
            ], "json");

            // Handle event creation
            scheduler.attachEvent("onAfterEventAdd", function(id, item) {
                $.ajax({
                    url: '/your-backend-endpoint', // Replace with your backend URL
                    method: 'POST',
                    data: item,
                    success: function(response) {
                        console.log('Event added successfully:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error adding event:', error);
                    }
                });
            });

            // Handle event update (including drag-and-drop)
            scheduler.attachEvent("onAfterEventUpdate", function(id, item) {
                $.ajax({
                    url: '/your-backend-endpoint/' + id, // Replace with your backend URL
                    method: 'PUT',
                    data: item,
                    success: function(response) {
                        console.log('Event updated successfully:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating event:', error);
                    }
                });
            });

            // Handle event deletion
            scheduler.attachEvent("onBeforeEventDelete", function(id) {
                if (confirm("Are you sure you want to delete this event?")) {
                    $.ajax({
                        url: '/your-backend-endpoint/' + id, // Replace with your backend URL
                        method: 'DELETE',
                        success: function(response) {
                            console.log('Event deleted successfully:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error deleting event:', error);
                        }
                    });
                } else {
                    return false; // Prevent default deletion
                }
            });

            // Make sure drag-and-drop functionality is enabled
            scheduler.config.drag_resize = true;
            scheduler.config.drag_move = true;
        });
    </script> --}}
    <script>
    $(document).ready(function () {
        // Dummy data for initial setup (if not fetching from backend)
        const eventData = [
            { Id: 1, Subject: 'Meeting with John', StartTime: new Date(2024, 8, 1, 9, 0), EndTime: new Date(2024, 8, 1, 12, 0) },
            { Id: 2, Subject: 'Conference Call', StartTime: new Date(2024, 8, 2, 14, 0), EndTime: new Date(2024, 8, 5, 16, 0) }
        ];
        var scheduleObj = new ej.schedule.Schedule({
                    height: '550px',
                    selectedDate: new Date(),
                    eventSettings: {
                        dataSource: eventData // Use the fetched data
                    },
                    // Enable drag-and-drop for resizing and moving events
                    allowDragAndDrop: true,
                    allowResizing: true,
                    views: ['Day', 'Week', 'Month'], // Configure views
                    currentView: 'Month',
                });
                scheduleObj.appendTo('#scheduler_here');

                // Handle event creation
                scheduleObj.eventRendered = function (args) {
                    if (args.data.isNew) {
                        $.ajax({
                            url: '/your-backend-endpoint',
                            method: 'POST',
                            data: args.data, // Event data
                            success: function (response) {
                                console.log('Event added successfully:', response);
                            },
                            error: function (xhr, status, error) {
                                console.error('Error adding event:', error);
                            }
                        });
                    }
                };

                // Handle event update (including drag-and-drop)
                scheduleObj.actionComplete = function (args) {
                    if (args.requestType === 'eventChanged') {
                        $.ajax({
                            url: '/your-backend-endpoint/' + args.data.Id, // Replace with your backend URL
                            method: 'PUT',
                            data: args.data, // Event data
                            success: function (response) {
                                console.log('Event updated successfully:', response);
                            },
                            error: function (xhr, status, error) {
                                console.error('Error updating event:', error);
                            }
                        });
                    }
                };

                // Handle event deletion
                scheduleObj.eventDeleted = function (args) {
                    if (confirm("Are you sure you want to delete this event?")) {
                        $.ajax({
                            url: '/your-backend-endpoint/' + args.data.Id, // Replace with your backend URL
                            method: 'DELETE',
                            success: function (response) {
                                console.log('Event deleted successfully:', response);
                            },
                            error: function (xhr, status, error) {
                                console.error('Error deleting event:', error);
                            }
                        });
                    }
                };
    });
</script>
@endsection
