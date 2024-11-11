@extends('layouts.dashboard.app')

@section('content')
<style>
    input[type='checkbox'] {
        zoom: 1.5;
        transform: scale(1.5);
        -ms-transform: scale(1.5);
        -webkit-transform: scale(1.5);
        -o-transform: scale(1.5);
        -moz-transform: scale(1.5);
        transform-origin: 0 0;
        -ms-transform-origin: 0 0;
        -webkit-transform-origin: 0 0;
        -o-transform-origin: 0 0;
        -moz-transform-origin: 0 0;
    }
    .prop-chk{
        position: relative;
        right: 9px !important;
        scale: 1 !important;
        bottom: 1px !important;
        height: 12px !important;
        width: 12px !important;
        border-radius: 3px !important;
        zoom: 0 !important;
    }
</style>
<div class="d-flex align-items-center">
    <a href="{{route('surveyor')}}">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mdi mdi-menu cliclef mr-3">
        <rect width="32" height="32" rx="16" fill="#E2E8ED" />
        <path
            d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
            fill="black" />
    </svg>
    </a>
    @isset($surveyor)
        <h4 class="page-title">UPDATE APP USER</h4>
    @else
        <h4 class="page-title">NEW APP USER</h4>
    @endisset
</div>
@php
    $pid = [];
    if(isset($surveyor)){
    foreach($surveyor->properties as $property){
        $pid[] = $property->id;
    }
        $pid = array_unique($pid);
    }
