@extends('layouts.dashboard.app')

@section('content')
<style>
.classcc{
            position: absolute;
            right: 10px;
            top: 36px;
            font-size: 20px;
            cursor: pointer;
        }
        .fxclose{
            margin-left: 10px;
            color: red;
            font-weight: 600;
        }
        .classbcc{
            position: absolute;
            right: 35px;
            top: 36px;
            cursor: pointer;
            font-size: 20px;
        }
        .classcc.active,.classbcc.active{
            color: #1A47A3;
        }
    th:first-child {
      border-top-left-radius: 12px; /* Adjust the pixel value as needed */
    }
    th:last-child {
      border-top-right-radius: 12px; /* Adjust the pixel value as needed */
    }
    tr:last-child td:first-child {
      border-bottom-left-radius: 12px; /* Adjust the pixel value as needed */
    }
    tr:last-child td:last-child {
      border-bottom-right-radius: 12px; /* Adjust the pixel value as needed */
    }
    .mybody{
        background-color: #e2e8ed;
        border-radius: 5px !important;
    }
    table{
        background-color: #fff;
        border-radius: 12px !important;
    }
    table {
      margin: 0 auto;
      outline: 1px solid white;
      outline-offset: -2px;
    }
    table td,table th {
      outline: 1px solid #e6e6e6 !important;
    }
    .table > :not(caption) > * > *{
        padding: 0.5rem 0.5rem !important;
    }
    .overflowClass{
        max-width: 160px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .po-none{
        pointer-events: none !important;
    }
    .firstClass{
        pointer-events: none !important;
    }
    .colsm-12{
        pointer-events: none !important;
    }
  </style>
    <h4 class="page-title text-uppercase">
        <a class="backalign" href="{{url()->previous()}}">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="mdi mdi-menu cliclef mr-3">
                <rect width="32" height="32" rx="16" fill="#E2E8ED" />
                <path
                    d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
                    fill="black" />
            </svg>
        </a>
        View Email</h4>

     @php
        $lead_scheme = collect($schemes)->first(function ($scheme) {
            return $scheme->scheme == 'Leads';
        });
        if (is_null($lead_scheme)) {
            $lead_scheme = [];
        }
    @endphp

        <div class="col-md-12 firstClass po-none colsm-12">
            <form action="#" method="#" enctype="multipart/form-data" readonly>
                {{-- @csrf --}}
                <input type="hidden" name="to_name" value="{{ $property->wh_fname }}">
                <input type="hidden" name="fk_property_id" value="{{ $property->id }}">
                <div class="col-md-12" style="position: relative;">
                        <label for="to_email" class="form-label mb-0 mt-2">To: <span class="text-danger" title="Required field">*</span></label>
                        <input type="email" id="to_email" name="to_email" class="form-control" value="{{ $data->to_email }}" placeholder="Enter email here..." required readonly>
                        <span class="classcc">cc</span>
                        <span class="classbcc">bcc</span>
                </div>
                <div class="col-md-12 ccClass">
                    <label for="to_cc" class="form-label mb-0 mt-2">cc: <span class="text-danger" title="Required field">*</span></label>
                    <input type="email" id="to_cc" name="to_cc" value="{{ $data->to_cc }}" class="form-control" placeholder="Enter cc here..." readonly>
                </div>
                <div class="col-md-12 bccClass">
                    <label for="to_bcc" class="form-label mb-0 mt-2">bcc: <span class="text-danger" title="Required field">*</span></label>
                    <input type="email" id="to_bcc" name="to_bcc" class="form-control" value="{{ env("MAIL_USERNAME") }}" placeholder="Enter bcc here..." readonly>
                </div>
                <div class="col-md-12">
                    <label for="to_subject" class="form-label mb-0 mt-2">Subject: <span class="text-danger" title="Required field">*</span></label>
                    <input type="text" id="to_subject" name="to_subject" class="form-control" value="{{$data->to_subject}}" placeholder="Enter subject here..." readonly required>
                </div>
                <div class="col-md-12">
                    <label for="to_greeting" class="form-label mb-0 mt-2">Greeting Text: <span class="text-danger" title="Required field">*</span></label>
                    <input type="text" id="to_greeting" name="to_greeting" class="form-control" value="{{$data->to_greeting}}" placeholder="Enter subject here..." readonly required>
                </div>
                <div class="col-md-12">
                    <label for="to_subject" class="form-label mb-0 mt-2">Body: <span class="text-danger" title="Required field">*</span></label>
                    <textarea name="to_body" id="to_body" class="ckeditor form-control" cols="30" rows="10" readonly>{!! $data->to_body!!}</textarea>
                </div>
                <div class="col-md-12">
                    <label for="to_regards" class="form-label mb-0 mt-2">Regards Text:</label>
                    <input type="text" id="to_regards" name="to_regards" class="form-control" placeholder="Enter greeting here..." value="{{$data->to_regards}}" readonly>
                </div>
                <div class="col-md-12">
                    <label for="to_regards_by" class="form-label mb-0 mt-2">Regards By:</label>
                    <input type="text" id="to_regards_by" name="to_regards_by" class="form-control" placeholder="Enter greeting here..." value="{{$data->to_regards_by}}" readonly>
                </div>
                <div class="col-md-12">
                    @if(sizeOf(json_decode($data->attechments)))       
                    <h5>ATTACHMENT</h5>
                        <div class="row">
                            @foreach (json_decode($data->attechments) as $key => $filesD)
                            <div class="col mb-2" style="gap: 10px;">
                                @php
                                    $extension = pathinfo($filesD->name, PATHINFO_EXTENSION);
                                @endphp
                                @if($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension == "svg")
                                <img src="{{$filesD->url}}" alt="{{$filesD->name}}" style="max-height: 200px;">
                                @else
                                <a style="pointer-events:all !important;" href="{{$filesD->url}}" download="{{$filesD->url}}">{{$filesD->name}}</a>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </form>
        </div><!-- end col -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    $(document).ready( function(){
        $('#filesx').change(function (e) {
            const files = e.target.files;
            $('#filenameList').html('');
            if (files.length > 1) {
                let fileList = '<span>Selected Files:</span>';
                for (let i = 0; i < files.length; i++) {
                fileList += `<div class="d-flex"><span>${files[i].name}</span></div>`;
                }
                // fileList += '</ul>';
                $('#filenameList').html(fileList);
            } else if (files.length === 1) {
                const fname = files[0].name;
                $('#filenameList').html('<div class="d-flex"><span>' + fname + '</span></div>');
            } else {
                $('#filenameList').html('No files selected');
            }
        });
    $(document).on('click','.classcc', function(){
        $(this).toggleClass('active');
        if($('.classcc').hasClass('active')){
            $('.ccClass').removeClass('d-none');
            $('#to_cc').prop('required',true);
        }else{
            $('#to_cc').prop('required',false);
            $('.ccClass').addClass('d-none');
        }
    });
    $(document).on('click','.classbcc', function(){
        $(this).toggleClass('active');
        if($('.classbcc').hasClass('active')){
            $('.bccClass').removeClass('d-none');
            $('#to_bcc').prop('required',true);
        }else{
            $('.bccClass').addClass('d-none');
            $('#to_bcc').prop('required',false);
        }
    });
    });
</script>
@endsection
