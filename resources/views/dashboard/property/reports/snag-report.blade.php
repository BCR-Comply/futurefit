@extends('layouts.dashboard.app')
@section('content')
    <style>
        .mybody {
            background-color: #eaf1ff !important;
        }
        .editSafty,
        .editSafty:hover {
            background: #1A47A3;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 0px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .d-none {
            display: none;
        }

        /* #gen_dec tbody tr:first-child {
        background-color: #1A47A3 !important;
        border: 1px solid #1A47A3;
        border-radius: 10px;
        } */
        #gen_dec tbody tr:first-child th,
        #gen_dec2 tbody tr:first-child th {
            background-color: #1A47A3 !important;
            border-top-left-radius: 4px !important;
            outline: 1px solid #1A47A3;
            border-bottom: 1px solid #1A47A3 !important;
            color: #fff !important;
        }

        #gen_dec tbody tr:first-child td,
        #gen_dec2 tbody tr:first-child td {
            background-color: #1A47A3 !important;
            border-top-right-radius: 4px !important;
            outline: 1px solid #1A47A3;
            border-bottom: 1px solid #1A47A3 !important;
            color: #fff !important;
        }

        #gen_dec tbody tr:not(:first-child) td:nth-child(2),
        #gen_dec2 tbody tr:not(:first-child) td:nth-child(2) {
            border-right: 1px solid #eaf1ff !important;
        }

        .f20 {
            font-size: 20px;
        }

        #gen_dec table tr:not(:first-child) th {
            width: 15%;
        }

        #gen_dec table tr:not(:first-child) td:nth-child(2) {
            width: 25%;
        }

        #gen_dec2 table tr:not(:first-child) th {
            width: 15%;
        }

        #gen_dec2 table tr:not(:first-child) td:nth-child(2) {
            width: 25%;
        }

        .text-info {
            color: #6c757d !important;
        }

        .f16 {
            font-size: 16px;
        }

        .brright {
            border-right: 1px solid #1A47A3;
        }

        table tbody tr:nth-child(even) {
            background-color: #fff !important;
        }

        table tbody tr:nth-child(odd) {
            background-color: #fff !important;
        }

        tbody tr:not(:last-child) {
            border-bottom: 1px solid #eaf1ff;
        }

        table {
            outline: 1px solid #1A47A3 !important;
        }

        .bg-grasy {
            background: #E0E9FC;
            border-radius: 6px !important;
        }

        h4 {
            color: #1A47A3;
        }

        .mybody table>tbody>tr>th {
            border-right: 1px solid #eaf1ff !important;
            width: 4%;
        }

        .mybody table>tbody>tr>td:nth-child(3) {
            width: 25%;
        }

        .mybody #gen_dec2>tbody>tr>td:nth-child(3) {
            width: 50%;
        }

        .mybody table>tbody>tr>th,
        .mybody table>tbody>tr>td {
            font-size: 15px;
        }

        th,
        td {
            padding: 1px 8px !important;
            color: #333;
            font-size: 12px !important;
        }
        .f12 {
            font-size: 12px !important;
        }
        .f14 {
            font-size: 14px !important;
        }
        .cm {
            margin-top: 16px !important;
        }
        .main-logo {
            width: 100px !important;
        }
        .main-header {
            font-size: 22px !important;
        }
    </style>
    <div class="col-md-12 mt-3 d-flex justify-content-between">
        <a href="{{ url()->previous() }}">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="mdi mdi-menu cliclef mr-3">
                <rect width="32" height="32" rx="16" fill="#E2E8ED" />
                <path
                    d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
                    fill="black" />
            </svg>
        </a>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between" style="font-family: Arial">
                        <div style="color: #1A47A3 !important;">
                            <div class="d-flex align-items-end">
                                <h4 class="main-header my-0">Snag Report</h4>
                            </div>
                            <h6 class="main-header-date my-0" style="margin-top: 4px !important;">{{ date('d/m/Y', strtotime($snag['created_at'])) }}</h6>
                        </div>

                        <div>
                            <img src="{{ asset('assets/images/new_logo.svg') }}" class="main-logo img-fluid">
                        </div>
                    </div>
                    <div style="border: 1px solid #e0e9fc;">

                    </div>
                    <div class="row mt-1 mb-1">
                        <div class="col-3 d-grid brright">
                            <span class="f14 text-black"><b>Client: </b></span>
                            <span class="f12">{{ isset($snag['property']['client']['name']) ? $snag['property']['client']['name'] : '' }}</span>
                        </div>
                        <div class="col-9 d-grid">
                            <span class="f14 text-black"><b>Address: </b></span>
                            <span
                                class="f12">{{ format_address($snag['property']['house_num'],
                                $snag['property']['address1'],
                                $snag['property']['address2'],
                                $snag['property']['address3'],
                                $snag['property']['county'],
                                $snag['property']['eircode']) }}</span>
                        </div>
                    </div>
                    <div style="border: 1px solid #e0e9fc;">

                    </div>

                    <div class="row cm">
                        <div class="col-12">
                            <div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>
                                                Item Name
                                            </th>
                                            <td>
                                                {{ $snag['item_name'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Priority
                                            </th>
                                            <td>
                                                {{ $snag['priority'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Measure
                                            </th>
                                            <td>
                                                {{ $snag['is_measure'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Status
                                            </th>
                                            <td>
                                                {{ $snag['status'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                General Comment
                                            </th>
                                            <td>
                                                {{ $snag['general_comment'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Contractor
                                            </th>
                                            <td>
                                                {{ $snag['contractor_name'] != "" && $snag['contractor_name'] != null ? $snag['contractor_name'] : "N/A" }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @if (sizeOf($snag['comments']))
                                <div class="cm">
                                    <h3 class="f14 text-blue mb-1 mt-0">Comments</h3>
                                    <div class="p-1" style="border: 1px solid #1A47A3;">
                                        @php
                                            $last = null;
                                            foreach ($snag['comments'] as $index => $comment) {
                                                $sum = 0;
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if (isset($comment['image' . $i]) && trim($comment['image' . $i]) != '') {
                                                        $sum++;
                                                    }
                                                }
                                                if($comment != '' && $comment != null && $sum > 0){
                                                    $last = $index;
                                                }
                                            }
                                        @endphp
                                        @foreach ($snag['comments'] as $index => $comment)
                                            @php
                                                $sum = 0;
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if (isset($comment['image' . $i]) && trim($comment['image' . $i]) != '') {
                                                        $sum++;
                                                    }
                                                }
                                            @endphp
                                            @if ($comment != '' && $comment != null && $sum > 0)
                                                <h4 class="f12 text-black mb-1 mt-0" style="margin: 0 0 10px !important;">{{ $comment['comment'] }}</h4>
                                                <div class="row mx-0 @if ($sum == 0) d-none @endif">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if (isset($comment['image' . $i]) && trim($comment['image' . $i]) != '')
                                                            <div class="col-sm-12 col-md-4 col-lg-4 py-0 px-0 d-flex justify-content-start"
                                                                style="max-width:fit-content;">
                                                                <img class="me-1 mb-1 img-fluid"
                                                                    style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;"
                                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/snag_photo/' . $comment['image' . $i]) }}"
                                                                    style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;">
                                                            </div>
                                                        @endif
                                                    @endfor
                                                </div>
                                                @if (sizeof($comment['comment_reply']) > 0)
                                                    <h4 class="f12 text-black mb-1 mt-1">Replies</h4>
                                                    @foreach ($comment['comment_reply'] as $reply)
                                                        @php
                                                            $sum2 = 0;
                                                            for ($i = 1; $i <= 5; $i++) {
                                                                if (isset($reply['image' . $i]) && trim($reply['image' . $i]) != '') {
                                                                    $sum2++;
                                                                }
                                                            }
                                                        @endphp
                                                        @if ($reply['comment'] != '' && $reply['comment'] != null && $sum2 > 0)
                                                            <div class="p-1" style="border: 1px solid #1A47A3;">
                                                                <h3 class="f12 text-black  mb-1 mt-0">{{ $reply['comment'] }}</h3>
                                                                <div class="row mx-0 @if ($sum2 == 0) d-none @endif">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if (isset($reply['image' . $i]) && trim($reply['image' . $i]) != '')
                                                                            <div class="col-sm-12 col-md-4 col-lg-4 py-0 px-0 d-flex justify-content-start"
                                                                                style="max-width:fit-content;">
                                                                                <img class="me-1 mb-1 img-fluid"
                                                                                    style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;"
                                                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/snag_photo/' . $reply['image' . $i]) }}"
                                                                                    style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;">
                                                                            </div>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @if ($index != $last)
                                                    <div class="mt-2 mb-1" style="border: 1px solid #e0e9fc;"></div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->

@endsection
