@extends('layouts.dashboard.print')
@section('content')
    <style>
        .f20 {
            font-size: 20px;
        }

        .f16 {
            font-size: 16px;
        }

        .brright {
            border-right: 1px solid #1A47A3;
        }

        h3.text-info {
            color: #1A47A3 !important;
            padding: unset !important;
            font-size: 14px !important;
            margin-bottom: 0.375rem !important;
            margin-top: unset !important;
        }

        .bg-grasy {
            background: #fff;
        }

        li::marker {
            color: #1A47A3 !important;
            font-size: 20px;
        }

        h4,
        li {
            color: #333;
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

        .border-card>h4 {
            font-size: 12px !important;
            margin-bottom: 0 !important;
            margin-top: 0 !important;
        }

        .border-card>small {
            font-size: 12px !important;
        }

        ul {
            padding-left: 21px;
            margin-bottom: 0 !important;
        }

        ul>li:not(:first-child) {
            font-size: 12px;
        }

        ul>li:first-child {
            font-size: 12px;
        }

        .border-card>h4 {
            margin-bottom: 4px !important;
        }
        .lead {
            font-size: 14px !important;
            font-weight: 300;
        }
    </style>
    @php
        $style['border-btm'] = 'border-bottom: 1px solid #e0e9fc;margin: 7px 0';
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
                                @if (isset($data['sir_preparation_complete']))
                                    <div class="lead ml-2">(Preparation Complete)</div>
                                @endif
                                @if (isset($data['sir_boarding_complete']))
                                    <div class="lead ml-2">(Bording / Stress Patches Complete)</div>
                                @endif
                                @if (isset($data['sir_base_coat_complete']))
                                    <div class="lead ml-2">(Base Coat Complete)</div>
                                @endif
                                @if (isset($data['sir_finish_coat_complete']))
                                    <div class="lead ml-2">(Finish Coat Complete)</div>
                                @endif
                                @if (isset($data['sir_job_complete']))
                                    <div class="lead ml-2">(Job Complete)</div>
                                @endif
                                @if (isset($data['sir_drawings_photographs']))
                                    <div class="lead ml-2">(Drawings & Photographs)</div>
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

                    <?php
                    
                    function clean($string)
                    {
                        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                        return preg_replace('/[^A-Za-z0-9, \-]/', '', $string); // Removes special chars.
                    }
                    
                    ?>

                    @if (isset($data['sir_preparation_complete']))
                        <div class="cm">
                            <h3 class="text-info">Preparation Complete</h3>
                            <div class="col-12 p-1 border-card">
                                <h4>Weather Conditions</h4>
                                <small>{{ $data['sir_preparation_complete']['weather_conditions'] ? $data['sir_preparation_complete']['weather_conditions'] : '--' }}</small>
                                <div style="{{ $style['border-btm'] }}"></div>

                                <h4>Temperature</h4>
                                <small>{{ $data['sir_preparation_complete']['temperature'] ? $data['sir_preparation_complete']['temperature'] : '--' }}</small>
                                <div style="{{ $style['border-btm'] }}"></div>


                                @if (isset($data['sir_preparation_complete']['temperature_image'])  &&
                                        trim($data['sir_preparation_complete']['temperature_image']) != '')
                                    <h4>Temperature Photo</h4>
                                    <img class="my-1"
                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_preparation_complete']['temperature_image']) }}"
                                        style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;">
                                    <div style="{{ $style['border-btm'] }}">
                                    </div>
                                @endif

                                <h4>Time of day</h4>
                                <small>{{ $data['sir_preparation_complete']['time_of_day'] ? $data['sir_preparation_complete']['time_of_day'] : '--' }}</small>
                                <div style="{{ $style['border-btm'] }}"></div>
                                <?php
                                $health_safety = explode(',', clean($data['sir_preparation_complete']['health_safety']));
                                ?>
                                @if (sizeOf($health_safety) && $health_safety[0] != '')
                                    <h4>Health & Safety</h4>
                                    <ul>
                                        @foreach ($health_safety as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div style="{{ $style['border-btm'] }}">

                                    </div>
                                @endif
                                <h4>Building services</h4>

                                <?php
                                $building_services = explode(',', clean($data['sir_preparation_complete']['building_services']));
                                ?>

                                <ul>
                                    @foreach ($building_services as $entry)
                                        @if ($entry)
                                            <li>{{ $entry }}</li>
                                        @endif
                                    @endforeach
                                </ul>

                                <div style="{{ $style['border-btm'] }}"></div>
                                <h4>Materials Check</h4>

                                <?php
                                $material_check = explode(',', clean($data['sir_preparation_complete']['materials_check']));
                                ?>

                                <ul>
                                    @foreach ($material_check as $entry)
                                        @if ($entry)
                                            <li>{{ $entry }}</li>
                                        @endif
                                    @endforeach
                                </ul>



                                <div style="{{ $style['border-btm'] }}"></div>

                                <?php
                                $contractor_performance_rating = explode(',', clean($data['sir_preparation_complete']['contractor_performance_rating']));
                                ?>
                                @if (sizeOf($contractor_performance_rating) && $contractor_performance_rating[0] != '')
                                    <h4>Contractor Performance Rating</h4>
                                    <ul>
                                        @foreach ($contractor_performance_rating as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                                @php
                                    $sum = 0;
                                    for ($i = 1; $i <= 5; $i++) {
                                        if (isset($data['sir_preparation_complete']['photos' . $i]) && trim($data['sir_preparation_complete']['photos' . $i]) != '') {
                                            $sum++;
                                        }
                                    }
                                @endphp
                                <div style="{{ $style['border-btm'] }}"
                                    class="@if ($sum == 0) d-none @endif">

                                </div>
                                <div class="bg-messi mx-0 @if ($sum == 0) d-none @endif">
                                    <div class="masonry-grid">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if (isset($data['sir_preparation_complete']['photos' . $i]) &&
                                                    trim($data['sir_preparation_complete']['photos' . $i]) != '')
                                                <div>
                                                    <img class="mb-1 img-fluid"
                                                        style="border-radius:6px; page-break-inside: avoid !important;"
                                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_preparation_complete']['photos' . $i]) }}">
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($data['sir_boarding_complete']))
                        <div class="cm">
                            <h3 class="text-info">Bording / Stress Patches Complete</h3>
                            <div class="col-12 p-1 border-card">
                                <h4>Weather Conditions</h4>
                                <small>{{ $data['sir_boarding_complete']['weather_conditions'] ? $data['sir_boarding_complete']['weather_conditions'] : '--' }}</small>
                                <div style="{{ $style['border-btm'] }}"></div>

                                <h4>Temperature</h4>
                                <small>{{ $data['sir_boarding_complete']['temperature'] ? $data['sir_boarding_complete']['temperature'] : '--' }}</small>
                                <div style="{{ $style['border-btm'] }}"></div>


                                @if (isset($data['sir_boarding_complete']['temperature_image']) &&
                                        trim($data['sir_boarding_complete']['temperature_image']) != '')
                                    <h4>Temperature Photo</h4>
                                    <img class="my-1"
                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_boarding_complete']['temperature_image']) }}"
                                        style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;">
                                    <div style="{{ $style['border-btm'] }}">
                                    </div>
                                @endif

                                <h4>Time of day</h4>
                                <small>{{ $data['sir_boarding_complete']['time_of_day'] ? $data['sir_boarding_complete']['time_of_day'] : '--' }}</small>
                                <div style="{{ $style['border-btm'] }}"></div>


                                <?php
                                $health_safety = explode(',', clean($data['sir_boarding_complete']['health_safety']));
                                ?>
                                @if (sizeOf($health_safety) && $health_safety[0] != '')
                                    <h4>Health & Safety</h4>
                                    <ul>
                                        @foreach ($health_safety as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div style="{{ $style['border-btm'] }}"></div>
                                @endif
                                <?php
                                $workmanship = explode(',', clean($data['sir_boarding_complete']['workmanship']));
                                ?>
                                @if (sizeOf($workmanship) && $workmanship[0] != '')
                                    <h4>Workmanship</h4>
                                    <ul>
                                        @foreach ($workmanship as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div style="{{ $style['border-btm'] }}"></div>
                                @endif

                                <?php
                                $ventilation = explode(',', clean($data['sir_boarding_complete']['ventilation']));
                                ?>
                                @if (sizeOf($ventilation) && $ventilation[0] != '')
                                    <h4>Ventilation</h4>
                                    <ul>
                                        @foreach ($ventilation as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <div style="{{ $style['border-btm'] }}"></div>
                                @endif


                                <?php
                                $contractor_performance_rating = explode(',', clean($data['sir_boarding_complete']['contractor_performance_rating']));
                                ?>
                                @if (sizeOf($contractor_performance_rating) && $contractor_performance_rating[0] != '')
                                    <h4>Contractor Performance Rating</h4>
                                    <ul>
                                        @foreach ($contractor_performance_rating as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                                @php
                                    $sum2 = 0;
                                    for ($i = 1; $i <= 5; $i++) {
                                        if (isset($data['sir_boarding_complete']['photos' . $i]) && trim($data['sir_boarding_complete']['photos' . $i]) != '') {
                                            $sum2++;
                                        }
                                    }
                                @endphp
                                <div class="@if ($sum2 == 0) d-none @endif"
                                    style="{{ $style['border-btm'] }}">

                                </div>
                                <div class="bg-messi mx-0 @if ($sum2 == 0) d-none @endif">
                                    <div class="masonry-grid">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if (isset($data['sir_boarding_complete']['photos' . $i]) && trim($data['sir_boarding_complete']['photos' . $i]) != '')
                                                <div>
                                                    <img class="mb-1 img-fluid"
                                                        style="border-radius:6px; page-break-inside: avoid !important;"
                                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_boarding_complete']['photos' . $i]) }}">
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($data['sir_base_coat_complete']))
                        <div class="cm">
                            <h3 class="text-info">Base Coat Complete</h3>
                            <div class="col-12 p-1 border-card">
                                <h4>Weather Conditions</h4>
                                <small>{{ $data['sir_base_coat_complete']['weather_conditions'] ? $data['sir_base_coat_complete']['weather_conditions'] : '--' }}</small>

                                <div style="{{ $style['border-btm'] }}"></div>
                                <h4>Temperature</h4>
                                <small>{{ $data['sir_base_coat_complete']['temperature'] ? $data['sir_base_coat_complete']['temperature'] : '--' }}</small>

                                <div style="{{ $style['border-btm'] }}"></div>

                                @if (isset($data['sir_base_coat_complete']['temperature_image']) &&
                                        trim($data['sir_base_coat_complete']['temperature_image']) != '')
                                    <h4>Temperature Photo</h4>
                                    <img class="my-1"
                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_base_coat_complete']['temperature_image']) }}"
                                        style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;">
                                    <div style="{{ $style['border-btm'] }}"></div>
                                @endif

                                <h4>Time of day</h4>
                                <small>{{ $data['sir_base_coat_complete']['time_of_day'] ? $data['sir_base_coat_complete']['time_of_day'] : '--' }}</small>
                                <div style="{{ $style['border-btm'] }}"></div>

                                <?php
                                $health_safety = explode(',', clean($data['sir_base_coat_complete']['health_safety']));
                                ?>
                                @if (sizeOf($health_safety) && $health_safety[0] != '')
                                    <h4>Health & Safety</h4>
                                    <ul>
                                        @foreach ($health_safety as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div style="{{ $style['border-btm'] }}"></div>
                                @endif
                                <?php
                                $workmanship = explode(',', clean($data['sir_base_coat_complete']['workmanship']));
                                ?>
                                @if (sizeOf($workmanship) && $workmanship[0] != '')
                                    <h4>Workmanship</h4>
                                    <ul>
                                        @foreach ($workmanship as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <div style="{{ $style['border-btm'] }}"></div>
                                @endif
                                <?php
                                $ventilation = explode(',', clean($data['sir_base_coat_complete']['ventilation']));
                                ?>
                                @if (sizeOf($ventilation) && $ventilation[0] != '')
                                    <h4>Ventilation</h4>
                                    <ul>
                                        @foreach ($ventilation as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <div style="{{ $style['border-btm'] }}"></div>
                                @endif


                                <?php
                                $contractor_performance_rating = explode(',', clean($data['sir_base_coat_complete']['contractor_performance_rating']));
                                ?>
                                @if (sizeOf($contractor_performance_rating) && $contractor_performance_rating[0] != '')
                                    <h4>Contractor Performance Rating</h4>
                                    <ul>
                                        @foreach ($contractor_performance_rating as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                                @php
                                    $sum4 = 0;
                                    for ($i = 1; $i <= 5; $i++) {
                                        if (isset($data['sir_base_coat_complete']['photos' . $i]) && trim($data['sir_base_coat_complete']['photos' . $i]) != '') {
                                            $sum4++;
                                        }
                                    }
                                @endphp
                                <div class="@if ($sum4 == 0) d-none @endif"
                                    style="{{ $style['border-btm'] }}">

                                </div>
                                <div class="bg-messi mx-0 @if ($sum4 == 0) d-none @endif">
                                    <div class="masonry-grid">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if (isset($data['sir_base_coat_complete']['photos' . $i]) && trim($data['sir_base_coat_complete']['photos' . $i]) != '')
                                                <div>
                                                    <img class="mb-1 img-fluid"
                                                        style="border-radius:6px; page-break-inside: avoid !important;"
                                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_base_coat_complete']['photos' . $i]) }}">
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($data['sir_finish_coat_complete']))
                        <div class="cm">
                            <h3 class="text-info">Finish Coat Complete</h3>
                            <div class="col-12 p-1 border-card">
                                <h4>Weather Conditions</h4>
                                <small>{{ $data['sir_finish_coat_complete']['weather_conditions'] ? $data['sir_finish_coat_complete']['weather_conditions'] : '--' }}</small>
                                <div style="{{ $style['border-btm'] }}"></div>

                                <h4>Temperature</h4>
                                <small>{{ $data['sir_finish_coat_complete']['temperature'] ? $data['sir_finish_coat_complete']['temperature'] : '--' }}</small>

                                <div style="{{ $style['border-btm'] }}"></div>

                                @if (isset($data['sir_finish_coat_complete']['temperature_image']) &&
                                        trim($data['sir_finish_coat_complete']['temperature_image']) != '')
                                    <h4>Temperature Photo</h4>
                                    <img class="my-1"
                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_finish_coat_complete']['temperature_image']) }}"
                                        style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;">
                                    <div style="{{ $style['border-btm'] }}">

                                    </div>
                                @endif

                                <h4>Time of day</h4>
                                <small>{{ $data['sir_finish_coat_complete']['time_of_day'] ? $data['sir_finish_coat_complete']['time_of_day'] : '--' }}</small>
                                <div style="{{ $style['border-btm'] }}"></div>
                                <?php
                                $health_safety = explode(',', clean($data['sir_finish_coat_complete']['health_safety']));
                                ?>
                                @if (sizeOf($health_safety) && $health_safety[0] != '')
                                    <h4>Health & Safety</h4>
                                    <ul>
                                        @foreach ($health_safety as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div style="{{ $style['border-btm'] }}"></div>
                                @endif

                                <?php
                                $workmanship = explode(',', clean($data['sir_finish_coat_complete']['workmanship']));
                                ?>
                                @if (sizeOf($workmanship) && $workmanship[0] != '')
                                    <h4>Workmanship</h4>
                                    <ul>
                                        @foreach ($workmanship as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <div style="{{ $style['border-btm'] }}"></div>
                                @endif

                                <?php
                                $ventilation = explode(',', clean($data['sir_finish_coat_complete']['ventilation']));
                                ?>
                                @if (sizeOf($ventilation) && $ventilation[0] != '')
                                    <h4>Ventilation</h4>
                                    <ul>
                                        @foreach ($ventilation as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <div style="{{ $style['border-btm'] }}"></div>
                                @endif
                                <?php
                                $contractor_performance_rating = explode(',', clean($data['sir_finish_coat_complete']['contractor_performance_rating']));
                                ?>
                                @if (sizeOf($contractor_performance_rating) && $contractor_performance_rating[0] != '')
                                    <h4>Contractor Performance Rating</h4>
                                    <ul>
                                        @foreach ($contractor_performance_rating as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                                @php
                                    $sum3 = 0;
                                    for ($i = 1; $i <= 5; $i++) {
                                        if (isset($data['sir_finish_coat_complete']['photos' . $i]) && trim($data['sir_finish_coat_complete']['photos' . $i]) != '') {
                                            $sum3++;
                                        }
                                    }
                                @endphp
                                <div class="@if ($sum3 == 0) d-none @endif"
                                    style="{{ $style['border-btm'] }}">

                                </div>
                                <div class="bg-messi mx-0 @if ($sum3 == 0) d-none @endif">
                                    <h4>Photos</h4>
                                    <div class="masonry-grid">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if (isset($data['sir_finish_coat_complete']['photos' . $i]) &&
                                                    trim($data['sir_finish_coat_complete']['photos' . $i]) != '')
                                                <div>
                                                    <img class="mb-1 img-fluid"
                                                        style="border-radius:6px; page-break-inside: avoid !important;"
                                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_finish_coat_complete']['photos' . $i]) }}">
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($data['sir_job_complete']))
                        <div class="cm">
                            <h3 class="text-info">Job Complete</h3>
                            <div class="col-12 p-1 border-card">
                                <h4>Materials Records</h4>

                                <?php
                                $material_records = explode(',', clean($data['sir_job_complete']['material_records']));
                                ?>

                                <ul>
                                    @foreach ($material_records as $entry)
                                        @if ($entry)
                                            <li>{{ $entry }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div style="{{ $style['border-btm'] }}"></div>

                                <h4>. Paperwork Records</h4>
                                <?php
                                $paperwork_records = explode(',', clean($data['sir_job_complete']['paperwork_records']));
                                ?>

                                <ul>
                                    @foreach ($paperwork_records as $entry)
                                        @if ($entry)
                                            <li>{{ $entry }}</li>
                                        @endif
                                    @endforeach
                                </ul>

                                <div style="{{ $style['border-btm'] }}"></div>
                                <h4>Exceptional Items</h4>
                                <small>{{ $data['sir_job_complete']['exceptional_items'] }}</small>
                                <div style="{{ $style['border-btm'] }}"></div>

                                <?php
                                $contractor_performance_rating = explode(',', clean($data['sir_job_complete']['contractor_performance_rating']));
                                ?>
                                @if (sizeOf($contractor_performance_rating) && $contractor_performance_rating[0] != '')
                                    <h4>Contractor Performance Rating</h4>
                                    <ul>
                                        @foreach ($contractor_performance_rating as $entry)
                                            @if ($entry)
                                                <li>{{ $entry }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif

                                <div class="@if ($data['sir_job_complete']['notes_recommendations'] == '') d-none @endif"
                                    style="{{ $style['border-btm'] }}">

                                </div>
                                <h4>Notes & Recommendations</h4>
                                <small>{{ $data['sir_job_complete']['notes_recommendations'] ? $data['sir_job_complete']['notes_recommendations'] : '--' }}</small>

                                @php
                                    $sum5 = 0;
                                    for ($i = 1; $i <= 5; $i++) {
                                        if (isset($data['sir_job_complete']['photos' . $i]) && trim($data['sir_job_complete']['photos' . $i]) != '') {
                                            $sum5++;
                                        }
                                    }
                                @endphp
                                <div class="@if ($sum5 == 0) d-none @endif"
                                    style="{{ $style['border-btm'] }}">

                                </div>
                                <div class="bg-messi mx-0 @if ($sum5 == 0) d-none @endif">
                                    <h4>Photos</h4>
                                    <div class="masonry-grid">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if (isset($data['sir_job_complete']['photos' . $i]) && trim($data['sir_job_complete']['photos' . $i]) != '')
                                                <div>
                                                    <img class="mb-1 img-fluid"
                                                        style="border-radius:6px; page-break-inside: avoid !important;"
                                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_job_complete']['photos' . $i]) }}">
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($data['sir_drawings_photographs']))
                        <div class="cm">
                            <h3 class="text-info">Drawings & Photographs</h3>
                            <div class="col-12 p-1 border-card">
                                <h4>Have sketches been completed and attached?</h4>
                                <small>{{ $data['sir_drawings_photographs']['sketches_been_completed_and_attached'] ? $data['sir_drawings_photographs']['sketches_been_completed_and_attached'] : '--' }}</small>
                                <div style="{{ $style['border-btm'] }}"></div>
                                <h4>Have photographs been taken?</h4>
                                <small>{{ $data['sir_drawings_photographs']['photographs_been_taken'] ? $data['sir_drawings_photographs']['photographs_been_taken'] : '--' }}</small>
                                <div style="{{ $style['border-btm'] }}"></div>
                                <h4>Plan View</h4>
                                @if (isset($data['sir_drawings_photographs']['plan_view']) && trim($data['sir_drawings_photographs']['plan_view']) != '')
                                    <img class="my-1"
                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_drawings_photographs']['plan_view']) }}"
                                        style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;">
                                @endif
                                <div style="{{ $style['border-btm'] }}"></div>
                                <h4>Front elevations</h4>
                                @if (isset($data['sir_drawings_photographs']['front_elevations']) &&
                                        trim($data['sir_drawings_photographs']['front_elevations']) != '')
                                    <img class="my-1"
                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_drawings_photographs']['front_elevations']) }}"
                                        style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;">
                                @endif
                                <div style="{{ $style['border-btm'] }}"></div>
                                <h4>Rear elevations</h4>
                                @if (isset($data['sir_drawings_photographs']['rear_elevations']) &&
                                        trim($data['sir_drawings_photographs']['rear_elevations']) != '')
                                    <img class="my-1"
                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_drawings_photographs']['rear_elevations']) }}"
                                        style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;">
                                @endif
                                <div style="{{ $style['border-btm'] }}"></div>
                                <h4>Gable elevation 1</h4>
                                @if (isset($data['sir_drawings_photographs']['gable_elevations1']) &&
                                        trim($data['sir_drawings_photographs']['gable_elevations1']) != '')
                                    <img class="my-1"
                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_drawings_photographs']['gable_elevations1']) }}"
                                        style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;">
                                @endif
                                <div style="{{ $style['border-btm'] }}"></div>
                                <h4>Gable elevation 2</h4>
                                @if (isset($data['sir_drawings_photographs']['gable_elevations2']) &&
                                        trim($data['sir_drawings_photographs']['gable_elevations2']) != '')
                                    <img class="my-1"
                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_drawings_photographs']['gable_elevations2']) }}"
                                        style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;">
                                @endif
                                <div style="{{ $style['border-btm'] }}"></div>
                                <h4>Gable elevation 3</h4>
                                @if (isset($data['sir_drawings_photographs']['gable_elevations3']) &&
                                        trim($data['sir_drawings_photographs']['gable_elevations3']) != '')
                                    <img class="my-1"
                                        src="{{ asset('/' . $APP_BASE_IMAGE_PATH . '/assets/uploads/inspection_photo/' . $data['sir_drawings_photographs']['gable_elevations3']) }}"
                                        style="max-height: 150px;border-radius:6px; page-break-inside: avoid !important;">
                                @endif
                                <div style="{{ $style['border-btm'] }}"></div>
                                <h4>Additional Risks / Notes</h4>
                                <small>{{ isset($data['sir_drawings_photographs']['addditional_risks_notes']) ? $data['sir_drawings_photographs']['addditional_risks_notes'] : '' }}</small>
                            </div>
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
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check for <small> elements with text content equal to "--"
            var targetSmalls = document.querySelectorAll('small');

            // Iterate over the selected small elements
            targetSmalls.forEach(function(small) {
                // Check if the text content is "--"
                if (small.textContent.trim() === '--') {
                    // Find previous <h4> element
                    var prevH4 = small.previousElementSibling;
                    // Find next <div> element
                    var nextDiv = small.nextElementSibling;

                    // Apply d-none class to previous <h4> element
                    if (prevH4 && prevH4.tagName === 'H4') {
                        prevH4.classList.add('d-none');
                    }

                    // Apply d-none class to next <div> element
                    if (nextDiv && nextDiv.tagName === 'DIV') {
                        nextDiv.classList.add('d-none');
                    }

                    // Apply d-none class to the current <small> element
                    small.classList.add('d-none');
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            // Check for <ol> elements
            var orderedLists = document.querySelectorAll('div');

            orderedLists.forEach(function(div) {
                // Check all <small> elements inside the <div>
                var smallTags = div.querySelectorAll('small');

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
