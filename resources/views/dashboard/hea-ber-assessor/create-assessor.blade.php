@extends('layouts.dashboard.app')

@section('content')
<div class="d-flex align-items-center">
    <a href="{{route('assessor')}}">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mdi mdi-menu cliclef mr-3">
        <rect width="32" height="32" rx="16" fill="#E2E8ED" />
        <path
            d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
            fill="black" />
    </svg>
    </a>
    @if($show)
        <h4 class="page-title">VIEW ASSESSOR</h4>
    @else
    @isset($assessor)
        <h4 class="page-title">UPDATE ASSESSOR</h4>
    @else
        <h4 class="page-title">NEW ASSESSOR</h4>
    @endisset
    @endif
</div>
@if(isset($assessor->assessor_properties))
        <div class="row">
            <div class="col-12">
                <div class="card _shadow-1">
                    <div class="card-body">
                        <h4 style="color: #1A47A3 !important;">Assessor Properties</h4>
                        <table class="table table-bordered" id="contractor-properties-table">
                            <thead>
                            <th>Property ID</th>
                            <th>Occupier</th>
                            <th>Batch</th>
                            <th>Address</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($assessor->assessor_properties as $property)
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
    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST" id="assessor-form"
                          action="{{ isset($assessor) ? route('assessor.update') : route('assessor.store')}}">
                        @csrf

                        <input type="hidden" name="id" value="{{ $assessor->id ?? '' }}">


                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="company" class="form-label">Company <span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{  $assessor->company ?? old('company') }}" type="text"
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
                                    <input value="{{  $assessor->firstname ?? old('firstname') }}" type="text"
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
                                    <input value="{{  $assessor->email ?? old('email') }}"
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
                                        {{ isset($assessor) ? '' : 'required' }}
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
                                    <input value="{{  $assessor->phone ?? old('phone') }}"
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
                                    <input value="{{  $assessor->eircode ?? old('eircode') }}"
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
                                    <input value="{{  $assessor->address1 ?? old('address1') }}" type="text"
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
                                    <input value="{{  $assessor->address2 ?? old('address2') }}" type="text"
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
                                    <input value="{{  $assessor->address3 ?? old('address3') }}" type="text"
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
                                                {{ ( isset($assessor) ? ($assessor->county == $county ? 'selected' : '') : '' ) ?? (old(county) == $assessor->county ? 'selected': '' ) }} value="{{$county}}">{{$county}}
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

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('assessor')}}" type="submit"
                                   class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                @if(!$show)
                                @isset($assessor)
                                    <button type="submit" class="btn _btn-primary float-end">UPDATE ASSESSOR</button>
                                @else
                                    <button type="submit" class="btn _btn-primary float-end">ADD ASSESSOR</button>
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
            $("#assessor-form :input").prop("disabled", true);
            @endif
        });
    </script>
@endpush