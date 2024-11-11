@extends('layouts.dashboard.app')

@section('content')
<style>
    tr td:not(:last-child), tr th:not(:last-child){
        border-right: 1px solid #e6e6e6 !important;
    }
</style>
<div class="d-flex align-items-center">
    <a href="{{route('contractor')}}">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mdi mdi-menu cliclef mr-3">
        <rect width="32" height="32" rx="16" fill="#E2E8ED" />
        <path
            d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
            fill="black" />
    </svg>
    </a>
    @if($show)
        <h4 class="page-title">VIEW CONTRACTOR</h4>
    @else
    @isset($contractor)
        <h4 class="page-title">UPDATE CONTRACTOR</h4>
    @else
        <h4 class="page-title">NEW CONTRACTOR</h4>
    @endisset
    @endif
</div>

    <div class="row">
        <style>
            .dataTables_scrollBody {
                max-height: 500px;
            }

            /* temp fix */
            .h-33px {
                height: 33px;
            }
        </style>

        @if(isset($jobs))

        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card _shadow-1">
                        <div class="card-header">
                            <h4>Contractor Properties</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-nowrap w-100" id="dashboard_properties_with_statuses" style="max-height: 500px !important">
                                <thead>
                                <tr>
                                    <th class="text-uppercase" style="background: #1A47A3 !important; opacity: 1; z-index: 1;min-width:16pc;">Address</th>
                                    <th class="text-uppercase" style="min-width: 5pc;">Status</th>
                                    @foreach ($jobs as $key => $entry)
                                        <th class="text-uppercase" style="min-width: 4.5pc;">{{shortName($entry['title'])}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody id="tablecontents" style="border:1px solid"></tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @endif

        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST" id="contractor-form"
                          action="{{ isset($contractor) ? route('contractor.update') : route('contractor.store')}}"
                          enctype="multipart/form-data"
                        >
                        @csrf

                        <input type="hidden" name="id" value="{{ $contractor->id ?? '' }}">
                        <input type="hidden" name="needChangeDefault" id="needChangeDefault" value="">

                        <div class="pb-3">
                            <h4 class="text-info" style="color: #1A47A3 !important;">Emergency Details</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="contractor_next_of_kin_name" class="form-label">Next of Kin</label>
                                        <input value="{{  $contractor->contractor_next_of_kin_name ?? old('contractor_next_of_kin_name') }}" type="text"
                                            name="contractor_next_of_kin_name" id="contractor_next_of_kin_name"
                                            class="form-control  @error('contractor_next_of_kin_name') is-invalid @enderror"
                                            placeholder="Enter Name"
                                        >
                                        @error('contractor_next_of_kin_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="contractor_next_of_kin_phone" class="form-label">Next of Kin Phone/Mobile</label>
                                        <input value="{{  $contractor->contractor_next_of_kin_phone ?? old('contractor_next_of_kin_phone') }}" type="text"
                                            name="contractor_next_of_kin_phone" id="contractor_next_of_kin_phone"
                                            class="form-control  @error('contractor_next_of_kin_phone') is-invalid @enderror"
                                            placeholder="Enter Phone/Mobile"
                                        >
                                        @error('contractor_next_of_kin_phone')
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
                                        <label for="contractor_safe_pass_photo" class="form-label">Safepass Photo (Max 1mb)</label>
                                        <input type="file"
                                            name="contractor_safe_pass_photo" id="contractor_safe_pass_photo"
                                            class="form-control  @error('contractor_safe_pass_photo') is-invalid @enderror"
                                            placeholder="Upload Photo"
                                            accept="image/*"
                                        >
                                        @error('contractor_safe_pass_photo')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                        @if(isset($contractor) && $contractor->contractor_safe_pass_photo != '')
                                           <div class="p-2">
                                                <img class="img-fluid" src="{{asset('/files/'.$contractor->contractor_safe_pass_photo)}}" width="300">
                                           </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="contractor_safe_pass_expiry" class="form-label">Safepass Expiry</label>
                                        <input value="{{  $contractor->contractor_safe_pass_expiry ?? old('contractor_safe_pass_expiry') }}" type="date"
                                            name="contractor_safe_pass_expiry" id="contractor_safe_pass_expiry"
                                            class="form-control  @error('contractor_safe_pass_expiry') is-invalid @enderror"
                                            placeholder="Pick Safepass Expiry"
                                        >
                                        @error('contractor_safe_pass_expiry')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                            <label for="contractor_medical_issue" class="form-label">Medical Issue(s)</label>
                                            <textarea
                                                name="contractor_medical_issue"
                                                id="contractor_medical_issue"
                                                rows="3"
                                                class="form-control"
                                                placeholder="Enter Health Issue(s)"
                                                >{{$contractor->contractor_medical_issue ?? ''}}</textarea>

                                            @error('contractor_medical_issue')
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
                                    <label for="company" class="form-label">Company <span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{  $contractor->company ?? old('company') }}" type="text"
                                           name="company" id="company"
                                           class="form-control  @error('company') is-invalid @enderror"
                                           placeholder="Enter company name"
                                           required
                                    >
                                    @error('company')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">Name <span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{  $contractor->firstname ?? old('firstname') }}" type="text"
                                           name="firstname" id="firstname"
                                           class="form-control  @error('firstname') is-invalid @enderror"
                                           placeholder="Enter name"
                                           required
                                    >
                                    @error('firstname')
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
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{  $contractor->email ?? old('email') }}"
                                           type="email" id="email" name="email"
                                           class="form-control  @error('email') is-invalid @enderror"
                                           placeholder="Enter email"
                                           required
                                    >
                                    @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password <span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <input type="password" autocomplete="false" name="password"
                                           id="password"
                                           class="form-control  @error('password') is-invalid @enderror"
                                           autocomplete="false"
                                           placeholder="Enter password"
                                        {{ isset($contractor) ? '' : 'required' }}
                                    >
                                    @error('password')
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
                                    <label for="phone" class="form-label">Phone <span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{  $contractor->phone ?? old('phone') }}"
                                           type="text" id="phone" name="phone"
                                           class="form-control  @error('phone') is-invalid @enderror"
                                           placeholder="Enter phone"
                                           required
                                    >
                                    @error('phone')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="eircode" class="form-label">Eircode <span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{  $contractor->eircode ?? old('eircode') }}"
                                           type="text" id="eircode" name="eircode"
                                           class="form-control  @error('eircode') is-invalid @enderror"
                                           placeholder="Enter eircode"
                                           required
                                    >
                                    @error('eircode')
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
                                    <label for="address1" class="form-label">Address 1</label>
                                    <input value="{{  $contractor->address1 ?? old('address1') }}" type="text"
                                           name="address1" id="address1"
                                           class="form-control  @error('address1') is-invalid @enderror"
                                           placeholder="Enter address 1"
                                    >
                                    @error('address1')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address2" class="form-label">Address 2</label>
                                    <input value="{{  $contractor->address2 ?? old('address2') }}" type="text"
                                           name="address2" id="address2"
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

                        </div>


                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address3" class="form-label">Address 3</label>
                                    <input value="{{  $contractor->address3 ?? old('address3') }}" type="text"
                                           name="address3" id="address3"
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


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="county" class="form-label">County <span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <select name="county"
                                            class="form-select  @error('county') is-invalid @enderror"
                                            id="county"
                                            required
                                    >
                                        @foreach($counties as $county)
                                            <option
                                                {{ ( isset($contractor) ? ($contractor->county == $county ? 'selected' : '') : '' ) ?? (old(county) == $contractor->county ? 'selected': '' ) }} value="{{$county}}">{{$county}}
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
                            <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="defatult_contractor" class="form-label">Default Contractor ?</label>
                                        <select name="is_default_contractor"
                                            class="form-select  @error('is_default_contractor') is-invalid @enderror"
                                            id="is_default_contractor"
                                            required
                                        >
                                        <option {{ ( isset($contractor) ? ($contractor->is_default_contractor == 0 ? 'selected' : '') : 'selected' ) ?? (old(is_default_contractor) == 0 ? 'selected': '' ) }} value="0">No</option>
                                        <option {{ ( isset($contractor) ? ($contractor->is_default_contractor == 1 ? 'selected' : '') : '' ) ?? (old(is_default_contractor) == 1 ? 'selected': '' ) }} value="1">YES</option>
                                        </select>
                                        <small class="defaultContractor"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                            <?php
                            $measures = [
                                'Ventilation',
                                'Plumbing',
                                'Windows',
                                'Airtightness',
                                'Scafolding',
                                'Ber',
                                'PV',
                                'Solar',
                                'External',
                                'Internal',
                                'Sprayfoam',
                                'Extraction',
                                'General',
                                'Carpentry',
                                'Electrical',
                                'DCV/ MHRV'
                            ]

                            ?>

                        <div class="row">
                            <div class="col-lg-6">

                                @foreach($measures as $measure)
                                    <div class="my-1">
                                        <input
                                            class="mr-3"
                                            type="checkbox"
                                            name="skills[]"
                                            value="{{$measure}}"

                                            {{isset($contractor) ? str_contains($contractor->jobs, $measure) ? 'checked' : '' : ''}}

                                        >
                                        <label for="{{$measure}}">{{$measure}}</label>
                                    </div>
                                @endforeach

                            </div>

                        </div>



                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('contractor')}}" type="submit"
                                   class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                   @if(!$show)
                                @isset($contractor)
                                    <button type="submit" class="btn _btn-primary float-end">UPDATE CONTRACTOR</button>
                                @else
                                    <button type="submit" class="btn _btn-primary float-end">ADD CONTRACTOR</button>
                                @endisset
                                @endif
                            </div>
                        </div>

                    </form>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->

    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            @if($show)
            $("#contractor-form :input").prop("disabled", true);
            @endif
        });
        $(document).on('change','#is_default_contractor', function(e){
            e.preventDefault();
            var isDefault = $(this).val();
            if(isDefault == 1){
                $.ajax({
                    type: 'POST',
                    url: "{{ route('checkDefaultContractor') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            // console.log(response.data);
                            var textMsg = "You've already added "+response.data.firstname+" as a default Contractor. Are you sure you want to change a default contractor to "+$('#firstname').val()+".";
                            $('.defaultContractor').text(textMsg);
                            $('#needChangeDefault').val(response.data.id);
                            $('.defaultContractor').css('color','red');
                        } else {
                            $('#needChangeDefault').val(null);
                            var textMsg = "Default Contractor is Avaialble to Assign."
                            $('.defaultContractor').text(textMsg);
                            $('.defaultContractor').css('color','#1A47A3');
                            // alert('Not deleted.');
                        }
                    }
                });
            // alert(isDefault);
            }

        });
    </script>
@endpush