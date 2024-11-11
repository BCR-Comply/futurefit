@extends('layouts.dashboard.app')

@section('content')
    <style>
        table {
            outline-offset: -1px !important;
        }

        video {
            height: 90px;
            width: 96px;
            object-fit: cover;
        }

        .folder-photos>h4 {
            color: #1A47A3;
        }
        .bg-grasy{

            border-radius: 6px !important;

        }
        .close-btn:has(+ video) {
            right: -63px !important;
        }

        .upload__img-box>div>video {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
        }
        #editor-controls{
            border-top: 2px solid #e6e6e6;
            margin-top: 20px;
        }
        #font-color,#font-size {
            z-index: 0;
            margin-left: 5px;
        }
        #font-color:before,#font-size:before{
            z-index: 2;
        }
        #font-color:after {
            content: "";
            position: absolute;
            width: 4px;
            left: 50px;
            border-radius: 50%;
            height: 4px;
            top: 9px;
            z-index: -1;
            box-shadow:
            -4px 0 0 rgb(190, 190, 190),
            37px 0 0 rgb(190, 190, 190),
            78px 0 0 rgb(190, 190, 190);
            }
            #font-size:after {
                content: "";
                position: absolute;
                width: 4px;
                left: 25px;
                border-radius: 50%;
                height: 4px;
                top: 6px;
                z-index: -1;
                box-shadow:
                4px 0 0 rgb(190, 190, 190),
                26px 0 0 rgb(190, 190, 190),
                50px 0 0 rgb(190, 190, 190),
                73px 0 0 rgb(190, 190, 190),
                97px 0 0 rgb(190, 190, 190),
                120px 0 0 rgb(190, 190, 190);
                }
        #font-color::-webkit-slider-thumb,#font-size::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            border-radius: 17px;
            box-shadow: 0px 2px 3px rgba(0,0,0,0.3);
        }
        #font-color::-moz-range-thumb,#font-size::-moz-range-thumb {
            -webkit-appearance: none;
            appearance: none;
            border-radius: 17px;
            box-shadow: 0px 2px 3px rgba(0,0,0,0.3);
        }
        .upload__img-box {
            position: relative;
        }

        .canvas-container {
            margin-bottom: 0.5rem !important;
            margin: 0 auto !important;
        }

        #font-size {
            margin-bottom: 0.375rem !important;
        }

        .col.card._shadow-1.generalCols {
            padding: 10px 15px;
        }

        /* .mfp-content{
                    width: 100%;
                    display: flex;
                }*/
        .deviders {
            border-top: 1px solid #e6e6e6;
            padding-block: 10px;
        }

        .mfp-wrap {
            display: -webkit-flex;
            display: flex;
            list-style-type: none;
            padding: 0;
            justify-content: flex-end;
        }

        .mfp-container {
            width: 75%;
        }

        .additional-details {
            width: 25%;
            background: #fff;
        }

        /* .mfp-content:nth-child(2){
                    width: 25%;
                } */
        tr td:not(:last-child),
        tr th:not(:last-child) {
            border-right: 1px solid #e6e6e6 !important;
        }

        .custom-dangerz {
            padding: 15px 0px;
        }

        .mouseHover {
            cursor: help;
        }

        .mfp-counter {
            display: none !important;
        }

        .backalign {
            width: fit-content;
            display: flex;
            align-self: center;
            margin-top: -10px;
        }

        ._btn-dangers,
        ._btn-dangers:hover {
            background: red;
            color: #fff;
            border-radius: 36px;
        }

        .borderBottomRedius {
            /* border-radius: 10px !important; */
            border-bottom-left-radius: 5px !important;
            border-bottom-right-radius: 5px !important;
        }

        .trans180 {
            transform: rotate(180deg) !important;
        }

        .propcart11,
        .toolboxdiv11,
        .propcart12 {
            background-color: #fff;
            border-radius: 10px !important;
            padding: 0.5rem 0rem !important;
        }

        button.dropdown-toggle {
            background: transparent !important;
            border: transparent !important;
            color: #1A47A3 !important;

        }

        .dropdown-toggle::after {
            display: none;
        }

        .reminderBoxsD {
            background-color: #f3f1fe !important;
            border: 1px solid #e6e6e6;
            color: #000 !important;
            border-radius: 10px;
            padding: 10px;
            margin: 0px 25px;
            position: relative;
            width: -webkit-fill-available;
        }

        .myremListD {
            background: #eaf1ff;
            width: 350px;
            margin: 5px 10px;
            border-radius: 10px;
            padding: 0px 10px;

        }

        .myremList {
            padding: 2px 1px 6px 1px !important;
            cursor: pointer;
        }

        .text-infos {
            color: #1A47A3;
        }
        .editableStatus {
            cursor: pointer;
        }
        .dropdown-menu.show {
            border-radius: 10px !important;
            max-height: 529px;
            overflow-y: auto;
        }

        .parent>p {
            margin: auto;
            text-align: justify;
            word-break: break-word;
            overflow-wrap: break-word;
            -ms-word-break: break-word;
            word-break: break-word;
            -ms-hyphens: auto;
            -moz-hyphens: auto;
            -webkit-hyphens: auto;
            hyphens: auto;
        }

        .showallm {
            display: flex;
            justify-content: center;
            border: unset;
            text-decoration: underline;
            padding: unset !important;
            box-shadow: none !important;
        }

        .showallm2 {
            /* margin-right: 0% !important */
        }

        .notiDot {
            position: absolute;
            right: -8px;
            top: -8px;
            background-color: red;
            border-radius: 36px;
            color: #fff;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 10px;
        }

        .editProps,
        .editProps:hover {
            background: #1a47a3;
            color: #fff;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 13px;
        }

        .table > :not(caption) > * > * {
            padding: 0.5rem 0.5rem !important;
        }

        table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_asc_disabled:before, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_desc_disabled:before {
            top: 2px !important;
        }
        table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_desc_disabled:after {
            top: 8px !important;
        }

        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_asc_disabled:after,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting_desc_disabled:after {
            right: 0.5em !important;
            left: auto;
            content: "\f035d" !important;
            font-family: "Material Design Icons";
            top: 18px;
            font-size: 1rem;
        }

        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc_disabled:before,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc_disabled:before {
            right: 0.5rem !important;
            left: auto;
            content: "\f0360" !important;
            font-family: "Material Design Icons";
            font-size: 1rem;
            top: 12px;
        }

        @media (max-width: 543px) {
            .reminderBoxs {
                min-width: fit-content !important;
            }
        }
        /* .videoOverlay{
            width: 140px !important;
        }
        .videoClose{
            right: -125px !important;
        }
        .videoClose1{
            right: -60px !important;
        } */
        figure > img.mfp-img{
            /* pointer-events: none !important; */
        }
        .zoom150{
            zoom: 200%;
        }
        .play-icon{
            position: relative;
            left: 42px;
            bottom: 101px;
            filter: drop-shadow(0px 0px 6px gray);
        }
        .vi-icon{
            bottom: 164px;
        }
        #property-assessor-table tbody tr{
            border-bottom: 1px solid #e6e6e6 !important;
        }
        #property-assessor-table tbody tr:nth-last-child(2):nth-child(odd) {
            border-bottom: 1px solid #fff !important;
        }
        #property-assessor-table tbody tr:last-child{
            border-bottom: 1px solid #fff !important;
        }
        #email-lead-data_wrapper > .dataTables_filter{
            right: 13pc !important;
        }
        #email-lead-data_wrapper > .dt-buttons > .dt-button.buttons-collection{
            right: 7pc !important;
        }
        .sendEmailBtn{
            width: fit-content;
            position: absolute;
            right: 16px;
            top: 3.4pc;
            padding: 7px 10px;
            cursor: pointer !important;
            z-index: 2;
        }
        .elep{
            max-width: 150px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            display: inline-block;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/_vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <div class="row mt-3">
        <div class="row d-flex flex-sm-row flex-column pe-0">
            @php
                if ($back == null) {
                    $back = 0;
                }
            @endphp
            {{-- <a class="backalign" href="{{ url('dashboard/property/' . $back) }}"> --}}
            <a class="backalign" href="{{url()->previous()}}">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="mdi mdi-menu cliclef mr-3">
                    <rect width="32" height="32" rx="16" fill="#E2E8ED" />
                    <path
                        d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
                        fill="black" />
                </svg>
            </a>
            @if ($property->status != 'completed' && strtotime($property->end_date) < strtotime(date('Y-m-d')))
                <div class="col custom-danger custom-dangerz  bg-danger text-white text-center my-0 mb-1" role="alert">
                    <b>THIS PROPERTY IS NOW OVERDUE</b>
                </div>
            @else
                <div class="col custom-danger custom-dangerz  bg-danger text-white text-center my-0 mb-1" role="alert"
                    style="opacity: 0;">
                    <b>THIS PROPERTY IS NOW OVERDUE</b>
                </div>
            @endif
            <div class="col-2 my-0 mb-1 reminderlist dropdown">
                <button class="dropdown-toggle dropdownMenuButton11" data-id="{{ $property->id }}"
                    style="padding: unset;margin:unset;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <b class="mr-3">Reminders</b>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_314_17910)">
                            <path
                                d="M19.5726 22C19.2788 23.2267 18.3639 23.9933 17.222 24C16.0401 24 15.1252 23.2533 14.8247 22H14.5643C13.3489 22 12.1336 22 10.9182 22C10.7112 22 10.5309 21.9733 10.4441 21.76C10.3506 21.54 10.4441 21.38 10.5977 21.2267C10.9516 20.88 11.2721 20.5067 11.6461 20.1933C11.9599 19.9267 12.0735 19.6267 11.9733 19.1933C11.8932 19.1933 11.7997 19.1933 11.7062 19.1933C7.99332 19.1933 4.27379 19.1933 0.560935 19.1933C0.113523 19.1933 0.0066778 19.08 0.0066778 18.6333C0 13.0133 0 7.39333 0 1.76667C0 1.30667 0.106845 1.2 0.57429 1.2C1.17529 1.2 1.76962 1.2 2.39733 1.2C2.39733 0.94 2.39733 0.706667 2.39733 0.466667C2.39733 0.146667 2.53756 0 2.84474 0C3.61269 0 4.38063 0 5.1419 0C5.4424 0 5.58264 0.146667 5.58932 0.44C5.58932 0.68 5.58932 0.92 5.58932 1.18H14.3907C14.3907 0.94 14.3907 0.7 14.3907 0.466667C14.3907 0.146667 14.5309 0 14.8381 0C15.606 0 16.374 0 17.1352 0C17.4357 0 17.576 0.146667 17.5826 0.44C17.5826 0.673333 17.5826 0.906667 17.5826 1.14C17.5826 1.14667 17.5826 1.15333 17.596 1.18667C17.6561 1.18667 17.7295 1.2 17.803 1.2C18.3506 1.2 18.9048 1.2 19.4524 1.2C19.8531 1.2 19.9733 1.32 19.9733 1.72C19.9733 4.66 19.9733 7.6 19.9733 10.5467C19.9733 10.74 20.0267 10.8533 20.187 10.9733C21.5893 12.0067 22.3439 13.4 22.3706 15.1467C22.3973 16.64 22.3706 18.1267 22.384 19.62C22.384 19.74 22.4507 19.8933 22.5376 19.98C22.9449 20.4067 23.3656 20.82 23.7863 21.24C23.9332 21.3867 24.0334 21.54 23.9533 21.7467C23.8664 21.9733 23.6861 22.0067 23.4658 22.0067C22.2571 22.0067 21.0484 22.0067 19.8397 22.0067C19.7462 22.0067 19.6594 22.0067 19.5526 22.0067L19.5726 22ZM12 18.3933C12 18.28 12 18.1933 12 18.1C12 17.1467 11.9866 16.2 12 15.2467C12.0401 13.0533 13.0551 11.4667 15.0117 10.48C15.1452 10.4133 15.2254 10.34 15.1987 10.18C15.1853 10.1067 15.1987 10.0333 15.1987 9.95333C15.212 8.52 16.7279 7.56 18.03 8.16667C18.6311 8.44667 18.9983 8.92667 19.1853 9.56V5.6H0.814691V18.38H12V18.3933ZM22.5576 21.1933C22.5709 21.1733 22.5843 21.16 22.5977 21.14C22.3372 20.8867 22.0768 20.6333 21.8097 20.3867C21.6561 20.2467 21.596 20.0867 21.596 19.88C21.596 18.3733 21.6027 16.8667 21.596 15.36C21.596 15.0133 21.5626 14.66 21.5025 14.32C21.0818 12.0133 18.7045 10.42 16.414 10.88C14.2504 11.32 12.808 13.0733 12.8013 15.28C12.8013 16.76 12.788 18.2467 12.808 19.7267C12.808 20.06 12.7212 20.3 12.4741 20.5133C12.2404 20.7133 12.0334 20.9467 11.7796 21.2H22.5576V21.1933ZM14.404 2.02H5.60935C5.50918 3.31333 5.02838 3.94667 4.13356 4C3.70618 4.02667 3.32554 3.92 2.99165 3.65333C2.46411 3.23333 2.34391 2.65333 2.39733 2.02H0.814691V4.79333H19.1786V2.02H17.6027C17.5159 3.34 16.995 3.98667 16.0267 4C15.5993 4 15.2254 3.86667 14.9115 3.58C14.4508 3.16667 14.3439 2.62 14.3973 2.01333L14.404 2.02ZM3.19866 0.806667C3.19866 1.36667 3.18531 1.9 3.19866 2.42667C3.21202 2.84667 3.54591 3.16 3.94658 3.19333C4.32721 3.22 4.72788 2.94667 4.76127 2.54C4.80801 1.96667 4.77462 1.38667 4.77462 0.806667H3.19199H3.19866ZM15.1987 0.806667C15.1987 1.36667 15.1853 1.9 15.1987 2.42667C15.212 2.84667 15.5392 3.16 15.9466 3.19333C16.3272 3.22 16.7279 2.94667 16.7613 2.54C16.808 1.96667 16.7746 1.38667 16.7746 0.8H15.192L15.1987 0.806667ZM15.6928 22.0067C15.7596 22.6467 16.5142 23.2267 17.2354 23.2C17.9499 23.1733 18.6644 22.5867 18.6845 22.0067H15.6928ZM18.3906 10.1333C18.404 9.62667 18.2304 9.23333 17.8097 8.98C17.3689 8.71333 16.9215 8.74 16.5008 9.02667C16.1336 9.27333 15.9399 9.74 16.0334 10.1267C16.8147 9.94667 17.596 9.95333 18.3973 10.1267L18.3906 10.1333Z"
                                fill="#1A47A3" />
                            <path
                                d="M2.39844 7.98625C2.39844 7.61292 2.39844 7.23958 2.39844 6.86625C2.39844 6.54625 2.53867 6.40625 2.85253 6.40625C3.62047 6.40625 4.38174 6.40625 5.14969 6.40625C5.45687 6.40625 5.5971 6.55292 5.5971 6.87292C5.5971 7.63292 5.5971 8.38625 5.5971 9.14625C5.5971 9.47292 5.45687 9.60625 5.12298 9.60625C4.37506 9.60625 3.62715 9.60625 2.87924 9.60625C2.53867 9.60625 2.40512 9.46625 2.40512 9.11958C2.40512 8.74625 2.40512 8.37292 2.40512 7.99958L2.39844 7.98625ZM3.21313 7.20625V8.77958H4.78241V7.20625H3.21313Z"
                                fill="#1A47A3" />
                            <path
                                d="M5.5971 16.0118C5.5971 16.3851 5.5971 16.7584 5.5971 17.1318C5.5971 17.4518 5.45687 17.5984 5.14969 17.5984C4.38174 17.5984 3.62047 17.5984 2.85253 17.5984C2.53867 17.5984 2.39844 17.4518 2.39844 17.1384C2.39844 16.3784 2.39844 15.6251 2.39844 14.8651C2.39844 14.5384 2.53867 14.3984 2.87256 14.3984C3.62047 14.3984 4.36839 14.3984 5.1163 14.3984C5.45687 14.3984 5.59042 14.5384 5.5971 14.8851C5.5971 15.2584 5.5971 15.6318 5.5971 16.0051V16.0118ZM3.21313 15.2118V16.7851H4.78241V15.2118H3.21313Z"
                                fill="#1A47A3" />
                            <path
                                d="M4.00501 13.5984C3.62438 13.5984 3.23707 13.5984 2.85643 13.5984C2.54258 13.5984 2.40234 13.4584 2.40234 13.1384C2.40234 12.3718 2.40234 11.6051 2.40234 10.8451C2.40234 10.5451 2.54926 10.4051 2.84308 10.3984C3.6177 10.3984 4.39233 10.3984 5.16027 10.3984C5.44074 10.3984 5.58765 10.5451 5.59433 10.8318C5.59433 11.6118 5.59433 12.3984 5.59433 13.1784C5.59433 13.4451 5.44074 13.5918 5.17363 13.5984C4.77964 13.5984 4.39233 13.5984 3.99834 13.5984H4.00501ZM3.21703 11.2118V12.7851H4.78632V11.2118H3.21703Z"
                                fill="#1A47A3" />
                            <path
                                d="M7.98108 13.5996C7.09293 13.5996 6.39844 12.8796 6.39844 11.9863C6.39844 11.0996 7.11296 10.3996 8.01446 10.4063C8.90261 10.4063 9.5971 11.1263 9.5971 12.0196C9.5971 12.9063 8.8759 13.6063 7.98108 13.5996ZM7.19977 11.9796C7.18642 12.3996 7.54702 12.7796 7.98108 12.7996C8.40178 12.813 8.78909 12.4463 8.80244 12.0196C8.8158 11.593 8.4552 11.2196 8.02114 11.1996C7.60044 11.1863 7.21981 11.5463 7.19977 11.9796Z"
                                fill="#1A47A3" />
                            <path
                                d="M6.39844 7.99958C6.39844 7.10625 7.10628 6.40625 8.00111 6.40625C8.88926 6.40625 9.5971 7.11958 9.5971 8.01292C9.5971 8.89958 8.88258 9.60625 7.99443 9.60625C7.10628 9.60625 6.39844 8.89292 6.40512 7.99958H6.39844ZM8.79577 8.01958C8.80244 7.59292 8.44184 7.21958 8.00779 7.20625C7.58709 7.19292 7.20645 7.56625 7.19977 7.99292C7.1931 8.41958 7.5537 8.79292 7.98775 8.80625C8.40845 8.81958 8.78909 8.44625 8.80244 8.01958H8.79577Z"
                                fill="#1A47A3" />
                            <path
                                d="M8.01451 14.3984C8.90266 14.3984 9.60383 15.1184 9.59715 16.0118C9.59715 16.8984 8.87595 17.5984 7.98112 17.5984C7.09298 17.5984 6.39181 16.8784 6.39848 15.9851C6.39848 15.0984 7.11301 14.3984 8.01451 14.4051V14.3984ZM8.79581 15.9984C8.79581 15.5718 8.42853 15.1984 8.00116 15.1984C7.57378 15.1984 7.19982 15.5718 7.19982 15.9984C7.19982 16.4251 7.5671 16.7984 7.99448 16.7984C8.41518 16.7984 8.79581 16.4251 8.79581 15.9984Z"
                                fill="#1A47A3" />
                            <path
                                d="M13.6077 7.99729C13.6011 8.89063 12.8865 9.59729 11.9984 9.59729C11.1236 9.59729 10.3957 8.85729 10.4024 7.98396C10.4024 7.10396 11.1303 6.39062 12.0184 6.39062C12.9066 6.39062 13.6144 7.11062 13.6077 7.99729ZM11.9984 7.19729C11.5576 7.19729 11.2104 7.55729 11.2171 7.99729C11.2171 8.42396 11.5977 8.79063 12.0251 8.78396C12.4658 8.77063 12.8064 8.41729 12.8064 7.97729C12.8064 7.53729 12.4458 7.19062 12.0051 7.19729H11.9984Z"
                                fill="#1A47A3" />
                        </g>
                        <defs>
                            <clipPath id="clip0_314_17910">
                                <rect width="24" height="24" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </button>
                <ul class="dropdown-menu appnedLi appnedLiP" aria-labelledby="dropdownMenuButton1">
                    @if (sizeOf($reminderss))
                    <div class="psremlis" style="max-height: 282px;">
                        @foreach ($reminderss as $rkey => $reminder)
                                <li class="myremListD">
                                    <div class="dropdown-item myremList" data-id="{{ $reminder->id }}" style="color:#1A47A3">
                                        <div class="d-flex justify-content-between">
                                            <h5
                                                style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;max-width: 50%;">
                                                <b>{{ $reminder['title'] }}</b>
                                            </h5>
                                            <a aria-hidden="true" class="text-bluess" style="color: #D33737;font-size: 16px;left: 2px;top: 3px;position: relative;"
                                                href="{{ route('property.deleteReminder', $reminder['id']) }}"
                                                onClick="return confirm(`Are you sure you want to delete?`)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="parent" style="text-overflow: ellipsis;overflow: hidden;">
                                            <p style="text-overflow: ellipsis;overflow: hidden;">{{ $reminder['notes'] }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <b>Due:</b>{{ date('d/m/Y', strtotime($reminder['due_date'])) . ' ' . date('h:i A', strtotime($reminder['due_time'])) }}
                                            </div>
                                            <div><small><span
                                                        class="@if ($reminder['status'] == 'Complete') compl @else inprog @endif"
                                                        style="padding: 2px 8px;">
                                                        @if ($reminder['status'] == 'Complete')
                                                            Complete
                                                        @else
                                                            Pending
                                                        @endif
                                                    </span></small></div>
                                        </div>
                                    </div>
                                </li>
                        @endforeach
                    </div>
                        <span style="margin: 15px auto;font-size: 15px;font-weight: 600;color: #1A47A3;width: -webkit-fill-available;text-align: center;text-decoration: underline;float: unset !important;height:23px !important;" class="filterSidebar showallm showallm2 mb-2" data-atr="rem">View All Reminders</span>
                    @else
                        @if ($reminders->count() != 0)
                        <span style="margin: 15px auto;font-size: 15px;font-weight: 600;color: #1A47A3;width: -webkit-fill-available;text-align: center;text-decoration: underline;float: unset !important;height:23px !important;" class="filterSidebar showallm showallm2 mb-2" data-atr="rem">View All Reminders</span>
                        @else
                        <span style="margin: 15px;font-size: 15px;font-weight: 600;width: -webkit-fill-available;text-align: center;text-decoration: underline;float: unset !important;height:23px !important; overflow-y: hidden;" class="filterSidebar showallm showallm2 mb-2">Reminders Not Available</span>
                        @endif
                    @endif
                </ul>
                <span class="notiDot @if ($remindersCount == 0) d-none @endif">{{ $remindersCount }}</span>
            </div>
        </div>

        <span style="display: none">{{ $property->status }}</span>
    </div>
    <div class="row px-2">
        <div class="card _shadow-2 mb-1 mt-2 p-2">

            @php

                $completed_work = 0;
                $uncompleted_work = 0;
                $total_work = 0;

            @endphp

            @foreach ($contractors as $contractor)
                @if ($contractor['status'] == 'Complete')
                    @php
                        $completed_work++;
                    @endphp
                @else
                    @php
                        $uncompleted_work++;
                    @endphp
                @endif

                @php
                    $total_work++;
                @endphp
            @endforeach

            @php
                $work_amount_done = round(
                    ($completed_work / ($total_work == 0 ? 1 : $total_work)) * (float) $property['overall_total'],
                    2,
                );
            @endphp

            <div class="d-flex justify-content-between px-2">
                <div>
                    <span class="text-infos">Measures Remaining:</span>
                    {{ round(($uncompleted_work / ($total_work == 0 ? 1 : $total_work)) * 100, 2) }}%
                </div>
                <div>
                    <span class="text-infos">Measures Completed:</span>
                    {{ round(($completed_work / ($total_work == 0 ? 1 : $total_work)) * 100, 2) }}%
                </div>
                <div>
                    <span class="text-infos">Value Done:</span> €{{ $work_amount_done }}
                </div>
            </div>

        </div>
    </div>
    <div class="row mt-2 px-2">
        <div class="card _shadow-2 my-1">
            <div class="row" style="min-height: 150px;">
                <div class="col-3 padding-15 border-right d-flex flex-column ">
                    <b class="mb-2">Occupier</b>
                    <span class="mb-1">
                        {{ $property->wh_fname . ' ' . $property->wh_lname }}
                    </span>
                    <span class="mb-1">{{ $property->phone1 }}</span>
                    <span class="mb-1">
                        @if (trim($property->phone2))
                            {{ $property->phone2 }}
                        @endif
                    </span>
                    <span class="mb-1">{{ $property->email }}</span>
                </div>
                <div class="col-3 padding-15 border-right d-flex flex-column" style="position: relative;">
                    <b class="mb-2">Address</b>
                    <span style="word-break: break-word;">
                        {{ format_address(
                            $property->house_num,
                            $property->address1,
                            $property->address2,
                            $property->address3,
                            $property->county,
                            $property->eircode,
                        ) }}
                    </span>
                    <div style="position: absolute;right: 12px;">
                        <a class="editProps"
                            href="{{ route('property.edit', \Illuminate\Support\Facades\Crypt::encrypt($property->id)) . '?back=' . (isset($_GET['back']) ? $_GET['back'] : '0') }}">Edit
                            Property</a>
                    </div>
                </div>

                <div class="col-2 padding-15 border-right d-flex flex-column">
                    <b class="mb-2">Date Added</b>
                    <p>{{ date('d/m/Y', strtotime($property['created_at'])) }}</p>
                </div>
                <div class="col-2 padding-15 border-right d-flex flex-column">
                    <b class="mb-2">MPRN</b>
                    <p>{{ $property['wh_mprn'] }}</p>
                </div>
                <div class="col-2 padding-15 d-flex flex-column">
                    <b class="mb-2">Scheme</b>
                    <p>{{ isset($property->batch) ? $property->batch->scheme->scheme : '' }}</p>
                </div>
            </div>
            <div class="row border-top " style="min-height: 150px;">
                <div class="col-3 padding-15 border-right d-flex flex-column">
                    <b class="mb-2">Client</b>
                    <p>{{ isset($property['client']) ? $property['client']['name'] : '' }}</p>
                </div>
                <div class="col-3 padding-15 border-right d-flex flex-column">
                    <b class="mb-2">Batch Ref</b>
                    <p>{{ isset($property->batch) ? $property->batch->our_ref : '' }}</p>
                </div>
                <div class="col-3 padding-15 border-right d-flex flex-column">
                    <span class="d-flex flex-sm-row flex-column"><b>Start Date:&nbsp;</b>
                        <p>{{ date('d/m/Y', strtotime($property['start_date'])) }}</p>
                    </span>
                    <span class="d-flex flex-sm-row flex-column"><b>End Date:&nbsp;</b>
                        <p>{{ date('d/m/Y', strtotime($property['end_date'])) }}</p>
                    </span>
                </div>
                <div class="col-3 padding-15 d-flex flex-column">
                    <b class="mb-2">Incomplete Post Work Log(s)</b>
                    <p> {{ $post_work_log_count }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <form method="POST"
                action="{{ route('property.changePropertyStatus', \Illuminate\Support\Facades\Crypt::encrypt($property->id)) }}">

                @csrf
                <input type="hidden" name="type" value="contractor_status">

                <label class="mb-1" for="status">Contractor Status</label>
                <select name="status" id="contractor_status" class="form-control"
                    onchange="if(confirm('Are you sure you want to change status?')) { this.form.submit(); } else { this.value = '{{ $property->contractor_status }}'; }">
                    @foreach ($contractor_status as $status)
                        <option
                            {{ (isset($property) ? ($property->contractor_status == $status ? 'selected' : '') : '') ?? (old(contractor_status) == $property->contractor_status ? 'selected' : '') }}
                            value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col">
            <form method="POST"
                action="{{ route('property.changePropertyStatus', \Illuminate\Support\Facades\Crypt::encrypt($property->id)) }}">
                @csrf
                <input type="hidden" name="type" value="hea_status">
                <label class="mb-1" for="status">HEA Status</label>

                <select name="status" id="hea_status" class="form-control"
                    onchange="if(confirm('Are you sure, you want to change status?')) { this.form.submit(); } else { this.value = '{{ $property->hea_status }}'; }">
                    @foreach ($hea_status as $status)
                        <option
                            {{ (isset($property) ? ($property->hea_status == $status ? 'selected' : '') : '') ?? (old(hea_status) == $property->hea_status ? 'selected' : '') }}
                            value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col">
            <form method="POST"
                action="{{ route('property.changePropertyStatus', \Illuminate\Support\Facades\Crypt::encrypt($property->id)) }}">

                @csrf
                <input type="hidden" name="type" value="property_status">
                <label class="mb-1" for="status">Property Status</label>

                <select name="status" id="property_status" class="form-control"
                    onchange="if(confirm('Are you sure you want to change status?')) { this.form.submit(); } else { this.value = '{{ $property->status }}'; }">
                    @foreach ($property_status as $key => $value)
                        <option {{ isset($property) ? ($property->status == $key ? 'selected' : '') : '' }}
                            value="{{ $key }}">
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col">
            <form method="POST"
                action="{{ route('property.changePropertyStatus', \Illuminate\Support\Facades\Crypt::encrypt($property->batch_id)) }}">

                @csrf
                <input type="hidden" name="type" value="batch_status">
                <label class="mb-1" for="status">Batch Status</label>

                <select name="status" id="batch_status" class="form-control"
                    onchange="if(confirm('Are you sure you want to change status?')) { this.form.submit(); } else { this.value = '{{ $property->batch->status }}'; }">
                    <option {{ isset($property) ? ($property->batch->status == 'pending' ? 'selected' : '') : '' }}
                        value="pending">
                        Pending
                    </option>
                    <option {{ isset($property) ? ($property->batch->status == 'completed' ? 'selected' : '') : '' }}
                        value="completed">
                        Completed
                    </option>


                </select>
            </form>
        </div>
    </div>
    <div class="col-md-12 w-100"></div>
    <div class="row mt-2">
        <div class="col-3 d-flex flex-column">
            <div class="filterSidebar mb-2 filterActive" data-atr="mea">Measures</div>
            <div class="filterSidebar mb-2" data-atr="safh">Health & Safety</div>
            {{-- <div class="filterSidebar mb-2" data-atr="rams">RAMS</div> --}}
            <div class="filterSidebar filterSidebars mb-2" data-atr="rem">Reminders</div>
            <div class="filterSidebar mb-2" data-atr="apmnt">Appointments</div>
            <div class="filterSidebar mb-2" data-atr="sur">Surveyors</div>
            <div class="filterSidebar mb-2" data-atr="ins">Inspections/Reports</div>
            <div class="filterSidebar mb-2" data-atr="timesheet">Timesheet</div>
            <div class="filterSidebar mb-2" data-atr="pho">Photo/Video Upload</div>
            <div class="filterSidebar mb-2" data-atr="threepdf">3rd Party Forms</div>
            <div class="filterSidebar mb-2" data-atr="her">HEA/BER Assessors</div>
            <div class="filterSidebar mb-2" data-atr="con">Contractors</div>
            <div class="filterSidebar mb-2" data-atr="con_l">Post Work Log(s)</div>
            <div class="filterSidebar mb-2" data-atr="snags">Snags</div>
            <div class="filterSidebar mb-2" data-atr="note">Notes</div>
            <div class="filterSidebar mb-2" data-atr="emailT">Email</div>
            <div class="sidebarNotePost" title="Please, go to Edit Property to add Pre-BER">
                <b>Pre BER</b>
                <p style="color: #808080;">{{ $property['pre_ber'] }}</p>
            </div>
            <div class="mt-2 mb-5 sidebarNotePost" title="Please, go to Edit Property to add Post-BER">
                <b>Post BER</b>
                <p style="color:#808080;">{{ $property['post_ber'] }}</p>
            </div>
        </div>
        <div class="col-9">
            <div class="col card _shadow-1 generalCols measureTarget">
                <h2>Measures</h2>
                {{-- <?php
                // Creating an array with the provided values
                $colors = ['#FAD480', '#F4A64E', '#B1D8B7', '#7BB7E0', '#FEC2C7', '#D2C7FF', '#85DBD9'];
                ?> --}}
                <div class="card _shadow-2 my-1">
                    <div class="d-flex flex-row flex-wrap pl-2 pt-1 pb-1 measureBox">
                        @if (sizeOf($property['measures']))
                            @foreach ($property['measures'] as $mkey => $measure)
                                {{-- @php
                                    $colors = ['#FAD480', '#F4A64E', '#B1D8B7', '#7BB7E0', '#FEC2C7', '#D2C7FF', '#85DBD9'];
                                    $colorIndex = $mkey % count($colors);
                                    $backgroundColor = $colors[$colorIndex];
                                @endphp --}}

                                <div class="{{ array_key_exists($measure['job_id'], $assigned_jobs) ? ($assigned_jobs[$measure['job_id']] == 'Complete' ? 'bg-success text-white' : 'bg-secondary text-white') : '' }} border rounded d-flex justify-content-between align-items-center py-1 pl-2 pr-1 mr-1 my-1 _shadow-2 unselectable"
                                    style="width: 200px; height: 38px;color:#333;font-weight:600; border-radius:6px !important;">
                                    <span>{{ $measure['job_lookup']['title'] ?? '' }}</span>
                                    <a class="pointer text-black pr-2 {{ array_key_exists($measure['job_id'], $assigned_jobs) ? ($assigned_jobs[$measure['job_id']] == 'Complete' ? 'text-white' : 'text-white') : 'text-black' }}"
                                        href="{{ route('property.deleteMeasure', $measure['id']) }}"
                                        onClick="return confirm(`Are you sure you want to delete this measure?`)"
                                        title="Delete measure">
                                        X
                                    </a>
                                </div>
                            @endforeach
                        @else
                        <span style="margin: 15px auto;">No measures added yet.</span>

                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <h4 class="text-black">Add Measure</h4>
                    {{-- <form action="{{ route('property.addMeasure') }}" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="property_id" value="{{ $property['id'] }}">
                            <div class="form-group col-md-5 col-sm-12 pe-md-0 mb-lg-0 mb-md-0 mb-2">
                                <select class="form-control" name="job_id" id="job_id" required>
                                    <option value="">Select Measure</option>
                                    @foreach ($contractor_jobs as $key => $_job)
                                        <option value="{{ $key }}">{{ $_job['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-12 pe-md-0 mb-lg-0 mb-md-0 mb-2">
                                <input type="number" class="form-control" name="quantity" placeholder="Quantity" value="1"
                                required>
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <button class="w-100 my-0 pointer _shadow-2 btn _btn-primary float-end mb-md-2 mb-2" style="width: fit-content;" type="submit">Add New Measure
                                    +</button>
                            </div>
                        </div>
                    </form> --}}
                    <form action="{{ route('property.addMeasure') }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property['id'] }}">
                        <div class="row align-items-center">
                            <div class="col-3">
                                <label for="job_id">Measure</label>
                                <select class="form-control my-1 mr-1" name="job_id" id="job_id">
                                    <option value="">Select Measure</option>
                                    @foreach ($contractor_jobs as $key => $_job)
                                    <option value="{{ $key }}">{{ $_job['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" col-3">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control my-1 mr-1" name="quantity"
                                    placeholder="Add Quantity" required="">
                            </div>

                            <div class="form-group col-3">
                                <label for="start_date">Start Date</label>
                                <input type="date" id="start_date" min="{{ date('Y-m-d') }}" name="start_date"
                                    class="form-control">
                            </div>
                            <div class="form-group col-3">
                                <label for="end_date">End Date</label>
                                <input type="date" id="end_date" min="{{ date('Y-m-d') }}" name="end_date"
                                    class="form-control">
                            </div>
                            <div class="form-group col-3">
                                <label for="qua_details">Quantity Details</label>
                                <input type="text" id="qua_details" name="qua_details" class="form-control"
                                    placeholder="Add Quantity Details...">
                            </div>
                            <div class="form-group col-3">
                                <label for="our_price">Our Price</label>
                                <input type="number" id="our_price" name="our_price" step="0.1" class="form-control"
                                    placeholder="Add Price...">
                            </div>
                            <div class="form-group col-3 mt-3">
                                <button class="mb-0 pointer _shadow-2 btn _btn-primary" type="submit">Add New
                                    Measure</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="p-0" id="property-contractors-units">
                    <form action="{{ route('property.updateContractorPropertyUnits') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Survey Qty</th>
                                        <th>Survey Qty Including Variation</th>
                                        <th>Survey Qty Including Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contractors as $i => $contractor)
                                        <tr>
                                            <td>{{ $contractor['job_lookup']['title'] ?? '' }}</td>
                                            <td>
                                                <input type="hidden"
                                                    name="data[{{ $i }}][contractor_property_id]"
                                                    value="{{ $contractor['id'] }}">
                                                <input type="number" step=".01" class="form-control"
                                                    name="data[{{ $i }}][units]"
                                                    value="{{ old("data.$i.units") ?? $contractor['units'] }}" />
                                            </td>
                                            <td>
                                                <input type="number" step=".01" class="form-control"
                                                    name="data[{{ $i }}][survey_qty_inc_variation]"
                                                    value="{{ old("data.$i.survey_qty_inc_variation") ?? $contractor['survey_qty_inc_variation'] }}" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="data[{{ $i }}][contractor_notes]"
                                                    value="{{ old(" data.$i.contractor_notes") ??
                                                    $contractor['contractor_notes'] }}" />
                                            </td>
                                            <td>
                                                <a onclick="return confirm(`Are you sure you want to delete?`)"
                                                                class="btn-sm _btn-dangers ml-1 my-2"
                                                                href="{{ route('property.deleteMeasures', [$contractor['id']]) }}">DELETE</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn _btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col card _shadow-1 generalCols safhTarget d-none">
                <h2>Health & Safety</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-2 mb-2 porelative">
                            <div
                                class="card-header mb-2 _shadow-1 d-flex justify-content-between align-items-center propcsv11">
                                <h4 class="my-0">Health & Safety</h4>

                                <svg class="propcsv111" width="15" height="9" viewBox="0 0 15 9" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0.293016 2.20711L6.65698 8.57107C7.0475 8.96159 7.68067 8.96159 8.07119 8.57107L14.4352 2.2071C14.8257 1.81658 14.8257 1.18342 14.4352 0.792892C14.0446 0.402368 13.4115 0.402368 13.0209 0.792892L8.36408 5.44975L7.36414 6.36426L6.36408 5.44975L1.70723 0.792893C1.3167 0.402369 0.68354 0.402369 0.293015 0.792893C-0.097509 1.18342 -0.0975089 1.81658 0.293016 2.20711Z"
                                        fill="black" />
                                </svg>

                            </div>
                            <div class="card-body mybody propcart11">
                                <table class="table dt-responsive w-100" id="property_inspection_table2">
                                    <thead>
                                        <th>Type</th>
                                        <th style="width: 55px">Date</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>

                                        @foreach ($inspections as $inspection)
                                            @if ($inspection->fk_forms_id == 55 || $inspection->fk_forms_id == 57)
                                                <tr>
                                                    <td>{{ isset($inspection['form']) ? $inspection['form']['name'] : '' }}
                                                    </td>
                                                    <td>{{ date('d/m/Y', strtotime($inspection['date_inspected'])) }}</td>
                                                    <td>{{ $inspection['name'] }}</td>
                                                    <td class="width-content">
                                                        <div>
                                                            <a class="btn-sm _btn-primary ml-1 my-2"
                                                                href="{{ route('property.new_report', [$inspection['id'], 'view']) }}">VIEW</a>
                                                            <a class="btn-sm _btn-primary ml-1 my-2" target="_blank"
                                                                href="{{ route('property.new_report', [$inspection['id'], 'print']) }}">PRINT</a>
                                                                @if(isset($inspection->property->client))
                                                                <a class="btn-sm _btn-primary ml-1 my-2"
                                                                onclick="return confirm(`Are you sure you want to send this form to {{ $inspection->property->client->email }}`)"
                                                                href="{{ route('property.sendPdfClient', [$inspection['id']]) }}">SEND</a>
                                                                @endif
                                                            <a class="btn-sm _btn-primary ml-1 my-2" target="_blank"
                                                                href="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_pdf' . $inspection['pdf_filename']) }}">PDF</a>
                                                            <a onclick="return confirm(`Are you sure you want to delete?`)"
                                                                class="btn-sm _btn-dangers ml-1 my-2"
                                                                href="{{ route('property.new_report', [$inspection['id'], 'delete']) }}">DELETE</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-2 mb-2 porelative">
                            <div
                                class="card-header mb-2 _shadow-1 d-flex justify-content-between align-items-center propcsv12">
                                <h4 class="my-0">RAMS</h4>

                                <svg class="propcsv112" width="15" height="9" viewBox="0 0 15 9" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0.293016 2.20711L6.65698 8.57107C7.0475 8.96159 7.68067 8.96159 8.07119 8.57107L14.4352 2.2071C14.8257 1.81658 14.8257 1.18342 14.4352 0.792892C14.0446 0.402368 13.4115 0.402368 13.0209 0.792892L8.36408 5.44975L7.36414 6.36426L6.36408 5.44975L1.70723 0.792893C1.3167 0.402369 0.68354 0.402369 0.293015 0.792893C-0.097509 1.18342 -0.0975089 1.81658 0.293016 2.20711Z"
                                        fill="black" />
                                </svg>

                            </div>
                            <div class="card-body mybody propcart12 d-none">
                                <table class="table dt-responsive w-100" id="property_inspection_table3">
                                    <thead>
                                        <th>Type</th>
                                        <th style="width: 55px">Date</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($inspections as $inspection)
                                            @if (
                                                $inspection->fk_forms_id == 56 ||
                                                    $inspection->fk_forms_id == 58 ||
                                                    $inspection->fk_forms_id == 59 ||
                                                    $inspection->fk_forms_id == 60)
                                                <tr>
                                                    <td>{{ isset($inspection['form']) ? $inspection['form']['name'] : '' }}
                                                    </td>
                                                    <td>{{ date('d/m/Y', strtotime($inspection['date_inspected'])) }}</td>
                                                    <td>{{ $inspection['name'] }}</td>
                                                    <td class="width-content">
                                                        <div>
                                                            <a class="btn-sm _btn-primary ml-1 my-2"
                                                                href="{{ route('property.new_report', [$inspection['id'], 'view']) }}">VIEW</a>
                                                            <a class="btn-sm _btn-primary ml-1 my-2" target="_blank"
                                                                href="{{ route('property.new_report', [$inspection['id'], 'print']) }}">PRINT</a>
                                                                <a class="btn-sm _btn-primary ml-1 my-2"
                                                                onclick="return confirm(`Are you sure you want to send this form to {{ $inspection->property->client->email }}`)"
                                                                href="{{ route('property.sendPdfClient', [$inspection['id']]) }}">SEND</a>
                                                            <a class="btn-sm _btn-primary ml-1 my-2" target="_blank"
                                                                href="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_pdf' . $inspection['pdf_filename']) }}">PDF</a>
                                                            <a onclick="return confirm(`Are you sure you want to delete?`)"
                                                                class="btn-sm _btn-dangers ml-1 my-2"
                                                                href="{{ route('property.new_report', [$inspection['id'], 'delete']) }}">DELETE</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-2 mb-2 porelative">
                            <div
                                class="card-header mb-2 _shadow-1 d-flex justify-content-between align-items-center toolboxdiv">
                                <h4 class="my-0">Toolbox Talk</h4>

                                <svg class="toolboxdiv1" width="15" height="9" viewBox="0 0 15 9" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0.293016 2.20711L6.65698 8.57107C7.0475 8.96159 7.68067 8.96159 8.07119 8.57107L14.4352 2.2071C14.8257 1.81658 14.8257 1.18342 14.4352 0.792892C14.0446 0.402368 13.4115 0.402368 13.0209 0.792892L8.36408 5.44975L7.36414 6.36426L6.36408 5.44975L1.70723 0.792893C1.3167 0.402369 0.68354 0.402369 0.293015 0.792893C-0.097509 1.18342 -0.0975089 1.81658 0.293016 2.20711Z"
                                        fill="black" />
                                </svg>

                            </div>
                            <div class="card-body mybody toolboxdiv11 d-none">
                                <table class="table dt-responsive w-100" id="property_inspection_table4">
                                    <thead>
                                        <th>Type</th>
                                        <th style="width: 55px">Date</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($inspections as $inspection)
                                            @if ($inspection->fk_forms_id == 61)
                                                <tr>
                                                    <td>{{ isset($inspection['form']) ? $inspection['form']['name'] : '' }}
                                                    </td>
                                                    <td>{{ date('d/m/Y', strtotime($inspection['date_inspected'])) }}</td>
                                                    <td>{{ $inspection['name'] }}</td>
                                                    <td class="width-content">
                                                        <div>
                                                            <a class="btn-sm _btn-primary ml-1 my-2"
                                                                href="{{ route('property.new_report', [$inspection['id'], 'view']) }}">VIEW</a>
                                                            <a class="btn-sm _btn-primary ml-1 my-2" target="_blank"
                                                                href="{{ route('property.new_report', [$inspection['id'], 'print']) }}">PRINT</a>
                                                                <a class="btn-sm _btn-primary ml-1 my-2"
                                                                onclick="return confirm(`Are you sure you want to send this form to {{ $inspection->property->client->email }}`)"
                                                                href="{{ route('property.sendPdfClient', [$inspection['id']]) }}">SEND</a>
                                                            <a class="btn-sm _btn-primary ml-1 my-2" target="_blank"
                                                                href="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_pdf' . $inspection['pdf_filename']) }}">PDF</a>
                                                            <a onclick="return confirm(`Are you sure you want to delete?`)"
                                                                class="btn-sm _btn-dangers ml-1 my-2"
                                                                href="{{ route('property.new_report', [$inspection['id'], 'delete']) }}">DELETE</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col card _shadow-1 generalCols ReminderTarget d-none">
                <h2>Reminders</h2>
                    @if (sizeOf($reminders))
                    <div class="card my-1 row pl-2 pt-2 pb-1" id="reminderBoxss"
                        style="border: unset !important; border-top:1px solid #E2E8ED !important;box-shadow: unset !important;border-radius: unset !important;">
                        @foreach ($reminders as $reminder)
                            <div class="mb-2 col-sm-12 col-lg-4 col-md-6 reminderBoxs" role="alert">

                                <div class="d-flex justify-content-between align-items-center py-0">
                                    <a aria-hidden="true" class="text-blues"
                                        href="{{ route('property.deleteReminder', $reminder['id']) }}"
                                        onClick="return confirm(`Are you sure you want to delete?`)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </div>
                                <div class=" mt-1 d-flex flex-column">
                                    <h5 class="mb-2 alert-heading my-0 py-0" style="width: 93%;">{{ $reminder['title'] }}</h5>
                                    <p class="mb-0 alert-heading my-0 py-0">{{ $reminder['notes'] }}</p>
                                </div>
                                <div class=" mt-1 d-flex justify-content-between align-items-end">
                                    <span>Due:
                                        {{ date('d/m/Y', strtotime($reminder['due_date'])) . ' ' . date('h:i A', strtotime($reminder['due_time'])) }}</span>
                                    <span
                                        class="clickStatusChange @if ($reminder['status'] == 'Complete') compl @else inprog @endif"
                                        data-id="{{ $reminder['id'] }}" data-status="{{ $reminder['status'] }}"
                                        style="padding: 3px 13px;" data-toggle="modal" data-target="#changeRemModal">
                                        @if ($reminder['status'] == 'Complete')
                                            Complete
                                        @else
                                            Pending
                                        @endif
                                    </span>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    @else
                    <div class="card _shadow-2 my-1 measureBox mb-3">
                        <span style="margin: 15px auto;">No reminders added yet.</span>
                    </div>
                    @endif
                <hr class="mt-0">
                <h5 class="mt-0">Add Reminders</h5>
                <div class="row ">
                    <form id="third-party-formss" method="POST" enctype="multipart/form-data"
                        action="{{ route('property.createReminder') }}">
                        @csrf

                        <input type="hidden" name="property_id" id="reminder_property_id" value="{{ $property->id }}">
                        <div class="row">
                            <div class="d-flex flex-sm-row flex-column">
                                <div class="col"><input type="text" class="my-1 form-control" name="title"
                                        id="title" placeholder="Title" required></div>
                                <div class="col px-lg-2 px-md-2 ">
                                    <select name="status" id="reminder_status" class="form-control my-1">
                                        <option value="">Select status</option>
                                        <option value="Pending" selected>Pending</option>
                                        <option value="Complete">Complete</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="when_time" id="when_time" class="form-control my-1">
                                        <option value="">Select remind me time</option>
                                        {{-- <option value="atoe">At time of event</option>
                                        <option value="5mb">5 minutes before</option>
                                        <option value="10mb">10 minutes before</option>
                                        <option value="15mb">15 minutes before</option>
                                        <option value="1hb">1 hour before</option> --}}
                                        <option value="2hb">2 hours before</option>
                                        <option value="1db">1 day before</option>
                                        <option value="2db">2 days before</option>
                                        <option value="1wb">1 week before</option>
                                        <option value="2wb">2 weeks before</option>
                                        <option value="3wb">3 weeks before</option>
                                        <option value="1mb">1 month before</option>
                                        <option value="2mb">2 months before</option>
                                    </select>
                                    <div class="rem-txt">
                                        *In order to get a Notification, please select remind me time
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex flex-sm-row flex-column">
                                <div class="col">
                                    <textarea class="my-1 form-control" name="notes" id="notes" cols="30" rows="1"
                                        placeholder="Notes"></textarea>
                                </div>
                                <div class="col px-lg-2 px-md-2">
                                    <input type="date" class="my-1 form-control" name="due_date"
                                        placeholder="Due date" required>
                                </div>
                                <div class="col">
                                    <input type="time" class="my-1 form-control" name="due_time"
                                        placeholder="Due time">
                                </div>
                                <div class="col ps-md-2 ps-sm-0">
                                    <button class="mt-1 w-100 btn btn-sm _btn-primary float-end" id="add-surveyor-button"
                                        type="submit">Add Reminder
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col card _shadow-1 generalCols SurveyourTarget d-none">
                <h2>Surveyors</h2>
                <div class="card _shadow-2 my-1">
                    <div class="d-flex flex-row flex-wrap pl-2 pt-1 pb-1">
                        <div id="survery-list-container">
                            <ul id="survery-list" class="px-1 list-unstyled d-flex flex-wrap">

                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <h5 class="mt-0">Add Surveyors</h5>
                <div class="row ">
                    <form id="add-surveyor-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 pe-lg-0 pe-md-0">
                                <select name="surveyor" id="surveyors-dropdown" class="form-control mt-1" required>
                                    @foreach ($surveyors as $surveyor)
                                        <option value="{{ $surveyor['user_id'] }}" class="input-sm form-control">
                                            {{ $surveyor['full_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 pe-lg-0 pe-md-0">
                                <input type="date" value="<?= date('Y-m-d') ?>" class="form-control mt-1"
                                    id="survery-date-picker" required />
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-sm _btn-primary w-100 mt-1" id="add-surveyor-button"
                                    type="submit">Add Surveyor
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col card _shadow-1 generalCols timesheetTarget d-none">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 style="color: #1A47A3;">Timesheet</h2>
                    <a href="{{ route('property.exportInspectionReport', \Illuminate\Support\Facades\Crypt::encrypt($property->id)) }}"
                        class="btn btn-sm _btn-primary float-end">Export All Documents</a>
                </div>
                <div class="mybody mt-2">
                    <table class="table dt-responsive w-100" id="timesheet_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Sigin Status</th>
                                <th>Signout Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeOf($property->user_signin_out))
                            @foreach ($property->user_signin_out as $usr_signinout)
                            <tr>
                                <td>{{ $usr_signinout->users ? $usr_signinout->users->full_name : "N/A"}}</td>
                                <td>@if($usr_signinout->sign_tt == null) N/A @else {{ date('d/m/Y | h:i A',strtotime($usr_signinout->sign_tt)) }} @endif</td>
                                <td>@if($usr_signinout->sign_e_tt == null) N/A @else {{ date('d/m/Y | h:i A',strtotime($usr_signinout->sign_e_tt)) }} @endif</td>
                                <td>
                                    <a title="View Timesheet" class="btn btn-outline-sm _btn-primary px-2 action-icon rounded viewTimeSheet" data-collection="{{ json_encode($usr_signinout) }}" ><i class="text-white mdi mdi-eye"></i></a>
                                    <a href="{{ route('signinout.deletesheet', Crypt::encrypt($usr_signinout->id)) }}" class="btn btn-outline-sm btn-danger  px-2 action-icon rounded" title="Delete Timesheet"> <i class="text-white mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col card _shadow-1 generalCols timesheetChildTarget d-none">
                <a href="javascript:void(0);" class="closeTimesheet">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="mdi mdi-menu cliclef mr-3">
                        <rect width="32" height="32" rx="16" fill="#E2E8ED" />
                        <path
                            d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
                            fill="black" />
                    </svg>
                    <span id="sheetName">Jon Lomex- Timesheet</span>
                </a>
                <div class="mybody mt-2" id="timesheetDataView">
                    <div class="p-2 card">
                        <h4 style="color: #1A47A3;">Signed In</h4>
                        <div class="row mb-2">
                            <div class="col"><div class="form-group"><label for="date">Date</label><input type="text" id="Indate" name="Indate" class="form-control" value="" readonly></div></div>
                            <div class="col"><div class="form-group"><label for="time">Time</label><input type="text" id="Intime" name="Intime" class="form-control" value="" readonly></div></div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                            <label for="details">Aditional Details</label>
                            <input type="text" class="form-control" id="InDetails" name="InDetails" value="" readonly>
                            </div>
                        </div>
                        <h5 style="color: #1A47A3;">Photo</h5>
                        <div class="row mb-2 bg-grasy m-0">
                            <div id="singInImgs">

                            </div>
                        </div>
                        <h5 style="color: #1A47A3;">Signature</h5>
                        <div class="row mb-2 bg-grasy m-0">
                            <img id="signInSign" src="" style="width: 35%;height:100px;">
                        </div>
                    </div>
                    <div class="p-2 card">
                        <h4 style="color: #1A47A3;">Signed Out</h4>
                        <div class="row mb-2">
                            <div class="col"><div class="form-group"><label for="date">Date</label><input type="text" id="Outdate" name="Outdate" class="form-control" value="2024-04-01" readonly></div></div>
                            <div class="col"><div class="form-group"><label for="time">Time</label><input type="text" id="Outtime" name="Outtime" class="form-control" value="04:15 AM" readonly></div></div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                            <label for="details">Aditional Details</label>
                            <input type="text" class="form-control" id="OutDetails" name="OutDetails" value="" readonly>
                            </div>
                        </div>
                        <h5 style="color: #1A47A3;">Photo</h5>
                        <div class="row mb-2 bg-grasy m-0">
                            <div class="my-1" id="singOutImgs">

                            </div>
                        </div>
                        <h5 style="color: #1A47A3;">Signature</h5>
                        <div class="row mb-2 bg-grasy m-0">
                            <img id="signoutSign" src="" style="width: 35%;height:100px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col card _shadow-1 generalCols insReportTarget d-none">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 style="color: #1A47A3;">Inspections / Reports</h2>
                    <a href="{{ route('property.exportInspectionReport', \Illuminate\Support\Facades\Crypt::encrypt($property->id)) }}"
                        class="btn btn-sm _btn-primary float-end">Export All Documents</a>
                </div>
                <div class="mybody mt-2">
                    <table class="table dt-responsive w-100" id="property_inspection_table">
                        <thead>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($inspections as $inspection)
                                @if (
                                    $inspection->fk_forms_id != 55 &&
                                        $inspection->fk_forms_id != 56 &&
                                        $inspection->fk_forms_id != 58 &&
                                        $inspection->fk_forms_id != 59 &&
                                        $inspection->fk_forms_id != 60 &&
                                        $inspection->fk_forms_id != 61 &&
                                        $inspection->fk_forms_id != 57)
                                    @if ($inspection->fk_forms_id == 14)
                                        @php

                                            $dataBS = \App\Models\Inspection::where('id', $inspection['id'])
                                                ->with([
                                                    'sir_base_coat_complete',
                                                    'sir_boarding_complete',
                                                    'sir_drawings_photographs',
                                                    'sir_finish_coat_complete',
                                                    'sir_job_complete',
                                                    'sir_preparation_complete',
                                                ])
                                                ->first();
                                            if ($dataBS) {
                                                $dataArray = $dataBS->toArray();
                                            }
                                            if (!function_exists('filterSirKeys')) {
                                                function filterSirKeys($value, $key)
                                                {
                                                    return strpos($key, 'sir_') === 0 && $value !== null;
                                                }
                                            }
                                            $filteredArray = array_filter(
                                                $dataArray,
                                                'filterSirKeys',
                                                ARRAY_FILTER_USE_BOTH,
                                            );
                                            $filteredKeys = array_keys($filteredArray);
                                            foreach ($filteredArray as $ks => $fa) {
                                                $stag = $ks;
                                            }
                                        @endphp
                                    @else
                                        @php
                                            $stag = null;
                                        @endphp
                                    @endif
                                    @php
                                        if($inspection->fk_forms_id == 25){
                                                $dataChecked = \App\Models\Inspection::where('id', $inspection->id)
                                                        ->with('property.client')
                                                        ->with('bre_photo_inspection_items.bre_question')
                                                        ->with('bre_photo_inspection_items.bre_item')
                                                        ->with('bre_photo_inspection_items.bre_area')
                                                        ->with('bre_snag')
                                                        ->first();

                                                        if(sizeOf($dataChecked['bre_snag'])){
                                                        $angArr = $dataChecked['bre_snag']->toArray();
                                                        $totalsnag = sizeOf($angArr);
                                                        // dd($angArr);
                                                        $reported = array_filter($angArr, function($item){
                                                            return $item['status'] == "Open";
                                                        });
                                                        $closed = array_filter($angArr, function($item){
                                                            return $item['status'] == "Closed" && $item['is_letest'] == 1;
                                                        });
                                                        $mainInsp = array_unique(array_column($angArr, 'fk_main_inspection_id'));
                                                        if(sizeOf($mainInsp)){
                                                            $inspI = $mainInsp[0];
                                                        }else{
                                                            $inspI = $inspection->id;
                                                        }
                                                        // dd($closed,$totalsnag);
                                                        if(sizeOf($closed) && sizeOf($closed) < $totalsnag){
                                                            $closed2 = array_filter($angArr, function($item){
                                                            return $item['status'] == "Closed";
                                                            });
                                                            if(sizeOf($closed2) && sizeOf($closed2) == $totalsnag){
                                                            $txt = "(Snag Resolved) (# ".$inspI.")";
                                                        }else{
                                                            $grup = implode('/',array_unique(array_column($closed, 'fk_type')));
                                                            $txt = "(Snag Resolved: ".$grup.") (# ".$inspI.")";
                                                        }
                                                        }else if(sizeOf($closed) && sizeOf($closed) == $totalsnag){
                                                            $txt = "(Snag Resolved) (# ".$inspI.")";
                                                        }else{
                                                            $txt = "(Snag Recorded) (# ".$inspI.")";
                                                        }
                                                    }else{
                                                        $txt = "(No Snag Recorded) (# ".$inspection->id.")";
                                                    }
                                            }
                                    @endphp
                                    <tr>
                                        <td>{{ isset($inspection['form']) ? $inspection['form']['name'] : '' }}
                                            @if (isset($stag) && $stag != null)
                                                @if ($stag == 'sir_preparation_complete')
                                                    (Preparation Complete)
                                                @endif
                                                @if ($stag == 'sir_boarding_complete')
                                                    (Bording / Stress Patches Complete)
                                                @endif
                                                @if ($stag == 'sir_base_coat_complete')
                                                    (Base Coat Complete)
                                                @endif
                                                @if ($stag == 'sir_finish_coat_complete')
                                                    (Finish Coat Complete)
                                                @endif
                                                @if ($stag == 'sir_job_complete')
                                                    (Job Complete)
                                                @endif
                                                @if ($stag == 'sir_drawings_photographs')
                                                    (Drawings & Photographs)
                                                @endif
                                            @endif
                                            @if($inspection->fk_forms_id == 25)
                                            {{ $txt }}
                                            @endif
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($inspection['date_inspected'])) }}</td>
                                        <td>{{ date('h:i A', strtotime($inspection['created_date'])) }}</td>
                                        <td>{{ $inspection['name'] }}</td>
                                        <td class="width-content">
                                            <div>
                                                <a class="btn-sm _btn-primary ml-1 my-2"
                                                    href="{{ route('property.new_report', [$inspection['id'], 'view']) }}">VIEW</a>
                                                <a class="btn-sm _btn-primary ml-1 my-2" target="_blank"
                                                    href="{{ route('property.new_report', [$inspection['id'], 'print']) }}">PRINT</a>
                                                <a class="btn-sm _btn-primary ml-1 my-2"
                                                onclick="return confirm(`Are you sure you want to send this form to {{ $inspection->property->client->email }}`)"
                                                href="{{ route('property.sendPdfClient', [$inspection['id']]) }}">SEND</a>
                                                <a class="btn-sm _btn-primary ml-1 my-2" target="_blank"
                                                    href="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_pdf' . $inspection['pdf_filename']) }}">PDF</a>
                                                <a onclick="return confirm(`Are you sure you want to delete?`)"
                                                    class="btn-sm _btn-dangers ml-1 my-2"
                                                    href="{{ route('property.new_report', [$inspection['id'], 'delete']) }}">DELETE</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col card _shadow-1 generalCols phoReportTarget d-none">
                <h2>Photo/Video Upload</h2>
                <hr>
                <div class="msg-show mb-1"></div>
                <div class="row d-flex justify-content-end photo-row">
                    <div class="col-md-4 col-sm-12 photo-header d-none d-flex flex-wrap mb-3 align-items-center">
                        <svg class="all-folders" width="32" height="32" viewBox="0 0 32 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="mdi mdi-menu cliclef mr-3">
                            <rect width="32" height="32" rx="16" fill="#E2E8ED"></rect>
                            <path
                                d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
                                fill="black"></path>
                        </svg>
                        <div class="ms-2 folder-name">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 photo-btn d-block mb-3 d-flex flex-wrap justify-content-end">
                        <button class="btn _btn-primary m-1 multiple-ubtn" data-pro_id="{{ $property->id }}"
                            data-bs-toggle="modal" data-bs-target="#singleModal">Single Photo/Video Upload
                        </button>
                        <button class="btn _btn-primary multiple-ubtn m-1" data-pro_id="{{ $property->id }}"
                            data-bs-toggle="modal" data-bs-target="#batchModal">Batch
                            Upload
                        </button>
                        <a href="{{ url('dashboard/property/photo/download-all', $property->id) }}"><button
                                class="btn _btn-primary sing-img signle-ubtn d-flex align-items-center m-1"
                                data-pro_id="{{ $property->id }}">
                                <svg class="download-svg me-1" xmlns="http://www.w3.org/2000/svg" width="15"
                                    height="15" viewBox="0 0 20 20" fill="none">
                                    <g clip-path="url(#clip0_1326_1880)">
                                        <path
                                            d="M1.38815 14.9729C1.42876 14.9105 1.47049 14.8488 1.51055 14.7859C2.04243 13.9514 2.5259 13.0762 3.11509 12.2823C4.84648 9.9456 8.28923 9.79371 10.2476 11.9418C10.8507 12.6028 11.411 13.3027 11.9912 13.9842C12.0224 14.0209 12.0552 14.0565 12.1025 14.1088C12.9076 12.9839 14.0008 12.3947 15.3745 12.3947C16.7481 12.3947 17.8402 12.9917 18.6653 14.1617V13.8896C18.6653 12.6056 18.6653 11.3215 18.6653 10.0374C18.6653 9.51998 19.1393 9.18617 19.5894 9.3859C19.8721 9.51053 19.9989 9.74253 19.9984 10.0535C19.9984 11.1779 20.0017 12.3023 19.9984 13.4267C19.995 14.0387 20.0106 14.6507 19.9566 15.2572C19.7536 17.5388 17.902 19.5211 15.6365 19.9016C15.3013 19.9581 14.9622 19.9875 14.6223 19.9895C11.54 19.9959 8.45762 19.9959 5.37502 19.9895C2.78684 19.9857 0.645967 18.2515 0.114644 15.7234C0.0405669 15.3633 0.00328468 14.9966 0.00337179 14.629C-0.00478814 11.5401 -0.00608672 8.45122 -0.000523132 5.36231C0.00392774 2.6712 1.90167 0.466353 4.56162 0.0540912C4.81579 0.0163525 5.07244 -0.00224513 5.3294 -0.00154466C7.47472 -0.00599553 9.61985 -0.00599553 11.7648 -0.00154466C12.2917 -0.00154466 12.6277 0.443542 12.4536 0.899756C12.3506 1.17015 12.107 1.32982 11.782 1.32982C10.4212 1.32982 9.06053 1.32982 7.70004 1.32982C6.92114 1.32982 6.14224 1.32982 5.36723 1.32982C3.10285 1.33761 1.33752 3.09682 1.33474 5.3573C1.33029 8.45326 1.33029 11.5492 1.33474 14.6452V14.9517L1.38815 14.9729Z"
                                            fill="#1A47A3"></path>
                                        <path
                                            d="M15.663 6.25213V3.97106C15.663 2.87392 15.663 1.77734 15.663 0.680197C15.6607 0.593218 15.6757 0.506644 15.707 0.425458C15.7383 0.344273 15.7853 0.27008 15.8454 0.207149C15.9055 0.144219 15.9774 0.0937934 16.0571 0.0587756C16.1367 0.0237577 16.2225 0.00483793 16.3095 0.00310738C16.6806 -0.00523801 16.9771 0.281287 16.9933 0.670738C16.996 0.733051 16.9933 0.795919 16.9933 0.858231V6.20317L17.0439 6.23544C17.0834 6.17981 17.1184 6.12417 17.1624 6.07521C17.7143 5.46062 18.2673 4.84695 18.8215 4.23422C19.0106 4.02614 19.2471 3.95214 19.5203 4.03615C19.7845 4.11794 19.9653 4.30488 19.9715 4.57416C19.9765 4.75219 19.9236 4.97696 19.8112 5.10659C19.1397 5.88549 18.4582 6.65382 17.7527 7.39823C17.5707 7.59362 17.3505 7.7495 17.1058 7.85618C16.861 7.96287 16.597 8.01808 16.33 8.0184C16.063 8.01871 15.7988 7.96411 15.5538 7.858C15.3088 7.75189 15.0882 7.59653 14.9058 7.40157C14.1914 6.65438 13.5116 5.87381 12.825 5.10047C12.7666 5.03542 12.7218 4.95926 12.6934 4.87652C12.665 4.79379 12.6536 4.70619 12.6599 4.61895C12.6661 4.5317 12.6898 4.44661 12.7297 4.36875C12.7695 4.29089 12.8247 4.22187 12.8918 4.16579C12.9567 4.1075 13.0327 4.06281 13.1151 4.03433C13.1976 4.00586 13.2849 3.99418 13.372 3.99999C13.459 4.00579 13.5441 4.02897 13.622 4.06815C13.7 4.10732 13.7693 4.16171 13.8259 4.2281C14.3823 4.83676 14.9336 5.45209 15.4866 6.06742C15.5317 6.11304 15.5818 6.16367 15.663 6.25213Z"
                                            fill="#1A47A3"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1326_1880">
                                            <rect width="20" height="19.9955" fill="white"
                                                transform="translate(-0.00195312 0.000976562)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                Download All Folders
                            </button>
                        </a>
                    </div>
                </div>
                <div class="folder-photos d-none">
                    <section class="img-gallery-magnific">
                    </section>
                    <div class="clear"></div>
                </div>
                @if (sizeOf($getfolders))
                <div class="photo-folders d-flex flex-wrap">
                        @foreach ($getfolders as $folders)
                            <div class="file me-1 mb-1" data-pro_id="{{ $property->id }}"
                                data-sec_id="{{ $folders->fk_section_id }}">
                                <div class="file-icon d-flex justify-content-center">
                                    <svg width="80" height="80" viewBox="0 0 96 96" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1109_15687)">
                                            <path
                                                d="M79.9143 36.7151C82.3512 36.7151 84.7872 36.719 87.2225 36.7268C90.0415 36.7268 91.7964 38.9961 91.0164 41.7118C89.2922 47.7256 87.5326 53.7113 85.7849 59.7064C84.1545 65.3115 82.496 70.9096 80.8939 76.5217C80.1187 79.228 78.5447 81.072 75.7257 81.6899C75.3525 81.7662 74.972 81.8016 74.5911 81.7956C54.1612 81.7956 33.7312 81.7956 13.3013 81.7956C13.0077 81.7956 12.714 81.7768 12.4204 81.7651C12.3828 81.2788 12.7916 81.2012 13.0969 81.0861C15.2793 80.2592 16.5173 78.6501 17.1563 76.4465C20.4733 64.9756 23.8538 53.5257 27.1591 42.0524C27.885 39.5317 29.2028 37.589 31.7564 36.6704C32.4454 36.4159 33.1737 36.2839 33.9082 36.2805C48.7549 36.2711 63.6017 36.2711 78.4484 36.2805C78.9699 36.2969 79.5079 36.2781 79.9143 36.7151Z"
                                                fill="#3F69BD" />
                                            <path
                                                d="M79.9175 36.7157L34.6631 36.7274C30.9279 36.7274 28.7315 38.3366 27.6814 41.9238C25.0284 50.9915 22.3879 60.0625 19.76 69.1365C19.0294 71.6431 18.2565 74.1379 17.5706 76.6538C16.8282 79.3718 15.104 81.0444 12.4165 81.7797C10.3399 81.9677 8.44643 81.5448 6.87249 80.086C6.21214 79.4991 5.68576 78.777 5.32907 77.9688C4.97238 77.1606 4.79371 76.2851 4.80521 75.4017C4.80521 56.8809 4.80521 38.3608 4.80521 19.8416C4.80521 16.5739 7.22956 14.2036 10.516 14.1848C17.5635 14.1676 24.6071 14.1676 31.6468 14.1848C32.7974 14.1641 33.937 14.4114 34.9755 14.9072C36.0139 15.403 36.9228 16.1337 37.6301 17.0414C38.7084 18.3593 39.8055 19.6607 40.8508 21.0044C42.2063 22.7499 43.9188 23.5885 46.1646 23.565C55.3804 23.518 64.5962 23.5415 73.812 23.5486C76.8659 23.5486 79.0953 25.193 79.7577 27.918C79.8698 28.4942 79.9132 29.0817 79.8869 29.6682C79.9042 32.0205 79.9143 34.3696 79.9175 36.7157Z"
                                                fill="#1A47A3" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1109_15687">
                                                <rect width="86.4" height="67.6466" fill="white"
                                                    transform="translate(4.80078 14.1758)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="file-txt d-flex justify-content-center">
                                    <span class="text-center folder-txt">{{ $folders->fk_section_name }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                    <div class="card _shadow-2 my-1 measureBox mb-3">
                        <span style="margin: 15px auto;">No photo/video added yet.</span>
                    </div>
                    @endif
            </div>
            <div class="col card _shadow-1 generalCols threepdfTarget d-none">
                <h2>3rd Party Forms</h2>
                <div class="mybody mb-1">
                    <table class="table dt-responsive w-100" id="third_party_form_table">
                        <thead>
                            <th>Document Link</th>
                            <th>Type</th>
                            <th>Date Added</th>
                            <th>Supplied By</th>
                            <th>Archived</th>
                        </thead>
                        <tbody>
                            @if(sizeOf($third_party_forms))
                            @foreach ($third_party_forms as $form)
                                <tr>
                                    <td>
                                        <a target="_blank"
                                            href="/files/{{ $form['file_path'] }}">{{ $form['file_path'] }}</a>

                                        @if ($form['archived'] == 1)
                                            <span class="text-danger"> (ARCHIVED)</span>
                                        @endif
                                    </td>
                                    <td>{{ $form['type'] }}</td>
                                    <td>{{ date('d/m/Y', strtotime($form['created_at'])) }}</td>
                                    <td>{{ $form['supplied_by'] }}</td>
                                    <td>

                                        <a href="{{ route('property.changeThirdPartyStatus', [$form['id'], $form['archived'] == 0 ? 'Archive' : 'Active']) }}"
                                            title="{{ $form['archived'] == 0 ? 'Archive document' : 'Activate document' }}">
                                            <i
                                                class="dripicons-{{ $form['archived'] == 0 ? 'cross' : 'checkmark' }}"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr><td colspan="11" class="text-center">No 3rd party forms added yet.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="mybody">
                    <h5 class="mt-0">Add 3rd Party Forms</h5>
                    <div class="px-0">
                        <form id="third-party-form" method="POST" enctype="multipart/form-data"
                            action="{{ route('property.addThirdPartyForm') }}">
                            @csrf

                            <div class="d-flex flex-wrap">
                                @php
                                    $job_documents = [];

                                    foreach ($contractor_jobs as $job) {
                                        foreach ($job['documents'] as $document) {
                                            $job_documents[$document] = 1;
                                        }
                                    }

                                @endphp
                                <div class="col-md-6 col-12 pe-md-2 mb-1">
                                    <select name="type" id="contractor-jobs-dropdown" class="form-control mt-1" required>
                                        @foreach ($job_documents as $document => $val)
                                            <option value="{{ $document }}" class="input-sm form-control">
                                                {{ $document }}</option>
                                        @endforeach
                                        <option value="Works Order" class="input-sm form-control">Works Order</option>

                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-1">
                                    <input type="text" name="supplied-by" class="form-control mt-1"
                                    id="third-party-supplied-by" placeholder="Supplied by" required />
                                </div>
                                <div class="col-md-4 col-12 pe-md-2 mb-1">
                                    <textarea class="form-control mt-1" id="third-party-notes" name="notes" id="" cols="30"
                                rows="3" placeholder="Notes"></textarea>
                                </div>
                                <div class="col-md-5 col-12 mb-1">
                                    <input type="file" class="form-control mt-1" name="third-party-files[]"
                                        id="third-party-files" required multiple>
                                </div>
                                <div class="col-md-3 col-12 ps-lg-2 ps-md-2">
                                    <button class="btn btn-sm _btn-primary mt-1 w-100" id="add-surveyor-button"
                                                type="submit">Add Document
                                            </button>
                                </div>
                            </div>
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                        </form>
                    </div>
                </div>
            </div>
            @php
                $status_color = [
                    'Pending' => 'badge-warning',
                    'Accepted' => 'badge-success-light',
                    'Rejected' => 'badge-danger',
                    'Complete' => 'badge-success',
                    'Variation' => 'badge-info',
                    'In-Progress' => 'badge-warning-light',
                ];
            @endphp
            <div class="col card _shadow-1 generalCols heaberTarget d-none">
                <div class="d-flex justify-content-between align-items-center">
                <h2>HEA / BER Assessors</h2>
                <a href="{{ route('property.export-all-documents2', [Crypt::encrypt($property->id)]) }}"
                    class="btn btn-sm _btn-primary mt-1 float-end">Export All Documents</a>
                </div>
                <div class="mybody mb-2" id="property-assessor-body">
                    <table class="table dt-responsive w-100" id="property-assessor-table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Assessor</th>
                                <th>QA Surveyor</th>
                                <th>Job</th>
                                <th>Cost</th>
                                <th>Paid</th>
                                <th>Our Price</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th style="width: 130px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeOf($assessors))
                            @foreach ($assessors as $k => $assessor)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>
                                        <b>{{ $assessor['assessor'] ? $assessor['assessor']['firstname'] : '' }}</b>
                                    </td>
                                    <td><b>{{ $assessor['surveyor'] ? $assessor['surveyor']['full_name'] : '' }}</b>
                                    </td>
                                    <td>{{ $assessor['job_lookup']['title'] ?? '' }}</td>
                                    <td>{{ number_format((float) $assessor['cost'], 2, '.', '') }}</td>
                                    <td>{{ number_format((float) $assessor['paid'], 2, '.', '') }}</td>
                                    <td>{{ number_format((float) $assessor['our_price'], 2, '.', '') }}</td>
                                    <td>{{ date('d/m/Y', strtotime($assessor['start_date'])) }}</td>
                                    <td
                                        class="{{ strtotime($assessor['end_date']) < strtotime(date('Y-m-d')) && $assessor['status'] == 'Pending' ? 'text-danger' : '' }}">
                                        {{ date('d/m/Y', strtotime($assessor['end_date'])) }}</td>
                                    <td
                                        class="{{ strtotime($assessor['end_date']) < strtotime(date('Y-m-d')) && $assessor['status'] == 'Pending'
                                            ? 'text-danger'
                                            : '' }}">
                                        <span
                                            class="badge {{ $status_color[$assessor['status']] }} p-1 lead d-block text-uppercase">{{ $assessor['status'] }}</span>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('property.assignAssessor', [$property->id, $assessor->id]) }}"
                                                class="btn-outline-sm _btn-primary px-2 action-icon rounded mb-0"
                                            title="Edit Contract">
                                            <i class="text-white mdi mdi-circle-edit-outline"></i>
                                            </a>
                                            <a title="Expand details"
                                                class="btn btn-outline-sm _btn-primary px-2 action-icon rounded my-1"
                                                onclick="toggleAssessorDetails({{ $assessor->id }})">
                                                <i class="text-white mdi mdi-eye"></i>
                                            </a>
                                            @if (sizeof($assessor['document']))
                                                <a href="{{ route('property.export-documents2', [Crypt::encrypt($property->id), Crypt::encrypt($assessor->assessor_id)]) }}"
                                                    class="btn btn-outline-sm _btn-primary px-2 action-icon rounded my-1"
                                                    title="Export Documents">
                                                    <i class="text-white mdi mdi-download-network"></i>
                                                </a>
                                            @else
                                                <button
                                                    class="btn btn-outline-sm _btn-primary px-2 action-icon rounded my-1"
                                                    title="No Document Found." disabled>
                                                    <i class="text-white mdi mdi-download-network"></i>
                                                </button>
                                            @endif
                                            <a href="{{ route('property.deleteAssessor', Crypt::encrypt($assessor->id)) }}"
                                                class="btn-outline-sm btn-danger  px-2 action-icon rounded"
                                                    title="Delete Contract">
                                                    <i class="text-white mdi mdi-delete"></i>
                                            </a>
                                    </div>
                                    </td>
                                </tr>
                                <tr class="bg-lighter">
                                        <td colspan="11" class="d-none thisClass" id="assessor_container_{{ $assessor['id'] }}">
                                            <div>
                                            @if (sizeof($assessor['document']))
                                                <ul class="list-unstyled">
                                                    @foreach ($assessor['document'] as $document)
                                                        <li>
                                                            <b>{{$document['document']}}:</b>
                                                            <a target="_blank"
                                                            href="/files/{{$document['file']}}">{{$document['file']}}</a>

                                                            <a
                                                                class="text-danger ml-2"
                                                                href="{{route('property.deleteDocument', $document['id'])}}"
                                                                onClick="return confirm(`Are you sure you want to delete this document?`)"
                                                                title="Delete document"
                                                            >
                                                                X
                                                            </a>
                                                        </li>

                                                    @endforeach
                                                </ul>
                                            @endif
                                            @if (sizeof($assessor['remaining_documents']))
                                                <h6 class="my-0">
                                                    <span class="text-danger">Remaining Documents: </span>
                                                    <span>
                                                    {{join(', ', $assessor['remaining_documents'])}}
                                                </span>
                                                </h6>
                                            @endif
                                            <form method="POST" action="{{ route('assessor-contract.uploadFile') }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$assessor['id']}}">
                                                <div class="row mt-2">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="document" class="form-label">Document Type</label>
                                                            <select name="document"class="form-select  @error('document') is-invalid @enderror" id="document" required >
                                                                    <option value="">Select Type</option>
                                                                    @foreach($assessor['remaining_documents'] as $doc)
                                                                    <option value="{{$doc}}">{{$doc}}</option>
                                                                    @endforeach
                                                            </select>
                                                            @error('document')
                                                            <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="document" class="form-label">Document Files</label>
                                                            <input type="file" accept="application/msword,application/vnd.ms-excel,application/vnd.ms-powerpoint,text/plain, application/pdf, image/*"
                                                                   name="files[]" class="form-control" required multiple>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="float-end">
                                                            <button class="btn _btn-primary">Upload File</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="11" class="text-center">No hea/ber assessors added yet.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mybody" style="background-color: #f7faff !important;padding:8px;">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end align-items-center">

                            <div class="align-self-start">
                                <a href="{{ route('property.assignAssessor', [$property->id, 0]) }}"
                                    class="btn btn-sm _btn-primary float-end borderrad">Assign HEA/BER Assessor</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col card _shadow-1 generalCols contractTarget d-none">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 style="color: #1A47A3;">Contractors</h2>
                    <a href="{{ route('property.export-all-documents', [Crypt::encrypt($property->id)]) }}"
                        class="btn btn-sm _btn-primary mt-1 float-end">Export All Documents</a>
                </div>
                <div class="mybody table-responsive mb-2">
                    <table class="table  dt-responsive w-100" id="contractor-table">
                        <thead>
                            <tr>
                                <th>Contractor</th>
                                <th>QA Surveyor</th>
                                <th>Job</th>
                                <th>Cost</th>
                                <th>Paid</th>
                                <th>Our Price</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeOf($contractors))
                            @foreach ($contractors as $contractor)
                                <tr>
                                    <td>
                                        <b>{{ $contractor['contractor'] ? $contractor['contractor']['firstname'] : '' }}</b>
                                    </td>
                                    <td><b>{{ $contractor['surveyor'] ? $contractor['surveyor']['full_name'] : '' }}</b>
                                    </td>
                                    <td>{{ $contractor['job_lookup']['title'] ?? '' }}</td>
                                    <td>{{ number_format((float) $contractor['cost'], 2, '.', '') }}</td>
                                    <td>{{ number_format((float) $contractor['paid'], 2, '.', '') }}</td>
                                    <td>{{ number_format((float) $contractor['our_price'], 2, '.', '') }}</td>
                                    <td>@if($contractor['start_date'] != null){{ date('d/m/Y', strtotime($contractor['start_date'])) }} @else N/A @endif</td>
                                    <td
                                        class="{{ $contractor['end_date'] < NOW() && $contractor['status'] == 'Pending' ? 'text-danger' : '' }}">
                                        @if($contractor['end_date'] != null)
                                        {{ date('d/m/Y', strtotime($contractor['end_date'])) }}
                                        @if (strtotime($contractor['end_date']) < strtotime(date('Y-m-d')) && ($contractor['status'] == 'Pending' || $contractor['status'] == 'Accepted'))
                                            <span
                                                class="badge badge-danger text-uppercase p-1 lead d-block mt-2">Overdue</span>
                                        @endif
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td
                                        class="{{ $contractor['end_date'] < NOW() && $contractor['status'] == 'Pending' ? 'text-danger' : '' }}">
                                        {{-- <span class="badge {{ $status_color[$contractor['status']] }} p-1 lead d-block text-uppercase">{{ $contractor['status'] }}</span> --}}
                                        <span
                                        class="badge {{ $status_color[$contractor['status']] }} p-1 lead d-block text-uppercase editableStatus"
                                        data-job="{{ $contractor['job_lookup']['title'] ?? '' }}"
                                        data-status="{{ $contractor['status'] }}" data-cid="{{ $contractor->id }}"
                                        data-pid="{{ $property->id }}">{{ $contractor['status'] }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            @if($contractor['contractor'])
                                            <a href="{{ route('chat.open', ['id' => Crypt::encrypt($contractor['contractor']['id']),'cid' => $property->id]) }}"
                                                title="Chat with contractor"
                                                class="btn btn-outline-sm _btn-primary px-2 my-1 action-icon rounded">
                                                <i class="text-white fa fa-envelope"></i>
                                            </a>
                                            @endif
                                            <a title="Expand details"
                                                class="btn btn-outline-sm _btn-primary px-2 action-icon rounded my-1"
                                                onclick="toggleContractorDetails({{ $contractor->id }})">
                                                <i class="text-white mdi mdi-eye"></i>
                                            </a>

                                            <a href="{{ route('property.assign-contractor', [$property->id, $contractor->id]) }}"
                                                class="btn btn-outline-sm _btn-primary px-2 action-icon rounded my-1"
                                                title="Edit Contract">
                                                <i class="text-white mdi mdi-circle-edit-outline"></i>
                                            </a>
                                            @if (sizeof($contractor['document']))
                                                <a href="{{ route('property.export-documents', [Crypt::encrypt($property->id), Crypt::encrypt($contractor->id)]) }}"
                                                    class="btn btn-outline-sm _btn-primary px-2 action-icon rounded my-1"
                                                    title="Export Documents">
                                                    <i class="text-white mdi mdi-download-network"></i>
                                                </a>
                                            @else
                                                <button
                                                    class="btn btn-outline-sm _btn-primary px-2 action-icon rounded my-1"
                                                    title="No Document Found." disabled>
                                                    <i class="text-white mdi mdi-download-network"></i>
                                                </button>
                                            @endif
                                            <a href="{{ route('property.deleteContract', Crypt::encrypt($contractor->id)) }}"
                                                class="btn btn-outline-sm btn-danger  px-2 my-1 action-icon rounded"
                                                title="Delete Contract" onclick="return confirm('Are you sure you want to delete this contractor?');">
                                                <i class="text-white mdi mdi-delete"></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="padding: unset">
                                        <div style="display: none" id="contractor_container_{{ $contractor->id }}">
                                            <table class="table">

                                                {{-- Contractor Notes Start here --}}
                                                @if (sizeof($contractor['property_notes']))
                                                    <tr class="bg-lighter">
                                                        <td colspan="10">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 py-0">

                                                                    <h5 class="m-0">Contractor Notes</h5>

                                                                    <table class="table table-bordered mt-2 ml-1">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Note</th>
                                                                                <th>Created At</th>
                                                                                <th>Added By</th>
                                                                                <th>Actions</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($contractor['property_notes'] as $note)
                                                                                <tr>
                                                                                    <td>{{ $note->notes }}</td>
                                                                                    <td>{{ date('d/m/Y', strtotime($note->created_at)) }}
                                                                                    </td>
                                                                                    <td>{{ $note->author->firstname . ' ' . $note->author->lastname }}
                                                                                        <small><b>({{ ucfirst($note->author->role) }})</b></small>
                                                                                    </td>
                                                                                    <td>
                                                                                        @if (Auth::user()->id == $note->created_by)
                                                                                            <a href="{{ route('contract.deleteNote', Crypt::encrypt($note->id)) }}"
                                                                                                class="btn btn-outline-sm btn-danger px-2 action-icon rounded"
                                                                                                title="Delete Note">
                                                                                                <i
                                                                                                    class="text-white mdi mdi-delete"></i>
                                                                                            </a>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                @endif

                                                <tr>
                                                    <td colspan="10">
                                                        <h5 class="mx-0">Add Contractor Notes</h5>
                                                        <form action="{{ route('contract.createNote') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="contractor_id"
                                                                value="{{ $contractor['contractor_id'] }}">
                                                            <input type="hidden" name="contractor_property_id"
                                                                value="{{ $contractor['id'] }}">
                                                            <input type="hidden" name="property_id"
                                                                value="{{ $property->id }}">
                                                            <input type="hidden" name="job_id"
                                                                @if (isset($contractor['job_lookup']) && $contractor['job_lookup'] != null) value="{{ $contractor['job_lookup']['id'] }}"
                                                            @else
                                                            value="" @endif>
                                                            <div class="row">
                                                                <div class="col-sm-6 col-md-10">
                                                                    <textarea class="form-control" name="notes" id="" cols="30" rows="3" placeholder="Notes"
                                                                        required></textarea>
                                                                </div>
                                                                <div class="col-sm-6 col-md-2">
                                                                    <button
                                                                        onClick="return confirm(`Are you sure you want to add note?`)"
                                                                        class="btn _btn-primary btn-block">
                                                                        Add note
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </td>
                                                </tr>
                                                {{-- Contractor Notes ends here --}}


                                                @if (sizeof($contractor['document']))
                                                    <tr class="bg-lighter">
                                                        <td colspan="10">
                                                            <ul class="list-unstyled">
                                                                @foreach ($contractor['document'] as $document)
                                                                    <li>
                                                                        <b>{{ $document['document'] }}:</b>
                                                                        <a target="_blank"
                                                                            href="/files/{{ $document['file'] }}">{{ $document['file'] }}
                                                                            {{ $document['author'] ? '| ' . $document['author'] : '' }}</a>

                                                                        <a class="text-danger ml-2"
                                                                            href="{{ route('property.deleteDocument', $document['id']) }}"
                                                                            onClick="return confirm(`Are you sure you want to delete this document?`)"
                                                                            title="Delete document">
                                                                            X
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>

                                                        </td>
                                                    </tr>
                                                @endif

                                                <tr>
                                                    <td colspan="10">
                                                        <div>
                                                            <form method="POST"
                                                                action="{{ route('document.contract.upload') }}">
                                                                @csrf

                                                                <input type="hidden" name="id"
                                                                    value="{{ $contractor['id'] }}">

                                                                <div class="row mb-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="choose_lib"
                                                                            data-contract={{ $contractor['id'] }}
                                                                            onclick="show_library(this);">
                                                                        <label class="form-check-label" name="choose_lib"
                                                                            for="choose_lib">Choose from document
                                                                            library</label>
                                                                    </div>

                                                                    <div class="d-none"
                                                                        id="show-library-{{ $contractor['id'] }}">
                                                                        <div class="row mb-3 mt-3">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="job_document"
                                                                                        class="form-label">Job</label>
                                                                                    <select name="job_document"
                                                                                        class="form-select  @error('document') is-invalid @enderror"
                                                                                        id="job_document" required
                                                                                        onchange="filter_options(this);"
                                                                                        data-contract={{ $contractor['id'] }}
                                                                                        data-job={{ $contractor['job_id'] }}>
                                                                                        @if (isset($contractor_jobs[$contractor['job_id']]['documents']))
                                                                                            <option value="">
                                                                                            </option>
                                                                                            @foreach ($contractor_jobs[$contractor['job_id']]['documents'] as $document)
                                                                                                <option
                                                                                                    value="{{ $document }}">
                                                                                                    {{ $document }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                    @error('job_document')
                                                                                        <span class="text-danger"
                                                                                            role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="document_lib-{{ $contractor['id'] }}"
                                                                                        class="form-label">Documents</label>
                                                                                    <select name="document_lib"
                                                                                        class="form-select  @error('document_lib') is-invalid @enderror"
                                                                                        id="document_lib-{{ $contractor['id'] }}"
                                                                                        required>
                                                                                        @if (isset($contractor_jobs[$contractor['job_id']]['library_documents']))
                                                                                            <option document_type = ""
                                                                                                value=""></option>
                                                                                            @foreach ($contractor_jobs[$contractor['job_id']]['library_documents'] as $document)
                                                                                                <option
                                                                                                    document_type = "{{ $document['job_document_type'] }}"
                                                                                                    value="{{ $document['id'] }}">
                                                                                                    {{ $document['name'] }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                    @error('document')
                                                                                        <span class="text-danger"
                                                                                            role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="float-end">
                                                                                    <button type="submit"
                                                                                        id="show-library-button-{{ $contractor['id'] }}"
                                                                                        class="btn _btn-primary">Upload
                                                                                        File</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </form>

                                                        </div>
                                                        <div id="upload-file-{{ $contractor['id'] }}">

                                                            <form method="POST"
                                                                action="{{ route('contract.uploadFile') }}"
                                                                enctype="multipart/form-data">
                                                                @csrf

                                                                <input type="hidden" name="id"
                                                                    value="{{ $contractor['id'] }}">

                                                                <div class="row mb-3">
                                                                    <div class="col-sm-6">

                                                                        <div class="form-group">
                                                                            <label for="document"
                                                                                class="form-label">Job</label>
                                                                            <select name="document"
                                                                                class="form-select  @error('document') is-invalid @enderror"
                                                                                id="document" required>
                                                                                @if (isset($contractor_jobs[$contractor['job_id']]['documents']))
                                                                                    @foreach ($contractor_jobs[$contractor['job_id']]['documents'] as $document)
                                                                                        <option
                                                                                            value="{{ $document }}">
                                                                                            {{ $document }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                            @error('document')
                                                                                <span class="text-danger" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-sm-6 pt-3">
                                                                        <input type="file"
                                                                            accept="application/msword,
                                                                            application/vnd.ms-excel,
                                                                            application/vnd.ms-powerpoint,
                                                                            text/plain, application/pdf, image/*"
                                                                            name="files[]" class="form-control" required
                                                                            multiple>
                                                                    </div>


                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="float-end">
                                                                            <button class="btn _btn-primary">Upload
                                                                                File</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </form>



                                                            @if (sizeof($contractor['remaining_documents']))
                                                                <h6 class="my-0">
                                                                    <span class="text-danger">Remaining Documents: </span>
                                                                    <span>{{ join(', ', $contractor['remaining_documents']) }}</span>
                                                                </h6>
                                                            @endif

                                                        </div>
                                                    </td>
                                                </tr>


                                                <tr class="bg-lighter">
                                                    <td colspan="10">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-8 col-lg-8 py-0"
                                                                style="border-right: 1px #cecdcd solid">
                                                                <h5 class="m-0">Work Orders</h5>
                                                                @if ($contractor['word_orders'])
                                                                    <ol class="mt-2">
                                                                        @foreach ($contractor['word_orders'] as $file)
                                                                            <li>
                                                                                <div
                                                                                    class="d-flex justify-content-between">
                                                                                    <div>
                                                                                        <a class="{{ $file['status'] != 'Active' ? 'text-secondary' : '' }}"
                                                                                            target="_blank"
                                                                                            href="/files/{{ $file['file_path'] }}">{{ $file['file_name'] }}</a>

                                                                                        @if ($file['status'] != 'Active')
                                                                                            <span class="text-danger">
                                                                                                (ARCHIVED)
                                                                                            </span>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div>
                                                                                        <a href="{{ route('property.changeWorkOrderStatus', [$file['id'], $file['status'] == 'Active' ? 'Archive' : 'Active']) }}"
                                                                                            title="{{ $file['status'] == 'Active' ? 'Archive document' : 'Activate document' }}">
                                                                                            <i
                                                                                                class="dripicons-{{ $file['status'] == 'Active' ? 'cross' : 'checkmark' }}"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ol>
                                                                @endif

                                                            </div>
                                                            <div class="col-sm-12 col-md-4 col-lg-4 pt-1">
                                                                <form method="POST"
                                                                    action="{{ route('property.uploadWorkOrder') }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="contract_id"
                                                                        value="{{ $contractor['id'] }}">
                                                                    <input type="file" class="form-control"
                                                                        name="work-order-file">
                                                                    <button class="btn _btn-primary my-1 float-end">
                                                                        Upload
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>

                                                <tr class="bg-lighter">
                                                    <td colspan="10">
                                                        <p>
                                                            <b>Notes: </b>{{ $contractor['contractor_notes'] }}
                                                        </p>
                                                    </td>
                                                </tr>

                                                @if (sizeof($contractor['variation']))
                                                    <tr class="bg-lighter">
                                                        <td colspan="10">

                                                            <div class="row col-sm-12">
                                                                <h5 class="m-0">Variation(s)</h5>
                                                                <table class="table table-bordered mt-2 ml-1">
                                                                    <thead>
                                                                        <tr class="">
                                                                            <th class="">Notes</th>
                                                                            <th class="">Cost</th>
                                                                            <th class="">Date</th>
                                                                            <th class="">Status</th>
                                                                            <th class="">Added By</th>
                                                                            {{--                                                        <th class="">File</th> --}}
                                                                            <th class="" colspan="2">Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($contractor['variation'] as $variation)
                                                                            <tr>
                                                                                <td style="max-width: 250px">
                                                                                    {{ $variation['notes'] }}</td>
                                                                                <td>{{ number_format((float) $variation['additional_cost'], 2, '.', '') }}
                                                                                </td>
                                                                                <td>{{ date('d/m/Y', strtotime($variation['date'])) }}
                                                                                </td>
                                                                                <td>{{ $variation['status'] }}</td>
                                                                                <td>{{ $variation['uploader_type'] }}</td>
                                                                                <td>

                                                                                    <form
                                                                                        action="{{ route('property.updateVariation') }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <input type="hidden"
                                                                                            class="hidden"
                                                                                            name="variation_id"
                                                                                            value="{{ $variation['id'] }}">
                                                                                        <div class="d-flex">
                                                                                            <select name="variation_status"
                                                                                                id="variation_status"
                                                                                                class="form-control form-control-sm">
                                                                                                <option
                                                                                                    {{ $variation['status'] == 'Pending' ? 'selected' : '' }}
                                                                                                    value="Pending">
                                                                                                    Pending
                                                                                                </option>
                                                                                                <option
                                                                                                    {{ $variation['status'] == 'Accepted' ? 'selected' : '' }}
                                                                                                    value="Accepted">
                                                                                                    Accepted
                                                                                                </option>
                                                                                                <option
                                                                                                    {{ $variation['status'] == 'Rejected' ? 'selected' : '' }}
                                                                                                    value="Rejected">
                                                                                                    Rejected
                                                                                                </option>
                                                                                            </select>
                                                                                            <button
                                                                                                class="btn btn-sm _btn-primary ml-1">
                                                                                                Update
                                                                                            </button>
                                                                                        </div>

                                                                                    </form>

                                                                                </td>
                                                                                <td>
                                                                                    <a title="Expand details"
                                                                                        class="btn btn-outline-sm _btn-primary px-2 action-icon rounded"
                                                                                        onclick="toggleVariationDetails({{ $variation['id'] }})">
                                                                                        <i
                                                                                            class="text-white mdi mdi-eye"></i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td colspan="6" style="padding: unset">
                                                                                    <div style="display: none"
                                                                                        id="variation_details_container_{{ $variation['id'] }}">
                                                                                        <table class="table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="6">
                                                                                                        <h5>Variation
                                                                                                            Document(s)</h5>
                                                                                                        <ol>
                                                                                                            @foreach ($variation['documents'] as $document)
                                                                                                                <li>
                                                                                                                    <a target="_blank"
                                                                                                                        href="/files/{{ $document['file_path'] }}">{{ $document['file_path'] }}</a>
                                                                                                                    <span>
                                                                                                                        <b>[{{ $document['uploader_type'] }}]
                                                                                                                            [{{ date('d/m/Y H:m:s', strtotime($document['created_at'])) }}]</b></span>

                                                                                                                    <a class="text-danger ml-2"
                                                                                                                        href="{{ route('property.deleteVariationDocument', $document['id']) }}"
                                                                                                                        onClick="return confirm(`Are you sure you want to delete this document?`)"
                                                                                                                        title="Delete document">
                                                                                                                        X
                                                                                                                    </a>
                                                                                                                </li>
                                                                                                            @endforeach
                                                                                                        </ol>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="6">
                                                                                                        <h5>Upload Variation
                                                                                                            Document</h5>
                                                                                                        <form
                                                                                                            action="{{ route('contract.uploadVariationDocument') }}"
                                                                                                            method="POST"
                                                                                                            enctype="multipart/form-data">
                                                                                                            @csrf
                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                class="hidden"
                                                                                                                name="variation_id"
                                                                                                                value="{{ $variation['id'] }}">
                                                                                                            <div
                                                                                                                class="d-flex">
                                                                                                                <input
                                                                                                                    type="file"
                                                                                                                    name="document"
                                                                                                                    class="mx-0 px-0"
                                                                                                                    required>
                                                                                                                <button
                                                                                                                    class="btn btn-sm _btn-primary mx-0">
                                                                                                                    UPLOAD
                                                                                                                </button>
                                                                                                            </div>

                                                                                                        </form>

                                                                                                    </td>

                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>

                                                            </div>

                                                        </td>
                                                    </tr>
                                                @endif

                                                <tr>
                                                    <td colspan="10">
                                                        <h5 class="mx-0">Add Variation</h5>
                                                        <form action="{{ route('contract.createVariation') }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="row">
                                                                <input type="hidden" name="contractor_property_id"
                                                                    value="{{ $contractor['id'] }}">
                                                                <div class="col-sm-6 col-md-4">
                                                                    <textarea class="form-control" name="notes" id="" cols="30" rows="3" placeholder="Notes"
                                                                        required></textarea>
                                                                </div>
                                                                <div class="col-sm-6 col-md-4">
                                                                    <input class="form-control" type="number"
                                                                        step=".01" name="additional_cost"
                                                                        min="0" placeholder="Additional Cost"
                                                                        required>
                                                                </div>
                                                                <div class="col-sm-6 col-md-4">
                                                                    <button
                                                                        onClick="return confirm(`Are you sure you want to add variation?`)"
                                                                        class="btn _btn-primary">Add Variation
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </td>
                                                </tr>


                                                <td colspan="10">
                                                    <div>
                                                        <h5 class="mx-0">Post Work Log(s)</h5>
                                                        <div>
                                                            <table class="table table-bordered table-striped">
                                                                <thead>
                                                                    <th>Id</th>
                                                                    <th>Notes</th>
                                                                    <th>Date Added</th>
                                                                    <th>Status</th>
                                                                    <th style="width: 150px">Actions</th>
                                                                </thead>
                                                                <tbody>

                                                                    @foreach ($contractor['post_work_log'] as $log)
                                                                        <span
                                                                            id="post_work_log_{{ $log['id'] }}"></span>
                                                                        <tr>
                                                                            <form
                                                                                action="{{ route('property.updatePostWorkLog') }}"
                                                                                method="POST">
                                                                                @csrf

                                                                                <td>{{ $log['id'] }}</td>

                                                                                <td>
                                                                                    <textarea name="notes" id="notes_id" class="form-control" rows="1">{{ $log['notes'] }}</textarea>
                                                                                </td>
                                                                                <td>{{ date('d/m/Y', strtotime($log['date_added'])) }}
                                                                                </td>
                                                                                <td>

                                                                                    <input type="hidden" name="id"
                                                                                        value="{{ $log['id'] }}">
                                                                                    <select name="status"
                                                                                        class="form-control">
                                                                                        <option
                                                                                            {{ $log['status'] == 'Opened' ? 'selected' : '' }}
                                                                                            value="Opened">
                                                                                            Opened
                                                                                        </option>
                                                                                        {{-- <option
                                                                                            {{ $log['status'] == 'In progress' ? 'selected' : '' }}
                                                                                            value="In progress">
                                                                                            In progress
                                                                                        </option> --}}
                                                                                        <option
                                                                                            {{ $log['status'] == 'Complete' ? 'selected' : '' }}
                                                                                            value="Complete">
                                                                                            Closed
                                                                                        </option>
                                                                                    </select>

                                                                                </td>
                                                                                <td>

                                                                                    <button
                                                                                        class="btn btn-outline-sm _btn-primary pointer px-2 action-icon rounded mt-0"
                                                                                        onclick="if(confirm('Are you sure, you want to update work log?')) this.form.submit()"
                                                                                        title="Update Work Log">
                                                                                        <i
                                                                                            class="text-white mdi mdi-restart"></i>
                                                                                    </button>

                                                                                    <button
                                                                                        onclick="if(confirm('Are you sure, you want to delete this work log?'))location.href='{{ route('property.deletePostWorkLog', \Illuminate\Support\Facades\Crypt::encrypt($log->id)) }}'"
                                                                                        class="btn btn-outline-sm btn-danger pointer px-2 action-icon rounded"
                                                                                        title="Delete Work Log">
                                                                                        <i
                                                                                            class="text-white mdi mdi-delete"></i>
                                                                                    </button>

                                                                                </td>
                                                                            </form>
                                                                        </tr>
                                                                    @endforeach
                                                                    <tr>
                                                                        <td colspan="5">
                                                                            <div>

                                                                                <form
                                                                                    action="{{ route('property.addPostWorkLog') }}"
                                                                                    method="post">
                                                                                    <h5>Add Post Work Log</h5>

                                                                                    @csrf

                                                                                    <div>
                                                                                        <input type="hidden"
                                                                                            name="id"
                                                                                            value="{{ $contractor['id'] }}">

                                                                                        <div class="row">
                                                                                            <div class="col-sm-6">

                                                                                                <div class="form-group">
                                                                                                    <label for="notes">
                                                                                                        Notes <span
                                                                                                            class="text-danger"
                                                                                                            title="Required field">*</span>
                                                                                                    </label>
                                                                                                    <textarea type="text" class="form-control" placeholder="Enter notes" rows="2" name="notes" required></textarea>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="col-sm-6">

                                                                                                <label for="status">
                                                                                                    Status <span
                                                                                                        class="text-danger"
                                                                                                        title="Required field">*</span>
                                                                                                </label>

                                                                                                <select name="status"
                                                                                                    class="form-control">
                                                                                                    <option value="Opened">
                                                                                                        Opened
                                                                                                    </option>
                                                                                                    {{-- <option
                                                                                                        value="In progress">
                                                                                                        In
                                                                                                        progress
                                                                                                    </option> --}}
                                                                                                    <option
                                                                                                        value="Complete">
                                                                                                        Closed
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="d-flex justify-content-end">
                                                                                        <button type="submit"
                                                                                            data-toggle="modal"
                                                                                            data-target="#addPostWorkModal"
                                                                                            class="btn _btn-primary mt-2">ADD
                                                                                            POST WORK LOG
                                                                                        </button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </td>

                                                <tr>
                                                    <td colspan="10" class="p-0">
                                                        <div class="d-flex p-2 py-1">
                                                            &nbsp;
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="10" class="text-center">No contractor added yet.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mybody">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('property.assign-contractor', [$property->id, 0]) }}"
                                class="btn btn-sm _btn-primary float-end">Assign Contractor</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col card _shadow-1 generalCols contractLogTarget d-none">
                <h2>Post Work Log(s)</h2>
                <div class="mybody mb-2">

                    <table class="table table-bordered dt-responsive nowrap w-100" id="property-post-work-logs">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Address</th>
                                <th>Notes</th>
                                <th>Status</th>
                                <th>Date Added</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeOf($post_work_logs))
                            @foreach ($post_work_logs as $postworklog)
                            <tr>
                                <td>{{ $postworklog->id }}</td>
                                <td>{{ format_address(
                                    $postworklog->house_num,
                                    $postworklog->address1,
                                    $postworklog->address2,
                                    $postworklog->address3,
                                    $postworklog->county,
                                    $postworklog->eircode
                                ) }}</td>
                                <td>{{ $postworklog->notes }}</td>
                                <td>{{ $postworklog->status }}</td>
                                <td>{{ $postworklog->date_added }}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center">No post work logs added yet.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
                @if ($property['batch']['scheme_id'] == 1)
                    <div class="card-body mybody">
                        <div class="row">


                            <form method="POST" action="{{ route('property.updateFinancials') }}">

                                @csrf

                                <input type="hidden" name="property_id" value="{{ $property['id'] }}">

                                <div class="card-body pt-2">

                                    <div class="row justify-content-end">
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-group my-1">
                                                <label for="overall_total" class="mr-1">Overall Total</label>
                                                <input class="form-control" name="overall_total" type="number"
                                                    step="0.01" value="{{ $property['overall_total'] }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">

                                            <div class="form-group">
                                                <label for="deposit_amount" class="mr-1">Deposit</label>
                                                <input class="form-control" name="deposit_amount" type="number"
                                                    step="0.01" value="{{ $property['deposit_amount'] }}">
                                            </div>

                                            <div class="form-group my-1">
                                                <label for="deposit_date" class="mr-1">Due/Paid</label>
                                                <input class="form-control" name="deposit_date" type="date"
                                                    value="{{ $property['deposit_date'] }}">
                                            </div>

                                            <div class="form-group my-1">
                                                <label for="deposit_status" class="mr-1">Status</label>
                                                <select class="form-control" name="deposit_status"
                                                    value="{{ $property['deposit_status'] }}">
                                                    <option {{ $property['deposit_status'] == 'Due' ? 'selected' : '' }}
                                                        value="Due">
                                                        Due
                                                    </option>
                                                    <option {{ $property['deposit_status'] == 'Paid' ? 'selected' : '' }}
                                                        value="Paid">
                                                        Paid
                                                    </option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="interim_amount" class="mr-1">Interim</label>
                                                <input class="form-control" name="interim_amount" type="number"
                                                    step="0.01" value="{{ $property['interim_amount'] }}">
                                            </div>

                                            <div class="form-group my-1">
                                                <label for="interim_date" class="mr-1">Due/Paid</label>
                                                <input class="form-control" name="interim_date" type="date"
                                                    value="{{ $property['interim_date'] }}">
                                            </div>

                                            <div class="form-group my-1">
                                                <label for="interim_status" class="mr-1">Status</label>
                                                <select class="form-control" name="interim_status"
                                                    value="{{ $property['interim_status'] }}">
                                                    <option {{ $property['interim_status'] == 'Due' ? 'selected' : '' }}
                                                        value="Due">
                                                        Due
                                                    </option>
                                                    <option {{ $property['interim_status'] == 'Paid' ? 'selected' : '' }}
                                                        value="Paid">
                                                        Paid
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="final_amount" class="mr-1">Final</label>
                                                <input class="form-control" name="final_amount" type="number"
                                                    step="0.01" value="{{ $property['final_amount'] }}">
                                            </div>

                                            <div class="form-group my-1">
                                                <label for="final_date" class="mr-1">Due/Paid</label>
                                                <input class="form-control" name="final_date" type="date"
                                                    value="{{ $property['final_date'] }}">
                                            </div>

                                            <div class="form-group my-1">
                                                <label for="final_status" class="mr-1">Status</label>
                                                <select class="form-control" name="final_status"
                                                    value="{{ $property['final_status'] }}">
                                                    <option {{ $property['final_status'] == 'Due' ? 'selected' : '' }}
                                                        value="Due">Due
                                                    </option>
                                                    <option {{ $property['final_status'] == 'Paid' ? 'selected' : '' }}
                                                        value="Paid">
                                                        Paid
                                                    </option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 ">
                                            <button class="btn btn-sm _btn-primary float-end mt-1">Update</button>
                                        </div>
                                    </div>
                                </div> <!-- end card-body-->


                            </form>

                        </div>
                    </div>
                @endif
            </div>
            <div class="col card _shadow-1 generalCols snagsTarget d-none">
                <h2>Snags Records</h2>
                <div class="mybody mb-2">
                    {{-- <div class="table-responsive"> --}}
                    <table class="table table-bordered" id="property_snags_table">
                        <thead>
                            <th>Id</th>
                            <th>Priority</th>
                            <th>General Comment</th>
                            <th>Status</th>
                            <th style="width: 55px">Date</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($snags as $snag)
                                @if (!isset($snag->del_status) || $snag->del_status == '0')
                                    <tr>
                                        <td>{{ $snag->id }}</td>
                                        <td>{{ $snag->priority }}</td>
                                        <td>{{ $snag->general_comment }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $snag->status == 'Open' ? 'badge-success' : 'badge-info' }} my-1 p-1 d-block text-uppercase">{{ $snag->status }}</span>
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($snag->created_at)) }}</td>
                                        <td class="width-content">
                                            <div>
                                                <a class="btn-sm _btn-primary ml-1 my-2"
                                                    href="{{ route('property.snag_report', [$snag->id, 'view']) }}">View</a>
                                                <a class="btn-sm _btn-primary ml-1 my-2" target="_blank"
                                                    href="{{ route('property.snag_report', [$snag->id, 'print']) }}">PRINT</a>
                                                {{-- @if ($snag->pdf_filename != '' && $snag->pdf_filename != null)
                                                    <a class="btn-sm _btn-primary ml-1 my-2" target="_blank"
                                                        href="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/snag_pdf' . $snag->pdf_filename) }}">PDF</a>
                                                @else --}}
                                                    <a class="btn-sm _btn-primary ml-1 my-2"
                                                        href="{{ route('property.snag_report', [$snag->id, 'pdf']) }}">PDF</a>
                                                {{-- @endif --}}
                                                <a onclick="return confirm(`Are you sure you want to delete?`)"
                                                    class="btn-sm _btn-dangers ml-1 my-2"
                                                    href="{{ route('property.snag_report', [$snag->id, 'delete']) }}">DELETE</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    {{-- </div> --}}
                </div>
            </div>
            <div class="col card _shadow-1 generalCols notesTarget d-none">
                <h2>Notes</h2>
                <div class="mybody mb-1">
                    <table id="property-notes-datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width: 70px">Id</th>
                                <th>Note</th>
                                <th style="width: 60px">Created At</th>
                                <th style="width: 50px">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <hr>
                <div class="mybody">
                    <h5 class="mt-0">Add Note</h5>
                    <div class="row">
                        <form method="POST" action="{{ route('property.note.store') }}">
                            @csrf
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-9 mb-md-0 mb-2">
                                        <textarea name="text" id="text" rows="3" class="form-control" required></textarea>
                                    </div>
                                    <div class="col-md-3 ps-lg-0 ps-md-0">
                                        <button class="w-100 my-0 btn _btn-primary">
                                            Add Note
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col card _shadow-1 generalCols emailTarget d-none">
                <h2>Email</h2>
                <a href="{{route('property.createpropertyEmail',['id'=>\Illuminate\Support\Facades\Crypt::encrypt($property->id)])}}" class="btn btn-sm _btn-primary float-end sendEmailBtn">Send Email</a>
                <table id="email-lead-data" class="table table-bordered display nowrap w-100" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>SUBJECT</th>
                            <th>CC</th>
                            <th>BODY</th>
                            <th>ATTACHMENT</th>
                            <th>DATE</th>
                            <th>TIME</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(sizeOf($emailDatas))
                        @foreach ($emailDatas as $emailD)
                        <tr>
                            <td>{{$emailD->id}}</td>
                            <td>{{$emailD->to_subject}}</td>
                            <td>{{isset($emailD->to_cc) ? $emailD->to_cc : "N/A"}}</td>
                            <td><div class="elep">{!!strip_tags($emailD->to_body)!!}</div></td>
                            <td>
                                <div class="d-flex flex-column">
                                @if(sizeOf(json_decode($emailD->attechments)))
                                    @foreach (json_decode($emailD->attechments) as $key => $filesD)
                                    <a href="{{$filesD->url}}" target="_blank">{{$filesD->name}}</a>
                                    @endforeach
                                    @else
                                    N/A
                                    @endif
                                </div>
                            </td>
                            <td>{{date('d/m/Y',strtotime($emailD->send_date))}}</td>
                            @php
                                $timestamp = strtotime($emailD->send_date);
                            @endphp
                            <td>
                                @if ($timestamp && date('Y-m-d H:i:s', $timestamp) === $emailD->send_date)
                                    {{date('g:i A',strtotime($emailD->send_date))}}
                                @else
                                    {{date('g:i A',strtotime($emailD->created_at))}}
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="{{route('property.propertyViewEmail',['id'=>\Illuminate\Support\Facades\Crypt::encrypt($emailD->id)])}}" class="_btn-primary" style="padding: 4px 10px;">View</a>
                                    {{-- <a href="{{url('/delete-email?id='.$emailD->id)}}"><i class="fas fa-trash"></i></a> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col card _shadow-1 generalCols apmntTarget d-none">
                <h2>Appointments</h2>
                @if (sizeOf($appointments))
                <div class="card my-1 row pl-2 pt-2 pb-1" id="appointmentboxess"
                    style="border: unset !important; border-top:1px solid #E2E8ED !important;box-shadow: unset !important;border-radius: unset !important;">
                    @foreach ($appointments as $appointment)
                    @php
                        if($appointment['appointment_contractors'] != null){
                            $decode = json_decode($appointment['appointment_contractors']);
                            if(sizeOf($decode)){
                                foreach($decode as $dcd){
                                    $textNames[] = $dcd->full_name;
                                }
                                $implodeName = implode(', ', $textNames);
                            }else{
                                $implodeName = "N/A";
                            }
                        }
                    @endphp
                        <div class="mb-2 col-sm-12 col-lg-6 col-md-6 appointmentboxes" role="alert">

                            <div class="d-flex justify-content-between align-items-center py-0">
                                <a aria-hidden="true" class="text-blues"
                                    href="{{ route('property.deleteAppointment', $appointment['id']) }}"
                                    onClick="return confirm(`Are you sure you want to delete?`)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </div>
                            <div class=" mt-1 d-flex flex-column">
                                {{-- <h5 class="mb-2 alert-heading my-0 py-0" style="width: 93%;">{{ $appointment['subject'] }}</h5> --}}
                                @if($appointment['appointment_desc'] != "" && $appointment['appointment_desc'] != null)
                                <p class="mb-0 alert-heading my-0 py-0"><b>Additional Information:</b> {{ $appointment['appointment_desc'] }}</p>
                                @endif
                                @if($appointment['appointment_status'] == "other")
                                <p class="mb-0 alert-heading my-0 py-0"><b>Other:</b> {{ $appointment['appointment_other'] }}</p>
                                @endif
                                <p class="mb-0 alert-heading my-0 py-0"><b>Location:</b> {{ $appointment['location'] }}</p>
                                @if($implodeName != "N/A")
                                <p class="mb-0 alert-heading my-0 py-0"><b>Team member:</b> {{ $implodeName }}</p>
                                @endif
                                @if ($appointment['status'] == 'Rejected')
                                <p class="mb-0 alert-heading my-0 py-0"><b>Reason:</b> {{ $appointment['reason'] }}</p>
                                @endif
                            </div>
                            <div class=" mt-1 d-flex justify-content-between align-items-end">
                                <span>Date:
                                    {{ date('d/m/Y', strtotime($appointment['due_date'])) . ' ' . date('h:i A', strtotime($appointment['due_time'])) }}</span>
                                <div class="d-flex flex-column" style="gap:5px;">
                                <span
                                    class="clickStatusChange2 text-capitalize @if ($appointment['appointment_status'] == 'lead') compl @else inprog @endif"
                                    data-id="{{ $appointment['id'] }}" data-status="{{ $appointment['appointment_status'] }}" data-other="{{ $appointment['appointment_other'] }}"
                                    style="padding: 3px 13px;" data-toggle="modal" data-target="#changeAppModal">
                                    {{$appointment['appointment_status']}}
                                </span>
                                <input type="hidden" id="hidR_{{$appointment['id']}}" value="{{$appointment['reason']}}">
                                <span
                                        class="clickStatusChange3 @if ($appointment['status'] == 'Accepted') compl @else inprog @endif"
                                        data-id="{{ $appointment['id'] }}" data-status="{{ $appointment['status'] }}"
                                        style="padding: 3px 13px;" data-toggle="modal" data-target="#changeAppModal2">
                                        @if ($appointment['status'] == 'Accepted')
                                            Accepted
                                        @else
                                            Rejected
                                        @endif
                                </span>
                            </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                @else
                <div class="card my-1 row pl-2 pt-2 pb-1" id="appointmentboxess"
                    style="border: unset !important; border-top:1px solid #E2E8ED !important;box-shadow: unset !important;border-radius: unset !important;">
                </div>
                <div class="noappoint-div card _shadow-2 my-1 measureBox mb-3">
                    <span style="margin: 15px auto;">No appointments added yet.</span>
                </div>
                @endif
            <hr class="mt-0">
            <h5 class="mt-0">Add Appointment</h5>
            <div class="row ">
                <form id="third-party-formss2" method="POST" enctype="multipart/form-data"
                    action="{{ route('property.createAppointment') }}">
                    @csrf

                    <input type="hidden" name="property_id" id="reminder_property_id" value="{{ $property->id }}">
                    <div class="row">
                        <div class="d-flex flex-sm-row flex-column">
                            <input type="hidden" class="my-1 form-control" name="subject" id="subject" value="subject" placeholder="Subject">
                            <div class="col ps-md-2 ps-sm-0 ">
                                <select name="appointment_status" id="appointment_status" class="form-control appointment_status my-1">
                                    <option value="">Select Type</option>
                                    <option value="call">Call</option>
                                    <option value="survey">Survey</option>
                                    <option value="visit">Visit</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col ps-md-2 ps-sm-0 appointment_other d-none">
                                <input type="text" class="my-1 form-control" name="appointment_other"
                                id="appointment_other" placeholder="Other Details"></div>
                            <div class="col ps-md-2 ps-sm-0 d-none"><input type="hidden" class="my-1 form-control" name="location"
                                id="location" placeholder="Location" value="{{ format_address(
                                    $property->house_num,
                                    $property->address1,
                                    $property->address2,
                                    $property->address3,
                                    $property->county,
                                    $property->eircode,
                                ) }}"></div>
                                <div class="col ps-md-2 ps-sm-0 ">
                                    <textarea class="my-1 form-control" name="appointment_desc" id="appointment_desc" cols="30" rows="1"
                                        placeholder="Additional Information"></textarea>
                                </div>
                                <div class="col ps-md-2 ps-sm-0">
                                    <div class="select2-containexr">
                                        <select name="appointment_contractors[]" id="appointment_contractors" class="form-control appointment_contractors mt-1" multiple="multiple">
                                            @foreach ($surveyors as $surveyor)
                                            <option value="{{ $surveyor['user_id'] }}" class="input-sm form-control">
                                                {{ $surveyor['full_name'] }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex flex-sm-row flex-column">
                            <div class="col ps-md-2 ps-sm-0">
                                <select name="appointment_status1" id="appointment_status1" class="appointment_status1 form-control my-1">
                                    <option value="">Select status</option>
                                    <option value="Accepted" selected>Accepted</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="col ps-md-2 ps-sm-0 appointment_status1_reason d-none">
                                <input type="text" class="my-1 form-control" name="appointment_status1_reason"
                                id="appointment_status1_reason" placeholder="Reason"></div>
                            <div class="col ps-md-2 ps-sm-0">
                                <input type="date" class="my-1 form-control" name="due_date"
                                    placeholder="Due date" required>
                            </div>
                            <div class="col ps-md-2 ps-sm-0">
                                <input type="time" class="my-1 form-control" name="due_time"
                                    placeholder="Due time">
                            </div>
                            <div class="col ps-md-2 ps-sm-0">
                                <button class="mt-1 w-100 btn btn-sm _btn-primary float-end" id="add-surveyor-button"
                                    type="submit">Add Appointment
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        <!--Image Editor Modal -->
        <div id="nestMod">

        </div>
        <!--Batch Modal -->
        <div class="modal fade" id="batchModal" tabindex="-1" aria-labelledby="batchModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title" id="exampleModalLabel">Batch Upload</h1>
                            <svg class="modal-cls-btn" data-bs-dismiss="modal" aria-label="Close" width="18"
                                height="17" viewBox="0 0 18 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path id="Arrow Left" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.99335 14.6187C8.38758 15.0511 8.39331 15.7459 8.00006 16.1773C7.60954 16.6056 6.98129 16.611 6.58171 16.1727L0.29715 9.27933C-0.0956605 8.84846 -0.102425 8.15731 0.29715 7.71902L6.58171 0.825611C6.97453 0.394745 7.60682 0.389723 8.00006 0.821065C8.39059 1.24942 8.39192 1.94245 7.99335 2.37964L3.41431 7.4023L16.9975 7.4023C17.5512 7.4023 18 7.88916 18 8.49917C18 9.10496 17.5475 9.59605 16.9975 9.59605L3.41431 9.59605L7.99335 14.6187Z"
                                    fill="#2A2D34" />
                            </svg>
                    </div>
                    <form class="photo-form-save" method="POST" enctype="multipart/form-data" action="{{ route('property.photo.store') }}">
                        @csrf
                        <input type="hidden" class="fk_property_id" name="fk_property_id"
                            value="{{ $property->id }}" required>
                        <input type="hidden" class="fid" name="folder_id" required>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label class="form-label">Select Section</label>
                                <select class="form-select folder_select" name="folder_id"
                                    aria-label="Default select example" required>
                                    @foreach ($folderLists as $folderList)
                                        <option class="folder_id" value="{{ $folderList->id }}">
                                            {{ $folderList->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="upload__img-wrap"></div>
                        </div>
                        <div class="modal-footer">
                            <div class="upload__btn-box">
                                <label class="btn _btn-primary w-100 mt-0 mb-0 sing-img batch-img-btn">
                                    <span>Add Photos/Videos</span>
                                    <input type="file" name="photo_img[]" accept="image/*,video/*"
                                        data-max_length="500" class="upload__inputfile" multiple required>
                                    <div id="fileList"></div>
                                </label>
                            </div>
                            <button type="submit" class="btn action-btn w-100 mt-0 mb-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
         {{-- measure status modal start --}}
        <div class="modal" id="measureModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Measure Status</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="meacid" id="meacid" value="">
                        <input type="hidden" name="meapid" id="meapid" value="">
                        <span id="MeasureText"></span>
                        <div class="form-group">
                            <select name="measureStatus" id="measureStatus" class="form-control">
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Unassigned">Unassigned</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn _btn-primary saveMea">Save</button>
                        <button type="button" class="btn btn-default closeModal"
                            style="background: gray; color: #fff; border-radius: 6px;">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Single Modal -->
        <div class="modal fade" id="singleModal" tabindex="-1" aria-labelledby="singleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title" id="exampleModalLabel">Single Photo/Video Upload</h1>
                            <svg class="modal-cls-btn" data-bs-dismiss="modal" aria-label="Close" width="18"
                                height="17" viewBox="0 0 18 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path id="Arrow Left" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.99335 14.6187C8.38758 15.0511 8.39331 15.7459 8.00006 16.1773C7.60954 16.6056 6.98129 16.611 6.58171 16.1727L0.29715 9.27933C-0.0956605 8.84846 -0.102425 8.15731 0.29715 7.71902L6.58171 0.825611C6.97453 0.394745 7.60682 0.389723 8.00006 0.821065C8.39059 1.24942 8.39192 1.94245 7.99335 2.37964L3.41431 7.4023L16.9975 7.4023C17.5512 7.4023 18 7.88916 18 8.49917C18 9.10496 17.5475 9.59605 16.9975 9.59605L3.41431 9.59605L7.99335 14.6187Z"
                                    fill="#2A2D34" />
                            </svg>
                    </div>
                    <form class="photo-form-save" method="POST" enctype="multipart/form-data" action="{{ route('property.photo.store') }}">
                        @csrf
                        <input type="hidden" class="fk_property_id" name="fk_property_id"
                            value="{{ $property->id }}" required>
                        <input type="hidden" class="fid" name="folder_id" required>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Select Section</label>
                                <select class="form-select folder_select" name="folder_id"
                                    aria-label="Default select example" required>
                                    @foreach ($folderLists as $folderList)
                                        <option class="folder_id" value="{{ $folderList->id }}">
                                            {{ $folderList->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-1 simgprev">
                                <div class="file-wrapper-bg">
                                </div>
                                <div class="file-wrapper">
                                    <input type="file" id="photo_img" accept="image/*,video/*" name="photo_img[]"
                                        required />
                                    <div class="close-btn">×</div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="col-form-label">Add Comment</label>
                                <input type="text" name="photo_comment" class="form-control"
                                    placeholder="Comment">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn _btn-primary w-100 mt-0 mb-0">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Edit Note Modal -->
        <div class="modal fade" id="editNoteModal" tabindex="-1" aria-labelledby="editNoteLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title" id="exampleModalLabel">Edit Note</h1>
                            <svg class="modal-cls-btn" data-bs-dismiss="modal" aria-label="Close" width="18"
                                height="17" viewBox="0 0 18 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path id="Arrow Left" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.99335 14.6187C8.38758 15.0511 8.39331 15.7459 8.00006 16.1773C7.60954 16.6056 6.98129 16.611 6.58171 16.1727L0.29715 9.27933C-0.0956605 8.84846 -0.102425 8.15731 0.29715 7.71902L6.58171 0.825611C6.97453 0.394745 7.60682 0.389723 8.00006 0.821065C8.39059 1.24942 8.39192 1.94245 7.99335 2.37964L3.41431 7.4023L16.9975 7.4023C17.5512 7.4023 18 7.88916 18 8.49917C18 9.10496 17.5475 9.59605 16.9975 9.59605L3.41431 9.59605L7.99335 14.6187Z"
                                    fill="#2A2D34" />
                            </svg>
                    </div>
                    <form method="POST" action="{{ route('property.note.update') }}">
                        @csrf
                        <input type="hidden" name="note_id">
                        <div class="modal-body">
                            <div class="mb-1">
                                <textarea name="text" rows="4" class="form-control enotetxt" placeholder="Note" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn _btn-primary w-100 mt-0 mb-0">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--View Note Modal -->
        <div class="modal fade" id="viewNoteModal" tabindex="-1" aria-labelledby="viewNoteLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title" id="exampleModalLabel">View Note</h1>
                            <svg class="modal-cls-btn" data-bs-dismiss="modal" aria-label="Close" width="18"
                                height="17" viewBox="0 0 18 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path id="Arrow Left" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.99335 14.6187C8.38758 15.0511 8.39331 15.7459 8.00006 16.1773C7.60954 16.6056 6.98129 16.611 6.58171 16.1727L0.29715 9.27933C-0.0956605 8.84846 -0.102425 8.15731 0.29715 7.71902L6.58171 0.825611C6.97453 0.394745 7.60682 0.389723 8.00006 0.821065C8.39059 1.24942 8.39192 1.94245 7.99335 2.37964L3.41431 7.4023L16.9975 7.4023C17.5512 7.4023 18 7.88916 18 8.49917C18 9.10496 17.5475 9.59605 16.9975 9.59605L3.41431 9.59605L7.99335 14.6187Z"
                                    fill="#2A2D34" />
                            </svg>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <textarea name="text" rows="4" class="form-control enotetxt" placeholder="Note" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 85px; right: 0;z-index:1;border:unset;">
        <div class="toast-header" style="background-color:#fee5e5;border-bottom:unset;border-radius:8px;">
          <strong class="mr-auto" style="color: #F10000;">Deleted Successfully</strong>
          <button type="button" class="close toast-cls" data-dismiss="toast" aria-label="Close" style="border: unset;background:unset;">
            <span aria-hidden="true" style="font-size: 18px;">&times;</span>
          </button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script>
        function htmlData(){
                $('#nestMod').empty();
            var html = '';
                html += '<div class="modal fade" id="imageEditorModal" tabindex="-1" role="dialog" aria-labelledby="imageEditorModalLabel" aria-hidden="true" style="z-index: 9999;">';
                html += '<div class="modal-dialog modal-lg" style="max-width:fit-content !important;min-width: 680px !important;" role="document">';
                html += '<div class="modal-content">';
                html += '<div class="modal-body pb-1">';
                html += '<button type="button" class="close closeBtn" id="closeBtn" style="z-index:99;border: unset; background: unset; line-height: 1; font-size: 24px; position: absolute; right: 13px; background: #1A47A3; border-radius: 36px; color: #fff; cursor: pointer;">';
                html += '<span aria-hidden="true">&times;</span>';
                html += '</button>';
                html += '<input type="hidden" name="fname">';
                html += '<canvas id="canvas" class="mb-2"></canvas>';
                html += '<div id="editor-controls">';
                html += '<div class="d-flex justify-content-between align-items-center pt-1 pb-1 mt-1 mb-1">';
                html += '<div class="d-flex align-items-center" style="gap: 5px;">';
                html += '<div class=""><button id="add-text-button" class="btn _btn-primary" style="font-weight:600;background:#fff !important;color:#1A47A3 !important; border:1px solid #1A47A3 !important;">';
                html += '<svg class="me-1" width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">';
                html += '<path d="M6.1237 13.4544C5.77648 13.4544 5.48148 13.3328 5.2387 13.0894C4.99536 12.8466 4.8737 12.5516 4.8737 12.2044V2.62109H1.95703C1.60981 2.62109 1.31481 2.49943 1.07203 2.25609C0.828698 2.01332 0.707031 1.71832 0.707031 1.37109C0.707031 1.02387 0.828698 0.728872 1.07203 0.486094C1.31481 0.242761 1.60981 0.121094 1.95703 0.121094H10.2904C10.6376 0.121094 10.9326 0.242761 11.1754 0.486094C11.4187 0.728872 11.5404 1.02387 11.5404 1.37109C11.5404 1.71832 11.4187 2.01332 11.1754 2.25609C10.9326 2.49943 10.6376 2.62109 10.2904 2.62109H7.3737V12.2044C7.3737 12.5516 7.25203 12.8466 7.0087 13.0894C6.76592 13.3328 6.47092 13.4544 6.1237 13.4544ZM13.6237 13.4544C13.2765 13.4544 12.9815 13.3328 12.7387 13.0894C12.4954 12.8466 12.3737 12.5516 12.3737 12.2044V6.78776H11.1237C10.7765 6.78776 10.4815 6.66609 10.2387 6.42276C9.99536 6.17998 9.8737 5.88498 9.8737 5.53776C9.8737 5.19054 9.99536 4.89554 10.2387 4.65276C10.4815 4.40943 10.7765 4.28776 11.1237 4.28776H16.1237C16.4709 4.28776 16.7659 4.40943 17.0087 4.65276C17.252 4.89554 17.3737 5.19054 17.3737 5.53776C17.3737 5.88498 17.252 6.17998 17.0087 6.42276C16.7659 6.66609 16.4709 6.78776 16.1237 6.78776H14.8737V12.2044C14.8737 12.5516 14.752 12.8466 14.5087 13.0894C14.2659 13.3328 13.9709 13.4544 13.6237 13.4544Z" fill="#1A47A3"/>';
                html += '</svg>';
                html += 'Add Text</button>';
                html += '</div>';
                html += '<div class="d-none"><button id="remove-text-button" style="font-weight:600;background-color: #fff !important;color:#D33737 !important;border:1px solid #D33737 !important"class="btn _btn-primary">';
                html += '<svg class="me-1" width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
                html += '<path d="M1.45052 13.6224C1.45052 14.5391 2.20052 15.2891 3.11719 15.2891H9.78385C10.7005 15.2891 11.4505 14.5391 11.4505 13.6224V3.6224H1.45052V13.6224ZM12.2839 1.1224H9.36719L8.53385 0.289062H4.36719L3.53385 1.1224H0.617188V2.78906H12.2839V1.1224Z" fill="#D33737"/>';
                html += '</svg>';
                html += 'Remove Text</button></div>';
                html += '</div>';
                html += '<div class="d-flex align-items-center font-div flex-column">';
                html += '<div class="d-none"><label for="font-size">Font Size&nbsp;&nbsp;:</label>';
                html += '<input type="range" id="font-size" min="0" max="7" step="1" value="0" style="width:180px;accent-color:#1A47A3;position: relative;"></div>';
                html += '<div class="d-none"><label for="font-color">Font Color:</label>';
                html += '<input type="range" id="font-color" min="0" max="4" step="1" value="0" style="width:180px;accent-color:#1A47A3;position: relative;"></div>';
                html += '</div>';
                html += '<div class="">';
                html += '<button type="button" class="btn btn-primary btn _btn-primary" id="saveBtn">Save changes</button>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $('#nestMod').append(html);
        }
    $(document).on('click','.viewTimeSheet', function(){
        $('#singInImgs').empty();
        $('#singOutImgs').empty();
        var datas = JSON.parse($(this).attr('data-collection'));

            var baseUrl = 'https://futurefit.bcrcomply.com';
            var signUrl = baseUrl+'/signinout_signature/';
            var inoutUrl = baseUrl+'/public/futurefitapi/public/assets/uploads/user_signinout/';
            $('#sheetName').text(datas.users.full_name+' - Timesheet');
            if(datas.sign_date != null){$('#Indate').val(formatDate5(datas.sign_date,'d/m/Y'));}else{$('#Indate').val("N/A");}
            if(datas.sign_time != null){$('#Intime').val(convertTo12Hour(datas.sign_time));}else{$('#Intime').val("N/A");}
            if(datas.sign_e_date != null){$('#Outdate').val(formatDate5(datas.sign_e_date,'d/m/Y'));}else{$('#Outdate').val("N/A");}
            if(datas.sign_e_time != null){$('#Outtime').val(convertTo12Hour(datas.sign_e_time));}else{$('#Outtime').val("N/A");}
            $('#InDetails').val(datas.text);
            $('#OutDetails').val(datas.signout_text);
            var html1 = '<div class="row bg-messi mx-0">';
            for (var i = 1; i <= 10; i++) {
                var signinImage = datas['signin_image' + i]; // Dynamically construct the variable name
                if (signinImage && signinImage.trim() !== '') {
                    var photoPath = inoutUrl + signinImage;
                    html1 += '<div class="col-sm-12 col-md-4 col-lg-4 py-0 px-0 d-flex justify-content-start" style="max-width: fit-content;">';
                    html1 += '<img class="me-1 mb-1 mt-1 img-fluid" style="max-height: 150px; border-radius: 6px; page-break-inside: avoid !important;" src="' + photoPath + '">';
                    html1 += '</div>';
                }
            }
            html1 += '</div>';
            $('#singInImgs').append(html1);

            var html2 = '<div class="row bg-messi mx-0">';
            for (var i = 1; i <= 10; i++) {
                var signinImage = datas['signout_image' + i]; // Dynamically construct the variable name
                if (signinImage && signinImage.trim() !== '') {
                    var photoPath2 = inoutUrl + signinImage;
                    html2 += '<div class="col-sm-12 col-md-4 col-lg-4 py-0 px-0 d-flex justify-content-start" style="max-width: fit-content;">';
                    html2 += '<img class="me-1 mb-1 img-fluid" style="max-height: 150px; border-radius: 6px; page-break-inside: avoid !important;" src="' + photoPath2 + '">';
                    html2 += '</div>';
                }
            }
            html2 += '</div>';
            $('#singOutImgs').append(html2);
            if(datas.signature != null){
                $('#signInSign').attr('src',(signUrl+'/'+datas.signature));
                $('#signInSign').removeClass('d-none');
            }else{
                $('#signInSign').attr('src','');
                $('#signInSign').addClass('d-none');
            }
            if(datas.signout_signature != null){
                $('#signoutSign').attr('src',(signUrl+'/'+datas.signout_signature));
                $('#signoutSign').removeClass('d-none');
            }else{
                $('#signoutSign').attr('src','');
                $('#signoutSign').addClass('d-none');
            }
        $('.timesheetChildTarget').removeClass('d-none');
        $('.timesheetTarget').addClass('d-none');
    });
    $(document).on('click','.closeTimesheet', function(){
        $('.timesheetChildTarget').addClass('d-none');
        $('.timesheetTarget').removeClass('d-none');
    });
        $(document).on('click', '.propcsv11', function() {
            if (!$('.propcart11').hasClass('d-none')) {
                $('.propcart11').addClass('d-none');
                $(this).parent('.card-header').addClass('borderBottomRedius');
                $('.propcsv111').addClass('trans180');
                $('.propcsv11').css({
                    'color': '#6c757d'
                });
            } else {
                $(this).parent('.card-header').removeClass('borderBottomRedius');
                $('.propcart11').removeClass('d-none');
                $('.propcsv111').removeClass('trans180');
                $('.propcsv11').css({
                    'color': '#1A47A3'
                });

            }
        });
        $(document).on('click', '.propcsv12', function() {
            if (!$('.propcart12').hasClass('d-none')) {
                $('.propcart12').addClass('d-none');
                $(this).parent('.card-header').addClass('borderBottomRedius');
                $('.propcsv112').addClass('trans180');
                $('.propcsv12').css({
                    'color': '#6c757d'
                });
            } else {
                $(this).parent('.card-header').removeClass('borderBottomRedius');
                $('.propcart12').removeClass('d-none');
                $('.propcsv112').removeClass('trans180');
                $('.propcsv12').css({
                    'color': '#1A47A3'
                });

            }
        });
        $(document).on('click', '.toolboxdiv', function() {
            if (!$('.toolboxdiv11').hasClass('d-none')) {
                $('.toolboxdiv11').addClass('d-none');
                $(this).parent('.card-header').addClass('borderBottomRedius');
                $('.toolboxdiv1').addClass('trans180');
                $('.toolboxdiv').css({
                    'color': '#6c757d'
                });
            } else {
                $(this).parent('.card-header').removeClass('borderBottomRedius');
                $('.toolboxdiv11').removeClass('d-none');
                $('.toolboxdiv1').removeClass('trans180');
                $('.toolboxdiv').css({
                    'color': '#1A47A3'
                });

            }
        });

        function showConfirmation(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            if (selectedOption.value && confirm(`Are you sure, you want to add '${selectedOption.text}' measure?`)) {
                selectElement.form.submit();
            }
        }

        function formatDate5(dateString) {
            var options = {
                month: '2-digit',
                day: '2-digit',
                year: 'numeric'
            };
            var formattedDate = new Date(dateString).toLocaleDateString('en-GB', options);
            return formattedDate.replace(/(\d+)\/(\d+)\/(\d+)/, '$1/$2/$3');
        }

        // Function to convert data URI to Blob
        function dataURItoBlob(dataURI) {
            var byteString = atob(dataURI.split(',')[1]);
            var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
            var ab = new ArrayBuffer(byteString.length);
            var ia = new Uint8Array(ab);
            for (var i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            return new Blob([ab], { type: mimeString });
        }

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            function ajaxReminderCall2() {
                var propId = "{{ $property->id }}";
                $.ajax({
                    url: "/check-reminder?id=" + propId, // Replace with your actual API endpoint
                    type: 'GET',
                    success: function(response) {
                        var data = response.data;
                        if (response.success == true) {
                            // $('.appnedLiP').empty();
                            $('.psremlis').empty();
                            var html2 = '';
                            var sumIsRead = 0;
                           var rlist = $.each(data, function(i, v) {
                                if (v.is_read == 1) {
                                    sumIsRead++;
                                }
                                html2 += '<div class="psremlis" style="max-height: 282px;">';
                                html2 += '<li class="myremListD">';
                                html2 += '<div class="dropdown-item myremList" data-id="' + v.id +
                                    '" style="color:#1A47A3">';
                                html2 += '<div class="d-flex justify-content-between">';
                                html2 +=
                                    '<h5 style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;max-width: 50%;"><b>' +
                                    v.title + '</b></h5>';
                                html2 += '<a aria-hidden="true" class="text-bluess" href="' +
                                    '{{ route('property.deleteReminder', '') }}/' + v.id +
                                    '" style="color: #D33737;font-size: 16px;left: 2px;top: 3px;position: relative;" onClick="return confirm(Are you sure you want to delete?)"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                                html2 += '</div>';
                                html2 += '<div class="parent" style="text-overflow: ellipsis;overflow: hidden;">';
                                html2 += '<p style="text-overflow: ellipsis;overflow: hidden;">' + v.notes + '</p>';
                                html2 += '</div>';
                                html2 += '<div class="d-flex justify-content-between">';
                                html2 += '<div><b>Due:</b>' + formatDate5(v.due_date, 'd/m/Y') + ' ' +
                                    convertTo12Hour(v.due_time) + '</div>';
                                html2 += '<div><small><span class="' + (v.status == 'Complete' ?
                                        'compl' : 'inprog') + '" style="padding: 2px 8px;">' + (v
                                        .status == 'Complete' ? 'Complete' : 'Pending') +
                                    '</span></small></div>';
                                html2 += '</div>';
                                html2 += '</div>';
                                html2 += '</li>';
                                html2 += '</div>';
                            });
                            $('.showallm2').remove();
                            if (rlist === 0) {
                                $('<span style="margin: 15px auto;font-size: 15px;font-weight: 600;color: #1A47A3;width: -webkit-fill-available;text-align: center;text-decoration: underline;float: unset !important;height:23px !important;" class="filterSidebar showallm showallm2 mb-2" data-atr="rem">View All Reminders</span>')
                                    .insertAfter(rdiv);
                            } else {
                                $('.appnedLiP').append('<span style="margin: 15px auto;font-size: 15px;font-weight: 600;color: #1A47A3;width: -webkit-fill-available;text-align: center;text-decoration: underline;float: unset !important;height:23px !important;" class="filterSidebar showallm showallm2 mb-2" data-atr="rem">View All Reminders</span>');
                            }
                            var rdiv = $('.psremlis').prepend(html2);
                            // if (sumIsRead > 0) {
                            //     $('<span style="margin: 15px auto;font-size: 15px;font-weight: 600;color: #1A47A3;width: -webkit-fill-available;text-align: center;text-decoration: underline;float: unset !important;height:23px !important;" class="filterSidebar showallm showallm2 mb-2" data-atr="rem">View All Reminders</span>')
                            //         .insertAfter(rdiv);
                            // } else {
                            //     $('.appnedLiP').append('<span style="margin: 15px auto;font-size: 15px;font-weight: 600;color: #1A47A3;width: -webkit-fill-available;text-align: center;text-decoration: underline;float: unset !important;height:23px !important;" class="filterSidebar showallm showallm2 mb-2" data-atr="rem">View All Reminders</span>');
                            // }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', status, error);
                    }
                });
            }
            setInterval(ajaxReminderCall2, 60000);
            const dt1 = new DataTransfer();
            $('.upload__inputfile').change(function() {
                // Adding files to the DataTransfer object
                for (let file of this.files) {
                    dt1.items.add(file);
                }
                // Update input file files after addition
                this.files = dt1.files;
            });

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    e.stopPropagation();
                e.preventDefault();htmlData();
                    var canvas = new fabric.Canvas('canvas');

                    $('#add-text-button').click(function() {
                    var text = "New Text Here";
                    if (text) {
                        var canvasWidth = canvas.getWidth();
                        var canvasHeight = canvas.getHeight();
                        var fontSizeM = Math.min(canvasWidth, canvasHeight) * 0.05;

                        // Create new text object
                        var newText = new fabric.IText(text, {
                            fontFamily: 'Arial',  // Or use desired font family
                            fill: '#000',
                            editable: true,
                            fontSize: fontSizeM,
                            backgroundColor: 'rgba(222, 222, 222, 0.8)', // White background with 50% opacity
                            borderColor: '#1A47A3', // Border color
                        });

                        // Calculate text box dimensions
                        var textBoxWidth = newText.width * newText.scaleX;
                        var textBoxHeight = newText.height * newText.scaleY;

                        // Set text object position to center of canvas
                        newText.set({
                            left: (canvasWidth - textBoxWidth) / 2,
                            top: (canvasHeight - textBoxHeight) / 2
                        });
                        $('#font-size').val('0');
                        newText.hiddenTextareaContainer = canvas.lowerCanvasEl.parentNode;
                        canvas.add(newText);

                        canvas.renderAll();
                        $(window).scrollTop(0);
                    }
                });
                canvas.on('selection:created', function() {
                    $('#remove-text-button').parent().removeClass("d-none");
                    $('#font-size').parent().removeClass("d-none");
                    $('#font-color').parent().removeClass("d-none");
                    $('#remove-text-button').parent().addClass("d-flex");
                    $('#font-size').parent().addClass("d-flex");
                    $('#font-color').parent().addClass("d-flex");
                });
                canvas.on('selection:cleared', function() {
                    $('#remove-text-button').parent().addClass("d-none");
                    $('#font-size').parent().addClass("d-none");
                    $('#font-color').parent().addClass("d-none");
                    $('#remove-text-button').parent().removeClass("d-flex");
                    $('#font-size').parent().removeClass("d-flex");
                    $('#font-color').parent().removeClass("d-flex");
                });
                        $('#font-size').change(function() {
                            var thisSize = $(this).val();
                        // Get the selected font size value
                        var selectedFontSizeIndex = parseInt(thisSize);
                        var selectedObject = canvas.getActiveObject();

                        if (selectedObject && selectedObject.type === 'i-text') {
                            var canvasWidth = canvas.getWidth();
                            var canvasHeight = canvas.getHeight();
                            var fontSizeM = Math.min(canvasWidth, canvasHeight) * 0.05;
                            var fontSizes = [fontSizeM + 4, fontSizeM + 8, fontSizeM + 12, fontSizeM + 16, fontSizeM + 20, fontSizeM + 24, fontSizeM + 28, fontSizeM + 32];
                            var fontSize = fontSizes[selectedFontSizeIndex];

                            if (selectedObject instanceof fabric.Text) {
                                selectedObject.set('fontSize', fontSize); // Set the font size directly
                                canvas.renderAll();
                                $(window).scrollTop(0);
                            }
                        }
                    });

                    // Font color change event listener
                    document.getElementById('font-color').addEventListener('change', function() {
                        var selectedObject = canvas.getActiveObject();
                        if (selectedObject && selectedObject.type === 'i-text') {
                            var colors = ['#000000', '#FF0000', '#00FF00', '#0000FF', '#FFF'];

                            var color = colors[this.value];
                            if (selectedObject instanceof fabric.Text) {
                                selectedObject.set('fill', color);
                                canvas.renderAll();
                                $(window).scrollTop(0);
                            }
                        }
                    });
                    document.getElementById('remove-text-button').addEventListener('click', removeSelectedText);
                    function removeSelectedText() {
                        var activeObject = canvas.getActiveObject();
                        if (activeObject && activeObject.type === 'i-text') {
                            canvas.remove(activeObject);
                            canvas.discardActiveObject();
                            canvas.renderAll();
                            $(window).scrollTop(0);
                        }
                    }
                    $('.upload__img-wrap').html('');
                    var maxLength = $(this).attr('data-max_length');
                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);

                    // if (e.target.files.length > 19) {
                    //     alert('Maximum 20 files per upload');
                    //     return;
                    // }
                    filesArr.forEach(function(f, index) {
                        var fileType = f.type.split('/')[0]; // Get the file type (image or video)

                        if (fileType !== 'image' && fileType !== 'video') {
                            alert('Invalid file type: Only images and videos are allowed.');
                            $('.upload__inputfile').val(null);
                            return;
                        }

                        if (imgArray.length >= maxLength) {
                            alert('Maximum number of files exceeded.');
                            return false;
                        } else {
                            imgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html = '';
                                if (fileType === 'image') {
                                    html =
                                        "<div class='upload__img-box m-1'><div style='background-image: url(" +
                                        e.target.result + ")' data-number='" + $(
                                            ".upload__img-close").length + "' class='img-bg image-link' data-name='" + f.name + "'><div class='upload__img-close' data-name='" + f.name + "'></div></div></div>";
                                } else if (fileType === 'video') {
                                    html =
                                        "<div class='upload__img-box m-1'><div data-number='" +
                                        $(".upload__img-close").length + "' class='img-bg'><video style='width:60px;' src='" + e.target
                                        .result +
                                        "'></video><div class='upload__img-close videoClose1' data-name='" + f.name + "'></div></div></div>";
                                }
                                $('.upload__img-wrap').append(html);
                            }
                            reader.readAsDataURL(f);
                        }
                    });

                    $(document).on('click','.image-link', function() {
                        var name = $(this).attr("data-name");
                        $('input[name="fname"]').val(name);
                        var imgSrc = $(this).css('background-image').replace(/url\(['"]?(.*?)['"]?\)/i, "$1");
                        if(imgSrc != "none"){
                        $(this).addClass('selected');
                        loadImageToCanvas(imgSrc, canvas);
                        $('#imageEditorModal').modal('show');
                        }

                    });

                    $(document).on('click','#saveBtn', function() {
                        // Get the edited image data from the canvas
                        var editedImageData = canvas.toDataURL({ format: 'png',quality: 1,multiplier: 3 });
                        // Find the corresponding .img-bg element and update its background image
                        var $selectedImage = $('.upload__img-wrap .img-bg.selected');
                        var selectedFilename = $selectedImage.data('file');

                        var name = $('input[name="fname"]').val();
                        for (let i = 0; i < dt1.items.length; i++) {
                            // Matching file and name
                            if (name == dt1.items[i].getAsFile().name) {
                                // Update the DataTransfer object with edited image data
                                var blob = dataURItoBlob(editedImageData);
                                var file = new File([blob], name);
                                dt1.items.remove(i);
                                dt1.items.add(file);
                                document.getElementsByClassName('.upload__inputfile').files = dt1.files;
                            }
                        }

                        if ($selectedImage.length > 0) {
                            $selectedImage.css('background-image', 'url(' + editedImageData + ')');
                            $selectedImage.removeClass('selected');
                        }
                        // Close the modal
                        $('#imageEditorModal').modal('hide');
                    });
                    $(document).on('click','.closeBtn', function() {
                        var $selectedImage = $('.upload__img-wrap .img-bg.selected');
                        $selectedImage.removeClass('selected');
                        // Close the modal
                        $('#imageEditorModal').modal('hide');
                    });
                });

            });

            $('body').on('click', ".upload__img-close", function(e) {
                e.stopPropagation();
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
                var name = $(this).attr("data-name");
                for (let i = 0; i < dt1.items.length; i++) {
                    // Matching file and name
                    if (name == dt1.items[i].getAsFile().name) {
                        // Delete the file in the DataTransfer object
                        dt1.items.remove(i);
                        continue;
                    }
                }
                // Update input file files after deletion
                document.getElementsByClassName('.upload__inputfile').files = dt1.files;
            });
        }

        // function loadImageToCanvas(imgSrc, canvas) {
        //     const maxWidth = window.innerWidth * 0.8;
        //     const maxHeight = window.innerHeight * 0.78;
        //     fabric.Image.fromURL(imgSrc, function(img) {
        //         canvas.clear();
        //         var imgWidth = img.width;
        //         var imgHeight = img.height;

        //         // Calculate scale factors based on limited dimensions
        //         var scaleX = Math.min(maxWidth / imgWidth, 1);
        //         var scaleY = Math.min(maxHeight / imgHeight, 1);
        //         var scaleFactor = Math.min(scaleX, scaleY);

        //         // Set canvas dimensions based on scaled image size
        //         canvas.setWidth(imgWidth * scaleFactor);
        //         canvas.setHeight(imgHeight * scaleFactor);

        //         // Ensure canvas dimensions don't exceed maximums
        //         canvas.setWidth(Math.min(canvas.width, maxWidth));
        //         canvas.setHeight(Math.min(canvas.height, maxHeight));

        //         // Set scaled dimensions and position the image at the center
        //         img.scale(scaleFactor);
        //         canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
        //     });
        // }
        function loadImageToCanvas(imgSrc, canvas) {
        const maxWidth = window.innerWidth * 0.8;
        const maxHeight = window.innerHeight * 0.78;
        const ASPECT_RATIO_TOLERANCE = 0.01; // Adjust tolerance as needed (smaller = stricter)

        fabric.Image.fromURL(imgSrc, function(img) {
            canvas.clear();
            const imgWidth = img.width;
            const imgHeight = img.height;
            // Calculate initial scale factors
            const initialScaleX = Math.min(maxWidth / imgWidth, 1);
            const initialScaleY = Math.min(maxHeight / imgHeight, 1);
            // Calculate maximum allowed scale factor while maintaining aspect ratio
            const maxScale = Math.min(maxWidth / imgWidth, maxHeight / imgHeight);
            // Check if initial scaling would distort aspect ratio beyond tolerance
            const initialAspectRatio = imgWidth / imgHeight;
            const scaledAspectRatio = (imgWidth * initialScaleX) / (imgHeight * initialScaleY);
            const aspectRatioDifference = Math.abs(initialAspectRatio - scaledAspectRatio);

            let finalScaleFactor;
            if (aspectRatioDifference > ASPECT_RATIO_TOLERANCE) {
            // Use the stricter maxScale to avoid distortion
            finalScaleFactor = maxScale;
            } else {
            // Use the larger of initial scales or maxScale
            finalScaleFactor = Math.max(initialScaleX, initialScaleY, maxScale);
            }
            // Set canvas dimensions based on scaled image size
            canvas.setWidth(imgWidth * finalScaleFactor);
            canvas.setHeight(imgHeight * finalScaleFactor);
            // Ensure canvas dimensions don't exceed maximums
            canvas.setWidth(Math.min(canvas.width, maxWidth));
            canvas.setHeight(Math.min(canvas.height, maxHeight));
            // Set scaled dimensions and position the image at the center
            img.scale(finalScaleFactor);
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
        });
        }


        function generateAdditionalDetails(anchorElement) {
            var type = anchorElement.getAttribute('data-type');
            var imgpath = "{{ asset('assets/images/users/avatar-1.jpg') }}";
            var username = anchorElement.getAttribute('username');
            var dataType = anchorElement.getAttribute('data-type');
            var parts = username.split(' ');
            var initials = '';
            for (var i = 0; i < parts.length; i++) {
                initials += parts[i].substring(0, 1);
            }
            initials = initials.toUpperCase();
            var comment = anchorElement.getAttribute('comment');
            var id = anchorElement.getAttribute('data-id');
            var createdDate = anchorElement.getAttribute('created-date');
            var createdDate1 = anchorElement.getAttribute('created-date1');
            if (createdDate1 == null || createdDate1 == "null" || createdDate1 == "|") {
                var createdDate1 = createdDate;
            }
            var htmlContent = '';
            htmlContent += '<div class="additional-details mfp-prevent-close py-1 px-2">';
            htmlContent += '<div class="d-flex justify-content-between align-items-center mb-3">';
            htmlContent += '<div class="d-flex justify-content-start align-items-center">';
            htmlContent +=
                '<div class="mr-1" style="font-family: Arial, sans-serif; font-size: 24px; color: #fff; background-color: #1A47A3; border-radius: 5px; display: inline-block; margin: 5px;border-radius: 36px; display: flex; align-items: center; justify-content: center;width:60px;height:60px;padding-left:10px;padding-right:10px;">' +
                initials + '</div>';
            htmlContent += '<span class="pl-2"><b>' + username + '</b></span>';
            htmlContent += '</div>';
            htmlContent += '<div class="d-flex flex-column">';
            htmlContent += '<span>Created: ' + createdDate1 + '</span>';
            htmlContent += '<span>Uploaded: ' + createdDate + '</span>';
            htmlContent += '</div>';
            htmlContent += '</div>';
            htmlContent += '<div class="d-flex justify-content-between align-items-center deviders">';
            htmlContent += '<div class="d-flex flex-column">';
            htmlContent += '<span><b>Comment</b></span>';
            htmlContent += '<span id="com-txt">' + comment + '</span>';
            htmlContent += '</div>';
            if(comment != '-') {
                htmlContent += '<button class="btn btn-danger magnific__img-close3 videoClose" style="border-radius: 6px;" data-type="' + dataType +
                '" data-id="' + id + '">Delete Comment';
                htmlContent += `<svg class="ms-1" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1809_9320)">
                                    <path d="M4.0026 12.6667C4.0026 13.4 4.6026 14 5.33594 14H10.6693C11.4026 14 12.0026 13.4 12.0026 12.6667V4.66667H4.0026V12.6667ZM12.6693 2.66667H10.3359L9.66927 2H6.33594L5.66927 2.66667H3.33594V4H12.6693V2.66667Z" fill="white"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_1809_9320">
                                    <rect width="16" height="16" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>`;
                htmlContent += '</button>'
            }
            htmlContent += '</div>';
            if(dataType == "image"){
            htmlContent += '<div class="d-flex justify-content-between align-items-center deviders">';
            htmlContent += '<div class="d-flex flex-column">';
            htmlContent += '</div>';
            htmlContent += '<button class="btn _btn-primary magnific__img-close2" data-type="' + dataType +
                '" data-id="' + id + '">Edit Image';
            htmlContent += `<svg class="ms-1" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1809_9323)">
                                <path d="M2 11.5017V14.0017H4.5L11.8733 6.62833L9.37333 4.12833L2 11.5017ZM13.8067 4.695C14.0667 4.435 14.0667 4.015 13.8067 3.755L12.2467 2.195C11.9867 1.935 11.5667 1.935 11.3067 2.195L10.0867 3.415L12.5867 5.915L13.8067 4.695Z" fill="white"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_1809_9323">
                                <rect width="16" height="16" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>`;
            htmlContent += '</button>'
            htmlContent += '</div>';
            }
            htmlContent += '</div>';

            return htmlContent;
        }

        function getFileExtension(url) {
            return url.split('.').pop().toLowerCase();
        }

        // Function to differentiate between image and video URLs
        function differentiateURL(url) {
            var extension = getFileExtension(url);
            if (extension === 'jpg' || extension === 'png' || extension === 'gif') {
                return 'image';
            } else if (extension === 'mp4' || extension === 'avi' || extension === 'mov' || extension === 'webm') {
                return 'video';
            } else {
                return 'Unknown';
            }
        }
        function inputColorChange() {
            $("#font-color").css('accent-color','#000000')
            var colors = ['#000000', '#FF0000', '#00FF00', '#0000FF', '#FFF']; // Array of colors
            var slider = $("#font-color");

            // Event listener for slider change
            slider.on("input", function() {
                var value = parseInt($(this).val());
                updateThumbColor(value);
            });

            // Function to update slider thumb color
            function updateThumbColor(index) {
                var color = colors[index];
                // Set thumb color dynamically
                slider.css("accent-color", color);
            }
        };
        $(document).ready(function() {
            $('.appointment_contractors').select2({
                placeholder: "Add Team member"
            });
            $(document).on('change','.appointment_status', function (e) {
                var apst = $(this).val();
               if(apst == "other"){
                $('.appointment_other').removeClass('d-none');
               }else{
                $('.appointment_other').addClass('d-none');
               }
            });
            $(document).on('change','.chngSts2', function (e) {
                var apst = $(this).val();
               if(apst == "other"){
                $('.appointment_other2').removeClass('d-none');
               }else{
                $('.appointment_other2').addClass('d-none');
               }
            });
            $(document).on('click', '.editableStatus', function() {
                var status = $(this).attr('data-status');
                var cid = $(this).attr('data-cid');
                var pid = $(this).attr('data-pid');
                var job = $(this).attr('data-job');
                $('#measureStatus').val(status);
                $('#meacid').val(cid);
                $('#meapid').val(pid);
                // $("#MeasureText").text('Are you sure you want to change this measure(' + job + ') status?');
                $("#MeasureText").text('Are you sure you want to change Contractor’s status?');
                $('#measureModal').modal('show');
            });
            $(document).on('click', '.closeModal', function() {
                $('#measureStatus').val('');
                $('#meacid').val('');
                $('#meapid').val('');
                $("#MeasureText").text('');
                $('#measureModal').modal('hide');
            });
            $(document).on('click', '.saveMea', function() {
                var status = $('#measureStatus').val();
                var cid = $('#meacid').val();
                var pid = $('#meapid').val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('updateMeaStatus') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        pid: pid,
                        cid: cid,
                        status: status,
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#measureModal').modal('hide');
                        if (response.success == true) {
                            $('.msgMea-show').text(response.message);
                            $('.msgMea-show').css('color', '#1a47a3');
                            $(".msgMea-show").show();
                            setTimeout(function() {
                                $('.msgMea-show')
                                    .hide();

                            }, 2000);
                            window.location.reload();
                        } else {
                            $('.msgMea-show').text(response.message);

                            $(".msgMea-show").show();
                            setTimeout(function() {
                                $('.msgMea-show')
                                    .hide();

                            }, 2000);
                            window.location.reload();
                        }
                    }
                });
            });
            $(document).on('submit','.photo-form-save', function (e) {
                var selectedOptionText = $(this).find('.folder_select option:selected').text().trim();;
                var selectedOptionId = $(this).find('.folder_select').val();

               localStorage.setItem('selectedfilesec', selectedOptionId);
                localStorage.setItem('selectedfilename', selectedOptionText);
            });

            $(document).on('show.bs.modal','#imageEditorModal', function (e) {
                inputColorChange();
            })
            $('#remove-text-button').attr("disabled", true);
            $('#font-size').attr("disabled", true);
            $('#font-color').attr("disabled", true);

            $(document).on('click','.enotebtn', function (e) {
                var v_token = "{{ csrf_token() }}";
                var noteId = $(this).attr("data-nid");
                $('input[name="note_id"]').val(noteId);
                $('input[name="_token"]').val(v_token);

                $.ajax({
                    type: 'GET',
                    url: '/dashboard/property/note/edit/'+ noteId,
                    success: function(data) {
                        $('.enotetxt').val(data.data['text'])
                    }
                });
            });

            $(document).on('click','.vnotebtn', function (e) {
                var noteId = $(this).attr("data-nid");
                $('input[name="note_id"]').val(noteId);
                $.ajax({
                    type: 'GET',
                    url: '/dashboard/property/note/edit/'+ noteId,
                    success: function(data) {
                        $('.enotetxt').val(data.data['text'])
                    }
                });
            });

            $('#editNoteModal').on('hidden.bs.modal', function() {
                $(this).find("input,textarea").val('').end().find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
            });

            $(".action-btn").on("click", function() {
                $(this).css('color', 'transparent important');
                if ($('.upload__inputfile').val() != '' && $('.upload__inputfile').val() != null) {
                    $(this).addClass("loading");
                }
            });

            $('.msg-show').hide();
            ImgUpload();
            $('.multiple-ubtn').click(function() {
                var v_token = "{{ csrf_token() }}";
                var proId = $(this).attr("data-pro_id");
                $('.fk_property_id').val(proId);
                $('input[name="_token"]').val(v_token);
            });
            $('.folder_select').change(function() {
                $('.fid').val($(this).find(":selected").val());
            });
            $('#batchModal').on('hidden.bs.modal', function() {
                $(this)
                    .find("input,textarea")
                    .val('')
                    .end()
                    .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
                $('.upload__img-wrap').html('');
                $('.upload__inputfile').val(null);
            });
            $('#singleModal').on('hidden.bs.modal', function() {
                $(this)
                    .find("input,textarea")
                    .val('')
                    .end()
                    .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
                $('.upload__img-wrap').html('');
                $('.close-btn').click();
            });

            $('.file').click(function() {
                var proId = $(this).attr("data-pro_id");
                var secId = $(this).attr('data-sec_id');
                localStorage.setItem('selectedfilesec', secId);
                localStorage.setItem('selectedfilepro', proId);
                var folder = $(this).children('.file-txt').children('span').text();
                localStorage.setItem('selectedfilename', folder);

                var url = '/dashboard/property/photo/get/' + proId + '/' + secId + '';
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        var imgs = data.data;
                        var groupedData = {};
                        $.each(imgs, function(index, item) {

                            var key = formatDate5(item.created_at, 'd/m/Y');
                            if (!groupedData[key]) {
                                groupedData[key] = [];
                            }
                            groupedData[key].push(item);
                        });
                        $(".folder-photos").html('');
                        $.each(groupedData, function(b, v) {
                            $(".folder-photos").append('<h4>' + b +
                                '</h4><section class="img-gallery-magnific img-gallery-magnific-'+b.replace(/\//g, "-")+'">');
                            v.forEach(function(f, i) {
                                var dataType = differentiateURL(f.image_path);
                                if (dataType === 'video') {
                                    mediaContent =
                                        `<video src="${f.image_path}" style="border-top-left-radius: 6px; border-top-right-radius: 6px;"></video>`;
                                } else {
                                    mediaContent =
                                        `<img src="${f.image_path}"/>`;
                                }
                                var newCls = "img-gallery-magnific-"+b.replace(/\//g, "-");
                                if (f.comment != "") {
                                    $("."+newCls).append(`<div class="magnific-img mb-3">
                                    <a class="image-popup-vertical-fit m-1" data-id="${f.id}" href="${f.image_path}" data-type="${dataType}" username="${f.full_name}" comment="${f.comment}" created-date="${f.date_added}" created-date1="${f.date_created}">
                                        ${mediaContent}
                                    </a>
                                    <div class="magnific__img-close ${dataType === 'video' ? 'videoClose' : ''}" data-type="${dataType}" data-id="${f.id}">
                                    </div>
                                    <div class="overlay ${dataType === 'video' ? 'videoOverlay' : ''}">${f.date_created}</div>
                                    ${dataType === 'video' ? '<svg class="play-icon" width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M21.409 9.35331C21.8893 9.60872 22.291 9.99 22.5712 10.4563C22.8514 10.9226 22.9994 11.4563 22.9994 12.0003C22.9994 12.5443 22.8514 13.078 22.5712 13.5443C22.291 14.0106 21.8893 14.3919 21.409 14.6473L8.597 21.6143C6.534 22.7373 4 21.2773 4 18.9683V5.03331C4 2.72331 6.534 1.26431 8.597 2.38531L21.409 9.35331Z" fill="white"/></svg>' : ''}
                                    <div class="mouseHoverx" title="${f.comment}" ><svg class="i-icon ${dataType === 'video' ? 'vi-icon' : ''}" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 8C16 9.05058 15.7931 10.0909 15.391 11.0615C14.989 12.0321 14.3997 12.914 13.6569 13.6569C12.914 14.3997 12.0321 14.989 11.0615 15.391C10.0909 15.7931 9.05058 16 8 16C6.94943 16 5.90914 15.7931 4.93853 15.391C3.96793 14.989 3.08601 14.3997 2.34315 13.6569C1.60028 12.914 1.011 12.0321 0.608964 11.0615C0.206926 10.0909 -1.56548e-08 9.05058 0 8C3.16163e-08 5.87827 0.842855 3.84344 2.34315 2.34315C3.84344 0.842855 5.87827 0 8 0C10.1217 0 12.1566 0.842855 13.6569 2.34315C15.1571 3.84344 16 5.87827 16 8ZM9.11111 4.22222C9.11111 4.51691 8.99405 4.79952 8.78567 5.0079C8.5773 5.21627 8.29469 5.33333 8 5.33333C7.70532 5.33333 7.4227 5.21627 7.21433 5.0079C7.00595 4.79952 6.88889 4.51691 6.88889 4.22222C6.88889 3.92754 7.00595 3.64492 7.21433 3.43655C7.4227 3.22817 7.70532 3.11111 8 3.11111C8.29469 3.11111 8.5773 3.22817 8.78567 3.43655C8.99405 3.64492 9.11111 3.92754 9.11111 4.22222ZM8.88889 12.8889V6.66667H7.11111V12.8889H8.88889Z" fill="white"/>
                                    </svg></div>
                                    </div>`);
                                } else {
                                    $("."+newCls).append(`<div class="magnific-img mb-3">
                                    <a class="image-popup-vertical-fit m-1" data-id="${f.id}" href="${f.image_path}" data-type="${dataType}" username="${f.full_name}" comment="-" created-date="${f.date_added}" created-date1="${f.date_created}">
                                        ${mediaContent}
                                    </a>
                                    <div class="magnific__img-close ${dataType === 'video' ? 'videoClose' : ''}" data-type="${dataType}" data-id="${f.id}">
                                    </div>
                                    <div class="overlay ${dataType === 'video' ? 'videoOverlay' : ''}">${f.date_created}</div>
                                    ${dataType === 'video' ? '<svg class="play-icon" width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M21.409 9.35331C21.8893 9.60872 22.291 9.99 22.5712 10.4563C22.8514 10.9226 22.9994 11.4563 22.9994 12.0003C22.9994 12.5443 22.8514 13.078 22.5712 13.5443C22.291 14.0106 21.8893 14.3919 21.409 14.6473L8.597 21.6143C6.534 22.7373 4 21.2773 4 18.9683V5.03331C4 2.72331 6.534 1.26431 8.597 2.38531L21.409 9.35331Z" fill="white"/></svg>' : ''}
                                    </div>`);
                                }
                            });
                            $(".folder-photos").append('</section>');
                        });
                        $('.image-popup-vertical-fit').magnificPopup({
                            type: 'image',
                            mainClass: 'mfp-with-zoom',
                            gallery: {
                                navigateByImgClick: false,
                                enabled: true
                            },
                            zoom: {
                                enabled: true,
                                duration: 300, // duration of the effect, in milliseconds
                                easing: 'ease-in-out', // CSS transition easing function
                                opener: function(openerElement) {
                                    return openerElement.is('img') ? openerElement :
                                        openerElement.find('img');
                                }
                            },
                            callbacks: {
                                elementParse: function(item) {
                                    var type = item.el[0].getAttribute('data-type');
                                    if (type == 'video') {
                                        item.type = 'iframe';
                                    } else {
                                        item.type = 'image';
                                    }
                                },
                                open: function() {
                                    $('.mfp-wrap').children('div:eq(1)').remove();
                                    var anchorElement = this.currItem.el[0];
                                    var type = anchorElement.getAttribute(
                                        'data-type');
                                    var htmlContent = generateAdditionalDetails(
                                        anchorElement);
                                    $('.mfp-wrap').append(htmlContent);
                                },
                                change: function() {
                                    $('.mfp-wrap').children('div:eq(1)').remove();
                                    var anchorElement = this.currItem.el[0];
                                    var htmlContent = generateAdditionalDetails(
                                        anchorElement);
                                    $('.mfp-wrap').append(htmlContent);
                                }
                            }
                        });
                        $(document).on('click','img.mfp-img',function() {
                            $(this).toggleClass('zoom150');
                        });
                        $(document).on('click', '.magnific__img-close',
                            function(e) {
                                e.stopPropagation();
                                var pid = $(this).attr("data-id");
                                $confirm = confirm(
                                    'Are you sure you want to delete this Image ?');
                                if ($confirm == true) {
                                    $(this).parent().remove();
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ route('property.photo.delete') }}",
                                        data: {
                                            '_token': "{{ csrf_token() }}",
                                            id: pid,
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            if (response.success == true) {
                                                $('#liveToast').toast('show');
                                            } else {
                                                alert('Not deleted.');
                                                window.location.reload();
                                            }
                                        }
                                    });
                                }
                            });
                            $(document).on('click','.toast-cls', function() {
                                $('#liveToast').toast('hide');
                            });
                    },
                    error: function() {}
                });
                $('.signle-ubtn').parent().attr('href',
                    `{{ url('dashboard/property/photo/download-all/${proId}/${secId}') }}`)
                $('.signle-ubtn').html(`
                <svg class="download-svg me-1" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_1326_1880)">
                                    <path d="M1.38815 14.9729C1.42876 14.9105 1.47049 14.8488 1.51055 14.7859C2.04243 13.9514 2.5259 13.0762 3.11509 12.2823C4.84648 9.9456 8.28923 9.79371 10.2476 11.9418C10.8507 12.6028 11.411 13.3027 11.9912 13.9842C12.0224 14.0209 12.0552 14.0565 12.1025 14.1088C12.9076 12.9839 14.0008 12.3947 15.3745 12.3947C16.7481 12.3947 17.8402 12.9917 18.6653 14.1617V13.8896C18.6653 12.6056 18.6653 11.3215 18.6653 10.0374C18.6653 9.51998 19.1393 9.18617 19.5894 9.3859C19.8721 9.51053 19.9989 9.74253 19.9984 10.0535C19.9984 11.1779 20.0017 12.3023 19.9984 13.4267C19.995 14.0387 20.0106 14.6507 19.9566 15.2572C19.7536 17.5388 17.902 19.5211 15.6365 19.9016C15.3013 19.9581 14.9622 19.9875 14.6223 19.9895C11.54 19.9959 8.45762 19.9959 5.37502 19.9895C2.78684 19.9857 0.645967 18.2515 0.114644 15.7234C0.0405669 15.3633 0.00328468 14.9966 0.00337179 14.629C-0.00478814 11.5401 -0.00608672 8.45122 -0.000523132 5.36231C0.00392774 2.6712 1.90167 0.466353 4.56162 0.0540912C4.81579 0.0163525 5.07244 -0.00224513 5.3294 -0.00154466C7.47472 -0.00599553 9.61985 -0.00599553 11.7648 -0.00154466C12.2917 -0.00154466 12.6277 0.443542 12.4536 0.899756C12.3506 1.17015 12.107 1.32982 11.782 1.32982C10.4212 1.32982 9.06053 1.32982 7.70004 1.32982C6.92114 1.32982 6.14224 1.32982 5.36723 1.32982C3.10285 1.33761 1.33752 3.09682 1.33474 5.3573C1.33029 8.45326 1.33029 11.5492 1.33474 14.6452V14.9517L1.38815 14.9729Z" fill="#1A47A3"></path>
                                    <path d="M15.663 6.25213V3.97106C15.663 2.87392 15.663 1.77734 15.663 0.680197C15.6607 0.593218 15.6757 0.506644 15.707 0.425458C15.7383 0.344273 15.7853 0.27008 15.8454 0.207149C15.9055 0.144219 15.9774 0.0937934 16.0571 0.0587756C16.1367 0.0237577 16.2225 0.00483793 16.3095 0.00310738C16.6806 -0.00523801 16.9771 0.281287 16.9933 0.670738C16.996 0.733051 16.9933 0.795919 16.9933 0.858231V6.20317L17.0439 6.23544C17.0834 6.17981 17.1184 6.12417 17.1624 6.07521C17.7143 5.46062 18.2673 4.84695 18.8215 4.23422C19.0106 4.02614 19.2471 3.95214 19.5203 4.03615C19.7845 4.11794 19.9653 4.30488 19.9715 4.57416C19.9765 4.75219 19.9236 4.97696 19.8112 5.10659C19.1397 5.88549 18.4582 6.65382 17.7527 7.39823C17.5707 7.59362 17.3505 7.7495 17.1058 7.85618C16.861 7.96287 16.597 8.01808 16.33 8.0184C16.063 8.01871 15.7988 7.96411 15.5538 7.858C15.3088 7.75189 15.0882 7.59653 14.9058 7.40157C14.1914 6.65438 13.5116 5.87381 12.825 5.10047C12.7666 5.03542 12.7218 4.95926 12.6934 4.87652C12.665 4.79379 12.6536 4.70619 12.6599 4.61895C12.6661 4.5317 12.6898 4.44661 12.7297 4.36875C12.7695 4.29089 12.8247 4.22187 12.8918 4.16579C12.9567 4.1075 13.0327 4.06281 13.1151 4.03433C13.1976 4.00586 13.2849 3.99418 13.372 3.99999C13.459 4.00579 13.5441 4.02897 13.622 4.06815C13.7 4.10732 13.7693 4.16171 13.8259 4.2281C14.3823 4.83676 14.9336 5.45209 15.4866 6.06742C15.5317 6.11304 15.5818 6.16367 15.663 6.25213Z" fill="#1A47A3"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1326_1880">
                                        <rect width="20" height="19.9955" fill="white" transform="translate(-0.00195312 0.000976562)"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                            Download`);
                $('.photo-btn').removeClass('col-md-12');
                $('.photo-btn').addClass('col-md-8');
                $('.folder-name').html('');
                $('.folder-name').html('<h4>' + folder + '</h4>')
                $('.photo-header').toggleClass('d-none');
                $('.photo-folders').toggleClass('d-none');
                $('.folder-photos').toggleClass('d-none');
                $('.photo-row').toggleClass('justify-content-end');
                $(".folder_select").val(secId).change();
                $('.folder_select').attr('disabled', true);
                $('.fid').val(secId);
            });
            $('.all-folders').click(function() {
                $(document).on('click','img.mfp-img',function() {
                            $(this).toggleClass('zoom150');
                        });
                localStorage.setItem('selectedfilesec', 'false');
                var proId = $('.file').attr("data-pro_id");
                $('.folder_select').attr('disabled', false);
                $('.signle-ubtn').parent().attr('href',
                    `{{ url('dashboard/property/photo/download-all/${proId}') }}`)
                $('.signle-ubtn').html(`<svg class="download-svg me-1" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_1326_1880)">
                                    <path d="M1.38815 14.9729C1.42876 14.9105 1.47049 14.8488 1.51055 14.7859C2.04243 13.9514 2.5259 13.0762 3.11509 12.2823C4.84648 9.9456 8.28923 9.79371 10.2476 11.9418C10.8507 12.6028 11.411 13.3027 11.9912 13.9842C12.0224 14.0209 12.0552 14.0565 12.1025 14.1088C12.9076 12.9839 14.0008 12.3947 15.3745 12.3947C16.7481 12.3947 17.8402 12.9917 18.6653 14.1617V13.8896C18.6653 12.6056 18.6653 11.3215 18.6653 10.0374C18.6653 9.51998 19.1393 9.18617 19.5894 9.3859C19.8721 9.51053 19.9989 9.74253 19.9984 10.0535C19.9984 11.1779 20.0017 12.3023 19.9984 13.4267C19.995 14.0387 20.0106 14.6507 19.9566 15.2572C19.7536 17.5388 17.902 19.5211 15.6365 19.9016C15.3013 19.9581 14.9622 19.9875 14.6223 19.9895C11.54 19.9959 8.45762 19.9959 5.37502 19.9895C2.78684 19.9857 0.645967 18.2515 0.114644 15.7234C0.0405669 15.3633 0.00328468 14.9966 0.00337179 14.629C-0.00478814 11.5401 -0.00608672 8.45122 -0.000523132 5.36231C0.00392774 2.6712 1.90167 0.466353 4.56162 0.0540912C4.81579 0.0163525 5.07244 -0.00224513 5.3294 -0.00154466C7.47472 -0.00599553 9.61985 -0.00599553 11.7648 -0.00154466C12.2917 -0.00154466 12.6277 0.443542 12.4536 0.899756C12.3506 1.17015 12.107 1.32982 11.782 1.32982C10.4212 1.32982 9.06053 1.32982 7.70004 1.32982C6.92114 1.32982 6.14224 1.32982 5.36723 1.32982C3.10285 1.33761 1.33752 3.09682 1.33474 5.3573C1.33029 8.45326 1.33029 11.5492 1.33474 14.6452V14.9517L1.38815 14.9729Z" fill="#1A47A3"></path>
                                    <path d="M15.663 6.25213V3.97106C15.663 2.87392 15.663 1.77734 15.663 0.680197C15.6607 0.593218 15.6757 0.506644 15.707 0.425458C15.7383 0.344273 15.7853 0.27008 15.8454 0.207149C15.9055 0.144219 15.9774 0.0937934 16.0571 0.0587756C16.1367 0.0237577 16.2225 0.00483793 16.3095 0.00310738C16.6806 -0.00523801 16.9771 0.281287 16.9933 0.670738C16.996 0.733051 16.9933 0.795919 16.9933 0.858231V6.20317L17.0439 6.23544C17.0834 6.17981 17.1184 6.12417 17.1624 6.07521C17.7143 5.46062 18.2673 4.84695 18.8215 4.23422C19.0106 4.02614 19.2471 3.95214 19.5203 4.03615C19.7845 4.11794 19.9653 4.30488 19.9715 4.57416C19.9765 4.75219 19.9236 4.97696 19.8112 5.10659C19.1397 5.88549 18.4582 6.65382 17.7527 7.39823C17.5707 7.59362 17.3505 7.7495 17.1058 7.85618C16.861 7.96287 16.597 8.01808 16.33 8.0184C16.063 8.01871 15.7988 7.96411 15.5538 7.858C15.3088 7.75189 15.0882 7.59653 14.9058 7.40157C14.1914 6.65438 13.5116 5.87381 12.825 5.10047C12.7666 5.03542 12.7218 4.95926 12.6934 4.87652C12.665 4.79379 12.6536 4.70619 12.6599 4.61895C12.6661 4.5317 12.6898 4.44661 12.7297 4.36875C12.7695 4.29089 12.8247 4.22187 12.8918 4.16579C12.9567 4.1075 13.0327 4.06281 13.1151 4.03433C13.1976 4.00586 13.2849 3.99418 13.372 3.99999C13.459 4.00579 13.5441 4.02897 13.622 4.06815C13.7 4.10732 13.7693 4.16171 13.8259 4.2281C14.3823 4.83676 14.9336 5.45209 15.4866 6.06742C15.5317 6.11304 15.5818 6.16367 15.663 6.25213Z" fill="#1A47A3"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1326_1880">
                                        <rect width="20" height="19.9955" fill="white" transform="translate(-0.00195312 0.000976562)"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                            Download All Folders`);
                $('.photo-btn').removeClass('col-md-8');
                $('.photo-btn').addClass('col-md-12');
                $('.photo-header').toggleClass('d-none');
                $('.photo-folders').toggleClass('d-none');
                $('.folder-photos').toggleClass('d-none');
                $('.photo-row').toggleClass('justify-content-end');
                $(".folder-photos").html(
                    `<section class="img-gallery-magnific"></section><div class="clear"></div>`);
                $('.close-btn').click();
                $('.upload__inputfile').val(null);
            });
            $(document).on('click','.magnific__img-close2', function(e){
                var imgId = $(this).attr('data-id');
                e.stopPropagation();
                e.preventDefault();
                htmlData();
                var canvas = new fabric.Canvas('canvas');

                $('#add-text-button').click(function() {
                    var text = "New Text Here";
                    if (text) {
                        var canvasWidth = canvas.getWidth();
                        var canvasHeight = canvas.getHeight();
                        var fontSizeM = Math.min(canvasWidth, canvasHeight) * 0.05;

                        // Create new text object
                        var newText = new fabric.IText(text, {
                            fontFamily: 'Arial',  // Or use desired font family
                            fill: '#000',
                            editable: true,
                            fontSize: fontSizeM,
                            backgroundColor: 'rgba(222, 222, 222, 0.8)', // White background with 50% opacity
                            borderColor: '#1A47A3', // Border color
                        });

                        // Calculate text box dimensions
                        var textBoxWidth = newText.width * newText.scaleX;
                        var textBoxHeight = newText.height * newText.scaleY;

                        // Set text object position to center of canvas
                        newText.set({
                            left: (canvasWidth - textBoxWidth) / 2,
                            top: (canvasHeight - textBoxHeight) / 2
                        });

                        $('#font-size').val('0');
                        newText.hiddenTextareaContainer = canvas.lowerCanvasEl.parentNode;
                        canvas.add(newText);

                        canvas.renderAll();
                        $(window).scrollTop(0);
                    }
                });
                canvas.on('selection:created', function() {
                    $('#remove-text-button').parent().removeClass("d-none");
                    $('#font-size').parent().removeClass("d-none");
                    $('#font-color').parent().removeClass("d-none");
                    $('#remove-text-button').parent().addClass("d-flex");
                    $('#font-size').parent().addClass("d-flex");
                    $('#font-color').parent().addClass("d-flex");
                });
                canvas.on('selection:cleared', function() {
                    $('#remove-text-button').parent().addClass("d-none");
                    $('#font-size').parent().addClass("d-none");
                    $('#font-color').parent().addClass("d-none");
                    $('#remove-text-button').parent().removeClass("d-flex");
                    $('#font-size').parent().removeClass("d-flex");
                    $('#font-color').parent().removeClass("d-flex");
                });
                    $('#font-size').change(function() {
                        var thisSize = $(this).val();
                        // Get the selected font size value
                        var selectedFontSizeIndex = parseInt(thisSize);
                        var selectedObject = canvas.getActiveObject();

                        if (selectedObject && selectedObject.type === 'i-text') {
                            var canvasWidth = canvas.getWidth();
                            var canvasHeight = canvas.getHeight();
                            var fontSizeM = Math.min(canvasWidth, canvasHeight) * 0.05;
                            var fontSizes = [fontSizeM + 4, fontSizeM + 8, fontSizeM + 12, fontSizeM + 16, fontSizeM + 20, fontSizeM + 24, fontSizeM + 28, fontSizeM + 32];
                            var fontSize = fontSizes[selectedFontSizeIndex];

                            if (selectedObject instanceof fabric.Text) {
                                selectedObject.set('fontSize', fontSize); // Set the font size directly
                                canvas.renderAll();
                                $(window).scrollTop(0);
                            }
                        }
                    });

                    // Font color change event listener
                    document.getElementById('font-color').addEventListener('change', function() {
                        var selectedObject = canvas.getActiveObject();
                        if (selectedObject && selectedObject.type === 'i-text') {
                            var colors = ['#000000', '#FF0000', '#00FF00', '#0000FF', '#FFF'];

                            var color = colors[this.value];
                            if (selectedObject instanceof fabric.Text) {
                                selectedObject.set('fill', color);
                                canvas.renderAll();
                                $(window).scrollTop(0);
                            }
                        }
                    });
                    document.getElementById('remove-text-button').addEventListener('click', removeSelectedText);
                    function removeSelectedText() {
                        var activeObject = canvas.getActiveObject();
                        if (activeObject && activeObject.type === 'i-text') {
                            canvas.remove(activeObject);
                            canvas.discardActiveObject();
                            canvas.renderAll();
                            $(window).scrollTop(0);
                        }
                    }

                $(document).on('click','#saveBtn', function() {
                    // Get the edited image data from the canvas
                    var editedImageData = canvas.toDataURL({ format: 'png',quality: 1,multiplier: 3 });
                    // Find the corresponding .img-bg element and update its background image
                    var $selectedImage = $('.simgprev .file-set.selected');
                    var selectedFilename = $selectedImage.data('file');
                    var blob = dataURItoBlob(editedImageData);
                    var file = new File([blob], "singleimg.png");
                    var formData = new FormData();
                    formData.append('photo_img', file);
                    formData.append('folder_id', "edit");
                    formData.append('id', imgId);
                    $.ajax({
                        url: '{{ route("property.photo.store") }}',
                        type: 'POST',
                        data: formData,
                        processData: false, // Important: Don't process the data
                        contentType: false, // Important: Don't set contentType
                        success: function(response) {
                            if(response.success == true){
                                window.location.reload();
                            }else{
                                alert('Image editation Failed')
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error response if needed
                            console.error('Upload error:', error);
                        }
                    });

                    if ($selectedImage.length > 0) {
                        $selectedImage.css('background-image', 'url(' + editedImageData + ')');
                        $selectedImage.removeClass('selected');
                    }
                    // Close the modal
                    $('#imageEditorModal').modal('hide');
                });
                $(document).on('click','.closeBtn', function() {
                    // Close the modal
                    var $selectedImage = $('.simgprev .file-set.selected');
                        $selectedImage.removeClass('selected');
                    $('#imageEditorModal').modal('hide');
                });
                var imgSrc = $('.mfp-img').attr('src');
                    if(imgSrc != "none"){
                        $(this).addClass('selected');
                        loadImageToCanvas(imgSrc, canvas);
                    $('#imageEditorModal').modal('show');
                    }
            });
            const dt2 = new DataTransfer();

            $('#photo_img').on('change', function(e) {
                e.stopPropagation();
                e.preventDefault();
                readURL(this, $('.file-wrapper')); //Change the image
                if ($(this).get(0).files.length === 0) {
                    $('.file-wrapper-bg').show();
                } else {
                    $('.file-wrapper-bg').hide();
                }
                htmlData();
                var canvas = new fabric.Canvas('canvas');

                $('#add-text-button').click(function() {
                    var text = "New Text Here";
                    if (text) {
                        var canvasWidth = canvas.getWidth();
                        var canvasHeight = canvas.getHeight();
                        var fontSizeM = Math.min(canvasWidth, canvasHeight) * 0.05;

                        // Create new text object
                        var newText = new fabric.IText(text, {
                            fontFamily: 'Arial',  // Or use desired font family
                            fill: '#000',
                            editable: true,
                            fontSize: fontSizeM,
                            backgroundColor: 'rgba(222, 222, 222, 0.8)', // White background with 50% opacity
                            borderColor: '#1A47A3', // Border color
                        });

                        // Calculate text box dimensions
                        var textBoxWidth = newText.width * newText.scaleX;
                        var textBoxHeight = newText.height * newText.scaleY;

                        // Set text object position to center of canvas
                        newText.set({
                            left: (canvasWidth - textBoxWidth) / 2,
                            top: (canvasHeight - textBoxHeight) / 2
                        });

                        $('#font-size').val('0');
                        newText.hiddenTextareaContainer = canvas.lowerCanvasEl.parentNode;
                        canvas.add(newText);

                        canvas.renderAll();
                        $(window).scrollTop(0);
                    }
                });
                canvas.on('selection:created', function() {
                    $('#remove-text-button').parent().removeClass("d-none");
                    $('#font-size').parent().removeClass("d-none");
                    $('#font-color').parent().removeClass("d-none");
                    $('#remove-text-button').parent().addClass("d-flex");
                    $('#font-size').parent().addClass("d-flex");
                    $('#font-color').parent().addClass("d-flex");
                });
                canvas.on('selection:cleared', function() {
                    $('#remove-text-button').parent().addClass("d-none");
                    $('#font-size').parent().addClass("d-none");
                    $('#font-color').parent().addClass("d-none");
                    $('#remove-text-button').parent().removeClass("d-flex");
                    $('#font-size').parent().removeClass("d-flex");
                    $('#font-color').parent().removeClass("d-flex");
                });
                        $('#font-size').change(function() {
                            var thisSize = $(this).val();
                        // Get the selected font size value
                        var selectedFontSizeIndex = parseInt(thisSize);
                        var selectedObject = canvas.getActiveObject();

                        if (selectedObject && selectedObject.type === 'i-text') {
                            var canvasWidth = canvas.getWidth();
                            var canvasHeight = canvas.getHeight();
                            var fontSizeM = Math.min(canvasWidth, canvasHeight) * 0.05;
                            var fontSizes = [fontSizeM + 4, fontSizeM + 8, fontSizeM + 12, fontSizeM + 16, fontSizeM + 20, fontSizeM + 24, fontSizeM + 28, fontSizeM + 32];
                            var fontSize = fontSizes[selectedFontSizeIndex];

                            if (selectedObject instanceof fabric.Text) {
                                selectedObject.set('fontSize', fontSize); // Set the font size directly
                                canvas.renderAll();
                                $(window).scrollTop(0);
                            }
                        }
                    });

                    // Font color change event listener
                    document.getElementById('font-color').addEventListener('change', function() {
                        var selectedObject = canvas.getActiveObject();
                        if (selectedObject && selectedObject.type === 'i-text') {
                            var colors = ['#000000', '#FF0000', '#00FF00', '#0000FF', '#FFF'];

                            var color = colors[this.value];
                            if (selectedObject instanceof fabric.Text) {
                                selectedObject.set('fill', color);
                                canvas.renderAll();
                                $(window).scrollTop(0);
                            }
                        }
                    });
                    document.getElementById('remove-text-button').addEventListener('click', removeSelectedText);
                    function removeSelectedText() {
                        var activeObject = canvas.getActiveObject();
                        if (activeObject && activeObject.type === 'i-text') {
                            canvas.remove(activeObject);
                            canvas.discardActiveObject();
                            canvas.renderAll();
                            $(window).scrollTop(0);
                        }
                    }

                $(document).on('click','.file-wrapper', function() {
                    var imgSrc = $(this).css('background-image').replace(/url\(['"]?(.*?)['"]?\)/i, "$1");
                    if(imgSrc != "none"){
                        $(this).addClass('selected');
                        loadImageToCanvas(imgSrc, canvas);
                    $('#imageEditorModal').modal('show');
                    }

                });

                $(document).on('click','#saveBtn', function() {
                    // Get the edited image data from the canvas
                    var editedImageData = canvas.toDataURL({ format: 'png',quality: 1,multiplier: 3 });
                    // Find the corresponding .img-bg element and update its background image
                    var $selectedImage = $('.simgprev .file-set.selected');
                    var selectedFilename = $selectedImage.data('file');
                    var blob = dataURItoBlob(editedImageData);
                    var file = new File([blob], "singleimg.png");
                    dt2.items.remove(0);
                    dt2.items.add(file);
                    document.getElementById('photo_img').files = dt2.files

                    if ($selectedImage.length > 0) {
                        $selectedImage.css('background-image', 'url(' + editedImageData + ')');
                        $selectedImage.removeClass('selected');
                    }
                    // Close the modal
                    $('#imageEditorModal').modal('hide');
                });
                $(document).on('click','.closeBtn', function() {
                    // Close the modal
                    var $selectedImage = $('.simgprev .file-set.selected');
                        $selectedImage.removeClass('selected');
                    $('#imageEditorModal').modal('hide');
                });
            });

            $('.close-btn').on('click', function(e) { //Unset the image or video
                e.stopPropagation();
                e.preventDefault();
                var $selectedImage = $('.simgprev .file-set.selected');
                $selectedImage.removeClass('selected');
                var $selectedImage2 = $('.upload__img-wrap .img-bg.selected');
                $selectedImage2.removeClass('selected');
                var $selectedImage3 = $('.file-wrapper');
                $selectedImage3.removeClass('selected');
                let file = $('#photo_img');
                $('.file-wrapper').css('background-image', 'unset');
                $('.file-wrapper video').remove(); // Remove any existing video element
                $('.file-wrapper').removeClass('file-set');
                file.replaceWith(file = file.clone(true));
                $('.file-wrapper-bg').show();
                $("#photo_img").val(null);
            });

            function readURL(input, obj) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var file = input.files[0];
                        var fileType = file.type;
                        if (fileType.indexOf('image') !== -1) {
                            obj.css('background-image', 'url(' + e.target.result + ')');
                            obj.find('video').remove(); // Remove any existing video element
                        } else if (fileType.indexOf('video') !== -1) {
                            obj.css('background-image', ''); // Remove any existing background image
                            var video = $('<video controls>');
                            video.attr('src', e.target.result);
                            obj.append(video);
                        }
                        obj.addClass('file-set');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('.image-popup-vertical-fit').magnificPopup({
                type: 'image',
                mainClass: 'mfp-with-zoom',
                gallery: {
                    navigateByImgClick: false,
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300, // duration of the effect, in milliseconds
                    easing: 'ease-in-out', // CSS transition easing function
                    opener: function(openerElement) {
                        return openerElement.is('img') ? openerElement :
                            openerElement.find('img');
                    }
                },
                callbacks: {
                    elementParse: function(item) {
                        var type = item.el[0].getAttribute('data-type');
                        if (type == 'video') {
                            item.type = 'iframe';
                        } else {
                            item.type = 'image';
                        }
                    },
                    open: function() {
                        $('.mfp-wrap').children('div:eq(1)').remove();
                        var anchorElement = this.currItem.el[0];
                        var type = anchorElement.getAttribute('data-type');
                        var htmlContent = generateAdditionalDetails(anchorElement);
                        $('.mfp-wrap').append(htmlContent);
                    },
                    change: function() {
                        $('.mfp-wrap').children('div:eq(1)').remove();
                        var anchorElement = this.currItem.el[0];
                        var htmlContent = generateAdditionalDetails(anchorElement);
                        $('.mfp-wrap').append(htmlContent);
                    }
                }
            });
            // $(document).on('click', 'img.mfp-img', function() {
            //     // Your code here
            //     // $(this).toggleClass('zoom150');
            //     console.log('clicked');
            // });
            var searchInput = $('.dataTables_filter input[type="search"]');
            searchInput.attr('placeholder', 'Search');
            searchInput.css('border', '1px solid #1A47A3');
            var icon = $('<i/>', {
                class: 'fas fa-search'
            }).css({
                position: 'absolute',
                right: '10px',
                top: '50%',
                transform: 'translateY(-50%)',
                color: '#aaa' // Adjust the color as needed
            });
            $('.dataTables_filter label').prepend(icon);
            $('.propcsv11').css({
                'color': '#1A47A3'
            });
            $('.propcsv112').addClass('trans180');
            $('.toolboxdiv1').addClass('trans180');

            $('#third-party-formss').submit(function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Get the form data
                var formData = new FormData($(this)[0]);
                var title = formData.get('title');
                var reminder_status = formData.get('status');
                var due_date = formData.get('due_date');
                var due_time = formData.get('due_time');
                var notes = formData.get('notes');

                // Perform an AJAX request
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle the success response
                        if (response.success == true) {
                            $('#third-party-formss')[0].reset();
                            // $('.notiDot').removeClass('d-none');
                            // var intt = $('.notiDot').text();
                            // var count = parseInt(1) + parseInt(intt);
                            // $('.notiDot').text(count);

                            if ($('.reminderBoxs').length == 0) {
                                $('#reminderBoxss').empty();
                            }
                            var html = '';
                            var html2 = '';
                            html +=
                                '<div class="mb-2 col-sm-12 col-lg-4 col-md-6 reminderBoxs" role="alert">';
                            html +=
                                '<div class="d-flex justify-content-between align-items-center py-0">';
                            html += '    <a aria-hidden="true" class="text-blues" href="' +
                                '{{ route('property.deleteReminder', '') }}/' + response.data
                                .id +
                                '" onClick="return confirm(`Are you sure you want to delete?`)"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                            html += '            </div>';
                            html += '            <div class=" mt-1 d-flex flex-column">';
                            html +=
                                '                <h5 class="mb-2 alert-heading my-0 py-0">' +
                                title + '</h5>';
                            html += '                <p class="mb-0 alert-heading my-0 py-0">' +
                                notes + '</p>';
                            html += '            </div>';
                            html +=
                                '            <div class=" mt-1 d-flex justify-content-between">';
                            html += '                <small class="mb-2 my-0"><span>Due: ' +
                                formatDate5(response.data.due_date, 'd/m/Y') + ' ' +
                                convertTo12Hour(response.data.due_time) + '</span></small>';
                            if (reminder_status == 'Pending') {
                                html +=
                                    '<small class="mb-2 my-0"><span class="clickStatusChange inprog" data-id="' +
                                    response.data.id + '" data-status="' + reminder_status +
                                    '" data-toggle="modal" data-target="#changeRemModal">Pending</span></small>';
                            } else {
                                html +=
                                    '<small class="mb-2 my-0"><span class="clickStatusChange compl" data-id="' +
                                    response.data.id + '" data-status="' + reminder_status +
                                    '" data-toggle="modal" data-target="#changeRemModal">Complete</span></small>';
                            }
                            html += '            </div></div>';
                            $('#reminderBoxss').prepend(html);
                            var msnry = new Masonry('#reminderBoxss', {
                                itemSelector: '.reminderBoxs',
                                percentPosition: true,
                                horizontalOrder: true
                            });
                            msnry.layout();
                        }
                        // $('.appnedLi').prepend(html2);

                    },
                    error: function(error) {
                        // Handle the error response
                        console.error(error);
                    }
                });
            });
            $(document).on('change','#appointment_status1', function(){
                var valuestatus = $(this).val();

                if(valuestatus == "Rejected"){
                    $('.appointment_status1_reason').removeClass('d-none');
                }else{
                    $('.appointment_status1_reason').addClass('d-none');
                }
            });
            $('#third-party-formss2').submit(function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Get the form data
                var formData = new FormData($(this)[0]);
                var title = formData.get('subject');
                var appointment_status = formData.get('appointment_status');
                var appointment_status1 = formData.get('appointment_status1');
                var appointment_status1_reason = formData.get('appointment_status1_reason');
                var due_date = formData.get('due_date');
                var due_time = formData.get('due_time');
                var notes = formData.get('appointment_desc');
                var notesOther = formData.get('appointment_other');
                var location = formData.get('location');
                var contractors = formData.get('appointment_contractors');

                // Perform an AJAX request
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle the success response
                        if (response.success == true) {
                            $(".noappoint-div").addClass("d-none");
                            $('#third-party-formss2')[0].reset();
                            $(".appointment_contractors").val(null).trigger('change');
                            var appointmentContractors = response.data.appointment_contractors;
                            var implodeName = "N/A";
                            if (appointmentContractors) {
                                var decode = JSON.parse(appointmentContractors);

                                if (decode.length > 0) {
                                    var textNames = [];
                                    $.each(decode, function(index, contractor) {
                                        textNames.push(contractor.full_name);
                                    });
                                    implodeName = textNames.join(', ');
                                }
                            }

                            if ($('.appointmentboxes').length == 0) {
                                $('#appointmentboxess').empty();
                            }
                            var html = '';
                            var html2 = '';
                            html +=
                                '<div class="mb-2 col-sm-12 col-lg-4 col-md-6 appointmentboxes" role="alert">';
                            html +=
                                '<div class="d-flex justify-content-between align-items-center py-0">';
                            html += '    <a aria-hidden="true" class="text-blues" href="' +
                                '{{ route('property.deleteAppointment', '') }}/' + response.data.id +
                                '" onClick="return confirm(`Are you sure you want to delete?`)"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                            html += '            </div>';
                            html += '            <div class=" mt-1 d-flex flex-column">';
                            //html +=
                              //  '                <h5 class="mb-2 alert-heading my-0 py-0">' +
                                //title + '</h5>';
                                if(response.data.appointment_desc != "" && response.data.appointment_desc != null){
                                html += '                <p class="mb-0 alert-heading my-0 py-0"><b>Additional Information:</b>' +
                                response.data.appointment_desc + '</p>';
                                }
                                if(response.data.appointment_status == "other"){
                                    html += '                <p class="mb-0 alert-heading my-0 py-0"><b>Other:</b>' +
                                        response.data.appointment_other + '</p>';
                                }
                                html += '                <p class="mb-0 alert-heading my-0 py-0"><b>Location:</b>' +
                                response.data.location + '</p>';
                                if(implodeName != "N/A"){
                                    html += '                <p class="mb-0 alert-heading my-0 py-0"><b>Team member:</b>' +
                                        implodeName + '</p>';
                                    }
                                    if(response.data.status != "Accepted"){
                                    html += '                <p class="mb-0 alert-heading my-0 py-0"><b>Reason:</b>' +
                                        response.data.reason + '</p>';
                                    }
                            html += '            </div>';
                            html +=
                                '            <div class=" mt-1 d-flex justify-content-between align-items-end">';
                            html += '<span>Due: ' +
                                formatDate5(response.data.due_date, 'd/m/Y') + ' ' +
                                convertTo12Hour(response.data.due_time) + '</span>';
                                html += '<div class="d-flex flex-column" style="gap:5px;">';
                                html +=
                                    '<span class="clickStatusChange2 text-capitalize inprog" data-id="' +
                                    response.data.id + '" data-status="' + response.data.appointment_status + '" data-other="' + response.data.appointment_other +
                                    '" data-toggle="modal" style="padding: 3px 13px;" data-target="#changeAppModal">'+response.data.appointment_status+'</span>';

                                html +='<input type="hidden" id="hidR_'+response.data.id+'" value="'+response.data.reason+'">';
                            if (response.data.status == 'Rejected') {
                                html +=
                                    '<span class="clickStatusChange3 inprog" data-id="' +
                                    response.data.id + '" data-status="' + response.data.status +
                                    '" data-toggle="modal" style="padding: 3px 13px;" data-target="#changeAppModal2">Rejected</span>';
                            } else {
                                html +=
                                    '<span class="clickStatusChange3 compl" data-id="' +
                                    response.data.id + '" data-status="' + response.data.status +
                                    '" data-toggle="modal" style="padding: 3px 13px;" data-target="#changeAppModal2">Accepted</span>';
                            }
                            html += '</div>';
                            html += '            </div></div>';
                            $('#appointmentboxess').prepend(html);

                            var msnry2 = new Masonry('#appointmentboxess', {
                                itemSelector: '.appointmentboxes',
                                percentPosition: true,
                                horizontalOrder: true
                            });
                            msnry2.layout();
                        }
                        // $('.appnedLi').prepend(html2);

                    },
                    error: function(error) {
                        // Handle the error response
                        console.error(error);
                    }
                });
            });
            var storedFilter = localStorage.getItem('selectedFilter');
            if (storedFilter) {
                $('.filterSidebar').removeClass('filterActive');
                $('.filterSidebar[data-atr="' + storedFilter + '"]').addClass('filterActive');
                $('.filterSidebar[data-atr="' + storedFilter + '"]').trigger('click');
            }
            var selectedfile = localStorage.getItem('selectedfilesec');
            var sectionpanel = localStorage.getItem('selectedFilter');

            if (selectedfile) {

                var secId = localStorage.getItem('selectedfilesec');
                var proId = localStorage.getItem('selectedfilepro');
                var folder = localStorage.getItem('selectedfilename');

                if (selectedfile != 'false' && sectionpanel == 'pho' && "{{ $property->id }}" == proId) {
                    var url = '/dashboard/property/photo/get/' + proId + '/' + secId + '';
                    $.ajax({
                        type: 'GET',
                        url: url,
                        success: function(data) {
                            var imgs = data.data;
                            var groupedData = {};
                            $.each(imgs, function(index, item) {

                                var key = formatDate5(item.created_at, 'd/m/Y');
                                if (!groupedData[key]) {
                                    groupedData[key] = [];
                                }
                                groupedData[key].push(item);
                            });
                            $(".folder-photos").html('');
                            $.each(groupedData, function(b, v) {
                                $(".folder-photos").append('<h4>' + b +
                                    '</h4><section class="img-gallery-magnific img-gallery-magnific-'+b.replace(/\//g, "-")+'">');
                                v.forEach(function(f, i) {
                                    var dataType = differentiateURL(f.image_path);
                                    if (dataType === 'video') {
                                        mediaContent =
                                            `<video src="${f.image_path}" style="border-top-left-radius: 6px; border-top-right-radius: 6px;"></video>`;
                                    } else {
                                        mediaContent = `<img src="${f.image_path}"/>`;
                                    }
                                    var newCls = "img-gallery-magnific-"+b.replace(/\//g, "-");
                                    if (f.comment != "") {
                                        $("."+newCls).append(`<div class="magnific-img mb-3">
                                <a class="image-popup-vertical-fit m-1" data-id="${f.id}" href="${f.image_path}" data-type="${dataType}" username="${f.full_name}" comment="${f.comment}" created-date="${f.date_added}" created-date1="${f.date_created}">
                                    ${mediaContent}
                                </a>
                                <div class="magnific__img-close ${dataType === 'video' ? 'videoClose' : ''}" data-type="${dataType}" data-id="${f.id}">
                                </div>
                                <div class="overlay ${dataType === 'video' ? 'videoOverlay' : ''}">${f.date_created}</div>
                                ${dataType === 'video' ? '<svg class="play-icon" width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M21.409 9.35331C21.8893 9.60872 22.291 9.99 22.5712 10.4563C22.8514 10.9226 22.9994 11.4563 22.9994 12.0003C22.9994 12.5443 22.8514 13.078 22.5712 13.5443C22.291 14.0106 21.8893 14.3919 21.409 14.6473L8.597 21.6143C6.534 22.7373 4 21.2773 4 18.9683V5.03331C4 2.72331 6.534 1.26431 8.597 2.38531L21.409 9.35331Z" fill="white"/></svg>' : ''}
                                <div class="mouseHoverx" title="${f.comment}" ><svg title="${f.comment}" class="i-icon ${dataType === 'video' ? 'vi-icon' : ''}" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16 8C16 9.05058 15.7931 10.0909 15.391 11.0615C14.989 12.0321 14.3997 12.914 13.6569 13.6569C12.914 14.3997 12.0321 14.989 11.0615 15.391C10.0909 15.7931 9.05058 16 8 16C6.94943 16 5.90914 15.7931 4.93853 15.391C3.96793 14.989 3.08601 14.3997 2.34315 13.6569C1.60028 12.914 1.011 12.0321 0.608964 11.0615C0.206926 10.0909 -1.56548e-08 9.05058 0 8C3.16163e-08 5.87827 0.842855 3.84344 2.34315 2.34315C3.84344 0.842855 5.87827 0 8 0C10.1217 0 12.1566 0.842855 13.6569 2.34315C15.1571 3.84344 16 5.87827 16 8ZM9.11111 4.22222C9.11111 4.51691 8.99405 4.79952 8.78567 5.0079C8.5773 5.21627 8.29469 5.33333 8 5.33333C7.70532 5.33333 7.4227 5.21627 7.21433 5.0079C7.00595 4.79952 6.88889 4.51691 6.88889 4.22222C6.88889 3.92754 7.00595 3.64492 7.21433 3.43655C7.4227 3.22817 7.70532 3.11111 8 3.11111C8.29469 3.11111 8.5773 3.22817 8.78567 3.43655C8.99405 3.64492 9.11111 3.92754 9.11111 4.22222ZM8.88889 12.8889V6.66667H7.11111V12.8889H8.88889Z" fill="white"/>
                                </svg></div>
                                </div>`);
                                    } else {
                                        $("."+newCls).append(`<div class="magnific-img mb-3">
                                <a class="image-popup-vertical-fit m-1" data-id="${f.id}" href="${f.image_path}" data-type="${dataType}" username="${f.full_name}" comment="-" created-date="${f.date_added}" created-date1="${f.date_created}">
                                    ${mediaContent}
                                </a>
                                <div class="magnific__img-close ${dataType === 'video' ? 'videoClose' : ''}" data-type="${dataType}" data-id="${f.id}">
                                </div>
                                <div class="overlay ${dataType === 'video' ? 'videoOverlay' : ''}">${f.date_created}</div>
                                ${dataType === 'video' ? '<svg class="play-icon" width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M21.409 9.35331C21.8893 9.60872 22.291 9.99 22.5712 10.4563C22.8514 10.9226 22.9994 11.4563 22.9994 12.0003C22.9994 12.5443 22.8514 13.078 22.5712 13.5443C22.291 14.0106 21.8893 14.3919 21.409 14.6473L8.597 21.6143C6.534 22.7373 4 21.2773 4 18.9683V5.03331C4 2.72331 6.534 1.26431 8.597 2.38531L21.409 9.35331Z" fill="white"/></svg>' : ''}
                                </div>`);
                                    }
                                });
                                $(".folder-photos").append('</section>');
                            });
                            $('.image-popup-vertical-fit').magnificPopup({
                                type: 'image',
                                mainClass: 'mfp-with-zoom',
                                gallery: {
                                    navigateByImgClick: false,
                                    enabled: true
                                },
                                zoom: {
                                    enabled: true,
                                    duration: 300, // duration of the effect, in milliseconds
                                    easing: 'ease-in-out', // CSS transition easing function
                                    opener: function(openerElement) {
                                        return openerElement.is('img') ? openerElement :
                                            openerElement.find('img');
                                    }
                                },
                                callbacks: {
                                    elementParse: function(item) {
                                        var type = item.el[0].getAttribute('data-type');
                                        if (type == 'video') {
                                            item.type = 'iframe';
                                        } else {
                                            item.type = 'image';
                                        }
                                    },
                                    open: function() {
                                        $('.mfp-wrap').children('div:eq(1)').remove();
                                        var anchorElement = this.currItem.el[0];
                                        var type = anchorElement.getAttribute('data-type');
                                        var htmlContent = generateAdditionalDetails(
                                            anchorElement);
                                        $('.mfp-wrap').append(htmlContent);
                                    },
                                    change: function() {
                                        $('.mfp-wrap').children('div:eq(1)').remove();
                                        var anchorElement = this.currItem.el[0];
                                        var htmlContent = generateAdditionalDetails(
                                            anchorElement);
                                        $('.mfp-wrap').append(htmlContent);
                                    }
                                }
                            });
                            $(document).on('click', 'img.mfp-img', function() {
                                $(this).toggleClass('zoom150');
                            });
                            $(document).on('click', '.magnific__img-close', function(e) {
                                e.stopPropagation();
                                var pid = $(this).attr("data-id");
                                var dataType = $(this).attr("data-type");

                                $confirm = confirm(
                                    'Are you sure you want to delete this ' + dataType +
                                    ' ?');
                                if ($confirm == true) {
                                    $(this).parent().remove();
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ route('property.photo.delete') }}",
                                        data: {
                                            '_token': "{{ csrf_token() }}",
                                            id: pid,
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            if (response.success == true) {
                                                $('#liveToast').toast('show');
                                            } else {
                                                alert('Not deleted.');
                                                window.location.reload();
                                            }
                                        }
                                    });
                                }
                            });
                            $(document).on('click', '.magnific__img-close3', function(e) {
                                e.stopPropagation();
                                var pid = $(this).attr("data-id");
                                var dataType = $(this).attr("data-type");
                                $confirm = confirm(
                                    'Are you sure you want to delete this comment ?');
                                if ($confirm == true) {
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ route('property.photo.comment') }}",
                                        data: {
                                            '_token': "{{ csrf_token() }}",
                                            id: pid,
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            if (response.success == true) {
                                                window.location.reload();
                                            } else {
                                                alert('Not deleted.');
                                                window.location.reload();
                                            }
                                        }
                                    });
                                }
                            });
                            $(document).on('click','.toast-cls', function() {
                                $('#liveToast').toast('hide');
                            });
                        },
                        error: function() {}
                    });
                    $('.signle-ubtn').parent().attr('href',
                        `{{ url('dashboard/property/photo/download-all/${proId}/${secId}') }}`)
                    $('.signle-ubtn').html(`
                            <svg class="download-svg me-1" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_1326_1880)">
                                    <path d="M1.38815 14.9729C1.42876 14.9105 1.47049 14.8488 1.51055 14.7859C2.04243 13.9514 2.5259 13.0762 3.11509 12.2823C4.84648 9.9456 8.28923 9.79371 10.2476 11.9418C10.8507 12.6028 11.411 13.3027 11.9912 13.9842C12.0224 14.0209 12.0552 14.0565 12.1025 14.1088C12.9076 12.9839 14.0008 12.3947 15.3745 12.3947C16.7481 12.3947 17.8402 12.9917 18.6653 14.1617V13.8896C18.6653 12.6056 18.6653 11.3215 18.6653 10.0374C18.6653 9.51998 19.1393 9.18617 19.5894 9.3859C19.8721 9.51053 19.9989 9.74253 19.9984 10.0535C19.9984 11.1779 20.0017 12.3023 19.9984 13.4267C19.995 14.0387 20.0106 14.6507 19.9566 15.2572C19.7536 17.5388 17.902 19.5211 15.6365 19.9016C15.3013 19.9581 14.9622 19.9875 14.6223 19.9895C11.54 19.9959 8.45762 19.9959 5.37502 19.9895C2.78684 19.9857 0.645967 18.2515 0.114644 15.7234C0.0405669 15.3633 0.00328468 14.9966 0.00337179 14.629C-0.00478814 11.5401 -0.00608672 8.45122 -0.000523132 5.36231C0.00392774 2.6712 1.90167 0.466353 4.56162 0.0540912C4.81579 0.0163525 5.07244 -0.00224513 5.3294 -0.00154466C7.47472 -0.00599553 9.61985 -0.00599553 11.7648 -0.00154466C12.2917 -0.00154466 12.6277 0.443542 12.4536 0.899756C12.3506 1.17015 12.107 1.32982 11.782 1.32982C10.4212 1.32982 9.06053 1.32982 7.70004 1.32982C6.92114 1.32982 6.14224 1.32982 5.36723 1.32982C3.10285 1.33761 1.33752 3.09682 1.33474 5.3573C1.33029 8.45326 1.33029 11.5492 1.33474 14.6452V14.9517L1.38815 14.9729Z" fill="#1A47A3"></path>
                                    <path d="M15.663 6.25213V3.97106C15.663 2.87392 15.663 1.77734 15.663 0.680197C15.6607 0.593218 15.6757 0.506644 15.707 0.425458C15.7383 0.344273 15.7853 0.27008 15.8454 0.207149C15.9055 0.144219 15.9774 0.0937934 16.0571 0.0587756C16.1367 0.0237577 16.2225 0.00483793 16.3095 0.00310738C16.6806 -0.00523801 16.9771 0.281287 16.9933 0.670738C16.996 0.733051 16.9933 0.795919 16.9933 0.858231V6.20317L17.0439 6.23544C17.0834 6.17981 17.1184 6.12417 17.1624 6.07521C17.7143 5.46062 18.2673 4.84695 18.8215 4.23422C19.0106 4.02614 19.2471 3.95214 19.5203 4.03615C19.7845 4.11794 19.9653 4.30488 19.9715 4.57416C19.9765 4.75219 19.9236 4.97696 19.8112 5.10659C19.1397 5.88549 18.4582 6.65382 17.7527 7.39823C17.5707 7.59362 17.3505 7.7495 17.1058 7.85618C16.861 7.96287 16.597 8.01808 16.33 8.0184C16.063 8.01871 15.7988 7.96411 15.5538 7.858C15.3088 7.75189 15.0882 7.59653 14.9058 7.40157C14.1914 6.65438 13.5116 5.87381 12.825 5.10047C12.7666 5.03542 12.7218 4.95926 12.6934 4.87652C12.665 4.79379 12.6536 4.70619 12.6599 4.61895C12.6661 4.5317 12.6898 4.44661 12.7297 4.36875C12.7695 4.29089 12.8247 4.22187 12.8918 4.16579C12.9567 4.1075 13.0327 4.06281 13.1151 4.03433C13.1976 4.00586 13.2849 3.99418 13.372 3.99999C13.459 4.00579 13.5441 4.02897 13.622 4.06815C13.7 4.10732 13.7693 4.16171 13.8259 4.2281C14.3823 4.83676 14.9336 5.45209 15.4866 6.06742C15.5317 6.11304 15.5818 6.16367 15.663 6.25213Z" fill="#1A47A3"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1326_1880">
                                        <rect width="20" height="19.9955" fill="white" transform="translate(-0.00195312 0.000976562)"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                            Download`);
                    $('.photo-btn').removeClass('col-md-12');
                    $('.photo-btn').addClass('col-md-8');
                    $('.folder-name').html('');
                    $('.folder-name').html('<h4>' + folder + '</h4>')
                    $('.photo-header').toggleClass('d-none');
                    $('.photo-folders').toggleClass('d-none');
                    $('.folder-photos').toggleClass('d-none');
                    $('.photo-row').toggleClass('justify-content-end');
                    $(".folder_select").val(secId).change();
                    $('.folder_select').attr('disabled', true);
                    $('.fid').val(secId);
                }
            }
            var lastConId = localStorage.getItem('lastConId');
            if(lastConId != "null" && storedFilter == "con") {
                toggleContractorDetails(lastConId);
            }else {
                localStorage.setItem('lastConId',null);
            }

            var lastAssesId = localStorage.getItem('lastAssesId');
            if(lastAssesId != "null" && storedFilter == "her") {
                // console.log(lastAssesId);
                    toggleAssessorDetails(lastAssesId);
            }else {
                localStorage.setItem('lastAssesId',null);
            }
            $('#email-lead-data').DataTable({
            order: [],
            responsive: true,
            bDestroy:true,
            colResizable:true,
            language: {
                search: ""
            },
            lengthMenu: [
                [10, 25, 50, 100, 250, 500],
                [10, 25, 50, 100, 250, 500],
            ],
            dom: 'fBrtlp',
            buttons: [{
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }],
            "language": {
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    },
                    processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> ',
                    emptyTable: "No emails sent yet."
                },
            columnDefs: [{
                targets: [5],
                render: function(data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        var dateParts = data.split('/');

                        return dateParts[0] + '/' + dateParts[1] + '/' + dateParts[2];
                    }
                    return data;
                },
                type: 'date-uk'
            }],
        });
            // $('#property-assessor-table').DataTable({
            //     order: [
            //         [1, 'desc']
            //     ],
            //     lengthMenu: [
            //         [10, 25, 50, 100, 250, 500],
            //         [10, 25, 50, 100, 250, 500],
            //     ],
            //     'responsive': true,
            //     dom: 'rtlp',
            //     "language": {
            //         "paginate": {
            //             "previous": "<",
            //             "next": ">"
            //         },
            //         processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            //     },
            //     buttons: [{
            //         extend: 'collection',
            //         text: 'Export',
            //         buttons: [
            //             'copy',
            //             'excel',
            //             'csv',
            //             'pdf',
            //             'print'
            //         ]
            //     }],
            // });
            // $('#contractor-table').DataTable({
            //     order: [
            //         [1, 'desc']
            //     ],
            //     'responsive': true,
            //     lengthMenu: [
            //         [10, 25, 50, 100, 250, 500],
            //         [10, 25, 50, 100, 250, 500],
            //     ],
            //     dom: 'rtlp',
            //     "language": {
            //         "paginate": {
            //             "previous": "<",
            //             "next": ">"
            //         },
            //         processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            //     },
            //     buttons: [{
            //         extend: 'collection',
            //         text: 'Export',
            //         buttons: [
            //             'copy',
            //             'excel',
            //             'csv',
            //             'pdf',
            //             'print'
            //         ]
            //     }],

            // });
            // $('#property-post-work-logs').DataTable({
            //     order: [
            //         [1, 'desc']
            //     ],
            //     lengthMenu: [
            //         [10, 25, 50, 100, 250, 500],
            //         [10, 25, 50, 100, 250, 500],
            //     ],
            //     'responsive': true,
            //     dom: 'fBrtlp',
            //     "language": {
            //         "paginate": {
            //             "previous": "<",
            //             "next": ">"
            //         },
            //         processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> ',
            //         emptyTable: "No Post Work Log(s) added yet."
            //     },
            //     buttons: [{
            //         extend: 'collection',
            //         text: 'Export',
            //         buttons: [
            //             'copy',
            //             'excel',
            //             'csv',
            //             'pdf',
            //             'print'
            //         ]
            //     }],
            // });
            // $('#third_party_form_table').DataTable({
            //     order: [
            //         [1, 'desc']
            //     ],
            //     lengthMenu: [
            //         [10, 25, 50, 100, 250, 500],
            //         [10, 25, 50, 100, 250, 500],
            //     ],
            //     'responsive': true,
            //     dom: 'fBrtlp',
            //     "language": {
            //         "paginate": {
            //             "previous": "<",
            //             "next": ">"
            //         },
            //         processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> ',
            //         emptyTable: "No 3rd party forms added yet."
            //     },
            //     buttons: [{
            //         extend: 'collection',
            //         text: 'Export',
            //         buttons: [
            //             'copy',
            //             'excel',
            //             'csv',
            //             'pdf',
            //             'print'
            //         ]
            //     }]
            // });
        });
        $(document).on('click', '.filterSidebar', function() {
            var attr = $(this).attr('data-atr');
            $('.filterSidebar').removeClass('filterActive');
            $(this).addClass('filterActive');
            localStorage.setItem('selectedFilter', attr);

            if (attr == 'mea') {
                $('.generalCols').addClass('d-none');
                $('.measureTarget').removeClass('d-none');
            }
            if (attr == 'safh') {
                $('.generalCols').addClass('d-none');
                $('.safhTarget').removeClass('d-none');
            }
            if(attr == 'timesheet'){
                $('.generalCols').addClass('d-none');
                $('.timesheetTarget').removeClass('d-none');
            }
            if (attr == 'rem') {
                $('.filterSidebars').addClass('filterActive');
                $('.generalCols').addClass('d-none');
                $('.ReminderTarget').removeClass('d-none');
                msnry.layout();
            }
            if (attr == 'sur') {
                $('.generalCols').addClass('d-none');
                $('.SurveyourTarget').removeClass('d-none');
            }
            if (attr == 'ins') {
                $('.generalCols').addClass('d-none');
                $('.insReportTarget').removeClass('d-none');
            }
            if (attr == 'pho') {
                $('.generalCols').addClass('d-none');
                $('.phoReportTarget').removeClass('d-none');
            }
            if (attr == 'threepdf') {
                $('.generalCols').addClass('d-none');
                $('.threepdfTarget').removeClass('d-none');
            }
            if (attr == 'her') {
                $('.generalCols').addClass('d-none');
                $('.heaberTarget').removeClass('d-none');
            }
            if (attr == 'con') {
                $('.generalCols').addClass('d-none');
                $('.contractTarget').removeClass('d-none');
            }
            if (attr == 'con_l') {
                $('.generalCols').addClass('d-none');
                $('.contractLogTarget').removeClass('d-none');
            }
            if (attr == 'note') {
                $('.generalCols').addClass('d-none');
                $('.notesTarget').removeClass('d-none');
            }
            if (attr == 'snags') {
                $('.generalCols').addClass('d-none');
                $('.snagsTarget').removeClass('d-none');
            }
            if (attr == 'apmnt') {
                $('.generalCols').addClass('d-none');
                $('.apmntTarget').removeClass('d-none');
                msnry2.layout();
            }
            if (attr == 'emailT') {
                $('.generalCols').addClass('d-none');
                $('.emailTarget').removeClass('d-none');
            }
        });
        $(document).on('click', '.myremList', function() {
            var $clickedElement = $(this);
            var id = $(this).attr('data-id');
            var type = 'reminder';
            var value = 0;
            $.ajax({
                type: 'POST',
                url: "{{ route('changeStatusNofication') }}",
                data: {
                    id: id,
                    type: type,
                    value: value,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success == true) {
                        // window.location.reload();
                        $('.notiDot').addClass('d-none');
                        $clickedElement.css('color', '#333 !important');
                    } else {
                        $('.notiDot').removeClass('d-none');
                        alert('Not updated.');
                    }
                }
            });

        });
        const toggleContractorDetails = (id) => {
            var lConId = null;
            const containerId = `contractor_container_${id}`;
            const containerStyle = document.getElementById(containerId);
            const containerStyleParent = containerStyle.closest('td');
            containerStyle.style.display = containerStyle.style.display === 'block' ? 'none' : 'block';
            containerStyleParent.style.padding = containerStyleParent.style.padding === 'unset' ? '0.95rem' : 'unset';
            if(containerStyle.style.display == 'block') {
                var lConId = id;
            }else {
                var lConId = null;
            }
            localStorage.setItem('lastConId',lConId);
        }
        const toggleAssessorDetails = (id) => {
            var lAssessId = null;
            const containerId = `assessor_container_${id}`;
            const containerStyle = document.getElementById(containerId);
            const containerStyleParent = containerStyle.closest('td');
            containerStyle.classList.toggle('d-none');
            containerStyleParent.style.padding = containerStyleParent.style.padding === 'unset' ? '0.95rem' : 'unset';
            if(containerStyle.classList != 'd-none') {
                var lAssessId = id;
            }else {
                var lAssessId = null;
            }
            localStorage.setItem('lastAssesId',lAssessId);
        }

        const toggleVariationDetails = (id) => {
            const containerId = `variation_details_container_${id}`;
            const containerStyle = document.getElementById(containerId);
            const containerStyleParent = containerStyle.closest('td');
            containerStyle.style.display = containerStyle.style.display === 'block' ? 'none' : 'block';
            containerStyleParent.style.padding = containerStyleParent.style.padding === 'unset' ? '0.95rem' : 'unset';

        }
    </script>
@endsection
@push('scripts')
    <script>
        function filter_options(e) {
            var contract_id = $(e).attr('data-contract');
            var job_id = $(e).attr('data-job');
            $.ajax({
                url: "{{ route('document.filter') }}",
                type: 'POST',
                data: {
                    document: $(e).val(),
                    job: job_id
                },
                success: function(data) {
                    if (data.html == '') {
                        $("#show-library-button-" + contract_id).prop('disabled', true);
                        $("#document_lib-" + contract_id).html('');
                    } else {
                        $("#document_lib-" + contract_id).html(data.html);
                        $("#show-library-button-" + contract_id).prop('disabled', false);
                    }

                }
            });
        }

        function show_library(e) {
            var contract_id = $(e).attr('data-contract');
            $("#show-library-" + contract_id).toggleClass('d-none');
            $("#upload-file-" + contract_id).toggleClass('d-none');
        }

        var msnry = new Masonry('#reminderBoxss', {
            itemSelector: '.reminderBoxs',
            percentPosition: true,
            horizontalOrder: true
        });
        var msnry2 = new Masonry('#appointmentboxess', {
            itemSelector: '.appointmentboxes',
            percentPosition: true,
            horizontalOrder: true
        });
    </script>
@endpush
