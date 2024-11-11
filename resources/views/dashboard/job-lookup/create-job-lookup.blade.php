@extends('layouts.dashboard.app')

@section('content')
<style>
    #job-document-lookup-datatable tbody tr td:nth-child(2){
        white-space: nowrap !important;
  overflow: hidden !important;
  text-overflow: ellipsis !important;
  max-width: 400px !important;
    }
</style>
<div class="d-flex align-items-center">
    <a href="{{route('lookup.job')}}">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mdi mdi-menu cliclef mr-3">
        <rect width="32" height="32" rx="16" fill="#E2E8ED" />
        <path
            d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
            fill="black" />
    </svg>
    </a>
    @isset($lookup)
        <h4 class="page-title">UPDATE JOB (Measure)</h4>
    @else
        <h4 class="page-title">NEW JOB (Measure)</h4>
    @endisset
</div>
    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST"
                          action="{{ isset($lookup) ? route('lookup.job.update', $lookup->id) : route('lookup.job.save')}}"
                    >
                        @csrf

                        @if(isset($lookup))
                            @method('put')
                        @else
                            @method('post')
                        @endif

                        <input type="hidden" name="id" value="{{ $lookup->id ?? '' }}">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type <span class="text-danger"
                                                                                    title="Required field">*</span></label>
                                    <select name="type"
                                            class="form-select  @error('scheme') is-invalid @enderror"
                                            id="_type"
                                            required
                                    >
                                        @foreach($types as $key => $type)
                                            <option
                                                {{(isset($lookup) ? ($lookup->type == $key ? 'selected' : '') : '' ) ?? (old(type) == $key ? 'selected': '' ) }} value="{{$key}}">{{$type}}
                                            </option>

                                        @endforeach
                                    </select>
                                    @error('type')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger"
                                                                                      title="Required field">*</span></label>
                                    <input value="{{  $lookup->title ?? old('title') }}"
                                           type="text" id="title" name="title"
                                           class="form-control  @error('title') is-invalid @enderror"
                                           placeholder="Enter title"
                                           required
                                    >
                                    @error('title')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('lookup.job')}}" type="submit"
                                   class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                @isset($lookup)
                                    <button type="submit" class="btn _btn-primary float-end">UPDATE JOB</button>
                                @else
                                    <button type="submit" class="btn _btn-primary float-end">ADD JOB</button>
                                @endisset

                            </div>
                        </div>
                    </form>


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->


    @isset($lookup)
        <h4 class="page-title">DOCUMENT JOBS</h4>
        <div class="row">
            <div class="col-12">
                <div class="card _shadow-1">
                    <div class="card-body">

                        <form method="POST" action="{{route('lookup.job.document.save', $lookup->id)}}">
                            @csrf
                            <div class="form">
                                <div class="" id="document_lookup_input_fields_container">
                                    <div class="form-group">
                                        <input value=""
                                               type="text" name="documents[]"
                                               class="form-control my-1"
                                               placeholder="Document title"
                                               required
                                               id="first"
                                        >
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-sm _btn-primary mt-1" id="add_more_button">Add
                                        More
                                    </button>
                                </div>

                                <div class="form-group mt-2">
                                    <button type="submit" class="btn _btn-primary float-end">ADD DOCUMENT JOBS
                                    </button>
                                </div>

                            </div>

                        </form>


                        <div class="mt-5">
                            <table id="job-document-lookup-datatable"
                                   class="table table-bordered dt-responsive nowrap w-100 mt-2">
                                <thead>
                                <tr>
                                    <th style="width: 100px">ID</th>
                                    <th>TITLE</th>
                                    <th style="width: 100px">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>

            const inputFieldHtml = `<div class="form-group d-flex justify-content-end" id="doucment_lookup_field_%id%">
                                    <input value=""
                                           type="text" name="documents[]"
                                           class="form-control my-1"
                                           placeholder="Document title"
                                           required
                                    >
                                    <button type="button" onclick="removeField('doucment_lookup_field_%id%')" class="btn btn-sm btn-danger mt-1 ml-1 py-1 remove_document_lookup_button" style="height: 36px">Remove</button></div>`;

            const addMoreButton = document.getElementById('add_more_button');
            const documentLookupInputFieldsContainer = document.getElementById('document_lookup_input_fields_container');

            addMoreButton.addEventListener('click', (e) => {
                documentLookupInputFieldsContainer.insertAdjacentHTML('beforeend', inputFieldHtml.replaceAll('%id%', Date.now));
            });

            const removeField = (id) => {
                document.getElementById(id).remove();
            }

        </script>

    @endif

@endsection
