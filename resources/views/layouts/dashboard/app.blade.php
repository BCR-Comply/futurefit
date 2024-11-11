<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="dashboard" name="author" />
    <!-- App favicon -->
    {{-- <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}"> --}}

    <!-- App css -->
    <link href="{{ asset('assets/css/_vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/_vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/_vendor/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
        integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/css/customcss.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    @stack('styles')



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <style>
        .card {
            border-radius: 6px !important;
        }
        .seeAll {
            cursor: pointer;
            margin: 10px auto !important;
            height: 40px !important;
        }

        .reminderlistMain {
            display: flex;
            align-items: center;
            padding: 0px 25px;
            margin-bottom: -22px !important;
        }

        .myremListD {
            max-height: 150px !important;
            cursor: pointer;
            width: 350px;
        }

        .myremList {
            padding: 2px 1px 6px 1px !important;
        }

        .showallm {
            float: right !important;
            /* margin-right: 25% !important; */
        }

        .overflowClass {
            text-overflow: ellipsis;
            overflow: hidden;
            width: 250px;
            white-space: break-spaces;
        }

        span.text-muted {
            color: #333 !important;
        }

        .bg-grasy,
        .justify-content-between.bg-graycard {
            background-color: #fff !important;
            border: 0.5px solid #1A47A3 !important;
            /* border-radius: 6px !important; */
        }

        .card-body.mybody,
        .card.mybody._shadow-1 {
            background-color: #fff !important;
        }

        .col-12.pt-3.bg-gray,
        .col-12.bg-gray,
        .col-12.mt-3.card,
        .col-sm-12.card.mt-3.text-black,
        div.row>div.col-12>.my-1.card,
        .card.pl-2 {
            background-color: #fff !important;
            border: 0.5px solid #1A47A3 !important;
        }

        .totalIsRead,
        .reminderNoti {
            position: absolute;
            right: 8px;
            top: 8px;
            min-width: 15px;
            min-height: 15px;
            background-color: red;
            display: flex;
            justify-content: center;
            color: #fff;
            border-radius: 36px;
            width: auto;
            height: auto;
            font-size: 10px;
            font-weight: 600;
        }

        .newMessageC {
            background-color: #EAF1FF !important;
            color: #1A47A3 !important;
        }

        .card-body ul>li:first-child {
            margin-top: -2px !important;
        }

        .dropdown-item.mark-read {
            color: #1A47A3 !important;
            margin: 5px 10px !important;
            justify-content: start !important;
            gap: 5px;
        }

        .dropdown-btns {
            background: #fff !important;
            border: unset;
        }

        ul.appnedLiX {
            position: absolute !important;
            top: 29px !important;
            right: 0px !important;
            display: none;
            max-height: 529px;
            overflow-y: auto;
            border-radius: 10px;
            padding: 0.5rem 0;
            min-width: 370px;
        }

        .reminderBoxs {
            width: 350px;
            height: fit-content;
        }

        ::-webkit-scrollbar {
            height: 8px !important;
            width: 4px;
            background: gray;
        }

        .clickStatusChange,.clickStatusChange2,.clickStatusChange3 {
            cursor: pointer;
        }

        table tbody tr {
            vertical-align: middle !important;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px #eaf1ff;
            border-radius: 0px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #1A47A3 !important;
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #1A47A3;
        }

        .myNewMenu {
            left: -15.5pc;
            max-height: 385px;
            overflow-y: scroll;
            padding: 0.2rem 0.4rem;
        }

        .myNewMenu>.dropdown-item {
            background: #F2F4F7;
            margin: 5px;
            width: -webkit-fill-available;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px !important;
            color: #000;
        }

        .menClr {
            color: #1A47A3 !important;
            cursor: pointer;
        }

        .dropdown-item:focus,
        .dropdown-item:hover {
            background-color: #EAF1FF !important;
            color: #1A47A3 !important;
        }

        .myremListD:hover {
            background-color: #EAF1FF !important;
            color: #1A47A3 !important;
        }

        .cusmarg {
            margin: 13px 0px 13px 13px !important;
        }

        .alert {
            margin-top: 10px;
        }

        tr td:not(:last-child),
        tr th:not(:last-child) {
            border-right: unset !important;
        }

        .mysvgmsg {
            width: 20px;
            height: 20px;
            margin-right: 7px;
        }

        .mynew2 {
            margin-top: 16px;
            margin-right: 0px;
            margin-bottom: -4px;
            margin-left: -13px;
        }

        .simplebar-mask {
            top: 30px !important;
        }

        @media (max-width: 576px) {
            .navbar-custom .dropdown .dropdown-menu {
                transform: translate3d(10px, 54px, 0px) !important;
            }

            .mynew2>div.dropdown-menu.show {
                width: 350px !important;
                transform: translate3d(0px, 50px, 0px) !important;
            }

            .notification-counter {
                right: 6pc !important;
                top: 1pc !important;
            }

            .mynew1 {
                position: initial;
                margin-right: 20px !important;
            }
        }

        th,
        td {
            font-size: 12px;
        }

        * {
            font-family: Roboto;
        }

        .propcsv2 {
            cursor: pointer;
        }

        .dgrid2 {
            display: grid !important;
            padding: 10px;
        }

        .badge-warning {
            background-color: #f68500 !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            font-size: 8px !important;
            color: #fff !important;
            width: fit-content;
        }

        .badge-success {
            background-color: #0eb50b !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            font-size: 8px !important;
            color: #fff !important;
            width: fit-content;
        }

        .badge-success-light {
            background-color: #ffd600 !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            font-size: 8px !important;
            color: #333 !important;
            width: fit-content;
        }

        .badge-danger {
            background-color: #FF3636 !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            font-size: 8px !important;
            color: #fff !important;
            width: fit-content;
        }

        .badge-infos {
            background-color: #e2e8ed !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            font-size: 8px !important;
            color: #333 !important;
            width: fit-content;
        }

        .badge-info {
            background-color: #0d187c !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            font-size: 8px !important;
            color: #fff !important;
            width: fit-content;
        }

        .text-bluess,
        .text-bluess:hover {
            color: #1A47A3;
            height: 12px;
            font-size: 26px;
        }

        .badge-warning-light {
            background-color: #ffa70f !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            font-size: 8px !important;
            color: #fff !important;
            width: fit-content;
        }

        .notification-counter {
            position: absolute;
            right: 12px;
            top: -5px;
            background-color: #FF3636;
            color: #ffffff;
            padding: 3px 5.5px;
            border-radius: 50px;
            line-height: 1;
            font-size: 8px;
            z-index: 1;
        }

        .rotate180 {
            transform: rotate(180deg) !important;
        }

        @media (max-width: 767.98px) {
            .leftside-menu>a.logo-light {
                margin-top: 4.5rem !important;
            }

            .simplebar-content>ul.side-nav {
                margin-top: 5.5rem !important;
            }
        }

        .msg-counter {
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

        .mynewNoti {
            color: #333;
            background-color: #eaf1ff;
            margin: 3px 3px 7px 3px !important;
            width: -webkit-fill-available;
            border-radius: 5px;
        }

        button.dropdown-toggle {
            background: transparent !important;
            border: transparent !important;
            color: #1A47A3 !important;
        }

        button.dropdown-toggle::after {
            display: none;
        }

        .mynew2>div.dropdown-menu.show {
            /* word-break: break-all; */
            max-width: 350px;
            width: 350px;
        }

        .mynewNoti>div.col>a.dropdown-item {
            white-space: wrap;
        }

        body[data-leftbar-theme="dark"][data-leftbar-compact-mode="condensed"] .side-nav .side-nav-item:hover .side-nav-link {
            background: #F1F5F8 !important;
        }

        .mark-read {
            color: #4d6e96;
        }

        body[data-leftbar-compact-mode="condensed"]:not(.authentication-bg) .wrapper .footer,
        body[data-leftbar-compact-mode="condensed"]:not(.authentication-bg) .wrapper .navbar-custom {
            left: 96px;
        }

        body[data-leftbar-compact-mode="condensed"]:not(.authentication-bg) .wrapper .leftside-menu {
            width: 80px !important;
        }

        a.side-nav-link>i,
        a.side-nav-link>span,
        a._nav-item-text>i,
        a._nav-item-text>span {
            color: #797B7C !important;
        }

        .content-page {
            background-color: #fff !important;
        }

        body[data-leftbar-theme="dark"] .leftside-menu .logo {
            background: #F1F5F8 !important;
        }

        body[data-leftbar-theme="dark"] .leftside-menu {
            background: #F1F5F8 !important;
        }

        body[data-leftbar-theme="dark"] .side-nav .menuitem-active>a {
            background-color: #EAF1FF !important;
        }

        body[data-leftbar-theme="dark"] .side-nav .menuitem-active>a>i,
        body[data-leftbar-theme="dark"] .side-nav .menuitem-active>a>span {
            color: #1A47A3 !important;
        }

        body[data-leftbar-theme="dark"] .side-nav .menuitem-active>a>svg>path {
            fill: #1A47A3 !important;
        }

        ._nav-item-text:hover {
            color: #1A47A3 !important;
        }

        ._nav-item-text:hover>span {
            color: #1A47A3 !important;
        }

        ._nav-item-text:hover>svg>path{
            fill: #1A47A3 !important;
        }

        .side-nav-link:hover>svg>path{
            fill: #1A47A3 !important;
        }

        .side-nav-link:hover>._nav-item-text{
            color: #1A47A3 !important;
        }

        ._nav-item-text:hover>i {
            color: #1A47A3 !important;
        }

        .side-nav-link._nav-item-text,
        .side-nav-second-level {
            background-color: #f1f5f8 !important;
        }

        .mybody {
            background-color: #fff !important;
            border-radius: 5px !important;
        }

        table {
            background-color: #fff !important;
            border-radius: 8px !important;
            border-color: transparent !important;
        }

        tr:last-child td:first-child {
            border-bottom-left-radius: 8px !important;
        }

        tr th {
            border-bottom: 1px solid #e2e8ed;
        }

        tr td:not(:last-child),
        tr th:not(:last-child) {
            border-right: 1px solid #e2e8ed;
        }

        tr:last-child td:last-child {
            border-bottom-right-radius: 8px !important;
        }

        a.mynewDropDown>div.namelogoMax {
            font-family: Arial, sans-serif;
            font-size: 24px;
            color: #333;
            background-color: #eee;
            border-radius: 5px;
            display: inline-block;
            margin: 5px;
        }

        .mynewDropDown {
            padding: .2rem !important;
        }

        .dropdown-item.mark-read.see-all-message {
            display: flex !important;
            justify-content: center !important;
            background: #fff !important;
            border: 1px solid #1A47A3 !important;
            border-radius: 10px !important;
            padding: 10px 0px !important;
            color: #1a47a3 !important;
            width: auto !important;
        }

        ._btn-dangers {
            border-radius: 6px !important;
        }

        button.dt-button {
            background: unset !important;
            padding: 0.45rem 0.7rem !important;
        }
    </style>
</head>

<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid"
    data-rightbar-onstart="true">
    <div id="overlay">
        <div class="loading-overlay"></div>
    </div>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- LOGO -->

            <a href="/dashboard" class="mt-1 pl-1 logo text-center logo-light">
                <span class="logo-lg logo-lg2">
                    <svg class="pl-4 pr-4 pt-2 pb-2" id="Layer_1" viewBox="0 0 286 141" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_176_3917)">
                        <path d="M12.8703 56.6059V67.2022H30.2061V72.191H12.8703V87.9866H8V51.6172H32.0357V56.6059H12.8703Z" fill="#3EA448"/>
                        <path d="M38.168 72.7249V51.6641H42.9725V72.7249C42.9725 79.2406 46.7897 83.9003 52.1866 83.9003C57.5834 83.9003 61.4007 79.2406 61.4007 72.7249V51.6641H66.2579V72.7249C66.2579 82.0575 60.4003 88.6785 52.2129 88.6785C44.0255 88.6785 38.168 82.0707 38.168 72.7249Z" fill="#3EA448"/>
                        <path d="M83.2426 56.6059H72.541V51.6172H98.8671V56.6059H88.1129V88.0393H83.2952L83.2426 56.6059Z" fill="#3EA448"/>
                        <path d="M105.088 72.7249V51.6641H109.892V72.7249C109.892 79.2406 113.697 83.9003 119.107 83.9003C124.517 83.9003 128.321 79.2406 128.321 72.7249V51.6641H133.178V72.7249C133.178 82.0707 127.386 88.6521 119.133 88.6521C110.88 88.6521 105.088 82.0707 105.088 72.7249Z" fill="#3EA448"/>
                        <path d="M158.588 74.8309L166.921 87.9939H161.405L153.402 75.3179H145.886V87.9939H141.068V51.6113H154.837C156.423 51.5465 158.007 51.8065 159.489 52.3751C160.972 52.9438 162.322 53.8093 163.459 54.9185C164.595 56.0277 165.493 57.3571 166.097 58.8255C166.702 60.2939 167 61.8703 166.973 63.458C167.046 66.0178 166.261 68.5284 164.741 70.5896C163.221 72.6508 161.055 74.1439 158.588 74.8309ZM145.886 70.3818H154.166C158.878 70.3818 162.063 67.7492 162.063 63.4843C162.063 59.2195 158.878 56.6 154.166 56.6H145.886V70.3818Z" fill="#3EA448"/>
                        <path d="M177.869 56.6059V66.9916H195.191V71.9673H177.869V83.0505H197.047V88.0393H173.012V51.6172H197.047V56.6059H177.869Z" fill="#3EA448"/>
                        <path d="M215.152 37.3957L203.186 89.2648C202.493 92.2683 204.366 95.2648 207.37 95.9577L259.239 107.923C262.242 108.616 265.239 106.743 265.932 103.739L277.897 51.8702C278.59 48.8667 276.717 45.8702 273.713 45.1774L221.844 33.212C218.841 32.5191 215.844 34.3923 215.152 37.3957Z" fill="#3EA448"/>
                        <path d="M211.493 60.0263V66.8316H228.17V75.2954H211.493V89.551H203.016V51.5625H229.855V60.0263H211.493Z" fill="white"/>
                        <path d="M235.064 51.5625H243.555V89.551H235.064V51.5625Z" fill="white"/>
                        <path d="M258.55 60.0263H248.178V51.5625H277.36V60.0263H267.04V89.551H258.55V60.0263Z" fill="white"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_176_3917">
                        <rect width="270" height="74.9898" fill="white" transform="translate(8 33.0078)"/>
                        </clipPath>
                        </defs>
                        </svg>
                        
                </span>
                {{-- <span class="logo-sm">
                    <img src="{{ asset('assets/images/small_new_logo.svg') }}" class="img-fluid"
                        style="max-height: 130px">

                </span> --}}
                <span class="logo-sm">
                    <svg class="img-fluid" width="68" height="68" viewBox="0 0 68 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_176_3941)">
                        <path d="M12.0939 4.81496L1.54542 50.5417C0.934609 53.1895 2.58592 55.8311 5.23373 56.4419L50.9604 66.9903C53.6082 67.6011 56.2498 65.9498 56.8606 63.302L67.4091 17.5753C68.0199 14.9275 66.3686 12.2859 63.7208 11.6751L17.9941 1.12665C15.3463 0.515841 12.7047 2.16715 12.0939 4.81496Z" fill="#3EA448"/>
                        <path d="M8.86572 24.7662V30.7656H23.5683V38.2271H8.86572V50.7945H1.39258V17.3047H25.0537V24.7662H8.86572Z" fill="white"/>
                        <path d="M29.6484 17.3047H37.1332V50.7945H29.6484V17.3047Z" fill="white"/>
                        <path d="M50.3531 24.7662H41.209V17.3047H66.9356V24.7662H57.8379V50.7945H50.3531V24.7662Z" fill="white"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_176_3941">
                        <rect width="67" height="66.1184" fill="white" transform="translate(0.5 0.9375)"/>
                        </clipPath>
                        </defs>
                    </svg>
                </span>
            </a>


            <!-- LOGO -->
            {{-- <a href="/dashboard" class="mt-3 logo text-center logo-dark">
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid">
                </span>
            </a> --}}

            <div class="h-100 mt-3" id="leftside-menu-container" data-simplebar>

                <!--- Sidemenu -->
                <ul class="side-nav mt-3">

                    @if (Auth::user()->role == 'admin')

                        <li class="side-nav-item">
                            <a href="/dashboard" class="side-nav-link">
                                {{-- <i class="uil-chart _nav-item-text"></i> --}}
                                <svg width="18" height="18" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" style="margin: 0 10px 0 0;">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.5 0.75C2.87665 0.75 0.75 2.87665 0.75 5.5C0.75 8.12335 2.87665 10.25 5.5 10.25C8.12335 10.25 10.25 8.12335 10.25 5.5C10.25 2.87665 8.12335 0.75 5.5 0.75ZM2.25 5.5C2.25 3.70507 3.70507 2.25 5.5 2.25C7.29493 2.25 8.75 3.70507 8.75 5.5C8.75 7.29493 7.29493 8.75 5.5 8.75C3.70507 8.75 2.25 7.29493 2.25 5.5Z"
                                        fill="#797B7C" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.5 11.75C13.8766 11.75 11.75 13.8766 11.75 16.5C11.75 19.1234 13.8766 21.25 16.5 21.25C19.1234 21.25 21.25 19.1234 21.25 16.5C21.25 13.8766 19.1234 11.75 16.5 11.75ZM13.25 16.5C13.25 14.7051 14.7051 13.25 16.5 13.25C18.2949 13.25 19.75 14.7051 19.75 16.5C19.75 18.2949 18.2949 19.75 16.5 19.75C14.7051 19.75 13.25 18.2949 13.25 16.5Z"
                                        fill="#797B7C" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.75 5.5C11.75 2.87665 13.8766 0.75 16.5 0.75C19.1234 0.75 21.25 2.87665 21.25 5.5C21.25 8.12335 19.1234 10.25 16.5 10.25C13.8766 10.25 11.75 8.12335 11.75 5.5ZM16.5 2.25C14.7051 2.25 13.25 3.70507 13.25 5.5C13.25 7.29493 14.7051 8.75 16.5 8.75C18.2949 8.75 19.75 7.29493 19.75 5.5C19.75 3.70507 18.2949 2.25 16.5 2.25Z"
                                        fill="#797B7C" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.5 11.75C2.87665 11.75 0.75 13.8766 0.75 16.5C0.75 19.1234 2.87665 21.25 5.5 21.25C8.12335 21.25 10.25 19.1234 10.25 16.5C10.25 13.8766 8.12335 11.75 5.5 11.75ZM2.25 16.5C2.25 14.7051 3.70507 13.25 5.5 13.25C7.29493 13.25 8.75 14.7051 8.75 16.5C8.75 18.2949 7.29493 19.75 5.5 19.75C3.70507 19.75 2.25 18.2949 2.25 16.5Z"
                                        fill="#797B7C" />
                                </svg>
                                <span class="_nav-item-text"> Dashboard </span>
                            </a>
                        </li>


                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#create-and-manage" aria-expanded="false"
                                aria-controls="sidebarPages" class="side-nav-link _nav-item-text">
                                {{-- <i class="uil-copy-alt"></i> --}}
                                <svg width="18" height="18" viewBox="0 0 20 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" style="margin: 0 10px 0 0;">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 7.25C7.92893 7.25 6.25 8.92893 6.25 11C6.25 13.0711 7.92893 14.75 10 14.75C12.0711 14.75 13.75 13.0711 13.75 11C13.75 8.92893 12.0711 7.25 10 7.25ZM7.75 11C7.75 9.75736 8.75736 8.75 10 8.75C11.2426 8.75 12.25 9.75736 12.25 11C12.25 12.2426 11.2426 13.25 10 13.25C8.75736 13.25 7.75 12.2426 7.75 11Z"
                                        fill="#797B7C" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 0.25C9.29541 0.25 8.65185 0.443593 7.94858 0.770366C7.26808 1.08656 6.48039 1.55304 5.49457 2.13685L4.74148 2.58283C3.75533 3.16682 2.96771 3.63324 2.36076 4.07944C1.73315 4.54083 1.25177 5.01311 0.903344 5.63212C0.555476 6.25014 0.398411 6.91095 0.323055 7.69506C0.249985 8.45539 0.249992 9.38651 0.25 10.556V11.444C0.249992 12.6135 0.249985 13.5446 0.323055 14.3049C0.398411 15.0891 0.555476 15.7499 0.903344 16.3679C1.25177 16.9869 1.73315 17.4592 2.36076 17.9206C2.96771 18.3668 3.75533 18.8332 4.74148 19.4172L5.4946 19.8632C6.48038 20.447 7.2681 20.9135 7.94858 21.2296C8.65185 21.5564 9.29541 21.75 10 21.75C10.7046 21.75 11.3481 21.5564 12.0514 21.2296C12.7319 20.9134 13.5196 20.447 14.5054 19.8632L15.2585 19.4172C16.2446 18.8332 17.0323 18.3668 17.6392 17.9206C18.2669 17.4592 18.7482 16.9869 19.0967 16.3679C19.4445 15.7499 19.6016 15.0891 19.6769 14.3049C19.75 13.5446 19.75 12.6135 19.75 11.4441V10.556C19.75 9.38656 19.75 8.45538 19.6769 7.69506C19.6016 6.91095 19.4445 6.25014 19.0967 5.63212C18.7482 5.01311 18.2669 4.54083 17.6392 4.07944C17.0323 3.63324 16.2447 3.16683 15.2585 2.58285L14.5054 2.13685C13.5196 1.55303 12.7319 1.08656 12.0514 0.770365C11.3481 0.443592 10.7046 0.25 10 0.25ZM6.22524 3.44744C7.25238 2.83917 7.97606 2.41161 8.58065 2.13069C9.1702 1.85676 9.59074 1.75 10 1.75C10.4093 1.75 10.8298 1.85676 11.4193 2.13069C12.0239 2.41161 12.7476 2.83917 13.7748 3.44744L14.4609 3.85379C15.4879 4.46197 16.2109 4.89115 16.7508 5.288C17.2767 5.67467 17.581 5.99746 17.7895 6.36788C17.9986 6.73929 18.1199 7.1739 18.1838 7.83855C18.2492 8.51884 18.25 9.37802 18.25 10.5937V11.4063C18.25 12.622 18.2492 13.4812 18.1838 14.1614C18.1199 14.8261 17.9986 15.2607 17.7895 15.6321C17.581 16.0025 17.2767 16.3253 16.7508 16.712C16.2109 17.1089 15.4879 17.538 14.4609 18.1462L13.7748 18.5526C12.7476 19.1608 12.0239 19.5884 11.4193 19.8693C10.8298 20.1432 10.4093 20.25 10 20.25C9.59074 20.25 9.1702 20.1432 8.58065 19.8693C7.97606 19.5884 7.25238 19.1608 6.22524 18.5526L5.53909 18.1462C4.5121 17.538 3.78906 17.1089 3.24923 16.712C2.72326 16.3253 2.419 16.0025 2.2105 15.6321C2.00145 15.2607 1.88005 14.8261 1.81618 14.1614C1.7508 13.4812 1.75 12.622 1.75 11.4063V10.5937C1.75 9.37802 1.7508 8.51884 1.81618 7.83855C1.88005 7.1739 2.00145 6.73929 2.2105 6.36788C2.419 5.99746 2.72326 5.67467 3.24923 5.288C3.78906 4.89115 4.5121 4.46197 5.53909 3.85379L6.22524 3.44744Z"
                                        fill="#797B7C" />
                                </svg>
                                <span> Create & Manage </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="create-and-manage">
                                <ul class="side-nav-second-level">


                                    <li>
                                        <a class="_nav-item-text" href="{{ route('client') }}">
                                            <i class="dripicons-user-group"></i>
                                            <span>&nbsp; Clients</span>
                                        </a>
                                    </li>


                                    <li>
                                        <a class="_nav-item-text" href="{{ route('property', 0) }}">
                                            <i class="dripicons-home"></i>
                                            <span>&nbsp; Properties</span>
                                        </a>
                                    </li>


                                    <li>
                                        <a class="_nav-item-text" href="{{ route('batch') }}">
                                            <i class="dripicons-document"></i>
                                            <span>&nbsp; Batches</span>
                                        </a>
                                    </li>


                                    <li>
                                        <a class="_nav-item-text" href="{{ route('contractor') }}">
                                            <i class="dripicons-user-id"></i>
                                            <span>&nbsp; Contractors</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="_nav-item-text" href="{{ route('assessor') }}">
                                            <i class="dripicons-scale"></i>
                                            <span>&nbsp; HEA/BER Assessors</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        @php
                            $lead_scheme = collect($schemes)->first(function ($scheme) {
                                return $scheme->scheme == 'Leads';
                            });
                            if (is_null($lead_scheme)) {
                                $lead_scheme = [];
                            }
                        @endphp


                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#properies" aria-expanded="false"
                                aria-controls="sidebarPages" class="side-nav-link _nav-item-text">
                                {{-- <i class="uil-home"></i> --}}
                                <svg width="18" height="18" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" style="margin: 0 10px 0 0;">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M13.948 0.250001H16.052C16.9505 0.249972 17.6997 0.249947 18.2945 0.329913C18.9223 0.414318 19.4891 0.599989 19.9445 1.05546C20.4 1.51093 20.5857 2.07773 20.6701 2.70552C20.7501 3.30031 20.75 4.04953 20.75 4.94801V20.25H21C21.4142 20.25 21.75 20.5858 21.75 21C21.75 21.4142 21.4142 21.75 21 21.75H1C0.585786 21.75 0.25 21.4142 0.25 21C0.25 20.5858 0.585786 20.25 1 20.25H1.25L1.25 7.948C1.24997 7.04952 1.24994 6.3003 1.32991 5.70552C1.41432 5.07773 1.59999 4.51093 2.05546 4.05546C2.51093 3.59999 3.07773 3.41432 3.70552 3.32991C4.3003 3.24995 5.04952 3.24997 5.948 3.25L9.27799 3.25C9.32944 2.37583 9.4906 1.62032 10.0555 1.05546C10.5109 0.599989 11.0777 0.414318 11.7055 0.329913C12.3003 0.249947 13.0495 0.249972 13.948 0.250001ZM10.0068 4.75C10.0055 4.75 10.0043 4.75 10.003 4.75C10.002 4.75 10.001 4.75 10 4.75H6C5.03599 4.75 4.38843 4.7516 3.90539 4.81654C3.44393 4.87858 3.24643 4.9858 3.11612 5.11612C2.9858 5.24644 2.87858 5.44393 2.81654 5.90539C2.75159 6.38843 2.75 7.03599 2.75 8V20.25H7.25V18C7.25 17.5858 7.58579 17.25 8 17.25C8.41421 17.25 8.75 17.5858 8.75 18V20.25H13.25V8C13.25 7.03599 13.2484 6.38843 13.1835 5.90539C13.1214 5.44393 13.0142 5.24644 12.8839 5.11612C12.7536 4.9858 12.5561 4.87858 12.0946 4.81654C11.6127 4.75175 10.9671 4.75001 10.0068 4.75ZM14.75 20.25L14.75 7.94801C14.75 7.04953 14.7501 6.30031 14.6701 5.70552C14.5857 5.07773 14.4 4.51093 13.9445 4.05546C13.4891 3.59999 12.9223 3.41432 12.2945 3.32991C11.8691 3.27273 11.3648 3.25645 10.7834 3.25183C10.8335 2.55219 10.9436 2.28863 11.1161 2.11612C11.2464 1.9858 11.4439 1.87858 11.9054 1.81654C12.3884 1.7516 13.036 1.75 14 1.75H16C16.964 1.75 17.6116 1.7516 18.0946 1.81654C18.5561 1.87858 18.7536 1.9858 18.8839 2.11612C19.0142 2.24644 19.1214 2.44393 19.1835 2.90539C19.2484 3.38843 19.25 4.03599 19.25 5V20.25H14.75ZM4.25 7C4.25 6.58579 4.58579 6.25 5 6.25H11C11.4142 6.25 11.75 6.58579 11.75 7C11.75 7.41422 11.4142 7.75 11 7.75H5C4.58579 7.75 4.25 7.41422 4.25 7ZM4.25 10C4.25 9.58579 4.58579 9.25 5 9.25H11C11.4142 9.25 11.75 9.58579 11.75 10C11.75 10.4142 11.4142 10.75 11 10.75H5C4.58579 10.75 4.25 10.4142 4.25 10ZM4.25 13C4.25 12.5858 4.58579 12.25 5 12.25H11C11.4142 12.25 11.75 12.5858 11.75 13C11.75 13.4142 11.4142 13.75 11 13.75H5C4.58579 13.75 4.25 13.4142 4.25 13Z"
                                        fill="#797B7C" />
                                </svg>
                                <span> Properties </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="properies">
                                <ul class="side-nav-second-level">

                                    @foreach ($schemes as $scheme)
                                        @if(isset($lead_scheme->id) && $lead_scheme->id !== $scheme->id)
                                            <li>
                                                <a class="_nav-item-text" href="{{ route('property', $scheme->id) }}">
                                                    <i class="uil-coins"></i>
                                                    <span>&nbsp; {{ $scheme->scheme }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach

                                    <li>
                                        <a class="_nav-item-text" href="{{ route('property', 909090909090) }}">
                                            <i class="uil-coins"></i>
                                            <span>&nbsp; Archieved Home</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @if($lead_scheme)
                            <li class="side-nav-item {{Request::segment(2) == "lead" ? "menuitem-active" : ""}}">
                                <a href="{{ route('lead', $lead_scheme->id) }}" class="side-nav-link">
                                    {{-- <i class="uil-chart _nav-item-text"></i> --}}
                                    <svg width="18" height="18" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" style="margin: 0 10px 0 0;">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.5 0.75C2.87665 0.75 0.75 2.87665 0.75 5.5C0.75 8.12335 2.87665 10.25 5.5 10.25C8.12335 10.25 10.25 8.12335 10.25 5.5C10.25 2.87665 8.12335 0.75 5.5 0.75ZM2.25 5.5C2.25 3.70507 3.70507 2.25 5.5 2.25C7.29493 2.25 8.75 3.70507 8.75 5.5C8.75 7.29493 7.29493 8.75 5.5 8.75C3.70507 8.75 2.25 7.29493 2.25 5.5Z"
                                            fill="#797B7C" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.5 11.75C13.8766 11.75 11.75 13.8766 11.75 16.5C11.75 19.1234 13.8766 21.25 16.5 21.25C19.1234 21.25 21.25 19.1234 21.25 16.5C21.25 13.8766 19.1234 11.75 16.5 11.75ZM13.25 16.5C13.25 14.7051 14.7051 13.25 16.5 13.25C18.2949 13.25 19.75 14.7051 19.75 16.5C19.75 18.2949 18.2949 19.75 16.5 19.75C14.7051 19.75 13.25 18.2949 13.25 16.5Z"
                                            fill="#797B7C" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11.75 5.5C11.75 2.87665 13.8766 0.75 16.5 0.75C19.1234 0.75 21.25 2.87665 21.25 5.5C21.25 8.12335 19.1234 10.25 16.5 10.25C13.8766 10.25 11.75 8.12335 11.75 5.5ZM16.5 2.25C14.7051 2.25 13.25 3.70507 13.25 5.5C13.25 7.29493 14.7051 8.75 16.5 8.75C18.2949 8.75 19.75 7.29493 19.75 5.5C19.75 3.70507 18.2949 2.25 16.5 2.25Z"
                                            fill="#797B7C" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.5 11.75C2.87665 11.75 0.75 13.8766 0.75 16.5C0.75 19.1234 2.87665 21.25 5.5 21.25C8.12335 21.25 10.25 19.1234 10.25 16.5C10.25 13.8766 8.12335 11.75 5.5 11.75ZM2.25 16.5C2.25 14.7051 3.70507 13.25 5.5 13.25C7.29493 13.25 8.75 14.7051 8.75 16.5C8.75 18.2949 7.29493 19.75 5.5 19.75C3.70507 19.75 2.25 18.2949 2.25 16.5Z"
                                            fill="#797B7C" />
                                    </svg>
                                    <span class="_nav-item-text"> Leads </span>
                                </a>
                            </li>
                        @endif
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#lookups" aria-expanded="false"
                                aria-controls="sidebarPages" class="side-nav-link _nav-item-text">
                                {{-- <i class="uil-search"></i> --}}
                                <svg width="15" height="15" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" style="margin: 0 13px 0 2px;">
                                    <path
                                        d="M17.2892 1.88976C16.2615 1.75159 14.9068 1.75 13 1.75C12.5858 1.75 12.25 1.41421 12.25 1C12.25 0.585788 12.5858 0.25 13 0.25H13.0564C14.8942 0.249985 16.3498 0.249973 17.489 0.403136C18.6615 0.560764 19.6104 0.892881 20.3588 1.64124C21.0432 2.32568 21.417 2.97665 21.5924 3.98199C21.7501 4.88571 21.7501 6.1045 21.75 7.90369L21.75 8C21.75 8.41422 21.4142 8.75 21 8.75C20.5858 8.75 20.25 8.41422 20.25 8C20.25 6.08092 20.2471 4.9986 20.1147 4.23984C19.9973 3.56666 19.7852 3.18904 19.2981 2.7019C18.8749 2.27869 18.2952 2.02503 17.2892 1.88976Z"
                                        fill="#797B7C" />
                                    <path
                                        d="M1.75001 14C1.75001 13.5858 1.41422 13.25 1.00001 13.25C0.585792 13.25 0.250005 13.5858 0.250005 14L0.250002 14.0963C0.249954 15.8955 0.249922 17.1143 0.407616 18.018C0.583043 19.0233 0.956812 19.6743 1.64125 20.3588C2.38961 21.1071 3.33856 21.4392 4.51098 21.5969C5.6502 21.75 7.10583 21.75 8.94359 21.75H9C9.41422 21.75 9.75001 21.4142 9.75001 21C9.75001 20.5858 9.41422 20.25 9 20.25C7.09318 20.25 5.73852 20.2484 4.71085 20.1102C3.70476 19.975 3.12512 19.7213 2.70191 19.2981C2.21477 18.811 2.00275 18.4333 1.88529 17.7602C1.75289 17.0014 1.75001 15.9191 1.75001 14Z"
                                        fill="#797B7C" />
                                    <path
                                        d="M21.75 14C21.75 13.5858 21.4142 13.25 21 13.25C20.5858 13.25 20.25 13.5858 20.25 14C20.25 15.9191 20.2471 17.0014 20.1147 17.7602C19.9973 18.4333 19.7852 18.811 19.2981 19.2981C18.8749 19.7213 18.2952 19.975 17.2892 20.1102C16.2615 20.2484 14.9068 20.25 13 20.25C12.5858 20.25 12.25 20.5858 12.25 21C12.25 21.4142 12.5858 21.75 13 21.75H13.0564C14.8942 21.75 16.3498 21.75 17.489 21.5969C18.6615 21.4392 19.6104 21.1071 20.3588 20.3588C21.0432 19.6743 21.417 19.0233 21.5924 18.018C21.7501 17.1143 21.7501 15.8955 21.75 14.0963L21.75 14Z"
                                        fill="#797B7C" />
                                    <path
                                        d="M9.00001 0.25H8.94359C7.10584 0.249985 5.65019 0.249973 4.51098 0.403136C3.33856 0.560764 2.38961 0.892881 1.64125 1.64124C0.956811 2.32568 0.583043 2.97665 0.407616 3.98199C0.249922 4.8857 0.249954 6.10448 0.250002 7.90364L0.250005 8C0.250005 8.41422 0.585792 8.75 1.00001 8.75C1.41422 8.75 1.75001 8.41422 1.75001 8C1.75001 6.08092 1.75289 4.9986 1.88529 4.23984C2.00275 3.56666 2.21477 3.18904 2.70191 2.7019C3.12512 2.27869 3.70476 2.02503 4.71085 1.88976C5.73852 1.75159 7.09319 1.75 9.00001 1.75C9.41422 1.75 9.75001 1.41421 9.75001 1C9.75001 0.585788 9.41422 0.25 9.00001 0.25Z"
                                        fill="#797B7C" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11 8.25C9.48122 8.25 8.25001 9.48122 8.25001 11C8.25001 12.5188 9.48122 13.75 11 13.75C12.5188 13.75 13.75 12.5188 13.75 11C13.75 9.48122 12.5188 8.25 11 8.25ZM9.75001 11C9.75001 10.3096 10.3096 9.75 11 9.75C11.6904 9.75 12.25 10.3096 12.25 11C12.25 11.6904 11.6904 12.25 11 12.25C10.3096 12.25 9.75001 11.6904 9.75001 11Z"
                                        fill="#797B7C" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.32438 8.45049C5.59435 6.97738 7.77637 5.25 11 5.25C14.2236 5.25 16.4057 6.97738 17.6756 8.45049L17.7079 8.48791C17.9789 8.80202 18.2576 9.12501 18.4491 9.51207C18.6632 9.94484 18.75 10.4094 18.75 11C18.75 11.5906 18.6632 12.0552 18.4491 12.4879C18.2576 12.875 17.9789 13.198 17.7079 13.5121L17.6756 13.5495C16.4057 15.0226 14.2236 16.75 11 16.75C7.77637 16.75 5.59435 15.0226 4.32438 13.5495L4.29211 13.5121C4.0211 13.198 3.7424 12.875 3.5509 12.4879C3.33676 12.0552 3.25001 11.5906 3.25001 11C3.25001 10.4094 3.33676 9.94484 3.5509 9.51207C3.74241 9.12501 4.02109 8.80202 4.2921 8.48791L4.32438 8.45049ZM11 6.75C8.369 6.75 6.56642 8.14707 5.46048 9.42992C5.14652 9.7941 4.99368 9.9785 4.89533 10.1773C4.81198 10.3457 4.75001 10.566 4.75001 11C4.75001 11.434 4.81198 11.6543 4.89533 11.8227C4.99368 12.0215 5.14652 12.2059 5.46048 12.5701C6.56642 13.8529 8.369 15.25 11 15.25C13.631 15.25 15.4336 13.8529 16.5395 12.5701C16.8535 12.2059 17.0063 12.0215 17.1047 11.8227C17.188 11.6543 17.25 11.434 17.25 11C17.25 10.566 17.188 10.3457 17.1047 10.1773C17.0063 9.9785 16.8535 9.7941 16.5395 9.42992C15.4336 8.14707 13.631 6.75 11 6.75Z"
                                        fill="#797B7C" />
                                </svg>
                                <span> Lookups </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="lookups">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a class="_nav-item-text" href="{{ route('lookup.job') }}">
                                            <i class="uil-list-ui-alt"></i>
                                            <span>&nbsp; Job (Measures)</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="_nav-item-text" href="{{ route('lookup.scheme') }}">
                                            <i class="uil-list-ui-alt"></i>
                                            <span>&nbsp; Schemes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="_nav-item-text" href="{{ route('document.index') }}">
                                            <i class="uil-list-ui-alt"></i>
                                            <span>&nbsp; Documents</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="_nav-item-text" href="{{ route('toolboxTalk') }}">
                                            <i class="uil-list-ui-alt"></i>
                                            <span>&nbsp; Toolbox Talk</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="_nav-item-text" href="{{ route('photoFolder') }}">
                                            <i class="uil-list-ui-alt"></i>
                                            <span>&nbsp; Folders</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#users" aria-expanded="false"
                                aria-controls="sidebarPages" class="side-nav-link _nav-item-text">
                                {{-- <i class="dripicons-user-group"></i> --}}
                                <svg width="18" height="18" viewBox="0 0 18 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" style="margin: 0 10px 0 0px;">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.99989 0.25C6.37654 0.25 4.24989 2.37665 4.24989 5C4.24989 7.62335 6.37654 9.75 8.99989 9.75C11.6232 9.75 13.7499 7.62335 13.7499 5C13.7499 2.37665 11.6232 0.25 8.99989 0.25ZM5.74989 5C5.74989 3.20507 7.20496 1.75 8.99989 1.75C10.7948 1.75 12.2499 3.20507 12.2499 5C12.2499 6.79493 10.7948 8.25 8.99989 8.25C7.20496 8.25 5.74989 6.79493 5.74989 5Z"
                                        fill="#797B7C" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.99989 11.25C6.68634 11.25 4.55481 11.7759 2.97534 12.6643C1.41937 13.5396 0.24989 14.8661 0.24989 16.5L0.249824 16.602C0.248694 17.7638 0.247276 19.222 1.5263 20.2635C2.15577 20.7761 3.03637 21.1406 4.2261 21.3815C5.41915 21.6229 6.97412 21.75 8.99989 21.75C11.0257 21.75 12.5806 21.6229 13.7737 21.3815C14.9634 21.1406 15.844 20.7761 16.4735 20.2635C17.7525 19.222 17.7511 17.7638 17.75 16.602L17.7499 16.5C17.7499 14.8661 16.5804 13.5396 15.0244 12.6643C13.445 11.7759 11.3134 11.25 8.99989 11.25ZM1.74989 16.5C1.74989 15.6487 2.37127 14.7251 3.71073 13.9717C5.02669 13.2315 6.89516 12.75 8.99989 12.75C11.1046 12.75 12.9731 13.2315 14.289 13.9717C15.6285 14.7251 16.2499 15.6487 16.2499 16.5C16.2499 17.8078 16.2096 18.544 15.5263 19.1004C15.1558 19.4022 14.5364 19.6967 13.4761 19.9113C12.4192 20.1252 10.9741 20.25 8.99989 20.25C7.02566 20.25 5.58063 20.1252 4.52368 19.9113C3.46341 19.6967 2.84401 19.4022 2.47348 19.1004C1.79021 18.544 1.74989 17.8078 1.74989 16.5Z"
                                        fill="#797B7C" />
                                </svg>
                                <span> Users </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="users">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a class="_nav-item-text" href="{{ route('user') }}">
                                            <i class="uil-500px"></i>
                                            <span>&nbsp; Admin</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="_nav-item-text" href="{{ route('surveyor') }}">
                                            <i class="uil-user-circle"></i>
                                            <span>&nbsp; App User</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a href="/dashboard/contractor-chat"
                                class="side-nav-link @if (Request::segment(2) == 'contractor-chat/*') active @endif">

                                <svg class="mysvgmsg" width="24" height="25" viewBox="0 0 24 25"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.0001 3.58905H17.9221C19.1328 3.56312 20.3125 3.97293 21.2464 4.74382C22.1803 5.51471 22.8062 6.5954 23.0101 7.78905C23.0661 8.07963 23.0922 8.37516 23.0881 8.67105C23.0881 11.207 23.0881 13.743 23.0881 16.279C23.1001 17.4715 22.6898 18.6298 21.93 19.5489C21.1701 20.468 20.1096 21.0887 18.9361 21.301C18.5734 21.362 18.2059 21.3901 17.8381 21.385C13.9381 21.385 10.0381 21.385 6.13811 21.385C5.4678 21.4058 4.80002 21.2934 4.17347 21.0543C3.54691 20.8152 2.97401 20.4541 2.48795 19.9921C2.0019 19.53 1.61234 18.9761 1.34184 18.3624C1.07134 17.7488 0.92528 17.0876 0.912109 16.4171C0.912109 13.781 0.912109 11.1451 0.912109 8.50905C0.949595 7.22072 1.47692 5.99516 2.38661 5.08212C3.29631 4.16908 4.51993 3.63726 5.80811 3.59505H12.0001V3.58905ZM21.1501 6.78105C21.0661 6.88305 21.0241 6.96105 20.9641 7.02105C19.0961 8.88905 17.2281 10.757 15.3601 12.625C14.9229 13.0745 14.4 13.4317 13.8224 13.6756C13.2448 13.9195 12.6241 14.0452 11.9971 14.0452C11.3701 14.0452 10.7495 13.9195 10.1718 13.6756C9.59421 13.4317 9.07134 13.0745 8.63411 12.625C6.76611 10.745 4.88811 8.87105 3.00011 7.00305C2.94611 6.94305 2.88611 6.88905 2.81411 6.82305C2.49187 7.34461 2.31765 7.94402 2.31011 8.55705C2.31011 11.1851 2.31011 13.813 2.31011 16.435C2.32429 17.3804 2.70983 18.2823 3.38343 18.9458C4.05703 19.6093 4.96461 19.9812 5.91011 19.9811C9.97411 19.9811 14.0361 19.9811 18.0961 19.9811C19.0393 19.9735 19.9425 19.5992 20.6144 18.9373C21.2864 18.2754 21.6743 17.378 21.6961 16.435C21.6961 13.813 21.6961 11.1851 21.6961 8.55705C21.6827 7.92669 21.4958 7.31221 21.1561 6.78105H21.1501ZM3.75011 5.78505C3.87011 5.87505 3.96611 5.93505 4.04411 6.00705C5.91611 7.87105 7.78411 9.73905 9.64811 11.6111C9.9532 11.9341 10.321 12.1914 10.7291 12.3673C11.1371 12.5432 11.5768 12.6339 12.0211 12.6339C12.4654 12.6339 12.9051 12.5432 13.3131 12.3673C13.7212 12.1914 14.089 11.9341 14.3941 11.6111C16.2901 9.72305 18.1801 7.83105 20.0641 5.93505L20.2501 5.73705C20.1594 5.66833 20.0653 5.60425 19.9681 5.54505C19.3555 5.1678 18.6475 4.97415 17.9281 4.98705H10.0681C8.65211 4.98705 7.24211 4.98705 5.83211 4.98705C5.06187 5.01626 4.3223 5.2965 3.72611 5.78505H3.75011Z"
                                        fill="#797B7C" />
                                </svg>

                                <span class="_nav-item-text"> Messages </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="/dashboard/scheduler"
                                class="side-nav-link @if (Request::segment(2) == 'scheduler/*') active @endif">

                                <i class="uil-calender"></i>

                                <span class="_nav-item-text"> Scheduler </span>
                            </a>
                        </li>
                        @if (Auth::user()->email == "test_admin@bcrcomply.com" || Auth::user()->email == "bcrretrofit@gmail.com")
                        <li class="side-nav-item">
                            <a href="{{ route('errorlogs') }}"
                                class="side-nav-link @if (Request::segment(2) == 'error-logs/*') active @endif">

                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin: 0 11px 0 1px;">
                                    <path d="M22.7029 17.3901C22.6207 16.9074 22.4518 16.4435 22.2045 16.0208C19.9203 12.0608 17.6345 8.10152 15.347 4.14297C14.718 3.05551 13.7928 2.36117 12.5359 2.21444C10.8493 2.01401 9.53043 2.6574 8.67442 4.12968C6.36772 8.09303 4.07302 12.0634 1.79032 16.0408C1.33906 16.8231 1.15634 17.6653 1.29587 18.5612C1.59099 20.4543 3.15075 21.8097 5.08703 21.8153C9.6923 21.8286 14.297 21.8286 18.9012 21.8153C20.6066 21.8103 21.9919 20.7743 22.5495 19.1681C22.6264 18.9466 22.6148 18.7024 22.7499 18.5036V17.4959C22.6912 17.4782 22.7089 17.4272 22.7029 17.3901ZM19.7644 19.8934C19.4405 20.044 19.0955 20.0839 18.7434 20.0839H11.9623C9.70872 20.0839 7.45537 20.0839 5.20219 20.0839C4.41373 20.0839 3.76259 19.807 3.33015 19.1304C2.91045 18.4754 2.83958 17.7666 3.20502 17.0784C3.70334 16.1371 4.25704 15.2202 4.79135 14.2955C6.56318 11.2247 8.3363 8.15412 10.1107 5.08369C10.4429 4.51062 10.8809 4.09867 11.5403 3.94973C12.3908 3.75704 13.2712 4.08372 13.7263 4.83232C14.3974 5.93528 15.0314 7.06094 15.6776 8.17885C17.3468 11.0677 19.0152 13.957 20.683 16.847C21.3463 17.9981 20.936 19.3486 19.7644 19.8934Z" fill="#797B7C"/>
                                    <path d="M13.0905 9.54828C13.0047 11.0183 12.9205 12.4773 12.8347 13.9363C12.8231 14.1312 12.8458 14.3272 12.8081 14.5216C12.7273 14.9396 12.3984 15.2231 11.9892 15.2198C11.58 15.2165 11.2417 14.9479 11.1947 14.531C11.1332 13.9828 11.1144 13.4297 11.08 12.8788C11.0108 11.7625 10.9488 10.6452 10.8735 9.52946C10.8126 8.62804 11.5822 7.96472 12.3685 8.25596C12.8114 8.42207 13.0423 8.75429 13.0883 9.2216C13.0994 9.33511 13.0905 9.44807 13.0905 9.54828Z" fill="#797B7C"/>
                                    <path d="M13.0803 17.0887C13.0803 17.3779 12.9655 17.6553 12.761 17.86C12.5566 18.0646 12.2793 18.1797 11.9901 18.18C11.701 18.1754 11.4252 18.0579 11.2215 17.8526C11.0179 17.6474 10.9027 17.3706 10.9004 17.0815C10.9016 16.7885 11.0188 16.508 11.2263 16.3013C11.4338 16.0946 11.7148 15.9785 12.0078 15.9785C12.6102 15.9824 13.0731 16.463 13.0803 17.0887Z" fill="#797B7C"/>
                                <defs>
                                <clipPath id="clip0_1700_11189">
                                <rect width="21.5" height="19.6462" fill="white" transform="translate(1.25 2.17676)"/>
                                </clipPath>
                                </defs>
                            </svg>

                                <span class="_nav-item-text"> Error Logs </span>
                            </a>
                        </li>
                        @endif
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#config" aria-expanded="false"
                                aria-controls="sidebarPages" class="side-nav-link _nav-item-text">
                                {{-- <i class="dripicons-gear"></i> --}}
                                <svg width="22" height="22" viewBox="0 0 84 84" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" style="margin: 0 10px 0 0px;">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M39.8474 13.3846C37.5367 20.3338 29.6025 23.6202 23.0548 20.3402C21.3178 19.4701 19.4697 21.3141 20.3416 23.0548C23.6209 29.6022 20.3353 37.5367 13.386 39.8477C11.5401 40.4616 11.5401 43.0726 13.386 43.6864C20.3353 45.9975 23.6209 53.932 20.3416 60.4793C19.4697 62.22 21.3178 64.0641 23.0548 63.1939C29.6025 59.9139 37.5367 63.2003 39.8474 70.1496C40.461 71.995 43.0714 71.995 43.6851 70.1496C45.9957 63.2003 53.9299 59.9139 60.4776 63.1939C62.2146 64.0641 64.0627 62.22 63.1909 60.4793C59.9115 53.932 63.1971 45.9975 70.1464 43.6864C71.9923 43.0726 71.9923 40.4616 70.1464 39.8477C63.1971 37.5367 59.9116 29.6022 63.1909 23.0548C64.0627 21.3141 62.2146 19.4701 60.4776 20.3402C53.9299 23.6202 45.9957 20.3338 43.6851 13.3846C43.0714 11.5391 40.461 11.5391 39.8474 13.3846ZM48.4296 11.807C46.2987 5.39832 37.2337 5.39832 35.1028 11.807C33.7531 15.866 29.1187 17.7856 25.2942 15.8698C19.256 12.845 12.8465 19.2556 15.871 25.294C17.7866 29.1186 15.8672 33.7533 11.8082 35.1032C5.3994 37.2345 5.3994 46.2997 11.8082 48.431C15.8672 49.7808 17.7866 54.4155 15.871 58.2402C12.8465 64.2786 19.256 70.6892 25.2942 67.6644C29.1187 65.7486 33.7531 67.6681 35.1028 71.7272C37.2337 78.1358 46.2987 78.1358 48.4296 71.7272C49.7793 67.6681 54.4137 65.7486 58.2382 67.6644C64.2765 70.6892 70.6859 64.2786 67.6615 58.2402C65.7458 54.4155 67.6653 49.7808 71.7243 48.431C78.133 46.2997 78.133 37.2345 71.7243 35.1032C67.6653 33.7533 65.7458 29.1186 67.6615 25.294C70.6859 19.2555 64.2764 12.845 58.2382 15.8698C54.4137 17.7856 49.7793 15.866 48.4296 11.807ZM42.4991 53.0002C48.297 53.0002 52.9979 48.2996 52.9979 42.5002C52.9979 36.7009 48.297 32.0002 42.4991 32.0002C36.7011 32.0002 32.0003 36.7009 32.0003 42.5002C32.0003 48.2996 36.7011 53.0002 42.4991 53.0002ZM42.4991 58.0002C51.0588 58.0002 57.9979 51.0606 57.9979 42.5002C57.9979 33.9398 51.0588 27.0002 42.4991 27.0002C33.9393 27.0002 27.0003 33.9398 27.0003 42.5002C27.0003 51.0606 33.9393 58.0002 42.4991 58.0002Z"
                                        fill="#797B7C" />
                                </svg>
                                <span> Config </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="config">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a class="_nav-item-text" href="{{ route('report-config') }}">
                                            <i class="uil-500px"></i>
                                            <span>&nbsp; Report Config</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="_nav-item-text" href="{{ route('config') }}">
                                            <i class="uil-500px"></i>
                                            <span>&nbsp; Application Config</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'contractor')
                        <li class="side-nav-item">
                            <a href="/dashboard/contract" class="side-nav-link _nav-item-text">
                                <i class="uil-clipboard-alt"></i>
                                <span> Contracts </span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'hea/ber-assessor')
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
                <div class="navbar-custom _shadow-1 ">
                    <div>
                        @php
                            $remindersCount = 0;
                            $result = getMessagesAll();
                            $result2 = getRemindersAll();
                            $sumIsRead = 0; // Initialize the variable to hold the sum
                            foreach ($result2 as $reminder) {
                                $sumIsRead += $reminder['is_read'];
                            }
                        @endphp
                    </div>
                    <ul class="list-unstyled topbar-menu float-end mt-1 mb-0 d-flex align-items-center mynew1">
                        <div class="col-2 my-0 mb-1 reminderlistMain dropdown">
                            <span class="reminderNoti @if ($sumIsRead <= 0) d-none @endif"
                                style="top: -6px;right: -3px;">{{ $sumIsRead }}</span>
                            <button class="dropdown-btns dropdownMenuButton11" data-id=""
                                style="padding: unset;margin:unset;" type="button" id="dropdownMenuButton1"
                                aria-expanded="false">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 20.8C16.8601 20.8 20.8 16.8601 20.8 12C20.8 7.13989 16.8601 3.2 12 3.2C7.13989 3.2 3.2 7.13989 3.2 12C3.2 16.8601 7.13989 20.8 12 20.8ZM12 22.5C17.799 22.5 22.5 17.799 22.5 12C22.5 6.20101 17.799 1.5 12 1.5C6.20101 1.5 1.5 6.20101 1.5 12C1.5 17.799 6.20101 22.5 12 22.5Z"
                                        fill="#1C274C" />
                                    <path
                                        d="M12.8127 9.36198C12.8127 10.0728 12.8158 10.7836 12.8101 11.4944C12.8063 11.5476 12.817 11.6009 12.8409 11.6485C12.8649 11.6962 12.9013 11.7364 12.9463 11.7651C13.862 12.4461 14.7753 13.1309 15.6862 13.8195C16.0258 14.0763 16.1394 14.4178 16.0155 14.7717C15.9769 14.8852 15.9134 14.9886 15.8297 15.0744C15.746 15.1602 15.6442 15.2263 15.5317 15.2678C15.4192 15.3093 15.2989 15.3253 15.1795 15.3144C15.06 15.3036 14.9446 15.2663 14.8414 15.2052C14.7373 15.1398 14.6369 15.0687 14.5408 14.992C13.5563 14.2545 12.5743 13.5134 11.5867 12.7805C11.4567 12.6914 11.3511 12.5712 11.2798 12.4307C11.2084 12.2903 11.1734 12.1342 11.1782 11.9767C11.1782 10.4046 11.1782 8.83297 11.1782 7.26085C11.1782 6.62399 11.7218 6.21979 12.2804 6.42831C12.6103 6.55157 12.8081 6.85151 12.8096 7.25007C12.8163 7.95421 12.8127 8.65835 12.8127 9.36198Z"
                                        fill="#1C274C" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu appnedLi appnedLiX" aria-labelledby="dropdownMenuButton1">
                                <li class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="pl-3 mr-1 me-2 text-blue"><b>Show</b></span>
                                    {{-- <select name="when_timeM" id="when_timeM" style="border: unset;padding: 0 20px;">
                                        <option value="">Filter</option>
                                        <option value="atoe">At event</option>
                                        <option value="5mb">5 minutes</option>
                                        <option value="10mb">10 minutes</option>
                                        <option value="15mb">15 minutes</option>
                                        <option value="1hb">1 hour</option>
                                        <option value="2hb">2 hours</option>
                                        <option value="1db">1 day</option>
                                        <option value="2db">2 days</option>
                                        <option value="1wb">1 week</option>
                                        <option value="2wb">2 week</option>
                                        <option value="1m">1 month</option>
                                        <option value="all">All Reminders</option>
                                    </select> --}}
                                    <div id="reportrange"
                                        style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;border-radius:8px;">
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                </li>
                                <div class="appnedLis mt-3">
                                    @if (sizeOf($result2))
                                        @foreach ($result2 as $rkey => $reminder)
                                            <li class="myremListD checkHide "
                                                data-when="{{ $reminder->when_time }}"
                                                @if ($reminder->is_read == 0) style="background:#F2F4F7;" @endif>
                                                <div class="dropdown-item myremList myremListM @if($reminder->is_read != 0) dReadRem @endif"
                                                    data-id="{{ $reminder->id }}"
                                                    style="color:@if ($reminder->is_read == 0) #313131 @else #1A47A3 @endif;">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class=" mb-0"
                                                            style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;max-width: 50%;">
                                                            <b>{{ $reminder['title'] }}</b>
                                                        </h5>
                                                        <div class="d-flex align-items-center">
                                                            <a aria-hidden="true" class="readrbtn me-1" data-id="{{ $reminder->id }}">
                                                                <svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M8.00033 6C7.46989 6 6.96118 6.21071 6.58611 6.58579C6.21104 6.96086 6.00033 7.46957 6.00033 8C6.00033 8.53043 6.21104 9.03914 6.58611 9.41421C6.96118 9.78929 7.46989 10 8.00033 10C8.53076 10 9.03947 9.78929 9.41454 9.41421C9.78961 9.03914 10.0003 8.53043 10.0003 8C10.0003 7.46957 9.78961 6.96086 9.41454 6.58579C9.03947 6.21071 8.53076 6 8.00033 6ZM8.00033 11.3333C7.11627 11.3333 6.26842 10.9821 5.6433 10.357C5.01818 9.7319 4.66699 8.88406 4.66699 8C4.66699 7.11595 5.01818 6.2681 5.6433 5.64298C6.26842 5.01786 7.11627 4.66667 8.00033 4.66667C8.88438 4.66667 9.73223 5.01786 10.3573 5.64298C10.9825 6.2681 11.3337 7.11595 11.3337 8C11.3337 8.88406 10.9825 9.7319 10.3573 10.357C9.73223 10.9821 8.88438 11.3333 8.00033 11.3333ZM8.00033 3C4.66699 3 1.82033 5.07333 0.666992 8C1.82033 10.9267 4.66699 13 8.00033 13C11.3337 13 14.1803 10.9267 15.3337 8C14.1803 5.07333 11.3337 3 8.00033 3Z" fill="#1A47A3"/>
                                                                </svg>
                                                            </a>
                                                            <a aria-hidden="true" class="text-bluess rdbtn" data-id="{{ $reminder->id }}" style="font-size: 14px;bottom:4px;color:#D33737;"
                                                                data-href="{{ route('property.deleteReminder', $reminder['id']) }}">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="parent"
                                                        style="text-overflow: ellipsis;overflow: hidden;">
                                                        <p class="mb-0"
                                                            style="text-overflow: ellipsis;overflow: hidden;">
                                                            {{ $reminder['notes'] ? $reminder['notes'] : 'N/A' }}</p>
                                                        <b class="">Property: </b>
                                                        <span>{{ $reminder['address'] }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <div class=""><b class="">Due:
                                                            </b>{{ date('d/m/Y', strtotime($reminder['due_date'])) . ' ' . date('h:i A', strtotime($reminder['due_time'])) }}
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
                                    @endif
                                </div>
                                @if (sizeOf($result2))
                                    <h4 href="#allrf" style="margin: 11px auto 0 auto !important;font-size: 15px;font-weight: 600;color: #1A47A3;width: -webkit-fill-available;text-align: center;text-decoration: underline;float: unset !important;height:23px !important;"
                                        class="seeAll showallm mb-2 nravail">View All Reminders</h4>
                                @else
                                    <h4 class="nravail"
                                        style="margin: 11px auto 0 auto !important;font-size: 15px;font-weight: 600;color: #808080;min-width: 180px; overflow-y: hidden;padding:0px 10px;width: -webkit-fill-available;text-align: center;">
                                        Reminders Not Available</h4>
                                @endif
                            </ul>
                            <span
                                class="notiDot @if ($remindersCount == 0) d-none @endif">{{ $remindersCount }}</span>
                        </div>
                        <li class="dropdown notification-list mylist">
                            {{-- @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\MessageNotification')->count() > 0)
                                <span
                                    class="msg-counter">{{ auth()->user()->unreadNotifications->where('type', 'App\Notifications\MessageNotification')->count() }}</span>
                            @endif --}}
                            <a class="nav-link dropdown-toggle arrow-none" style="top: 10px;position: relative;"
                                data-bs-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="false"
                                aria-expanded="false">

                                <svg class="" width="24" height="25" viewBox="0 0 24 25"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.0001 3.58905H17.9221C19.1328 3.56312 20.3125 3.97293 21.2464 4.74382C22.1803 5.51471 22.8062 6.5954 23.0101 7.78905C23.0661 8.07963 23.0922 8.37516 23.0881 8.67105C23.0881 11.207 23.0881 13.743 23.0881 16.279C23.1001 17.4715 22.6898 18.6298 21.93 19.5489C21.1701 20.468 20.1096 21.0887 18.9361 21.301C18.5734 21.362 18.2059 21.3901 17.8381 21.385C13.9381 21.385 10.0381 21.385 6.13811 21.385C5.4678 21.4058 4.80002 21.2934 4.17347 21.0543C3.54691 20.8152 2.97401 20.4541 2.48795 19.9921C2.0019 19.53 1.61234 18.9761 1.34184 18.3624C1.07134 17.7488 0.92528 17.0876 0.912109 16.4171C0.912109 13.781 0.912109 11.1451 0.912109 8.50905C0.949595 7.22072 1.47692 5.99516 2.38661 5.08212C3.29631 4.16908 4.51993 3.63726 5.80811 3.59505H12.0001V3.58905ZM21.1501 6.78105C21.0661 6.88305 21.0241 6.96105 20.9641 7.02105C19.0961 8.88905 17.2281 10.757 15.3601 12.625C14.9229 13.0745 14.4 13.4317 13.8224 13.6756C13.2448 13.9195 12.6241 14.0452 11.9971 14.0452C11.3701 14.0452 10.7495 13.9195 10.1718 13.6756C9.59421 13.4317 9.07134 13.0745 8.63411 12.625C6.76611 10.745 4.88811 8.87105 3.00011 7.00305C2.94611 6.94305 2.88611 6.88905 2.81411 6.82305C2.49187 7.34461 2.31765 7.94402 2.31011 8.55705C2.31011 11.1851 2.31011 13.813 2.31011 16.435C2.32429 17.3804 2.70983 18.2823 3.38343 18.9458C4.05703 19.6093 4.96461 19.9812 5.91011 19.9811C9.97411 19.9811 14.0361 19.9811 18.0961 19.9811C19.0393 19.9735 19.9425 19.5992 20.6144 18.9373C21.2864 18.2754 21.6743 17.378 21.6961 16.435C21.6961 13.813 21.6961 11.1851 21.6961 8.55705C21.6827 7.92669 21.4958 7.31221 21.1561 6.78105H21.1501ZM3.75011 5.78505C3.87011 5.87505 3.96611 5.93505 4.04411 6.00705C5.91611 7.87105 7.78411 9.73905 9.64811 11.6111C9.9532 11.9341 10.321 12.1914 10.7291 12.3673C11.1371 12.5432 11.5768 12.6339 12.0211 12.6339C12.4654 12.6339 12.9051 12.5432 13.3131 12.3673C13.7212 12.1914 14.089 11.9341 14.3941 11.6111C16.2901 9.72305 18.1801 7.83105 20.0641 5.93505L20.2501 5.73705C20.1594 5.66833 20.0653 5.60425 19.9681 5.54505C19.3555 5.1678 18.6475 4.97415 17.9281 4.98705H10.0681C8.65211 4.98705 7.24211 4.98705 5.83211 4.98705C5.06187 5.01626 4.3223 5.2965 3.72611 5.78505H3.75011Z"
                                        fill="#1C274C" />
                                </svg>


                            </a>
                            @php
                                $sum = 0;
                                foreach ($result as $nkey => $noti) {
                                    $sum += intval($noti['is_read']);
                                }
                            @endphp
                            <span id="totalIsRead"
                                class="totalIsRead @if ($sum == 0) d-none @endif">{{ $sum }}</span>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" style="border-radius:15px;">
                                {{-- CREATE A NEW MESSAGE --}}
                                {{-- <a class="dropdown-item mark-read" href="javascript:;" id="create-new-message"><i
                                        class="fa fa-comments"> Create a new message</i></a> --}}

                                <div class="myNewMenu" id="myMenuAppend">
                                    @foreach ($result as $nkey => $noti)
                                        @php
                                            $initials = '';
                                            if (isset($noti['firstname'])) {
                                                $ab = substr($noti['firstname'], 0, 1);
                                                $initials .= $ab;
                                            }
                                            if (isset($noti['lastname'])) {
                                                $cd = substr($noti['lastname'], 0, 1);
                                                $initials .= $cd;
                                            }
                                            $initials = strtoupper($initials);
                                        @endphp
                                        <a class="mynewDropDown dropdown-item @if ($noti['is_read'] == 1) newMessageC @endif"
                                            href="{{ route('chat.open', ['id' => $noti['id'], 'cid' => $noti['property_id']]) }}">
                                            <div class="mr-1"
                                                style="border:1px solid #1A47A3;font-weight: 600;min-width: 48px;font-family: Arial, sans-serif; font-size: 20px; color: #1A47A3; background-color: #e8ecf6; border-radius: 5px; display: inline-block; margin: 3px;border-radius: 36px; display: flex; align-items: center; justify-content: center;width:48px;height:48px;padding-left:10px;padding-right:10px;">
                                                {{ $initials }}</div>
                                            <div class="d-flex flex-column overflowClass ms-1">
                                                <b style="text-overflow: ellipsis;overflow: hidden;width: 243px;white-space: nowrap;">{{ $noti['name'] }} - ({{ $noti['appname'] }}) - {{ $noti['address'] }}</b>
                                                @if ($noti['last_msg'] != '' || $noti['last_msg'] != null)
                                                    <span
                                                        style="text-overflow: ellipsis;overflow: hidden;width: 241px;white-space: nowrap;">{{ $noti['last_msg'] }}</span>
                                                @else
                                                <div class="d-flex mt-1">
                                                    <img src="{{ getLogoUrl($noti['last_img']) }}"
                                                    alt="" style="width:30px;height:30px;">
                                                    <span style="text-overflow: ellipsis;overflow: hidden;width: 205px;white-space: nowrap;margin-left:10px;">{{ $noti['last_img'] }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="mr-1 d-flex flex-column text-end">
                                                <span>{{ date('d-m-Y', strtotime($noti['msg_date'])) }}</span>
                                                <span><small>{{ date('h:i A', strtotime($noti['msg_date'])) }}</small></span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <a class="dropdown-item mark-read see-all-message d-flex align-items-center"
                                    href="{{ route('chat.open') }}">
                                    <svg class="" width="24" height="25" viewBox="0 0 24 25"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.0001 3.58905H17.9221C19.1328 3.56312 20.3125 3.97293 21.2464 4.74382C22.1803 5.51471 22.8062 6.5954 23.0101 7.78905C23.0661 8.07963 23.0922 8.37516 23.0881 8.67105C23.0881 11.207 23.0881 13.743 23.0881 16.279C23.1001 17.4715 22.6898 18.6298 21.93 19.5489C21.1701 20.468 20.1096 21.0887 18.9361 21.301C18.5734 21.362 18.2059 21.3901 17.8381 21.385C13.9381 21.385 10.0381 21.385 6.13811 21.385C5.4678 21.4058 4.80002 21.2934 4.17347 21.0543C3.54691 20.8152 2.97401 20.4541 2.48795 19.9921C2.0019 19.53 1.61234 18.9761 1.34184 18.3624C1.07134 17.7488 0.92528 17.0876 0.912109 16.4171C0.912109 13.781 0.912109 11.1451 0.912109 8.50905C0.949595 7.22072 1.47692 5.99516 2.38661 5.08212C3.29631 4.16908 4.51993 3.63726 5.80811 3.59505H12.0001V3.58905ZM21.1501 6.78105C21.0661 6.88305 21.0241 6.96105 20.9641 7.02105C19.0961 8.88905 17.2281 10.757 15.3601 12.625C14.9229 13.0745 14.4 13.4317 13.8224 13.6756C13.2448 13.9195 12.6241 14.0452 11.9971 14.0452C11.3701 14.0452 10.7495 13.9195 10.1718 13.6756C9.59421 13.4317 9.07134 13.0745 8.63411 12.625C6.76611 10.745 4.88811 8.87105 3.00011 7.00305C2.94611 6.94305 2.88611 6.88905 2.81411 6.82305C2.49187 7.34461 2.31765 7.94402 2.31011 8.55705C2.31011 11.1851 2.31011 13.813 2.31011 16.435C2.32429 17.3804 2.70983 18.2823 3.38343 18.9458C4.05703 19.6093 4.96461 19.9812 5.91011 19.9811C9.97411 19.9811 14.0361 19.9811 18.0961 19.9811C19.0393 19.9735 19.9425 19.5992 20.6144 18.9373C21.2864 18.2754 21.6743 17.378 21.6961 16.435C21.6961 13.813 21.6961 11.1851 21.6961 8.55705C21.6827 7.92669 21.4958 7.31221 21.1561 6.78105H21.1501ZM3.75011 5.78505C3.87011 5.87505 3.96611 5.93505 4.04411 6.00705C5.91611 7.87105 7.78411 9.73905 9.64811 11.6111C9.9532 11.9341 10.321 12.1914 10.7291 12.3673C11.1371 12.5432 11.5768 12.6339 12.0211 12.6339C12.4654 12.6339 12.9051 12.5432 13.3131 12.3673C13.7212 12.1914 14.089 11.9341 14.3941 11.6111C16.2901 9.72305 18.1801 7.83105 20.0641 5.93505L20.2501 5.73705C20.1594 5.66833 20.0653 5.60425 19.9681 5.54505C19.3555 5.1678 18.6475 4.97415 17.9281 4.98705H10.0681C8.65211 4.98705 7.24211 4.98705 5.83211 4.98705C5.06187 5.01626 4.3223 5.2965 3.72611 5.78505H3.75011Z"
                                            fill="#1A47A3" />
                                    </svg>
                                    Show all messages
                                </a>

                                {{-- @endif --}}
                            </div>

                        </li>

                        @if (Auth::user()->role == 'contractor')
                            <li class="dropdown notification-list mynew2">
                                @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJob')->count() > 0)
                                    <span
                                        class="notification-counter">{{ auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJob')->count() }}</span>
                                @endif
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown"
                                    href="javascript:;" role="button" aria-haspopup="false" aria-expanded="false">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11 0.25C6.71983 0.25 3.25004 3.71979 3.25004 8V8.7041C3.25004 9.40102 3.04375 10.0824 2.65717 10.6622L1.50856 12.3851C0.175468 14.3848 1.19318 17.1028 3.51177 17.7351C4.26738 17.9412 5.02937 18.1155 5.79578 18.2581L5.79768 18.2632C6.56667 20.3151 8.62198 21.75 11 21.75C13.378 21.75 15.4333 20.3151 16.2023 18.2632L16.2042 18.2581C16.9706 18.1155 17.7327 17.9412 18.4883 17.7351C20.8069 17.1028 21.8246 14.3848 20.4915 12.3851L19.3429 10.6622C18.9563 10.0824 18.75 9.40102 18.75 8.7041V8C18.75 3.71979 15.2802 0.25 11 0.25ZM14.3764 18.537C12.1335 18.805 9.86644 18.8049 7.62349 18.5369C8.33444 19.5585 9.57101 20.25 11 20.25C12.4289 20.25 13.6655 19.5585 14.3764 18.537ZM4.75004 8C4.75004 4.54822 7.54826 1.75 11 1.75C14.4518 1.75 17.25 4.54822 17.25 8V8.7041C17.25 9.69716 17.544 10.668 18.0948 11.4943L19.2434 13.2172C20.0086 14.3649 19.4245 15.925 18.0936 16.288C13.4494 17.5546 8.5507 17.5546 3.90644 16.288C2.57561 15.925 1.99147 14.3649 2.75664 13.2172L3.90524 11.4943C4.45609 10.668 4.75004 9.69716 4.75004 8.7041V8Z"
                                            fill="#1C274C" />
                                    </svg>
                                </a>
                                @if (auth()->user()->notifications->where('type', 'App\Notifications\ContractorJob')->count() > 0)
                                    <div class="dropdown-menu myNewMenu" aria-labelledby="dropdownMenuButton">

                                        @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJob')->count() > 0)
                                            <a class="dropdown-item mark-read"
                                                href="{{ route('notification.markAsRead') }}"><i class="fa fa-check"
                                                    aria-hidden="true"></i>Mark all as read</a>
                                        @endif

                                        @foreach (auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJob')->all() as $notification)
                                            <div class="mb-1 mt-1 mynewNoti row">
                                                <div class="col-12 px-0">
                                                    <a class="dropdown-item" style="color:#313131;padding:0.5rem 0.5rem 0rem 0.5rem !important;white-space:unset;"
                                                        href="/dashboard/contract/show-contract/{{ Crypt::encrypt($notification->data['property_id']) }}?notify=true">{{ $notification->data['notify'] }}</a>
                                                </div>
                                                <div class="col-12 ps-0 pe-2 text-end pb-1">

                                                    <span><small
                                                            style="color: #1A47A3;">{{ date('d/m/Y', strtotime($notification->created_at)) }}</small></span>
                                                </div>
                                            </div>
                                        @endforeach

                                        @foreach (auth()->user()->readNotifications->where('type', 'App\Notifications\ContractorJob')->all() as $notification)
                                            <div class="mb-1 mt-1 mynewNoti row">
                                                <div class="col-12 px-0">
                                                    <a class="dropdown-item" style="color:#313131;padding:0.5rem 0.5rem 0rem 0.5rem !important;white-space:unset;"
                                                        href="/dashboard/contract/show-contract/{{ Crypt::encrypt($notification->data['property_id']) }}">{{ $notification->data['notify'] }}</a>
                                                </div>
                                                <div class="col-12 ps-0 pe-2 text-end pb-1">

                                                    <span><small
                                                            style="color: #1A47A3;">{{ date('d/m/Y', strtotime($notification->created_at)) }}</small></span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @elseif(Auth::user()->role == 'admin')
                        @php
                            $snagMsgs = [];
                            $snagMsgs = notificationMobile();
                            // dd($snagMsgs);
                        @endphp
                            <li class="dropdown notification-list mynew2">
                                @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJobAcceptReject')->count() > 0)
                                    <span
                                        class="notification-counter">{{ auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJobAcceptReject')->count() }}</span>
                                @endif
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown"
                                    href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11 0.25C6.71983 0.25 3.25004 3.71979 3.25004 8V8.7041C3.25004 9.40102 3.04375 10.0824 2.65717 10.6622L1.50856 12.3851C0.175468 14.3848 1.19318 17.1028 3.51177 17.7351C4.26738 17.9412 5.02937 18.1155 5.79578 18.2581L5.79768 18.2632C6.56667 20.3151 8.62198 21.75 11 21.75C13.378 21.75 15.4333 20.3151 16.2023 18.2632L16.2042 18.2581C16.9706 18.1155 17.7327 17.9412 18.4883 17.7351C20.8069 17.1028 21.8246 14.3848 20.4915 12.3851L19.3429 10.6622C18.9563 10.0824 18.75 9.40102 18.75 8.7041V8C18.75 3.71979 15.2802 0.25 11 0.25ZM14.3764 18.537C12.1335 18.805 9.86644 18.8049 7.62349 18.5369C8.33444 19.5585 9.57101 20.25 11 20.25C12.4289 20.25 13.6655 19.5585 14.3764 18.537ZM4.75004 8C4.75004 4.54822 7.54826 1.75 11 1.75C14.4518 1.75 17.25 4.54822 17.25 8V8.7041C17.25 9.69716 17.544 10.668 18.0948 11.4943L19.2434 13.2172C20.0086 14.3649 19.4245 15.925 18.0936 16.288C13.4494 17.5546 8.5507 17.5546 3.90644 16.288C2.57561 15.925 1.99147 14.3649 2.75664 13.2172L3.90524 11.4943C4.45609 10.668 4.75004 9.69716 4.75004 8.7041V8Z"
                                            fill="#1C274C" />
                                    </svg>
                                </a>
                                @if (auth()->user()->notifications->where('type', 'App\Notifications\ContractorJobAcceptReject')->count() > 0 || sizeOf($snagMsgs) > 0)
                                    <div class="dropdown-menu myNewMenu " style="padding: 0.4rem 0.4rem !important;border-radius: 9px !important;"
                                     aria-labelledby="dropdownMenuButton">

                                        @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJobAcceptReject')->count() > 0)
                                            <a class="dropdown-item mark-read"
                                                href="{{ route('notification.markAsRead') }}"><i class="fa fa-check"
                                                    aria-hidden="true"></i>Mark all as read</a>
                                        @endif

                                        {{-- @foreach (auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJobAcceptReject')->all() as $notification)
                                            <div class="mb-1 mt-1 mynewNoti row">
                                                <div class="col-12 px-0">
                                                    <a class="dropdown-item" style="color:#313131;padding:0.5rem 0.5rem 0rem 0.5rem !important;white-space:unset;"
                                                        href="javascript:;">{{ $notification->data['notify'] }}</a>
                                                </div>
                                                <div class="col-12 ps-0 pe-2 text-end pb-1">

                                                    <span><small
                                                            style="color: #1A47A3;">{{ date('d/m/Y', strtotime($notification->created_at)) }}</small></span>
                                                </div>
                                            </div>
                                        @endforeach --}}
                                        {{-- @foreach ($snagMsgs as $notification)
                                        <div class="mb-1 mt-1 mynewNoti row">
                                            <div class="col-12 px-0">
                                                <a class="dropdown-item" style="color:#313131;padding:0.5rem 0.5rem 0rem 0.5rem !important;white-space:unset;"
                                                    href="javascript:;">{{ $notification->note }}</a>
                                            </div>
                                            <div class="col-12 ps-0 pe-2 text-end pb-1">

                                                <span><small
                                                        style="color: #1A47A3;">{{ date('d/m/Y', strtotime($notification->date)) }}</small></span>
                                            </div>
                                        </div>
                                        @endforeach --}}
                                        {{-- @foreach (auth()->user()->readNotifications->where('type', 'App\Notifications\ContractorJobAcceptReject')->all() as $notification)
                                            <div class="mb-1 mt-1 mynewNoti row">
                                                <div class="col-12 px-0">
                                                    <a class="dropdown-item" style="color:#313131;padding:0.5rem 0.5rem 0rem 0.5rem !important;white-space:unset;"
                                                        href="javascript:;">{{ $notification->data['notify'] }}</a>

                                                </div>
                                                <div class="col-12 ps-0 pe-2 text-end pb-1">

                                                    <span><small
                                                            style="color: #1A47A3;">{{ date('d/m/Y', strtotime($notification->created_at)) }}</small></span>
                                                </div>
                                            </div>
                                        @endforeach --}}

                                        @foreach ($snagMsgs as $snagMsg)
                                            @php
                                                    $route = "javascript:void(0)";
                                                    if($snagMsg['route'] && $snagMsg['property_id']){
                                                        $property_id = Crypt::encrypt($snagMsg["property_id"]);
                                                        $route = route($snagMsg['route'],$property_id);
                                                        $section = $snagMsg["sub_section"];
                                                    } elseif ($snagMsg['route'] == "lead" && isset($lead_scheme->id)) {
                                                        $route = route($snagMsg['route'],$lead_scheme->id);
                                                    }elseif ($snagMsg['route'] == "property") {
                                                        $route = route($snagMsg['route'],0);
                                                    } else {
                                                        if($snagMsg['route']){
                                                            $route = route($snagMsg['route']);
                                                        }
                                                    }
                                                @endphp
                                                <div class="d-flex mb-1 mt-1 mynewNoti row">
                                                    <div class="col-12 px-0">
                                                        <a class="dropdown-item" style="color:#313131;padding:0.5rem 0.5rem 0rem 0.5rem !important;white-space:unset;"
                                                            href="{{ $route }}" @if($snagMsg['property_id']) onclick="localStorage.setItem('selectedFilter', '{{ $section }}' );"
                                                            onauxclick="localStorage.setItem('selectedFilter', '{{ $section }}' );" @endif>{{ $snagMsg['note'] }}</a>
                                                    </div>
                                                    <div class="col-12 ps-0 pe-2 text-end pb-1">

                                                        <span><small
                                                                style="color: #1A47A3;">{{ date('d/m/Y', strtotime($snagMsg['date'])) }}</small></span>
                                                    </div>
                                                </div>
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @endif
                        <li class="dropdown notification-list">
                            <span class="account-user-avatar" style="top: 10px;position: relative;">
                                @if (Auth::user())
                                    @php
                                        $user = \App\Models\User::find(Auth::user()->id);
                                    @endphp
                                    @if ($user->profile_img == null)
                                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image"
                                            class="rounded-circle" style="height: 36px;width: 36px;">
                                    @else
                                        <img src="{{ asset('assets/images/admin/' . $user->profile_img) }}"
                                            alt="user-image" class="rounded-circle"
                                            style="height: 36px;width: 36px;">
                                    @endif
                                @else
                                @endif
                            </span>
                            {{-- <a class="nav-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                                href="#" role="button" aria-haspopup="false" aria-expanded="false"> --}}
                            <svg data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false" style="position: relative; top: 10px; left: 5px;"
                                class="propcsv2" width="15" height="9" viewBox="0 0 15 9" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.293016 2.20711L6.65698 8.57107C7.0475 8.96159 7.68067 8.96159 8.07119 8.57107L14.4352 2.2071C14.8257 1.81658 14.8257 1.18342 14.4352 0.792892C14.0446 0.402368 13.4115 0.402368 13.0209 0.792892L8.36408 5.44975L7.36414 6.36426L6.36408 5.44975L1.70723 0.792893C1.3167 0.402369 0.68354 0.402369 0.293015 0.792893C-0.097509 1.18342 -0.0975089 1.81658 0.293016 2.20711Z"
                                    fill="black" />
                            </svg>
                            {{-- </a> --}}
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown dgrid"
                                style="color:#1A47A3 !important;">
                                <span style="text-align: center; background: #e7e7e7; padding: 15px;">
                                    <span
                                        class="account-position text-uppercase"><b>{{ Auth::user()->role }}</b></span>
                                    <span class="account-user-name">{{ Auth::user()->email }}</span>

                                </span>
                                <a class="text-secondary" href="{{ route('admin-profile') }}"
                                    style="padding: 10px 0px 0px 0px;color:#1A47A3 !important;"
                                    class="dropdown-item notify-item">
                                    <span class="mdi mdi-account-circle"></span>
                                    <span>My Profile</span>
                                </a>
                                <a class="text-secondary" href="{{ route('logout') }}"
                                    style="padding: 10px 0px 0px 0px;color:#1A47A3 !important;"
                                    class="dropdown-item notify-item"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout me-1" style="color: red;"></i>
                                    <span>Logout</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                        {{-- <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown"
                                href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image"
                                        class="rounded-circle">
                                </span>
                                <span>
                                    <span class="account-user-name">{{ Auth::user()->email }}</span>
                                    <span class="account-position text-uppercase">{{ Auth::user()->role }}</span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                <a class="text-secondary" href="{{ route('logout') }}"
                                    class="dropdown-item notify-item"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout me-1"></i>
                                    <span>Logout</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li> --}}

                    </ul>
                    <button class="button-menu-mobile open-left">
                        <i class="mdi mdi-menu menClr"></i>
                        {{-- <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="mdi mdi-menu cliclef">
                            <rect width="32" height="32" rx="16" fill="#E2E8ED" />
                            <path
                                d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
                                fill="black" />
                        </svg> --}}
                        {{-- <i ></i> --}}
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
                                    @if (\Session::has('success'))
                                        <div class="alert alert-success">
                                            <ul>
                                                <span>{!! \Session::get('success') !!}</span>
                                            </ul>
                                        </div>
                                    @endif
                                    @if (\Session::has('error'))
                                        <div class="alert alert-danger">
                                            <ul>
                                                <span>{!! \Session::get('error') !!}</span>
                                            </ul>
                                        </div>
                                    @endif
                                    @yield('content')

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                </div> <!-- container -->
                <!-- Modal -->
                <div class="modal fade" id="changeRemModal" tabindex="-1" role="dialog"
                    aria-labelledby="changeRemModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <button type="button" class="close mod-cls-btn rdbtn" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-header d-flex justify-content-center pt-4 pb-0"
                                style="border-bottom:none !important;">
                                <h4 class="modal-title text-blue">Are you sure you want to change
                                    the status of Reminder?</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="reminderid">
                                <div class="form-group">
                                    <label class="mb-1 file-txt">Status</label>
                                    <select class="form-control chngSts">
                                        <option value="Complete">Complete</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer" style="border-top:none !important;">
                                <button type="button" class="btn _btn-primary my-0 saveremstatus w-100">Change
                                    Status</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="changeAppModal" tabindex="-1" role="dialog"
                    aria-labelledby="changeAppModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <button type="button" class="close mod-cls-btn rdbtn" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-header d-flex justify-content-center pt-4 pb-0"
                                style="border-bottom:none !important;">
                                <h4 class="modal-title text-blue">Are you sure you want to change
                                    the status of Appointment?</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="appointmentid">
                                <div class="form-group">
                                    <label class="mb-1 file-txt">Status</label>
                                    <select class="form-control chngSts2">
                                        <option value="call">Call</option>
                                        <option value="survey">Survey</option>
                                        <option value="visit">Visit</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group appointment_other2 d-none">
                                    <input type="text" class="my-1 form-control appointment_others" name="appointment_other"
                                    id="appointment_other" placeholder="Other Details"></div>
                            </div>
                            <div class="modal-footer" style="border-top:none !important;">
                                <button type="button" class="btn _btn-primary my-0 saveremstatus2 w-100">Change
                                    Status</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="changeAppModal2" tabindex="-1" role="dialog"
                    aria-labelledby="changeAppModal2Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header d-flex justify-content-center pt-4 pb-0"
                                style="border-bottom:none !important;">
                                <h4 class="modal-title text-blue">Are you sure you want to change
                                    the status of Appointment?</h4>
                                    <button style="position: absolute;top: -15px;" type="button" class="close mod-cls-btn rdbtn" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="appointmentid2">
                                <div class="form-group">
                                    <label class="mb-1 file-txt">Status</label>
                                    <select class="form-control chngSts3">
                                        <option value="Accepted">Accepted</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>
                                <div class="form-group app_reason d-none">
                                    <label for="app_reason" class="mb-1 file-txt">Reason</label>
                                    <input type="text" class="my-1 form-control" name="app_reason"
                                    id="app_reason" placeholder="Reason">
                                </div>
                            </div>
                            <div class="modal-footer" style="border-top:none !important;">
                                <button type="button" class="btn _btn-primary my-0 saveremstatus3 w-100">Change
                                    Status</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            © {{ config('app.name', 'Laravel') }}
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

    <!-- bundle -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <!-- third party js -->
    <script src="{{ asset('assets/js/_vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/_vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/_vendor/dataTables.responsive.min.js') }}"></script>


    <script src="{{ asset('assets/js/_vendor/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/_vendor/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/_vendor/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/_vendor/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/_vendor/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/_vendor/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/_vendor/dataTables.fixedColumns.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jqueryui/jquery-ui.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"
        integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/sorting/datetime-moment.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    @stack('scripts')

    <!-- third party js ends -->
    <script>
        $(function() {
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end, label) {
                var rangeText = 'Select Filter';
                if (label != null && end != null && start.isValid() && end.isValid()) {
                    rangeText = start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY');
                }
                $('#reportrange span').html(rangeText);
                var sdate = start.format('YYYY-MM-DD');
                var edate = end.format('YYYY-MM-DD');
                var range = label;
                var from = 'drop';
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
                                $('.appnedLis').empty();
                                $('.reminderNoti').text('');
                                var html2 = '';
                                var sumIsRead = 0;
                                var rlist = $.each(data, function(i, v) {
                                    if (v.is_read == 1) {
                                        sumIsRead++;
                                        // if (i > 3) {
                                        //     html2 +=
                                        //         '<li class="myremListD checkHide d-none" data-when="' +
                                        //         v.when_time + '">';
                                        // } else {
                                            html2 +=
                                                '<li class="myremListD checkHide" data-when="' +
                                                v.when_time + '">';
                                        // }
                                        html2 +=
                                            '<div class="dropdown-item myremListM myremList dReadRem" data-id="' +
                                            v.id + '" style="color:#1A47A3;">';
                                    } else {
                                        // if (i > 3) {
                                        //     html2 +=
                                        //         '<li class="myremListD checkHide d-none" data-when="' +
                                        //         v.when_time + '" style="background:#F2F4F7;">';
                                        // } else {
                                            html2 +=
                                                '<li class="myremListD checkHide" data-when="' +
                                                v.when_time + '" style="background:#F2F4F7;">';
                                        // }
                                        html2 +=
                                            '<div class="dropdown-item myremListM myremList" data-id="' +
                                            v.id + '" style="color:#313131;">';
                                    }
                                    html2 += '<div class="d-flex justify-content-between">';
                                    html2 +=
                                        '<h5 class=" mb-0" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;max-width: 50%;"><b>' +
                                        v.title + '</b></h5>';
                                    html2 +=
                                        '<div class="d-flex align-items-center">';
                                    html2 +=
                                        `<a aria-hidden="true" class="readrbtn me-1" data-id="${v.id}">
                                            <svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.00033 6C7.46989 6 6.96118 6.21071 6.58611 6.58579C6.21104 6.96086 6.00033 7.46957 6.00033 8C6.00033 8.53043 6.21104 9.03914 6.58611 9.41421C6.96118 9.78929 7.46989 10 8.00033 10C8.53076 10 9.03947 9.78929 9.41454 9.41421C9.78961 9.03914 10.0003 8.53043 10.0003 8C10.0003 7.46957 9.78961 6.96086 9.41454 6.58579C9.03947 6.21071 8.53076 6 8.00033 6ZM8.00033 11.3333C7.11627 11.3333 6.26842 10.9821 5.6433 10.357C5.01818 9.7319 4.66699 8.88406 4.66699 8C4.66699 7.11595 5.01818 6.2681 5.6433 5.64298C6.26842 5.01786 7.11627 4.66667 8.00033 4.66667C8.88438 4.66667 9.73223 5.01786 10.3573 5.64298C10.9825 6.2681 11.3337 7.11595 11.3337 8C11.3337 8.88406 10.9825 9.7319 10.3573 10.357C9.73223 10.9821 8.88438 11.3333 8.00033 11.3333ZM8.00033 3C4.66699 3 1.82033 5.07333 0.666992 8C1.82033 10.9267 4.66699 13 8.00033 13C11.3337 13 14.1803 10.9267 15.3337 8C14.1803 5.07333 11.3337 3 8.00033 3Z" fill="#1A47A3"/>
                                            </svg>
                                        </a>`;
                                    html2 +=
                                        '<a aria-hidden="true" class="text-bluess rdbtn" data-id="'+ v.id +'" style="font-size: 14px;bottom:4px;color:#D33737;" data-href="' +
                                        '{{ route('property.deleteReminder', '') }}/' + v.id +
                                        '"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                                    html2 +='</div>';
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
                                    html2 += '</li>';
                                });
                                var rdiv = $('.appnedLis').prepend(html2);
                                $('.nravail').remove();
                                attachSeeAllClickListener();
                            }

                            if (rlist.length === 0) {
                                $('<h4 class="nravail" style="margin: 11px auto 0 auto !important;font-size: 15px;font-weight: 600;color: #808080;min-width: 180px; overflow-y: hidden;padding:0px 10px;width: -webkit-fill-available;text-align: center;">Reminders Not Available</h4>')
                                    .insertAfter(rdiv);
                            } else {
                                $('<h4 style="margin: 11px auto 0 auto !important;font-size: 15px;font-weight: 600;color: #1A47A3;width: -webkit-fill-available;text-align: center;text-decoration: underline;float: unset !important;height:23px !important;" class="seeAll showallm mb-2 nravail">View All Reminders</h4>')
                                    .insertAfter(rdiv);
                            }
                            if (sumIsRead > 0) {
                                $('.reminderNoti').removeClass('d-none');
                                $('.reminderNoti').text(sumIsRead);
                            } else {
                                $('.reminderNoti').addClass('d-none');
                                $('.reminderNoti').text(sumIsRead);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', status, error);
                        }
                    });
                }
            }

            $('#reportrange').daterangepicker({
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
        $(document).on('click', '.clickStatusChange', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var value = $(this).attr('data-status');
            $('input[name=reminderid]').val(id);
            $('.chngSts').val(value);
        });
        $(document).on('click', '.clickStatusChange2', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var value = $(this).attr('data-status');
            var valueO = $(this).attr('data-other');
            $('input[name=appointmentid]').val(id);
            $('.chngSts2').val(value);
            if(value == "other"){
                $('.appointment_other2').removeClass('d-none');
                $('.appointment_others').val(valueO);
            }else{
                $('.appointment_others').val("");
                $('.appointment_other2').addClass('d-none');
            }
        });
        $(document).on('change', '.chngSts3', function(e) {
            e.preventDefault();
            var valuestatus = $(this).val();
                if(valuestatus == "Rejected"){
                    $('.app_reason').removeClass('d-none');
                }else{
                    $('.app_reason').addClass('d-none');
                }
        });
        $(document).on('click', '.clickStatusChange3', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var reVal = $('#hidR_'+id).val();
            var value = $(this).attr('data-status');
            if(value == "Rejected"){
                $('.app_reason').removeClass('d-none');
                $('#app_reason').val(reVal);
            }else{
                $('#app_reason').val("");
                $('.app_reason').addClass('d-none');
            }
            $('input[name=appointmentid2]').val(id);
            $('.chngSts3').val(value);
        });
        $('.myremListdash').on('click', function(event) {
            if (!$(event.target).hasClass('clickStatusChange') && !$(event.target).hasClass('rdbtn')) {
                var propertyId = $(this).attr('data-pid');
                var route = '/dashboard/property/show/' +
                    propertyId; // Modify this route as per your Laravel route setup
                location.href = route;
            }
        });
        $(document).on('click', '.saveremstatus', function(e) {
            var value = $('.chngSts').val();
            var id = $('input[name=reminderid]').val();
            var type = 'reminderstatus'
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
                        window.location.reload();
                    } else {
                        alert('Not updated.');
                        window.location.reload();
                    }
                }
            });
        });
        $(document).on('click', '.saveremstatus2', function(e) {
            var value = $('.chngSts2').val();
            var value2 = $('.appointment_others').val();
            var id = $('input[name=appointmentid]').val();
            var type = 'appointmentstatus'
            $.ajax({
                type: 'POST',
                url: "{{ route('changeStatusNofication') }}",
                data: {
                    id: id,
                    type: type,
                    value: value,
                    value2: value2,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success == true) {
                        window.location.reload();
                    } else {
                        alert('Not updated.');
                        window.location.reload();
                    }
                }
            });
        });
        $(document).on('click', '.saveremstatus3', function(e) {
            var value = $('.chngSts3').val();
            var id = $('input[name=appointmentid2]').val();
            var reason = $('#app_reason').val();
            var type = 'appointmentPstatus'
            $.ajax({
                type: 'POST',
                url: "{{ route('changeStatusNofication') }}",
                data: {
                    id: id,
                    type: type,
                    value: value,
                    reason: reason,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success == true) {
                        window.location.reload();
                    } else {
                        alert('Not updated.');
                        window.location.reload();
                    }
                }
            });
        });
        $(document).on('click', '.dropdown-btns', function() {
            $('.appnedLiX').toggleClass('show');
        });
        $(document).on('change', '#when_timeM', function(e) {
            var when_timeM = $(this).val();
            if (when_timeM == "") {
                $('.checkHide').each(function(i, v) {
                    var dataWhen = $(this).data('when');
                    if (i < 3) {
                        $(this).removeClass('d-none');
                    } else {
                        $(this).addClass('d-none');
                    }
                });
            } else {
                $('.checkHide').each(function() {
                    var dataWhen = $(this).data('when');
                    if (dataWhen === when_timeM) {
                        $(this).removeClass('d-none');
                    } else {
                        $(this).addClass('d-none');
                    }
                });
            }

        });
        $(document).on('click', '.seeAll', function(e) {
            e.stopPropagation();
            // $('.checkHide').removeClass('d-none');
            $(this).parent('.card-header').removeClass('borderBottomRedius');
            $('.ipwlcart2').removeClass('d-none');
            $('.ipwlcsv11').addClass('trans180');
            $('.ipwlcsv12').css({
                'color': '#1A47A3'
            });
            window.location.href = window.location.origin + '/dashboard#allrf';
        });
        if(window.location.href === window.location.origin + '/dashboard#allrf') {
            $(this).parent('.card-header').removeClass('borderBottomRedius');
            $('.ipwlcart2').removeClass('d-none');
            $('.ipwlcsv11').addClass('trans180');
            $('.ipwlcsv12').css({
                'color': '#1A47A3'
            });
        }
        $(document).on('click', '.myremListM', function() {
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

                            $('.reminderNoti').addClass('d-none');
                            $clickedElement.css('color', '#333 !important');
                            if (response.data.id != "") {
                                var url = window.location.origin + '/dashboard/property/show/' + response
                                    .data.id + '?back=0';
                                window.location.href = url;
                                localStorage.setItem('selectedFilter', 'rem');
                            }
                        } else {
                            $('.reminderNoti').removeClass('d-none');
                            alert('Not updated.');
                        }
                    }
                });
        });
        $(document).on('click', '.readrbtn', function(event) {
            event.preventDefault();
            event.stopPropagation();
            var $clickedElement = $(this);
            var id = $(this).attr('data-id');
            var type = 'reminder';
            var value = 0;
            if($clickedElement.parent().parent().parent().hasClass('dReadRem')) {
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
                        var currentText = $('.reminderNoti').text();
                        var currentCount = parseInt(currentText);
                        var newCount = currentCount - 1;
                        $('.reminderNoti').text(newCount);
                        if(newCount == 0) {
                            $('.reminderNoti').addClass('d-none');
                        }
                        $clickedElement.parent().parent().css('color', '#313131 !important');
                        $clickedElement.parent().parent().parent().css('background', '#F2F4F7');
                        $clickedElement.parent().parent().parent().css('color', '#313131 !important');
                        $clickedElement.parent().parent().removeClass('dReadRem')
                    } else {
                        $('.reminderNoti').removeClass('d-none');
                        alert('Not updated.');
                    }
                }
            });
            }
        });

        function ajaxReminderCall() {
            $.ajax({
                url: "{{ route('checkReminder') }}",
                type: 'GET',
                success: function(response) {
                    var data = response.data;
                    if (response.success == true) {
                        $('.appnedLis').empty();
                        var html2 = '';
                        var sumIsRead = 0;
                        var rlist = $.each(data, function(i, v) {
                            if (v.is_read == 1) {
                                sumIsRead++;
                                // if (i > 3) {
                                //     html2 += '<li class="myremListD checkHide d-none" data-when="' + v
                                //         .when_time + '">';
                                // } else {
                                    html2 += '<li class="myremListD checkHide" data-when="' + v
                                        .when_time + '">';
                                // }
                                html2 += '<div class="dropdown-item myremListM myremList dReadRem" data-id="' + v
                                    .id + '" style="color:#1A47A3;">';
                            } else {
                                // if (i > 3) {
                                //     html2 += '<li class="myremListD checkHide d-none" data-when="' + v
                                //         .when_time + '" style="background:#F2F4F7;">';
                                // } else {
                                    html2 += '<li class="myremListD checkHide" data-when="' + v
                                        .when_time + '" style="background:#F2F4F7;">';
                                // }
                                html2 += '<div class="dropdown-item myremListM myremList" data-id="' + v
                                    .id + '" style="color:#313131;">';
                            }
                            html2 += '<div class="d-flex justify-content-between">';
                            html2 +=
                                '<h5 class=" mb-0" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;max-width: 50%;"><b>' +
                                v.title + '</b></h5>';
                            html2 += '<div class="d-flex align-items-center">';
                                    html2 +=
                                        `<a aria-hidden="true" class="readrbtn me-1" data-id="${v.id}">
                                            <svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.00033 6C7.46989 6 6.96118 6.21071 6.58611 6.58579C6.21104 6.96086 6.00033 7.46957 6.00033 8C6.00033 8.53043 6.21104 9.03914 6.58611 9.41421C6.96118 9.78929 7.46989 10 8.00033 10C8.53076 10 9.03947 9.78929 9.41454 9.41421C9.78961 9.03914 10.0003 8.53043 10.0003 8C10.0003 7.46957 9.78961 6.96086 9.41454 6.58579C9.03947 6.21071 8.53076 6 8.00033 6ZM8.00033 11.3333C7.11627 11.3333 6.26842 10.9821 5.6433 10.357C5.01818 9.7319 4.66699 8.88406 4.66699 8C4.66699 7.11595 5.01818 6.2681 5.6433 5.64298C6.26842 5.01786 7.11627 4.66667 8.00033 4.66667C8.88438 4.66667 9.73223 5.01786 10.3573 5.64298C10.9825 6.2681 11.3337 7.11595 11.3337 8C11.3337 8.88406 10.9825 9.7319 10.3573 10.357C9.73223 10.9821 8.88438 11.3333 8.00033 11.3333ZM8.00033 3C4.66699 3 1.82033 5.07333 0.666992 8C1.82033 10.9267 4.66699 13 8.00033 13C11.3337 13 14.1803 10.9267 15.3337 8C14.1803 5.07333 11.3337 3 8.00033 3Z" fill="#1A47A3"/>
                                            </svg>
                                        </a>`;
                                    html2 +=
                                        '<a aria-hidden="true" class="text-bluess rdbtn" data-id="'+ v.id +'" style="font-size: 14px;bottom:4px;color:#D33737;" data-href="' +
                                        '{{ route('property.deleteReminder', '') }}/' + v.id +
                                        '"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                                    html2 +='</div>';
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
                            html2 += '<div class=""><b class="">Due: </b>' + formatDate33(v.due_date,
                                'd/m/Y') + ' ' + convertTo12Hour(v.due_time) + '</div>';
                            html2 += '<div><small><span class="' + (v.status == 'Complete' ? 'compl' :
                                'inprog') + '" style="padding: 2px 8px;">' + (v.status ==
                                'Complete' ? 'Complete' : 'Pending') + '</span></small></div>';
                            html2 += '</div>';
                            html2 += '</div>';
                            html2 += '</li>';
                        });
                        var rdiv = $('.appnedLis').prepend(html2);
                        $('.nravail').remove();
                        attachSeeAllClickListener();
                    }
                    if (rlist.length === 0) {
                        $('<h4 class="nravail" style="margin: 11px auto 0 auto !important;font-size: 15px;font-weight: 600;color: #808080;min-width: 180px; overflow-y: hidden;padding:0px 10px;width: -webkit-fill-available;text-align: center;">Reminders Not Available</h4>')
                            .insertAfter(rdiv);
                    } else {
                        $('<h4 style="margin: 11px auto 0 auto !important;font-size: 15px;font-weight: 600;color: #1A47A3;width: -webkit-fill-available;text-align: center;text-decoration: underline;float: unset !important;height:23px !important;" class="seeAll showallm mb-2 nravail">View All Reminders</h4>')
                            .insertAfter(rdiv);
                    }
                    if (sumIsRead > 0) {
                        $('.reminderNoti').removeClass('d-none');
                        $('.reminderNoti').text(sumIsRead);
                    } else {
                        $('.reminderNoti').addClass('d-none');
                        $('.reminderNoti').text(sumIsRead);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', status, error);
                }
            });
        }

        function attachSeeAllClickListener() {
            $('.seeAll').off('click').on('click', function(e) {
                e.stopPropagation();
                $('.checkHide').removeClass('d-none');
            });
        }
        setInterval(ajaxReminderCall, 60000);
        var pusher = new Pusher('370bf8e7b4b51f01c629', {
                    cluster: 'eu',
                    forceTLS: true
                });

                var channel = pusher.subscribe('my-channel');
                channel.bind('my-event', function(data) {
                    makeAjaxCall();
                });
        function makeAjaxCall() {
            $.ajax({
                url: "{{ route('openChatNoti') }}", // Replace with your actual API endpoint
                type: 'GET',
                success: function(data) {
                    $('#myMenuAppend').empty();
                    var html = '';
                    var totalIsRead = 0;
                    $.each(data, function(index, noti) {
                        totalIsRead += parseInt(noti.is_read);
                        var initials = '';
                        if (noti.hasOwnProperty('firstname')) {
                            initials += noti.firstname.substr(0, 1);
                        }
                        if (noti.hasOwnProperty('lastname') && noti.lastname !== "" && noti.lastname !==
                            null) {
                            initials += noti.lastname.substr(0, 1);
                        }
                        initials = initials.toUpperCase();

                        if (noti.is_read == 1) {
                            html += '<a class="mynewDropDown dropdown-item newMessageC" href="' +
                                '/dashboard/contractor-chat/' + noti.id + '?cid=' + noti.property_id +
                                '">';
                        } else {
                            html += '<a class="mynewDropDown dropdown-item" href="' +
                                '/dashboard/contractor-chat/' + noti.id + '?cid=' + noti.property_id +
                                '">';
                        }
                        html +=
                            '<div class="mr-1" style="border:1px solid #1A47A3;font-weight: 600;min-width: 48px;font-family: Arial, sans-serif; font-size: 20px; color: #1A47A3; background-color: #e8ecf6; border-radius: 5px; display: inline-block; margin: 3px;border-radius: 36px; display: flex; align-items: center; justify-content: center;width:48px;height:48px;padding-left:10px;padding-right:10px;">';
                        html += initials + '</div>';
                        html += '<div class="d-flex flex-column overflowClass ms-1">';
                        html += '<b style="text-overflow: ellipsis;overflow: hidden;width: 243px;white-space: nowrap;">' + noti.name + ' - (' + noti.appname + ') - ' + noti
                            .address + '</b>';
                        if (noti.last_msg != "") {
                            html +=
                                '<span style="text-overflow: ellipsis; overflow: hidden; width: 150px;white-space: nowrap;">' +
                                noti.last_msg + '</span>';
                        } else {
                            var imageUrl = getLogoUrls(noti.last_img);
                            html += '<div class="d-flex mt-1">'
                            html += '<img src="' + imageUrl +
                                '" alt="" style="width:30px;height:30px;">';
                            html += '<span style="text-overflow: ellipsis;overflow: hidden;width: 205px;white-space: nowrap;margin-left:10px;">'+ noti.last_img +'</span>';
                            html += '</div>'
                        }

                        html += '</div>';
                        html += '<div class="d-flex flex-column text-end">';
                        html += '<span>' + formatDate3(noti.msg_date, 'd-m-Y') + '</span>';
                        html += '<span><small>' + formatDate4(noti.msg_date, 'hh:mm A') +
                            '</small></span>';
                        html += '</div>';
                        html += '</a>';

                        // Append the generated HTML to #myMenuAppend

                    });

                    $('#myMenuAppend').append(html);
                    $('#totalIsRead').text(totalIsRead);
                    if (totalIsRead > 0) {
                        $('#totalIsRead').removeClass('d-none');
                    } else {
                        $('#totalIsRead').addClass('d-none');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', status, error);
                }
            });
        }
        $('.mylist').on('click', function() {
            $('#totalIsRead').addClass('d-none');
        });
        function getLogoUrls(attachment) {
            var fileExtension = attachment.split('.').pop().toLowerCase();
            var imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'];
            var videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm', 'm4v', '3gp', 'mpeg', 'mpg'];
            var audioExtensions = ['mp3', 'wav', 'ogg', 'flac', 'aac', 'm4a', 'wma', 'aiff', 'ape', 'opus'];
            var otherExtensions = ['txt', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'rar', '7z', 'tar', 'gz', 'html', 'htm', 'css', 'js', 'php', 'cpp', 'java', 'py', 'csv', 'json', 'xml', 'epub', 'svg', 'ico', 'psd', 'ai', 'max', 'dwg'];

            var base = '/';
            var defaultLogo = base + 'public/assets/images/extension/word.svg';
            var videoLogo = base + 'public/assets/images/extension/video.svg';
            var audioLogo = base + 'public/assets/images/extension/audio.svg';
            var imageLogo = base + 'public/assets/images/extension/image.svg';
            var excelLogo = base + 'public/assets/images/extension/excel.svg';
            var slideLogo = base + 'public/assets/images/extension/slide.svg';
            var wordLogo = base + 'public/assets/images/extension/word.svg';

            var logoUrl = defaultLogo;
            if (imageExtensions.indexOf(fileExtension) !== -1) {
                logoUrl = imageLogo;
            } else if (videoExtensions.indexOf(fileExtension) !== -1) {
                logoUrl = videoLogo;
            } else if (audioExtensions.indexOf(fileExtension) !== -1) {
                logoUrl = audioLogo;
            } else if (fileExtension === 'xls' || fileExtension === 'xlsx') {
                logoUrl = excelLogo;
            } else if (fileExtension === 'ppt' || fileExtension === 'pptx') {
                logoUrl = slideLogo;
            } else if (fileExtension === 'doc' || fileExtension === 'docx') {
                logoUrl = wordLogo;
            }
            return logoUrl;
        }

        function formatDate33(dateString) {
            var options = {
                month: '2-digit',
                day: '2-digit',
                year: 'numeric'
            };
            var formattedDate = new Date(dateString).toLocaleDateString('en-GB', options);
            return formattedDate.replace(/(\d+)\/(\d+)\/(\d+)/, '$1/$2/$3');
        }
        function YMDFormat(dateString)
        {
            var options = {
                month: '2-digit',
                day: '2-digit',
                year: 'numeric'
            };
            var formattedDate = new Date(dateString).toLocaleDateString('en-GB', options);
            return formattedDate.replace(/(\d+)\/(\d+)\/(\d+)/, '$3-$2-$1');
        }
        function formatDate3(dateString) {
            var options = {
                month: '2-digit',
                day: '2-digit',
                year: 'numeric'
            };
            var formattedDate = new Date(dateString).toLocaleDateString('en-GB', options);
            return formattedDate.replace(/(\d+)\/(\d+)\/(\d+)/, '$1-$2-$3');
        }

        function convertTo12Hour(time24) {
            // Split the time string into hours and minutes
            var splitTime = time24.split(':');
            var hours = parseInt(splitTime[0]);
            var minutes = parseInt(splitTime[1]);

            // Format hours to 12-hour format with AM/PM
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // "0" should be "12" for 12-hour format

            // Add leading zeros to single-digit minutes
            minutes = minutes < 10 ? '0' + minutes : minutes;

            // Construct the 12-hour time string
            var time12 = hours + ':' + minutes + ' ' + ampm;

            return time12;
        }

        function formatDate4(dateString, format) {
            // Parse the date string without using Date object
            var match = dateString.match(/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})/);

            if (!match) {
                // Handle invalid date string
                return 'Invalid Date';
            }
            var year = parseInt(match[1], 10);
            var month = parseInt(match[2], 10) - 1; // Month is zero-based
            var day = parseInt(match[3], 10);
            var hours = parseInt(match[4], 10);
            var minutes = parseInt(match[5], 10);
            var seconds = parseInt(match[6], 10);

            // Format the time
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? (hours < 10 ? '0' + hours : hours) : 12; // Handle midnight
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var formattedTime = hours + ':' + minutes + ' ' + ampm;
            return formattedTime;
        }
    </script>
    <script>
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
        $(document).on('click', '.propcsv2', function() {
            if (!$('.dgrid').hasClass('dgrid2')) {
                $('.dgrid').addClass('dgrid2 show');
                $('.propcsv2').addClass('trans180');
            } else {
                $('.dgrid').removeClass('dgrid2 show');
                $('.propcsv2').removeClass('trans180');
            }
        });
        $(document).on('click', '.eye-toggle', function() {
            var input = $('input[name="password"]');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(document).ready(function() {
            $('input[name="password"]').after(
                '<svg style="right: 2%; position: absolute; top: 63%;" class="eye-toggle" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 18 18" fill="none"> <path d="M11.8125 9C11.8125 9.74592 11.5162 10.4613 10.9887 10.9887C10.4613 11.5162 9.74592 11.8125 9 11.8125C8.25408 11.8125 7.53871 11.5162 7.01126 10.9887C6.48382 10.4613 6.1875 9.74592 6.1875 9C6.1875 8.25408 6.48382 7.53871 7.01126 7.01126C7.53871 6.48382 8.25408 6.1875 9 6.1875C9.74592 6.1875 10.4613 6.48382 10.9887 7.01126C11.5162 7.53871 11.8125 8.25408 11.8125 9Z" fill="#2A2D34"></path> <path d="M0 9C0 9 3.375 2.8125 9 2.8125C14.625 2.8125 18 9 18 9C18 9 14.625 15.1875 9 15.1875C3.375 15.1875 0 9 0 9ZM9 12.9375C10.0443 12.9375 11.0458 12.5227 11.7842 11.7842C12.5227 11.0458 12.9375 10.0443 12.9375 9C12.9375 7.95571 12.5227 6.95419 11.7842 6.21577C11.0458 5.47734 10.0443 5.0625 9 5.0625C7.95571 5.0625 6.95419 5.47734 6.21577 6.21577C5.47734 6.95419 5.0625 7.95571 5.0625 9C5.0625 10.0443 5.47734 11.0458 6.21577 11.7842C6.95419 12.5227 7.95571 12.9375 9 12.9375Z" fill="#2A2D34"></path> </svg>'
            );
            $('input[name="password"]').parent().css('position', 'relative');
            $.fn.dataTableExt.errMode = 'ignore';
            jQuery.extend(jQuery.fn.dataTableExt.oSort, {
                "date-uk-pre": function(a) {
                    var ukDatea = a.split('/');
                    return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
                },

                "date-uk-asc": function(a, b) {
                    return a < b ? -1 : a > b ? 1 : 0;
                },

                "date-uk-desc": function(a, b) {
                    return a < b ? 1 : a > b ? -1 : 0;
                }
            });
            var isChromium = window.chrome;
            var winNav = window.navigator;
            var vendorName = winNav.vendor;
            var isOpera = typeof window.opr !== "undefined";
            var isIEedge = winNav.userAgent.indexOf("Edge") > -1;
            var isIOSChrome = winNav.userAgent.match("CriOS");

            // Autocomplete default value
            var autocomplete = "chrome-off";

            if (isIOSChrome) {
                // is Google Chrome on IOS
            } else if (isChromium !== null && typeof isChromium !== "undefined" && vendorName === "Google Inc." &&
                isOpera === false && isIEedge === false) {
                // Is Google Chrome
                autocomplete = "off";
            } else {
                // Is not Chrome
                autocomplete = "off";
            }

            // Apply the autocomplete attribute to all forms
            var forms = document.querySelectorAll('form');
            forms.forEach(function(form) {
                form.setAttribute("autocomplete", autocomplete);

                // Apply the autocomplete attribute to all input fields within the form
                var inputs = form.querySelectorAll('input');
                inputs.forEach(function(input) {
                    input.setAttribute("autocomplete", autocomplete);
                });
            });
            var url = window.location.href;
            var dashboardIndex = url.indexOf("dashboard/");
            if (dashboardIndex !== -1) {
                var valueAfterDashboard = url.substring(dashboardIndex + "dashboard/".length);
                var nextSlashIndex = valueAfterDashboard.indexOf("/");
                if (nextSlashIndex !== -1) {
                    var dashboardValue = valueAfterDashboard.substring(0, nextSlashIndex);
                    if (dashboardValue == "property") {} else {
                        localStorage.setItem('selectedFilter', "mea");
                    }
                } else {
                    localStorage.setItem('selectedFilter', "mea");
                }
            } else {
                localStorage.setItem('selectedFilter', "mea");
            }
            $('input[type="search"]').on('keyup', function() {
                var val = $(this).val();
                if (val === "") {
                    $('.fa-search').removeClass('d-none');
                } else {
                    $('.fa-search').addClass('d-none');
                }
            });
            $('#calendar_jobs').select2({
                placeholder: "Select Jobs"
            });
            $('#properties_jobs').select2({
                placeholder: "Select Jobs"
            });
            $('#gantt-filter').select2({
                placeholder: "Select Jobs"
            });

            // $('#dashboard-contractor-jobs-datatable_filter input[type="search"]').attr('placeholder', 'Search');
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
            $('.dataTables_filter label').append(icon);
            $('[data-toggle="tooltip"]').tooltip();
            $('#dashboard-contractor-jobs-datatable').DataTable().columns.adjust().draw();


            $('#overlay').fadeOut();
        });

        // function open_chatbox(e) {
        //     var popupWinWidth = 500;
        //     var popupWinHeight = 600;
        //     var pageTitle = "ChatBox";
        //     var pageURL = e.href;
        //     var left = (screen.width - popupWinWidth) / 2;
        //     var top = (screen.height - popupWinHeight) / 4;
        //     var strWindowFeatures =
        //         `directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no,width=${popupWinWidth},height=${popupWinHeight},left=${left},top=${top}`;
        //     var myWindow = window.open(pageURL, pageTitle, strWindowFeatures);
        // }
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#contractor-properties-table').DataTable();

        $('#admin-users-datatable').DataTable({
            lengthMenu: [
                [10, 25, 50, 100, 250, 500],
                [10, 25, 50, 100, 250, 500],
            ],
            // language: { search: "" },
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
            serverSide: true,
            pageLength: 25,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('user') }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'firstname',
                    name: 'firstname'
                },
                {
                    data: 'lastname',
                    name: 'lastname'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'usertype',
                    name: 'usertype'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#admin-users-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });


        $('#surveyor-users-datatable').DataTable({
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
            serverSide: true,
            pageLength: 25,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('surveyor') }}"
            },
            columns: [{
                    data: 'user_id',
                    name: 'user_id'
                },
                {
                    data: 'full_name',
                    name: 'full_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone_number',
                    name: 'phone_number'
                },
                {
                    data: 'appname',
                    name: 'appname'
                },
                {
                    data: 'is_access',
                    name: 'is_access',
                    render: function(data, type, row) {
                        return data == 1 ? 'Yes' : 'No';
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#surveyor-users-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });

        $('#errorlogs-datatable').DataTable({
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
            order: [
                [0, "desc"]
            ],
            serverSide: true,
            pageLength: 25,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('errorlogs') }}"
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'error_code',
                    name: 'error_code'
                },
                {
                    data: 'section',
                    name: 'section'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'property_name',
                    name: 'property_name'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'gen_id',
                    name: 'gen_id'
                },
                {
                    data: 'message',
                    name: 'message'
                },
                {
                    data: 'url',
                    name: 'url'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            // columnDefs: [
            //     {
            //         targets: 3, // Target the URL column
            //         width: '2px' // Set custom width
            //     }
            // ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#errorlogs-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });


        $('#clients-datatable').DataTable({
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
            serverSide: true,
            pageLength: 25,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('client') }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'address',
                    name: 'address1',
                    searchable: false
                },
                {
                    data: 'eircode',
                    name: 'eircode'
                },
                {
                    data: 'properties',
                    name: 'properties',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'batches',
                    name: 'batches',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'notes',
                    name: 'notes'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#clients-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });


        $('#batches-datatable').DataTable({
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
            serverSide: true,
            pageLength: 25,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('batch') }}?client_id=<?= isset($_GET['client_id']) ? $_GET['client_id'] : '' ?>&batch_id=<?= isset($_GET['batch_id']) ? $_GET['batch_id'] : '' ?>"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'our_ref',
                    name: 'our_ref'
                },
                {
                    data: 'scheme',
                    name: 'scheme.scheme',
                    orderable: false
                },
                {
                    data: 'quote',
                    name: 'quote'
                },
                {
                    data: 'invoice',
                    name: 'invoice'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'properties',
                    name: 'properties',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#batches-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });

        const propertiesDataTable = $('#properties-datatable').DataTable({
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
            order: [
                [0, "desc"]
            ],
            serverSide: true,
            pageLength: 25,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                {{-- url: "{{route('property', isset($_GET['scheme_id']) ? $_GET['scheme_id'] : 0)}}?client_id=<?= isset($_GET['client_id']) ? $_GET['client_id'] : '' ?>&batch_id=<?= isset($_GET['batch_id']) ? $_GET['batch_id'] : '' ?>" --}}
                url: window.location.href,
                data: function(data) {
                    data.property_start_date_filter = $("#property_start_date_filter").val();
                    data.property_end_date_filter = $("#property_end_date_filter").val();
                }
            },
            columns: [{
                    data: 'id',
                    name: 'properties.id'
                },
                {
                    data: 'scheme',
                    name: 'batch.scheme.scheme'
                },
                {
                    data: 'ref',
                    name: 'batch.our_ref'
                },
                {
                    data: 'client',
                    name: 'client.name'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'start_date',
                    name: 'properties.start_date'
                },
                {
                    data: 'end_date',
                    name: 'properties.end_date'
                },
                {
                    data: 'hea_status',
                    name: 'hea_status'
                },
                {
                    data: 'eircode',
                    name: 'eircode'
                },
                {
                    data: 'contractor_status',
                    name: 'contractor_status'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#properties-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });
        const leadsDataTable = $('#leads-datatable').DataTable({
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
            order: [
                [0, "desc"]
            ],
            serverSide: true,
            pageLength: 25,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> ',
                emptyTable:"No Leads added yet."
            },
            ajax: {
                {{-- url: "{{route('property', isset($_GET['scheme_id']) ? $_GET['scheme_id'] : 0)}}?client_id=<?= isset($_GET['client_id']) ? $_GET['client_id'] : '' ?>&batch_id=<?= isset($_GET['batch_id']) ? $_GET['batch_id'] : '' ?>" --}}
                url: window.location.href,
                data: function(data) {
                    data.property_start_date_filter = $("#leads_start_date_filter").val();
                    data.property_end_date_filter = $("#leads_end_date_filter").val();
                }
            },
            columns: [{
                    data: 'id',
                    name: 'properties.id'
                },
                {
                    data: 'occupier_name',
                    name: 'occupier_name',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'eircode',
                    name: 'eircode'
                },
                {
                    data: 'lead_type',
                    name: 'lead_type'
                },
                {
                    data: 'lead_value',
                    name: 'lead_value'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        return data == 'Lead' ? 'New Lead' : data;
                    }
                },
                {
                    data: 'quotation',
                    name: 'quotation',
                    render: function(data, type, row, meta) {
                        if(data != ""){
                            return '<a href="'+data+'" download>'+row.quotation_title+'</a>';
                        }else{
                            return "N/A";
                        }
                    }
                },
                {
                    data: 'start_date',
                    name: 'properties.start_date',
                },
                {
                    data: 'end_date',
                    name: 'properties.end_date'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#leads-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });
        function applyFilters() {
            var batchFilterValue = $("#property_batch_filter").val();
            var schemeFilterValue = $("#property_scheme_filter").val();
            var statusFilterValue = $("#property_status_filter").val();

            // Construct the search query
            var searchQuery = '';

            if (batchFilterValue !== "") {
                searchQuery += batchFilterValue + ' ';
            }

            if (schemeFilterValue !== "") {
                searchQuery += schemeFilterValue + ' ';
            }

            if (statusFilterValue !== "") {
                searchQuery += statusFilterValue + ' ';
            }

            // Apply the search query to the entire table
            propertiesDataTable.search(searchQuery.trim(), true, false).draw();
        }

        // Attach the function to the change event of relevant filters
        $('#property_batch_filter, #property_scheme_filter, #property_status_filter, #property_start_date_filter, #property_end_date_filter').change(applyFilters);
        function applyFilters2() {
            var leadbatchFilterValue = $("#leads_status_filter").val();
            var leadbatchFiltertext = $("#leads_status_filter option:selected").text();
            // console.log(leadbatchFiltertext);
            if(leadbatchFiltertext == "All Leads"){
               $("#leads_start_date_filter").val("");
               $("#leads_end_date_filter").val("");
            }
            console.log(leadbatchFilterValue);
            // Construct the search query
            var searchQuery = '';

            if (leadbatchFilterValue !== "") {
                searchQuery += leadbatchFilterValue + ' ';
            }
            leadsDataTable.search(searchQuery.trim(), true, false).draw();
        }

        // Attach the function to the change event of relevant filters
        $('#leads_status_filter, #leads_start_date_filter, #leads_end_date_filter').change(applyFilters2);

        $('#contractor-datatable').DataTable({
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
            serverSide: true,
            pageLength: 25,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('contractor') }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'company',
                    name: 'company'
                },
                {
                    data: 'firstname',
                    name: 'firstname'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'jobs',
                    name: 'jobs'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#contractor-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });

        $('#assessor-datatable').DataTable({
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
            serverSide: true,
            pageLength: 25,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('assessor') }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'company',
                    name: 'company'
                },
                {
                    data: 'firstname',
                    name: 'firstname'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#assessor-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });

        $('#contract-datatable').DataTable({
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
            serverSide: true,
            pageLength: 25,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('contract') }}"
            },
            columns: [{
                    data: 'address1',
                    name: 'address1',
                    orderable: false
                },
                {
                    data: 'batch',
                    name: 'batch',
                    orderable: false
                },
                {
                    data: 'wh_fname',
                    name: 'wh_fname',
                    orderable: false
                },
                {
                    data: 'wh_lname',
                    name: 'wh_lname',
                    orderable: false
                },
                {
                    data: 'end_date',
                    name: 'end_date',
                    orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#accessor-contract-datatable').DataTable({
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
            serverSide: true,
            pageLength: 25,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('assessor-contract') }}"
            },
            columns: [{
                    data: 'address1',
                    name: 'address1'
                },
                {
                    data: 'batch',
                    name: 'batch'
                },
                {
                    data: 'wh_fname',
                    name: 'wh_fname'
                },
                {
                    data: 'wh_lname',
                    name: 'wh_lname'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#logs-datatable').DataTable({
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
            order: [
                [0, "desc"]
            ],
            serverSide: true,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('dashboard') }}"
            },
            columns: [{
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'author',
                    name: 'author'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                // {data: 'address', name: 'address'},
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                // {
                //     data: 'address',
                //     name: 'address'
                // },
                {
                    data: null,
                    render: function(data, type, row) {
                        // Concatenate address, city, state, and country, handling null values
                        let addressParts = [row.house_num, row.address1, row.address2, row.address3, row
                            .county, row.eircode
                        ];
                        let filteredAddressParts = addressParts.filter(part => part !== null && part !==
                            undefined);
                        return filteredAddressParts.join(', ');
                    },
                    name: 'full_address'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#logs-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });

        $('#post-work-logs-datatable').DataTable({
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
            serverSide: true,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('dashboard.postWorkLog') }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        // Concatenate address, city, state, and country, handling null values
                        let addressParts = [row.house_num, row.address1, row.address2, row.address3, row
                            .county, row.eircode
                        ];
                        let filteredAddressParts = addressParts.filter(part => part !== null && part !==
                            undefined);
                        return filteredAddressParts.join(', ');
                    },
                    name: 'full_address'
                },
                {
                    data: 'notes',
                    name: 'notes'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                // { data: 'status', name: 'status',
                //     createdCell: function (td, cellData, rowData, row, col) {
                //         if (cellData === 'In progress') {
                //             $(td).addClass('cusmarg badge badge-infos');
                //         } else if (cellData === 'Opened') {
                //             $(td).addClass('cusmarg badge badge-infos');
                //         } else if (cellData === 'Pending') {
                //             $(td).addClass('cusmarg badge badge-warning');
                //         }else if (cellData === 'Complete') {
                //             $(td).addClass('cusmarg badge badge-success');
                //         }else if (cellData === 'Accepted') {
                //             $(td).addClass('cusmarg badge badge-success-light');
                //         }
                //     }
                // },
                {
                    data: 'date_added',
                    name: 'date_added'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#post-work-logs-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });

        $('#property-notes-datatable').DataTable({
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
            order: [
                [0, "desc"]
            ],
            serverSide: true,
            responsive: true,
            select: true,
            pageLength: 10,
            "processing": true,
            empty: 'fff',
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> ',
                emptyTable: "No notes added yet."
            },
            ajax: {
                url: "{{ route('property.note', isset($property) ? $property->id : 1) }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'text',
                    name: 'text',
                    render: function(data, type, row) {
                        if (type === 'display' && data.length > 100) {
                            return '<span title="' + data + '">' + data.substr(0, 100) + '...</span>';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#job-lookup-datatable').DataTable({
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
            order: [
                [0, "desc"]
            ],
            serverSide: true,
            responsive: true,
            select: true,
            pageLength: 25,
            "processing": true,
            empty: 'fff',
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('lookup.job') }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#job-lookup-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });

        $('#job-document-lookup-datatable').DataTable({
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
            order: [
                [0, "desc"]
            ],
            serverSide: true,
            responsive: true,
            select: true,
            pageLength: 10,
            "processing": true,
            empty: 'fff',
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('lookup.job.document', isset($lookup) ? $lookup->id : 0) }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#schemes-datatable').DataTable({
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
            order: [
                [2, "desc"]
            ],
            serverSide: true,
            responsive: true,
            select: true,
            pageLength: 10,
            "processing": true,
            empty: 'fff',
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('lookup.scheme') }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'scheme',
                    name: 'scheme'
                },
                {
                    data: 'is_active',
                    name: 'is_active'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#schemes-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });

        const contractorJobsDataTable = $('#dashboard-contractor-jobs-datatable').DataTable({
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
            order: [
                [0, "desc"]
            ],
            serverSide: true,
            pageLength: 10,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('dashboard.contractor-jobs') }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'wh_fname',
                    name: 'wh_fname',
                    orderable: false
                },
                {
                    data: 'address',
                    name: 'address',
                    orderable: false
                },
                {
                    data: 'eircode',
                    name: 'property.eircode',
                    orderable: false
                },
                {
                    data: 'phone',
                    name: 'phone',
                    orderable: false
                },
                {
                    data: 'property.created_at',
                    name: 'property.created_at'
                },
                {
                    data: 'property.wh_mprn',
                    name: 'property.wh_mprn',
                    orderable: false
                },
                {
                    data: 'scheme',
                    name: 'property.batch.scheme.scheme',
                    orderable: false
                },
                {
                    data: 'property.batch.our_ref',
                    name: 'property.batch.our_ref',
                    orderable: false
                },
                {
                    data: 'job',
                    name: 'job',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'surveyor.full_name',
                    name: 'surveyor.full_name',
                    orderable: false
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#dashboard_job_filter_select').change(function() {
            contractorJobsDataTable
                .columns(8)
                .search($("#dashboard_job_filter_select").val())
                .draw();
        });

        let jobs = [];
        @if (isset($jobs))
            jobs = @json($jobs);
        @endif

        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                saveOrder();
            }
        });

        function saveOrder() {
            var order = [];

            $('#tablecontents tr').each(function(index, element) {
                order.push({
                    id: $(this).attr('data-id'),
                    contractor_id: $(this).attr('data-contractor'),
                    position: index + 1
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
            // dom: 'Bfrtip',
            dom: 'fBrtlp',
            buttons: [{
                extend: 'collection',
                text: 'Export',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    size: 'A4',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function (doc) {
                        // Reduce font size for all content (optional)
                        doc.defaultStyle.fontSize = 6.5; // Adjust as needed

                        // Change header background color (optional)
                        if (doc.content[1] && doc.content[1].table && doc.content[1].table.body && doc.content[1].table.body.length > 0) {
                        var headerCells = doc.content[1].table.body[0];
                        headerCells.forEach(function(cell) {
                            cell.fontSize = 6.5;
                            cell.fillColor = '#1A47A3'; // Change to your desired color
                            cell.color = '#ffffff'; // Change text color if needed
                        });
                        }

                        // Change odd row background color (optional)
                        if (doc.content[1] && doc.content[1].table && doc.content[1].table.body && doc.content[1].table.body.length > 1) {
                        var rowCount = doc.content[1].table.body.length;
                        for (var i = 1; i < rowCount; i += 2) {
                            var rowCells = doc.content[1].table.body[i];
                            rowCells.forEach(function(cell) {
                            cell.fillColor = '#EAF1FF'; // Change to your desired color
                            });
                        }
                        }

                        // Add grey borders to all table cells
                        if (doc.content[1] && doc.content[1].table) {
                        var tableLayout = {
                            hLineWidth: function (i) { return 0.75; }, // Adjust line width as needed
                            vLineWidth: function (i) { return 0.75; },
                            hLineColor: function (i) { return '#cccccc'; }, // Grey color for borders
                            vLineColor: function (i) { return '#cccccc'; }
                        };
                        doc.content[1].layout = tableLayout;
                        }
                    }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            }],
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
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            createdRow: function(row, data, dataIndex) {
                $(row).attr('data-contractor', "{{ request('contractor_id') }}");
            },
            ajax: {
                url: "{{ route('dashboard.property-contracts') }}",
                type: 'POST',
                data: function(data) {
                    data.batch_id = $('#properties_batch').val();;
                    data.contractor_id = "{{ request('contractor_id') }}";
                    data.scheme = $('#properties_scheme').val();
                    data.selected_jobs = $('#properties_jobs').val();
                }
            },
            columns: [{
                    data: 'address',
                    name: 'address',
                    class: "px-1 py-0 border-b bg-light h-33px align-middle",
                    orderable: false,
                },
                {
                    data: 'status',
                    name: 'properties.status',
                    class: "px-1 py-0 align-middle text-uppercase",
                    render: function(data, type, row) {
                        if (type === 'display' && data != null && data.length > 10) {
                            return '<span title="' + data + '">' + data.substr(0, 10) + '...</span>';
                        } else {
                            return data;
                        }
                    }
                },
                ...(jobs?.length ? jobs : []).map((job, key) => ({
                    data: 'c_' + job.id,
                    name: 'c_' + job.id,
                    orderable: false,
                    searchable: false,
                    class: "px-1 py-0 align-middle"
                })),
                {
                    data: 'clients_name',
                    name: 'clients_name',
                    visible: false, // Hide the column
                },
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#dashboard_properties_with_statuses_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });
        $("#properties_jobs,#properties_batch,#properties_scheme").on('change',function() {
            propertyContractsDataTable.draw();
        });
        @if (isset($property) && $property->id)

            $('#property-surveyor-sign-logs').DataTable({
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
                serverSide: true,
                pageLength: 25,
                responsive: true,
                select: true,
                "processing": true,
                "language": {
                    "search": "",
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    },
                    processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
                },
                ajax: {
                    url: "{{ route('property.surveyorLogs', $property->id) }}"
                },
                columns: [{
                        data: 'surveyor',
                        name: 'surveyor',
                        orderable: false,
                        searchable: false,
                        width: 100
                    },
                    {
                        data: 'type',
                        name: 'type',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date',
                        name: 'date',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'time',
                        name: 'time',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'text',
                        name: 'text',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'showDetails',
                        name: 'showDetails',
                        orderable: false,
                        searchable: false
                    }
                ]
            });


            const fetchAndPopulateSurveyors = () => {
                listContainer = $('#survery-list')
                $.ajax({
                    url: '{{ route('property.getSurveyors', $property->id) }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        listContainer.html('');
                        if(data.length > 0){
                        data.forEach((surveyor, i) => {
                            listContainer.append(`<li class="survey-list-li mr-2 mb-2">
                                <div class="d-flex justify-content-around">
                                    <div class="d-flex justify-content-center align-items-center"><span class="info font-16 mr-1">${surveyor?.name}</span><span class="font-12">(${surveyor?.survey_date})</span></div>
                                    <div>
                                        <span>
                                            <i onclick="deleteSurveyor(${surveyor.id})" class="pointer dripicons-cross"></i>
                                        </span>
                                    </div>
                                </div>
                            </li>`)
                        })
                        }else{
                            listContainer.append(`<span style="margin: 15px auto; text-align: center; width: 60vw;">No surveyers added yet.</span>`);
                        }
                    }
                });
            }

            const removeSurveyor = (id) => {
                let removeUrl = `{{ route('property.removeSurveyor', 'delete_id') }}`;
                $.ajax({
                    url: removeUrl.replace('delete_id', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
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

                if (surveyDate && surveyorId && confirm(
                        'Are you sure you want to add this surveyor to the property?')) {

                    $.ajax({
                        url: '{{ route('property.assignSurveyor', $property->id) }}',
                        type: 'POST',
                        dataType: 'json',
                        contentType: "application/json",
                        data: JSON.stringify({
                            survey_date: surveyDate,
                            surveyor_id: surveyorId,
                            property_id: {{ $property->id }}
                        }),
                        success: function(data) {
                            fetchAndPopulateSurveyors();
                        }
                    });

                }
            })
        @endif
        $('#property_inspection_table').DataTable({
            order: [],
            language: {
                search: "",
                paginate: {
                    "previous": "<",
                    "next": ">"
                },
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
            columnDefs: [{
                targets: [1],
                render: function(data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        var dateParts = data.split('/');

                        return dateParts[0] + '/' + dateParts[1] + '/' + dateParts[2];
                    }
                    return data;
                },
                type: 'date-uk'
            }],
            "language": {
                emptyTable: "No inspection/reports added yet."
                }
        });
        $('#property_inspection_table2').DataTable({
            order: [],
            language: {
                search: "",
                paginate: {
                    "previous": "<",
                    "next": ">"
                },
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
            columnDefs: [{
                targets: [1],
                render: function(data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        var dateParts = data.split('/');

                        return dateParts[0] + '/' + dateParts[1] + '/' + dateParts[2];
                    }
                    return data;
                },
                type: 'date-uk'
            }],
            "language": {
                emptyTable: "No inspection/reports added yet."
                }
        });
        $('#property_inspection_table3').DataTable({
            order: [],
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
            columnDefs: [{
                targets: [1],
                render: function(data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        var dateParts = data.split('/');

                        return dateParts[0] + '/' + dateParts[1] + '/' + dateParts[2];
                    }
                    return data;
                },
                type: 'date-uk'
            }],
            "language": {
                emptyTable: "No inspection/reports added yet."
                }
        });
        $('#property_inspection_table4').DataTable({
            order: [],
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
            columnDefs: [{
                targets: [1],
                render: function(data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        var dateParts = data.split('/');

                        return dateParts[0] + '/' + dateParts[1] + '/' + dateParts[2];
                    }
                    return data;
                },
                type: 'date-uk'
            }],
            "language": {
                emptyTable: "No inspection/reports added yet."
                }
        });
        $('#timesheet_table').DataTable({
            order: [],
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
            columnDefs: [{
                targets: [1,2],
                render: function(data, type, row) {
                    if ((type === 'display' || type === 'filter') && data != "N/A") {
                        var dateParts = data.split('/');

                        return dateParts[0] + '/' + dateParts[1] + '/' + dateParts[2];
                    }
                    return data;
                },
                type: 'date-uk'
            }],
            "language": {
                emptyTable: "No timesheet added yet."
                }
        });
        $('#property_snags_table').DataTable({
            order: [
                [1, 'desc']
            ],
            language: {
                search: "",
                paginate: {
                    "previous": "<",
                    "next": ">"
                },
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
                emptyTable: "No snags added yet."
                }
        });
        $('#property-assessor-body1').DataTable({
            order: [
                [1, 'desc']
            ],
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
                emptyTable: "No hea/ber assessor added yet."
                }
        });
        $('#photo-datatable').DataTable({
            order: [
                [0, 'asc']
            ],
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
        });
        $('#toolbox-talk-datatable').DataTable({
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
            order: [
                [0, "desc"]
            ],
            serverSide: true,
            responsive: true,
            select: true,
            pageLength: 25,
            "processing": true,
            empty: 'fff',
            "language": {
                "search": "",
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('toolboxTalk') }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'talk_title',
                    name: 'talk_title'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#toolbox-talk-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            }
        });

        $('#toolbox-talk-items-datatable').DataTable({
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
            order: [
                [0, "desc"]
            ],
            serverSide: true,
            responsive: true,
            select: true,
            pageLength: 10,
            "processing": true,
            empty: 'fff',
            "language": {
                "search": "",
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            ajax: {
                url: "{{ route('toolboxTalk.getToolboxTalkItems', isset($toolbox_talk) ? $toolbox_talk->id : 0) }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'toolbox_item',
                    name: 'toolbox_item'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#work-desc-datatable').DataTable({
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
            order: [
                [0, "desc"]
            ],
            // serverSide: true,
            responsive: true,
            select: true,
            "processing": true,
            "language": {
                "search": "",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                },
                processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
            },
            initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $("#logs-datatable_wrapper").find('.buttons-collection').addClass('disabled');
                }
            },
            columnDefs: [
                {
                targets: 2, // Target the third column (index starts from 0)
                orderable: false,
                searchable: false
                }
            ]
        });

        function showSurveyorLogDetails(id = 0) {
            const IMAGE_BASE_PATH = "{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/user_signinout/') }}";
            $.ajax({
                url: "{{ route('property.surveyorLogDetails', 'log_id') }}".replace('log_id', id),
                type: 'GET',
                dataType: 'json',
                contentType: "application/json",
                success: function(data) {
                    let signInColumns = '';
                    for (let i = 1; i <= 15; i++) {
                        if (data['signin_image' + i]) {
                            signInColumns += `<div class="col-sm-12 p-2">
                                        <img src="${IMAGE_BASE_PATH}/${data['signin_image'+i]}" class="img-fluid">
                                    </div>`;
                        }
                    }

                    let signOutColumns = '';

                    for (let i = 1; i <= 15; i++) {
                        if (data['signout_image' + i]) {
                            signOutColumns += `<div class="col-sm-12 p-2">
                                        <img src="${IMAGE_BASE_PATH}/${data['signout_image'+i]}" class="img-fluid">
                                    </div>`;
                        }
                    }

                    const [signin_year, signin_month, signin_day] = (data?.sign_date || '0000-00-00').split(
                        '-');
                    const [signout_year, signout_month, signout_day] = (data?.sign_e_date || '0000-00-00').split
                        ('-');

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

        $(document).on('click', '.text-bluess.rdbtn', function(event) {
            event.preventDefault();
            event.stopPropagation(); // Stop event propagation to prevent triggering the parent element click event
            var confirmation = confirm(`Are you sure you want to delete?`);
            if (confirmation) {
                // Your delete logic here
                var deleteUrl = $(this).attr('data-href');
                // Perform deletion
                $.ajax({
                    type: 'GET', // Assuming it's a GET request, adjust accordingly
                    url: deleteUrl,
                    success: function(response) {
                        // Handle success response
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                    }
                });
            }
        });


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
        //         url: "{{ route('dashboard.calendar') }}",
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
