@extends('layouts.dashboard.app')

@section('content')
<div class="d-flex align-items-center">
    <a href="{{route('document.index')}}">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mdi mdi-menu cliclef mr-3">
        <rect width="32" height="32" rx="16" fill="#E2E8ED" />
        <path
            d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
            fill="black" />
    </svg>
    </a>
    <h4 class="page-title">NEW DOCUMENT</h4>
</div>
    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST" action="{{ route('document.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="job_lookup" class="form-label">Job Lookups
                                        <span class="text-danger" title="Required field">*</span>
                                    </label>
                                    <select name="job_lookup" class="form-select  @error('job_lookup') is-invalid @enderror" id="job_lookup" required>
                                        <option value=""></option>
                                        @foreach($lookups as $lookup)
                                            <option value="{{ $lookup->id }}">{{$lookup->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('job_lookup')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="job_document" class="form-label">Job Documents
                                        <span class="text-danger" title="Required field">*</span>
                                    </label>
                                    <select name="job_document" class="form-select  @error('job_document') is-invalid @enderror" id="job_document" required>
                                        <option job_lookup = "" value=""></option>
                                        @foreach($job_documents as $job_document)
                                            <option job_lookup = "{{ $job_document->job_look_id }}" value="{{ $job_document->id }}">{{$job_document->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('job_document')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="document" class="form-label">Upload Document
                                        <span class="text-danger" title="Required field">*</span>
                                    </label>
                                    <input type="file" accept=".txt,.pdf,.jpg,.jpeg,.png,.pdf,.xlsx,.xlsm,.xls,.pptx,.doc,.rtf,.gif" name="document" id="document" class="form-control @error('document') is-invalid @enderror" required>
                                    @error('document')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('document.index')}}" type="submit" class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                <button type="submit" class="btn _btn-primary float-end">ADD DOCUMENT</button>
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
        let job_documents = $('#job_document').find('option');
        $(document).on("change","#job_lookup", function(e){
            var selected_option = $('#job_lookup option:selected').val();
           
            var elem = $('#job_document').html(job_documents.filter(`[job_lookup="${selected_option}"]`));
        }).trigger('change');
    </script>
@endpush