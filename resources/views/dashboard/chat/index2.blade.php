<!DOCTYPE html>
<html lang="en">
    <!-- Head -->
    <head>
        <meta charset="UTF-8">
        <title>{{config('app.name', 'Laravel')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no, viewport-fit=cover">
        <meta name="color-scheme" content="light dark">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <meta content="dashboard" name="author"/>
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com/">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700" rel="stylesheet">

        <link href="{{asset('assets/plugins/chat/css/template.bundle.css')}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    </head>
    <style>
        .fa-chevron-circle-left{
            color: #3b5e8a;
        }
        .fa-sync-alt{
            color: #3b5e8a;
        }

    </style>
    

    <body>

<div class="row">
    <div class="col-12">
        <!-- Layout -->
        <div class="layout overflow-hidden">

            
           
            <!-- Sidebar -->
            <aside class="sidebar bg-light">
                <div class="tab-content h-100" role="tablist">
                    <!-- Chats -->
                    <div class="tab-pane fade h-100 show active" id="tab-content-chats" role="tabpanel">
                        <div class="d-flex flex-column h-100 position-relative">
                            <div class="hide-scrollbar">
                                <div class="container py-8">
                                    <!-- Title -->
                                    <div class="mb-8">
                                        <h2 class="fw-bold m-0">Chats</h2>
                                    </div>

                                    <!-- Chats -->
                                    <div class="card-list">

                                        @foreach ($all_chats as $chat_user)
                                        <!-- Card -->
                                        <a href="{{ route('chat.open', ['id' => $chat_user['id']]) }}" class="card border-0 text-reset">
                                            <div class="card-body">
                                                <div class="row gx-5">
                                                    <div class="col-auto">
                                                        <div class="avatar">
                                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="contractor-name" class="avatar-img">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <h5 class="me-auto mb-0">{{ $chat_user['name'] }}</h5>
                                                            <span class="text-muted extra-small ms-2">{{ date('d-m-Y h:m A', strtotime($chat_user['msg_date'])) }}</span>
                                                        </div>

                                                        <div class="d-flex align-items-center">
                                                            <div class="line-clamp me-auto">
                                                                {{ $chat_user['last_msg'] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card-body -->
                                        </a>
                                        <!-- Card -->
                                        @endforeach

                                    </div>
                                    <!-- Chats -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- Sidebar -->

            <!-- Chat -->
            <main class="main {{ $id ? 'is-visible' : ''}} ">
                <div class="container h-100">

                
                    <div class="d-flex flex-column h-100 position-relative">
                        <!-- Chat: Header -->
                        <div class="chat-header border-bottom py-4 py-lg-7">
                            <div class="row align-items-center">

                                <!-- Mobile: close -->
                                <div class="col-2 d-xl-none">
                                    <a title="Back" class="icon icon-lg text-muted" href="#" data-toggle-chat="">
                                        <i class="fa fa-chevron-circle-left fa-2x"></i> 
                                    </a>
                                </div>
                                <!-- Mobile: close -->

                                <!-- Content -->
                                <div class="col-8 col-xl-12">
                                    <div class="row align-items-center text-center text-xl-start">
                                        <!-- Title -->
                                        <div class="col-12 col-xl-6">
                                            <div class="row align-items-center gx-5">
                                                <div class="col-auto">
                                                    <div class="avatar avatar-online d-none d-xl-inline-block">
                                                        <img class="avatar-img" src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="">
                                                    </div>
                                                </div>

                                                <div class="col overflow-hidden">
                                                    <h5 class="text-truncate">{{ @$contractor->firstname }} {{ @$contractor->lastname }}</h5>
                                                </div>

                                                
                                            </div>
                                        </div>
                                        <!-- Title -->
                                    </div>
                                </div>
                                <!-- Content -->
                                <!-- Mobile: close -->
                                <div class="col-2 d-xl-none">
                                    <a title="Reload chat" class="icon icon-lg text-muted" href="javascript:;" onclick="refresh_chat(); return false;">
                                        <i class="fas fa-sync-alt fa-lg"></i>
                                    </a>
                                </div>
                                <!-- Mobile: close -->

                            </div>
                        </div>
                        <!-- Chat: Header -->

                        <!-- Chat: Content -->
                        <div class="chat-body hide-scrollbar flex-1 h-100">
                            <div class="chat-body-inner">
                                <div class="py-6 py-lg-12">


                                    @if(count($messages) > 0)

                                    @foreach ($messages as $message)
                                    @if($message->from_user == auth()->user()->id)

                                        <div class="message message-out">
                                            <div class="avatar avatar-responsive">
                                                <img class="avatar-img" src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="">
                                            </div>

                                            <div class="message-inner">
                                                <div class="message-body">
                                                    
                                                    @if(!empty($message->attachment))
                                                    <div class="message-content">
                                                        <div class="message-gallery">
                                                            <div class="row gx-3">
                                                                <div class="col">
                                                                    <img class="img-fluid rounded" src="{{ asset('uploads/chat-attachments/'.$message->attachment) }}" data-action="zoom" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if(!empty($message->content))
                                                        <div class="message-content">
                                                            <div class="message-text">
                                                                <blockquote class="overflow-hidden">
                                                                    <h6 class="text-reset text-truncate">You</h6>
                                                                </blockquote>
                                                                <p>{{ $message->content }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="message-footer">
                                                    <span class="extra-small text-muted">{{ date('d-m-Y h:m A', strtotime($message->created_at)) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        
                                        <div class="message">
                                            <div class="avatar avatar-responsive">
                                                <img class="avatar-img" src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="">
                                            </div>

                                            <div class="message-inner">
                                                <div class="message-body">
                                                    @if(!empty($message->attachment))
                                                        <div class="message-content">
                                                            <div class="message-gallery">
                                                                <div class="row gx-3">
                                                                    <div class="col">
                                                                        <img class="img-fluid rounded" src="{{ asset('uploads/chat-attachments/'.$message->attachment) }}" data-action="zoom" alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if(!empty($message->content))
                                                        <div class="message-content">
                                                            <div class="message-text">
                                                                <blockquote class="overflow-hidden">
                                                                    <h6 class="text-reset text-truncate">{{ $contractor->firstname }} {{ $contractor->lastname }}</h6>
                                                                </blockquote>
                                                                <p>{{ $message->content }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="message-footer">
                                                    <span class="extra-small text-muted">{{ date('d-m-Y h:m A', strtotime($message->created_at)) }}</span>
                                                </div>
                                            </div>
                                        </div>

                                    @endif

                                    @endforeach

                                    @endif
                                   
                                </div>
                            </div>
                        </div>
                        <!-- Chat: Content -->


                        <!-- Chat: Footer -->
                        <div class="chat-footer pb-3 pb-lg-7 position-absolute bottom-0 start-0">

                            <!-- Chat: Form -->
                            <form class="chat-form rounded-pill bg-dark" enctype="multipart/form-data" method="post" action="{{ route('contractor.send-message') }}">
                                @csrf
                                <div class="row align-items-center gx-0">
                                    <div class="col-auto">
                                        <label for="file">
                                        <div class="btn btn-icon btn-link text-body rounded-circle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>  
                                        </div>
                                        </label>
                                        <input type="file" name="file" id="file" accept="image/*" style="display: none;">
                                        
                                    </div>
                                    <input type="hidden" name="from_user" value=" {{ auth()->user()->id }}">
                                    <input type="hidden" name="to_user" value="{{ $id }}">
                                    <div class="col">
                                        <div class="input-group">
                                            <textarea class="form-control px-0" placeholder="Type your message..." rows="1" name="content" data-autosize="true"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-icon btn-primary rounded-circle ms-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- Chat: Form -->
                        </div>
                        <!-- Chat: Footer -->

                    </div>
                </div>
            </main>
            <!-- Chat -->
        </div>
        <!-- Layout -->


    </div>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{asset('assets/plugins/chat/js/template.js')}}"></script>
<script src="{{asset('assets/plugins/chat/js/vendor.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };


    function refresh_chat(){
        location.reload(true);
    }
</script>


@if(isset($errors) && $errors->any())
	 @foreach($errors->all() as $error)
	<script> toastr.error("{{$error}}"); </script>
	@endforeach
	@endif
</html>


