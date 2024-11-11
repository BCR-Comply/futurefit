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
  </style>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
        Send Email</h4>

     @php
        $lead_scheme = collect($schemes)->first(function ($scheme) {
            return $scheme->scheme == 'Leads';
        });
        if (is_null($lead_scheme)) {
            $lead_scheme = [];
        }
    @endphp


    <div class="row">
        <div class="col-12">
            <form action="{{ route('lead.sendEmailCustom') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="to_name" value="{{ $property->wh_fname }}">
                <input type="hidden" name="prev" value="{{ $prev }}">
                <input type="hidden" name="fk_property_id" value="{{ $property->id }}">
                <div class="col-md-12" style="position: relative;">
                        <label for="to_email" class="form-label mb-0 mt-2">To: <span class="text-danger" title="Required field">*</span></label>
                        <input type="email" id="to_email" name="to_email" class="form-control" value="{{ $property->email }}" placeholder="Enter email here..." required readonly>
                        <span class="classcc">cc</span>
                        <span class="classbcc">bcc</span>
                </div>
                <div class="col-md-12 ccClass d-none">
                    <label for="to_cc" class="form-label mb-0 mt-2">cc:</label>
                    {{-- <select name="to_cc[]" id="to_cc" class="to_cc form-control" multiple="multiple"></select> --}}
                    <input type="email" id="to_cc" name="to_cc" class="form-control" placeholder="Enter cc here...">
                </div>
                <div class="col-md-12 bccClass d-none">
                    <label for="to_bcc" class="form-label mb-0 mt-2">bcc:</label>
                    {{-- <select name="to_bcc[]" id="to_bcc" class="to_bcc form-control" multiple="multiple">
                        <option value="{{ env("MAIL_USERNAME") }}" selected>{{ env("MAIL_USERNAME") }}</option>
                    </select> --}}
                    <input type="email" id="to_bcc" name="to_bcc" class="form-control" value="{{ env("MAIL_USERNAME") }}" placeholder="Enter bcc here...">
                </div>
                <div class="col-md-12">
                    <label for="to_subject" class="form-label mb-0 mt-2">Subject: <span class="text-danger" title="Required field">*</span></label>
                    <input type="text" id="to_subject" name="to_subject" class="form-control" placeholder="Enter subject here..." required>
                </div>
                <div class="col-md-12">
                    <label for="to_greeting" class="form-label mb-0 mt-2">Greeting Text:</label>
                    <input type="text" id="to_greeting" name="to_greeting" class="form-control" placeholder="Enter greeting here..." value="Hi, {{ $property->wh_fname }}">
                </div>
                <div class="col-md-12">
                    <label for="to_subject" class="form-label mb-0 mt-2">Body: <span class="text-danger" title="Required field">*</span></label>
                    <textarea name="to_body" id="to_body" class="ckeditor form-control" cols="30" rows="10" required></textarea>
                </div>
                <div class="col-md-12">
                    <label for="to_regards" class="form-label mb-0 mt-2">Regards Text:</label>
                    <input type="text" id="to_regards" name="to_regards" class="form-control" placeholder="Enter greeting here..." value="Kind Regards,">
                </div>
                <div class="col-md-12">
                    <label for="to_regards_by" class="form-label mb-0 mt-2">Regards By:</label>
                    <input type="text" id="to_regards_by" name="to_regards_by" class="form-control" placeholder="Enter greeting here..." value="Admin">
                </div>
                <div class="col-md-12 d-flex">
                    <div class="col-md-6 mt-3">
                        <span  onclick="document.getElementById('filesx').click()"><svg height="18px" width="18px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 280.067 280.067" xml:space="preserve" fill="#1a47a3" stroke="#1a47a3">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                            <g id="SVGRepo_iconCarrier"> <g> <path style="fill:##1a47a3;" d="M149.823,257.142c-31.398,30.698-81.882,30.576-113.105-0.429 c-31.214-30.987-31.337-81.129-0.42-112.308l-0.026-0.018L149.841,31.615l14.203-14.098c23.522-23.356,61.65-23.356,85.172,0 s23.522,61.221,0,84.586l-125.19,123.02l-0.044-0.035c-15.428,14.771-40.018,14.666-55.262-0.394 c-15.244-15.069-15.34-39.361-0.394-54.588l-0.044-0.053l13.94-13.756l69.701-68.843l13.931,13.774l-83.632,82.599 c-7.701,7.596-7.701,19.926,0,27.53s20.188,7.604,27.88,0L235.02,87.987l-0.035-0.026l0.473-0.403 c15.682-15.568,15.682-40.823,0-56.39s-41.094-15.568-56.776,0l-0.42,0.473l-0.026-0.018l-14.194,14.089L50.466,158.485 c-23.522,23.356-23.522,61.221,0,84.577s61.659,23.356,85.163,0l99.375-98.675l14.194-14.089l14.194,14.089l-14.194,14.098 l-99.357,98.675C149.841,257.159,149.823,257.142,149.823,257.142z"/> </g> </g>
                            </svg> Select Files</span>
                        <input type="file" style="visibility: hidden;" id="filesx"
                        accept="application/msword,application/vnd.ms-excel,application/vnd.ms-powerpoint,text/plain, application/pdf, image/*"
                        name="files[]" class="form-control" multiple>
                        <span class="d-flex flex-column" id="filenameList"></span>
                    </div>
                    <div class="col-md-6 py-3 pr-3 d-flex align-items-center justify-content-end">
                        <button type="submit" class="_btn-primary px-2 py-1">Send</button>
                    </div>
                </div>
                
            </form>
        </div><!-- end col -->
    </div><!-- end row -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready( function(){
        // $(".to_cc").select2({
        //     tags: true,
        //     placeholder:"Enter cc here...",
        //     tokenSeparators: [',', ' ']
        // })
        // $(".to_bcc").select2({
        //     tags: true,
        //     placeholder:"Enter bcc here...",
        //     tokenSeparators: [',', ' ']
        // })
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
            $('#to_cc').prop('required',false);
        }else{
            $('#to_cc').prop('required',false);
            $('.ccClass').addClass('d-none');
        }
    });
    $(document).on('click','.classbcc', function(){
        $(this).toggleClass('active');
        if($('.classbcc').hasClass('active')){
            $('.bccClass').removeClass('d-none');
            $('#to_bcc').prop('required',false);
        }else{
            $('.bccClass').addClass('d-none');
            $('#to_bcc').prop('required',false);
        }
    });
    });
</script>
@endsection