@endphp
    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST"
                          action="{{ isset($surveyor) ? route('surveyor.update') : route('surveyor.create')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input value="{{  $surveyor->full_name ?? old('full_name') }}" type="text"
                                           name="full_name" id="full_name"
                                           class="form-control  @error('full_name') is-invalid @enderror"
                                           placeholder="Enter name"
                                           required
                                           {{ isset($surveyor) ? 'readonly' : '' }}
                                    >
                                    @error('full_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone</label>
                                    <input
                                        value="{{  $surveyor->phone_number ?? old('phone_number') }}"
                                        type="text" name="phone_number" id="phone_number"
                                        class="form-control  @error('phone_number') is-invalid @enderror"
                                        placeholder="Enter phone"
                                        required
                                        {{ isset($surveyor) ? 'readonly' : '' }}
                                    >
                                    @error('phone_number')
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
                                    <input type="hidden" name="id"
                                           value="{{ $surveyor->user_id ?? '' }}">
                                    <label for="appname" class="form-label">App</label>
                                    <select name="appname"
                                            class="form-select  @error('appname') is-invalid @enderror"
                                            id="appname"
                                            required
                                            {{ isset($surveyor) ? 'readonly' : '' }}
                                    >
                                        <option selected disabled>Choose</option>
                                        <option
                                            {{ ( isset($surveyor) ? ($surveyor->appname == "Main app" ? 'Selected' : '') : '' ) ?? (old(appname) == "Main app" ? 'selected': '' ) }}  value="Main app">
                                            Main App
                                        </option>
                                        <option
                                            {{ ( isset($surveyor) ? ($surveyor->appname == "Lite" ? 'Selected' : '') : '' ) ?? (old(appname) == "Lite" ? 'selected': '' ) }} value="Lite">
                                            Lite
                                        </option>
                                    </select>
                                    @error('appname')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input value="{{  $surveyor->email ?? old('email') }}"
                                           type="email" id="email" name="email"
                                           class="form-control  @error('email') is-invalid @enderror"
                                           placeholder="Enter email"
                                           required
                                           {{ isset($surveyor) ? 'readonly' : '' }}
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
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password"
                                           id="password"
                                           class="form-control  @error('password') is-invalid @enderror"
                                           autocomplete="false"
                                           placeholder="Enter password"
                                        {{ isset($surveyor) ? '' : 'required' }}
                                    >
                                    @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="isAccess col-lg-6">
                                <div >
                                    <label for="is_access" class="mb-2"> Access  All Properties</label><br>
                                    <input type="checkbox" id="is_access" name="is_access" value="{{  $surveyor->is_access ?? old('is_access') }}" @if(isset($surveyor) && $surveyor->is_access && $surveyor->is_access == 1) checked @endif>
                                    <label for="is_access" class="mb-2"> </label><br>
                                    @error('is_access')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('surveyor')}}" type="submit"
                                   class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                @isset($surveyor)
                                    <button type="submit" class="btn _btn-primary px-2 float-end">UPDATE APP USER
                                    </button>
                                @else
                                    <button type="submit" class="btn _btn-primary px-2 float-end">ADD APP USER
                                    </button>
                                @endisset

                            </div>
                        </div>

                        <!--selectProp Modal -->
                        <div class="modal fade" id="selectPropModal" tabindex="-1" aria-labelledby="selectPropModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="p-3 pb-0">
                                        <h3 class="modal-title text-blue text-center">Do you want to keep Properties?</h3>
                                    </div>
                                    <div class="modal-body">
                                        <label for="" class="text-black mb-1">Properties</label>
                                        <input type="checkbox" style="float: inline-end;margin-right: 3px;" class="form-check-input prop-chk" id="all-prop">
                                        <input type="text" id="prop-fliter" placeholder="Search Properties" class="form-control">
                                        <div class="allProperties py-2" style="height: 350px;overflow-x: hidden;">
                                            @foreach ($getAllP as $k => $prop)
                                            <div class="per-prop justify-content-between py-1" data-id="{{ $prop->id }}" @if(!$loop->last) style="border-bottom:1px solid grey;display:flex;" @else style="display:flex;" @endif>
                                                <h6 style="margin: 5px 0;">{{ format_address($prop->house_num,$prop->address1,$prop->address2,$prop->address3,$prop->county,$prop->eircode) }}</h6>
                                                <input class="form-check-input prop-chk selected-prop" name="property_ids[]" type="checkbox" value="{{ $prop->id }}" @if (in_array($prop->id, $pid)) checked @else @endif>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 p-2 pt-0">
                                        <button type="button" class="slt-yes-btn btn _btn-primary w-100 mt-0 mb-0">Yes</button>
                                        <button type="button" class="slt-no-btn btn _btn-primary sing-img w-100 mt-0 mb-0">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    @if(isset($surveyor->properties))
        <div class="row">
            <div class="col-12">

                <div class="card _shadow-1">
                    <div class="card-body">
                        <h4>App User Properties</h4>
                        <table class="table table-bordered" id="contractor-properties-table">
                            <thead>
                            <th>Property ID</th>
                            <th>Occupier</th>
                            <th>Batch</th>
                            <th>Address</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($surveyor->properties as $property)
                                <tr>
                                    <td>{{$property->id}}</td>
                                    <td>{{$property->wh_fname.' '.$property->wh_lname}}</td>
                                    <td>{{isset($property->batch) ?$property->batch->our_ref : ''}}</td>
                                    <td>
                                        {{format_address(
                                            $property->house_num,
                                            $property->address1,
                                            $property->address2,
                                            $property->address3,
                                            $property->county
                                        )}}
                                    </td>
                                    <td>
                                        <a href="{{route('property.show', \Illuminate\Support\Facades\Crypt::encrypt($property->id))}}?back=0">View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    @endif
    <!--All Prop Modal -->
    <div class="modal fade" id="allConModal" tabindex="-1" aria-labelledby="allConModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="modal-title text-blue text-center">Please Note: this surveyor will have access to all properties on the Main APP.</h4>
                </div>
                <div class="d-flex gap-2 p-2 pt-0">
                    <button type="button" class="okay-btn btn _btn-primary w-100 mt-0 mb-0">Okay</button>
                    <button type="button" class="cancel-btn btn _btn-primary sing-img w-100 mt-0 mb-0">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!--unEnable Modal -->
    <div class="modal fade" id="unEnableModal" tabindex="-1" aria-labelledby="unEnableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="modal-title text-blue text-center">Are you sure you want to unenable the access for All properties?</h4>
                </div>
                <div class="d-flex gap-2 p-2 pt-0">
                    <button type="button" class="yes-btn btn _btn-primary w-100 mt-0 mb-0">Yes</button>
                    <button type="button" class="no-btn btn _btn-primary sing-img w-100 mt-0 mb-0">No</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready( function(e){
                $(document).on('change','#is_access', function(e){
                    var ischecked = $(this).prop('checked');
                    if(ischecked){
                        $("#allConModal").modal("show");
                    }else{
                        $("#unEnableModal").modal("show");
                    }
                });
                $(document).on('change',"input[name='property_ids[]']", function(e){
                    if ($("input[name='property_ids[]']:checked").length == $("input[name='property_ids[]']").length) {
                        $("#all-prop").prop("checked",true);
                        $('#is_access').val('1');
                        $("#is_access").prop("checked",true);
                    }else {
                        $("#all-prop").prop("checked",false);
                        $('#is_access').val('0');
                        $("#is_access").prop("checked",false);
                    }
                });
                $(document).on('click','#all-prop', function(e){
                    var ischecked = $(this).prop('checked');
                    if(ischecked){
                        $('#is_access').val('1');
                        $("#is_access").prop("checked",true);
                        $("input[name='property_ids[]']").each(function(){
                            $(this).prop('checked', true);
                        });
                    }else{
                        $('#is_access').val('0');
                        $("#is_access").prop("checked",false);
                        $("input[name='property_ids[]']").each(function(){
                            $(this).prop('checked', false);
                        });
                    }
                });
                $(document).on('click','.no-btn', function(e){
                    $("#is_access").prop("checked",true);
                    $('#is_access').val('1');
                    $("#unEnableModal").modal("hide");
                });
                $(document).on('click','.yes-btn', function(e){
                    $("#is_access").prop("checked",false);
                    $('#is_access').val('0');
                    $("#unEnableModal").modal("hide");
                    $("#selectPropModal").modal("show");
                });
                $(document).on('click','.okay-btn', function(e){
                    $("#is_access").prop("checked",true);
                    $('#is_access').val('1');
                    $("#allConModal").modal("hide");
                });
                $(document).on('click','.cancel-btn', function(e){
                    $("#is_access").prop("checked",false);
                    $('#is_access').val('0');
                    $("#allConModal").modal("hide");
                });
                $(document).on('click','.slt-no-btn', function(e){
                    $("input[name='property_ids[]']").each(function(){
                        $(this).prop('checked', false);
                    });
                    $("#is_access").prop("checked",false);
                    $('#is_access').val('0');
                    $('#all-prop').prop('checked', false);
                    $("#selectPropModal").modal("hide");
                });
                $(document).on('click','.slt-yes-btn', function(e){
                    $("#selectPropModal").modal("hide");
                });
                $(document).on('keyup', '#prop-fliter', function(e) {
                    var value = $(this).val().toLowerCase();
                    $(".per-prop").each(function() {
                        var propertyAddress = $(this).children("h6").text().toLowerCase();
                        $(this).toggle(propertyAddress.indexOf(value) > -1);
                    });
                });
                $("#selectPropModal").on('show.bs.modal', function(e){
                    var isasset = "{{isset($surveyor) ? $surveyor->is_access : '0' }}"
                    if(isasset == "1"){
                        $('#all-prop').prop('checked', true);
                        $("input[name='property_ids[]']").each(function(){
                        $(this).prop('checked', true);
                    });
                    }
                });
                // $(document).on('change','#appname', function(e){
                //     var appname = $(this).val();
                //     if(appname == "Lite"){
                //         $('.isAccess').addClass('d-none');
                //     }else{
                //         $('.isAccess').removeClass('d-none');
                //     }
                // });
            });
        </script>
@endsection
