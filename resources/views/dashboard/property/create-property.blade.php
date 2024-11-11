@extends('layouts.dashboard.app')

@section('content')
<div class="d-flex align-items-center">
    {{-- <a href="{{url('dashboard/property/'.$back)}}"> --}}
        <a href="{{url()->previous()}}">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mdi mdi-menu cliclef mr-3">
        <rect width="32" height="32" rx="16" fill="#E2E8ED" />
        <path
            d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
            fill="black" />
    </svg>
    </a>
    @isset($property)
        <h4 class="page-title">UPDATE PROPERTY</h4>
    @else
        <h4 class="page-title">NEW PROPERTY</h4>
    @endisset
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
    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST" id="myForm"
                          action="{{ isset($property) ? route('property.update', ['back' => $back]) : route('property.store')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $property->id ?? '' }}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
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
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="batch_id" class="form-label">Batch <span class="text-danger"
                                                                                         title="Required field">*</span></label>
                                    <select name="batch_id"
                                            class="form-select  @error('batch_id') is-invalid @enderror"
                                            id="batch_id"
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


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger"
                                                                                        title="Required field">*</span></label>
                                    <select name="status"
                                            class="form-select  @error('status') is-invalid @enderror"
                                            id="_status"
                                            required>

                                        @foreach($property_status as $key => $value)
                                            <option
                                                {{ ( isset($property) ? ($property->status == $key ? 'selected' : '') : '' ) ?? (old(status) == $property->status ? 'selected': '' ) }} value="{{$key}}">
                                                {{$value}}
                                            </option>
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


                        <div
                            style="{{isset($property->batch) ? ($property->batch->scheme->scheme == "Warmer Homes" ? '' : 'display: none') : 'display: none' }}"
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

                                if (get_val == "Warmer Homes") {
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
                                    <label for="wh_lname" class="form-label">Last Name <span class="text-danger"title="Required field">*</span></label>
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
                                    <label for="email" class="form-label">Email<span class="text-danger"title="Required field">*</span></label>
                                    <input value="{{  $property->email ?? old('email') }}"
                                           type="email" id="email" name="email"
                                           class="form-control  @error('email') is-invalid @enderror"
                                           placeholder="Enter Email" required
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
                                    <label for="address2" class="form-label">Address 2<span class="text-danger"title="Required field">*</span></label>
                                    <input value="{{  $property->address2 ?? old('address2') }}"
                                           type="text" id="address2" name="address2"
                                           class="form-control  @error('address2') is-invalid @enderror"
                                           placeholder="Enter address 2" required
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
                                    <label for="address3" class="form-label">Address 3<span class="text-danger"title="Required field">*</span></label>
                                    <input value="{{  $property->address3 ?? old('address3') }}"
                                           type="text" id="address3" name="address3"
                                           class="form-control  @error('address3') is-invalid @enderror"
                                           placeholder="Enter address 3" required
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

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="client_select_type" class="form-label">Client Selection</label>
                                    <select name="client_select_type"
                                            class="form-select  @error('client_select_type') is-invalid @enderror"
                                            id="client_select_type"
                                        {{-- {{ isset($property) ? 'disabled' : '' }} --}}
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
                        </div>


                        <div class="row bg-light-lighten py-2 mb-2" id="client_list_dropdown_container">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <h4 class="text-secondary">Choose Client</h4>
                                    <label for="client_id" class="form-label">Client <span class="text-danger"
                                                                                           title="Required field">*</span></label>
                                    <select name="client_id"
                                            class="form-select  @error('client_id') is-invalid @enderror"
                                            id="client_id"
                                            required
                                        {{-- {{ isset($property) ? 'disabled' : '' }} --}}
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
                                    <label for="start_date" class="form-label">Start Date <span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{  $property->start_date ?? date('Y-m-d') }}"
                                           type="date" id="start_date" name="start_date"
                                           class="form-control  @error('start_date') is-invalid @enderror"
                                           placeholder="Enter start date" required
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
                                    <label for="end_date" class="form-label">End Date <span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{  $property->end_date ?? date('Y-m-d', strtotime(date('Y-m-d') . ' +7 days')) }}"
                                           type="date" id="end_date" name="end_date"
                                           class="form-control  @error('end_date') is-invalid @enderror"
                                           placeholder="Enter end date" required
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
                                                                                            title="Required field">*</span></label>
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
                                <a href="{{route('property', $back ? $back : 0)}}" type="submit"
                                   class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                @isset($property)
                                    <button type="submit" class="btn _btn-primary float-end">UPDATE PROPERTY</button>
                                @else
                                    <button type="submit" class="btn _btn-primary float-end">ADD PROPERTY</button>
                                @endisset

                            </div>
                        </div>

                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready( function(){
        $('._btn-primary').click(function() {
        const form = $('#myForm');

        // Validate the entire form at once
        if (!form[0].checkValidity()) {
            // Form is invalid, mark all invalid fields
            form.find('input, select').each(function() {
            if (!this.checkValidity()) {
                $(this).addClass('is-invalid');
                // $(this).removeClass('is-valid');
            }else{
                $(this).removeClass('is-invalid');
                // $(this).addClass('is-valid');
            }
            });
            return; // Prevent further action if form is invalid
        }
        });
        var selectedScheme = "";
        var batchVal = $('#batch_id').val();
        $('#batch_id').find('option').each(function() { // Corrected selector targeting
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
        console.log(schemeName);
        if(schemeName != ""){
        $('#batch_id').find('option').each(function() {
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
        $('#batch_id').val('');
        // console.log(schemeName);
        $('#batch_id').find('option').each(function() {

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
    // console.log(selectedScheme);
    });
</script>
@endsection
