@extends('layouts.dashboard.app')

@section('content')
<div class="d-flex align-items-center">
    <a href="{{url()->previous()}}">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mdi mdi-menu cliclef mr-3">
        <rect width="32" height="32" rx="16" fill="#E2E8ED" />
        <path
            d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
            fill="black" />
    </svg>
    </a>
    @php
    $lead_scheme = collect($schemes)->first(function ($scheme) {
        return $scheme->scheme == 'Leads';
    });
    if (is_null($lead_scheme)) {
        $lead_scheme = [];
    }
    $sch = intval($lead_scheme->id);
    $lead_statussx = [$lead_scheme->id];
    @endphp
    @isset($property)
        <h4 class="page-title">UPDATE LEAD</h4>
    @else
        <h4 class="page-title">NEW LEAD</h4>
    @endisset
</div>
    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST" id="lead-form"
                          action="{{ isset($property) ? route('lead.update', ['back' => $back]) : route('lead.store')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $property->id ?? '' }}">
                        <div class="row">
                            <div class="col-lg-6 d-none">
                                <div class="mb-3">
                                    <label for="batch_id" class="form-label">Batch <span class="text-danger"
                                                                                         title="Required field">*</span></label>
                                    <select name="batch_id"
                                            class="form-select  @error('batch_id') is-invalid @enderror"
                                            id="batch_id"
                                            required
                                    >
                                        {{-- <option value="" selected></option> --}}
                                        @foreach($batches as $batch)
                                                    @if (in_array($batch->scheme_id, $lead_statussx))
                                                    <option data_scheme_id="{{$batch->scheme_id}}" {{ ( isset($property) ? ($property->batch_id == $batch->id ? 'selected' : '') : '' ) ?? (old(batch_id) == $batch->id ? 'selected': '' ) }} value="{{$batch->id}}"
                                                        >{{$batch->our_ref}}
                                                        </option>
                                                    @endif
                                        @endforeach
                                    </select>
                                    @error('batch_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label"><span id="st_lbl">Status</span> <span class="text-danger"
                                                                                        title="Required field">*</span></label>
                                    <select name="status"
                                            class="form-select  @error('status') is-invalid @enderror @isset($property) lead_stage @endisset"
                                            id="_status"
                                            required>
                                            @php
                                            $lead_statuss = [
                                                'lead',
                                                'appointment_booked',
                                                'surveyed',
                                                'confirmed',
                                                'will-follow-up',
                                                'quoted',
                                                'not_interested',
                                                'lost'
                                            ];
                                            @endphp

                                        @foreach($property_status as $key => $value)
                                                    @if (in_array($key, $lead_statuss))
                                                        <option {{ ( isset($property) ? ($property->status == $key ? 'selected' : '') : '' ) ?? (old(status) == $property->status ? 'selected': '' ) }} value="{{$key}}">{{$value}}</option>
                                                    @endif
                                        @endforeach

                                    </select>
                                    @error('project_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>



		 <div class="row lead_form_container d-none" id="lead_form_container">
                            @php
                                $lead_stypes = [
                                    'Full Retrofit',
                                    'One Stop Shop',
                                    'Single / Multiple Measures',
                                    'Solar PV',
                                    'Commercial Solar PV',
                                    'Other'
                                ]
                            @endphp
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="lead_type" class="form-label">Lead Type</label>
                                    <select name="lead_type"
                                            class="form-select  @error('lead_type') is-invalid @enderror"
                                            id="lead_type"
                                            required>
                                        <option value="N/A" selected>N/A</option>
                                        @foreach($lead_stypes as $lead_type)
                                            <option
                                                {{ ( isset($property) ? ($property->lead_type == $lead_type ? 'selected' : '') : '' ) ?? (old(lead_type) == $property->lead_type ? 'selected': '' ) }} value="{{$lead_type}}">{{$lead_type}}</option>
                                        @endforeach
                                    </select>

                                    @error('lead_type')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="lead_value" class="form-label">Lead Value</label>
                                    <input value="{{  $property->lead_value ?? old('lead_value') }}"
                                            type="number" step="any" min="0" id="lead_value" name="lead_value"
                                            class="form-control  @error('lead_value') is-invalid @enderror"
                                            placeholder="Enter Lead Value"
                                    >
                                    @error('lead_value')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div
                            style="{{isset($property->batch) ? ($property->batch->scheme_id == 2 ? '' : 'display: none') : 'display: none' }}"
                            class="row" id="wh_ref_container">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="wh_ref " class="form-label">WH Ref </label>
                                    <input value="{{  $property->wh_ref  ?? old('wh_ref ') }}"
                                           type="text" id="wh_ref " name="wh_ref"
                                           class="form-control  @error('wh_ref ') is-invalid @enderror"
                                           placeholder="Enter WH ref"
                                    >
                                    @error('wh_ref ')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <script>

                            document.getElementById("batch_id").onchange = function (event) {
                                const get_val = event.target.selectedOptions[0].getAttribute("data_scheme_id");
                                const wfRefContainer = document.getElementById('wh_ref_container');

                                if (get_val == 2) {
                                    wfRefContainer.style.display = 'block';

                                } else {
                                    wfRefContainer.style.display = 'none';

                                }

                            }

                        </script>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="wh_fname" class="form-label">First Name <span class="text-danger"
                                                                                              title="Required field">*</span></label>
                                    <input value="{{  $property->wh_fname ?? old('wh_fname') }}"
                                           type="text" id="wh_fname" name="wh_fname"
                                           class="form-control  @error('wh_fname') is-invalid @enderror"
                                           placeholder="Enter first name"
                                           required
                                    >
                                    @error('wh_fname')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="wh_lname" class="form-label">Last Name <span class="text-danger"
                                                                                             title="Required field">*</span></label>
                                    <input value="{{  $property->wh_lname ?? old('wh_lname') }}"
                                           type="text" id="wh_lname" name="wh_lname"
                                           class="form-control  @error('wh_lname') is-invalid @enderror"
                                           placeholder="Enter last name"
                                           required
                                    >
                                    @error('wh_lname')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input value="{{  $property->email ?? old('email') }}"
                                           type="text" id="email" name="email"
                                           class="form-control  @error('email') is-invalid @enderror"
                                           placeholder="Enter Email"
                                    >
                                    @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">


                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 mb-3">
                                        <label for="phone1" class="form-label">Phone</label>
                                        <input value="{{  $property->phone1 ?? old('phone1') }}"
                                               type="text" id="phone1" name="phone1"
                                               class="form-control  @error('phone1') is-invalid @enderror"
                                               placeholder="Enter phone"
                                        >
                                        @error('phone1')
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-12 mb-3 pl-md-0 pl-sm-2">
                                        <label for="mobile" class="form-label">Mobile</label>
                                        <input value="{{  $property->phone2 ?? old('phone2') }}"
                                               type="text" id="phone2" name="phone2"
                                               class="form-control  @error('phone2') is-invalid @enderror"
                                               placeholder="Enter mobile"
                                        >
                                        @error('phone2')
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>


                        </div>


                        <div class="row">


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="house_num" class="form-label">House Number</label>
                                    <input value="{{  $property->house_num ?? old('house_num') }}"
                                           type="text" id="house_num" name="house_num"
                                           class="form-control  @error('house_num') is-invalid @enderror"
                                           placeholder="Enter house number"
                                    >
                                    @error('house_num')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address1" class="form-label">Address 1 <span class="text-danger"
                                                                                             title="Required field">*</span></label>
                                    <input value="{{  $property->address1 ?? old('address1') }}"
                                           type="text" id="address1" name="address1"
                                           class="form-control  @error('address1') is-invalid @enderror"
                                           placeholder="Enter address 1"
                                           required
                                    >
                                    @error('address1')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                        </div>


                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address2" class="form-label">Address 2</label>
                                    <input value="{{  $property->address2 ?? old('address2') }}"
                                           type="text" id="address2" name="address2"
                                           class="form-control  @error('address2') is-invalid @enderror"
                                           placeholder="Enter address 2"
                                    >
                                    @error('address2')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address3" class="form-label">Address 3</label>
                                    <input value="{{  $property->address3 ?? old('address3') }}"
                                           type="text" id="address3" name="address3"
                                           class="form-control  @error('address3') is-invalid @enderror"
                                           placeholder="Enter address 3"
                                    >
                                    @error('address3')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="wh_mprn" class="form-label">MPRN<span class="text-danger"
                                        title="Required field">*</span></label>
                                    <input value="{{  $property->wh_mprn ?? old('wh_mprn') }}"
                                           type="text" id="wh_mprn" name="wh_mprn"
                                           class="form-control  @error('wh_mprn') is-invalid @enderror"
                                           placeholder="Enter MPRN (11 digit number)"
                                           pattern="((^\d{11}$)|^$)" required
                                    >
                                    @error('wh_mprn')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="county" class="form-label">County <span class="text-danger"
                                                                                        title="Required field">*</span></label>
                                    <select name="county"
                                            class="form-select  @error('county') is-invalid @enderror"
                                            id="county"
                                            required
                                    >
                                        {{--                                        <option value="" selected></option>--}}
                                        @foreach($counties as $county)
                                            <option
                                                {{ ( isset($property) ? ($property->county == $county ? 'selected' : '') : '' ) ?? (old(county) == $property->county ? 'selected': '' ) }} value="{{$county}}">{{$county}}</option>

                                        @endforeach
                                    </select>
                                    @error('project_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="eircode" class="form-label">Eircode</label>
                                    <input value="{{  $property->eircode ?? old('eircode') }}"
                                           type="text" id="eircode" name="eircode"
                                           class="form-control  @error('eircode') is-invalid @enderror"
                                           placeholder="Enter eircode"
                                    >
                                    @error('eircode')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 client_list_dropdown_container">
                                <div class="mb-3">
                                    <label for="client_select_type" class="form-label">Client Selection</label>
                                    <select name="client_select_type"
                                            class="form-select  @error('client_select_type') is-invalid @enderror"
                                            id="client_select_type"
                                        {{ isset($property) ? 'disabled' : '' }}
                                    >
                                        <option value="select_from_clients">Select from existing client(s)</option>
                                        <option value="use_above_client">Use above client</option>
                                        <option value="create_new_client">Create new Client/Landlord</option>

                                    </select>
                                    @error('client_select_type')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 lead_extra d-none">
                                <div class="mb-3">
                                    <label for="lead_source" class="form-label">Source</label>
                                    <select name="lead_source" class="form-select  @error('lead_source') is-invalid @enderror" id="lead_source">
                                        <option value="">Select Source</option>
                                        <option value="email" @if(isset($property) && $property->lead_source == "email") selected @endif>Email</option>
                                        <option value="website" @if(isset($property) && $property->lead_source == "website") selected @endif>Website</option>
                                        <option value="phone_call" @if(isset($property) && $property->lead_source == "phone_call") selected @endif>Phone Call</option>
                                        <option value="facebook" @if(isset($property) && $property->lead_source == "facebook") selected @endif>Facebook</option>
                                        <option value="instagram" @if(isset($property) && $property->lead_source == "instagram") selected @endif>Instragram</option>
                                        <option value="tik_tok" @if(isset($property) && $property->lead_source == "tik_tok") selected @endif>Tik Tok</option>
                                        <option value="other" @if(isset($property) && $property->lead_source == "other") selected @endif>Other</option>

                                    </select>
                                    @error('lead_source')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row bg-light-lighten py-2 mb-2 client_list_dropdown_container" id="client_list_dropdown_container">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <h4 class="text-secondary">Choose Client</h4>
                                    <label for="client_id" class="form-label">Client <span class="text-danger"
                                                                                           title="Required field">*</span></label>
                                    <select name="client_id"
                                            class="form-select  @error('client_id') is-invalid @enderror"
                                            id="client_id"
                                            required
                                        {{ isset($property) ? 'disabled' : '' }}
                                    >
                                        <option value=""></option>
                                        @foreach($clients as $client)
                                            <option
                                                {{ ( isset($property) ? ($property->client_id == $client->id ? 'selected' : '') : '' ) ?? (old(client) == $client->id ? 'selected': '' ) }} value="{{$client->id}}">{{$client->name. ($client->email ? ' ('.$client->email.')' : '')}}</option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div
                            class="row bg-light-lighten pt-2 mb-3"
                            id="create_new_client_container"
                            style="display: none"
                        >
                            <div class="col-12">
                                <h4 class="text-secondary">Create New Client/Landlord</h4>
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="client_name" class="form-label">Name <span class="text-danger"
                                                                                                   title="Required field">*</span></label>
                                            <input
                                                type="text" id="client_name" name="client_name"
                                                class="form-control  @error('client_name') is-invalid @enderror"
                                                placeholder="Enter name"
                                            >
                                            @error('client_name')
                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="client_email" class="form-label">Email</label>
                                            <input
                                                type="email" id="client_email" name="client_email"
                                                class="form-control  @error('client_email') is-invalid @enderror"
                                                placeholder="Enter email"
                                            >
                                            @error('email')
                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="client_phone" class="form-label">Phone</label>
                                            <input
                                                type="tel" id="client_phone" name="client_phone"
                                                class="form-control  @error('phone') is-invalid @enderror"
                                                placeholder="Enter phone"
                                            >
                                            @error('client_phone')
                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="client_address1" class="form-label">Address 1 <span
                                                    class="text-danger"
                                                    title="Required field">*</span></label>
                                            <input
                                                type="tel" id="client_address1" name="client_address1"
                                                class="form-control  @error('client_address1') is-invalid @enderror"
                                                placeholder="Enter address 1"
                                            >
                                            @error('client_address1')
                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="client_address2" class="form-label">Address 2</label>
                                            <input type="tel" id="client_address2" name="client_address2"
                                                   class="form-control  @error('client_address2') is-invalid @enderror"
                                                   placeholder="Enter address 2"
                                            >
                                            @error('client_address2')
                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="client_address3" class="form-label">Address 3</label>
                                            <input type="tel" id="client_address3" name="client_address3"
                                                   class="form-control  @error('client_address3') is-invalid @enderror"
                                                   placeholder="Enter address 3"
                                            >
                                            @error('client_address3')
                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="client_county" class="form-label">County <span
                                                    class="text-danger"
                                                    title="Required field">*</span></label>
                                            <select name="client_county"
                                                    class="form-select  @error('client_county') is-invalid @enderror"
                                                    id="client_county"
                                            >
                                                @foreach($counties as $county)
                                                    <option value="{{$county}}">{{$county}}</option>
                                                @endforeach
                                            </select>
                                            @error('client_county')
                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="client_eircode" class="form-label">Eircode</label>
                                            <input type="text" id="client_eircode" name="client_eircode"
                                                   class="form-control  @error('client_eircode') is-invalid @enderror"
                                                   placeholder="Enter eircode"
                                            >
                                            @error('client_eircode')
                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="client_notes" class="form-label">Notes</label>

                                            <textarea class="form-control  @error('client_notes') is-invalid @enderror"
                                                      name="client_notes"
                                                      id="client_notes" cols="30"
                                                      rows="5"></textarea>

                                            @error('client_notes')
                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                            </div><!-- end col -->
                        </div><!-- end row -->


                        <script>
                            document.getElementById('client_select_type').addEventListener('change', (event) => {

                                const type = event.target.value;

                                const clientListContainer = document.getElementById('client_list_dropdown_container');
                                const createNewClientContainer = document.getElementById('create_new_client_container');


                                const clientName = document.getElementById('client_name');
                                const clientAddress = document.getElementById('client_address1');
                                const clientCounty = document.getElementById('client_county');
                                const clientId = document.getElementById('client_id');

                                if (type == 'select_from_clients') {

                                    clientListContainer.style.display = 'block';
                                    createNewClientContainer.style.display = 'none';

                                    clientName.required = false;
                                    clientAddress.required = false;
                                    clientCounty.required = false;
                                    clientId.required = true;

                                } else if (type == 'create_new_client') {

                                    clientListContainer.style.display = 'none';
                                    createNewClientContainer.style.display = 'block';

                                    clientName.required = true;
                                    clientAddress.required = true;
                                    clientCounty.required = true;
                                    clientId.required = false;

                                } else {

                                    clientListContainer.style.display = 'none';
                                    createNewClientContainer.style.display = 'none';

                                    clientName.required = false;
                                    clientAddress.required = false;
                                    clientCounty.required = false;
                                    clientId.required = false;
                                }
                            })
                        </script>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label"><span id="sd_lbl">Start Date</span><span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{  $property->start_date ?? old('start_date') }}"
                                           type="date" id="start_date" name="start_date"
                                           class="form-control  @error('start_date') is-invalid @enderror"
                                           placeholder="Enter start date"
                                    >
                                    @error('start_date')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label"><span id="ed_lbl">Start Date</span><span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{  $property->end_date ?? old('end_date') }}"
                                           type="date" id="end_date" name="end_date"
                                           class="form-control  @error('end_date') is-invalid @enderror"
                                           placeholder="Enter end date"
                                    >
                                    @error('end_date')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="county" class="form-label">HEA Status <span class="text-danger"
                                                                                            title="Required field" id="heaS">*</span></label>
                                    <select name="hea_status"
                                            class="form-select  @error('hea_status') is-invalid @enderror"
                                            id="hea_status"
                                            required>
                                        @foreach($hea_status as $status)
                                            <option
                                                {{ ( isset($property) ? ($property->hea_status == $status ? 'selected' : '') : ($status == 'Pending' ? 'selected' : '') ) ?? (old(hea_status) == $property->hea_status ? 'selected': '' ) }} value="{{$status}}">{{$status}}</option>

                                        @endforeach
                                    </select>
                                    @error('hea_status')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="county" class="form-label">Contractor Status <span class="text-danger"
                                                                                                   title="Required field">*</span></label>
                                    <select name="contractor_status"
                                            class="form-select  @error('contractor_status') is-invalid @enderror"
                                            id="contractor_status"
                                            required>
                                        @foreach($contractor_status as $status)
                                            <option
                                                {{ ( isset($property) ? ($property->contractor_status == $status ? 'selected' : '') : ($status == 'Pending' ? 'selected' : '') ) ?? (old(contractor_status) == $property->contractor_status ? 'selected': '' ) }} value="{{$status}}">{{$status}}</option>
                                        @endforeach
                                    </select>
                                    @error('contractor_status')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="pre_ber" class="form-label">Pre BER</label>

                                    <select name="pre_ber"
                                            class="form-select  @error('pre_ber') is-invalid @enderror"
                                            id="pre_ber"
                                            required>
                                        <option value="N/A" selected>N/A</option>
                                        @foreach($bers as $ber)
                                            <option
                                                {{ ( isset($property) ? ($property->pre_ber == $ber ? 'selected' : '') : '' ) ?? (old(pre_ber) == $property->pre_ber ? 'selected': '' ) }} value="{{$ber}}">{{$ber}}</option>
                                        @endforeach
                                    </select>

                                    @error('pre_ber')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="post_ber" class="form-label">Post BER</label>

                                    <select name="post_ber"
                                            class="form-select  @error('post_ber') is-invalid @enderror"
                                            id="post_ber"
                                            required>
                                        <option value="N/A" selected>N/A</option>
                                        @foreach($bers as $ber)
                                            <option
                                                {{ ( isset($property) ? ($property->post_ber == $ber ? 'selected' : '') : '' ) ?? (old(post_ber) == $property->post_ber ? 'selected': '' ) }} value="{{$ber}}">{{$ber}}</option>
                                        @endforeach
                                    </select>

                                    @error('post_ber')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
{{--                            <div class="col-lg-6">--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="notes" class="form-label">Notes</label>--}}
{{--                                    <textarea class="form-control  @error('notes') is-invalid @enderror" name="notes"--}}
{{--                                              id="notes" cols="30"--}}
{{--                                              rows="10">{{  $property->notes ?? old('notes') }}</textarea>--}}


{{--                                    @error('notes')--}}
{{--                                    <span class="text-danger" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="col-lg-6">
                                <div class="mb-3 pt-3 mt-2">
                                    <input type="checkbox" class="mr-2"
                                           name="archived" {{isset($property) ? ($property->archived ? 'checked' : '') : ''}}>
                                    <label for="archived" class="form-label">Archived?</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{ route('lead', $lead_scheme->id) }}" type="submit"
                                   class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                @isset($property)
                                    <button type="button" class="uLead-btn btn _btn-primary float-end">UPDATE LEAD</button>
                                @else
                                    <button type="submit" class="btn _btn-primary float-end">ADD LEAD</button>
                                @endisset

                            </div>
                        </div>
                        @if(isset($property))
                        <!--Lead Move Modal -->
                        <div class="modal fade" id="leadMoveModal" tabindex="-1" aria-labelledby="leadMoveModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="p-3">
                                        <h3 class="modal-title text-blue text-center">This Lead is confirmed now. Do you want to move this lead to Property?</h3>
                                        <h5 class="modal-title text-center mt-2">By clicking “Yes”, this lead will be moved into Property on the main dashboard</h5>
                                    </div>
                                    @php
                                    $leadId = null;
                                        foreach($schemes as $sch){
                                            if($sch->scheme == "Leads"){
                                                $leadId = $sch->id;
                                            }else{
                                                continue;
                                            }
                                        }
                                    @endphp
                                        <input type="hidden" class="fk_property_id" name="fk_property_id"
                                            value="{{ $property->id ?? ''}}" required>
                                        <input type="hidden" id="is_property" name="is_property" value="lead">
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label for="scheme_id" class="form-label">Scheme <span class="text-danger" title="Required field">*</span></label>
                                                <select name="scheme_id" class="form-select  @error('scheme') is-invalid @enderror" id="scheme" required>
                                                        <option value=""></option>
                                                    @foreach($schemes as $scheme)
                                                    @if($scheme->scheme != "Leads")
                                                        <option
                                                            {{(isset($batch) ? ($batch->scheme_id == $scheme->id ? 'selected' : '') : '' ) ?? (old(scheme_id) == $scheme->id ? 'selected': '' ) }} value="{{$scheme->id }}">{{$scheme->scheme}}
                                                        </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @error('scheme')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label for="prop_batch_id" class="form-label">Batch <span class="text-danger"
                                                                                                    title="Required field">*</span></label>
                                                <select name="prop_batch_id"
                                                        class="form-select  @error('batch_id') is-invalid @enderror"
                                                        id="prop_batch_id"
                                                        required
                                                >
                                                    <option value="" selected></option>
                                                    @foreach($batches as $batch)
                                                    @if($leadId == null)
                                                        <option data_scheme_id="{{$batch->scheme->scheme}}" {{ ( isset($property) ? ($property->batch_id == $batch->id ? 'selected' : '') : '' ) ?? (old(batch_id) == $batch->id ? 'selected': '' ) }} value="{{$batch->id}}" >{{$batch->our_ref}}
                                                        </option>
                                                    @else
                                                    @if($batch->scheme_id != $leadId)
                                                    <option data_scheme_id="{{$batch->scheme->scheme}}" {{ ( isset($property) ? ($property->batch_id == $batch->id ? 'selected' : '') : '' ) ?? (old(batch_id) == $batch->id ? 'selected': '' ) }} value="{{$batch->id}}" >{{$batch->our_ref}}
                                                    </option>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @error('batch_id')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 p-2 pt-0">
                                            <button type="button" class="yes-btn btn _btn-primary w-100 mt-0 mb-0">Yes</button>
                                            <button type="button" class="no-btn cancel-prop-convert btn _btn-primary sing-img w-100 mt-0 mb-0">No</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
    @if(isset($property))
    <!--Reason Modal -->
    <div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="reasonLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title" id="exampleModalLabel">Add Reason</h1>
                        <svg class="modal-cls-btn" data-bs-dismiss="modal" aria-label="Close" width="18"
                            height="17" viewBox="0 0 18 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path id="Arrow Left" fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.99335 14.6187C8.38758 15.0511 8.39331 15.7459 8.00006 16.1773C7.60954 16.6056 6.98129 16.611 6.58171 16.1727L0.29715 9.27933C-0.0956605 8.84846 -0.102425 8.15731 0.29715 7.71902L6.58171 0.825611C6.97453 0.394745 7.60682 0.389723 8.00006 0.821065C8.39059 1.24942 8.39192 1.94245 7.99335 2.37964L3.41431 7.4023L16.9975 7.4023C17.5512 7.4023 18 7.88916 18 8.49917C18 9.10496 17.5475 9.59605 16.9975 9.59605L3.41431 9.59605L7.99335 14.6187Z"
                                fill="#2A2D34" />
                        </svg>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" name="reason" id="reason" style="width: 100%;" rows="6" placeholder="Add Reason"></textarea>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex gap-2" style="width:100%">
                            <button type="button" class="reason-save btn _btn-primary w-100 mt-0 mb-0">Save</button>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn _btn-primary sing-img w-100 mt-0 mb-0">Cancel</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    const sch = '{{ $sch }}';
    function addMonths(date, months) {
        const newDate = new Date(date.getTime()); // Create a copy to avoid modifying original
        newDate.setMonth(newDate.getMonth() + months);

        // Handle edge cases for months with different day counts:
        if (newDate.getDate() !== date.getDate()) {
            newDate.setDate(0); // Set date to last day of previous month
        }

        return newDate;
    }
    function changeDrop(val,date1,date2){
        var status = val;
        if(status.trim() == "lead"){
            $('.lead_form_container').removeClass('d-none');
            $('.client_list_dropdown_container').addClass('d-none');
            $('.lead_extra').removeClass('d-none');
            $('#sd_lbl').text('Created Date');
            if(date1 == "" && date2 == ""){
                var date = new Date();
            const newDate = addMonths(date, 3);
            $('#start_date').val(YMDFormat(date));
            $('#end_date').val(YMDFormat(newDate));
            }
            $('#ed_lbl').text('Expected Close Date');
            $('#st_lbl').text('Stage');
            $('#heaS').text('');
            $('#hea_status').prop('required',false);
            $('#client_id').prop('required',false);
        }else{
            $('.lead_form_container').addClass('d-none');
            $('.lead_extra').addClass('d-none');
            $('.client_list_dropdown_container').removeClass('d-none');
            $('#hea_status').prop('required',true);
            $('#client_id').prop('required',true);
            $('#heaS').text('*');
            $('#sd_lbl').text('Start Date');
            $('#st_lbl').text('Status');
            $('#ed_lbl').text('End Date');
        }
    }
    $(document).ready( function(){
        var date1 = $('#start_date').val();
        var date2 = $('#end_date').val();
        changeDrop("lead",date1,date2);
        $(document).on('change','#_status', function(){
            var status = $(this).val();
            var date1 = $('#start_date').val();
            var date2 = $('#end_date').val();
            changeDrop(status,date1,date2);
        });

        $(document).on("change",".lead_stage", function() {
            if(this.value == "not_interested" || this.value == "lost"){
                $("#reasonModal").modal('show');
            }
        });

        $(document).on("click",".reason-save", function() {
            var txt = $("#reason").val();
            $.ajax({
                type: 'POST',
                url: "{{ route('lead.reason') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    property_id: "{{ $property->id ?? '' }}",
                    text: txt,
                },
                dataType: 'json',
                success: function(response) {
                    if(response.success == true){
                        $("#reasonModal").modal('hide');
                    }
                }
            });
        });

        // var lead = "{{ isset($property) ? 'true' : 'false' }}";
        // if(lead == "true") {
            var selectedScheme = "";
            var batchVal = $('#prop_batch_id').val();
            $('#prop_batch_id').find('option').each(function() { // Corrected selector targeting
                    if ($(this).val() == batchVal) {
                        var selectedScheme = $(this).attr('data_scheme_id');
                        if(selectedScheme != undefined){
                            thisisSelectFunction(selectedScheme);
                            $('#scheme').find('option').each(function() {
                                var thisTExt = $(this).text().trim();
                                    if(selectedScheme.trim() == thisTExt){
                                        $(this).prop('selected',true);
                                    }
                                // console.log(thisTExt.trim());
                            });
                        }
                        return false; // Stop the loop once a match is found
                    }
            });
            function thisisSelectFunction(schemeName) {
                    if(schemeName != ""){
                        $('#prop_batch_id').find('option').each(function() {
                            if($(this).attr('data_scheme_id') != undefined){
                                $(this).addClass('d-none');
                                if($(this).attr('data_scheme_id').trim() == schemeName){
                                $(this).removeClass('d-none');
                                }
                            }
                        });
                    }
            }
            $(document).on('change','#scheme', function(){
                    var schemeName = $(this).find('option:selected').text().trim();
                    $('#prop_batch_id').val('');
                    // console.log(schemeName);
                    $('#prop_batch_id').find('option').each(function() {

                        if($(this).attr('data_scheme_id') != undefined){
                            $(this).addClass('d-none');
                            if($(this).attr('data_scheme_id').trim() == schemeName){
                            $(this).removeClass('d-none');
                            }
                        }
                        // var mainScheme = $(this).attr('data_scheme_id').trim();
                        // console.log(mainScheme);

                    });
            });
            $(document).on("click",".uLead-btn", function() {
            if($("#_status").val() == "confirmed"){
                    $('#leadMoveModal').modal('show');
            }else {
                    $("#lead-form").submit();
            }
            });
            $(document).on("click",".yes-btn",function() {
                $("#is_property").val('property');
                $("#lead-form").submit();
            });
            $(document).on("click",".no-btn",function() {
                $("#is_property").val('lead');
                $("#lead-form").submit();
            });
        // }
    });
// document.addEventListener('DOMContentLoaded', function () {
//     document.querySelector('#_status').addEventListener('change', function () {
//         const status = this.options[this.selectedIndex].text.trim();
//         const leadFormContainer = document.querySelector('.lead_form_container');
//         if (status == "New Lead") {

//             leadFormContainer.classList.remove('d-none');
//         } else {

//             leadFormContainer.classList.add('d-none');
//         }
//     });
// });

</script>

@endsection
