@extends('layouts.dashboard.app')

@push('styles')
<style>

.chat-online {
    color: #34ce57
}

.chat-offline {
    color: #e4606d
}

.chat-messages {
    display: flex;
    flex-direction: column;
    max-height: 400px;
    height: 400px;
    overflow-y: scroll
}

.chat-message-left,
.chat-message-right {
    display: flex;
    flex-shrink: 0
}

.chat-message-left {
    margin-right: auto
}

.chat-message-right {
    flex-direction: row-reverse;
    margin-left: auto
}
.py-3 {
    padding-top: 1rem!important;
    padding-bottom: 1rem!important;
}
.px-4 {
    padding-right: 1.5rem!important;
    padding-left: 1.5rem!important;
}
.flex-grow-0 {
    flex-grow: 0!important;
}
.border-top {
    border-top: 1px solid #dee2e6!important;
}

.font-weight-bold{
    font-weight: bold;
}

.no-message{
    color: #c5c5c5;
}
</style>
@endpush

@section('content')
<h4 class="page-title">Messages</h4>
<div class="row">
    <div class="col-12">
        <div class="card _shadow-1">
            <div class="card-body">
                <div class="row g-0"></div>
				<div class="col-12 ">
					<div class="py-2 px-4 border-bottom d-none d-lg-block">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">
								<img src="{{ asset('assets/images/users/avatar-1.jpg') }}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
							</div>
							<div class="flex-grow-1 pl-3">
								<strong>{{ $contractor->firstname }} </strong>
							</div>
							
						</div>
					</div>

					<div class="position-relative">
						<div class="chat-messages p-4">
                            
                            @if(count($messages) > 0)
                            @foreach ($messages as $message)
                                @if($message->from_user == auth()->user()->id)
                                    
                                    <div class="chat-message-right pb-4">
                                        <div>
                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">{{ getRelativeTime($message->created_at) }}</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1">You</div>
                                            {{ $message->content }}
                                        </div>
                                    </div>
                                
                                @else
                                
                                    <div class="chat-message-left pb-4">
                                        <div>
                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" class="rounded-circle mr-1" alt="{{ $contractor->firstname }}" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">{{ getRelativeTime($message->created_at) }}</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                            <div class="font-weight-bold mb-1">{{ $contractor->firstname }}</div>
                                            {{ $message->content }}
                                        </div>
                                    </div>
                                
                                
                                @endif
                                
                                
                                
                                
                            @endforeach
                            @else
                                <p class="text-center no-message">No Messages</p>
                            @endif

							

						</div>
					</div>

					<div class="flex-grow-0 py-3 px-4 border-top">
                        <form method="post" action="{{ route('contractor.send-message') }}">
                        @csrf
						<div class="input-group">
                            <input type="hidden" name="from_user" value=" {{ auth()->user()->id }}">
                            <input type="hidden" name="to_user" value="{{ $id }}">
							<input type="text" name="content" class="form-control" placeholder="Type your message" required>
							<button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
						</div>
                        </form>
					</div>

				</div>
			</div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $(".chat-messages").animate({ scrollTop: $('.chat-messages').prop("scrollHeight")}, 1000);
    });
</script>
@endpush