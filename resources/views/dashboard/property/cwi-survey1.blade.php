@extends('layouts.dashboard.app')
@section('content')
    <style>
        .mybody {
            background-color: #eaf1ff !important;
        }

        ol {
            padding-left: 0rem !important;
        }

        .f20 {
            font-size: 20px;
        }

        .f16 {
            font-size: 16px;
        }

        .brright {
            border-right: 1px solid #1A47A3;
        }

        h4 {
            color: #1A47A3 !important;
            padding: unset !important;
            font-size: 14px !important;
            margin-bottom: 0.375rem !important;
            margin-top: unset !important;
        }

        .bg-grasy {
            background: #E0E9FC;
        }

        .bdtl ul li::marker {
            color: #1A47A3 !important;
            font-size: 20px;
        }

        ol>li::marker {
            content: "";
        }

        li {
            /* color: #1A47A3 !important; */
            font-size: 16px;
        }

        .clrYes {
            background: #E4F3EA !important;
            color: #3A9B7A !important;
            padding: 3px 6px 3px 9px;
            border-radius: 36px;
            margin-bottom: 5px;
        }

        .clrNo {
            background: #FDE6E6 !important;
            color: #FF1919 !important;
            padding: 3px 6px 3px 9px;
            border-radius: 36px;
            margin-bottom: 5px;
        }

        li,
        small {
            color: #333;
        }

        .cm {
            margin-top: 16px !important;
            page-break-inside: avoid !important;
        }

        .main-header {
            font-size: 22px !important;
        }

        .main-header-date {
            color: gray;
            font-weight: 500;
        }

        .main-logo {
            width: 100px;
        }

        .f14 {
            font-size: 14px !important;
        }

        .f12 {
            font-size: 12px;
        }

        .bg-grasy h4 {
            font-size: 12px !important;
        }

        .footer-sign {
            height: 120px;
            width: 160px;
        }

        .text-gray {
            color: gray !important;
        }

        h5 {
            font-size: 12px;
            margin: 0 0 4px;
        }

        .lead {
            font-size: 14px !important;
        }

        .f12 {
            font-size: 12px !important;
        }

        .bg-grasy1 {
            background: #fff;
            border: 1px solid lightgray;
        }

        .border-card {
            background-color: #fff !important;
            border: 0.5px solid #1A47A3 !important;
        }
        ul {
            padding-left: 21px;
            margin-bottom: 0 !important;
        }

        .card-body ul>li {
            margin-top: -10px;
        }
        ol {
            margin-bottom: 0 !important;
        }
        ol>li,small {
            font-size: 12px !important;
        }
        ol>li {
            font-weight: 600 !important;
            margin-bottom: 4px !important;
        }
    </style>
    <div class="col-md-12 mt-3 d-flex justify-content-start">
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
                <div class="card-body mybody">
                    <div class="d-flex justify-content-between" style="font-family: Arial">
                        <div style="color: #1A47A3 !important;">
                            <div class="d-flex align-items-end">
                                <h4 class="main-header my-0">{{ $data['report_name'] }}</h4>
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
                        @if (isset($data['ws_building_details']))
                            <div class="cm">
                                <h4 class="f14">Building Details</h4>
                                <div class="col-12 p-1 bdtl bg-gray">
                                    <?php
                                    
                                    function clean($string)
                                    {
                                        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                                        return preg_replace('/[^A-Za-z0-9, \-]/', '', $string); // Removes special chars.
                                    }
                                    
                                    $building_details = explode(',', clean($data['ws_building_details']['appropriate_tick_box']));
                                    
                                    ?>

                                    <ul>
                                        @foreach ($building_details as $detail)
                                            <li class="f12">{{ $detail }}</li>
                                        @endforeach
                                    </ul>
                                    
                                    @if (in_array('Other', $building_details))
                                        <p class="mb-0 f12">
                                            {{ $data['ws_building_details']['others_data'] }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if (isset($data['ws_Additional_property_detail']))
                            <div class="cm">
                                <h4 class="f14">Additional property detail</h4>
                                <div class="col-12 p-1 bg-gray">
                                    <p class="mb-0 f12">
                                        {{ isset($data['ws_Additional_property_detail']['additional_note']) ? $data['ws_Additional_property_detail']['additional_note'] : '--' }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if (isset($data['ws_building_type']))
                            <div class="cm">
                                <h4>Building Type</h4>
                                <div class="col-12 p-1 bg-gray">
                                    <ol class="f12">
                                        <li>External walls examined with borescope</li>
                                        <small>{{ isset($data['ws_building_type']['examined_with_borescope']) ? $data['ws_building_type']['examined_with_borescope'] : '-' }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Cavity Type</li>
                                        <small>{{ isset($data['ws_building_type']['cavity_type']) ? $data['ws_building_type']['cavity_type'] : '-' }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>No. of holes drilled</li>
                                        <small>{{ isset($data['ws_building_type']['no_of_holes_drilled']) ? $data['ws_building_type']['no_of_holes_drilled'] : '-' }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Cavity widths</li>
                                        <small>{{ isset($data['ws_building_type']['cavity_widths']) ? $data['ws_building_type']['cavity_widths'] : '-' }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Notes on cavity</li>
                                        <small>{{ isset($data['ws_building_type']['notes_on_cavity']) ? $data['ws_building_type']['notes_on_cavity'] : '-' }}</small>
                                    </ol>
                                </div>
                            </div>
                        @endif

                        @if (isset($data['ws_condition_of_outer_leaf']))
                            <div class="cm">
                                <h4>Condition of outer leaf</h4>
                                <div class="col-12 p-1 bg-gray">
                                    <ol>
                                        <li>Is it in good condition</li>
                                        <small>{{ $data['ws_condition_of_outer_leaf']['good_condition'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Render free from cracks/gaps/holes</li>
                                        <small>{{ $data['ws_condition_of_outer_leaf']['cracks_gaps_holes'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Is brick jointing good</li>
                                        <small>{{ $data['ws_condition_of_outer_leaf']['jointing_good'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are the cracks running vertically</li>
                                        <small>{{ $data['ws_condition_of_outer_leaf']['running_vertically'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are the cracks running horizontally</li>
                                        <small>{{ $data['ws_condition_of_outer_leaf']['running_horizontally'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are movement joints sealed</li>
                                        <small>{{ $data['ws_condition_of_outer_leaf']['joints_sealed'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Weep holes to linters</li>
                                        <small>{{ $data['ws_condition_of_outer_leaf']['weep_holes_to_linters'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Have sills adequate drip</li>
                                        <small>{{ $data['ws_condition_of_outer_leaf']['have_sills_adequate_drip'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Notes</li>
                                        <small>{{ $data['ws_condition_of_outer_leaf']['notes'] }}</small>
                                    </ol>
                                </div>
                            </div>
                        @endif

                        @if (isset($data['ws_condition_of_inner_leaf']))
                            <div class="cm">
                                <h4>Condition of inner leaf</h4>
                                <div class="col-12 p-1 bg-gray">
                                    <ol>
                                        <li>Internal plaster free from cracks</li>
                                        <small>{{ $data['ws_condition_of_inner_leaf']['cracks'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are the holes around the services sealed</li>
                                        <small>{{ $data['ws_condition_of_inner_leaf']['services_sealed'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are roofs of bay windows airtight</li>
                                        <small>{{ $data['ws_condition_of_inner_leaf']['airtight'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Is there any sign of dampness</li>
                                        <small>{{ $data['ws_condition_of_inner_leaf']['dampness'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are slabs dobbed</li>
                                        <small>{{ $data['ws_condition_of_inner_leaf']['slabs_dobbed'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are conduits sealed</li>
                                        <small>{{ $data['ws_condition_of_inner_leaf']['conduits_sealed'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are gables to be fitted</li>
                                        <small>{{ $data['ws_condition_of_inner_leaf']['gables_to_be_fitted'] }}</small>
                                    </ol>
                                </div>
                            </div>
                        @endif

                        @if (isset($data['ws_insulation_present_in_cavity']))
                            <div class="cm">
                                <h4>Insulation Present in Cavity</h4>
                                <div class="col-12 p-1 bg-gray">
                                    <ol>
                                        <li>EPS White</li>
                                        <small>{{ $data['ws_insulation_present_in_cavity']['eps_white'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>EPS Silver</li>
                                        <small>{{ $data['ws_insulation_present_in_cavity']['eps_silver'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Pir Board</li>
                                        <small>{{ $data['ws_insulation_present_in_cavity']['pir_board'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Mineral Board</li>
                                        <small>{{ $data['ws_insulation_present_in_cavity']['mineral_board'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Fsell Fill</li>
                                        <small>{{ $data['ws_insulation_present_in_cavity']['fsell_fill'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Condition of insulation Present</li>
                                        <small>{{ $data['ws_insulation_present_in_cavity']['condition_of_insulation_present'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are the boards overlapping</li>
                                        <small>{{ $data['ws_insulation_present_in_cavity']['boards_overlapping'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Does Insulation bridge the cavity</li>
                                        <small>{{ $data['ws_insulation_present_in_cavity']['insulation_bridge_the_cavity'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>DPC free from significant mortar</li>
                                        <small>{{ $data['ws_insulation_present_in_cavity']['significant_mortar'] }}</small>
                                    </ol>
                                </div>
                            </div>
                        @endif

                        @if (isset($data['ws_new_build_cavity']))
                            <div class="cm">
                                <h4>New build cavity</h4>
                                <div class="col-12 p-1 bg-gray">
                                    <ol>
                                        <li>Are wall ties free from mortar</li>
                                        <small>{{ $data['ws_new_build_cavity']['wall_ties_free_from_mortar'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are details adequate</li>
                                        <small>{{ $data['ws_new_build_cavity']['window_details_adequate'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        @php
                                            $sum = 0;
                                            for ($i = 1; $i <= 5; $i++) {
                                                if (isset($data['ws_new_build_cavity']['pictures' . $i]) && trim($data['ws_new_build_cavity']['pictures' . $i]) != '') {
                                                    $sum++;
                                                }
                                            }
                                        @endphp
                                        <li class="mt-1 @if ($sum == 0) d-none @endif">Photos</li>
                                        <div
                                            class="row bg-messi mx-0 @if ($sum == 0) d-none @endif">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if (isset($data['ws_new_build_cavity']['pictures' . $i]) && trim($data['ws_new_build_cavity']['pictures' . $i]) != '')
                                                    <div class="col-sm-12 col-md-4 col-lg-4 py-0 px-0 d-flex justify-content-start"
                                                        style="max-width:fit-content;">
                                                        <img class="me-1 mb-1 img-fluid"
                                                            style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;"
                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['ws_new_build_cavity']['pictures' . $i]) }}">
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="@if ($sum == 0) d-none @endif"
                                            style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Comment</li>
                                        <small>{{ $data['ws_new_build_cavity']['comments'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Is wall plate open</li>
                                        <small>{{ $data['ws_new_build_cavity']['plate_open'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are DPCs in correct position</li>
                                        <small>{{ $data['ws_new_build_cavity']['correct_position'] }}</small>
                                    </ol>
                                </div>
                            </div>
                        @endif

                        @if (isset($data['ws_services_in_the_cavity']))
                            <div class="cm">
                                <h4>Services in the cavity</h4>
                                <div class="col-12 p-1 bg-gray">
                                    <ol>
                                        <li>Are there any piped in the cavity</li>
                                        <small>{{ $data['ws_services_in_the_cavity']['pipes_in_the_cavity'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        @php
                                            $sum2 = 0;
                                            for ($i = 1; $i <= 5; $i++) {
                                                if (isset($data['ws_services_in_the_cavity']['pictures' . $i]) && trim($data['ws_services_in_the_cavity']['pictures' . $i]) != '') {
                                                    $sum2++;
                                                }
                                            }
                                        @endphp
                                        <li class="@if ($sum2 == 0) d-none @endif">Photos</li>
                                        <div
                                            class="row bg-messi mx-0 @if ($sum2 == 0) d-none @endif">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if (isset($data['ws_services_in_the_cavity']['pictures' . $i]) &&
                                                        trim($data['ws_services_in_the_cavity']['pictures' . $i]) != '')
                                                    <div class="col-sm-12 col-md-4 col-lg-4 py-0 px-0 d-flex justify-content-start"
                                                        style="max-width:fit-content;">
                                                        <img class="me-1 mb-1 img-fluid"
                                                            style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;"
                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['ws_services_in_the_cavity']['pictures' . $i]) }}">
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="@if ($sum2 == 0) d-none @endif"
                                            style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are there any faces crossing the cavity</li>
                                        <small>{{ $data['ws_services_in_the_cavity']['crossing_the_cavity'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are the roofs of the bay windows airtight</li>
                                        <small>{{ $data['ws_services_in_the_cavity']['windows_airtight'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are there electrical cables in the cavity</li>
                                        <small>{{ $data['ws_services_in_the_cavity']['cables_in_the_cavity'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are the flues isolated from the cavity</li>
                                        <small>{{ $data['ws_services_in_the_cavity']['isolated_from_the_cavity'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Additional Comments</li>
                                        <small>{{ $data['ws_services_in_the_cavity']['additional_comments'] }}</small>
                                    </ol>
                                </div>
                            </div>
                        @endif

                        @if (isset($data['ws_ventilation_through_the_cavity']))
                            <div class="cm">
                                <h4>Ventilation through the cavity</h4>
                                <div class="col-12 p-1 bg-gray">
                                    <ol>
                                        <li>Are there vents to suspended floors</li>
                                        <small>{{ $data['ws_ventilation_through_the_cavity']['suspended_floors'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are vents sleeved</li>
                                        <small>{{ $data['ws_ventilation_through_the_cavity']['vents_sleeved'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Comment</li>
                                        <small>{{ $data['ws_ventilation_through_the_cavity']['comment'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Are Cores needed</li>
                                        <small>{{ $data['ws_ventilation_through_the_cavity']['cores_need'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>How many</li>
                                        <small>{{ $data['ws_ventilation_through_the_cavity']['how_many'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Types of vents needed</li>
                                        <small>{{ $data['ws_ventilation_through_the_cavity']['types_of_vents_need'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Is there adequate ventilation in rooms with burning appliances</li>
                                        <small>{{ $data['ws_ventilation_through_the_cavity']['burning_appliances'] }}</small>
                                        <div style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        @php
                                            $sum3 = 0;
                                            for ($i = 1; $i <= 5; $i++) {
                                                if (isset($data['ws_ventilation_through_the_cavity']['pictures' . $i]) && trim($data['ws_ventilation_through_the_cavity']['pictures' . $i]) != '') {
                                                    $sum3++;
                                                }
                                            }
                                        @endphp
                                        <li class="@if ($sum3 == 0) d-none @endif">Photos</li>
                                        <div
                                            class="row bg-messi mx-0 @if ($sum3 == 0) d-none @endif">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if (isset($data['ws_ventilation_through_the_cavity']['pictures' . $i]) &&
                                                        trim($data['ws_ventilation_through_the_cavity']['pictures' . $i]) != '')
                                                    <div class="col-sm-12 col-md-4 col-lg-4 py-0 px-0 d-flex justify-content-start"
                                                        style="max-width:fit-content;">
                                                        <img class="me-1 mb-1 img-fluid"
                                                            style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;"
                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['ws_ventilation_through_the_cavity']['pictures' . $i]) }}">
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="@if ($sum3 == 0) d-none @endif"
                                            style="border-bottom: 1px solid #e0e9fc;margin-top:5px"></div>
                                        <li>Notes</li>
                                        <small>{{ isset($data['ws_ventilation_through_the_cavity']['notes']) ? $data['ws_ventilation_through_the_cavity']['notes'] : '' }}</small>
                                    </ol>
                                </div>
                            </div>
                        @endif
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


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all <ol> elements
            var orderedLists = document.querySelectorAll('ol');

            orderedLists.forEach(function(ol) {
                // Find all <small> elements within the <ol>
                var smallTags = ol.querySelectorAll('small');

                smallTags.forEach(function(small, index) {
                    // Get the trimmed text content of the <small> element
                    var smallText = small.textContent.trim();

                    // Check if <small> has no visible text content
                    if (!smallText) {
                        small.textContent = '--'; // Set content to "--"

                        // Find the closest previous <li> and <div> elements
                        var previousLi = small.previousElementSibling;
                        var previousDiv = small.previousElementSibling.previousElementSibling;

                        // Add "d-none" class to hide elements
                        if (previousLi && previousDiv) {
                            previousLi.classList.add('d-none');
                            previousDiv.classList.add('d-none');
                            small.classList.add('d-none');
                        }
                    }
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Check for <ol> elements
            var orderedLists = document.querySelectorAll('ol');

            orderedLists.forEach(function(ol) {
                // Check all <small> elements inside the <ol>
                var smallTags = ol.querySelectorAll('small');

                smallTags.forEach(function(smallTag) {
                    // Get the text content of the <small> element
                    var smallText = smallTag.textContent.trim().toLowerCase();

                    // Add appropriate class based on the small text content
                    if (smallText === 'yes') {
                        smallTag.classList.add('clrYes');
                    } else if (smallText === 'no') {
                        smallTag.classList.add('clrNo');
                    }
                });
            });
        });
    </script>
@endsection