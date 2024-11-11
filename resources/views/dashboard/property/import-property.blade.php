@extends('layouts.dashboard.app')

@section('content')
<div class="col-md-12 mt-3 d-flex justify-content-start align-items-center">
        <a href="{{ url('/dashboard/property/0/') }}">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="mdi mdi-menu cliclef mr-3">
                <rect width="32" height="32" rx="16" fill="#E2E8ED" />
                <path
                    d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
                    fill="black" />
            </svg>
        </a>
            <h4 class="page-title">IMPORT PROPERTY</h4>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST" action="{{ route('property.import.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="batch_id" class="form-label">Batch <span class="text-danger" title="Required field">*</span></label>
                                    <select name="batch_id" class="form-select  @error('batch_id') is-invalid @enderror" id="batch_id" required>
                                        <option value="" selected></option>
                                        @foreach($batches  as $batch)
                                            <option data_scheme_id="{{$batch->scheme_id}}" value="{{$batch->id}}">
                                                {{$batch->our_ref}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('batch_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="client_id" class="form-label">Client <span class="text-danger" title="Required field">*</span></label>
                                    <select name="client_id" class="form-select  @error('client_id') is-invalid @enderror" id="client_id" required>
                                        <option value="" selected></option>
                                        @foreach($clients  as $client)
                                            <option value="{{$client->id}}">
                                                {{$client->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="file" class="form-label">File <span class="text-danger" title="Required field">*</span></label>
                                    <input type="file" id="file" name="file" required accept=".csv" class="form-control  @error('file') is-invalid @enderror">
                                    @error('file')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('property', $back ? $back : 0)}}" type="submit"
                                   class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                <button type="submit" class="btn _btn-primary float-end">IMPORT</button>
                            </div>
                        </div>

                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
