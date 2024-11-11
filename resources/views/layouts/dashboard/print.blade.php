<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/css/customcss.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <style>
        .col-print-1 {width:8%;  float:left;}
        .col-print-2 {width:16%; float:left;}
        .col-print-3 {width:25%; float:left;}
        .col-print-4 {width:33%; float:left;}
        .col-print-5 {width:42%; float:left;}
        .col-print-6 {width:50%; float:left;}
        .col-print-7 {width:58%; float:left;}
        .col-print-8 {width:66%; float:left;}
        .col-print-9 {width:75%; float:left;}
        .col-print-10 {width:83%; float:left;}
        .col-print-11 {width:92%; float:left;}
        .col-print-12 {width:100%; float:left;}
        table tbody tr {background-color: #fff !important;}
        .card{
            /* border-radius: 6px !important; */
        }
        .bg-grasy,.justify-content-between.bg-graycard{
            background-color: #fff !important;
            border: 0.5px solid #1A47A3 !important;
            /* border-radius: 6px !important; */
        }
        .card-body.mybody,.card.mybody._shadow-1{
            background-color: #fff !important;
        }
        .col-12.pt-3.bg-gray,.col-12.bg-gray,.col-12.mt-3.card,.col-sm-12.card.mt-3.text-black,div.row > div.col-12 > .my-1.card{
            background-color: #fff !important;
            border: 0.5px solid #1A47A3 !important;
        }
        img {page-break-inside: avoid !important;max-width: 100% !important;}

        .cm {
            margin-top: 16px !important;
           /* page-break-inside: avoid !important;*/
        }
        .main-header {
            font-size: 22px !important;
        }
        .main-header-date {
            color: gray;
            font-weight:500;
        }
        .main-logo {
            width: 100px;
        }
        .f14 {
            font-size: 14px;
        }
        .bg-grasy h4 {
            font-size: 12px !important;
        }
        .footer-sign {
            height: 120px;
            width: 160px;
        }
        .text-gray {
            color: gray;
        }
        .masonry-grid {
            column-count: 4;
            column-gap: 8px;
        }

        .masonry-grid div {
            break-inside: avoid;
            page-break-inside: avoid;
        }
        .f12 {
            font-size: 12px !important;
        }
        body {
            background-color: #fff;
            padding-left: 20px !important;
        }
        .border-card {
            background-color: #fff !important;
            border: 0.5px solid #1A47A3 !important;
        }
        .bg-grasy1 {
            background: #fff;
            border: 1px solid lightgray;
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>
