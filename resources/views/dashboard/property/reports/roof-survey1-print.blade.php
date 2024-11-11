@extends('layouts.dashboard.print')
@section('content')
    <style>
        .mybody {
            background-color: #eaf1ff !important;
        }

        .d-none {
            display: none;
        }

        .f20 {
            font-size: 20px;
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
            background: #fff;
        }

        h4 {
            color: #1A47A3;
        }

        .mybody table>tbody>tr>th {
            border-right: 1px solid #eaf1ff !important;
        }

        .mybody table>tbody>tr>th,
        .mybody table>tbody>tr>td {
            font-size: 15px;
        }

        th,
        td {
            color: #333;
        }

        .cm>h4 {
            font-size: 12px !important;
            margin-bottom: 4px !important;
            margin-top: 0 !important;
        }

        .img-padding {
            padding-block: 6px !important;
            padding-inline: 6px !important;
        }

        table {
            border-radius: 0px !important;
        }

        h5 {
            font-size: 12px;
            margin: 0 0 6px;
            padding-left: 2px;
        }
    </style>
    @php
        $style['tbl-padding'] = 'font-size: 12px !important; padding: 1px 8px !important;';
        $style['tbl-padding-img'] = 'padding-block: 6px !important; padding-inline: 6px !important;';
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="">
                <div class="">
                    <div class="d-flex justify-content-between" style="font-family: Arial">
                        <div style="color: #1A47A3 !important;">
                            <div class="d-flex align-items-end">
                                <h4 class="main-header my-0" style="color: #1A47A3 !important;padding-bottom: 2px;">
                                    {{ $data['report_name'] }}</h4>
                                @if ($data['report_type'])
                                    <div class="lead ml-2">({{ $data['report_type'] }})</div>
                                @endif
                            </div>
                            <h6 class="main-header-date my-0">{{ date('d/m/Y', strtotime($data['date_inspected'])) }}</h6>
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
                            <span class="f12">{{ $data['property']['client']['name'] }}</span>
                        </div>
                        <div class="col-9 d-grid">
                            <span class="f14 text-black"><b>Address: </b></span>
                            <span
                                class="f12">{{ format_address($data['property']['house_num'], $data['property']['address1'], $data['property']['address2'], $data['property']['address3'], $data['property']['county'], $data['property']['eircode']) }}</span>
                        </div>
                    </div>
                    <div style="border: 1px solid #e0e9fc;">

                    </div>

                    <div class="row">
                        <div class="col-12">

                            @if (isset($data['rs_building_details']))
                                <div class="cm">
                                    <h4>Building Details</h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                            @if (isset($data['rs_building_details']['appropriate_tick_box']))
                                                @foreach (json_decode($data['rs_building_details']['appropriate_tick_box']) as $item)
                                                    <tr>
                                                        <th style="{{ $style['tbl-padding'] }}">{{ $item }}</th>
                                                        <td style="{{ $style['tbl-padding'] }}">YES</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            @endif

                            @if (isset($data['rs_additional_property_detail']))
                                <div class="cm">
                                    <h4>Additional Property Details</h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Additional Note</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_additional_property_detail']['additional_note'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            @if (isset($data['rs_roof_types']))
                                <div class="cm">
                                    <h4>Roof Types</h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Flat Roof (Warm)</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_types']['warm'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Flat Roof (Cold)</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_types']['cold'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Pitches Roof</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_types']['pitches'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Vaulted Roof</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_types']['vaulted'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Dormer Roof</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_types']['dormer'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            @if (isset($data['rs_roof_conditions']))
                                <div class="cm">
                                    <h4>Roof Conditions</h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Is felt existing</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_conditions']['existing'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Is it breathable</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_conditions']['breathable'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Is it non-breathable</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_conditions']['non_breathable'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Comment</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_conditions']['comments'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Is there holes in breather membrane
                                                </th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_conditions']['comments'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Is there signs of rot</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_conditions']['comments'] }}</td>
                                            </tr>
                                            @php
                                                $sum2 = 0;
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if (isset($data['rs_roof_conditions']['pictures' . $i]) && trim($data['rs_roof_conditions']['pictures' . $i]) != '') {
                                                        $sum2++;
                                                    }
                                                }
                                            @endphp
                                            <tr class="@if ($sum2 == 0) d-none @endif">
                                                <td style="{{ $style['tbl-padding-img'] }}" colspan="2"
                                                    class="img-padding">
                                                    <h5>Photos</h5>
                                                    <div class="row">
                                                        <div class="masonry-grid">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if (isset($data['rs_roof_conditions']['pictures' . $i]) && trim($data['rs_roof_conditions']['pictures' . $i]) != '')
                                                                    <div>
                                                                        <img class="m-1"
                                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['rs_roof_conditions']['pictures' . $i]) }}"
                                                                            style="border-radius:6px; page-break-inside: avoid !important;">
                                                                    </div>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Is there signs of mould</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_conditions']['signs_of_mould'] }}</td>
                                            </tr>
                                            @php
                                                $sum = 0;
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if (isset($data['rs_roof_conditions']['mould_pictures' . $i]) && trim($data['rs_roof_conditions']['mould_pictures' . $i]) != '') {
                                                        $sum++;
                                                    }
                                                }
                                            @endphp
                                            <tr class="@if ($sum == 0) d-none @endif">
                                                <td style="{{ $style['tbl-padding-img'] }}" colspan="2"
                                                    class="img-padding">
                                                    <h5>Photos</h5>
                                                    <div class="row">
                                                        <div class="masonry-grid">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if (isset($data['rs_roof_conditions']['mould_pictures' . $i]) &&
                                                                        trim($data['rs_roof_conditions']['mould_pictures' . $i]) != '')
                                                                    <div>
                                                                        <img class="m-1"
                                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['rs_roof_conditions']['mould_pictures' . $i]) }}"
                                                                            style="border-radius:6px; page-break-inside: avoid !important;">
                                                                    </div>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">What centres are rafters</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    @if (isset($data['rs_roof_conditions']['rafters']))
                                                        {{ join(', ', json_decode($data['rs_roof_conditions']['rafters'])) }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Other</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_conditions']['other'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            @if (isset($data['rs_roof_ventilation']))
                                <div class="cm">
                                    <h4>Roof Ventilation</h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Are there ventilated ridges</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_ventilation']['ventilated_ridges'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Are there ventilated ridges on hips
                                                </th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_ventilation']['ridges_on_hips'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Are there adequate ventilation at
                                                    soffit</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_ventilation']['soffit'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Has the fascia and soffit been
                                                    fitted</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_ventilation']['fitted'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">If no fascia and soffit is there
                                                    another source of ventilation</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_ventilation']['source_of_ventilation'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">If cold deck is there allowance for
                                                    cross ventilation</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_ventilation']['cross_ventilation'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Can the ridge be adequately
                                                    ventilated</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_ventilation']['adequately_ventilated'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Is the roof counter battened</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_ventilation']['counter_battened'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            @if (isset($data['rs_roof_services']))
                                <div class="cm">
                                    <h4>Roof Services</h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Are there any roof vents for
                                                    services in roof</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_services']['vents_for_services'] }}</td>
                                            </tr>
                                            @php
                                                $sum3 = 0;
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if (isset($data['rs_roof_services']['pictures' . $i]) && trim($data['rs_roof_services']['pictures' . $i]) != '') {
                                                        $sum3++;
                                                    }
                                                }
                                            @endphp
                                            <tr class="@if ($sum3 == 0) d-none @endif">
                                                <td style="{{ $style['tbl-padding-img'] }}" colspan="2"
                                                    class="img-padding">
                                                    <h5>Photos</h5>
                                                    <div class="row">
                                                        <div class="masonry-grid">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if (isset($data['rs_roof_services']['pictures' . $i]) && trim($data['rs_roof_services']['pictures' . $i]) != '')
                                                                    <div>
                                                                        <img class="m-1"
                                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['rs_roof_services']['pictures' . $i]) }}"
                                                                            style="border-radius:6px; page-break-inside: avoid !important;">
                                                                    </div>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Are there any electrical cables in
                                                    roof</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_services']['electical_cables'] }}</td>
                                            </tr>

                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Is there ductwork in roof</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_services']['ductwork'] }}</td>
                                            </tr>
                                            @php
                                                $sum4 = 0;
                                                for ($i = 6; $i <= 10; $i++) {
                                                    if (isset($data['rs_roof_services']['pictures' . $i]) && trim($data['rs_roof_services']['pictures' . $i]) != '') {
                                                        $sum4++;
                                                    }
                                                }
                                            @endphp
                                            <tr class="@if ($sum4 == 0) d-none @endif">
                                                <td style="{{ $style['tbl-padding-img'] }}" colspan="2"
                                                    class="img-padding">
                                                    <h5>Photos</h5>
                                                    <div class="row">
                                                        <div class="masonry-grid">
                                                            @for ($i = 6; $i <= 10; $i++)
                                                                @if (isset($data['rs_roof_services']['pictures' . $i]) && trim($data['rs_roof_services']['pictures' . $i]) != '')
                                                                    <div>
                                                                        <img class="m-1"
                                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['rs_roof_services']['pictures' . $i]) }}"
                                                                            style="border-radius:6px; page-break-inside: avoid !important;">
                                                                    </div>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Comments</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_roof_services']['comments'] }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            @if (isset($data['rs_spray_plan_for_roof']))
                                <div class="cm">
                                    <h4>Spray Plan for Roof</h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Spraying flat roof cold deck</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['cold_deck'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Air sealing flat warm deck</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['warm_deck'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Air sealing perimeter of ceiling
                                                    ground floor</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['ceiling_ground_floor'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Spraying from wall plate to top
                                                    of stud</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['top_of_stud'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Ventcard</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['ventcard1'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Depth</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['depth1'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Does it need to be shaved</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['shaved'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Spraying from top of stud to
                                                    collar</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['stud_to_collar'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Ventcard</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['ventcard2'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Depth</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['depth2'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Does it need to be shaved</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['need_to_be_shaved'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Spraying from top of collar to
                                                    ridge</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['collar_to_ridge'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Ventcard</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['ventcard3'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Depth</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['depth3'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Spraying from wall plate accross
                                                </th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['plate_across'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Ceilling to stud</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['ceiling_to_stud'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Depth</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['depth4'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Spraying back of stud</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['spraying'] }}</td>
                                            </tr>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Depth</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['depth5'] }}</td>
                                            </tr>
                                            @php
                                                $sum5 = 0;
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if (isset($data['rs_spray_plan_for_roof']['pictures' . $i]) && trim($data['rs_spray_plan_for_roof']['pictures' . $i]) != '') {
                                                        $sum5++;
                                                    }
                                                }
                                            @endphp
                                            <tr class="@if ($sum5 == 0) d-none @endif">

                                                <td style="{{ $style['tbl-padding-img'] }}" colspan="2"
                                                    class="img-padding">
                                                    <h5>Photos</h5>
                                                    <div class="row">
                                                        <div class="masonry-grid">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if (isset($data['rs_spray_plan_for_roof']['pictures' . $i]) &&
                                                                        trim($data['rs_spray_plan_for_roof']['pictures' . $i]) != '')
                                                                    <div>
                                                                        <img class="m-1"
                                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['rs_spray_plan_for_roof']['pictures' . $i]) }}"
                                                                            style="border-radius:6px; page-break-inside: avoid !important;">
                                                                    </div>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Comment</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_spray_plan_for_roof']['comments'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            @if (isset($data['rs_coomments_photographs']))
                                <div class="cm">
                                    <h4>Comments & Photographs</h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="{{ $style['tbl-padding'] }}">Additional Comments</th>
                                                <td style="{{ $style['tbl-padding'] }}">
                                                    {{ $data['rs_coomments_photographs']['comments'] }}</td>
                                            </tr>
                                            @php
                                                $sum6 = 0;
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if (isset($data['rs_coomments_photographs']['photos' . $i]) && trim($data['rs_coomments_photographs']['photos' . $i]) != '') {
                                                        $sum6++;
                                                    }
                                                }
                                            @endphp
                                            <tr class="@if ($sum6 == 0) d-none @endif">
                                            <tr>
                                                <td style="{{ $style['tbl-padding-img'] }}" colspan="2"
                                                    class="img-padding">
                                                    <h5>Photos</h5>
                                                    <div class="row">
                                                        <div class="masonry-grid">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if (isset($data['rs_coomments_photographs']['photos' . $i]) &&
                                                                        trim($data['rs_coomments_photographs']['photos' . $i]) != '')
                                                                    <div>
                                                                        <img class="m-1"
                                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['rs_coomments_photographs']['photos' . $i]) }}"
                                                                            style="border-radius:6px; page-break-inside: avoid !important;">
                                                                    </div>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        </div>

                    </div>
                    <div class="mt-2 px-1 py-1 d-flex justify-content-between bg-grasy"
                        style="page-break-inside: avoid !important;">
                        <div class="col-md-6 d-flex" style="justify-content: start;">
                            <div class="">
                                <div class="d-flex">
                                    <h4 class="text-black my-1">Date: </h4>
                                    <h4 class="ml-1 my-1 text-gray">
                                        {{ date('d/m/Y', strtotime($data['date_inspected'])) }}</h4>
                                </div>
                                <div class="d-flex">
                                    <h4 class="text-black my-0">Signed: </h4>
                                    <h4 class="ml-1 my-0 text-black">{{ $data['name'] }}</h4>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6" style="justify-content: end;">
                            @if ($data['signature'])
                                <img class="footer-sign bg-grasy1 img-fluid bg-white float-end"
                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_signature/' . $data['signature']) }}"
                                    width="200">
                            @endif
                        </div>
                    </div>

                </div>


            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rows = document.querySelectorAll('tr');

            rows.forEach(function(row) {
                // Check if the second td exists and is empty
                var secondTd = row.querySelector('td:nth-child(2)');
                if (secondTd && secondTd.textContent.trim() === '') {
                    // If empty, hide the entire tr
                    row.classList.add('d-none');
                }
            });
        });
    </script>
@endsection
