@extends('layouts.dashboard.print')
@section('content')
    <style>
        .mybody {
            background-color: #eaf1ff !important;
        }

        table tr,
        h5,
        tr.text-info {
            color: #333 !important;
        }

        .bg-messi {
            position: relative;
            top: 0;
            border-top-right-radius: 0px !important;
            border-top-left-radius: 0px !important;
            outline: 0.5px solid #1A47A3 !important;
            border: unset !important;
            background: #fff !important;
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
            border-color: #eaf1ff !important;
        }

        .bg-grasy {
            background: #fff;
        }

        .bg-grasy1 {
            background: #fff;
            border: 1px solid lightgray;
        }

        h4 {
            color: #1A47A3;
            margin-top: 20px !important;
            font-size: 14px !important;
        }

        .mybody table>tbody>tr>th {
            border-right: 1px solid #eaf1ff !important;
        }

        .mybody table>tbody>tr>th,
        .mybody table>tbody>tr>td {
            font-size: 12px !important;
            padding-block: 1px !important;
            padding-inline: 8px !important;
        }

        h5 {
            font-size: 12px;
            margin: 0 0 10px;
        }
    </style>
    @php
        $style['tbl-padding'] = 'font-size: 12px; padding: 1px 8px !important;width: 50%;';
        $style['tbl-padding-30'] = 'font-size: 12px; padding: 1px 8px !important;width: 30%;';
        $style['tbl-padding-25'] = 'font-size: 12px; padding: 1px 8px !important;width: 25%;';
        $style['tbl-padding-5'] = 'font-size: 12px; padding: 1px 8px !important;width: 5%;';
        $style['tbl-padding-60'] = 'font-size: 12px; padding: 1px 8px !important;width: 60%;';
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="">
                <div class="">
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
                    @if (isset($data['build_details']) && $data['build_details'] != null)
                        <div class="cm">
                            <h4 class=" mb-1 mt-0">BUILDING DETAILS</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <?php
                                    $types = str_replace('["', '', isset($data['build_details']['appropriate_tick_box']) ? $data['build_details']['appropriate_tick_box'] : '');
                                    $types = str_replace('","', ' ', $types);
                                    $types = str_replace('"]', '', $types);
                                    $types = str_replace('",', '', $types);
                                    $types = str_replace('"', ' ', $types);
                                    ?>
                                    <th style="{{ $style['tbl-padding'] }}">Type</th>
                                    <td style="{{ $style['tbl-padding'] }}">{{ $types }}</td>
                                </tr>
                                <tr>

                                    <th style="{{ $style['tbl-padding'] }}">Other</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['build_details']['others_data']) ? $data['build_details']['others_data'] : '' }}
                                    </td>
                                </tr>
                            </table>

                            @if (
                                (isset($data['build_details']['image1']) && trim($data['build_details']['image1']) != '') ||
                                    (isset($data['build_details']['image2']) && trim($data['build_details']['image2']) != '') ||
                                    (isset($data['build_details']['image3']) && trim($data['build_details']['image3']) != '') ||
                                    (isset($data['build_details']['image4']) && trim($data['build_details']['image4']) != '') ||
                                    (isset($data['build_details']['image5']) && trim($data['build_details']['image5']) != ''))
                                <div class="bg-messi mx-0 p-1" style="page-break-inside: avoid !important;">
                                    <h5>Photos</h5>
                                    <div class="masonry-grid">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if (isset($data['build_details']['image' . $i]) && trim($data['build_details']['image' . $i]) != '')
                                                <div>
                                                    <img class="mb-1 img-fluid"
                                                        style="border-radius:6px; page-break-inside: avoid !important;"
                                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['build_details']['image' . $i]) }}">
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endif

                    @if (isset($data['addtitional_building_detail']))

                        <div class="cm">
                            <h4 class=" mb-1 mt-0">ADDITIONAL BUILDING DETAILS</h4>

                            <table class="table table-bordered">
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['addtitional_building_detail']) ? $data['addtitional_building_detail']['additional_note'] : '' }}
                                    </td>
                                </tr>
                            </table>


                            @if (
                                (isset($data['addtitional_building_detail']['image1']) &&
                                    trim($data['addtitional_building_detail']['image1']) != '') ||
                                    (isset($data['addtitional_building_detail']['image2']) &&
                                        trim($data['addtitional_building_detail']['image2']) != '') ||
                                    (isset($data['addtitional_building_detail']['image3']) &&
                                        trim($data['addtitional_building_detail']['image3']) != '') ||
                                    (isset($data['addtitional_building_detail']['image4']) &&
                                        trim($data['addtitional_building_detail']['image4']) != '') ||
                                    (isset($data['addtitional_building_detail']['image5']) &&
                                        trim($data['addtitional_building_detail']['image5']) != ''))
                                <div class="bg-messi mx-0 p-1" style="page-break-inside: avoid !important;">
                                    <div class="col-sm-12">
                                        <h5>Photos</h5>
                                        <div class="masonry-grid">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if (isset($data['addtitional_building_detail']['image' . $i]) &&
                                                        trim($data['addtitional_building_detail']['image' . $i]) != '')
                                                    <div>
                                                        <img class="mb-1 img-fluid"
                                                            style="border-radius:6px; page-break-inside: avoid !important;"
                                                            src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['addtitional_building_detail']['image' . $i]) }}">
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                    @endif


                    @if (isset($data['wall_insulation']))
                        <div class="cm">
                            <h4 class=" mb-1 mt-0">WALL INSULATION</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Wall Insulation</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? implode(', ', json_decode($data['wall_insulation']['wall_insulation_tick'])) : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Other</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['all_insulation_other'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">No. of storeys</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['no_of_storeys'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Measure of outer walls</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['measure_of_outer_walls'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Age of house</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['age_of_house'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Construction of walls</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['construction_of_walls'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Rendered or protected areas</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? implode(', ', json_decode($data['wall_insulation']['rendered_or_protected_areas'])) : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Other</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['areas_other'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Colour</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['colour'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Is there any evidence of the following:
                                        Cracking, Defective Mortar, Damaged Rendering, Spalled Bricks, Discharge of
                                        Water
                                        from Building Features?
                                    </th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['building_features'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">If yes give details details</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['building_features_details'] : '' }}
                                    </td>
                                </tr>

                                <tr class="text-info">
                                    <th style="{{ $style['tbl-padding'] }}">Cavity Bead Qty</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['cavity_bead_quantity'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Remarks</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['cavity_bead_remarks'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Currency Amount</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['cavity_bead_amount'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Comments</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['cavity_bead_comments'] : '' }}
                                    </td>
                                </tr>


                                <tr class="text-info">
                                    <th style="{{ $style['tbl-padding'] }}">Cavity Block Foam Qty</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['cavity_block_quantity'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Remarks</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['cavity_block_remarks'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Currency Amount</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['cavity_block_amount'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Comments</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['cavity_block_comments'] : '' }}
                                    </td>
                                </tr>


                                <tr class="text-info">
                                    <th style="{{ $style['tbl-padding'] }}">Drylining Qty</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['drylining_quantity'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Remarks</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['drylining_remarks'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Currency Amount</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['drylining_amount'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Comments</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['drylining_comments'] : '' }}
                                    </td>
                                </tr>


                                <tr class="text-info">
                                    <th style="{{ $style['tbl-padding'] }}">External Wrap Qty</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['external_wrap_quantity'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Remarks</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['external_wrap_remarks'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Currency Amount</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['external_wrap_amount'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Comments</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['external_wrap_comments'] : '' }}
                                    </td>
                                </tr>


                                <tr class="text-info">
                                    <th style="{{ $style['tbl-padding'] }}">Core Vents Required Qty</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['core_vents_quantity'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Remarks</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['core_vents_remarks'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Currency Amount</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['core_vents_amount'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Comments</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['core_vents_comments'] : '' }}
                                    </td>
                                </tr>


                                <tr class="text-info">
                                    <th style="{{ $style['tbl-padding'] }}">Window Vents Qty</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['window_vents_quantity'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Remarks</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['window_vents_remarks'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Currency Amount</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['window_vents_amount'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Comments</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['wall_insulation']) ? $data['wall_insulation']['window_vents_comments'] : '' }}
                                    </td>
                                </tr>
                            </table>
                            @php
                                $sum7 = 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    if (isset($data['wall_insulation']['image' . $i]) && trim($data['wall_insulation']['image' . $i]) != '') {
                                        $sum7++;
                                    }
                                }
                            @endphp
                            <div class="bg-messi mx-0 p-1 @if ($sum7 == 0) d-none @endif"
                                style="page-break-inside: avoid !important;">
                                <h5>Photos</h5>
                                <div class="masonry-grid">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if (isset($data['wall_insulation']['image' . $i]) && trim($data['wall_insulation']['image' . $i]) != '')
                                            <div>
                                                <img class="mb-1 img-fluid"
                                                    style="border-radius:6px; page-break-inside: avoid !important;"
                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['wall_insulation']['image' . $i]) }}">
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (sizeOf($data['internal_insulation']))
                        <div class="cm">
                            <h4 class=" mb-1 mt-0">INTERNAL</h4>

                            <?php $room = '';
                            // dd($data['internal_insulation']);
                            ?>

                            @foreach ($data['internal_insulation'] as $internal_insulation)
                                @if (
                                    (isset($internal_insulation['image1']) && trim($internal_insulation['image1']) != '') ||
                                        (isset($internal_insulation['image2']) && trim($internal_insulation['image2']) != '') ||
                                        (isset($internal_insulation['image3']) && trim($internal_insulation['image3']) != '') ||
                                        (isset($internal_insulation['image4']) && trim($internal_insulation['image4']) != '') ||
                                        (isset($internal_insulation['image5']) && trim($internal_insulation['image5']) != '') ||
                                        (isset($internal_insulation['image6']) && trim($internal_insulation['image6']) != '') ||
                                        (isset($internal_insulation['image7']) && trim($internal_insulation['image7']) != '') ||
                                        (isset($internal_insulation['image8']) && trim($internal_insulation['image8']) != '') ||
                                        (isset($internal_insulation['image9']) && trim($internal_insulation['image9']) != ''))
                                    <div>
                                        @if ($internal_insulation['room'] != $room)
                                            <?php $room = $internal_insulation['room']; ?>
                                            <h5 class="text-info">
                                                {{ $room }}
                                            </h5>
                                        @endif

                                        <table class="table table-bordered">

                                            @if (isset($internal_insulation['section']) && trim($internal_insulation['section']) != '')
                                                <tr>
                                                    <th style="{{ $style['tbl-padding'] }}">Section</th>
                                                    <td style="{{ $style['tbl-padding'] }}">
                                                        {{ $internal_insulation['section'] }}</td>
                                                </tr>
                                            @endif

                                            @if (isset($internal_insulation['comment']) && trim($internal_insulation['comment']) != '')
                                                <tr>
                                                    <th style="{{ $style['tbl-padding'] }}">Comment</th>
                                                    <td style="{{ $style['tbl-padding'] }}">
                                                        {{ $internal_insulation['comment'] }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                        <div class="bg-messi mx-0 p-1" style="page-break-inside: avoid !important;">
                                            <h5>Photos</h5>
                                            <div class="masonry-grid">
                                                @for ($i = 1; $i < 10; $i++)
                                                    @if (isset($internal_insulation['image' . $i]) && trim($internal_insulation['image' . $i]) != '')
                                                        <div>
                                                            <div>
                                                                <img src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $internal_insulation['image' . $i]) }}"
                                                                    class="mb-1 img-fluid"
                                                                    style="border-radius:6px; page-break-inside: avoid !important;">
                                                            </div>
                                                            @if (isset($internal_insulation['imagecomment' . $i]) && trim($internal_insulation['imagecomment' . $i]) != '')
                                                                <small>{{ $internal_insulation['imagecomment' . $i] }}</small>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    @if (isset($data['external_insulation1']))
                        <div class="cm">
                            <h4 class=" mb-1 mt-0">EXTERNAL INSULATION 1</h4>
                            <table class="table table-bordered">
                                @if ($data['external_insulation1']['house_type'] != '[]')
                                    <tr>
                                        <th style="{{ $style['tbl-padding-30'] }}" style="{{ $style['tbl-padding'] }}">
                                            House Type</-25th>
                                        <?php
                                        $types = str_replace('["', '', isset($data['external_insulation1']) ? $data['external_insulation1']['house_type'] : '');
                                        $types = str_replace('","', ' ', $types);
                                        $types = str_replace('"]', '', $types);
                                        $types = str_replace('",', '', $types);
                                        $types = str_replace('"', ' ', $types);
                                        ?>
                                        <td style="{{ $style['tbl-padding'] }}" style="{{ $style['tbl-padding'] }}"
                                            colspan="3">{{ $types }}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Wall type (1)</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['wall_type1'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Wall width (1)</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['wall_width1'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Wall type (2)</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['wall_type2'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Wall width (2)</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['wall_width2'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Render type (1)</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['render_type1'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Condition (1)</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['condition1'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Render type (2)</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['render_type2'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Condition (2)</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['condition2'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Year Constructed</th>
                                    <td style="{{ $style['tbl-padding-25'] }}"></td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Original Cwelling</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['wall_type1'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Extension (1)</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['extension1'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Extension (2)</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['extension2'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Over Chill Required</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['over_cill_required'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Eve Trims Required</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['eve_trims_required'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Eve Vents No. - Maintain/Installed</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['eve_vents_no_maintain_installed'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding-25'] }}" colspan="3">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['notes1'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Wall Vents No. - Maintain/Installed</th>
                                    <td style="{{ $style['tbl-padding-5'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['wall_vents_no_maintain_installed'] : '' }}
                                    </td>
                                    <th style="{{ $style['tbl-padding-5'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding-60'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['notes2'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Plinth Vents No. - Maintain/Installed</th>
                                    <td style="{{ $style['tbl-padding-5'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['plinth_vents_no_maintain_installed'] : '' }}
                                    </td>
                                    <th style="{{ $style['tbl-padding-5'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding-60'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['notes3'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">ESB Vents No. - Maintain/Installed</th>
                                    <td style="{{ $style['tbl-padding-5'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['esb_vents_no_maintain_installed'] : '' }}
                                    </td>
                                    <th style="{{ $style['tbl-padding-5'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding-60'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['notes4'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Flue Vents No. - Maintain/Installed</th>
                                    <td style="{{ $style['tbl-padding-5'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['flue_vents_no_maintain_installed'] : '' }}
                                    </td>
                                    <th style="{{ $style['tbl-padding-5'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding-60'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['notes5'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Down pipes refitted replace</th>
                                    <td style="{{ $style['tbl-padding-5'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['down_pipes_refitted_replace'] : '' }}
                                    </td>
                                    <th style="{{ $style['tbl-padding-5'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding-60'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['notes6'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Fence gates refitted replace</th>
                                    <td style="{{ $style['tbl-padding-5'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['fense_gates_refitted_replace'] : '' }}
                                    </td>
                                    <th style="{{ $style['tbl-padding-5'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding-60'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['notes7'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Telecom cables re clipped in conduit</th>
                                    <td style="{{ $style['tbl-padding-5'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['telecom_cables_re_clipped_in_conduit'] : '' }}
                                    </td>
                                    <th style="{{ $style['tbl-padding-5'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding-60'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['notes8'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Alarm box reinstated refitted</th>
                                    <td style="{{ $style['tbl-padding-5'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['alarm_box_reinstated_refitted'] : '' }}
                                    </td>
                                    <th style="{{ $style['tbl-padding-5'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding-60'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['notes9'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Satelite dish maintain installed</th>
                                    <td style="{{ $style['tbl-padding-5'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['satelite_dish_maintain_installed'] : '' }}
                                    </td>
                                    <th style="{{ $style['tbl-padding-5'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding-60'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['notes10'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Hanging basket reinstated refitted</th>
                                    <td style="{{ $style['tbl-padding-5'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['hanging_basket_reinstated_refitted'] : '' }}
                                    </td>
                                    <th style="{{ $style['tbl-padding-5'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding-60'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['notes11'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding-30'] }}">Wall trellis reinstated refitted</th>
                                    <td style="{{ $style['tbl-padding-5'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['wall_trellis_reinstated_refitted'] : '' }}
                                    </td>
                                    <th style="{{ $style['tbl-padding-5'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding-60'] }}">
                                        {{ isset($data['external_insulation1']) ? $data['external_insulation1']['notes12'] : '' }}
                                    </td>
                                </tr>
                            </table>
                            @php
                                $sum = 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    if (isset($data['external_insulation1']['image' . $i]) && trim($data['external_insulation1']['image' . $i]) != '') {
                                        $sum++;
                                    }
                                }
                            @endphp
                            <div class="bg-messi mx-0 p-1 @if ($sum == 0) d-none @endif"
                                style="page-break-inside: avoid !important;">
                                <h5>Photos</h5>
                                <div class="masonry-grid">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if (isset($data['external_insulation1']['image' . $i]) && trim($data['external_insulation1']['image' . $i]) != '')
                                            <div>
                                                <img class="mb-1 img-fluid"
                                                    style="border-radius:6px; page-break-inside: avoid !important;"
                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['external_insulation1']['image' . $i]) }}">
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($data['external_insulation2']))
                        <div class="cm">
                            <h4 class=" mb-1 mt-0">EXTERNAL INSULATION 2</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Insulation Type & Depth</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['insulation_type_depth'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Finish render type requested</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['finish_render_type_requested'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Finish reveal type_ requested</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['finish_reveal_type_requested'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Wall width 2</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['wall_width2'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Health safety issues access issues</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['health_safety_issues_access_issues'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Fire barriers vertical horizonta</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['fire_barriers_vertical_horizontal'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Fire sepration requirements at boundary</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['fire_sepration_requirements_at_betoiic'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Exposure to heat barbeque bonfire</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['exposure_to_heat_barbeque_bonfire'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Abutments boundary wall treatments</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['abutments_boundary_wall_treatments'] : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Confirm existing wall insulation</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['confirm_existing_wall_insulation'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Confirm finished floor dpc level</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['confirm_finished_floor_dpc_level'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Evidense_of_exception_dampness_in_or_on_walls
                                    </th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['evidense_of_exception_dampness_in_or_on_walls'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Plant growth or fungi on wall surfaces</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['plant_growth_or_fungi_on_wall_surfaces'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Insulation Type & Depth</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['adequency_of_root_overhangs'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Adequency of root overhangs</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['decorative_features_on_wall_surface'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Cill reveal threshold condition</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['cill_reveal_threshold_condition'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Surface render paint condition</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['surface_render_paint_condition'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Details of abutting roofs</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['details_of_abutting_roofs'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Esb gas telecoms cables if applicable</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['esb_gas_telecoms_cables_if_applicable'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Treatments to cavity hollow block wall cavity
                                        closer</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['treatments_to_cavity_hollow_block_wall_cavity_closer'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Existing cracks</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['existing_cracks'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Existing render defects</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['existing_render_defects'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Other exceptional items</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['other_exceptional_items'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Walls</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['walls'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Floor</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['floor'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Attics</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['attics'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Planning permission if applicable consult pw
                                        hermal building solutions</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['planning_permission_if_applicable_consult_pw_thermal_building_so'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Chimneys and flues</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['chimneys_and_flues'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Structure fixing awnings clothes lines</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['structure_fixing_awnings_clothes_lines'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Earth rod boxes</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['earth_rod_boxes'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Other items of concern</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['external_insulation2']) ? $data['external_insulation2']['other_items_of_concern'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Front elevations</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        @if (isset($data['external_insulation2']['front_elevations']) &&
                                                trim($data['external_insulation2']['front_elevations']) != '')
                                            <img alt=""
                                                src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['external_insulation2']['front_elevations']) }}"
                                                style="max-height: 150px;border-radius:6px;">
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            @php
                                $sum2 = 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    if (isset($data['external_insulation2']['image' . $i]) && trim($data['external_insulation2']['image' . $i]) != '') {
                                        $sum2++;
                                    }
                                }
                            @endphp
                            <div class="bg-messi mx-0 p-1 @if ($sum2 == 0) d-none @endif"
                                style="page-break-inside: avoid !important;">
                                <h5>Photos</h5>
                                <div class="masonry-grid">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if (isset($data['external_insulation2']['image' . $i]) && trim($data['external_insulation2']['image' . $i]) != '')
                                            <div>
                                                <img class="mb-1 img-fluid"
                                                    style="border-radius:6px; page-break-inside: avoid !important;"
                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['external_insulation2']['image' . $i]) }}">
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($data['attic_insulation']))
                        <div class="cm">
                            <h4 class=" mb-1 mt-0">ATTIC</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Gas Boiler Existing System</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['attic_floor_4'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Earthwool insulation to attic floor 4</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['attic_floor_4'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Earthwool insulation to attic floor 8</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['attic_floor_8'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Earthwool insulation to attic floor 12</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['attic_floor_12'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Overall Comment</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['attic_floor_comment'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Foamlok (sprayfoam open cell card system
                                        between rafters - Specify 400m or 600m
                                        card
                                        size) 5-6
                                    </th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['foamlok_5_6'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Overall comment</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['foamlok_comment'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">BASF Walltite Qty</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['basf_walltite_qty'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Overall comment</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['basf_walltite_comment'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Retro-Roof Sprayfoam Insulation (strip open,
                                        clear-out, sprayfoam for
                                        airtightness,
                                        refit/reseal roof) Qty
                                    </th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['retro_roof_sprayfoam_qty'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Overall comment</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['retro_roof_sprayfoam_comment'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Soffit Vents Qty</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['soffit_vents_qty'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Overall comment</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['soffit_vents_comment'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Roof Tile Vents</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['roof_tile_vents_qty'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Overall comment</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['roof_tile_vents_qty'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Wooden Attic Ladder with Hood Qty</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['wooden_attic_ladder_with_hood_qty'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Overall comment</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['wooden_attic_ladder_with_hood_comment'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Remove Existing Floor Qty</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['remove_existing_floor_qty'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Overall comment</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['remove_existing_floor_comment'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Raised Floor Space Qty</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['raised_floor_space_qty'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Overall comment</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['raised_floor_space_comment'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Attic Light Qty</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['attic_light_qty'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Overall comment</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['attic_insulation']) ? $data['attic_insulation']['attic_light_comment'] : '' }}
                                    </td>
                                </tr>
                            </table>
                            @php
                                $sum3 = 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    if (isset($data['attic_insulation']['image' . $i]) && trim($data['attic_insulation']['image' . $i]) != '') {
                                        $sum3++;
                                    }
                                }
                            @endphp
                            <div class="bg-messi mx-0 p-1 @if ($sum3 == 0) d-none @endif"
                                style="page-break-inside: avoid !important;">
                                <h5>Photos</h5>
                                <div class="masonry-grid">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if (isset($data['attic_insulation']['image' . $i]) && trim($data['attic_insulation']['image' . $i]) != '')
                                            <div>
                                                <img class="mb-1 img-fluid"
                                                    style="border-radius:6px; page-break-inside: avoid !important;"
                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['attic_insulation']['image' . $i]) }}">
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($data['heating_upgrade']))
                        <div class="cm">
                            <h4 class=" mb-1 mt-0">HEATING UPGRADE</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Gas Boiler Existing System</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['heating_upgrade']) ? $data['heating_upgrade']['existing_system'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Remarks</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['heating_upgrade']) ? $data['heating_upgrade']['remarks'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Subtotal</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['heating_upgrade']) ? $data['heating_upgrade']['subtotal'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Vat 13.5%</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['heating_upgrade']) ? $data['heating_upgrade']['vat'] : '' }}</td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Price</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['heating_upgrade']) ? $data['heating_upgrade']['price'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['heating_upgrade']) ? $data['heating_upgrade']['additional_notes'] : '' }}
                                    </td>
                                </tr>

                            </table>
                            @php
                                $sum4 = 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    if (isset($data['heating_upgrade']['image' . $i]) && trim($data['heating_upgrade']['image' . $i]) != '') {
                                        $sum4++;
                                    }
                                }
                            @endphp
                            <div class="bg-messi mx-0 p-1 @if ($sum4 == 0) d-none @endif"
                                style="page-break-inside: avoid !important;">
                                <h5>Photos</h5>
                                <div class="masonry-grid">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if (isset($data['heating_upgrade']['image' . $i]) && trim($data['heating_upgrade']['image' . $i]) != '')
                                            <div>
                                                <img class="mb-1 img-fluid"
                                                    style="border-radius:6px; page-break-inside: avoid !important;"
                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['heating_upgrade']['image' . $i]) }}">
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($data['grand_total']))
                        <div class="cm">
                            <h4 class=" mb-1 mt-0">GRAND TOTAL</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Subtotal</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['grand_total']) ? $data['grand_total']['subtotal'] : '' }}</td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Vat 13.5%</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['grand_total']) ? $data['grand_total']['vat'] : '' }}</td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Grand Total</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['grand_total']) ? $data['grand_total']['grand_total'] : '' }}</td>
                                </tr>
                            </table>
                            @php
                                $sum5 = 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    if (isset($data['grand_total']['image' . $i]) && trim($data['grand_total']['image' . $i]) != '') {
                                        $sum5++;
                                    }
                                }
                            @endphp
                            <div class="bg-messi mx-0 p-1 @if ($sum5 == 0) d-none @endif"
                                style="page-break-inside: avoid !important;">
                                <h5>Photos</h5>
                                <div class="masonry-grid">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if (isset($data['grand_total']['image' . $i]) && trim($data['grand_total']['image' . $i]) != '')
                                            <div>
                                                <img class="mb-1 img-fluid"
                                                    style="border-radius:6px; page-break-inside: avoid !important;"
                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['grand_total']['image' . $i]) }}">
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($data['grant_and_credits']))
                        <div class="cm">
                            <h4 class=" mb-1 mt-0">GRANTS & CREDITS</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Have the customers applied for a grant?</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['grant_and_credits']) ? implode(', ', json_decode($data['grant_and_credits']['grant_tick'])) : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Energy Credits</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['grant_and_credits']) ? implode(', ', json_decode($data['grant_and_credits']['energy_credits_tick'])) : '' }}
                                    </td>
                                </tr>
                            </table>
                            @php
                                $sum6 = 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    if (isset($data['grant_and_credits']['image' . $i]) && trim($data['grant_and_credits']['image' . $i]) != '') {
                                        $sum6++;
                                    }
                                }
                            @endphp
                            <div class="bg-messi mx-0 p-1 @if ($sum6 == 0) d-none @endif"
                                style="page-break-inside: avoid !important;">
                                <h5>Photos</h5>
                                <div class="masonry-grid">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if (isset($data['grant_and_credits']['image' . $i]) && trim($data['grant_and_credits']['image' . $i]) != '')
                                            <div>
                                                <img class="mb-1 img-fluid"
                                                    style="border-radius:6px; page-break-inside: avoid !important;"
                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['grant_and_credits']['image' . $i]) }}">
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($data['additional_photo_and_note']))
                        <div class="cm">
                            <h4 class=" mb-1 mt-0">ADDITIONAL PHOTOS & NOTES</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Notes</th>
                                    <td style="{{ $style['tbl-padding'] }}" colspan="4">
                                        {{ isset($data['additional_photo_and_note']) ? $data['additional_photo_and_note']['notes'] : '' }}
                                    </td>
                                </tr>
                            </table>
                            @php
                                $sum66 = 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    if (isset($data['additional_photo_and_note']['image' . $i]) && trim($data['additional_photo_and_note']['image' . $i]) != '') {
                                        $sum66++;
                                    }
                                }
                            @endphp
                            <div class="bg-messi mx-0 p-1 @if ($sum66 == 0) d-none @endif"
                                style="page-break-inside: avoid !important;">
                                <h5>Photos</h5>
                                <div class="masonry-grid">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if (isset($data['additional_photo_and_note']['image' . $i]) &&
                                                trim($data['additional_photo_and_note']['image' . $i]) != '')
                                            <div>
                                                <img class="mb-1 img-fluid"
                                                    style="border-radius:6px; page-break-inside: avoid !important;"
                                                    src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['additional_photo_and_note']['image' . $i]) }}">
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($data['additional_drawing_and_photo']))
                        <div class="cm">
                            <h4 class=" mb-1 mt-0">DRAWINGS AND PHOTOGRAPHS</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Sketches been ecosmartd and attached</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['additional_drawing_and_photo']) ? $data['additional_drawing_and_photo']['sketches_been_ecosmartd_and_attached'] : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Photographs been taken</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        {{ isset($data['additional_drawing_and_photo']) ? $data['additional_drawing_and_photo']['photographs_been_taken'] : '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Plan View</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        @if (isset($data['additional_drawing_and_photo']) && trim($data['additional_drawing_and_photo']['plan_view']) != '')
                                            <img src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . (isset($data['additional_drawing_and_photo']) ? $data['additional_drawing_and_photo']['plan_view'] : '')) }}"
                                                style="max-height: 150px;border-radius:6px;" class="m-1">
                                        @endif
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Front elevations</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        @if (isset($data['additional_drawing_and_photo']) &&
                                                trim($data['additional_drawing_and_photo']['front_elevations']) != '')
                                            <img src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . (isset($data['additional_drawing_and_photo']) ? $data['additional_drawing_and_photo']['front_elevations'] : '')) }}"
                                                style="max-height: 150px;border-radius:6px;" class="m-1">
                                        @endif
                                    </td>
                                </tr>


                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Rear elevations</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        @if (isset($data['additional_drawing_and_photo']) &&
                                                trim($data['additional_drawing_and_photo']['rear_elevations']) != '')
                                            <img src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . (isset($data['additional_drawing_and_photo']) ? $data['additional_drawing_and_photo']['rear_elevations'] : '')) }}"
                                                style="max-height: 150px;border-radius:6px;" class="m-1">
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Gable elevations1</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        @if (isset($data['additional_drawing_and_photo']) &&
                                                trim($data['additional_drawing_and_photo']['gable_elevations1']) != '')
                                            <img src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . (isset($data['additional_drawing_and_photo']) ? $data['additional_drawing_and_photo']['gable_elevations1'] : '')) }}"
                                                style="max-height: 150px;border-radius:6px;" class="m-1">
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Gable elevations2</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        @if (isset($data['additional_drawing_and_photo']) &&
                                                trim($data['additional_drawing_and_photo']['gable_elevations2']) != '')
                                            <img src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . (isset($data['additional_drawing_and_photo']) ? $data['additional_drawing_and_photo']['gable_elevations2'] : '')) }}"
                                                style="max-height: 150px;border-radius:6px;" class="m-1">
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th style="{{ $style['tbl-padding'] }}">Gable elevations3</th>
                                    <td style="{{ $style['tbl-padding'] }}">
                                        @if (isset($data['additional_drawing_and_photo']) &&
                                                trim($data['additional_drawing_and_photo']['gable_elevations3']) != '')
                                            <img src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . (isset($data['additional_drawing_and_photo']) ? $data['additional_drawing_and_photo']['gable_elevations3'] : '')) }}"
                                                style="max-height: 150px;border-radius:6px;" class="m-1">
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif

                            
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
            var rows = document.querySelectorAll('tr');

            rows.forEach(function(row) {
                // Check if the second td exists and is empty, and the first td is a th sibling
                var firstTh = row.querySelector('th:nth-child(1)');
                var secondTd = row.querySelector('td:nth-child(2)');
                if (firstTh && secondTd && secondTd.textContent.trim() === '') {
                    // If empty or contains only img tag, hide the entire tr
                    row.classList.add('d-none');
                }
                if ((firstTh && secondTd && secondTd.querySelector('img'))) {
                    row.classList.remove('d-none');
                }
            });
        });
    </script>
@endsection
