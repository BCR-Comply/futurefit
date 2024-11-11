<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>{{config('app.name', 'Laravel')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta content="dashboard" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('assets/css/_vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/_vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/_vendor/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    @stack('styles')



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        th, td {
            font-size: 12px;
        }

        * {
            font-family: Roboto;
        }

        .notification-counter{
            position: absolute;
            right: 0px;
            top: 1px;
            background-color: #FF3636;
            color: #ffffff;
            padding: 3px 5.5px;
            border-radius: 50px;
            line-height: 1;
            font-size: 8px;
        }

        .msg-counter{
            position: absolute;
            right: -2px;
            top: 1px;
            background-color: #FF3636;
            color: #ffffff;
            padding: 3px 5.5px;
            border-radius: 50px;
            line-height: 1;
            font-size: 8px;
        }
        .un-read-notification{
            color: #383d41;
            background-color: #e2e3e5;
        }
        .mark-read{
            color: #4d6e96;
        }
    </style>

</head>

<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid"
      data-rightbar-onstart="true">
<!-- Begin page -->
<div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="leftside-menu">

        <!-- LOGO -->

        <a href="/dashboard" class="mt-3 logo text-center logo-light">
                <span class="logo-lg">
                    <img src="{{asset('assets/images/logo.png')}}" class="img-fluid" style="max-height: 130px">
                </span>
            <span class="logo-sm">
                    <img src="{{asset('assets/images/logo.png')}}" class="img-fluid" style="max-height: 130px">
                </span>
        </a>


        <!-- LOGO -->
        <a href="/dashboard" class="mt-3 logo text-center logo-dark">
                <span class="logo-lg">
                    <img src="{{asset('assets/images/logo.png')}}" class="img-fluid">
                </span>
            <span class="logo-sm">
                    <img src="{{asset('assets/images/logo.png')}}" class="img-fluid">
                </span>
        </a>

        <div class="h-100 mt-5" id="leftside-menu-container" data-simplebar>

            <!--- Sidemenu -->
            <ul class="side-nav mt-3">

                @if(Auth::user()->role == 'admin')

                    <li class="side-nav-item">
                        <a href="/dashboard" class="side-nav-link">
                            <i class="uil-chart _nav-item-text"></i>
                            <span class="_nav-item-text"> Dashboard </span>
                        </a>
                    </li>


                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#create-and-manage" aria-expanded="false"
                           aria-controls="sidebarPages" class="side-nav-link _nav-item-text">
                            <i class="uil-copy-alt"></i>
                            <span> Create & Manage </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="create-and-manage">
                            <ul class="side-nav-second-level">


                                <li>
                                    <a class="_nav-item-text" href="{{route('client')}}">
                                        <i class="dripicons-user-group"></i>
                                        <span>&nbsp; Clients</span>
                                    </a>
                                </li>


                                <li>
                                    <a class="_nav-item-text" href="{{route('property', 0)}}">
                                        <i class="dripicons-home"></i>
                                        <span>&nbsp; Properties</span>
                                    </a>
                                </li>


                                <li>
                                    <a class="_nav-item-text" href="{{route('batch')}}">
                                        <i class="dripicons-document"></i>
                                        <span>&nbsp; Batches</span>
                                    </a>
                                </li>


                                <li>
                                    <a class="_nav-item-text" href="{{route('contractor')}}">
                                        <i class="dripicons-user-id"></i>
                                        <span>&nbsp; Contractors</span>
                                    </a>
                                </li>

                                <li>
                                    <a class="_nav-item-text" href="{{route('assessor')}}">
                                        <i class="dripicons-scale"></i>
                                        <span>&nbsp; HEA/BER Assessors</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>



                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#properies" aria-expanded="false"
                           aria-controls="sidebarPages" class="side-nav-link _nav-item-text">
                            <i class="uil-home"></i>
                            <span> Properties </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="properies">
                            <ul class="side-nav-second-level">

                                @foreach($schemes as $scheme)
                                    <li>
                                        <a class="_nav-item-text"
                                           href="{{route('property', $scheme->id)}}"
                                        >
                                            <i class="uil-coins"></i>
                                            <span>&nbsp; {{$scheme->scheme}}</span>
                                        </a>
                                    </li>
                                @endforeach

                                <li>
                                    <a class="_nav-item-text" href="{{route('property', 909090909090)}}">
                                        <i class="uil-coins"></i>
                                        <span>&nbsp; Archieved Home</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#lookups" aria-expanded="false"
                           aria-controls="sidebarPages" class="side-nav-link _nav-item-text">
                            <i class="uil-search"></i>
                            <span> Lookups </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="lookups">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a class="_nav-item-text" href="{{ route('lookup.job')}}">
                                        <i class="uil-list-ui-alt"></i>
                                        <span>&nbsp; Job Lookups</span>
                                    </a>
                                </li>

                                <li>
                                    <a class="_nav-item-text" href="{{ route('lookup.scheme')}}">
                                        <i class="uil-list-ui-alt"></i>
                                        <span>&nbsp; Schemes</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#users" aria-expanded="false"
                           aria-controls="sidebarPages" class="side-nav-link _nav-item-text">
                            <i class="dripicons-user-group"></i>
                            <span> Users </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="users">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a class="_nav-item-text" href="{{ route('user')}}">
                                        <i class="uil-500px"></i>
                                        <span>&nbsp; Admin</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="_nav-item-text" href="{{ route('surveyor') }}">
                                        <i class="uil-user-circle"></i>
                                        <span>&nbsp; Surveyor</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#config" aria-expanded="false"
                           aria-controls="sidebarPages" class="side-nav-link _nav-item-text">
                            <i class="dripicons-gear"></i>
                            <span> Config </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="config">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a class="_nav-item-text" href="{{ route('config')}}">
                                        <i class="uil-500px"></i>
                                        <span>&nbsp; Application Config</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                @endif

                @if(Auth::user()->role == 'contractor')

                    <li class="side-nav-item">
                        <a href="/dashboard/contract" class="side-nav-link _nav-item-text">
                            <i class="uil-clipboard-alt"></i>
                            <span> Contracts </span>
                        </a>
                    </li>

                @endif

                @if(Auth::user()->role == 'hea/ber-assessor')

                    <li class="side-nav-item">
                        <a href="/dashboard/assessor-contract" class="side-nav-link _nav-item-text">
                            <i class="uil-clipboard-alt"></i>
                            <span> Contracts </span>
                        </a>
                    </li>

                @endif

            </ul>

            <!-- end Help Box -->
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            <div class="navbar-custom _shadow-1">
                <ul class="list-unstyled topbar-menu float-end mb-0 d-flex align-items-center">

                    <li class="dropdown notification-list">
                        @if(auth()->user()->unreadNotifications->where('type', 'App\Notifications\MessageNotification')->count() > 0)
                        <span class="msg-counter">{{ auth()->user()->unreadNotifications->where('type', 'App\Notifications\MessageNotification')->count() }}</span>
                        @endif
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fa fa-envelope fa-lg"></i>
                        </a>


                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            {{-- CREATE A NEW MESSAGE --}}
                            <a class="dropdown-item mark-read" href="javascript:;" id="create-new-message"><i class="fa fa-comments"> Create a new message</i></a>
                            @if( auth()->user()->notifications->where('type', 'App\Notifications\MessageNotification')->count() > 0)
                                @foreach(auth()->user()->unreadNotifications->where('type', 'App\Notifications\MessageNotification')->take(10) as $notification)
                                <a class="dropdown-item un-read-notification" onclick="open_chatbox(this); return false;"  href="{{ route('chat.open', ['id' => Crypt::encrypt($notification->data['msg_id']), 'notification_id' => $notification->id]) }}"><b>{{ $notification->data['user'] }}</b> {{ date('d-m-Y h:m A', strtotime($notification->created_at)) }}</a>
                                @endforeach
                                @foreach(auth()->user()->readNotifications->where('type', 'App\Notifications\MessageNotification')->take(10) as $notification)
                                <a class="dropdown-item" onclick="open_chatbox(this); return false;"  href="{{ route('chat.open', ['id' => Crypt::encrypt($notification->data['msg_id']), 'notification_id' => $notification->id]) }}"><b>{{ $notification->data['user'] }}</b> {{ date('d-m-Y h:m A', strtotime($notification->created_at)) }}</a>
                                @endforeach
                            @endif
                            <a class="dropdown-item mark-read" onclick="open_chatbox(this); return false;"  href="{{ route('chat.open') }}"><i class="fa fa-comments"> Show all messages</i></a>
                        </div>

                    </li>

                    @if(Auth::user()->role == 'contractor')
                    <li class="dropdown notification-list">
                        @if(auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJob')->count() > 0)
                        <span class="notification-counter">{{ auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJob')->count() }}</span>
                        @endif
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fa fa-bell fa-lg"></i>
                        </a>
                        @if( auth()->user()->notifications->where('type', 'App\Notifications\ContractorJob')->count() > 0)
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            @if(auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJob')->count() > 0)
                            <a class="dropdown-item mark-read" href="{{ route('notification.markAsRead') }}"><i class="fa fa-check" aria-hidden="true"> Mark all as read</i></a>
                            @endif

                            @foreach(auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJob')->all() as $notification)
                                <a class="dropdown-item un-read-notification" href="/dashboard/contract/show-contract/{{ Crypt::encrypt($notification->data['property_id']) }}?notify=true">{{ $notification->data['notify'] }}</a> 
                            @endforeach

                            @foreach(auth()->user()->readNotifications->where('type', 'App\Notifications\ContractorJob')->all() as $notification)
                                <a class="dropdown-item" href="/dashboard/contract/show-contract/{{ Crypt::encrypt($notification->data['property_id']) }}">{{ $notification->data['notify'] }}</a>
                            @endforeach
                        </div>
                        @endif
                    </li>

                    @elseif(Auth::user()->role == 'admin')
                    <li class="dropdown notification-list">
                        @if(auth()->user()->unreadNotifications->where('type','App\Notifications\ContractorJobAcceptReject')->count() > 0)
                        <span class="notification-counter">{{ auth()->user()->unreadNotifications->where('type','App\Notifications\ContractorJobAcceptReject')->count() }}</span>
                        @endif
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fa fa-bell fa-lg"></i>
                        </a>
                        @if( auth()->user()->notifications->where('type','App\Notifications\ContractorJobAcceptReject')->count() > 0)
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            @if(auth()->user()->unreadNotifications->where('type','App\Notifications\ContractorJobAcceptReject')->count() > 0)
                            <a class="dropdown-item mark-read" href="{{ route('notification.markAsRead') }}"><i class="fa fa-check" aria-hidden="true"> Mark all as read</i></a>
                            @endif

                            @foreach(auth()->user()->unreadNotifications->where('type','App\Notifications\ContractorJobAcceptReject')->all() as $notification)
                                <a class="dropdown-item un-read-notification" href="javascript:;">{{ $notification->data['notify'] }}</a>
                            @endforeach

                            @foreach(auth()->user()->readNotifications->where('type','App\Notifications\ContractorJobAcceptReject')->all() as $notification)
                                <a class="dropdown-item" href="javascript:;">{{ $notification->data['notify'] }}</a>
                            @endforeach
                        </div>
                        @endif
                    </li>
                    @endif


                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown"
                           href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <img src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="user-image"
                                         class="rounded-circle">
                                </span>
                            <span>
                                    <span class="account-user-name">{{ Auth::user()->email }}</span>
                                    <span class="account-position text-uppercase">{{Auth::user()->role}}</span>
                                </span>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">

                            {{--                            <div class=" dropdown-header noti-title">--}}
                            {{--                                <h6 class="text-overflow m-0">Welcome !</h6>--}}
                            {{--                            </div>--}}

                            <a class="text-secondary" href="{{ route('logout') }}" class="dropdown-item notify-item"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                </ul>
                <button class="button-menu-mobile open-left">
                    <i class="mdi mdi-menu"></i>
                </button>

            </div>
            <!-- end Topbar -->

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">


                            <div id="main-container">

                                @yield('content')

                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <script>document.write(new Date().getFullYear())</script>
                        © {{config('app.name', 'Laravel')}}
                    </div>

                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->

<div class="rightbar-overlay"></div>
<!-- /End-bar -->


{{-- MESSAGE MODAL --}}
<div class="modal fade" id="newMessage" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="send-message-form">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create a new message</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="new-message-body"></div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeMsgModal();">Cancel</button>
                    <button type="button" id="send-message-button" class="btn btn-primary">Send</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- bundle -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
<script src="{{asset('assets/js/app.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<!-- third party js -->
<script src="{{asset('assets/js/_vendor/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/_vendor/dataTables.bootstrap5.js')}}"></script>
<script src="{{asset('assets/js/_vendor/dataTables.responsive.min.js')}}"></script>


<script src="{{asset('assets/js/_vendor/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/_vendor/jszip.min.js')}}"></script>
<script src="{{asset('assets/js/_vendor/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/js/_vendor/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/js/_vendor/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/_vendor/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/_vendor/dataTables.fixedColumns.min.js')}}"></script>
<script src="{{asset('assets/plugins/fullcalendar/index.global.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/jqueryui/jquery-ui.min.js')}}"></script>
@stack('scripts')

<!-- third party js ends -->

<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
      $('#calendar_jobs,#properties_jobs,#gantt-filter').select2();
    });

    function open_chatbox(e) {
        var popupWinWidth = 500;
        var popupWinHeight = 600;
        var pageTitle = "ChatBox";
        var pageURL = e.href;
        var left = (screen.width - popupWinWidth) / 2;
        var top = (screen.height - popupWinHeight) / 4;
        var strWindowFeatures = `directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no,width=${popupWinWidth},height=${popupWinHeight},left=${left},top=${top}`;
        var myWindow = window.open(pageURL, pageTitle,strWindowFeatures);
    }


</script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let to_users = '';
    $(document).on("click","#create-new-message", function(e){
        $.ajax({
            url: "{{ route('dashboard.contractor-admin') }}",
            type: 'POST',
            success: function (data) {
                $("#new-message-body").html(data.html);
                to_users = $('#to_user').find('option');
                $('#newMessage').modal('show');
            }
        });
    });

    $(document).on("change","#select_type", function(e){

        var selected_option = $('#select_type option:selected').val();

        var elem = $('#to_user').html(to_users.filter(`[user_type="${selected_option}"]`));

        if(selected_option == 'contractor'){
            $("#admin-user-select").removeClass('d-none');
            $("label[for*='to_user']").html("Contractor");

        }else if(selected_option == 'accessor'){
            $("#admin-user-select").removeClass('d-none');
            $("label[for*='to_user']").html("HEA/BER Assessors");
        }else{
            $("#admin-user-select").addClass('d-none');
            $("label[for*='to_user']").html("");
        }
    }).trigger('change');


    $(document).on("click","#send-message-button", function(e){
        e.preventDefault();
        $('#send-message-button').prop('disabled', true);
        var to_user = $("#to_user").val();
        var from_user = $("#from_user").val();
        var content = $("#content").val();

        $.ajax({
            type:'POST',
            url:"{{ route('chat.send-new-message') }}",
            data:{to_user:to_user, from_user:from_user, content:content},
            success:function(data){
                if(data.success){
                    $("#send-message-form").trigger('reset');
                    $('#newMessage').modal('hide');
                    $('#send-message-button').prop('disabled', false);
                    window.open(data.url, '_blank', 'width=700,height=700'); return false;
                }
            }
        });

    });

    function closeMsgModal() {
        $('#newMessage').modal('hide');
    }

    $('#contractor-properties-table').DataTable();

    $('#admin-users-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        serverSide: true,
        pageLength: 25,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('user')}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'firstname', name: 'firstname'},
            {data: 'lastname', name: 'lastname'},
            {data: 'email', name: 'email'},
            {data: 'usertype', name: 'usertype'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });


    $('#surveyor-users-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        serverSide: true,
        pageLength: 25,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('surveyor')}}"
        },
        columns: [
            {data: 'user_id', name: 'user_id'},
            {data: 'full_name', name: 'full_name'},
            {data: 'email', name: 'email'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'appname', name: 'appname'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });


    $('#clients-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        serverSide: true,
        pageLength: 25,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('client')}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address1', searchable: false},
            {data: 'notes', name: 'notes'},
            {data: 'properties', name: 'properties', orderable: false, searchable: false},
            {data: 'batches', name: 'batches', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    $('#batches-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        serverSide: true,
        pageLength: 25,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('batch')}}?client_id=<?= isset($_GET['client_id']) ? $_GET['client_id'] : '' ?>&batch_id=<?= isset($_GET['batch_id']) ? $_GET['batch_id'] : '' ?>"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'our_ref', name: 'our_ref'},
            {data: 'scheme', name: 'scheme.scheme', orderable: false},
            {data: 'quote', name: 'quote'},
            {data: 'invoice', name: 'invoice'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'status', name: 'status'},
            {data: 'properties', name: 'properties', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    const propertiesDataTable = $('#properties-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        order: [[0, "desc"]],
        serverSide: true,
        pageLength: 25,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            {{--url: "{{route('property', isset($_GET['scheme_id']) ? $_GET['scheme_id'] : 0)}}?client_id=<?= isset($_GET['client_id']) ? $_GET['client_id'] : '' ?>&batch_id=<?= isset($_GET['batch_id']) ? $_GET['batch_id'] : '' ?>"--}}
            url: window.location.href,
            data: function (data) {
                data.property_start_date_filter = $("#property_start_date_filter").val();
                data.property_end_date_filter = $("#property_end_date_filter").val();
            }
        },
        columns: [
            {data: 'id', name: 'properties.id'},
            {data: 'scheme', name: 'batch.scheme.scheme'},
            {data: 'ref', name: 'batch.our_ref'},
            {data: 'client', name: 'client.name'},
            {data: 'address', name: 'address'},
            {data: 'start_date', name: 'properties.start_date'},
            {data: 'end_date', name: 'properties.end_date'},
            {data: 'hea_status', name: 'hea_status'},
            {data: 'eircode', name: 'eircode'},
            {data: 'contractor_status', name: 'contractor_status'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#property_batch_filter').change(function () {
        propertiesDataTable
            .columns(2)
            .search($("#property_batch_filter").val())
            .columns(1)
            .search($("#property_scheme_filter").val())
            .columns(10)
            .search($("#property_status_filter").val())
            .draw();
    });

    $('#property_scheme_filter').change(function () {
        propertiesDataTable
            .columns(2)
            .search($("#property_batch_filter").val())
            .columns(1)
            .search($("#property_scheme_filter").val())
            .columns(10)
            .search($("#property_status_filter").val())
            .draw();
    });

    $('#property_status_filter').change(function () {
        propertiesDataTable
            .columns(2)
            .search($("#property_batch_filter").val())
            .columns(1)
            .search($("#property_scheme_filter").val())
            .columns(10)
            .search($("#property_status_filter").val())
            .draw();
    });

    $("#property_start_date_filter").change(function () {
        propertiesDataTable
            .columns(2)
            .search($("#property_batch_filter").val())
            .columns(1)
            .search($("#property_scheme_filter").val())
            .columns(10)
            .search($("#property_status_filter").val())
            .draw();
    });

    $("#property_end_date_filter").change(function () {
        propertiesDataTable
            .columns(2)
            .search($("#property_batch_filter").val())
            .columns(1)
            .search($("#property_scheme_filter").val())
            .columns(10)
            .search($("#property_status_filter").val())
            .draw();
    });

    $('#contractor-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        serverSide: true,
        pageLength: 25,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('contractor')}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'company', name: 'company'},
            {data: 'firstname', name: 'firstname'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address'},
            {data: 'jobs', name: 'jobs'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#assessor-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        serverSide: true,
        pageLength: 25,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('assessor')}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'company', name: 'company'},
            {data: 'firstname', name: 'firstname'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#contract-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        serverSide: true,
        pageLength: 25,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('contract')}}"
        },
        columns: [
            {data: 'address1', name: 'address1', orderable: false},
            {data: 'batch', name: 'batch', orderable: false},
            {data: 'wh_fname', name: 'wh_fname', orderable: false},
            {data: 'wh_lname', name: 'wh_lname', orderable: false},
            {data: 'end_date', name: 'end_date', orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#accessor-contract-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        serverSide: true,
        pageLength: 25,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('assessor-contract')}}"
        },
        columns: [
            {data: 'address1', name: 'address1'},
            {data: 'batch', name: 'batch'},
            {data: 'wh_fname', name: 'wh_fname'},
            {data: 'wh_lname', name: 'wh_lname'},
            {data: 'end_date', name: 'end_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#logs-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        order: [[0, "desc"]],
        serverSide: true,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('dashboard')}}"
        },
        columns: [
            {data: 'created_at', name: 'created_at'},
            {data: 'author', name: 'author'},
            {data: 'type', name: 'type'},
            // {data: 'address', name: 'address'},
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#post-work-logs-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        serverSide: true,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('dashboard.postWorkLog')}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'notes', name: 'notes'},
            {data: 'status', name: 'status'},
            {data: 'date_added', name: 'date_added'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#property-notes-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        order: [[0, "desc"]],
        serverSide: true,
        responsive: true,
        select: true,
        pageLength: 5,
        "processing": true,
        empty: 'fff',
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> ',
            emptyTable: "No notes available"
        },
        ajax: {
            url: "{{route('property.note', isset($property) ? $property->id : 1)}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'text', name: 'text'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#job-lookup-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        order: [[0, "desc"]],
        serverSide: true,
        responsive: true,
        select: true,
        pageLength: 25,
        "processing": true,
        empty: 'fff',
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('lookup.job')}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'type', name: 'type'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ]
    });

    $('#job-document-lookup-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        order: [[0, "desc"]],
        serverSide: true,
        responsive: true,
        select: true,
        pageLength: 10,
        "processing": true,
        empty: 'fff',
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('lookup.job.document', isset($lookup) ? $lookup->id : 0)}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ]
    });

    $('#schemes-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        order: [[2, "desc"]],
        serverSide: true,
        responsive: true,
        select: true,
        pageLength: 10,
        "processing": true,
        empty: 'fff',
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('lookup.scheme')}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'scheme', name: 'scheme'},
            {data: 'is_active', name: 'is_active'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ]
    });

    const contractorJobsDataTable = $('#dashboard-contractor-jobs-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        order: [[0, "desc"]],
        serverSide: true,
        pageLength: 10,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('dashboard.contractor-jobs')}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'wh_fname', name: 'wh_fname', orderable: false},
            {data: 'address', name: 'address', orderable: false},
            {data: 'eircode', name: 'property.eircode', orderable: false},
            {data: 'phone', name: 'phone', orderable: false},
            {data: 'property.created_at', name: 'property.created_at'},
            {data: 'property.wh_mprn', name: 'property.wh_mprn', orderable: false},
            {data: 'scheme', name: 'property.batch.scheme.scheme', orderable: false},
            {data: 'property.batch.our_ref', name: 'property.batch.our_ref', orderable: false},
            {data: 'job', name: 'job', orderable: false, searchable: false},
            {data: 'surveyor.full_name', name: 'surveyor.full_name', orderable: false},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });


    $('#dashboard_job_filter_select').change(function () {
        contractorJobsDataTable
            .columns(8)
            .search($("#dashboard_job_filter_select").val())
            .draw();
    });

    let jobs = [];
    @if(isset($jobs))
        jobs = @json($jobs);
    @endif

    $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              saveOrder();
          }
        });

        function saveOrder() {
          var order = [];

          $('#tablecontents tr').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              contractor_id : $(this).attr('data-contractor'),
              position: index+1
            });
          });

          $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('dashboard.property-contracts-order') }}",
            data: {
              order: order
            },
            success: function(response) {

            }
          });

        }

    const propertyContractsDataTable = $('#dashboard_properties_with_statuses').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', 'print', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
        ],
        serverSide: true,
        pageLength: 25,
        responsive: false,
        select: true,
        scrollX: true,
        // scrollCollapse: true,
        fixedColumns: {
            left: 1
        },
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        createdRow: function( row, data, dataIndex ) {
            $(row).attr('data-contractor', "{{request('contractor_id')}}");
        },
        ajax: {
            url: "{{route('dashboard.property-contracts')}}",
            type: 'POST',
            data: function(data){
                data.batch_id = $('#properties_batch').val();;
                data.contractor_id = "{{request('contractor_id')}}";
                data.scheme = $('#properties_scheme').val();
                data.selected_jobs = $('#properties_jobs').val();
            }
        },
        columns: [
            {data: 'address', name: 'address', class: "px-1 py-0 border-b bg-light h-33px align-middle", orderable: false},
            {data: 'status', name: 'properties.status', class: "px-1 py-0 align-middle text-uppercase"},
            ...(jobs?.length ? jobs:  []).map((job, key) => ({
                data: 'c_' + job.id,
                name: 'c_' + job.id,
                orderable: false,
                searchable: false,
                class: "px-1 py-0 align-middle"
            }))
        ],

    });

    $("#properties_jobs,#properties_batch,#properties_scheme").on('change',function() {
        propertyContractsDataTable.draw();
    });

    @if(isset($property) && $property->id)

    $('#property-surveyor-sign-logs').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'print'
        ],
        serverSide: true,
        pageLength: 25,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('property.surveyorLogs', $property->id)}}"
        },
        columns: [
            {data: 'surveyor', name: 'surveyor', orderable: false, searchable: false, width: 100},
            {data: 'type', name: 'type', orderable: false, searchable: false},
            {data: 'date', name: 'date', orderable: false, searchable: false},
            {data: 'time', name: 'time', orderable: false, searchable: false},
            {data: 'text', name: 'text', orderable: false, searchable: false},
            {data: 'showDetails', name: 'showDetails', orderable: false, searchable: false}
        ]
    });


    const fetchAndPopulateSurveyors = () => {
        listContainer = $('#survery-list')
        $.ajax({
            url: '{{route('property.getSurveyors', $property->id)}}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                listContainer.html('');
                data.forEach((surveyor, i) => {
                    listContainer.append(`<li >
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-center align-items-center"><span class="info font-16 mr-1">${surveyor?.name}</span><span class="font-12">(${surveyor?.survey_date})</span></div>
                                    <div>
                                        <span>
                                            <i onclick="deleteSurveyor(${surveyor.id})" class="pointer dripicons-cross"></i>
                                        </span>
                                    </div>
                                </div>
                            </li>`)
                })
            }
        });
    }

    const removeSurveyor = (id) => {
        let removeUrl = `{{route('property.removeSurveyor', 'delete_id')}}`;
        $.ajax({
            url: removeUrl.replace('delete_id', id),
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                fetchAndPopulateSurveyors();
            }
        })
    }

    const deleteSurveyor = (id) => {
        if (confirm('Are you are sure you want to remove this surveyor?')) {
            removeSurveyor(id);
        }
    }


    fetchAndPopulateSurveyors();

    $('#add-surveyor-form').submit((e) => {

        e.preventDefault();

        const surveyDate = $('#survery-date-picker').val();
        const surveyorId = $('#surveyors-dropdown').val();

        if (surveyDate && surveyorId && confirm('Are you sure you want to add this surveyor to the property?')) {

            $.ajax({
                url: '{{route('property.assignSurveyor', $property->id)}}',
                type: 'POST',
                dataType: 'json',
                contentType: "application/json",
                data: JSON.stringify({
                    survey_date: surveyDate,
                    surveyor_id: surveyorId,
                    property_id: {{$property->id}}
                }),
                success: function (data) {
                    fetchAndPopulateSurveyors();
                }
            });

        }
    })

    $(document).ready(function () {
        $('#property_inspection_table').DataTable({
            order: [[1, 'desc']],
        });
    });

    $(document).ready(function () {
        $('#third_party_form_table').DataTable({
            order: [[1, 'desc']],
        });
    });

    @endif

    function showSurveyorLogDetails(id = 0) {
        const IMAGE_BASE_PATH = "{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/user_signinout/')}}";
        $.ajax({
                url: "{{route('property.surveyorLogDetails', 'log_id')}}".replace('log_id', id),
                type: 'GET',
                dataType: 'json',
                contentType: "application/json",
                success: function (data) {
                    let signInColumns = '';
                    for(let i = 1; i <= 15; i++) {
                        if(data['signin_image'+i]){
                            console.log(data['signin_image'+i]);
                            signInColumns += `<div class="col-sm-12 p-2">
                                        <img src="${IMAGE_BASE_PATH}/${data['signin_image'+i]}" class="img-fluid">
                                    </div>`;
                        }
                    }

                    let signOutColumns = '';

                    for(let i = 1; i <= 15; i++) {
                        if(data['signout_image'+i]){
                            console.log(data['signout_image'+i]);
                            signOutColumns += `<div class="col-sm-12 p-2">
                                        <img src="${IMAGE_BASE_PATH}/${data['signout_image'+i]}" class="img-fluid">
                                    </div>`;
                        }
                    }

                    const [signin_year, signin_month, signin_day] = (data?.sign_date || '0000-00-00').split('-');
                    const [signout_year, signout_month, signout_day] = (data?.sign_e_date || '0000-00-00').split('-');

                    let html = `<div>
                        <div class="d-flex align-items-center">
                            <h4>Sign In </h4> <span> <small> &nbsp ${signin_day}/${signin_month}/${signin_year} ${data?.sign_time?.substr(0, 5)} </small></span>
                        </div>
                        <div>
                            <p>${data?.text}</p>
                        </div>
                        <div class="row">${signInColumns}</div>

                        <br>

                        <div class="d-flex align-items-center">
                            <h4>Sign Out </h4> <span> <small> &nbsp ${signout_day}/${signout_month}/${signout_year} ${data?.sign_e_time?.substr(0, 5) || '00:00'} </small></span>
                        </div>
                        <div>
                            <p>${data?.signout_text}</p>
                        </div>
                        <div class="row">${signOutColumns}</div>
                    <div>`;

                    $('#surveyor-log-detail-model-body').html(html);

                    $('#surveyor-log-detail-model').modal('show');
                }
            });

    }

    function closeSurveyorLogModal() {
        $('#surveyor-log-detail-model').modal('hide');
    }


    // Calendar JS:: start here
    // document.addEventListener('DOMContentLoaded', function() {
    //     var calendarEl = document.getElementById('job-calendar');
    //     var calendar = new FullCalendar.Calendar(calendarEl, {
    //         eventSources: getCalendarEvents,
    //         headerToolbar: {
    //             start: 'prev,next',
    //             center: 'title',
    //             end: 'today'
    //         },
    //         navLinks: true,
    //         eventClick: function(info) {
    //             console.log(info.event);
    //             $('#calendar_modal_title').html(info.event.extendedProps.address);
    //             $('#calendar-modal-body').html(`<table class="table">
    //             <tbody>
    //                 <tr>
    //                 <td>Job</td>
    //                 <td>`+info.event.title+`</td>
    //                 </tr>
    //                 <tr>
    //                 <td>Contractor Name</td>
    //                 <td>`+info.event.extendedProps.contractor_name+`</td>
    //                 </tr>
    //                 <tr>
    //                 <tr>
    //                 <td>Contractor Email</td>
    //                 <td>`+info.event.extendedProps.contractor_email+`</td>
    //                 </tr>
    //                 <tr>
    //                 <tr>
    //                 <td>Contractor Phone</td>
    //                 <td>`+info.event.extendedProps.contractor_phone+`</td>
    //                 </tr>
    //                 <tr>
    //                 <td>Surveyor Name</td>
    //                 <td>`+info.event.extendedProps.surveyor_name+`</td>
    //                 </tr>
    //                 <tr>
    //                 <td>Surveyor Phone</td>
    //                 <td>`+info.event.extendedProps.surveyor_phone+`</td>
    //                 </tr>
    //                 <tr>
    //                 <td>Status</td>
    //                 <td><span class="pointer badge `+info.event.extendedProps.status_class+` text-uppercase">`+info.event.extendedProps.status+`</span></td>
    //                 </tr>
    //                 <tr>
    //                 <td>Property</td>
    //                 <td><a href="/dashboard/property/show/`+info.event.extendedProps.action_url+`">`+info.event.extendedProps.address+`</a></td>
    //                 </tr>
    //             </tbody>
    //             </table>`);

    //             $('#calendarModal').modal('show');
    //         }
    //     });
    //     calendar.render();

    //     $("#calendar_jobs,#calendar_start_date,#calendar_end_date").on("change", function(e){
    //         calendar.refetchEvents();
    //     });
    // });


    // var getCalendarEvents = function(fetchInfo, successCallback, failureCallback) {
    //     var jobs = $("#calendar_jobs").val();
    //     var start_date = $("#calendar_start_date").val();
    //     var end_date = $("#calendar_end_date").val();
    //     $.ajax({
    //         url: "{{route('dashboard.calendar')}}",
    //         type: "POST",
    //         data: {
    //             jobs: jobs,
    //             start_date: start_date,
    //             end_date: end_date
    //         },
    //         success: function (response) {
    //             successCallback(response);
    //         }
    //     });
    // }

    // function closeModal() {
    //     $('#calendarModal').modal('hide');
    // }

    // Calendar JS:: end here

</script>

</body>

</html>
