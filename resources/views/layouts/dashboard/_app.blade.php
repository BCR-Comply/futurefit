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

        .clickStatusChange {
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

<<<<<<< HEAD
        .myNewMenu>.dropdown-item {
            background: #F2F4F7;
=======
        .myNewMenu > .dropdown-item{
            background: #eaf1ff;
>>>>>>> c7a5aaf60620f311fd9663dad475708479988024
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
                    {{-- <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" style="max-height: 130px"> --}}

<<<<<<< HEAD
                    {{-- <svg class="pl-2 pr-2 pt-2 pb-2" id="Layer_1" data-name="Layer 1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 1110 502">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #1a47a3;
                                }

                                .cls-2 {
                                    fill: #fff;
                                }

                                .cls-3 {
                                    fill: url(#linear-gradient);
                                }

                                .cls-4 {
                                    fill: url(#linear-gradient-2);
                                }

                                .cls-5 {
                                    fill: url(#linear-gradient-3);
                                }

                                .cls-6 {
                                    fill: url(#linear-gradient-4);
                                }

                                .cls-7 {
                                    fill: url(#linear-gradient-5);
                                }

                                .cls-8 {
                                    fill: url(#linear-gradient-6);
                                }

                                .cls-9 {
                                    fill: url(#linear-gradient-7);
                                }

                                .cls-10 {
                                    fill: url(#linear-gradient-8);
                                }

                                .cls-11 {
                                    fill: url(#linear-gradient-9);
                                }

                                .cls-12 {
                                    fill: url(#linear-gradient-10);
                                }

                                .cls-13 {
                                    fill: url(#linear-gradient-11);
                                }

                                .cls-14 {
                                    opacity: 0.5;
                                    fill: url(#radial-gradient);
                                }
                            </style>
                            <linearGradient id="linear-gradient" x1="136.75" y1="248.86" x2="136.75"
                                y2="53.63" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#009ddc" />
                                <stop offset="1" stop-color="#67b8e7" />
                            </linearGradient>
                            <linearGradient id="linear-gradient-2" x1="337.35" y1="248.86" x2="337.35"
                                y2="53.63" xlink:href="#linear-gradient" />
                            <linearGradient id="linear-gradient-3" x1="548.1" y1="248.86" x2="548.1"
                                y2="53.63" xlink:href="#linear-gradient" />
                            <linearGradient id="linear-gradient-4" x1="80.36" y1="255.11" x2="80.36"
                                y2="411.83" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#e06c6d" />
                                <stop offset="1" stop-color="#d5244c" />
                            </linearGradient>
                            <linearGradient id="linear-gradient-5" x1="186" y1="255.11" x2="186"
                                y2="411.83" xlink:href="#linear-gradient-4" />
                            <linearGradient id="linear-gradient-6" x1="323.91" y1="255.11" x2="323.91"
                                y2="411.83" xlink:href="#linear-gradient-4" />
                            <linearGradient id="linear-gradient-7" x1="463.79" y1="255.11" x2="463.79"
                                y2="411.83" xlink:href="#linear-gradient-4" />
                            <linearGradient id="linear-gradient-8" x1="538.16" y1="255.11" x2="538.16"
                                y2="411.83" xlink:href="#linear-gradient-4" />
                            <linearGradient id="linear-gradient-9" x1="608.37" y1="255.11" x2="608.37"
                                y2="411.83" xlink:href="#linear-gradient-4" />
                            <linearGradient id="linear-gradient-10" x1="718.64" y1="163.48" x2="970.1"
                                y2="163.48" xlink:href="#linear-gradient" />
                            <linearGradient id="linear-gradient-11" x1="703.18" y1="192.17" x2="1075.38"
                                y2="192.17" xlink:href="#linear-gradient-4" />
                            <radialGradient id="radial-gradient" cx="790.05" cy="189.79" r="37.92"
                                gradientTransform="translate(0 314.58) scale(1 0.2)" gradientUnits="userSpaceOnUse">
                                <stop offset="0" />
                                <stop offset="1" stop-opacity="0" />
                            </radialGradient>
                        </defs>
                        <rect class="cls-1" x="702.75" y="371.65" width="373.19" height="89.85" rx="10.89" />
                        <path class="cls-2"
                            d="M816.85,437.89a1.21,1.21,0,0,1-.13.6,1,1,0,0,1-.62.41,6.32,6.32,0,0,1-1.43.23c-.63,0-1.49.06-2.57.06-.91,0-1.64,0-2.18-.06a5,5,0,0,1-1.29-.25,1.41,1.41,0,0,1-.67-.45,2.45,2.45,0,0,1-.32-.67l-3.78-9.41c-.46-1.07-.9-2-1.34-2.84a8.94,8.94,0,0,0-1.45-2.06,5.13,5.13,0,0,0-1.84-1.26,6.4,6.4,0,0,0-2.41-.42h-2.67v16.06a.9.9,0,0,1-.21.58,1.35,1.35,0,0,1-.7.42,7.1,7.1,0,0,1-1.3.27,24.08,24.08,0,0,1-4.16,0,7.19,7.19,0,0,1-1.32-.27,1.28,1.28,0,0,1-.68-.42.94.94,0,0,1-.19-.58V399.55a2.58,2.58,0,0,1,.73-2.06,2.64,2.64,0,0,1,1.81-.64H799c1.1,0,2,0,2.73.07s1.37.09,2,.16a17.57,17.57,0,0,1,4.57,1.24,11,11,0,0,1,3.46,2.29,9.7,9.7,0,0,1,2.16,3.36,12.23,12.23,0,0,1,.75,4.44,13,13,0,0,1-.54,3.86,9.52,9.52,0,0,1-1.58,3.11,10.11,10.11,0,0,1-2.57,2.38,13.61,13.61,0,0,1-3.48,1.63,9.32,9.32,0,0,1,3.33,2.69,15.74,15.74,0,0,1,1.39,2.11,28.47,28.47,0,0,1,1.27,2.69l3.55,8.31c.32.82.54,1.43.65,1.8A3.41,3.41,0,0,1,816.85,437.89Zm-11-28.6a6.21,6.21,0,0,0-.94-3.51,5.11,5.11,0,0,0-3.1-2,10.73,10.73,0,0,0-1.48-.26,19.57,19.57,0,0,0-2.3-.1h-3.84v12h4.37a10.55,10.55,0,0,0,3.19-.44,6.24,6.24,0,0,0,2.28-1.24,5.06,5.06,0,0,0,1.37-1.9A6.56,6.56,0,0,0,805.81,409.29Z" />
                        <path class="cls-2"
                            d="M848.51,422.52a3.13,3.13,0,0,1-.67,2.21,2.37,2.37,0,0,1-1.84.72H828.32a11.81,11.81,0,0,0,.44,3.37,6.35,6.35,0,0,0,1.4,2.57,5.94,5.94,0,0,0,2.47,1.61,10.59,10.59,0,0,0,3.64.56,20,20,0,0,0,3.77-.31,25.57,25.57,0,0,0,2.82-.68c.79-.25,1.45-.48,2-.69a3.6,3.6,0,0,1,1.27-.31.91.91,0,0,1,.49.12.85.85,0,0,1,.33.4,3.36,3.36,0,0,1,.18.83c0,.36,0,.81,0,1.36s0,.88,0,1.22a6.19,6.19,0,0,1-.1.86,2.12,2.12,0,0,1-.19.6,2.43,2.43,0,0,1-.34.47,3.77,3.77,0,0,1-1.16.62,18.23,18.23,0,0,1-2.41.77c-1,.25-2.1.46-3.35.65a28.58,28.58,0,0,1-4,.28,21.37,21.37,0,0,1-6.79-1,12.06,12.06,0,0,1-4.87-3,12.3,12.3,0,0,1-2.92-5,23.59,23.59,0,0,1-1-7.1,22.73,22.73,0,0,1,1-7,14.58,14.58,0,0,1,2.93-5.27,12.52,12.52,0,0,1,4.68-3.31,16,16,0,0,1,6.2-1.14,16.21,16.21,0,0,1,6.24,1.08,11.25,11.25,0,0,1,4.25,3,11.94,11.94,0,0,1,2.44,4.51,19.61,19.61,0,0,1,.78,5.66Zm-7.94-2.35a8.43,8.43,0,0,0-1.39-5.42,5.37,5.37,0,0,0-4.58-2,5.83,5.83,0,0,0-2.72.59,5.56,5.56,0,0,0-1.92,1.57,7.29,7.29,0,0,0-1.17,2.35,11.56,11.56,0,0,0-.47,2.88Z" />
                        <path class="cls-2"
                            d="M872,435a10.19,10.19,0,0,1-.18,2.2,2.49,2.49,0,0,1-.47,1.08,2.72,2.72,0,0,1-.87.55,7.46,7.46,0,0,1-1.33.42,12.9,12.9,0,0,1-1.67.28,15.39,15.39,0,0,1-1.8.1,13.12,13.12,0,0,1-4.24-.62,7,7,0,0,1-3-1.91,7.87,7.87,0,0,1-1.73-3.24,17,17,0,0,1-.55-4.62V414.37h-3.49c-.41,0-.72-.25-.94-.76a7,7,0,0,1-.33-2.56,11.78,11.78,0,0,1,.09-1.59,3.64,3.64,0,0,1,.24-1,1.17,1.17,0,0,1,.41-.54,1,1,0,0,1,.57-.16h3.45v-6.48a1,1,0,0,1,.18-.59,1.34,1.34,0,0,1,.65-.44,5.39,5.39,0,0,1,1.27-.26c.53,0,1.19-.08,2-.08s1.47,0,2,.08a5.18,5.18,0,0,1,1.26.26,1.51,1.51,0,0,1,.65.44,1,1,0,0,1,.19.59v6.48h6.32a1,1,0,0,1,.57.16,1.17,1.17,0,0,1,.41.54,3.64,3.64,0,0,1,.24,1,11.78,11.78,0,0,1,.09,1.59,7,7,0,0,1-.33,2.56c-.22.51-.53.76-.94.76h-6.36V428a6.78,6.78,0,0,0,.75,3.57,2.91,2.91,0,0,0,2.67,1.19,5.29,5.29,0,0,0,1.18-.12,6.9,6.9,0,0,0,.93-.26c.27-.1.5-.18.68-.26a1.42,1.42,0,0,1,.5-.11.76.76,0,0,1,.38.11.81.81,0,0,1,.28.46,7.61,7.61,0,0,1,.17.93A10.14,10.14,0,0,1,872,435Z" />
                        <path class="cls-2"
                            d="M896.59,411.54c0,.78,0,1.42-.07,1.92a6.17,6.17,0,0,1-.19,1.17,1.1,1.1,0,0,1-.35.59.84.84,0,0,1-.53.16,1.69,1.69,0,0,1-.59-.11l-.73-.24c-.27-.09-.57-.17-.9-.25a5,5,0,0,0-1.07-.11,3.71,3.71,0,0,0-1.37.27,6,6,0,0,0-1.42.87,10.34,10.34,0,0,0-1.53,1.56,26.74,26.74,0,0,0-1.71,2.41v18.11a.87.87,0,0,1-.19.57,1.51,1.51,0,0,1-.67.41,5.53,5.53,0,0,1-1.26.24,24.67,24.67,0,0,1-4,0,5.43,5.43,0,0,1-1.25-.24,1.45,1.45,0,0,1-.67-.41.88.88,0,0,1-.2-.57V408.84a1,1,0,0,1,.17-.57,1.11,1.11,0,0,1,.58-.41,4.44,4.44,0,0,1,1.09-.24,13.05,13.05,0,0,1,1.68-.09,13.69,13.69,0,0,1,1.73.09,3.79,3.79,0,0,1,1.06.24,1.14,1.14,0,0,1,.53.41,1,1,0,0,1,.17.57v3.61a22.34,22.34,0,0,1,2.15-2.68,11.62,11.62,0,0,1,1.92-1.68,6,6,0,0,1,1.82-.86,6.78,6.78,0,0,1,1.83-.25c.28,0,.58,0,.91,0a10,10,0,0,1,1,.16,9.42,9.42,0,0,1,.91.26,1.83,1.83,0,0,1,.57.31,1,1,0,0,1,.26.36,3.85,3.85,0,0,1,.15.54,8.68,8.68,0,0,1,.09,1C896.58,410.14,896.59,410.76,896.59,411.54Z" />
                        <path class="cls-2"
                            d="M930.2,423.07a22.3,22.3,0,0,1-1,6.78,14.26,14.26,0,0,1-3,5.27,13.19,13.19,0,0,1-5,3.42,18.81,18.81,0,0,1-7,1.21,19.1,19.1,0,0,1-6.74-1.08,12,12,0,0,1-4.75-3.12A13,13,0,0,1,900,430.5a23.8,23.8,0,0,1-.91-6.84,21.75,21.75,0,0,1,1-6.79,14.18,14.18,0,0,1,3-5.28,13.19,13.19,0,0,1,5-3.4,18.47,18.47,0,0,1,7-1.21,19.4,19.4,0,0,1,6.77,1.06,11.78,11.78,0,0,1,4.74,3.11,13,13,0,0,1,2.79,5.05A23.57,23.57,0,0,1,930.2,423.07Zm-8.44.33a21.1,21.1,0,0,0-.34-4,9.35,9.35,0,0,0-1.15-3.14,5.88,5.88,0,0,0-2.17-2.09,7,7,0,0,0-3.4-.75,7.32,7.32,0,0,0-3.2.67,5.77,5.77,0,0,0-2.24,1.95,9.22,9.22,0,0,0-1.32,3.1,17.64,17.64,0,0,0-.44,4.12,20.37,20.37,0,0,0,.36,4A9.89,9.89,0,0,0,909,430.4a5.54,5.54,0,0,0,2.17,2.07,7.09,7.09,0,0,0,3.39.73,7.21,7.21,0,0,0,3.22-.67,5.76,5.76,0,0,0,2.25-1.94,9,9,0,0,0,1.3-3.07A18.33,18.33,0,0,0,921.76,423.4Z" />
                        <path class="cls-2"
                            d="M954.2,397.76c0,.63,0,1.14-.06,1.52a3.11,3.11,0,0,1-.2.88.94.94,0,0,1-.29.42.59.59,0,0,1-.36.11,1.23,1.23,0,0,1-.5-.11,6,6,0,0,0-.69-.24,9.36,9.36,0,0,0-1-.25,7,7,0,0,0-1.3-.11,3.81,3.81,0,0,0-1.51.27,2.51,2.51,0,0,0-1.06.88,4.1,4.1,0,0,0-.62,1.57,12.08,12.08,0,0,0-.2,2.36v2.67h5.31a.93.93,0,0,1,.54.16,1.24,1.24,0,0,1,.41.54,3.64,3.64,0,0,1,.24,1,14,14,0,0,1,.08,1.59,7.33,7.33,0,0,1-.32,2.56,1,1,0,0,1-1,.76h-5.31v23.52a.87.87,0,0,1-.19.57,1.49,1.49,0,0,1-.65.41,5.41,5.41,0,0,1-1.27.24,19,19,0,0,1-2,.08,18.34,18.34,0,0,1-2-.08,5.52,5.52,0,0,1-1.27-.24,1.32,1.32,0,0,1-.65-.41.92.92,0,0,1-.18-.57V414.37h-3.65c-.41,0-.72-.25-.93-.76a7.38,7.38,0,0,1-.31-2.56,14,14,0,0,1,.08-1.59,4.56,4.56,0,0,1,.23-1,1.15,1.15,0,0,1,.39-.54,1,1,0,0,1,.57-.16h3.62v-2.44a20.65,20.65,0,0,1,.58-5.2,9.44,9.44,0,0,1,1.84-3.71,7.75,7.75,0,0,1,3.2-2.23,12.61,12.61,0,0,1,4.57-.75,13.26,13.26,0,0,1,2.41.21,10.1,10.1,0,0,1,1.79.46,2.76,2.76,0,0,1,.88.45,1.6,1.6,0,0,1,.38.62,4.22,4.22,0,0,1,.21,1C954.18,396.61,954.2,397.13,954.2,397.76Z" />
                        <path class="cls-2"
                            d="M968.35,399c0,1.65-.33,2.79-1,3.42s-1.92.95-3.74.95-3.09-.31-3.73-.92a4.44,4.44,0,0,1-1-3.29,4.7,4.7,0,0,1,1-3.43c.66-.64,1.92-1,3.76-1s3.07.31,3.72.93A4.46,4.46,0,0,1,968.35,399Zm-.62,38.89a.87.87,0,0,1-.19.57,1.45,1.45,0,0,1-.67.41,5.43,5.43,0,0,1-1.25.24,24.79,24.79,0,0,1-4,0,5.43,5.43,0,0,1-1.25-.24,1.51,1.51,0,0,1-.67-.41.87.87,0,0,1-.19-.57v-29a.89.89,0,0,1,.19-.57,1.61,1.61,0,0,1,.67-.42,5.72,5.72,0,0,1,1.25-.28,19.85,19.85,0,0,1,4,0,5.72,5.72,0,0,1,1.25.28,1.55,1.55,0,0,1,.67.42.89.89,0,0,1,.19.57Z" />
                        <path class="cls-2"
                            d="M993.11,435a10.19,10.19,0,0,1-.18,2.2,2.49,2.49,0,0,1-.47,1.08,2.72,2.72,0,0,1-.87.55,7.46,7.46,0,0,1-1.33.42,13,13,0,0,1-1.66.28,15.56,15.56,0,0,1-1.81.1,13.12,13.12,0,0,1-4.24-.62,7,7,0,0,1-3-1.91,7.87,7.87,0,0,1-1.73-3.24,17,17,0,0,1-.55-4.62V414.37h-3.48c-.42,0-.73-.25-1-.76a7.1,7.1,0,0,1-.32-2.56,12,12,0,0,1,.08-1.59,3.64,3.64,0,0,1,.24-1,1.24,1.24,0,0,1,.41-.54,1,1,0,0,1,.57-.16h3.45v-6.48a1,1,0,0,1,.18-.59,1.4,1.4,0,0,1,.65-.44,5.5,5.5,0,0,1,1.27-.26c.53,0,1.19-.08,2-.08s1.47,0,2,.08a5.19,5.19,0,0,1,1.25.26,1.51,1.51,0,0,1,.65.44,1,1,0,0,1,.2.59v6.48h6.31a1,1,0,0,1,.57.16,1.17,1.17,0,0,1,.41.54,4,4,0,0,1,.25,1,14,14,0,0,1,.08,1.59,7,7,0,0,1-.33,2.56,1,1,0,0,1-.94.76h-6.35V428a6.79,6.79,0,0,0,.74,3.57,2.92,2.92,0,0,0,2.68,1.19,5.26,5.26,0,0,0,1.17-.12,6.51,6.51,0,0,0,.93-.26c.27-.1.5-.18.68-.26a1.42,1.42,0,0,1,.51-.11.72.72,0,0,1,.37.11.81.81,0,0,1,.28.46q.09.34.18.93A12,12,0,0,1,993.11,435Z" />
                        <path class="cls-3"
                            d="M229.05,199.64a60.12,60.12,0,0,1-3.74,21.71A56.23,56.23,0,0,1,215,238.55a64.45,64.45,0,0,1-15.76,12.85,97.13,97.13,0,0,1-20.2,8.86,137.38,137.38,0,0,1-23.54,5.12A212.57,212.57,0,0,1,127.59,267H59.82a17.48,17.48,0,0,1-10.94-3.39q-4.43-3.39-4.43-11V56.68q0-7.65,4.43-11a17.54,17.54,0,0,1,10.94-3.38h64q23.44,0,39.7,3.47t27.38,10.51a48.59,48.59,0,0,1,17,17.81q5.91,10.77,5.91,25.36a48.88,48.88,0,0,1-2.36,15.37,43.93,43.93,0,0,1-6.9,13.12,48.27,48.27,0,0,1-11.13,10.42,59.06,59.06,0,0,1-15.07,7.29,74,74,0,0,1,20,6.08,56.1,56.1,0,0,1,16,11.21A51,51,0,0,1,225.11,179,52,52,0,0,1,229.05,199.64Zm-67-94.67a29.88,29.88,0,0,0-2.37-12.16,22.21,22.21,0,0,0-7.09-9,34.25,34.25,0,0,0-11.92-5.47q-7.19-1.9-19.21-1.91H95.28v58.36h29q11.24,0,17.93-2.34a31.57,31.57,0,0,0,11.13-6.43,25.7,25.7,0,0,0,6.6-9.55A31,31,0,0,0,162.07,105Zm13.2,96.23a32,32,0,0,0-3-14,27.29,27.29,0,0,0-8.66-10.34,42.4,42.4,0,0,0-14.58-6.43q-8.88-2.25-23.06-2.25H95.28v63.92h37.43a70.64,70.64,0,0,0,18.23-2,39.18,39.18,0,0,0,12.8-5.9,27.76,27.76,0,0,0,8.47-9.73A28.13,28.13,0,0,0,175.27,201.2Z" />
                        <path class="cls-4"
                            d="M431.62,233c0,2.9-.09,5.36-.29,7.38a31.27,31.27,0,0,1-.89,5.21,13.8,13.8,0,0,1-1.57,3.74,18.78,18.78,0,0,1-3.16,3.56q-2.16,2-8.37,5.12a105.81,105.81,0,0,1-15.17,6,146,146,0,0,1-20.49,4.77,151.86,151.86,0,0,1-24.92,1.91q-26.2,0-47.29-7.12a94.91,94.91,0,0,1-35.85-21.28Q258.83,228.12,251,206.93t-7.88-49.33q0-28.66,8.67-50.9T276,69.36a102.44,102.44,0,0,1,37.33-22.93q21.78-7.82,48-7.82a130.93,130.93,0,0,1,20.49,1.56A139.78,139.78,0,0,1,400,44.26a99,99,0,0,1,15.07,5.81,46.1,46.1,0,0,1,9.36,5.65,20.12,20.12,0,0,1,3.65,3.91,13.49,13.49,0,0,1,1.57,4,39.33,39.33,0,0,1,.89,5.74q.3,3.3.3,8.16a84.78,84.78,0,0,1-.4,8.86,20.42,20.42,0,0,1-1.38,5.91,8.17,8.17,0,0,1-2.36,3.3,5.12,5.12,0,0,1-3.15,1q-3,0-7.49-3a126.32,126.32,0,0,0-11.72-6.78A103.58,103.58,0,0,0,387.2,80a82.06,82.06,0,0,0-23.74-3,64.16,64.16,0,0,0-27.09,5.47,56.58,56.58,0,0,0-20.3,15.63,69.58,69.58,0,0,0-12.7,24.59A112.69,112.69,0,0,0,299,155.17q0,19.8,4.63,34.3t13.2,23.89a53.09,53.09,0,0,0,20.69,14A76.34,76.34,0,0,0,364.84,232a87.46,87.46,0,0,0,23.83-2.87,107.43,107.43,0,0,0,17.24-6.34q7.2-3.47,11.82-6.25t7.2-2.78a6.23,6.23,0,0,1,3.15.69,5.25,5.25,0,0,1,2,2.78,24.51,24.51,0,0,1,1.18,5.82Q431.62,226.74,431.62,233Z" />
                        <path class="cls-5"
                            d="M642.66,261.13a6.13,6.13,0,0,1-.78,3.21c-.53.87-1.78,1.6-3.75,2.17a41.51,41.51,0,0,1-8.66,1.22c-3.82.23-9,.35-15.57.35q-8.28,0-13.2-.35a33,33,0,0,1-7.78-1.3,8.56,8.56,0,0,1-4-2.43,13,13,0,0,1-2-3.57l-22.86-50.2q-4.12-8.5-8.07-15.11a48.69,48.69,0,0,0-8.77-11,32.65,32.65,0,0,0-11.13-6.69,43.31,43.31,0,0,0-14.58-2.26H505.34v85.64a4.48,4.48,0,0,1-1.28,3.13,9.18,9.18,0,0,1-4.23,2.26,46.44,46.44,0,0,1-7.88,1.39q-4.93.51-12.61.52c-5,0-9.16-.18-12.51-.52a46.58,46.58,0,0,1-8-1.39,8.51,8.51,0,0,1-4.14-2.26,4.7,4.7,0,0,1-1.18-3.13V56.68q0-7.65,4.43-11a17.53,17.53,0,0,1,10.93-3.38h66q10,0,16.55.35t11.82.86A119.62,119.62,0,0,1,591,50.07a67.65,67.65,0,0,1,20.88,12.25,50.83,50.83,0,0,1,13.1,17.89,58.57,58.57,0,0,1,4.54,23.71,61.93,61.93,0,0,1-3.26,20.59,50.79,50.79,0,0,1-9.55,16.59,60.68,60.68,0,0,1-15.57,12.68A89.3,89.3,0,0,1,580,162.46a61.42,61.42,0,0,1,10.74,5.91,54.09,54.09,0,0,1,9.46,8.42,82,82,0,0,1,8.37,11.3,135.91,135.91,0,0,1,7.68,14.33l21.48,44.29q3,6.6,3.94,9.64A16.88,16.88,0,0,1,642.66,261.13ZM575.88,108.61q0-11.11-5.72-18.76T551.45,79.08a83.62,83.62,0,0,0-9-1.39q-5-.51-13.89-.52H505.34v63.75h26.4a71.3,71.3,0,0,0,19.31-2.34,40.41,40.41,0,0,0,13.79-6.6,27.46,27.46,0,0,0,8.28-10.16A31,31,0,0,0,575.88,108.61Z" />
                        <path class="cls-6"
                            d="M130.16,405.21c0,1.74,0,3.21-.16,4.43a20.73,20.73,0,0,1-.47,3.12,8.3,8.3,0,0,1-.83,2.23,11,11,0,0,1-1.66,2.14,21.28,21.28,0,0,1-4.43,3.07,52,52,0,0,1-8,3.59,70.12,70.12,0,0,1-10.82,2.86,71.59,71.59,0,0,1-13.17,1.15,69.44,69.44,0,0,1-25-4.27,49.33,49.33,0,0,1-18.94-12.75,56.76,56.76,0,0,1-12-21.18Q30.55,376.91,30.56,360q0-17.18,4.58-30.49a63.53,63.53,0,0,1,12.8-22.38,53.71,53.71,0,0,1,19.72-13.74A66.62,66.62,0,0,1,93,288.75a60.54,60.54,0,0,1,10.83.94,66.2,66.2,0,0,1,9.62,2.44,48.5,48.5,0,0,1,8,3.49,24.11,24.11,0,0,1,4.94,3.38,11.48,11.48,0,0,1,1.92,2.34,8.8,8.8,0,0,1,.84,2.4,27.14,27.14,0,0,1,.47,3.43q.15,2,.15,4.89,0,3.12-.21,5.31a14,14,0,0,1-.72,3.54,5,5,0,0,1-1.25,2,2.52,2.52,0,0,1-1.67.62,7.14,7.14,0,0,1-4-1.82,64.68,64.68,0,0,0-6.2-4.06,50.92,50.92,0,0,0-9-4.06,38.59,38.59,0,0,0-12.54-1.82,29.63,29.63,0,0,0-25,12.65,44,44,0,0,0-6.72,14.72,85.67,85.67,0,0,0,.16,40,39.85,39.85,0,0,0,7,14.31,28.2,28.2,0,0,0,10.93,8.38,36.07,36.07,0,0,0,14.42,2.76,41.24,41.24,0,0,0,12.59-1.72,52.66,52.66,0,0,0,9.11-3.8q3.8-2.08,6.24-3.75a7.73,7.73,0,0,1,3.8-1.66,3,3,0,0,1,1.66.41,3.16,3.16,0,0,1,1.05,1.67,17,17,0,0,1,.62,3.49Q130.16,401.47,130.16,405.21Z" />
                        <path class="cls-7"
                            d="M235.75,374.72a70.92,70.92,0,0,1-3.12,21.64,45.57,45.57,0,0,1-9.47,16.86,42,42,0,0,1-15.93,10.93A59.64,59.64,0,0,1,184.86,428a61.33,61.33,0,0,1-21.55-3.43,38.76,38.76,0,0,1-15.19-10,41,41,0,0,1-9-16.13,74.88,74.88,0,0,1-2.92-21.86,70.26,70.26,0,0,1,3.18-21.7A45.6,45.6,0,0,1,149,338a42.52,42.52,0,0,1,15.87-10.88,59.48,59.48,0,0,1,22.33-3.85,62.31,62.31,0,0,1,21.64,3.39,37.71,37.71,0,0,1,15.15,9.94,41.44,41.44,0,0,1,8.9,16.13A75.56,75.56,0,0,1,235.75,374.72Zm-27,1a68.07,68.07,0,0,0-1.09-12.65,29.82,29.82,0,0,0-3.69-10,18.5,18.5,0,0,0-6.92-6.66,22.2,22.2,0,0,0-10.88-2.4,23,23,0,0,0-10.2,2.14,18.28,18.28,0,0,0-7.18,6.24,30,30,0,0,0-4.22,9.89,56.3,56.3,0,0,0-1.4,13.17,65.41,65.41,0,0,0,1.14,12.64,31.4,31.4,0,0,0,3.7,10,17.59,17.59,0,0,0,6.92,6.61,22.7,22.7,0,0,0,10.82,2.34A23.31,23.31,0,0,0,196.1,405a18.48,18.48,0,0,0,7.18-6.19,28.64,28.64,0,0,0,4.16-9.84A58.09,58.09,0,0,0,208.79,375.76Z" />
                        <path class="cls-8"
                            d="M397.75,422.07a2.85,2.85,0,0,1-.62,1.82,4.54,4.54,0,0,1-2.08,1.3,17.33,17.33,0,0,1-4,.78,61.36,61.36,0,0,1-6.35.26,62.83,62.83,0,0,1-6.45-.26,18.32,18.32,0,0,1-4-.78,4.19,4.19,0,0,1-2.08-1.3,3,3,0,0,1-.57-1.82V367a38.16,38.16,0,0,0-.89-8.54,20.11,20.11,0,0,0-2.7-6.61,12.85,12.85,0,0,0-4.58-4.26,13.54,13.54,0,0,0-6.61-1.51,15.65,15.65,0,0,0-9.47,3.64A63.74,63.74,0,0,0,337,360.35v61.72a2.85,2.85,0,0,1-.62,1.82,4.56,4.56,0,0,1-2.14,1.3,18.1,18.1,0,0,1-4,.78,60.3,60.3,0,0,1-6.25.26,61.49,61.49,0,0,1-6.35-.26,18.1,18.1,0,0,1-4-.78,4.56,4.56,0,0,1-2.14-1.3,2.85,2.85,0,0,1-.62-1.82V367a38.16,38.16,0,0,0-.89-8.54,20.74,20.74,0,0,0-2.65-6.61,12.3,12.3,0,0,0-4.58-4.26,13.61,13.61,0,0,0-6.56-1.51,15.75,15.75,0,0,0-9.57,3.64,61,61,0,0,0-10.31,10.61v61.72a2.79,2.79,0,0,1-.62,1.82,4.58,4.58,0,0,1-2.13,1.3,18.32,18.32,0,0,1-4,.78,77.67,77.67,0,0,1-12.7,0,18.1,18.1,0,0,1-4-.78,4.56,4.56,0,0,1-2.14-1.3,2.85,2.85,0,0,1-.62-1.82V329.24a3.2,3.2,0,0,1,.52-1.83,3.8,3.8,0,0,1,1.87-1.3,15.71,15.71,0,0,1,3.49-.78,46.35,46.35,0,0,1,5.36-.26,48.72,48.72,0,0,1,5.51.26,13.1,13.1,0,0,1,3.39.78,3.82,3.82,0,0,1,1.71,1.3,3.2,3.2,0,0,1,.52,1.83V340a61.41,61.41,0,0,1,15.36-12.49,32.91,32.91,0,0,1,16-4.17,40.63,40.63,0,0,1,10.3,1.2,29.37,29.37,0,0,1,8.17,3.43,25.88,25.88,0,0,1,6.2,5.36,31.49,31.49,0,0,1,4.37,7,78.42,78.42,0,0,1,8.17-7.7,48,48,0,0,1,7.91-5.26,36.34,36.34,0,0,1,7.8-3,32.35,32.35,0,0,1,8-1q9.25,0,15.61,3.13a27.37,27.37,0,0,1,10.25,8.48,34.12,34.12,0,0,1,5.57,12.54,67.1,67.1,0,0,1,1.66,15.19Z" />
                        <path class="cls-9"
                            d="M510.53,374.3a86.6,86.6,0,0,1-2.66,22.33,50.42,50.42,0,0,1-7.75,16.91,34.44,34.44,0,0,1-12.7,10.72A38.89,38.89,0,0,1,470,428a33.06,33.06,0,0,1-7.44-.78,28.41,28.41,0,0,1-6.56-2.39,39.66,39.66,0,0,1-6.29-4,72.42,72.42,0,0,1-6.46-5.62v43.72a3.09,3.09,0,0,1-.62,1.87,4.71,4.71,0,0,1-2.14,1.4,17.93,17.93,0,0,1-4,.89,65.19,65.19,0,0,1-12.7,0,18,18,0,0,1-4-.89,4.73,4.73,0,0,1-2.13-1.4,3,3,0,0,1-.63-1.87V329.24a3.27,3.27,0,0,1,.52-1.83,3.86,3.86,0,0,1,1.83-1.3,14.6,14.6,0,0,1,3.43-.78,46.35,46.35,0,0,1,5.36-.26,45.45,45.45,0,0,1,5.26.26,14.72,14.72,0,0,1,3.43.78,3.82,3.82,0,0,1,1.82,1.3,3.2,3.2,0,0,1,.52,1.83v10.92a94.92,94.92,0,0,1,8-7.33,48,48,0,0,1,8-5.31,36.4,36.4,0,0,1,8.37-3.18,39.46,39.46,0,0,1,9.22-1q10.19,0,17.38,4a32.82,32.82,0,0,1,11.7,11,49.23,49.23,0,0,1,6.61,16.24A89.8,89.8,0,0,1,510.53,374.3Zm-27.27,1.87a71.14,71.14,0,0,0-.89-11.39,33.43,33.43,0,0,0-3-9.73,18.42,18.42,0,0,0-5.62-6.82,14.32,14.32,0,0,0-8.69-2.55,17.53,17.53,0,0,0-5.15.78,20,20,0,0,0-5.2,2.55,37,37,0,0,0-5.47,4.58,65.74,65.74,0,0,0-5.93,7v30.6a61.12,61.12,0,0,0,10.51,10.77,16.93,16.93,0,0,0,10.41,3.8,14.43,14.43,0,0,0,8.69-2.6,20.06,20.06,0,0,0,5.88-6.82,33.92,33.92,0,0,0,3.38-9.52A52.47,52.47,0,0,0,483.26,376.17Z" />
                        <path class="cls-10"
                            d="M551.28,422.07a2.8,2.8,0,0,1-.63,1.82,4.52,4.52,0,0,1-2.13,1.3,18.2,18.2,0,0,1-4,.78,77.55,77.55,0,0,1-12.69,0,18.08,18.08,0,0,1-4-.78,4.56,4.56,0,0,1-2.14-1.3,2.85,2.85,0,0,1-.62-1.82V285.21a3.07,3.07,0,0,1,.62-1.87,4.64,4.64,0,0,1,2.14-1.41,18,18,0,0,1,4-.88,65.09,65.09,0,0,1,12.69,0,18.1,18.1,0,0,1,4,.88,4.6,4.6,0,0,1,2.13,1.41,3,3,0,0,1,.63,1.87Z" />
                        <path class="cls-11"
                            d="M624.81,425.61,613.57,458.5q-.93,2.6-5.1,3.75a64.23,64.23,0,0,1-18.84.78,9.47,9.47,0,0,1-3.74-1.2,2.77,2.77,0,0,1-1.36-2.08,6.8,6.8,0,0,1,.63-3l12.38-31.12a7.2,7.2,0,0,1-2.44-1.92,8.85,8.85,0,0,1-1.61-2.76l-32-85.35a17.6,17.6,0,0,1-1.35-5.56,3.81,3.81,0,0,1,1.25-3,8.21,8.21,0,0,1,4.22-1.51,58.3,58.3,0,0,1,7.85-.42c3,0,5.34.05,7.08.16a12.35,12.35,0,0,1,4.06.78,4.42,4.42,0,0,1,2.18,1.92,18.77,18.77,0,0,1,1.46,3.7l21.86,62.13h.31l20-63.38a7.1,7.1,0,0,1,1.62-3.59,6.74,6.74,0,0,1,3.28-1.3,51.25,51.25,0,0,1,8-.42,54.63,54.63,0,0,1,7.44.42,9,9,0,0,1,4.37,1.56,3.75,3.75,0,0,1,1.41,3.07,15.07,15.07,0,0,1-.84,4.53Z" />
                        <path class="cls-12"
                            d="M964.22,92.3V83.74h-8.39v4.19h-16L929,101.79h5v23.07l-12.6,10.92V114h8.4L916.38,97.17V84.58H902.11v6.71h-26L858.46,114h8.4v68.83l-13.43,11.71V52.68L787.59,82.06v37.27H758.13v33.5H718.64V164h8.88v38.12l-4.2,7.55,36.94,64.63L808.1,264.2,966.35,127.38l3.75-28.54ZM746.83,207.12H733.4V193.69h13.43Zm0-21.82H733.4V171.87h13.43Zm19.3,21.82H752.7V193.69h13.43Zm0-21.82H752.7V171.87h13.43Zm18.47,26.86h-9.9V130.74h9.9Zm31.23-3.55H795.51V188.29h20.32Zm0-33H795.51V155.28h20.32Zm0-31.62H795.51V123.66h20.32Zm0-33H795.51V90.64h20.32ZM845,208.61H824.71V188.29H845Zm0-33H824.71V155.28H845ZM845,144H824.71V123.66H845Zm0-33H824.71V90.64H845Zm56.24,69.3H888V132.42h13.25Z" />
                        <path class="cls-13"
                            d="M703.31,198.3a3.58,3.58,0,0,1,.14-.54c1.59-5.13,9.89-3.81,13.39-2.12,11.38,5.48,21.75,13.88,31.41,21.89a261.14,261.14,0,0,1,22.24,20.61c5.66,6,10.78,11.14,19.8,8.84,6.14-1.57,11.2-5.85,15.66-10.35,42.67-43.13,90.25-82.91,137.82-120.54,36.09-28.54,75.11-60.33,118.77-76.48,0,0,11.37-3.14,12.72,1.13s-8.38,2.17-39.2,30.44c-2,1.88-4.13,3.75-6.2,5.61l-7.51,6.69q-4.36,3.9-8.72,7.81-5,4.48-9.91,9-5.55,5.1-11,10.27-6.11,5.76-12.13,11.61-6.63,6.45-13.17,13-7.14,7.17-14.17,14.47-7.63,7.94-15.12,16-8.1,8.73-16,17.62-8.53,9.57-16.9,19.29-9,10.44-17.72,21-9.36,11.34-18.5,22.86-9.74,12.27-19.23,24.73-10.1,13.25-19.92,26.68-10.42,14.25-20.57,28.7c-2,2.85-4,5.7-6,8.56-3,4.3-5.11,8.62-10.5,10.18a11.21,11.21,0,0,1-11.14-2.66c-14.12-13.56-24.71-33.3-34.84-49.78-17.54-28.53-30.93-57.86-42.66-89.11A10.11,10.11,0,0,1,703.31,198.3Z" />
                        <ellipse class="cls-14" cx="790.05" cy="352.33" rx="39.87" ry="7.55" />
                    </svg> --}}

                    <svg class="pl-4 pr-4 pt-2 pb-2" id="Layer_1" data-name="Layer 1" viewBox="0 0 286 141" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1646_16736)">
                        <path d="M113.73 23.4302V19.7002H110.08V21.5302H103.08L98.3305 27.5302H100.52V37.5802L95.0305 42.3302V32.9002H98.7305L92.8805 25.5802V20.1002H86.6605V23.0202H75.3205L67.6405 32.9002H71.3005V62.9002L65.4505 68.0002V6.18018L36.7305 18.9702V35.2102H23.9405V49.8002H6.73047V54.6602H10.6005V71.2602L8.73047 74.5502L24.8205 102.7L45.7305 98.3202L114.67 38.7202L116.3 26.2902L113.73 23.4302ZM19.0305 73.4302H13.1805V67.6002H19.0305V73.4302ZM19.0305 63.9302H13.1805V58.1002H19.0305V63.9302ZM27.4405 73.4302H21.5905V67.6002H27.4405V73.4302ZM27.4405 63.9302H21.5905V58.1002H27.4405V63.9302ZM35.4905 75.6302H31.1705V40.1802H35.4905V75.6302ZM49.0905 74.0802H40.2405V65.2302H49.0905V74.0802ZM49.0905 59.7002H40.2405V50.9002H49.0905V59.7002ZM49.0905 45.9302H40.2405V37.0702H49.0905V45.9302ZM49.0905 31.5502H40.2405V22.6902H49.0905V31.5502ZM61.8105 74.0802H52.9605V65.2302H61.8105V74.0802ZM61.8105 59.7002H52.9605V50.9002H61.8105V59.7002ZM61.8105 45.9302H52.9605V37.0702H61.8105V45.9302ZM61.8105 31.5502H52.9605V22.6902H61.8105V31.5502ZM86.3105 61.7302H80.5405V40.9002H86.3105V61.7302Z" fill="url(#paint0_linear_1646_16736)"/>
                        <path d="M0.0503962 69.6098C0.069098 69.5286 0.0924698 69.4484 0.120396 69.3698C0.810396 67.1398 4.4204 67.7198 5.9504 68.4498C10.9504 70.8398 15.4304 74.4998 19.6304 77.9898C23.036 80.795 26.2717 83.8003 29.3204 86.9898C31.7804 89.5798 34.0104 91.8398 37.9504 90.8298C40.6204 90.1498 42.8304 88.2898 44.7704 86.3298C63.3504 67.5398 84.0804 50.2098 104.77 33.8198C120.49 21.3898 137.49 7.53985 156.51 0.499848C156.51 0.499848 161.46 -0.860162 162.05 0.989838C162.64 2.83984 158.4 1.98985 144.98 14.2498C144.08 15.0798 143.18 15.8898 142.27 16.6998L139 19.6098L135.2 23.0198L130.92 26.8998C129.31 28.3798 127.7 29.8998 126.11 31.3798C124.34 33.0498 122.58 34.7398 120.83 36.4298C118.897 38.3098 116.984 40.1998 115.09 42.0998C113.017 44.1798 110.96 46.2832 108.92 48.4098C106.7 50.7098 104.504 53.0432 102.33 55.4098C99.9771 57.9498 97.6437 60.5098 95.3304 63.0898C92.8504 65.8698 90.3937 68.6698 87.9604 71.4898C85.3604 74.5165 82.7871 77.5732 80.2404 80.6599C77.5271 83.9532 74.8437 87.2698 72.1904 90.6098C69.3637 94.1765 66.5704 97.7698 63.8104 101.39C60.8771 105.23 57.9837 109.103 55.1304 113.01C52.1037 117.15 49.1037 121.316 46.1304 125.51L43.5304 129.24C42.2304 131.11 41.3004 132.99 38.9604 133.67C38.1218 133.934 37.2276 133.966 36.3721 133.764C35.5167 133.561 34.7318 133.131 34.1004 132.52C27.9504 126.61 23.3404 118.01 18.9304 110.83C11.4876 98.5243 5.26156 85.5229 0.340397 72.0098C0.0271279 71.2511 -0.073142 70.4213 0.0503962 69.6098Z" fill="url(#paint1_linear_1646_16736)"/>
                        <path opacity="0.5" d="M37.8397 140C47.4329 140 55.2097 138.527 55.2097 136.71C55.2097 134.893 47.4329 133.42 37.8397 133.42C28.2465 133.42 20.4697 134.893 20.4697 136.71C20.4697 138.527 28.2465 140 37.8397 140Z" fill="url(#paint2_radial_1646_16736)"/>
                        <path d="M171.19 53.4099V53.5599C176.9 54.5599 181.77 58.3599 181.77 66.5599C181.77 78.1299 174.38 82.6199 163.12 82.6199H135.93V28.1299H162.35C173.7 28.1299 179.64 32.5499 179.64 41.8399C179.64 48.5399 175.73 51.8999 171.19 53.4099ZM159.08 50.1399C162.89 50.1399 165.93 49.2199 165.93 44.7299C165.93 40.2399 162.93 39.3199 159.08 39.3199H149.64V50.1399H159.08ZM149.64 71.3799H159.46C165.17 71.3799 168.07 70.0099 168.07 64.9099C168.07 59.8099 165.17 58.5099 159.46 58.5099H149.64V71.3799Z" fill="#09A0DC"/>
                        <path d="M210.63 38.1099C201.57 38.1099 198.52 45.1099 198.52 55.3099C198.52 65.5099 201.52 72.5999 210.63 72.5999C217.94 72.5999 220.68 68.2599 221.63 62.1699H235.34C234.12 74.9599 226.2 83.7899 211.28 83.7899C194.07 83.7899 184.86 71.7899 184.86 55.3099C184.86 38.8299 194.03 26.8999 211.24 26.8999C226.09 26.8999 234 35.7399 235.3 48.3799H221.59C220.6 42.4499 217.86 38.1099 210.63 38.1099Z" fill="#09A0DC"/>
                        <path d="M240.1 28.1299H265.73C277.83 28.1299 285.14 33.6899 285.14 43.9699C285.14 51.1999 280.88 55.7699 274.14 57.2899V57.4499C287.77 59.8099 282.82 80.8999 285.95 81.8099V82.5699H271.73C269.06 80.2899 274.01 63.5699 262.36 63.5699H253.83V82.5699H240.13L240.1 28.1299ZM253.8 52.4199H263.09C268.58 52.4199 271.47 50.4199 271.47 45.8699C271.47 41.3199 268.58 39.3199 263.09 39.3199H253.8V52.4199Z" fill="#09A0DC"/>
                        <path d="M277.58 93.5098H143.84C141.007 93.5098 138.71 95.8065 138.71 98.6398V135.07C138.71 137.903 141.007 140.2 143.84 140.2H277.58C280.413 140.2 282.71 137.903 282.71 135.07V98.6398C282.71 95.8065 280.413 93.5098 277.58 93.5098Z" fill="#09A0DC"/>
                        <path d="M149.16 101.9H158.59C160.358 101.837 162.116 102.179 163.73 102.9C165.11 103.561 166.245 104.643 166.97 105.99C167.753 107.538 168.134 109.257 168.08 110.99C168.112 112.389 167.885 113.783 167.41 115.1C166.998 116.203 166.342 117.197 165.49 118.01C164.622 118.809 163.602 119.425 162.49 119.82L160.8 120.77H153V116.13H158.48C159.277 116.159 160.064 115.951 160.74 115.53C161.35 115.119 161.82 114.533 162.09 113.85C162.404 113.068 162.557 112.232 162.54 111.39C162.559 110.499 162.421 109.612 162.13 108.77C161.896 108.092 161.451 107.507 160.86 107.1C160.181 106.686 159.395 106.484 158.6 106.52H154.73V132.16H149.15L149.16 101.9ZM163.11 132.21L157.43 118.64H163.28L169.06 131.92V132.21H163.11Z" fill="white"/>
                        <path d="M181.01 132.67C179.645 132.696 178.288 132.461 177.01 131.98C175.89 131.547 174.885 130.863 174.07 129.98C173.229 129.05 172.601 127.948 172.23 126.75C171.78 125.331 171.564 123.848 171.59 122.36V120.36C171.562 118.71 171.781 117.065 172.24 115.48C172.604 114.227 173.216 113.06 174.04 112.05C174.796 111.168 175.753 110.482 176.83 110.05C177.977 109.587 179.204 109.356 180.44 109.37C181.712 109.346 182.975 109.584 184.15 110.07C185.194 110.522 186.103 111.235 186.79 112.14C187.528 113.159 188.055 114.315 188.34 115.54C188.701 117.08 188.872 118.658 188.85 120.24V122.8H174V118.9H183.61V118.37C183.603 117.535 183.486 116.704 183.26 115.9C183.098 115.291 182.748 114.749 182.26 114.35C181.725 113.968 181.076 113.781 180.42 113.82C179.872 113.805 179.328 113.929 178.84 114.18C178.374 114.438 177.998 114.832 177.76 115.31C177.451 115.94 177.246 116.615 177.15 117.31C176.998 118.326 176.928 119.352 176.94 120.38V122.38C176.925 123.295 177.022 124.209 177.23 125.1C177.386 125.757 177.679 126.374 178.09 126.91C178.448 127.361 178.921 127.707 179.46 127.91C180.066 128.129 180.707 128.234 181.35 128.22C182.336 128.24 183.313 128.038 184.21 127.63C185.011 127.238 185.73 126.699 186.33 126.04L188.56 129.3C188.089 129.908 187.533 130.447 186.91 130.9C186.145 131.454 185.299 131.886 184.4 132.18C183.305 132.526 182.16 132.691 181.01 132.67Z" fill="white"/>
                        <path d="M201.95 109.73V113.79H190.73V109.73H201.95ZM193.52 104.19H198.83V125.67C198.812 126.181 198.879 126.691 199.03 127.18C199.134 127.492 199.357 127.751 199.65 127.9C199.967 128.033 200.307 128.098 200.65 128.09C200.929 128.093 201.207 128.069 201.48 128.02C201.677 127.994 201.87 127.954 202.06 127.9V132.15C201.075 132.513 200.031 132.69 198.98 132.67C197.996 132.689 197.022 132.469 196.14 132.03C195.292 131.569 194.623 130.837 194.24 129.95C193.735 128.749 193.5 127.452 193.55 126.15L193.52 104.19Z" fill="white"/>
                        <path d="M210.79 114.41V132.25H205.47V109.73H210.52L210.79 114.41ZM216.17 109.56L216.12 114.87C215.85 114.82 215.54 114.77 215.2 114.74C214.86 114.71 214.54 114.74 214.2 114.74C213.618 114.729 213.042 114.845 212.51 115.08C212.046 115.298 211.642 115.624 211.33 116.03C210.992 116.49 210.745 117.009 210.6 117.56C210.422 118.23 210.318 118.918 210.29 119.61L209.2 119.43C209.192 118.089 209.309 116.75 209.55 115.43C209.737 114.323 210.073 113.247 210.55 112.23C210.938 111.406 211.509 110.681 212.22 110.11C212.878 109.61 213.683 109.343 214.51 109.35C214.801 109.354 215.092 109.381 215.38 109.43C215.648 109.437 215.914 109.481 216.17 109.56Z" fill="white"/>
                        <path d="M217.93 121.82V120.18C217.906 118.596 218.126 117.018 218.58 115.5C218.954 114.255 219.576 113.098 220.41 112.1C221.185 111.199 222.157 110.487 223.25 110.02C225.623 109.077 228.267 109.077 230.64 110.02C231.734 110.49 232.709 111.201 233.49 112.1C234.33 113.093 234.954 114.252 235.32 115.5C235.771 117.018 235.986 118.597 235.96 120.18V121.82C235.988 123.397 235.772 124.969 235.32 126.48C234.952 127.731 234.329 128.892 233.49 129.89C232.712 130.793 231.737 131.504 230.64 131.97C228.279 132.903 225.651 132.903 223.29 131.97C222.193 131.505 221.215 130.797 220.43 129.9C219.588 128.901 218.959 127.741 218.58 126.49C218.123 124.976 217.904 123.401 217.93 121.82ZM223.28 120.18V121.82C223.27 122.773 223.354 123.724 223.53 124.66C223.663 125.364 223.913 126.04 224.27 126.66C224.556 127.145 224.958 127.55 225.44 127.84C225.909 128.097 226.436 128.228 226.97 128.22C227.527 128.231 228.077 128.1 228.57 127.84C229.052 127.56 229.447 127.152 229.71 126.66C230.053 126.038 230.286 125.362 230.4 124.66C230.563 123.723 230.64 122.772 230.63 121.82V120.18C230.64 119.237 230.553 118.295 230.37 117.37C230.237 116.667 229.987 115.991 229.63 115.37C229.348 114.881 228.949 114.469 228.47 114.17C228.002 113.901 227.47 113.762 226.93 113.77C226.402 113.76 225.882 113.899 225.43 114.17C224.953 114.471 224.555 114.883 224.27 115.37C223.913 115.991 223.663 116.667 223.53 117.37C223.355 118.296 223.271 119.238 223.28 120.18Z" fill="white"/>
                        <path d="M250.26 109.73V113.79H238.54V109.73H250.26ZM246.66 132.25H241.33V107.67C241.286 106.196 241.581 104.732 242.19 103.39C242.723 102.28 243.581 101.36 244.65 100.75C245.807 100.117 247.112 99.8032 248.43 99.8398C248.872 99.8408 249.314 99.8776 249.75 99.9498C250.17 100.017 250.584 100.114 250.99 100.24L250.9 104.55C250.684 104.471 250.459 104.421 250.23 104.4C249.954 104.385 249.677 104.385 249.4 104.4C248.881 104.386 248.368 104.517 247.92 104.78C247.498 105.051 247.17 105.446 246.98 105.91C246.748 106.481 246.639 107.094 246.66 107.71V132.25Z" fill="white"/>
                        <path d="M253.73 103.9C253.717 103.516 253.781 103.133 253.919 102.774C254.056 102.415 254.264 102.087 254.53 101.81C254.809 101.508 255.15 101.27 255.53 101.112C255.91 100.955 256.319 100.883 256.73 100.9C257.125 100.877 257.521 100.94 257.89 101.083C258.259 101.226 258.593 101.447 258.87 101.73C259.368 102.309 259.642 103.047 259.642 103.81C259.642 104.573 259.368 105.311 258.87 105.89C258.593 106.171 258.258 106.39 257.889 106.532C257.52 106.673 257.125 106.734 256.73 106.71C256.333 106.733 255.935 106.672 255.563 106.531C255.19 106.389 254.852 106.171 254.57 105.89C254.042 105.361 253.74 104.647 253.73 103.9ZM259.35 109.77V132.29H254.03V109.73L259.35 109.77Z" fill="white"/>
                        <path d="M273.73 109.73V113.79H262.46V109.73H273.73ZM265.3 104.19H270.6V125.67C270.579 126.182 270.65 126.693 270.81 127.18C270.914 127.492 271.137 127.751 271.43 127.9C271.746 128.034 272.087 128.099 272.43 128.09C272.712 128.093 272.993 128.069 273.27 128.02C273.466 127.993 273.66 127.953 273.85 127.9V132.15C273.417 132.307 272.972 132.43 272.52 132.52C271.943 132.628 271.357 132.678 270.77 132.67C269.786 132.689 268.811 132.469 267.93 132.03C267.081 131.566 266.41 130.835 266.02 129.95C265.518 128.748 265.286 127.451 265.34 126.15L265.3 104.19Z" fill="white"/>
                        </g>
                        <defs>
                        <linearGradient id="paint0_linear_1646_16736" x1="6.73047" y1="54.4402" x2="116.27" y2="54.4402" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#009DDC"/>
                        <stop offset="1" stop-color="#67B8E7"/>
                        </linearGradient>
                        <linearGradient id="paint1_linear_1646_16736" x1="0.000396344" y1="66.9398" x2="162.13" y2="66.9398" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E06C6D"/>
                        <stop offset="1" stop-color="#D5244C"/>
                        </linearGradient>
                        <radialGradient id="paint2_radial_1646_16736" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(37.6187 133.93) scale(16.4934 3.366)">
                        <stop/>
                        <stop offset="1" stop-opacity="0"/>
                        </radialGradient>
                        <clipPath id="clip0_1646_16736">
                        <rect width="285.93" height="140.2" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>

=======
<svg class="pl-2 pr-2 pt-2 pb-2" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1110 502"><defs><style>.cls-1{fill:#1a47a3;}.cls-2{fill:#fff;}.cls-3{fill:url(#linear-gradient);}.cls-4{fill:url(#linear-gradient-2);}.cls-5{fill:url(#linear-gradient-3);}.cls-6{fill:url(#linear-gradient-4);}.cls-7{fill:url(#linear-gradient-5);}.cls-8{fill:url(#linear-gradient-6);}.cls-9{fill:url(#linear-gradient-7);}.cls-10{fill:url(#linear-gradient-8);}.cls-11{fill:url(#linear-gradient-9);}.cls-12{fill:url(#linear-gradient-10);}.cls-13{fill:url(#linear-gradient-11);}.cls-14{opacity:0.5;fill:url(#radial-gradient);}</style><linearGradient id="linear-gradient" x1="136.75" y1="248.86" x2="136.75" y2="53.63" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#009ddc"/><stop offset="1" stop-color="#67b8e7"/></linearGradient><linearGradient id="linear-gradient-2" x1="337.35" y1="248.86" x2="337.35" y2="53.63" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-3" x1="548.1" y1="248.86" x2="548.1" y2="53.63" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-4" x1="80.36" y1="255.11" x2="80.36" y2="411.83" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e06c6d"/><stop offset="1" stop-color="#d5244c"/></linearGradient><linearGradient id="linear-gradient-5" x1="186" y1="255.11" x2="186" y2="411.83" xlink:href="#linear-gradient-4"/><linearGradient id="linear-gradient-6" x1="323.91" y1="255.11" x2="323.91" y2="411.83" xlink:href="#linear-gradient-4"/><linearGradient id="linear-gradient-7" x1="463.79" y1="255.11" x2="463.79" y2="411.83" xlink:href="#linear-gradient-4"/><linearGradient id="linear-gradient-8" x1="538.16" y1="255.11" x2="538.16" y2="411.83" xlink:href="#linear-gradient-4"/><linearGradient id="linear-gradient-9" x1="608.37" y1="255.11" x2="608.37" y2="411.83" xlink:href="#linear-gradient-4"/><linearGradient id="linear-gradient-10" x1="718.64" y1="163.48" x2="970.1" y2="163.48" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-11" x1="703.18" y1="192.17" x2="1075.38" y2="192.17" xlink:href="#linear-gradient-4"/><radialGradient id="radial-gradient" cx="790.05" cy="189.79" r="37.92" gradientTransform="translate(0 314.58) scale(1 0.2)" gradientUnits="userSpaceOnUse"><stop offset="0"/><stop offset="1" stop-opacity="0"/></radialGradient></defs><rect class="cls-1" x="702.75" y="371.65" width="373.19" height="89.85" rx="10.89"/><path class="cls-2" d="M816.85,437.89a1.21,1.21,0,0,1-.13.6,1,1,0,0,1-.62.41,6.32,6.32,0,0,1-1.43.23c-.63,0-1.49.06-2.57.06-.91,0-1.64,0-2.18-.06a5,5,0,0,1-1.29-.25,1.41,1.41,0,0,1-.67-.45,2.45,2.45,0,0,1-.32-.67l-3.78-9.41c-.46-1.07-.9-2-1.34-2.84a8.94,8.94,0,0,0-1.45-2.06,5.13,5.13,0,0,0-1.84-1.26,6.4,6.4,0,0,0-2.41-.42h-2.67v16.06a.9.9,0,0,1-.21.58,1.35,1.35,0,0,1-.7.42,7.1,7.1,0,0,1-1.3.27,24.08,24.08,0,0,1-4.16,0,7.19,7.19,0,0,1-1.32-.27,1.28,1.28,0,0,1-.68-.42.94.94,0,0,1-.19-.58V399.55a2.58,2.58,0,0,1,.73-2.06,2.64,2.64,0,0,1,1.81-.64H799c1.1,0,2,0,2.73.07s1.37.09,2,.16a17.57,17.57,0,0,1,4.57,1.24,11,11,0,0,1,3.46,2.29,9.7,9.7,0,0,1,2.16,3.36,12.23,12.23,0,0,1,.75,4.44,13,13,0,0,1-.54,3.86,9.52,9.52,0,0,1-1.58,3.11,10.11,10.11,0,0,1-2.57,2.38,13.61,13.61,0,0,1-3.48,1.63,9.32,9.32,0,0,1,3.33,2.69,15.74,15.74,0,0,1,1.39,2.11,28.47,28.47,0,0,1,1.27,2.69l3.55,8.31c.32.82.54,1.43.65,1.8A3.41,3.41,0,0,1,816.85,437.89Zm-11-28.6a6.21,6.21,0,0,0-.94-3.51,5.11,5.11,0,0,0-3.1-2,10.73,10.73,0,0,0-1.48-.26,19.57,19.57,0,0,0-2.3-.1h-3.84v12h4.37a10.55,10.55,0,0,0,3.19-.44,6.24,6.24,0,0,0,2.28-1.24,5.06,5.06,0,0,0,1.37-1.9A6.56,6.56,0,0,0,805.81,409.29Z"/><path class="cls-2" d="M848.51,422.52a3.13,3.13,0,0,1-.67,2.21,2.37,2.37,0,0,1-1.84.72H828.32a11.81,11.81,0,0,0,.44,3.37,6.35,6.35,0,0,0,1.4,2.57,5.94,5.94,0,0,0,2.47,1.61,10.59,10.59,0,0,0,3.64.56,20,20,0,0,0,3.77-.31,25.57,25.57,0,0,0,2.82-.68c.79-.25,1.45-.48,2-.69a3.6,3.6,0,0,1,1.27-.31.91.91,0,0,1,.49.12.85.85,0,0,1,.33.4,3.36,3.36,0,0,1,.18.83c0,.36,0,.81,0,1.36s0,.88,0,1.22a6.19,6.19,0,0,1-.1.86,2.12,2.12,0,0,1-.19.6,2.43,2.43,0,0,1-.34.47,3.77,3.77,0,0,1-1.16.62,18.23,18.23,0,0,1-2.41.77c-1,.25-2.1.46-3.35.65a28.58,28.58,0,0,1-4,.28,21.37,21.37,0,0,1-6.79-1,12.06,12.06,0,0,1-4.87-3,12.3,12.3,0,0,1-2.92-5,23.59,23.59,0,0,1-1-7.1,22.73,22.73,0,0,1,1-7,14.58,14.58,0,0,1,2.93-5.27,12.52,12.52,0,0,1,4.68-3.31,16,16,0,0,1,6.2-1.14,16.21,16.21,0,0,1,6.24,1.08,11.25,11.25,0,0,1,4.25,3,11.94,11.94,0,0,1,2.44,4.51,19.61,19.61,0,0,1,.78,5.66Zm-7.94-2.35a8.43,8.43,0,0,0-1.39-5.42,5.37,5.37,0,0,0-4.58-2,5.83,5.83,0,0,0-2.72.59,5.56,5.56,0,0,0-1.92,1.57,7.29,7.29,0,0,0-1.17,2.35,11.56,11.56,0,0,0-.47,2.88Z"/><path class="cls-2" d="M872,435a10.19,10.19,0,0,1-.18,2.2,2.49,2.49,0,0,1-.47,1.08,2.72,2.72,0,0,1-.87.55,7.46,7.46,0,0,1-1.33.42,12.9,12.9,0,0,1-1.67.28,15.39,15.39,0,0,1-1.8.1,13.12,13.12,0,0,1-4.24-.62,7,7,0,0,1-3-1.91,7.87,7.87,0,0,1-1.73-3.24,17,17,0,0,1-.55-4.62V414.37h-3.49c-.41,0-.72-.25-.94-.76a7,7,0,0,1-.33-2.56,11.78,11.78,0,0,1,.09-1.59,3.64,3.64,0,0,1,.24-1,1.17,1.17,0,0,1,.41-.54,1,1,0,0,1,.57-.16h3.45v-6.48a1,1,0,0,1,.18-.59,1.34,1.34,0,0,1,.65-.44,5.39,5.39,0,0,1,1.27-.26c.53,0,1.19-.08,2-.08s1.47,0,2,.08a5.18,5.18,0,0,1,1.26.26,1.51,1.51,0,0,1,.65.44,1,1,0,0,1,.19.59v6.48h6.32a1,1,0,0,1,.57.16,1.17,1.17,0,0,1,.41.54,3.64,3.64,0,0,1,.24,1,11.78,11.78,0,0,1,.09,1.59,7,7,0,0,1-.33,2.56c-.22.51-.53.76-.94.76h-6.36V428a6.78,6.78,0,0,0,.75,3.57,2.91,2.91,0,0,0,2.67,1.19,5.29,5.29,0,0,0,1.18-.12,6.9,6.9,0,0,0,.93-.26c.27-.1.5-.18.68-.26a1.42,1.42,0,0,1,.5-.11.76.76,0,0,1,.38.11.81.81,0,0,1,.28.46,7.61,7.61,0,0,1,.17.93A10.14,10.14,0,0,1,872,435Z"/><path class="cls-2" d="M896.59,411.54c0,.78,0,1.42-.07,1.92a6.17,6.17,0,0,1-.19,1.17,1.1,1.1,0,0,1-.35.59.84.84,0,0,1-.53.16,1.69,1.69,0,0,1-.59-.11l-.73-.24c-.27-.09-.57-.17-.9-.25a5,5,0,0,0-1.07-.11,3.71,3.71,0,0,0-1.37.27,6,6,0,0,0-1.42.87,10.34,10.34,0,0,0-1.53,1.56,26.74,26.74,0,0,0-1.71,2.41v18.11a.87.87,0,0,1-.19.57,1.51,1.51,0,0,1-.67.41,5.53,5.53,0,0,1-1.26.24,24.67,24.67,0,0,1-4,0,5.43,5.43,0,0,1-1.25-.24,1.45,1.45,0,0,1-.67-.41.88.88,0,0,1-.2-.57V408.84a1,1,0,0,1,.17-.57,1.11,1.11,0,0,1,.58-.41,4.44,4.44,0,0,1,1.09-.24,13.05,13.05,0,0,1,1.68-.09,13.69,13.69,0,0,1,1.73.09,3.79,3.79,0,0,1,1.06.24,1.14,1.14,0,0,1,.53.41,1,1,0,0,1,.17.57v3.61a22.34,22.34,0,0,1,2.15-2.68,11.62,11.62,0,0,1,1.92-1.68,6,6,0,0,1,1.82-.86,6.78,6.78,0,0,1,1.83-.25c.28,0,.58,0,.91,0a10,10,0,0,1,1,.16,9.42,9.42,0,0,1,.91.26,1.83,1.83,0,0,1,.57.31,1,1,0,0,1,.26.36,3.85,3.85,0,0,1,.15.54,8.68,8.68,0,0,1,.09,1C896.58,410.14,896.59,410.76,896.59,411.54Z"/><path class="cls-2" d="M930.2,423.07a22.3,22.3,0,0,1-1,6.78,14.26,14.26,0,0,1-3,5.27,13.19,13.19,0,0,1-5,3.42,18.81,18.81,0,0,1-7,1.21,19.1,19.1,0,0,1-6.74-1.08,12,12,0,0,1-4.75-3.12A13,13,0,0,1,900,430.5a23.8,23.8,0,0,1-.91-6.84,21.75,21.75,0,0,1,1-6.79,14.18,14.18,0,0,1,3-5.28,13.19,13.19,0,0,1,5-3.4,18.47,18.47,0,0,1,7-1.21,19.4,19.4,0,0,1,6.77,1.06,11.78,11.78,0,0,1,4.74,3.11,13,13,0,0,1,2.79,5.05A23.57,23.57,0,0,1,930.2,423.07Zm-8.44.33a21.1,21.1,0,0,0-.34-4,9.35,9.35,0,0,0-1.15-3.14,5.88,5.88,0,0,0-2.17-2.09,7,7,0,0,0-3.4-.75,7.32,7.32,0,0,0-3.2.67,5.77,5.77,0,0,0-2.24,1.95,9.22,9.22,0,0,0-1.32,3.1,17.64,17.64,0,0,0-.44,4.12,20.37,20.37,0,0,0,.36,4A9.89,9.89,0,0,0,909,430.4a5.54,5.54,0,0,0,2.17,2.07,7.09,7.09,0,0,0,3.39.73,7.21,7.21,0,0,0,3.22-.67,5.76,5.76,0,0,0,2.25-1.94,9,9,0,0,0,1.3-3.07A18.33,18.33,0,0,0,921.76,423.4Z"/><path class="cls-2" d="M954.2,397.76c0,.63,0,1.14-.06,1.52a3.11,3.11,0,0,1-.2.88.94.94,0,0,1-.29.42.59.59,0,0,1-.36.11,1.23,1.23,0,0,1-.5-.11,6,6,0,0,0-.69-.24,9.36,9.36,0,0,0-1-.25,7,7,0,0,0-1.3-.11,3.81,3.81,0,0,0-1.51.27,2.51,2.51,0,0,0-1.06.88,4.1,4.1,0,0,0-.62,1.57,12.08,12.08,0,0,0-.2,2.36v2.67h5.31a.93.93,0,0,1,.54.16,1.24,1.24,0,0,1,.41.54,3.64,3.64,0,0,1,.24,1,14,14,0,0,1,.08,1.59,7.33,7.33,0,0,1-.32,2.56,1,1,0,0,1-1,.76h-5.31v23.52a.87.87,0,0,1-.19.57,1.49,1.49,0,0,1-.65.41,5.41,5.41,0,0,1-1.27.24,19,19,0,0,1-2,.08,18.34,18.34,0,0,1-2-.08,5.52,5.52,0,0,1-1.27-.24,1.32,1.32,0,0,1-.65-.41.92.92,0,0,1-.18-.57V414.37h-3.65c-.41,0-.72-.25-.93-.76a7.38,7.38,0,0,1-.31-2.56,14,14,0,0,1,.08-1.59,4.56,4.56,0,0,1,.23-1,1.15,1.15,0,0,1,.39-.54,1,1,0,0,1,.57-.16h3.62v-2.44a20.65,20.65,0,0,1,.58-5.2,9.44,9.44,0,0,1,1.84-3.71,7.75,7.75,0,0,1,3.2-2.23,12.61,12.61,0,0,1,4.57-.75,13.26,13.26,0,0,1,2.41.21,10.1,10.1,0,0,1,1.79.46,2.76,2.76,0,0,1,.88.45,1.6,1.6,0,0,1,.38.62,4.22,4.22,0,0,1,.21,1C954.18,396.61,954.2,397.13,954.2,397.76Z"/><path class="cls-2" d="M968.35,399c0,1.65-.33,2.79-1,3.42s-1.92.95-3.74.95-3.09-.31-3.73-.92a4.44,4.44,0,0,1-1-3.29,4.7,4.7,0,0,1,1-3.43c.66-.64,1.92-1,3.76-1s3.07.31,3.72.93A4.46,4.46,0,0,1,968.35,399Zm-.62,38.89a.87.87,0,0,1-.19.57,1.45,1.45,0,0,1-.67.41,5.43,5.43,0,0,1-1.25.24,24.79,24.79,0,0,1-4,0,5.43,5.43,0,0,1-1.25-.24,1.51,1.51,0,0,1-.67-.41.87.87,0,0,1-.19-.57v-29a.89.89,0,0,1,.19-.57,1.61,1.61,0,0,1,.67-.42,5.72,5.72,0,0,1,1.25-.28,19.85,19.85,0,0,1,4,0,5.72,5.72,0,0,1,1.25.28,1.55,1.55,0,0,1,.67.42.89.89,0,0,1,.19.57Z"/><path class="cls-2" d="M993.11,435a10.19,10.19,0,0,1-.18,2.2,2.49,2.49,0,0,1-.47,1.08,2.72,2.72,0,0,1-.87.55,7.46,7.46,0,0,1-1.33.42,13,13,0,0,1-1.66.28,15.56,15.56,0,0,1-1.81.1,13.12,13.12,0,0,1-4.24-.62,7,7,0,0,1-3-1.91,7.87,7.87,0,0,1-1.73-3.24,17,17,0,0,1-.55-4.62V414.37h-3.48c-.42,0-.73-.25-1-.76a7.1,7.1,0,0,1-.32-2.56,12,12,0,0,1,.08-1.59,3.64,3.64,0,0,1,.24-1,1.24,1.24,0,0,1,.41-.54,1,1,0,0,1,.57-.16h3.45v-6.48a1,1,0,0,1,.18-.59,1.4,1.4,0,0,1,.65-.44,5.5,5.5,0,0,1,1.27-.26c.53,0,1.19-.08,2-.08s1.47,0,2,.08a5.19,5.19,0,0,1,1.25.26,1.51,1.51,0,0,1,.65.44,1,1,0,0,1,.2.59v6.48h6.31a1,1,0,0,1,.57.16,1.17,1.17,0,0,1,.41.54,4,4,0,0,1,.25,1,14,14,0,0,1,.08,1.59,7,7,0,0,1-.33,2.56,1,1,0,0,1-.94.76h-6.35V428a6.79,6.79,0,0,0,.74,3.57,2.92,2.92,0,0,0,2.68,1.19,5.26,5.26,0,0,0,1.17-.12,6.51,6.51,0,0,0,.93-.26c.27-.1.5-.18.68-.26a1.42,1.42,0,0,1,.51-.11.72.72,0,0,1,.37.11.81.81,0,0,1,.28.46q.09.34.18.93A12,12,0,0,1,993.11,435Z"/><path class="cls-3" d="M229.05,199.64a60.12,60.12,0,0,1-3.74,21.71A56.23,56.23,0,0,1,215,238.55a64.45,64.45,0,0,1-15.76,12.85,97.13,97.13,0,0,1-20.2,8.86,137.38,137.38,0,0,1-23.54,5.12A212.57,212.57,0,0,1,127.59,267H59.82a17.48,17.48,0,0,1-10.94-3.39q-4.43-3.39-4.43-11V56.68q0-7.65,4.43-11a17.54,17.54,0,0,1,10.94-3.38h64q23.44,0,39.7,3.47t27.38,10.51a48.59,48.59,0,0,1,17,17.81q5.91,10.77,5.91,25.36a48.88,48.88,0,0,1-2.36,15.37,43.93,43.93,0,0,1-6.9,13.12,48.27,48.27,0,0,1-11.13,10.42,59.06,59.06,0,0,1-15.07,7.29,74,74,0,0,1,20,6.08,56.1,56.1,0,0,1,16,11.21A51,51,0,0,1,225.11,179,52,52,0,0,1,229.05,199.64Zm-67-94.67a29.88,29.88,0,0,0-2.37-12.16,22.21,22.21,0,0,0-7.09-9,34.25,34.25,0,0,0-11.92-5.47q-7.19-1.9-19.21-1.91H95.28v58.36h29q11.24,0,17.93-2.34a31.57,31.57,0,0,0,11.13-6.43,25.7,25.7,0,0,0,6.6-9.55A31,31,0,0,0,162.07,105Zm13.2,96.23a32,32,0,0,0-3-14,27.29,27.29,0,0,0-8.66-10.34,42.4,42.4,0,0,0-14.58-6.43q-8.88-2.25-23.06-2.25H95.28v63.92h37.43a70.64,70.64,0,0,0,18.23-2,39.18,39.18,0,0,0,12.8-5.9,27.76,27.76,0,0,0,8.47-9.73A28.13,28.13,0,0,0,175.27,201.2Z"/><path class="cls-4" d="M431.62,233c0,2.9-.09,5.36-.29,7.38a31.27,31.27,0,0,1-.89,5.21,13.8,13.8,0,0,1-1.57,3.74,18.78,18.78,0,0,1-3.16,3.56q-2.16,2-8.37,5.12a105.81,105.81,0,0,1-15.17,6,146,146,0,0,1-20.49,4.77,151.86,151.86,0,0,1-24.92,1.91q-26.2,0-47.29-7.12a94.91,94.91,0,0,1-35.85-21.28Q258.83,228.12,251,206.93t-7.88-49.33q0-28.66,8.67-50.9T276,69.36a102.44,102.44,0,0,1,37.33-22.93q21.78-7.82,48-7.82a130.93,130.93,0,0,1,20.49,1.56A139.78,139.78,0,0,1,400,44.26a99,99,0,0,1,15.07,5.81,46.1,46.1,0,0,1,9.36,5.65,20.12,20.12,0,0,1,3.65,3.91,13.49,13.49,0,0,1,1.57,4,39.33,39.33,0,0,1,.89,5.74q.3,3.3.3,8.16a84.78,84.78,0,0,1-.4,8.86,20.42,20.42,0,0,1-1.38,5.91,8.17,8.17,0,0,1-2.36,3.3,5.12,5.12,0,0,1-3.15,1q-3,0-7.49-3a126.32,126.32,0,0,0-11.72-6.78A103.58,103.58,0,0,0,387.2,80a82.06,82.06,0,0,0-23.74-3,64.16,64.16,0,0,0-27.09,5.47,56.58,56.58,0,0,0-20.3,15.63,69.58,69.58,0,0,0-12.7,24.59A112.69,112.69,0,0,0,299,155.17q0,19.8,4.63,34.3t13.2,23.89a53.09,53.09,0,0,0,20.69,14A76.34,76.34,0,0,0,364.84,232a87.46,87.46,0,0,0,23.83-2.87,107.43,107.43,0,0,0,17.24-6.34q7.2-3.47,11.82-6.25t7.2-2.78a6.23,6.23,0,0,1,3.15.69,5.25,5.25,0,0,1,2,2.78,24.51,24.51,0,0,1,1.18,5.82Q431.62,226.74,431.62,233Z"/><path class="cls-5" d="M642.66,261.13a6.13,6.13,0,0,1-.78,3.21c-.53.87-1.78,1.6-3.75,2.17a41.51,41.51,0,0,1-8.66,1.22c-3.82.23-9,.35-15.57.35q-8.28,0-13.2-.35a33,33,0,0,1-7.78-1.3,8.56,8.56,0,0,1-4-2.43,13,13,0,0,1-2-3.57l-22.86-50.2q-4.12-8.5-8.07-15.11a48.69,48.69,0,0,0-8.77-11,32.65,32.65,0,0,0-11.13-6.69,43.31,43.31,0,0,0-14.58-2.26H505.34v85.64a4.48,4.48,0,0,1-1.28,3.13,9.18,9.18,0,0,1-4.23,2.26,46.44,46.44,0,0,1-7.88,1.39q-4.93.51-12.61.52c-5,0-9.16-.18-12.51-.52a46.58,46.58,0,0,1-8-1.39,8.51,8.51,0,0,1-4.14-2.26,4.7,4.7,0,0,1-1.18-3.13V56.68q0-7.65,4.43-11a17.53,17.53,0,0,1,10.93-3.38h66q10,0,16.55.35t11.82.86A119.62,119.62,0,0,1,591,50.07a67.65,67.65,0,0,1,20.88,12.25,50.83,50.83,0,0,1,13.1,17.89,58.57,58.57,0,0,1,4.54,23.71,61.93,61.93,0,0,1-3.26,20.59,50.79,50.79,0,0,1-9.55,16.59,60.68,60.68,0,0,1-15.57,12.68A89.3,89.3,0,0,1,580,162.46a61.42,61.42,0,0,1,10.74,5.91,54.09,54.09,0,0,1,9.46,8.42,82,82,0,0,1,8.37,11.3,135.91,135.91,0,0,1,7.68,14.33l21.48,44.29q3,6.6,3.94,9.64A16.88,16.88,0,0,1,642.66,261.13ZM575.88,108.61q0-11.11-5.72-18.76T551.45,79.08a83.62,83.62,0,0,0-9-1.39q-5-.51-13.89-.52H505.34v63.75h26.4a71.3,71.3,0,0,0,19.31-2.34,40.41,40.41,0,0,0,13.79-6.6,27.46,27.46,0,0,0,8.28-10.16A31,31,0,0,0,575.88,108.61Z"/><path class="cls-6" d="M130.16,405.21c0,1.74,0,3.21-.16,4.43a20.73,20.73,0,0,1-.47,3.12,8.3,8.3,0,0,1-.83,2.23,11,11,0,0,1-1.66,2.14,21.28,21.28,0,0,1-4.43,3.07,52,52,0,0,1-8,3.59,70.12,70.12,0,0,1-10.82,2.86,71.59,71.59,0,0,1-13.17,1.15,69.44,69.44,0,0,1-25-4.27,49.33,49.33,0,0,1-18.94-12.75,56.76,56.76,0,0,1-12-21.18Q30.55,376.91,30.56,360q0-17.18,4.58-30.49a63.53,63.53,0,0,1,12.8-22.38,53.71,53.71,0,0,1,19.72-13.74A66.62,66.62,0,0,1,93,288.75a60.54,60.54,0,0,1,10.83.94,66.2,66.2,0,0,1,9.62,2.44,48.5,48.5,0,0,1,8,3.49,24.11,24.11,0,0,1,4.94,3.38,11.48,11.48,0,0,1,1.92,2.34,8.8,8.8,0,0,1,.84,2.4,27.14,27.14,0,0,1,.47,3.43q.15,2,.15,4.89,0,3.12-.21,5.31a14,14,0,0,1-.72,3.54,5,5,0,0,1-1.25,2,2.52,2.52,0,0,1-1.67.62,7.14,7.14,0,0,1-4-1.82,64.68,64.68,0,0,0-6.2-4.06,50.92,50.92,0,0,0-9-4.06,38.59,38.59,0,0,0-12.54-1.82,29.63,29.63,0,0,0-25,12.65,44,44,0,0,0-6.72,14.72,85.67,85.67,0,0,0,.16,40,39.85,39.85,0,0,0,7,14.31,28.2,28.2,0,0,0,10.93,8.38,36.07,36.07,0,0,0,14.42,2.76,41.24,41.24,0,0,0,12.59-1.72,52.66,52.66,0,0,0,9.11-3.8q3.8-2.08,6.24-3.75a7.73,7.73,0,0,1,3.8-1.66,3,3,0,0,1,1.66.41,3.16,3.16,0,0,1,1.05,1.67,17,17,0,0,1,.62,3.49Q130.16,401.47,130.16,405.21Z"/><path class="cls-7" d="M235.75,374.72a70.92,70.92,0,0,1-3.12,21.64,45.57,45.57,0,0,1-9.47,16.86,42,42,0,0,1-15.93,10.93A59.64,59.64,0,0,1,184.86,428a61.33,61.33,0,0,1-21.55-3.43,38.76,38.76,0,0,1-15.19-10,41,41,0,0,1-9-16.13,74.88,74.88,0,0,1-2.92-21.86,70.26,70.26,0,0,1,3.18-21.7A45.6,45.6,0,0,1,149,338a42.52,42.52,0,0,1,15.87-10.88,59.48,59.48,0,0,1,22.33-3.85,62.31,62.31,0,0,1,21.64,3.39,37.71,37.71,0,0,1,15.15,9.94,41.44,41.44,0,0,1,8.9,16.13A75.56,75.56,0,0,1,235.75,374.72Zm-27,1a68.07,68.07,0,0,0-1.09-12.65,29.82,29.82,0,0,0-3.69-10,18.5,18.5,0,0,0-6.92-6.66,22.2,22.2,0,0,0-10.88-2.4,23,23,0,0,0-10.2,2.14,18.28,18.28,0,0,0-7.18,6.24,30,30,0,0,0-4.22,9.89,56.3,56.3,0,0,0-1.4,13.17,65.41,65.41,0,0,0,1.14,12.64,31.4,31.4,0,0,0,3.7,10,17.59,17.59,0,0,0,6.92,6.61,22.7,22.7,0,0,0,10.82,2.34A23.31,23.31,0,0,0,196.1,405a18.48,18.48,0,0,0,7.18-6.19,28.64,28.64,0,0,0,4.16-9.84A58.09,58.09,0,0,0,208.79,375.76Z"/><path class="cls-8" d="M397.75,422.07a2.85,2.85,0,0,1-.62,1.82,4.54,4.54,0,0,1-2.08,1.3,17.33,17.33,0,0,1-4,.78,61.36,61.36,0,0,1-6.35.26,62.83,62.83,0,0,1-6.45-.26,18.32,18.32,0,0,1-4-.78,4.19,4.19,0,0,1-2.08-1.3,3,3,0,0,1-.57-1.82V367a38.16,38.16,0,0,0-.89-8.54,20.11,20.11,0,0,0-2.7-6.61,12.85,12.85,0,0,0-4.58-4.26,13.54,13.54,0,0,0-6.61-1.51,15.65,15.65,0,0,0-9.47,3.64A63.74,63.74,0,0,0,337,360.35v61.72a2.85,2.85,0,0,1-.62,1.82,4.56,4.56,0,0,1-2.14,1.3,18.1,18.1,0,0,1-4,.78,60.3,60.3,0,0,1-6.25.26,61.49,61.49,0,0,1-6.35-.26,18.1,18.1,0,0,1-4-.78,4.56,4.56,0,0,1-2.14-1.3,2.85,2.85,0,0,1-.62-1.82V367a38.16,38.16,0,0,0-.89-8.54,20.74,20.74,0,0,0-2.65-6.61,12.3,12.3,0,0,0-4.58-4.26,13.61,13.61,0,0,0-6.56-1.51,15.75,15.75,0,0,0-9.57,3.64,61,61,0,0,0-10.31,10.61v61.72a2.79,2.79,0,0,1-.62,1.82,4.58,4.58,0,0,1-2.13,1.3,18.32,18.32,0,0,1-4,.78,77.67,77.67,0,0,1-12.7,0,18.1,18.1,0,0,1-4-.78,4.56,4.56,0,0,1-2.14-1.3,2.85,2.85,0,0,1-.62-1.82V329.24a3.2,3.2,0,0,1,.52-1.83,3.8,3.8,0,0,1,1.87-1.3,15.71,15.71,0,0,1,3.49-.78,46.35,46.35,0,0,1,5.36-.26,48.72,48.72,0,0,1,5.51.26,13.1,13.1,0,0,1,3.39.78,3.82,3.82,0,0,1,1.71,1.3,3.2,3.2,0,0,1,.52,1.83V340a61.41,61.41,0,0,1,15.36-12.49,32.91,32.91,0,0,1,16-4.17,40.63,40.63,0,0,1,10.3,1.2,29.37,29.37,0,0,1,8.17,3.43,25.88,25.88,0,0,1,6.2,5.36,31.49,31.49,0,0,1,4.37,7,78.42,78.42,0,0,1,8.17-7.7,48,48,0,0,1,7.91-5.26,36.34,36.34,0,0,1,7.8-3,32.35,32.35,0,0,1,8-1q9.25,0,15.61,3.13a27.37,27.37,0,0,1,10.25,8.48,34.12,34.12,0,0,1,5.57,12.54,67.1,67.1,0,0,1,1.66,15.19Z"/><path class="cls-9" d="M510.53,374.3a86.6,86.6,0,0,1-2.66,22.33,50.42,50.42,0,0,1-7.75,16.91,34.44,34.44,0,0,1-12.7,10.72A38.89,38.89,0,0,1,470,428a33.06,33.06,0,0,1-7.44-.78,28.41,28.41,0,0,1-6.56-2.39,39.66,39.66,0,0,1-6.29-4,72.42,72.42,0,0,1-6.46-5.62v43.72a3.09,3.09,0,0,1-.62,1.87,4.71,4.71,0,0,1-2.14,1.4,17.93,17.93,0,0,1-4,.89,65.19,65.19,0,0,1-12.7,0,18,18,0,0,1-4-.89,4.73,4.73,0,0,1-2.13-1.4,3,3,0,0,1-.63-1.87V329.24a3.27,3.27,0,0,1,.52-1.83,3.86,3.86,0,0,1,1.83-1.3,14.6,14.6,0,0,1,3.43-.78,46.35,46.35,0,0,1,5.36-.26,45.45,45.45,0,0,1,5.26.26,14.72,14.72,0,0,1,3.43.78,3.82,3.82,0,0,1,1.82,1.3,3.2,3.2,0,0,1,.52,1.83v10.92a94.92,94.92,0,0,1,8-7.33,48,48,0,0,1,8-5.31,36.4,36.4,0,0,1,8.37-3.18,39.46,39.46,0,0,1,9.22-1q10.19,0,17.38,4a32.82,32.82,0,0,1,11.7,11,49.23,49.23,0,0,1,6.61,16.24A89.8,89.8,0,0,1,510.53,374.3Zm-27.27,1.87a71.14,71.14,0,0,0-.89-11.39,33.43,33.43,0,0,0-3-9.73,18.42,18.42,0,0,0-5.62-6.82,14.32,14.32,0,0,0-8.69-2.55,17.53,17.53,0,0,0-5.15.78,20,20,0,0,0-5.2,2.55,37,37,0,0,0-5.47,4.58,65.74,65.74,0,0,0-5.93,7v30.6a61.12,61.12,0,0,0,10.51,10.77,16.93,16.93,0,0,0,10.41,3.8,14.43,14.43,0,0,0,8.69-2.6,20.06,20.06,0,0,0,5.88-6.82,33.92,33.92,0,0,0,3.38-9.52A52.47,52.47,0,0,0,483.26,376.17Z"/><path class="cls-10" d="M551.28,422.07a2.8,2.8,0,0,1-.63,1.82,4.52,4.52,0,0,1-2.13,1.3,18.2,18.2,0,0,1-4,.78,77.55,77.55,0,0,1-12.69,0,18.08,18.08,0,0,1-4-.78,4.56,4.56,0,0,1-2.14-1.3,2.85,2.85,0,0,1-.62-1.82V285.21a3.07,3.07,0,0,1,.62-1.87,4.64,4.64,0,0,1,2.14-1.41,18,18,0,0,1,4-.88,65.09,65.09,0,0,1,12.69,0,18.1,18.1,0,0,1,4,.88,4.6,4.6,0,0,1,2.13,1.41,3,3,0,0,1,.63,1.87Z"/><path class="cls-11" d="M624.81,425.61,613.57,458.5q-.93,2.6-5.1,3.75a64.23,64.23,0,0,1-18.84.78,9.47,9.47,0,0,1-3.74-1.2,2.77,2.77,0,0,1-1.36-2.08,6.8,6.8,0,0,1,.63-3l12.38-31.12a7.2,7.2,0,0,1-2.44-1.92,8.85,8.85,0,0,1-1.61-2.76l-32-85.35a17.6,17.6,0,0,1-1.35-5.56,3.81,3.81,0,0,1,1.25-3,8.21,8.21,0,0,1,4.22-1.51,58.3,58.3,0,0,1,7.85-.42c3,0,5.34.05,7.08.16a12.35,12.35,0,0,1,4.06.78,4.42,4.42,0,0,1,2.18,1.92,18.77,18.77,0,0,1,1.46,3.7l21.86,62.13h.31l20-63.38a7.1,7.1,0,0,1,1.62-3.59,6.74,6.74,0,0,1,3.28-1.3,51.25,51.25,0,0,1,8-.42,54.63,54.63,0,0,1,7.44.42,9,9,0,0,1,4.37,1.56,3.75,3.75,0,0,1,1.41,3.07,15.07,15.07,0,0,1-.84,4.53Z"/><path class="cls-12" d="M964.22,92.3V83.74h-8.39v4.19h-16L929,101.79h5v23.07l-12.6,10.92V114h8.4L916.38,97.17V84.58H902.11v6.71h-26L858.46,114h8.4v68.83l-13.43,11.71V52.68L787.59,82.06v37.27H758.13v33.5H718.64V164h8.88v38.12l-4.2,7.55,36.94,64.63L808.1,264.2,966.35,127.38l3.75-28.54ZM746.83,207.12H733.4V193.69h13.43Zm0-21.82H733.4V171.87h13.43Zm19.3,21.82H752.7V193.69h13.43Zm0-21.82H752.7V171.87h13.43Zm18.47,26.86h-9.9V130.74h9.9Zm31.23-3.55H795.51V188.29h20.32Zm0-33H795.51V155.28h20.32Zm0-31.62H795.51V123.66h20.32Zm0-33H795.51V90.64h20.32ZM845,208.61H824.71V188.29H845Zm0-33H824.71V155.28H845ZM845,144H824.71V123.66H845Zm0-33H824.71V90.64H845Zm56.24,69.3H888V132.42h13.25Z"/><path class="cls-13" d="M703.31,198.3a3.58,3.58,0,0,1,.14-.54c1.59-5.13,9.89-3.81,13.39-2.12,11.38,5.48,21.75,13.88,31.41,21.89a261.14,261.14,0,0,1,22.24,20.61c5.66,6,10.78,11.14,19.8,8.84,6.14-1.57,11.2-5.85,15.66-10.35,42.67-43.13,90.25-82.91,137.82-120.54,36.09-28.54,75.11-60.33,118.77-76.48,0,0,11.37-3.14,12.72,1.13s-8.38,2.17-39.2,30.44c-2,1.88-4.13,3.75-6.2,5.61l-7.51,6.69q-4.36,3.9-8.72,7.81-5,4.48-9.91,9-5.55,5.1-11,10.27-6.11,5.76-12.13,11.61-6.63,6.45-13.17,13-7.14,7.17-14.17,14.47-7.63,7.94-15.12,16-8.1,8.73-16,17.62-8.53,9.57-16.9,19.29-9,10.44-17.72,21-9.36,11.34-18.5,22.86-9.74,12.27-19.23,24.73-10.1,13.25-19.92,26.68-10.42,14.25-20.57,28.7c-2,2.85-4,5.7-6,8.56-3,4.3-5.11,8.62-10.5,10.18a11.21,11.21,0,0,1-11.14-2.66c-14.12-13.56-24.71-33.3-34.84-49.78-17.54-28.53-30.93-57.86-42.66-89.11A10.11,10.11,0,0,1,703.31,198.3Z"/><ellipse class="cls-14" cx="790.05" cy="352.33" rx="39.87" ry="7.55"/></svg>
>>>>>>> c7a5aaf60620f311fd9663dad475708479988024
                </span>
                {{-- <span class="logo-sm">
                    <img src="{{ asset('assets/images/small_new_logo.svg') }}" class="img-fluid"
                        style="max-height: 130px">

                </span> --}}
                <span class="logo-sm">
                    <svg class="img-fluid" width="67" height="67" viewBox="0 0 67 67" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1651_16797)">
                        <path d="M58.7215 48.7869H7.68051C6.94547 48.7869 6.34961 49.3827 6.34961 50.1178V64.8692C6.34961 65.6042 6.94547 66.2001 7.68051 66.2001H58.7215C59.4566 66.2001 60.0524 65.6042 60.0524 64.8692V50.1178C60.0524 49.3827 59.4566 48.7869 58.7215 48.7869Z" fill="#09A0DC"/>
                        <path d="M10.2412 51.9338H13.7643C14.4247 51.9152 15.0806 52.0484 15.6815 52.323C16.195 52.5689 16.6174 52.9713 16.8879 53.4723C17.1817 54.0508 17.3245 54.6943 17.303 55.3428C17.3122 55.8656 17.2243 56.3854 17.0436 56.8761C16.8888 57.2851 16.6451 57.6546 16.3301 57.9579C16.0086 58.257 15.6288 58.4866 15.2146 58.6324L14.5867 58.9904H11.6837V57.26H13.7176C14.0149 57.2709 14.3087 57.1922 14.5608 57.0343C14.7872 56.8808 14.9625 56.6631 15.0641 56.4091C15.1801 56.1171 15.2365 55.8048 15.2301 55.4907C15.238 55.1592 15.1871 54.8289 15.0797 54.5152C14.9923 54.2614 14.8259 54.0423 14.6049 53.89C14.3523 53.7364 14.0597 53.6614 13.7643 53.6747H12.3167V63.2374H10.2412V51.9338ZM15.4299 63.2374L13.3285 58.1758H15.5103L17.6688 63.1284V63.2374H15.4299Z" fill="white"/>
                        <path d="M22.1238 63.3905C21.6164 63.3986 21.112 63.3105 20.6372 63.131C20.2201 62.9685 19.845 62.714 19.5398 62.3865C19.2276 62.0387 18.9932 61.6283 18.8523 61.1827C18.6863 60.6523 18.6066 60.0987 18.6163 59.543V58.7907C18.605 58.1767 18.6864 57.5644 18.8575 56.9746C18.992 56.5067 19.2197 56.0708 19.5269 55.693C19.8068 55.3601 20.1627 55.0994 20.5646 54.9329C20.9918 54.7582 21.4495 54.67 21.9111 54.6735C22.3867 54.6628 22.8594 54.7512 23.299 54.9329C23.6875 55.1036 24.0253 55.3717 24.2797 55.7112C24.5564 56.0916 24.7532 56.524 24.8582 56.9824C24.9927 57.5553 25.0563 58.1426 25.0476 58.731V59.6857H19.5087V58.2355H23.0941V58.0409C23.0911 57.7286 23.0466 57.418 22.9618 57.1173C22.9021 56.8909 22.7734 56.6886 22.5934 56.5388C22.3931 56.3972 22.1507 56.3277 21.9059 56.3416C21.7013 56.3361 21.4987 56.3826 21.317 56.4765C21.1451 56.5739 21.006 56.7202 20.9174 56.8968C20.8016 57.1338 20.7245 57.3878 20.6891 57.6492C20.6326 58.0279 20.6066 58.4104 20.6113 58.7933V59.5456C20.6048 59.887 20.6414 60.2278 20.7203 60.56C20.778 60.8043 20.8858 61.034 21.0368 61.2346C21.1726 61.4045 21.3519 61.5345 21.5556 61.6107C21.7817 61.6927 22.0209 61.7323 22.2613 61.7275C22.628 61.7358 22.9918 61.6604 23.325 61.507C23.6208 61.3617 23.8852 61.1599 24.1033 60.9129L24.9335 62.1322C24.7589 62.3586 24.5527 62.5587 24.3212 62.7263C24.0356 62.9329 23.7196 63.0939 23.3847 63.2037C22.9774 63.3344 22.5515 63.3975 22.1238 63.3905Z" fill="white"/>
                        <path d="M29.9327 54.8367V56.3518H25.7324V54.8367H29.9327ZM26.7883 52.7612H28.7678V60.7726C28.7599 60.9634 28.7863 61.154 28.8456 61.3355C28.8859 61.4487 28.9687 61.5418 29.0765 61.595C29.1927 61.645 29.3185 61.6689 29.4449 61.665C29.5483 61.6654 29.6515 61.6576 29.7537 61.6417C29.8274 61.6316 29.9002 61.616 29.9716 61.595V63.1801C29.8104 63.2401 29.6447 63.2869 29.4761 63.3202C29.2601 63.3572 29.0413 63.3745 28.8223 63.3721C28.4555 63.3806 28.0922 63.2995 27.7638 63.136C27.4465 62.9633 27.1963 62.6893 27.0529 62.3577C26.864 61.9102 26.7754 61.4266 26.7935 60.9412L26.7883 52.7612Z" fill="white"/>
                        <path d="M33.2327 56.5828V63.2373H31.2559V54.8368H33.1419L33.2327 56.5828ZM35.2356 54.7668L35.22 56.7463C35.106 56.7241 34.9908 56.7085 34.875 56.6996C34.7478 56.6996 34.6285 56.684 34.5221 56.684C34.3054 56.6785 34.0901 56.721 33.8917 56.8085C33.7173 56.8896 33.5658 57.0126 33.4507 57.1665C33.3238 57.3374 33.2313 57.5312 33.1783 57.7373C33.1113 57.9917 33.0721 58.2527 33.0615 58.5156L32.6568 58.4456C32.6538 57.9454 32.6972 57.446 32.7865 56.9538C32.8591 56.5418 32.9865 56.1413 33.1653 55.763C33.3094 55.4543 33.5235 55.1833 33.7905 54.9717C34.035 54.7836 34.3356 54.683 34.6441 54.6864C34.7527 54.6876 34.8611 54.6972 34.9684 54.7149C35.0593 54.725 35.1489 54.745 35.2356 54.7746V54.7668Z" fill="white"/>
                        <path d="M35.8943 59.3483V58.7334C35.8847 58.1442 35.9661 57.557 36.1356 56.9926C36.2741 56.5268 36.5063 56.0943 36.8179 55.7214C37.1074 55.3843 37.4704 55.118 37.879 54.9431C38.313 54.7638 38.7793 54.6755 39.2488 54.6837C39.7234 54.675 40.1948 54.7633 40.6342 54.9431C41.0428 55.1192 41.4064 55.3853 41.6979 55.7214C42.0104 56.0936 42.2427 56.5264 42.3802 56.9926C42.5466 57.5576 42.6262 58.1446 42.6163 58.7334V59.3483C42.6262 59.9363 42.5466 60.5224 42.3802 61.0865C42.241 61.5512 42.0088 61.9828 41.6979 62.3551C41.4085 62.6936 41.0443 62.9601 40.6342 63.1334C39.7528 63.4792 38.7733 63.4792 37.892 63.1334C37.4814 62.9595 37.1165 62.6931 36.8257 62.3551C36.5113 61.9839 36.2764 61.5522 36.1356 61.0865C35.966 60.523 35.8847 59.9367 35.8943 59.3483ZM37.8894 58.7334V59.3483C37.8846 59.7034 37.9159 60.058 37.9828 60.4068C38.0308 60.6682 38.1239 60.9192 38.2578 61.1488C38.3636 61.3294 38.5136 61.4803 38.6936 61.5872C38.8678 61.6846 39.0648 61.7339 39.2644 61.7299C39.4723 61.7348 39.6779 61.6856 39.8611 61.5872C40.041 61.4828 40.1891 61.3312 40.2891 61.1488C40.4153 60.9171 40.5029 60.6666 40.5486 60.4068C40.6099 60.0574 40.6386 59.703 40.6342 59.3483V58.7334C40.6382 58.3851 40.606 58.0374 40.5382 57.6957C40.4866 57.4345 40.3937 57.1832 40.2632 56.9511C40.1575 56.7683 40.0076 56.6149 39.8273 56.5049C39.6534 56.4036 39.4552 56.3516 39.254 56.3544C39.0568 56.3511 38.8626 56.4033 38.6936 56.5049C38.5166 56.6173 38.369 56.7703 38.263 56.9511C38.1291 57.1816 38.0361 57.4335 37.988 57.6957C37.9206 58.0375 37.8876 58.3851 37.8894 58.7334Z" fill="white"/>
                        <path d="M47.9506 54.8367V56.3518H43.5791V54.8367H47.9506ZM46.6067 63.2372H44.6194V54.0688C44.6021 53.5192 44.7122 52.9732 44.9411 52.4733C45.1403 52.06 45.4595 51.7165 45.8569 51.4874C46.2888 51.2535 46.7746 51.1371 47.2657 51.1502C47.4308 51.1497 47.5956 51.1627 47.7586 51.1891C47.9149 51.2146 48.0692 51.2511 48.2204 51.298L48.1892 52.9039C48.1056 52.8742 48.0183 52.8559 47.9298 52.8495C47.8281 52.839 47.7259 52.8338 47.6237 52.8339C47.4285 52.8283 47.2359 52.8787 47.0685 52.9792C46.9121 53.0796 46.7899 53.2253 46.7183 53.3969C46.6327 53.6103 46.5921 53.839 46.5989 54.0688L46.6067 63.2372Z" fill="white"/>
                        <path d="M49.2528 52.6497C49.2481 52.5069 49.2718 52.3645 49.3226 52.2309C49.3733 52.0973 49.4501 51.9751 49.5485 51.8714C49.6542 51.767 49.7806 51.6858 49.9196 51.6331C50.0585 51.5804 50.207 51.5573 50.3554 51.5653C50.5027 51.5566 50.6501 51.5794 50.7879 51.6322C50.9257 51.6849 51.0506 51.7665 51.1544 51.8714C51.3488 52.083 51.4523 52.3625 51.4424 52.6497C51.4534 52.9371 51.3498 53.217 51.1544 53.428C51.0506 53.5329 50.9257 53.6145 50.7879 53.6673C50.6501 53.7201 50.5027 53.7429 50.3554 53.7342C50.2104 53.7433 50.0651 53.722 49.9289 53.6715C49.7927 53.621 49.6686 53.5425 49.5647 53.441C49.4608 53.3395 49.3793 53.2173 49.3256 53.0824C49.2718 52.9474 49.247 52.8027 49.2528 52.6575V52.6497ZM51.349 54.8367V63.2372H49.3539V54.8367H51.349Z" fill="white"/>
                        <path d="M56.6983 54.8367V56.3518H52.498V54.8367H56.6983ZM53.5539 52.7612H55.5334V60.7726C55.5255 60.9634 55.5519 61.154 55.6113 61.3355C55.6504 61.4486 55.7324 61.5417 55.8396 61.595C55.9558 61.6448 56.0815 61.6687 56.2079 61.665C56.3122 61.6654 56.4163 61.6576 56.5193 61.6417C56.593 61.6316 56.6658 61.616 56.7372 61.595V63.1801C56.5753 63.2404 56.4087 63.2873 56.2391 63.3202C56.024 63.3572 55.8061 63.3746 55.5879 63.3721C55.2203 63.3808 54.8561 63.2998 54.5268 63.136C54.2109 62.9624 53.9617 62.6885 53.8186 62.3577C53.6296 61.9102 53.541 61.4266 53.5591 60.9412L53.5539 52.7612Z" fill="white"/>
                        <path d="M43.9856 7.95711V6.72999H42.7767V7.33448H40.4755L38.9033 9.32433H39.6297V12.6503L37.8137 14.2224V11.0807H39.0226L37.0873 8.65759V6.84155H35.03V7.80923H31.2785L28.7361 11.0781H29.958V20.9989L28.02 22.6878V2.24438L18.517 6.47056V11.8434H14.27V16.6741H8.5625V18.28H9.8441V23.7774L9.25 24.8904L14.5762 34.2092L21.4745 32.7564L44.3047 13.0394L44.8443 8.92481L43.9856 7.95711ZM12.6408 24.5142H10.7028V22.5762H12.6408V24.5142ZM12.6408 21.3673H10.7028V19.4423H12.6408V21.3673ZM15.4297 24.5142H13.4866V22.5762H15.4297V24.5142ZM15.4297 21.3673H13.4866V19.4423H15.4297V21.3673ZM18.0915 25.2406H16.6646V13.5012H18.0915V25.2406ZM22.5953 24.7217H19.6585V21.7979H22.5901L22.5953 24.7217ZM22.5953 19.9637H19.6585V17.0321H22.5901L22.5953 19.9637ZM22.5953 15.4029H19.6585V12.479H22.5901L22.5953 15.4029ZM22.5953 10.6423H19.6585V7.71844H22.5901L22.5953 10.6423ZM26.8059 24.7217H23.8743V21.7979H26.8059V24.7217ZM26.8059 19.9637H23.8743V17.0321H26.8059V19.9637ZM26.8059 15.4029H23.8743V12.479H26.8059V15.4029ZM26.8059 10.6423H23.8743V7.71844H26.8059V10.6423ZM34.9132 20.6356H33.0038V13.7347H34.9132V20.6356Z" fill="url(#paint0_linear_1651_16797)"/>
                        <path d="M6.36529 23.2403C6.36529 23.2143 6.36529 23.1884 6.38605 23.1624C6.61435 22.4231 7.81034 22.615 8.31624 22.8563C9.95586 23.6476 11.4528 24.8591 12.846 26.0136C13.9714 26.9419 15.042 27.9346 16.0526 28.9867C16.8672 29.8429 17.6092 30.5926 18.9063 30.2605C19.7936 30.0348 20.5226 29.4174 21.166 28.7688C27.3172 22.5424 34.1792 16.8141 41.036 11.3867C46.2403 7.26951 51.8674 2.68531 58.1587 0.358186C58.1587 0.358186 59.7983 -0.0958247 59.9929 0.519034C60.1875 1.13389 58.7865 0.835544 54.345 4.91385C54.0493 5.17328 53.7483 5.45606 53.45 5.72328L52.3681 6.68838L51.1099 7.81432C50.6325 8.24498 50.156 8.67737 49.6804 9.11149C49.1485 9.60182 48.6167 10.0947 48.0901 10.5929C47.5037 11.1463 46.9209 11.7041 46.3415 12.2662C45.7033 12.8854 45.0702 13.5106 44.4424 14.1419C43.7506 14.8337 43.07 15.5256 42.4007 16.2174C41.6656 16.9801 40.9383 17.7498 40.2188 18.5263C39.4405 19.3652 38.67 20.2118 37.9073 21.0662C37.0857 21.9881 36.2737 22.916 35.4712 23.8499C34.6064 24.8513 33.7546 25.8623 32.9158 26.8827C32.0147 27.9723 31.1248 29.0706 30.2462 30.1775C29.3122 31.3588 28.3886 32.5479 27.4754 33.7447C26.5051 35.016 25.547 36.2976 24.6009 37.5896C23.5995 38.9594 22.6119 40.343 21.6382 41.7405C21.3476 42.1504 21.0622 42.5603 20.7768 42.9728C20.3462 43.5929 20.0375 44.2155 19.2618 44.4412C18.9843 44.5278 18.6886 44.5378 18.406 44.4702C18.1233 44.4026 17.8642 44.2599 17.6559 44.0572C15.6193 42.1011 14.0912 39.2577 12.6306 36.8813C10.1011 32.7693 8.16576 28.5405 6.47944 24.0341C6.36912 23.785 6.32962 23.5104 6.36529 23.2403Z" fill="url(#paint1_linear_1651_16797)"/>
                        <path opacity="0.5" d="M18.8731 46.5401C22.0482 46.5401 24.6221 46.0522 24.6221 45.4505C24.6221 44.8487 22.0482 44.3608 18.8731 44.3608C15.698 44.3608 13.124 44.8487 13.124 45.4505C13.124 46.0522 15.698 46.5401 18.8731 46.5401Z" fill="url(#paint2_radial_1651_16797)"/>
                        </g>
                        <defs>
                        <linearGradient id="paint0_linear_1651_16797" x1="8.57547" y1="18.2203" x2="44.834" y2="18.2203" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#009DDC"/>
                        <stop offset="1" stop-color="#67B8E7"/>
                        </linearGradient>
                        <linearGradient id="paint1_linear_1651_16797" x1="6.34713" y1="22.3582" x2="60.0136" y2="22.3582" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E06C6D"/>
                        <stop offset="1" stop-color="#D5244C"/>
                        </linearGradient>
                        <radialGradient id="paint2_radial_1651_16797" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(18.8159 45.0198) scale(5.45865 1.11401)">
                        <stop/>
                        <stop offset="1" stop-opacity="0"/>
                        </radialGradient>
                        <clipPath id="clip0_1651_16797">
                        <rect width="53.7054" height="66" fill="white" transform="translate(6.34766 0.199951)"/>
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
                                        <li>
                                            <a class="_nav-item-text" href="{{ route('property', $scheme->id) }}">
                                                <i class="uil-coins"></i>
                                                <span>&nbsp; {{ $scheme->scheme }}</span>
                                            </a>
                                        </li>
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
<<<<<<< HEAD
                            <a href="/dashboard/contractor-chat"
                                class="side-nav-link @if (Request::segment(2) == 'contractor-chat/*') active @endif">

                                <svg class="mysvgmsg" width="24" height="25" viewBox="0 0 24 25"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.0001 3.58905H17.9221C19.1328 3.56312 20.3125 3.97293 21.2464 4.74382C22.1803 5.51471 22.8062 6.5954 23.0101 7.78905C23.0661 8.07963 23.0922 8.37516 23.0881 8.67105C23.0881 11.207 23.0881 13.743 23.0881 16.279C23.1001 17.4715 22.6898 18.6298 21.93 19.5489C21.1701 20.468 20.1096 21.0887 18.9361 21.301C18.5734 21.362 18.2059 21.3901 17.8381 21.385C13.9381 21.385 10.0381 21.385 6.13811 21.385C5.4678 21.4058 4.80002 21.2934 4.17347 21.0543C3.54691 20.8152 2.97401 20.4541 2.48795 19.9921C2.0019 19.53 1.61234 18.9761 1.34184 18.3624C1.07134 17.7488 0.92528 17.0876 0.912109 16.4171C0.912109 13.781 0.912109 11.1451 0.912109 8.50905C0.949595 7.22072 1.47692 5.99516 2.38661 5.08212C3.29631 4.16908 4.51993 3.63726 5.80811 3.59505H12.0001V3.58905ZM21.1501 6.78105C21.0661 6.88305 21.0241 6.96105 20.9641 7.02105C19.0961 8.88905 17.2281 10.757 15.3601 12.625C14.9229 13.0745 14.4 13.4317 13.8224 13.6756C13.2448 13.9195 12.6241 14.0452 11.9971 14.0452C11.3701 14.0452 10.7495 13.9195 10.1718 13.6756C9.59421 13.4317 9.07134 13.0745 8.63411 12.625C6.76611 10.745 4.88811 8.87105 3.00011 7.00305C2.94611 6.94305 2.88611 6.88905 2.81411 6.82305C2.49187 7.34461 2.31765 7.94402 2.31011 8.55705C2.31011 11.1851 2.31011 13.813 2.31011 16.435C2.32429 17.3804 2.70983 18.2823 3.38343 18.9458C4.05703 19.6093 4.96461 19.9812 5.91011 19.9811C9.97411 19.9811 14.0361 19.9811 18.0961 19.9811C19.0393 19.9735 19.9425 19.5992 20.6144 18.9373C21.2864 18.2754 21.6743 17.378 21.6961 16.435C21.6961 13.813 21.6961 11.1851 21.6961 8.55705C21.6827 7.92669 21.4958 7.31221 21.1561 6.78105H21.1501ZM3.75011 5.78505C3.87011 5.87505 3.96611 5.93505 4.04411 6.00705C5.91611 7.87105 7.78411 9.73905 9.64811 11.6111C9.9532 11.9341 10.321 12.1914 10.7291 12.3673C11.1371 12.5432 11.5768 12.6339 12.0211 12.6339C12.4654 12.6339 12.9051 12.5432 13.3131 12.3673C13.7212 12.1914 14.089 11.9341 14.3941 11.6111C16.2901 9.72305 18.1801 7.83105 20.0641 5.93505L20.2501 5.73705C20.1594 5.66833 20.0653 5.60425 19.9681 5.54505C19.3555 5.1678 18.6475 4.97415 17.9281 4.98705H10.0681C8.65211 4.98705 7.24211 4.98705 5.83211 4.98705C5.06187 5.01626 4.3223 5.2965 3.72611 5.78505H3.75011Z"
                                        fill="#797B7C" />
                                </svg>
=======
                            <a href="/dashboard/contractor-chat" class="side-nav-link @if(Request::segment(2) == 'contractor-chat/*') active @endif">

<svg class="mysvgmsg" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.0001 3.58905H17.9221C19.1328 3.56312 20.3125 3.97293 21.2464 4.74382C22.1803 5.51471 22.8062 6.5954 23.0101 7.78905C23.0661 8.07963 23.0922 8.37516 23.0881 8.67105C23.0881 11.207 23.0881 13.743 23.0881 16.279C23.1001 17.4715 22.6898 18.6298 21.93 19.5489C21.1701 20.468 20.1096 21.0887 18.9361 21.301C18.5734 21.362 18.2059 21.3901 17.8381 21.385C13.9381 21.385 10.0381 21.385 6.13811 21.385C5.4678 21.4058 4.80002 21.2934 4.17347 21.0543C3.54691 20.8152 2.97401 20.4541 2.48795 19.9921C2.0019 19.53 1.61234 18.9761 1.34184 18.3624C1.07134 17.7488 0.92528 17.0876 0.912109 16.4171C0.912109 13.781 0.912109 11.1451 0.912109 8.50905C0.949595 7.22072 1.47692 5.99516 2.38661 5.08212C3.29631 4.16908 4.51993 3.63726 5.80811 3.59505H12.0001V3.58905ZM21.1501 6.78105C21.0661 6.88305 21.0241 6.96105 20.9641 7.02105C19.0961 8.88905 17.2281 10.757 15.3601 12.625C14.9229 13.0745 14.4 13.4317 13.8224 13.6756C13.2448 13.9195 12.6241 14.0452 11.9971 14.0452C11.3701 14.0452 10.7495 13.9195 10.1718 13.6756C9.59421 13.4317 9.07134 13.0745 8.63411 12.625C6.76611 10.745 4.88811 8.87105 3.00011 7.00305C2.94611 6.94305 2.88611 6.88905 2.81411 6.82305C2.49187 7.34461 2.31765 7.94402 2.31011 8.55705C2.31011 11.1851 2.31011 13.813 2.31011 16.435C2.32429 17.3804 2.70983 18.2823 3.38343 18.9458C4.05703 19.6093 4.96461 19.9812 5.91011 19.9811C9.97411 19.9811 14.0361 19.9811 18.0961 19.9811C19.0393 19.9735 19.9425 19.5992 20.6144 18.9373C21.2864 18.2754 21.6743 17.378 21.6961 16.435C21.6961 13.813 21.6961 11.1851 21.6961 8.55705C21.6827 7.92669 21.4958 7.31221 21.1561 6.78105H21.1501ZM3.75011 5.78505C3.87011 5.87505 3.96611 5.93505 4.04411 6.00705C5.91611 7.87105 7.78411 9.73905 9.64811 11.6111C9.9532 11.9341 10.321 12.1914 10.7291 12.3673C11.1371 12.5432 11.5768 12.6339 12.0211 12.6339C12.4654 12.6339 12.9051 12.5432 13.3131 12.3673C13.7212 12.1914 14.089 11.9341 14.3941 11.6111C16.2901 9.72305 18.1801 7.83105 20.0641 5.93505L20.2501 5.73705C20.1594 5.66833 20.0653 5.60425 19.9681 5.54505C19.3555 5.1678 18.6475 4.97415 17.9281 4.98705H10.0681C8.65211 4.98705 7.24211 4.98705 5.83211 4.98705C5.06187 5.01626 4.3223 5.2965 3.72611 5.78505H3.75011Z" fill="#797B7C"/>
    </svg>
>>>>>>> c7a5aaf60620f311fd9663dad475708479988024

                                <span class="_nav-item-text"> Messages </span>
                            </a>
                        </li>
                        {{-- @if (Auth::user()->email == "test_admin@bcrcomply.com") --}}
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
                        {{-- @endif --}}
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
                        <li class="side-nav-item">
                            <a href="/crm" class="side-nav-link" target="_blank">
                                <i class="uil-chart _nav-item-text"></i>
                                <span class="_nav-item-text"> CRM </span>
                            </a>
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


                    @if (Auth::user()->role == 'admin')
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#crm" aria-expanded="false"
                            aria-controls="sidebarPages" class="side-nav-link _nav-item-text">
                            <i class="fa fa-users"></i>

                            <span> CRM </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="crm">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a target="_blank" class="_nav-item-text" href="https://crm.bcrcomply.com/">
                                        <i class="fa fa-users"></i>
                                        <span>&nbsp; Go to CRM</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
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
<<<<<<< HEAD
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
=======
                    {{-- <ul class="titleHeader"><h3>
                    @if(Request::segment(2) == "")
                    Dashboard
                    @elseif(Request::segment(2) == "client" || Request::segment(2) == "batch" || Request::segment(2) == "contractor" || Request::segment(2) == "assessor" || (Request::segment(2) == "property" && Request::segment(3) == "0"))
                    Create & Manage
                    @elseif(Request::segment(2) == "property" && Request::segment(3) > 0)
                    Properties
                    @elseif(Request::segment(2) == "lookup")
                    Lookups
                    @elseif(Request::segment(2) == "user")
                    Users
                    @elseif(Request::segment(2) == "surveyor")
                    Surveyor
                    @elseif(Request::segment(2) == "config")
                    Config
                    @endif
                    </h3></ul> --}}
                    <ul class="list-unstyled topbar-menu float-end mt-1 mb-0 d-flex align-items-center mynew1">

                        <li class="dropdown notification-list">
                            @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\MessageNotification')->count() > 0)
                                <span
                                    class="msg-counter">{{ auth()->user()->unreadNotifications->where('type', 'App\Notifications\MessageNotification')->count() }}</span>
                            @endif
                            <a class="nav-link dropdown-toggle arrow-none" style="top: 10px;position: relative;" data-bs-toggle="dropdown"
                                href="javascript:;" role="button" aria-haspopup="false" aria-expanded="false">

                            <svg class="" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.0001 3.58905H17.9221C19.1328 3.56312 20.3125 3.97293 21.2464 4.74382C22.1803 5.51471 22.8062 6.5954 23.0101 7.78905C23.0661 8.07963 23.0922 8.37516 23.0881 8.67105C23.0881 11.207 23.0881 13.743 23.0881 16.279C23.1001 17.4715 22.6898 18.6298 21.93 19.5489C21.1701 20.468 20.1096 21.0887 18.9361 21.301C18.5734 21.362 18.2059 21.3901 17.8381 21.385C13.9381 21.385 10.0381 21.385 6.13811 21.385C5.4678 21.4058 4.80002 21.2934 4.17347 21.0543C3.54691 20.8152 2.97401 20.4541 2.48795 19.9921C2.0019 19.53 1.61234 18.9761 1.34184 18.3624C1.07134 17.7488 0.92528 17.0876 0.912109 16.4171C0.912109 13.781 0.912109 11.1451 0.912109 8.50905C0.949595 7.22072 1.47692 5.99516 2.38661 5.08212C3.29631 4.16908 4.51993 3.63726 5.80811 3.59505H12.0001V3.58905ZM21.1501 6.78105C21.0661 6.88305 21.0241 6.96105 20.9641 7.02105C19.0961 8.88905 17.2281 10.757 15.3601 12.625C14.9229 13.0745 14.4 13.4317 13.8224 13.6756C13.2448 13.9195 12.6241 14.0452 11.9971 14.0452C11.3701 14.0452 10.7495 13.9195 10.1718 13.6756C9.59421 13.4317 9.07134 13.0745 8.63411 12.625C6.76611 10.745 4.88811 8.87105 3.00011 7.00305C2.94611 6.94305 2.88611 6.88905 2.81411 6.82305C2.49187 7.34461 2.31765 7.94402 2.31011 8.55705C2.31011 11.1851 2.31011 13.813 2.31011 16.435C2.32429 17.3804 2.70983 18.2823 3.38343 18.9458C4.05703 19.6093 4.96461 19.9812 5.91011 19.9811C9.97411 19.9811 14.0361 19.9811 18.0961 19.9811C19.0393 19.9735 19.9425 19.5992 20.6144 18.9373C21.2864 18.2754 21.6743 17.378 21.6961 16.435C21.6961 13.813 21.6961 11.1851 21.6961 8.55705C21.6827 7.92669 21.4958 7.31221 21.1561 6.78105H21.1501ZM3.75011 5.78505C3.87011 5.87505 3.96611 5.93505 4.04411 6.00705C5.91611 7.87105 7.78411 9.73905 9.64811 11.6111C9.9532 11.9341 10.321 12.1914 10.7291 12.3673C11.1371 12.5432 11.5768 12.6339 12.0211 12.6339C12.4654 12.6339 12.9051 12.5432 13.3131 12.3673C13.7212 12.1914 14.089 11.9341 14.3941 11.6111C16.2901 9.72305 18.1801 7.83105 20.0641 5.93505L20.2501 5.73705C20.1594 5.66833 20.0653 5.60425 19.9681 5.54505C19.3555 5.1678 18.6475 4.97415 17.9281 4.98705H10.0681C8.65211 4.98705 7.24211 4.98705 5.83211 4.98705C5.06187 5.01626 4.3223 5.2965 3.72611 5.78505H3.75011Z" fill="#1C274C"/>
                            </svg>


                            </a>
>>>>>>> c7a5aaf60620f311fd9663dad475708479988024

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
<<<<<<< HEAD

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
=======
                                        <div class="myNewMenu">

                                @if (auth()->user()->notifications->where('type', 'App\Notifications\MessageNotification')->count() > 0)
                                    @foreach (auth()->user()->unreadNotifications->where('type', 'App\Notifications\MessageNotification')->all() as $notification)
                                    @php
                                        $parts = explode(' ', $notification->data['user']);
                                        $initials = "";
                                        if (isset($parts[0])) {
                                            $initials .= $parts[0][0];
                                        }
                                        if (isset($parts[1])) {
                                            $initials .= $parts[1][0];
                                        }
                                        $initials = strtoupper($initials);
                                        $lastMsg = "N/A";
                                        $lastMsgs = \App\Models\ContractorMessage::where('id',$notification->data['msg_id'])->first();
                                        $lastMsg = $lastMsgs->content;
                                        if($lastMsg){
                                            $lastMsg = $lastMsgs->content;
                                        }else{
                                            $lastMsg = "N/A";

                                        }
                                    @endphp
                                        <a class="mynewDropDown dropdown-item un-read-notification"
                                        href="{{ route('chat.open', ['id' => Crypt::encrypt($notification->data['msg_id']), 'notification_id' => $notification->id]) }}">
                                            <div class="mr-1" style="font-family: Arial, sans-serif; font-size: 24px; color: #fff; background-color: #1A47A3; border-radius: 5px; display: inline-block; margin: 5px;border-radius: 36px; display: flex; align-items: center; justify-content: center;width:60px;height:60px;padding-left:10px;padding-right:10px;">{{$initials}}</div>
                                            <div class="d-flex flex-column">
                                                <b class="mr-2">{{ $notification->data['user'] }}</b>
                                                <span style="text-overflow: ellipsis; overflow: hidden; width: 150px;white-space: nowrap;">{{$lastMsg}}</span>
                                            </div>
                                            <div class=" ml-2 mr-2 d-flex flex-column text-end">
                                                <span>{{ date('d-m-Y', strtotime($notification->created_at)) }}</span>
                                                <span><small>{{ date('h:m A', strtotime($notification->created_at)) }}</small></span>
                                            </div>
                                        </a>
                                    @endforeach

                                    @foreach (auth()->user()->readNotifications->where('type', 'App\Notifications\MessageNotification')->all() as $notification)
                                    @php

                                        $parts = explode(' ', $notification->data['user']);
                                        $initials = "";
                                        if (isset($parts[0])) {
                                            $initials .= $parts[0][0];
                                        }
                                        if (isset($parts[1])) {
                                            $initials .= $parts[1][0];
                                        }
                                        $initials = strtoupper($initials);
                                        $lastMsg = "N/A";
                                        $lastMsgs = \App\Models\ContractorMessage::where('id',$notification->data['msg_id'])->first();
                                        if($lastMsgs){
                                            $lastMsg = $lastMsgs->content;
                                        }else{
                                            $lastMsg = "N/A";
                                        }
                                    @endphp
                                        <a class="mynewDropDown dropdown-item"
                                            href="{{ route('chat.open', ['id' => Crypt::encrypt($notification->data['msg_id']), 'notification_id' => $notification->id]) }}">
                                            <div class="mr-1" style="font-family: Arial, sans-serif; font-size: 24px; color: #fff; background-color: #1A47A3; border-radius: 5px; display: inline-block; margin: 5px;border-radius: 36px; display: flex; align-items: center; justify-content: center;width:60px;height:60px;padding-left:10px;padding-right:10px;">{{$initials}}</div>
                                            <div class="d-flex flex-column">
                                                <b class="mr-2">{{ $notification->data['user'] }}</b>
                                                <span style="text-overflow: ellipsis; overflow: hidden; width: 150px;white-space: nowrap;">{{$lastMsg}}</span>
>>>>>>> c7a5aaf60620f311fd9663dad475708479988024
                                            </div>
                                            <div class="mr-1 d-flex flex-column text-end">
                                                <span>{{ date('d-m-Y', strtotime($noti['msg_date'])) }}</span>
                                                <span><small>{{ date('h:i A', strtotime($noti['msg_date'])) }}</small></span>
                                            </div>
                                        </a>
                                    @endforeach
<<<<<<< HEAD
=======

>>>>>>> c7a5aaf60620f311fd9663dad475708479988024
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
<<<<<<< HEAD
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11 0.25C6.71983 0.25 3.25004 3.71979 3.25004 8V8.7041C3.25004 9.40102 3.04375 10.0824 2.65717 10.6622L1.50856 12.3851C0.175468 14.3848 1.19318 17.1028 3.51177 17.7351C4.26738 17.9412 5.02937 18.1155 5.79578 18.2581L5.79768 18.2632C6.56667 20.3151 8.62198 21.75 11 21.75C13.378 21.75 15.4333 20.3151 16.2023 18.2632L16.2042 18.2581C16.9706 18.1155 17.7327 17.9412 18.4883 17.7351C20.8069 17.1028 21.8246 14.3848 20.4915 12.3851L19.3429 10.6622C18.9563 10.0824 18.75 9.40102 18.75 8.7041V8C18.75 3.71979 15.2802 0.25 11 0.25ZM14.3764 18.537C12.1335 18.805 9.86644 18.8049 7.62349 18.5369C8.33444 19.5585 9.57101 20.25 11 20.25C12.4289 20.25 13.6655 19.5585 14.3764 18.537ZM4.75004 8C4.75004 4.54822 7.54826 1.75 11 1.75C14.4518 1.75 17.25 4.54822 17.25 8V8.7041C17.25 9.69716 17.544 10.668 18.0948 11.4943L19.2434 13.2172C20.0086 14.3649 19.4245 15.925 18.0936 16.288C13.4494 17.5546 8.5507 17.5546 3.90644 16.288C2.57561 15.925 1.99147 14.3649 2.75664 13.2172L3.90524 11.4943C4.45609 10.668 4.75004 9.69716 4.75004 8.7041V8Z"
                                            fill="#1C274C" />
                                    </svg>
=======
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11 0.25C6.71983 0.25 3.25004 3.71979 3.25004 8V8.7041C3.25004 9.40102 3.04375 10.0824 2.65717 10.6622L1.50856 12.3851C0.175468 14.3848 1.19318 17.1028 3.51177 17.7351C4.26738 17.9412 5.02937 18.1155 5.79578 18.2581L5.79768 18.2632C6.56667 20.3151 8.62198 21.75 11 21.75C13.378 21.75 15.4333 20.3151 16.2023 18.2632L16.2042 18.2581C16.9706 18.1155 17.7327 17.9412 18.4883 17.7351C20.8069 17.1028 21.8246 14.3848 20.4915 12.3851L19.3429 10.6622C18.9563 10.0824 18.75 9.40102 18.75 8.7041V8C18.75 3.71979 15.2802 0.25 11 0.25ZM14.3764 18.537C12.1335 18.805 9.86644 18.8049 7.62349 18.5369C8.33444 19.5585 9.57101 20.25 11 20.25C12.4289 20.25 13.6655 19.5585 14.3764 18.537ZM4.75004 8C4.75004 4.54822 7.54826 1.75 11 1.75C14.4518 1.75 17.25 4.54822 17.25 8V8.7041C17.25 9.69716 17.544 10.668 18.0948 11.4943L19.2434 13.2172C20.0086 14.3649 19.4245 15.925 18.0936 16.288C13.4494 17.5546 8.5507 17.5546 3.90644 16.288C2.57561 15.925 1.99147 14.3649 2.75664 13.2172L3.90524 11.4943C4.45609 10.668 4.75004 9.69716 4.75004 8.7041V8Z" fill="#1C274C"/>
                                        </svg>
>>>>>>> c7a5aaf60620f311fd9663dad475708479988024
                                </a>
                                @if (auth()->user()->notifications->where('type', 'App\Notifications\ContractorJob')->count() > 0)
                                    <div class="dropdown-menu myNewMenu" aria-labelledby="dropdownMenuButton">

                                        @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJob')->count() > 0)
                                            <a class="dropdown-item mark-read"
                                                href="{{ route('notification.markAsRead') }}"><i class="fa fa-check"
                                                    aria-hidden="true"></i>Mark all as read</a>
                                        @endif

                                        @foreach (auth()->user()->unreadNotifications->where('type', 'App\Notifications\ContractorJob')->all() as $notification)
<<<<<<< HEAD
                                            <div class="mb-1 mt-1 mynewNoti row">
                                                <div class="col-12 px-0">
                                                    <a class="dropdown-item" style="color:#313131;padding:0.5rem 0.5rem 0rem 0.5rem !important;white-space:unset;"
                                                        href="/dashboard/contract/show-contract/{{ Crypt::encrypt($notification->data['property_id']) }}?notify=true">{{ $notification->data['notify'] }}</a>
                                                </div>
                                                <div class="col-12 ps-0 pe-2 text-end pb-1">

                                                    <span><small
                                                            style="color: #1A47A3;">{{ date('d/m/Y', strtotime($notification->created_at)) }}</small></span>
=======

                                                <div class="row mynewNoti mb-1 mt-1 d-flex">
                                                    <div class="col">
                                                        <a class="dropdown-item un-read-notification"
                                                href="/dashboard/contract/show-contract/{{ Crypt::encrypt($notification->data['property_id']) }}?notify=true">{{ $notification->data['notify'] }}</a>
                                                    </div>
                                                    <div class="d-flex flex-column col-3 justify-content-between text-end">
                                                        <span style="color: #1A47A3;opacity:0;">X</span>
                                                        <span><small  style="color: #1A47A3;">{{ date('d/m/Y', strtotime($notification->created_at)) }}</small></span>
                                                    </div>
>>>>>>> c7a5aaf60620f311fd9663dad475708479988024
                                                </div>
                                            </div>
                                        @endforeach

                                        @foreach (auth()->user()->readNotifications->where('type', 'App\Notifications\ContractorJob')->all() as $notification)
<<<<<<< HEAD
                                            <div class="mb-1 mt-1 mynewNoti row">
                                                <div class="col-12 px-0">
                                                    <a class="dropdown-item" style="color:#313131;padding:0.5rem 0.5rem 0rem 0.5rem !important;white-space:unset;"
                                                        href="/dashboard/contract/show-contract/{{ Crypt::encrypt($notification->data['property_id']) }}">{{ $notification->data['notify'] }}</a>
=======

                                                <div class="d-flex mb-1 mt-1 mynewNoti row">
                                                    <div class="col">
                                                        <a class="dropdown-item"
                                                        href="/dashboard/contract/show-contract/{{ Crypt::encrypt($notification->data['property_id']) }}">{{ $notification->data['notify'] }}</a>

                                                    </div>
                                                    <div class="d-flex flex-column col-3 justify-content-between text-end">
                                                        <span style="color: #1A47A3;opacity:0;">X</span>
                                                        <span><small  style="color: #1A47A3;">{{ date('d/m/Y', strtotime($notification->created_at)) }}</small></span>
                                                    </div>
>>>>>>> c7a5aaf60620f311fd9663dad475708479988024
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
<<<<<<< HEAD
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
=======
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="false" aria-expanded="false">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11 0.25C6.71983 0.25 3.25004 3.71979 3.25004 8V8.7041C3.25004 9.40102 3.04375 10.0824 2.65717 10.6622L1.50856 12.3851C0.175468 14.3848 1.19318 17.1028 3.51177 17.7351C4.26738 17.9412 5.02937 18.1155 5.79578 18.2581L5.79768 18.2632C6.56667 20.3151 8.62198 21.75 11 21.75C13.378 21.75 15.4333 20.3151 16.2023 18.2632L16.2042 18.2581C16.9706 18.1155 17.7327 17.9412 18.4883 17.7351C20.8069 17.1028 21.8246 14.3848 20.4915 12.3851L19.3429 10.6622C18.9563 10.0824 18.75 9.40102 18.75 8.7041V8C18.75 3.71979 15.2802 0.25 11 0.25ZM14.3764 18.537C12.1335 18.805 9.86644 18.8049 7.62349 18.5369C8.33444 19.5585 9.57101 20.25 11 20.25C12.4289 20.25 13.6655 19.5585 14.3764 18.537ZM4.75004 8C4.75004 4.54822 7.54826 1.75 11 1.75C14.4518 1.75 17.25 4.54822 17.25 8V8.7041C17.25 9.69716 17.544 10.668 18.0948 11.4943L19.2434 13.2172C20.0086 14.3649 19.4245 15.925 18.0936 16.288C13.4494 17.5546 8.5507 17.5546 3.90644 16.288C2.57561 15.925 1.99147 14.3649 2.75664 13.2172L3.90524 11.4943C4.45609 10.668 4.75004 9.69716 4.75004 8.7041V8Z" fill="#1C274C"/>
                                </svg>
                                </a>
                                @if( auth()->user()->notifications->where('type','App\Notifications\ContractorJobAcceptReject')->count() > 0)
                                <div class="dropdown-menu myNewMenu " aria-labelledby="dropdownMenuButton">

                                    @if(auth()->user()->unreadNotifications->where('type','App\Notifications\ContractorJobAcceptReject')->count() > 0)
                                    <a class="dropdown-item mark-read" href="{{ route('notification.markAsRead') }}"><i class="fa fa-check" aria-hidden="true"></i>Mark all as read</a>
                                    @endif

                                    @foreach(auth()->user()->unreadNotifications->where('type','App\Notifications\ContractorJobAcceptReject')->all() as $notification)
                                    <div class="row mynewNoti mb-1 mt-1 d-flex">
                                        <div class="col">
                                            <a class="dropdown-item un-read-notification" href="javascript:;">{{ $notification->data['notify'] }}</a>
                                        </div>
                                        <div class="d-flex flex-column col-3 justify-content-between text-end">
                                            <span style="color: #1A47A3;opacity:0;">X</span>
                                            <span><small  style="color: #1A47A3;">{{ date('d/m/Y', strtotime($notification->created_at)) }}</small></span>
                                        </div>
                                    </div>
                                    @endforeach

                                    @foreach(auth()->user()->readNotifications->where('type','App\Notifications\ContractorJobAcceptReject')->all() as $notification)
>>>>>>> c7a5aaf60620f311fd9663dad475708479988024
                                        <div class="d-flex mb-1 mt-1 mynewNoti row">
                                            <div class="col-12 px-0">
                                                <a class="dropdown-item" style="color:#313131;padding:0.5rem 0.5rem 0rem 0.5rem !important;white-space:unset;"
                                                    href="javascript:;">{{ $snagMsg['note'] }}</a>

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

        // Set interval to make the AJAX call every 10 seconds
        setInterval(makeAjaxCall, 10000);
        // setInterval(makeAjaxCall, 100000000);

        function formatDate33(dateString) {
            var options = {
                month: '2-digit',
                day: '2-digit',
                year: 'numeric'
            };
            var formattedDate = new Date(dateString).toLocaleDateString('en-GB', options);
            return formattedDate.replace(/(\d+)\/(\d+)\/(\d+)/, '$1/$2/$3');
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
<<<<<<< HEAD
        $(document).on('click', '.eye-toggle', function() {
            var input = $('input[name="password"]');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
=======
        // $(document).on('click', '.cliclef', function() {
        //     if (!$('body.show').hasClass('sidebar-enable')) {
        //         $(".cliclef").addClass("rotate180");
        //     } else {
        //         $(".cliclef").removeClass("rotate180");
        //     }
        // })

>>>>>>> c7a5aaf60620f311fd9663dad475708479988024
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
<<<<<<< HEAD
=======



>>>>>>> c7a5aaf60620f311fd9663dad475708479988024
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
                emptyTable: "No notes available"
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

<<<<<<< HEAD
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
=======
            $(document).ready(function() {

                $('#property_inspection_table').DataTable({
                    order: [
                        [1, 'desc']
                    ],
                    lengthMenu: [
                    [10, 25, 50, 100, 250, 500],
                    [10, 25, 50, 100, 250, 500],
                    ],
                    dom: 'fBrtlp',
                    buttons: [
                        {
                            extend: 'collection',
                            text: 'Export',
                            buttons: [
                                'copy',
                                'excel',
                                'csv',
                                'pdf',
                                'print'
                            ]
                        }
                    ],
                });
                $('#property_inspection_table2').DataTable({
                    order: [
                        [1, 'desc']
                    ],
                    lengthMenu: [
                    [10, 25, 50, 100, 250, 500],
                    [10, 25, 50, 100, 250, 500],
                    ],
                    dom: 'fBrtlp',
                    buttons: [
                        {
                            extend: 'collection',
                            text: 'Export',
                            buttons: [
                                'copy',
                                'excel',
                                'csv',
                                'pdf',
                                'print'
                            ]
                        }
                    ],
                });
                $('#property_snags_table').DataTable({
                    order: [[1, 'desc']],
                    lengthMenu: [
                    [10, 25, 50, 100, 250, 500],
                    [10, 25, 50, 100, 250, 500],
                    ],
                    dom: 'fBrtlp',
                    buttons: [
                        {
                            extend: 'collection',
                            text: 'Export',
                            buttons: [
                                'copy',
                                'excel',
                                'csv',
                                'pdf',
                                'print'
                            ]
                        }
                    ],
                });
            });
>>>>>>> c7a5aaf60620f311fd9663dad475708479988024

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
