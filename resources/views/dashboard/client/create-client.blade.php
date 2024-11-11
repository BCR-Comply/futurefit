@extends('layouts.dashboard.app')

@section('content')
<div class="d-flex align-items-center">
    <a href="{{route('client')}}">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mdi mdi-menu cliclef mr-3">
        <rect width="32" height="32" rx="16" fill="#E2E8ED" />
        <path
            d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
            fill="black" />
    </svg>
    </a>
    @isset($client)
        <h4 class="page-title">UPDATE CLIENT</h4>
    @else
        <h4 class="page-title">NEW CLIENT</h4>
    @endisset
</div>
    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST" action="{{ isset($client) ? route('client.update') : route('client.store') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $client->id ?? '' }}">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{ $client->name ?? old('name') }}" type="text" id="name"
                                        name="name" class="form-control  @error('name') is-invalid @enderror"
                                        placeholder="Enter name" required>
                                    @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email
                                        <span class="text-danger"
                                        title="Required field">*</span>
                                    </label>
                                    <input value="{{ $client->email ?? old('email') }}" type="email" id="email"
                                        name="email" class="form-control  @error('email') is-invalid @enderror"
                                        placeholder="Enter email" required>
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
                                    <label for="phone" class="form-label">Phone</label>
                                    <input value="{{ $client->phone ?? old('phone') }}" type="tel" id="phone"
                                        name="phone" class="form-control  @error('phone') is-invalid @enderror"
                                        placeholder="Enter phone">
                                    @error('phone')
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
                                    <input value="{{ $client->address1 ?? old('address1') }}" type="tel" id="address1"
                                        name="address1" class="form-control  @error('address1') is-invalid @enderror"
                                        placeholder="Enter address 1" required>
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
                                    <input value="{{ $client->address2 ?? old('address2') }}" type="tel" id="address2"
                                        name="address2" class="form-control  @error('address2') is-invalid @enderror"
                                        placeholder="Enter address 2">
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
                                    <input value="{{ $client->address3 ?? old('address3') }}" type="tel" id="address3"
                                        name="address3" class="form-control  @error('address3') is-invalid @enderror"
                                        placeholder="Enter address 3">
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
                                    <label for="county" class="form-label">County <span class="text-danger"
                                            title="Required field">*</span></label>
                                    <select name="county" class="form-select  @error('county') is-invalid @enderror"
                                        id="county" required>
                                        @foreach ($counties as $county)
                                            <option
                                                {{ (isset($client) ? ($client->county == $county ? 'selected' : '') : '') ?? (old(county) == $county ? 'selected' : '') }}
                                                value="{{ $county }}">{{ $county }}</option>
                                        @endforeach
                                    </select>
                                    @error('county')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="eircode" class="form-label">Eircode <span class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{ $client->eircode ?? old('eircode') }}" type="text"
                                        id="eircode" name="eircode"
                                        class="form-control  @error('eircode') is-invalid @enderror"
                                        placeholder="Enter eircode" required>
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
                                    <label for="notes" class="form-label">Notes</label>

                                    <textarea class="form-control  @error('notes') is-invalid @enderror" name="notes" id="notes" cols="30"
                                        rows="10">{{ $client->notes ?? old('notes') }}</textarea>

                                    @error('notes')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{ route('client') }}" type="submit"
                                    class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                @isset($client)
                                    <button type="submit" class="btn _btn-primary float-end">UPDATE CLIENT</button>
                                @else
                                    <button type="submit" class="btn _btn-primary float-end">ADD CLIENT</button>
                                @endisset

                            </div>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
@endsection
