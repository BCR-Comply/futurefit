@extends('layouts.dashboard.app')

@section('content')
    <style>
        video {
            height: 90px;
            width: 96px;
            object-fit: cover;
        }

        .folder-photos>h4 {
            color: #1A47A3;
        }

        .close-btn:has(+ video) {
            right: -63px !important;
        }

        .upload__img-box>div>video {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
        }

        #editor-controls {
            border-top: 2px solid #e6e6e6;
            margin-top: 20px;
        }

        #font-color,
        #font-size {
            z-index: 0;
            margin-left: 5px;
        }

        #font-color:before,
        #font-size:before {
            z-index: 2;
        }

        #font-color:after {
            content: "";
            position: absolute;
            width: 4px;
            left: 50px;
            border-radius: 50%;
            height: 4px;
            top: 9px;
            z-index: -1;
            box-shadow:
                -4px 0 0 rgb(190, 190, 190),
                37px 0 0 rgb(190, 190, 190),
                78px 0 0 rgb(190, 190, 190);
        }

        #font-size:after {
            content: "";
            position: absolute;
            width: 4px;
            left: 25px;
            border-radius: 50%;
            height: 4px;
            top: 6px;
            z-index: -1;
            box-shadow:
                4px 0 0 rgb(190, 190, 190),
                26px 0 0 rgb(190, 190, 190),
                50px 0 0 rgb(190, 190, 190),
                73px 0 0 rgb(190, 190, 190),
                97px 0 0 rgb(190, 190, 190),
                120px 0 0 rgb(190, 190, 190);
        }

        #font-color::-webkit-slider-thumb,
        #font-size::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            border-radius: 17px;
            box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.3);
        }

        #font-color::-moz-range-thumb,
        #font-size::-moz-range-thumb {
            -webkit-appearance: none;
            appearance: none;
            border-radius: 17px;
            box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.3);
        }

        .upload__img-box {
            position: relative;
        }

        .canvas-container {
            margin-bottom: 0.5rem !important;
            margin: 0 auto !important;
        }

        #font-size {
            margin-bottom: 0.375rem !important;
        }

        .deviders {
            border-top: 1px solid #e6e6e6;
            padding-block: 10px;
        }

        .mfp-wrap {
            display: -webkit-flex;
            display: flex;
            list-style-type: none;
            padding: 0;
            justify-content: flex-end;
        }

        .mfp-container {
            width: 75%;
        }

        .additional-details {
            width: 25%;
            background: #fff;
        }

        .mfp-counter {
            display: none !important;
        }

        .zoom150 {
            zoom: 200%;
        }

        .play-icon {
            position: relative;
            left: 42px;
            bottom: 101px;
            filter: drop-shadow(0px 0px 6px gray);
        }

        .vi-icon {
            bottom: 164px;
        }
        .magnific__img-close,
        .magnific__img-close3 {
            z-index: -1;
        }
    </style>
    <h4 class="page-title">View Contract</h4>


    <div class="row mt-2">
        <div class="col-sm-12 pr-0">
            <div class="card _shadow-1 mb-2">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" style="border-bottom: transparent 1px solid">
                            <tr>
                                <td class="py-0" style="border-right: 1px #808080 solid">
                                    <div>
                                        <h5>Occupier</h5>
                                        <p>
                                            <b>
                                                {{ $property->wh_fname . ' ' . $property->wh_lname }}
                                                <br>
                                                {{ $property->phone1 }}
                                                <br>
                                                {{ $property->email }}
                                            </b>
                                        </p>
                                    </div>
                                </td>

                                <td class="py-0" style="border-right: 1px #808080 solid">
                                    <div>
                                        <h5>Client</h5>
                                        <p><b>{{ isset($property['client']) ? $property['client']['name'] : '' }}</b></p>
                                    </div>
                                </td>

                                <td class="py-0" style="border-right: 1px #808080 solid">
                                    <div>
                                        <h5>Address</h5>
                                        <p>
                                            <b>
                                                {{ format_address(
                                                    $property->house_num,
                                                    $property->address1,
                                                    $property->address2,
                                                    $property->address3,
                                                    $property->county,
                                                    $property->eircode,
                                                ) }}
                                        </p>
                                    </div>
                                </td>
                                <td class="py-0" style="border-right: 1px #808080 solid">

                                    <div>
                                        <h5 class="mb-0">Start Date:</h5>
                                        <p>{{ date('d/m/Y', strtotime($property['start_date'])) }}</p>
                                    </div>

                                    <div>
                                        <h5 class="my-0">End Date:</h5>
                                        <p>{{ date('d/m/Y', strtotime($property['end_date'])) }}</p>
                                    </div>

                                </td>

                                <td class="py-0" style="border-right: 1px #808080 solid">
                                    <div>
                                        <h5>MPRN</h5>
                                        <p><b>{{ $property['wh_mprn'] }}</b></p>
                                    </div>
                                </td>

                                <td class="py-0">
                                    <div>
                                        <h5>Batch</h5>

                                        <p><b>{{ isset($property->batch) ? $property->batch->our_ref : '' }}</b>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @foreach ($contacts as $contract)
                        <div class="border my-3 px-2 py-1">
                            <form method="POST" action="{{ route('assessor-contract.uploadFile') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $contract['id'] }}">

                                <div class="card-body my-1 p-2">
                                    <h5>Document(s) uploaded for: <span
                                            class="text-danger">{{ $contract->job_lookup->title ?? '' }}</span>
                                    </h5>


                                    {{-- <p class="bg-secondary text-white p-2"><b>Note: </b>{{ $contract->notes }}</p>
                                    <div class="row mt-2">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="document" class="form-label">Job</label>
                                                <select name="document"
                                                    class="form-select  @error('document') is-invalid @enderror"
                                                    id="document" required>
                                                    @foreach ($jobs[$contract['job']] as $document)
                                                        <option value="{{ $document }}">{{ $document }}</option>
                                                    @endforeach
                                                </select>
                                                @error('document')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3 pt-3 mt-1">
                                                <input type="file" name="file" class="form-control" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="float-end">
                                                <button class="btn _btn-primary">Upload File</button>
                                            </div>
                                        </div>
                                    </div> --}}


                                    <div class="row">
                                        <div class="col-lg-12">

                                            @if (isset($contract['document']))
                                                <ul>
                                                    @foreach ($contract['document'] as $document)
                                                        <li>
                                                            <b>{{ $document['document'] }}:</b>
                                                            <a target="_blank"
                                                                href="/files/{{ $document['file'] }}">{{ $document['file'] }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif


                                        </div>
                                    </div>

                                    {{--                                    <div class="row"> --}}
                                    {{--                                        <div class="col-lg-12"> --}}
                                    {{--                                            <div class="mt-2"> --}}
                                    {{--                                                <label for="document" class="form-label text-danger">Documents remaining --}}
                                    {{--                                                    to --}}
                                    {{--                                                    be uploaded: </label> --}}

                                    {{--                                                <span class="text-black">{{join(", ", $contract['remaining_documents'])}}</span> --}}

                                    {{--                                            </div> --}}

                                    {{--                                        </div> --}}
                                    {{--                                    </div> --}}

                                </div>

                            </form>

                            {{--                            <hr> --}}

                            {{--                            <div class="p-2 mt-1"> --}}
                            {{--                                <form action="{{route('contract.updateStatus')}}" method="POST"> --}}
                            {{--                                    <div class="row"> --}}
                            {{--                                        @csrf --}}
                            {{--                                        <input type="hidden" name="id" value="{{$contract['id']}}"> --}}
                            {{--                                        <input type="hidden" name="property_id" value="{{$contract['property_id']}}"> --}}
                            {{--                                        <input type="hidden" name="current_status" value="{{$contract->status}}"> --}}

                            {{--                                        <div class="col-lg-6"> --}}
                            {{--                                            <div class="mb-3"> --}}
                            {{--                                                <label for="contractor_notes" class="form-label">Contractor --}}
                            {{--                                                    Notes</label> --}}
                            {{--                                                <textarea --}}
                            {{--                                                    type="text" id="contractor_notes" name="contractor_notes" --}}
                            {{--                                                    class="form-control  @error('contractor_notes') is-invalid @enderror" --}}
                            {{--                                                    placeholder="Enter contractor_notes" --}}
                            {{--                                                    rows="5" --}}
                            {{--                                                >{{  $contract->contractor_notes ?? old('contractor_notes') }}</textarea> --}}
                            {{--                                                @error('contractor_notes') --}}
                            {{--                                                <span class="text-danger" role="alert"> --}}
                            {{--                                        <strong>{{ $message }}</strong> --}}
                            {{--                                    </span> --}}
                            {{--                                                @enderror --}}
                            {{--                                            </div> --}}
                            {{--                                        </div> --}}


                            {{--                                        <div class="col-lg-6"> --}}
                            {{--                                            <div class="mb-3"> --}}

                            {{--                                                <label for="status" class="form-label">Status</label> --}}

                            {{--                                                <select name="status" --}}
                            {{--                                                        class="form-select  @error('status') is-invalid @enderror" --}}
                            {{--                                                        required> --}}

                            {{--                                                    @foreach ($contact_status as $status) --}}
                            {{--                                                        <option --}}
                            {{--                                                            value="{{$status}}" {{isset($contract) ? ($contract->status == $status ? 'selected' : '') : ''}}> --}}
                            {{--                                                            {{$status}} --}}
                            {{--                                                        </option> --}}
                            {{--                                                    @endforeach --}}

                            {{--                                                </select> --}}

                            {{--                                                @error('status') --}}
                            {{--                                                <span class="text-danger" role="alert"> --}}
                            {{--                                        <strong>{{ $message }}</strong> --}}
                            {{--                                    </span> --}}
                            {{--                                                @enderror --}}
                            {{--                                            </div> --}}

                            {{--                                        </div> --}}

                            {{--                                    </div> --}}

                            {{--                                    <div class="row"> --}}
                            {{--                                        <div class="col-13"> --}}
                            {{--                                            <button class="btn _btn-primary float-end">Update Status</button> --}}
                            {{--                                        </div> --}}
                            {{--                                    </div> --}}

                            {{--                                </form> --}}

                            {{--                                <hr> --}}

                            {{--                                <div class="my-3"> --}}
                            {{--                                    <h5 class="m-0">Work Orders</h5> --}}
                            {{--                                    @if ($contract['word_orders']) --}}
                            {{--                                        <ol class="mt-2"> --}}
                            {{--                                            @foreach ($contract['word_orders'] as $file) --}}
                            {{--                                                <li> --}}
                            {{--                                                    <div class="d-flex justify-content-between"> --}}
                            {{--                                                        <div> --}}
                            {{--                                                            <a class="{{$file['status'] != 'Active' ? 'text-secondary' : ''}}" --}}
                            {{--                                                               target="_blank" --}}
                            {{--                                                               href="/files/{{$file['status'] == 'Active' ?  $file['file_path'] : ''}}">{{$file['file_name']}}</a> --}}
                            {{--                                                        </div> --}}
                            {{--                                                    </div> --}}
                            {{--                                                </li> --}}
                            {{--                                            @endforeach --}}
                            {{--                                        </ol> --}}
                            {{--                                    @endif --}}
                            {{--                                </div> --}}
                            {{--                            </div> --}}
                        </div>
                    @endforeach
                </div> <!-- end card-body -->
            </div> <!-- end card -->


            <div class="card mt-2">
                <div class="card-body">
                    <h5>ASSESSOR CONTRACTS</h5>
                    @foreach ($assessor_contacts as $contract)
                        <div class="border my-3 px-2 py-1">
                            <form method="POST" action="{{ route('assessor-contract.uploadFile') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $contract['id'] }}">

                                <div class="card-body my-1 p-2">
                                    <h5>Document(s) uploaded for: <span
                                            class="text-danger">{{ $contract->job_lookup->title ?? '' }}</span>
                                    </h5>

                                    <p class="bg-secondary text-white p-2"><b>Note: </b>{{ $contract->notes }}</p>
                                    <div class="row mt-2">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="document" class="form-label">Job</label>
                                                <select name="document"
                                                    class="form-select  @error('document') is-invalid @enderror"
                                                    id="document" required>
                                                    @if(isset($assessor_jobs[$contract['job_id']]['documents']))
                                                        @foreach ($assessor_jobs[$contract['job_id']]['documents'] as $document)
                                                            <option value="{{ $document }}">{{ $document }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('document')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3 pt-3 mt-1">
                                                <input type="file"
                                                    accept="application/msword,
                                                       application/vnd.ms-excel,
                                                       application/vnd.ms-powerpoint,
                                                       text/plain, application/pdf, image/*"
                                                    name="files[]" class="form-control" required multiple>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="float-end">
                                                <button class="btn _btn-primary">Upload File</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">

                                            @if (isset($contract['document']))
                                                <ul>
                                                    @foreach ($contract['document'] as $document)
                                                        <li>
                                                            <b>{{ $document['document'] }}:</b>
                                                            <a target="_blank"
                                                                href="/files/{{ $document['file'] }}">{{ $document['file'] }}</a>


                                                            @if ($contract['status'] != 'Complete')
                                                                <a class="text-danger ml-2"
                                                                    href="{{ route('assessor-contract.deleteDocument', $document['id']) }}"
                                                                    onClick="return confirm(`Are you sure you want to delete this document?`)"
                                                                    title="Delete document">
                                                                    X
                                                                </a>
                                                            @endif

                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif


                                        </div>
                                    </div>

                                </div>

                            </form>

                            {{--                            <hr> --}}

                            {{--                            <div class="p-2 mt-1"> --}}
                            {{--                                <div class="my-3"> --}}
                            {{--                                    <h5 class="m-0">Work Orders</h5> --}}
                            {{--                                    @if ($contract['work_orders']) --}}
                            {{--                                        <ol class="mt-2"> --}}
                            {{--                                            @foreach ($contract['work_orders'] as $file) --}}
                            {{--                                                <li> --}}
                            {{--                                                    <div class="d-flex justify-content-between"> --}}
                            {{--                                                        <div> --}}
                            {{--                                                            <a class="{{$file['status'] != 'Active' ? 'text-secondary' : ''}}" --}}
                            {{--                                                               target="_blank" --}}
                            {{--                                                               href="/files/{{$file['status'] == 'Active' ?  $file['file_path'] : ''}}">{{$file['file_name']}}</a> --}}
                            {{--                                                        </div> --}}
                            {{--                                                    </div> --}}
                            {{--                                                </li> --}}
                            {{--                                            @endforeach --}}
                            {{--                                        </ol> --}}
                            {{--                                    @endif --}}
                            {{--                                </div> --}}
                            {{--                            </div> --}}
                        </div>
                    @endforeach
                </div> <!-- end card-body -->
            </div> <!-- end card -->

            <div class="card mt-2">
                <div class="card-body">
                    <h5>PHOTO/VIDEO</h5>
                    <div class="border my-3 px-2 py-1">
                        <div class="msg-show mb-1"></div>
                        <div class="row d-flex justify-content-end photo-row">
                            <div class="col-md-4 col-sm-12 photo-header d-none d-flex flex-wrap mb-3 align-items-center">
                                <svg class="all-folders" width="32" height="32" viewBox="0 0 32 32"
                                    fill="none" xmlns="http://www.w3.org/2000/svg" class="mdi mdi-menu cliclef mr-3">
                                    <rect width="32" height="32" rx="16" fill="#E2E8ED"></rect>
                                    <path
                                        d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
                                        fill="black"></path>
                                </svg>
                                <div class="ms-2 folder-name">
                                </div>
                            </div>
                            {{-- <div class="col-md-12 col-sm-12 photo-btn d-block mb-3 d-flex flex-wrap justify-content-end">
                                <button class="btn _btn-primary m-1 multiple-ubtn" data-pro_id="{{ $property->id }}"
                                    data-bs-toggle="modal" data-bs-target="#singleModal">Single Photo/Video Upload
                                </button>
                                <button class="btn _btn-primary multiple-ubtn m-1" data-pro_id="{{ $property->id }}"
                                    data-bs-toggle="modal" data-bs-target="#batchModal">Batch
                                    Upload
                                </button>
                                <a href="{{ url('dashboard/assessor-contract/photo/download-all', $property->id) }}">
                                    <button
                                        class="btn _btn-primary sing-img signle-ubtn d-flex align-items-center m-1"
                                        data-pro_id="{{ $property->id }}">
                                        <svg class="download-svg me-1" xmlns="http://www.w3.org/2000/svg" width="15"
                                            height="15" viewBox="0 0 20 20" fill="none">
                                            <g clip-path="url(#clip0_1326_1880)">
                                                <path
                                                    d="M1.38815 14.9729C1.42876 14.9105 1.47049 14.8488 1.51055 14.7859C2.04243 13.9514 2.5259 13.0762 3.11509 12.2823C4.84648 9.9456 8.28923 9.79371 10.2476 11.9418C10.8507 12.6028 11.411 13.3027 11.9912 13.9842C12.0224 14.0209 12.0552 14.0565 12.1025 14.1088C12.9076 12.9839 14.0008 12.3947 15.3745 12.3947C16.7481 12.3947 17.8402 12.9917 18.6653 14.1617V13.8896C18.6653 12.6056 18.6653 11.3215 18.6653 10.0374C18.6653 9.51998 19.1393 9.18617 19.5894 9.3859C19.8721 9.51053 19.9989 9.74253 19.9984 10.0535C19.9984 11.1779 20.0017 12.3023 19.9984 13.4267C19.995 14.0387 20.0106 14.6507 19.9566 15.2572C19.7536 17.5388 17.902 19.5211 15.6365 19.9016C15.3013 19.9581 14.9622 19.9875 14.6223 19.9895C11.54 19.9959 8.45762 19.9959 5.37502 19.9895C2.78684 19.9857 0.645967 18.2515 0.114644 15.7234C0.0405669 15.3633 0.00328468 14.9966 0.00337179 14.629C-0.00478814 11.5401 -0.00608672 8.45122 -0.000523132 5.36231C0.00392774 2.6712 1.90167 0.466353 4.56162 0.0540912C4.81579 0.0163525 5.07244 -0.00224513 5.3294 -0.00154466C7.47472 -0.00599553 9.61985 -0.00599553 11.7648 -0.00154466C12.2917 -0.00154466 12.6277 0.443542 12.4536 0.899756C12.3506 1.17015 12.107 1.32982 11.782 1.32982C10.4212 1.32982 9.06053 1.32982 7.70004 1.32982C6.92114 1.32982 6.14224 1.32982 5.36723 1.32982C3.10285 1.33761 1.33752 3.09682 1.33474 5.3573C1.33029 8.45326 1.33029 11.5492 1.33474 14.6452V14.9517L1.38815 14.9729Z"
                                                    fill="#1A47A3"></path>
                                                <path
                                                    d="M15.663 6.25213V3.97106C15.663 2.87392 15.663 1.77734 15.663 0.680197C15.6607 0.593218 15.6757 0.506644 15.707 0.425458C15.7383 0.344273 15.7853 0.27008 15.8454 0.207149C15.9055 0.144219 15.9774 0.0937934 16.0571 0.0587756C16.1367 0.0237577 16.2225 0.00483793 16.3095 0.00310738C16.6806 -0.00523801 16.9771 0.281287 16.9933 0.670738C16.996 0.733051 16.9933 0.795919 16.9933 0.858231V6.20317L17.0439 6.23544C17.0834 6.17981 17.1184 6.12417 17.1624 6.07521C17.7143 5.46062 18.2673 4.84695 18.8215 4.23422C19.0106 4.02614 19.2471 3.95214 19.5203 4.03615C19.7845 4.11794 19.9653 4.30488 19.9715 4.57416C19.9765 4.75219 19.9236 4.97696 19.8112 5.10659C19.1397 5.88549 18.4582 6.65382 17.7527 7.39823C17.5707 7.59362 17.3505 7.7495 17.1058 7.85618C16.861 7.96287 16.597 8.01808 16.33 8.0184C16.063 8.01871 15.7988 7.96411 15.5538 7.858C15.3088 7.75189 15.0882 7.59653 14.9058 7.40157C14.1914 6.65438 13.5116 5.87381 12.825 5.10047C12.7666 5.03542 12.7218 4.95926 12.6934 4.87652C12.665 4.79379 12.6536 4.70619 12.6599 4.61895C12.6661 4.5317 12.6898 4.44661 12.7297 4.36875C12.7695 4.29089 12.8247 4.22187 12.8918 4.16579C12.9567 4.1075 13.0327 4.06281 13.1151 4.03433C13.1976 4.00586 13.2849 3.99418 13.372 3.99999C13.459 4.00579 13.5441 4.02897 13.622 4.06815C13.7 4.10732 13.7693 4.16171 13.8259 4.2281C14.3823 4.83676 14.9336 5.45209 15.4866 6.06742C15.5317 6.11304 15.5818 6.16367 15.663 6.25213Z"
                                                    fill="#1A47A3"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1326_1880">
                                                    <rect width="20" height="19.9955" fill="white"
                                                        transform="translate(-0.00195312 0.000976562)"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        Download All Folders
                                    </button>
                                </a>
                            </div> --}}
                        </div>
                        <div class="folder-photos d-none">
                            <section class="img-gallery-magnific">
                            </section>
                            <div class="clear"></div>
                        </div>
                        @if (sizeOf($getfolders))
                            <div class="photo-folders d-flex flex-wrap">
                                @foreach ($getfolders as $folders)
                                    <div class="file me-1 mb-1" data-pro_id="{{ $property->id }}"
                                        data-sec_id="{{ $folders->fk_section_id }}">
                                        <div class="file-icon d-flex justify-content-center">
                                            <svg width="80" height="80" viewBox="0 0 96 96" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1109_15687)">
                                                    <path
                                                        d="M79.9143 36.7151C82.3512 36.7151 84.7872 36.719 87.2225 36.7268C90.0415 36.7268 91.7964 38.9961 91.0164 41.7118C89.2922 47.7256 87.5326 53.7113 85.7849 59.7064C84.1545 65.3115 82.496 70.9096 80.8939 76.5217C80.1187 79.228 78.5447 81.072 75.7257 81.6899C75.3525 81.7662 74.972 81.8016 74.5911 81.7956C54.1612 81.7956 33.7312 81.7956 13.3013 81.7956C13.0077 81.7956 12.714 81.7768 12.4204 81.7651C12.3828 81.2788 12.7916 81.2012 13.0969 81.0861C15.2793 80.2592 16.5173 78.6501 17.1563 76.4465C20.4733 64.9756 23.8538 53.5257 27.1591 42.0524C27.885 39.5317 29.2028 37.589 31.7564 36.6704C32.4454 36.4159 33.1737 36.2839 33.9082 36.2805C48.7549 36.2711 63.6017 36.2711 78.4484 36.2805C78.9699 36.2969 79.5079 36.2781 79.9143 36.7151Z"
                                                        fill="#3F69BD" />
                                                    <path
                                                        d="M79.9175 36.7157L34.6631 36.7274C30.9279 36.7274 28.7315 38.3366 27.6814 41.9238C25.0284 50.9915 22.3879 60.0625 19.76 69.1365C19.0294 71.6431 18.2565 74.1379 17.5706 76.6538C16.8282 79.3718 15.104 81.0444 12.4165 81.7797C10.3399 81.9677 8.44643 81.5448 6.87249 80.086C6.21214 79.4991 5.68576 78.777 5.32907 77.9688C4.97238 77.1606 4.79371 76.2851 4.80521 75.4017C4.80521 56.8809 4.80521 38.3608 4.80521 19.8416C4.80521 16.5739 7.22956 14.2036 10.516 14.1848C17.5635 14.1676 24.6071 14.1676 31.6468 14.1848C32.7974 14.1641 33.937 14.4114 34.9755 14.9072C36.0139 15.403 36.9228 16.1337 37.6301 17.0414C38.7084 18.3593 39.8055 19.6607 40.8508 21.0044C42.2063 22.7499 43.9188 23.5885 46.1646 23.565C55.3804 23.518 64.5962 23.5415 73.812 23.5486C76.8659 23.5486 79.0953 25.193 79.7577 27.918C79.8698 28.4942 79.9132 29.0817 79.8869 29.6682C79.9042 32.0205 79.9143 34.3696 79.9175 36.7157Z"
                                                        fill="#1A47A3" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1109_15687">
                                                        <rect width="86.4" height="67.6466" fill="white"
                                                            transform="translate(4.80078 14.1758)" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="file-txt d-flex justify-content-center">
                                            <span class="text-center folder-txt">{{ $folders->fk_section_name }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card _shadow-2 my-1 measureBox mb-3">
                                <span style="margin: 15px auto;">No photo/video added yet.</span>
                            </div>
                        @endif
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->

        </div><!-- end col -->
    </div><!-- end row -->
    <!--Image Editor Modal -->
    <div id="nestMod"></div>
    <!--Batch Modal -->
    <div class="modal fade" id="batchModal" tabindex="-1" aria-labelledby="batchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h4 class="modal-title" id="exampleModalLabel">Batch Upload</h1>
                        <svg class="modal-cls-btn" data-bs-dismiss="modal" aria-label="Close" width="18"
                            height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path id="Arrow Left" fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.99335 14.6187C8.38758 15.0511 8.39331 15.7459 8.00006 16.1773C7.60954 16.6056 6.98129 16.611 6.58171 16.1727L0.29715 9.27933C-0.0956605 8.84846 -0.102425 8.15731 0.29715 7.71902L6.58171 0.825611C6.97453 0.394745 7.60682 0.389723 8.00006 0.821065C8.39059 1.24942 8.39192 1.94245 7.99335 2.37964L3.41431 7.4023L16.9975 7.4023C17.5512 7.4023 18 7.88916 18 8.49917C18 9.10496 17.5475 9.59605 16.9975 9.59605L3.41431 9.59605L7.99335 14.6187Z"
                                fill="#2A2D34" />
                        </svg>
                </div>
                <form class="photo-form-save" method="POST" enctype="multipart/form-data"
                    action="{{ route('property.photo.store') }}">
                    @csrf
                    <input type="hidden" class="fk_property_id" name="fk_property_id" value="{{ $property->id }}"
                        required>
                    <input type="hidden" class="fid" name="folder_id" required>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label">Select Section</label>
                            <select class="form-select folder_select" name="folder_id"
                                aria-label="Default select example" required>
                                @foreach ($folderLists as $folderList)
                                    <option class="folder_id" value="{{ $folderList->id }}">
                                        {{ $folderList->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="upload__img-wrap"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="upload__btn-box">
                            <label class="btn _btn-primary w-100 mt-0 mb-0 sing-img batch-img-btn">
                                <span>Add Photos/Videos</span>
                                <input type="file" name="photo_img[]" accept="image/*,video/*" data-max_length="500"
                                    class="upload__inputfile" multiple required>
                                <div id="fileList"></div>
                            </label>
                        </div>
                        <button type="submit" class="btn action-btn w-100 mt-0 mb-0">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Single Modal -->
    <div class="modal fade" id="singleModal" tabindex="-1" aria-labelledby="singleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h4 class="modal-title" id="exampleModalLabel">Single Photo/Video Upload</h1>
                        <svg class="modal-cls-btn" data-bs-dismiss="modal" aria-label="Close" width="18"
                            height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path id="Arrow Left" fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.99335 14.6187C8.38758 15.0511 8.39331 15.7459 8.00006 16.1773C7.60954 16.6056 6.98129 16.611 6.58171 16.1727L0.29715 9.27933C-0.0956605 8.84846 -0.102425 8.15731 0.29715 7.71902L6.58171 0.825611C6.97453 0.394745 7.60682 0.389723 8.00006 0.821065C8.39059 1.24942 8.39192 1.94245 7.99335 2.37964L3.41431 7.4023L16.9975 7.4023C17.5512 7.4023 18 7.88916 18 8.49917C18 9.10496 17.5475 9.59605 16.9975 9.59605L3.41431 9.59605L7.99335 14.6187Z"
                                fill="#2A2D34" />
                        </svg>
                </div>
                <form class="photo-form-save" method="POST" enctype="multipart/form-data"
                    action="{{ route('property.photo.store') }}">
                    @csrf
                    <input type="hidden" class="fk_property_id" name="fk_property_id" value="{{ $property->id }}"
                        required>
                    <input type="hidden" class="fid" name="folder_id" required>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Select Section</label>
                            <select class="form-select folder_select" name="folder_id"
                                aria-label="Default select example" required>
                                @foreach ($folderLists as $folderList)
                                    <option class="folder_id" value="{{ $folderList->id }}">
                                        {{ $folderList->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1 simgprev">
                            <div class="file-wrapper-bg">
                            </div>
                            <div class="file-wrapper">
                                <input type="file" id="photo_img" accept="image/*,video/*" name="photo_img[]"
                                    required />
                                <div class="close-btn">×</div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label class="col-form-label">Add Comment</label>
                            <input type="text" name="photo_comment" class="form-control" placeholder="Comment">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn _btn-primary w-100 mt-0 mb-0">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script>
        function htmlData() {
            $('#nestMod').empty();
            var html = '';
            html +=
                '<div class="modal fade" id="imageEditorModal" tabindex="-1" role="dialog" aria-labelledby="imageEditorModalLabel" aria-hidden="true" style="z-index: 9999;">';
            html +=
                '<div class="modal-dialog modal-lg" style="max-width:fit-content !important;min-width: 680px !important;" role="document">';
            html += '<div class="modal-content">';
            html += '<div class="modal-body pb-1">';
            html +=
                '<button type="button" class="close closeBtn" id="closeBtn" style="z-index:99;border: unset; background: unset; line-height: 1; font-size: 24px; position: absolute; right: 13px; background: #1A47A3; border-radius: 36px; color: #fff; cursor: pointer;">';
            html += '<span aria-hidden="true">&times;</span>';
            html += '</button>';
            html += '<input type="hidden" name="fname">';
            html += '<canvas id="canvas" class="mb-2"></canvas>';
            html += '<div id="editor-controls">';
            html += '<div class="d-flex justify-content-between align-items-center pt-1 pb-1 mt-1 mb-1">';
            html += '<div class="d-flex align-items-center" style="gap: 5px;">';
            html +=
                '<div class=""><button id="add-text-button" class="btn _btn-primary" style="font-weight:600;background:#fff !important;color:#1A47A3 !important; border:1px solid #1A47A3 !important;">';
            html +=
                '<svg class="me-1" width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">';
            html +=
                '<path d="M6.1237 13.4544C5.77648 13.4544 5.48148 13.3328 5.2387 13.0894C4.99536 12.8466 4.8737 12.5516 4.8737 12.2044V2.62109H1.95703C1.60981 2.62109 1.31481 2.49943 1.07203 2.25609C0.828698 2.01332 0.707031 1.71832 0.707031 1.37109C0.707031 1.02387 0.828698 0.728872 1.07203 0.486094C1.31481 0.242761 1.60981 0.121094 1.95703 0.121094H10.2904C10.6376 0.121094 10.9326 0.242761 11.1754 0.486094C11.4187 0.728872 11.5404 1.02387 11.5404 1.37109C11.5404 1.71832 11.4187 2.01332 11.1754 2.25609C10.9326 2.49943 10.6376 2.62109 10.2904 2.62109H7.3737V12.2044C7.3737 12.5516 7.25203 12.8466 7.0087 13.0894C6.76592 13.3328 6.47092 13.4544 6.1237 13.4544ZM13.6237 13.4544C13.2765 13.4544 12.9815 13.3328 12.7387 13.0894C12.4954 12.8466 12.3737 12.5516 12.3737 12.2044V6.78776H11.1237C10.7765 6.78776 10.4815 6.66609 10.2387 6.42276C9.99536 6.17998 9.8737 5.88498 9.8737 5.53776C9.8737 5.19054 9.99536 4.89554 10.2387 4.65276C10.4815 4.40943 10.7765 4.28776 11.1237 4.28776H16.1237C16.4709 4.28776 16.7659 4.40943 17.0087 4.65276C17.252 4.89554 17.3737 5.19054 17.3737 5.53776C17.3737 5.88498 17.252 6.17998 17.0087 6.42276C16.7659 6.66609 16.4709 6.78776 16.1237 6.78776H14.8737V12.2044C14.8737 12.5516 14.752 12.8466 14.5087 13.0894C14.2659 13.3328 13.9709 13.4544 13.6237 13.4544Z" fill="#1A47A3"/>';
            html += '</svg>';
            html += 'Add Text</button>';
            html += '</div>';
            html +=
                '<div class="d-none"><button id="remove-text-button" style="font-weight:600;background-color: #fff !important;color:#D33737 !important;border:1px solid #D33737 !important"class="btn _btn-primary">';
            html +=
                '<svg class="me-1" width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
            html +=
                '<path d="M1.45052 13.6224C1.45052 14.5391 2.20052 15.2891 3.11719 15.2891H9.78385C10.7005 15.2891 11.4505 14.5391 11.4505 13.6224V3.6224H1.45052V13.6224ZM12.2839 1.1224H9.36719L8.53385 0.289062H4.36719L3.53385 1.1224H0.617188V2.78906H12.2839V1.1224Z" fill="#D33737"/>';
            html += '</svg>';
            html += 'Remove Text</button></div>';
            html += '</div>';
            html += '<div class="d-flex align-items-center font-div flex-column">';
            html += '<div class="d-none"><label for="font-size">Font Size&nbsp;&nbsp;:</label>';
            html +=
                '<input type="range" id="font-size" min="0" max="7" step="1" value="0" style="width:180px;accent-color:#1A47A3;position: relative;"></div>';
            html += '<div class="d-none"><label for="font-color">Font Color:</label>';
            html +=
                '<input type="range" id="font-color" min="0" max="4" step="1" value="0" style="width:180px;accent-color:#1A47A3;position: relative;"></div>';
            html += '</div>';
            html += '<div class="">';
            html += '<button type="button" class="btn btn-primary btn _btn-primary" id="saveBtn">Save changes</button>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            $('#nestMod').append(html);
        }

        function formatDate5(dateString) {
            var options = {
                month: '2-digit',
                day: '2-digit',
                year: 'numeric'
            };
            var formattedDate = new Date(dateString).toLocaleDateString('en-GB', options);
            return formattedDate.replace(/(\d+)\/(\d+)\/(\d+)/, '$1/$2/$3');
        }

        // Function to convert data URI to Blob
        function dataURItoBlob(dataURI) {
            var byteString = atob(dataURI.split(',')[1]);
            var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
            var ab = new ArrayBuffer(byteString.length);
            var ia = new Uint8Array(ab);
            for (var i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            return new Blob([ab], {
                type: mimeString
            });
        }

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            const dt1 = new DataTransfer();
            $('.upload__inputfile').change(function() {
                // Adding files to the DataTransfer object
                for (let file of this.files) {
                    dt1.items.add(file);
                }
                // Update input file files after addition
                this.files = dt1.files;
            });

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    htmlData();
                    var canvas = new fabric.Canvas('canvas');

                    $('#add-text-button').click(function() {
                        var text = "New Text Here";
                        if (text) {
                            var canvasWidth = canvas.getWidth();
                            var canvasHeight = canvas.getHeight();
                            var fontSizeM = Math.min(canvasWidth, canvasHeight) * 0.05;

                            // Create new text object
                            var newText = new fabric.IText(text, {
                                fontFamily: 'Arial', // Or use desired font family
                                fill: '#000',
                                editable: true,
                                fontSize: fontSizeM,
                                backgroundColor: 'rgba(222, 222, 222, 0.8)', // White background with 50% opacity
                                borderColor: '#1A47A3', // Border color
                            });

                            // Calculate text box dimensions
                            var textBoxWidth = newText.width * newText.scaleX;
                            var textBoxHeight = newText.height * newText.scaleY;

                            // Set text object position to center of canvas
                            newText.set({
                                left: (canvasWidth - textBoxWidth) / 2,
                                top: (canvasHeight - textBoxHeight) / 2
                            });
                            $('#font-size').val('0');
                            newText.hiddenTextareaContainer = canvas.lowerCanvasEl.parentNode;
                            canvas.add(newText);

                            canvas.renderAll();
                            $(window).scrollTop(0);
                        }
                    });
                    canvas.on('selection:created', function() {
                        $('#remove-text-button').parent().removeClass("d-none");
                        $('#font-size').parent().removeClass("d-none");
                        $('#font-color').parent().removeClass("d-none");
                        $('#remove-text-button').parent().addClass("d-flex");
                        $('#font-size').parent().addClass("d-flex");
                        $('#font-color').parent().addClass("d-flex");
                    });
                    canvas.on('selection:cleared', function() {
                        $('#remove-text-button').parent().addClass("d-none");
                        $('#font-size').parent().addClass("d-none");
                        $('#font-color').parent().addClass("d-none");
                        $('#remove-text-button').parent().removeClass("d-flex");
                        $('#font-size').parent().removeClass("d-flex");
                        $('#font-color').parent().removeClass("d-flex");
                    });
                    $('#font-size').change(function() {
                        var thisSize = $(this).val();
                        // Get the selected font size value
                        var selectedFontSizeIndex = parseInt(thisSize);
                        var selectedObject = canvas.getActiveObject();

                        if (selectedObject && selectedObject.type === 'i-text') {
                            var canvasWidth = canvas.getWidth();
                            var canvasHeight = canvas.getHeight();
                            var fontSizeM = Math.min(canvasWidth, canvasHeight) * 0.05;
                            var fontSizes = [fontSizeM + 4, fontSizeM + 8, fontSizeM + 12,
                                fontSizeM + 16, fontSizeM + 20, fontSizeM + 24, fontSizeM + 28,
                                fontSizeM + 32
                            ];
                            var fontSize = fontSizes[selectedFontSizeIndex];

                            if (selectedObject instanceof fabric.Text) {
                                selectedObject.set('fontSize',
                                    fontSize); // Set the font size directly
                                canvas.renderAll();
                                $(window).scrollTop(0);
                            }
                        }
                    });

                    // Font color change event listener
                    document.getElementById('font-color').addEventListener('change', function() {
                        var selectedObject = canvas.getActiveObject();
                        if (selectedObject && selectedObject.type === 'i-text') {
                            var colors = ['#000000', '#FF0000', '#00FF00', '#0000FF', '#FFF'];

                            var color = colors[this.value];
                            if (selectedObject instanceof fabric.Text) {
                                selectedObject.set('fill', color);
                                canvas.renderAll();
                                $(window).scrollTop(0);
                            }
                        }
                    });
                    document.getElementById('remove-text-button').addEventListener('click',
                        removeSelectedText);

                    function removeSelectedText() {
                        var activeObject = canvas.getActiveObject();
                        if (activeObject && activeObject.type === 'i-text') {
                            canvas.remove(activeObject);
                            canvas.discardActiveObject();
                            canvas.renderAll();
                            $(window).scrollTop(0);
                        }
                    }
                    $('.upload__img-wrap').html('');
                    var maxLength = $(this).attr('data-max_length');
                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);

                    // if (e.target.files.length > 19) {
                    //     alert('Maximum 20 files per upload');
                    //     return;
                    // }
                    filesArr.forEach(function(f, index) {
                        var fileType = f.type.split('/')[0]; // Get the file type (image or video)

                        if (fileType !== 'image' && fileType !== 'video') {
                            alert('Invalid file type: Only images and videos are allowed.');
                            $('.upload__inputfile').val(null);
                            return;
                        }

                        if (imgArray.length >= maxLength) {
                            alert('Maximum number of files exceeded.');
                            return false;
                        } else {
                            imgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html = '';
                                if (fileType === 'image') {
                                    html =
                                        "<div class='upload__img-box m-1'><div style='background-image: url(" +
                                        e.target.result + ")' data-number='" + $(
                                            ".upload__img-close").length +
                                        "' class='img-bg image-link' data-name='" + f.name +
                                        "'><div class='upload__img-close' data-name='" + f
                                        .name + "'></div></div></div>";
                                } else if (fileType === 'video') {
                                    html =
                                        "<div class='upload__img-box m-1'><div data-number='" +
                                        $(".upload__img-close").length +
                                        "' class='img-bg'><video style='width:60px;' src='" + e
                                        .target
                                        .result +
                                        "'></video><div class='upload__img-close videoClose1' data-name='" +
                                        f.name + "'></div></div></div>";
                                }
                                $('.upload__img-wrap').append(html);
                            }
                            reader.readAsDataURL(f);
                        }
                    });

                    $(document).on('click', '.image-link', function() {
                        var name = $(this).attr("data-name");
                        $('input[name="fname"]').val(name);
                        var imgSrc = $(this).css('background-image').replace(
                            /url\(['"]?(.*?)['"]?\)/i, "$1");
                        if (imgSrc != "none") {
                            $(this).addClass('selected');
                            loadImageToCanvas(imgSrc, canvas);
                            $('#imageEditorModal').modal('show');
                        }

                    });

                    $(document).on('click', '#saveBtn', function() {
                        // Get the edited image data from the canvas
                        var editedImageData = canvas.toDataURL({
                            format: 'png',
                            quality: 1,
                            multiplier: 3
                        });
                        // Find the corresponding .img-bg element and update its background image
                        var $selectedImage = $('.upload__img-wrap .img-bg.selected');
                        var selectedFilename = $selectedImage.data('file');

                        var name = $('input[name="fname"]').val();
                        for (let i = 0; i < dt1.items.length; i++) {
                            // Matching file and name
                            if (name == dt1.items[i].getAsFile().name) {
                                // Update the DataTransfer object with edited image data
                                var blob = dataURItoBlob(editedImageData);
                                var file = new File([blob], name);
                                dt1.items.remove(i);
                                dt1.items.add(file);
                                document.getElementsByClassName('.upload__inputfile').files = dt1
                                    .files;
                            }
                        }

                        if ($selectedImage.length > 0) {
                            $selectedImage.css('background-image', 'url(' + editedImageData + ')');
                            $selectedImage.removeClass('selected');
                        }
                        // Close the modal
                        $('#imageEditorModal').modal('hide');
                    });
                    $(document).on('click', '.closeBtn', function() {
                        var $selectedImage = $('.upload__img-wrap .img-bg.selected');
                        $selectedImage.removeClass('selected');
                        // Close the modal
                        $('#imageEditorModal').modal('hide');
                    });
                });

            });

            $('body').on('click', ".upload__img-close", function(e) {
                e.stopPropagation();
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
                var name = $(this).attr("data-name");
                for (let i = 0; i < dt1.items.length; i++) {
                    // Matching file and name
                    if (name == dt1.items[i].getAsFile().name) {
                        // Delete the file in the DataTransfer object
                        dt1.items.remove(i);
                        continue;
                    }
                }
                // Update input file files after deletion
                document.getElementsByClassName('.upload__inputfile').files = dt1.files;
            });
        }

        function loadImageToCanvas(imgSrc, canvas) {
            const maxWidth = window.innerWidth * 0.8;
            const maxHeight = window.innerHeight * 0.78;
            const ASPECT_RATIO_TOLERANCE = 0.01; // Adjust tolerance as needed (smaller = stricter)

            fabric.Image.fromURL(imgSrc, function(img) {
                canvas.clear();
                const imgWidth = img.width;
                const imgHeight = img.height;
                // Calculate initial scale factors
                const initialScaleX = Math.min(maxWidth / imgWidth, 1);
                const initialScaleY = Math.min(maxHeight / imgHeight, 1);
                // Calculate maximum allowed scale factor while maintaining aspect ratio
                const maxScale = Math.min(maxWidth / imgWidth, maxHeight / imgHeight);
                // Check if initial scaling would distort aspect ratio beyond tolerance
                const initialAspectRatio = imgWidth / imgHeight;
                const scaledAspectRatio = (imgWidth * initialScaleX) / (imgHeight * initialScaleY);
                const aspectRatioDifference = Math.abs(initialAspectRatio - scaledAspectRatio);

                let finalScaleFactor;
                if (aspectRatioDifference > ASPECT_RATIO_TOLERANCE) {
                    // Use the stricter maxScale to avoid distortion
                    finalScaleFactor = maxScale;
                } else {
                    // Use the larger of initial scales or maxScale
                    finalScaleFactor = Math.max(initialScaleX, initialScaleY, maxScale);
                }
                // Set canvas dimensions based on scaled image size
                canvas.setWidth(imgWidth * finalScaleFactor);
                canvas.setHeight(imgHeight * finalScaleFactor);
                // Ensure canvas dimensions don't exceed maximums
                canvas.setWidth(Math.min(canvas.width, maxWidth));
                canvas.setHeight(Math.min(canvas.height, maxHeight));
                // Set scaled dimensions and position the image at the center
                img.scale(finalScaleFactor);
                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
            });
        }


        function generateAdditionalDetails(anchorElement) {
            var type = anchorElement.getAttribute('data-type');
            var imgpath = "{{ asset('assets/images/users/avatar-1.jpg') }}";
            var username = anchorElement.getAttribute('username');
            var dataType = anchorElement.getAttribute('data-type');
            var parts = username.split(' ');
            var initials = '';
            for (var i = 0; i < parts.length; i++) {
                initials += parts[i].substring(0, 1);
            }
            initials = initials.toUpperCase();
            var comment = anchorElement.getAttribute('comment');
            var id = anchorElement.getAttribute('data-id');
            var createdDate = anchorElement.getAttribute('created-date');
            var createdDate1 = anchorElement.getAttribute('created-date1');
            if (createdDate1 == null || createdDate1 == "null" || createdDate1 == "|") {
                var createdDate1 = createdDate;
            }
            var htmlContent = '';
            htmlContent += '<div class="additional-details mfp-prevent-close py-1 px-2">';
            htmlContent += '<div class="d-flex justify-content-between align-items-center mb-3">';
            htmlContent += '<div class="d-flex justify-content-start align-items-center">';
            htmlContent +=
                '<div class="mr-1" style="font-family: Arial, sans-serif; font-size: 24px; color: #fff; background-color: #1A47A3; border-radius: 5px; display: inline-block; margin: 5px;border-radius: 36px; display: flex; align-items: center; justify-content: center;width:60px;height:60px;padding-left:10px;padding-right:10px;">' +
                initials + '</div>';
            htmlContent += '<span class="pl-2"><b>' + username + '</b></span>';
            htmlContent += '</div>';
            htmlContent += '<div class="d-flex flex-column">';
            htmlContent += '<span>Created: ' + createdDate1 + '</span>';
            htmlContent += '<span>Uploaded: ' + createdDate + '</span>';
            htmlContent += '</div>';
            htmlContent += '</div>';
            htmlContent += '<div class="d-flex justify-content-between align-items-center deviders">';
            htmlContent += '<div class="d-flex flex-column">';
            htmlContent += '<span><b>Comment</b></span>';
            htmlContent += '<span id="com-txt">' + comment + '</span>';
            htmlContent += '</div>';
            if (comment != '-') {
                htmlContent +=
                    '<button class="btn btn-danger magnific__img-close3 videoClose" style="border-radius: 6px;" data-type="' +
                    dataType +
                    '" data-id="' + id + '">Delete Comment';
                htmlContent += `<svg class="ms-1" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1809_9320)">
                                    <path d="M4.0026 12.6667C4.0026 13.4 4.6026 14 5.33594 14H10.6693C11.4026 14 12.0026 13.4 12.0026 12.6667V4.66667H4.0026V12.6667ZM12.6693 2.66667H10.3359L9.66927 2H6.33594L5.66927 2.66667H3.33594V4H12.6693V2.66667Z" fill="white"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_1809_9320">
                                    <rect width="16" height="16" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>`;
                htmlContent += '</button>'
            }
            htmlContent += '</div>';
            if (dataType == "image") {
                htmlContent += '<div class="d-flex justify-content-between align-items-center deviders">';
                htmlContent += '<div class="d-flex flex-column">';
                htmlContent += '</div>';
                htmlContent += '<button class="btn _btn-primary magnific__img-close2" data-type="' + dataType +
                    '" data-id="' + id + '">Edit Image';
                htmlContent += `<svg class="ms-1" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1809_9323)">
                                <path d="M2 11.5017V14.0017H4.5L11.8733 6.62833L9.37333 4.12833L2 11.5017ZM13.8067 4.695C14.0667 4.435 14.0667 4.015 13.8067 3.755L12.2467 2.195C11.9867 1.935 11.5667 1.935 11.3067 2.195L10.0867 3.415L12.5867 5.915L13.8067 4.695Z" fill="white"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_1809_9323">
                                <rect width="16" height="16" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>`;
                htmlContent += '</button>'
                htmlContent += '</div>';
            }
            htmlContent += '</div>';

            return htmlContent;
        }

        function getFileExtension(url) {
            return url.split('.').pop().toLowerCase();
        }

        // Function to differentiate between image and video URLs
        function differentiateURL(url) {
            var extension = getFileExtension(url);
            if (extension === 'jpg' || extension === 'png' || extension === 'gif') {
                return 'image';
            } else if (extension === 'mp4' || extension === 'avi' || extension === 'mov' || extension === 'webm') {
                return 'video';
            } else {
                return 'Unknown';
            }
        }

        function inputColorChange() {
            $("#font-color").css('accent-color', '#000000')
            var colors = ['#000000', '#FF0000', '#00FF00', '#0000FF', '#FFF']; // Array of colors
            var slider = $("#font-color");

            // Event listener for slider change
            slider.on("input", function() {
                var value = parseInt($(this).val());
                updateThumbColor(value);
            });

            // Function to update slider thumb color
            function updateThumbColor(index) {
                var color = colors[index];
                // Set thumb color dynamically
                slider.css("accent-color", color);
            }
        };

        $(document).ready(function() {
            $('.msg-show').hide();
            ImgUpload();
            $(document).on('submit', '.photo-form-save', function(e) {
                var selectedOptionText = $(this).find('.folder_select option:selected').text().trim();;
                var selectedOptionId = $(this).find('.folder_select').val();

                localStorage.setItem('selectedfilesec', selectedOptionId);
                localStorage.setItem('selectedfilename', selectedOptionText);
            });

            $(document).on('show.bs.modal', '#imageEditorModal', function(e) {
                inputColorChange();
            });

            $('#remove-text-button').attr("disabled", true);
            $('#font-size').attr("disabled", true);
            $('#font-color').attr("disabled", true);

            $(".action-btn").on("click", function() {
                $(this).css('color', 'transparent important');
                if ($('.upload__inputfile').val() != '' && $('.upload__inputfile').val() != null) {
                    $(this).addClass("loading");
                }
            });

            $('.multiple-ubtn').click(function() {
                var v_token = "{{ csrf_token() }}";
                var proId = $(this).attr("data-pro_id");
                $('.fk_property_id').val(proId);
                $('input[name="_token"]').val(v_token);
            });
            $('.folder_select').change(function() {
                $('.fid').val($(this).find(":selected").val());
            });
            $('#batchModal').on('hidden.bs.modal', function() {
                $(this)
                    .find("input,textarea")
                    .val('')
                    .end()
                    .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
                $('.upload__img-wrap').html('');
                $('.upload__inputfile').val(null);
            });
            $('#singleModal').on('hidden.bs.modal', function() {
                $(this)
                    .find("input,textarea")
                    .val('')
                    .end()
                    .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
                $('.upload__img-wrap').html('');
                $('.close-btn').click();
            });

            $('.file').click(function() {
                var proId = $(this).attr("data-pro_id");
                var secId = $(this).attr('data-sec_id');
                localStorage.setItem('selectedfilesec', secId);
                localStorage.setItem('selectedfilepro', proId);
                var folder = $(this).children('.file-txt').children('span').text();
                localStorage.setItem('selectedfilename', folder);

                var url = '/dashboard/assessor-contract/photo/get/' + proId + '/' + secId + '';
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        var imgs = data.data;
                        var groupedData = {};
                        $.each(imgs, function(index, item) {

                            var key = formatDate5(item.created_at, 'd/m/Y');
                            if (!groupedData[key]) {
                                groupedData[key] = [];
                            }
                            groupedData[key].push(item);
                        });
                        $(".folder-photos").html('');
                        $.each(groupedData, function(b, v) {
                            $(".folder-photos").append('<h4>' + b +
                                '</h4><section class="img-gallery-magnific img-gallery-magnific-' +
                                b.replace(/\//g, "-") + '">');
                            v.forEach(function(f, i) {
                                var dataType = differentiateURL(f.image_path);
                                if (dataType === 'video') {
                                    mediaContent =
                                        `<video src="${f.image_path}" style="border-top-left-radius: 6px; border-top-right-radius: 6px;"></video>`;
                                } else {
                                    mediaContent =
                                        `<img src="${f.image_path}"/>`;
                                }
                                var newCls = "img-gallery-magnific-" + b
                                    .replace(/\//g, "-");
                                if (f.comment != "") {
                                    $("." + newCls).append(`<div class="magnific-img mb-3">
                                    <a class="image-popup-vertical-fit m-1" data-id="${f.id}" href="${f.image_path}" data-type="${dataType}" username="${f.full_name}" comment="${f.comment}" created-date="${f.date_added}" created-date1="${f.date_created}">
                                        ${mediaContent}
                                    </a>
                                    <div class="magnific__img-close ${dataType === 'video' ? 'videoClose' : ''}" data-type="${dataType}" data-id="${f.id}">
                                    </div>
                                    <div class="overlay ${dataType === 'video' ? 'videoOverlay' : ''}">${f.date_created}</div>
                                    ${dataType === 'video' ? '<svg class="play-icon" width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M21.409 9.35331C21.8893 9.60872 22.291 9.99 22.5712 10.4563C22.8514 10.9226 22.9994 11.4563 22.9994 12.0003C22.9994 12.5443 22.8514 13.078 22.5712 13.5443C22.291 14.0106 21.8893 14.3919 21.409 14.6473L8.597 21.6143C6.534 22.7373 4 21.2773 4 18.9683V5.03331C4 2.72331 6.534 1.26431 8.597 2.38531L21.409 9.35331Z" fill="white"/></svg>' : ''}
                                    <div class="mouseHoverx" title="${f.comment}" ><svg class="i-icon ${dataType === 'video' ? 'vi-icon' : ''}" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 8C16 9.05058 15.7931 10.0909 15.391 11.0615C14.989 12.0321 14.3997 12.914 13.6569 13.6569C12.914 14.3997 12.0321 14.989 11.0615 15.391C10.0909 15.7931 9.05058 16 8 16C6.94943 16 5.90914 15.7931 4.93853 15.391C3.96793 14.989 3.08601 14.3997 2.34315 13.6569C1.60028 12.914 1.011 12.0321 0.608964 11.0615C0.206926 10.0909 -1.56548e-08 9.05058 0 8C3.16163e-08 5.87827 0.842855 3.84344 2.34315 2.34315C3.84344 0.842855 5.87827 0 8 0C10.1217 0 12.1566 0.842855 13.6569 2.34315C15.1571 3.84344 16 5.87827 16 8ZM9.11111 4.22222C9.11111 4.51691 8.99405 4.79952 8.78567 5.0079C8.5773 5.21627 8.29469 5.33333 8 5.33333C7.70532 5.33333 7.4227 5.21627 7.21433 5.0079C7.00595 4.79952 6.88889 4.51691 6.88889 4.22222C6.88889 3.92754 7.00595 3.64492 7.21433 3.43655C7.4227 3.22817 7.70532 3.11111 8 3.11111C8.29469 3.11111 8.5773 3.22817 8.78567 3.43655C8.99405 3.64492 9.11111 3.92754 9.11111 4.22222ZM8.88889 12.8889V6.66667H7.11111V12.8889H8.88889Z" fill="white"/>
                                    </svg></div>
                                    </div>`);
                                } else {
                                    $("." + newCls).append(`<div class="magnific-img mb-3">
                                    <a class="image-popup-vertical-fit m-1" data-id="${f.id}" href="${f.image_path}" data-type="${dataType}" username="${f.full_name}" comment="-" created-date="${f.date_added}" created-date1="${f.date_created}">
                                        ${mediaContent}
                                    </a>
                                    <div class="magnific__img-close ${dataType === 'video' ? 'videoClose' : ''}" data-type="${dataType}" data-id="${f.id}">
                                    </div>
                                    <div class="overlay ${dataType === 'video' ? 'videoOverlay' : ''}">${f.date_created}</div>
                                    ${dataType === 'video' ? '<svg class="play-icon" width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M21.409 9.35331C21.8893 9.60872 22.291 9.99 22.5712 10.4563C22.8514 10.9226 22.9994 11.4563 22.9994 12.0003C22.9994 12.5443 22.8514 13.078 22.5712 13.5443C22.291 14.0106 21.8893 14.3919 21.409 14.6473L8.597 21.6143C6.534 22.7373 4 21.2773 4 18.9683V5.03331C4 2.72331 6.534 1.26431 8.597 2.38531L21.409 9.35331Z" fill="white"/></svg>' : ''}
                                    </div>`);
                                }
                            });
                            $(".folder-photos").append('</section>');
                        });
                        $('.image-popup-vertical-fit').magnificPopup({
                            type: 'image',
                            mainClass: 'mfp-with-zoom',
                            gallery: {
                                navigateByImgClick: false,
                                enabled: true
                            },
                            zoom: {
                                enabled: true,
                                duration: 300, // duration of the effect, in milliseconds
                                easing: 'ease-in-out', // CSS transition easing function
                                opener: function(openerElement) {
                                    return openerElement.is('img') ? openerElement :
                                        openerElement.find('img');
                                }
                            },
                            callbacks: {
                                elementParse: function(item) {
                                    var type = item.el[0].getAttribute('data-type');
                                    if (type == 'video') {
                                        item.type = 'iframe';
                                    } else {
                                        item.type = 'image';
                                    }
                                },
                                open: function() {
                                    $('.mfp-wrap').children('div:eq(1)').remove();
                                    var anchorElement = this.currItem.el[0];
                                    var type = anchorElement.getAttribute(
                                        'data-type');
                                    var htmlContent = generateAdditionalDetails(
                                        anchorElement);
                                    $('.mfp-wrap').append(htmlContent);
                                },
                                change: function() {
                                    $('.mfp-wrap').children('div:eq(1)').remove();
                                    var anchorElement = this.currItem.el[0];
                                    var htmlContent = generateAdditionalDetails(
                                        anchorElement);
                                    $('.mfp-wrap').append(htmlContent);
                                }
                            }
                        });
                        $(document).on('click', 'img.mfp-img', function() {
                            $(this).toggleClass('zoom150');
                        });
                        $(document).on('click', '.magnific__img-close',
                            function(e) {
                                e.stopPropagation();
                                var pid = $(this).attr("data-id");
                                $confirm = confirm(
                                    'Are you sure you want to delete this Image ?');
                                if ($confirm == true) {
                                    $(this).parent().remove();
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ route('property.photo.delete') }}",
                                        data: {
                                            '_token': "{{ csrf_token() }}",
                                            id: pid,
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            if (response.success == true) {
                                                $('#liveToast').toast('show');
                                            } else {
                                                alert('Not deleted.');
                                                window.location.reload();
                                            }
                                        }
                                    });
                                }
                            });
                        $(document).on('click', '.toast-cls', function() {
                            $('#liveToast').toast('hide');
                        });
                    },
                    error: function() {}
                });
                $('.signle-ubtn').parent().attr('href',
                    `{{ url('dashboard/property/photo/download-all/${proId}/${secId}') }}`)
                $('.signle-ubtn').html(`
                <svg class="download-svg me-1" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_1326_1880)">
                                    <path d="M1.38815 14.9729C1.42876 14.9105 1.47049 14.8488 1.51055 14.7859C2.04243 13.9514 2.5259 13.0762 3.11509 12.2823C4.84648 9.9456 8.28923 9.79371 10.2476 11.9418C10.8507 12.6028 11.411 13.3027 11.9912 13.9842C12.0224 14.0209 12.0552 14.0565 12.1025 14.1088C12.9076 12.9839 14.0008 12.3947 15.3745 12.3947C16.7481 12.3947 17.8402 12.9917 18.6653 14.1617V13.8896C18.6653 12.6056 18.6653 11.3215 18.6653 10.0374C18.6653 9.51998 19.1393 9.18617 19.5894 9.3859C19.8721 9.51053 19.9989 9.74253 19.9984 10.0535C19.9984 11.1779 20.0017 12.3023 19.9984 13.4267C19.995 14.0387 20.0106 14.6507 19.9566 15.2572C19.7536 17.5388 17.902 19.5211 15.6365 19.9016C15.3013 19.9581 14.9622 19.9875 14.6223 19.9895C11.54 19.9959 8.45762 19.9959 5.37502 19.9895C2.78684 19.9857 0.645967 18.2515 0.114644 15.7234C0.0405669 15.3633 0.00328468 14.9966 0.00337179 14.629C-0.00478814 11.5401 -0.00608672 8.45122 -0.000523132 5.36231C0.00392774 2.6712 1.90167 0.466353 4.56162 0.0540912C4.81579 0.0163525 5.07244 -0.00224513 5.3294 -0.00154466C7.47472 -0.00599553 9.61985 -0.00599553 11.7648 -0.00154466C12.2917 -0.00154466 12.6277 0.443542 12.4536 0.899756C12.3506 1.17015 12.107 1.32982 11.782 1.32982C10.4212 1.32982 9.06053 1.32982 7.70004 1.32982C6.92114 1.32982 6.14224 1.32982 5.36723 1.32982C3.10285 1.33761 1.33752 3.09682 1.33474 5.3573C1.33029 8.45326 1.33029 11.5492 1.33474 14.6452V14.9517L1.38815 14.9729Z" fill="#1A47A3"></path>
                                    <path d="M15.663 6.25213V3.97106C15.663 2.87392 15.663 1.77734 15.663 0.680197C15.6607 0.593218 15.6757 0.506644 15.707 0.425458C15.7383 0.344273 15.7853 0.27008 15.8454 0.207149C15.9055 0.144219 15.9774 0.0937934 16.0571 0.0587756C16.1367 0.0237577 16.2225 0.00483793 16.3095 0.00310738C16.6806 -0.00523801 16.9771 0.281287 16.9933 0.670738C16.996 0.733051 16.9933 0.795919 16.9933 0.858231V6.20317L17.0439 6.23544C17.0834 6.17981 17.1184 6.12417 17.1624 6.07521C17.7143 5.46062 18.2673 4.84695 18.8215 4.23422C19.0106 4.02614 19.2471 3.95214 19.5203 4.03615C19.7845 4.11794 19.9653 4.30488 19.9715 4.57416C19.9765 4.75219 19.9236 4.97696 19.8112 5.10659C19.1397 5.88549 18.4582 6.65382 17.7527 7.39823C17.5707 7.59362 17.3505 7.7495 17.1058 7.85618C16.861 7.96287 16.597 8.01808 16.33 8.0184C16.063 8.01871 15.7988 7.96411 15.5538 7.858C15.3088 7.75189 15.0882 7.59653 14.9058 7.40157C14.1914 6.65438 13.5116 5.87381 12.825 5.10047C12.7666 5.03542 12.7218 4.95926 12.6934 4.87652C12.665 4.79379 12.6536 4.70619 12.6599 4.61895C12.6661 4.5317 12.6898 4.44661 12.7297 4.36875C12.7695 4.29089 12.8247 4.22187 12.8918 4.16579C12.9567 4.1075 13.0327 4.06281 13.1151 4.03433C13.1976 4.00586 13.2849 3.99418 13.372 3.99999C13.459 4.00579 13.5441 4.02897 13.622 4.06815C13.7 4.10732 13.7693 4.16171 13.8259 4.2281C14.3823 4.83676 14.9336 5.45209 15.4866 6.06742C15.5317 6.11304 15.5818 6.16367 15.663 6.25213Z" fill="#1A47A3"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1326_1880">
                                        <rect width="20" height="19.9955" fill="white" transform="translate(-0.00195312 0.000976562)"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                            Download`);
                $('.photo-btn').removeClass('col-md-12');
                $('.photo-btn').addClass('col-md-8');
                $('.folder-name').html('');
                $('.folder-name').html('<h4>' + folder + '</h4>')
                $('.photo-header').toggleClass('d-none');
                $('.photo-folders').toggleClass('d-none');
                $('.folder-photos').toggleClass('d-none');
                $('.photo-row').toggleClass('justify-content-end');
                $(".folder_select").val(secId).change();
                $('.folder_select').attr('disabled', true);
                $('.fid').val(secId);
            });
            $('.all-folders').click(function() {
                $(document).on('click', 'img.mfp-img', function() {
                    $(this).toggleClass('zoom150');
                });
                localStorage.setItem('selectedfilesec', 'false');
                var proId = $('.file').attr("data-pro_id");
                $('.folder_select').attr('disabled', false);
                $('.signle-ubtn').parent().attr('href',
                    `{{ url('dashboard/property/photo/download-all/${proId}') }}`)
                $('.signle-ubtn').html(`<svg class="download-svg me-1" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_1326_1880)">
                                    <path d="M1.38815 14.9729C1.42876 14.9105 1.47049 14.8488 1.51055 14.7859C2.04243 13.9514 2.5259 13.0762 3.11509 12.2823C4.84648 9.9456 8.28923 9.79371 10.2476 11.9418C10.8507 12.6028 11.411 13.3027 11.9912 13.9842C12.0224 14.0209 12.0552 14.0565 12.1025 14.1088C12.9076 12.9839 14.0008 12.3947 15.3745 12.3947C16.7481 12.3947 17.8402 12.9917 18.6653 14.1617V13.8896C18.6653 12.6056 18.6653 11.3215 18.6653 10.0374C18.6653 9.51998 19.1393 9.18617 19.5894 9.3859C19.8721 9.51053 19.9989 9.74253 19.9984 10.0535C19.9984 11.1779 20.0017 12.3023 19.9984 13.4267C19.995 14.0387 20.0106 14.6507 19.9566 15.2572C19.7536 17.5388 17.902 19.5211 15.6365 19.9016C15.3013 19.9581 14.9622 19.9875 14.6223 19.9895C11.54 19.9959 8.45762 19.9959 5.37502 19.9895C2.78684 19.9857 0.645967 18.2515 0.114644 15.7234C0.0405669 15.3633 0.00328468 14.9966 0.00337179 14.629C-0.00478814 11.5401 -0.00608672 8.45122 -0.000523132 5.36231C0.00392774 2.6712 1.90167 0.466353 4.56162 0.0540912C4.81579 0.0163525 5.07244 -0.00224513 5.3294 -0.00154466C7.47472 -0.00599553 9.61985 -0.00599553 11.7648 -0.00154466C12.2917 -0.00154466 12.6277 0.443542 12.4536 0.899756C12.3506 1.17015 12.107 1.32982 11.782 1.32982C10.4212 1.32982 9.06053 1.32982 7.70004 1.32982C6.92114 1.32982 6.14224 1.32982 5.36723 1.32982C3.10285 1.33761 1.33752 3.09682 1.33474 5.3573C1.33029 8.45326 1.33029 11.5492 1.33474 14.6452V14.9517L1.38815 14.9729Z" fill="#1A47A3"></path>
                                    <path d="M15.663 6.25213V3.97106C15.663 2.87392 15.663 1.77734 15.663 0.680197C15.6607 0.593218 15.6757 0.506644 15.707 0.425458C15.7383 0.344273 15.7853 0.27008 15.8454 0.207149C15.9055 0.144219 15.9774 0.0937934 16.0571 0.0587756C16.1367 0.0237577 16.2225 0.00483793 16.3095 0.00310738C16.6806 -0.00523801 16.9771 0.281287 16.9933 0.670738C16.996 0.733051 16.9933 0.795919 16.9933 0.858231V6.20317L17.0439 6.23544C17.0834 6.17981 17.1184 6.12417 17.1624 6.07521C17.7143 5.46062 18.2673 4.84695 18.8215 4.23422C19.0106 4.02614 19.2471 3.95214 19.5203 4.03615C19.7845 4.11794 19.9653 4.30488 19.9715 4.57416C19.9765 4.75219 19.9236 4.97696 19.8112 5.10659C19.1397 5.88549 18.4582 6.65382 17.7527 7.39823C17.5707 7.59362 17.3505 7.7495 17.1058 7.85618C16.861 7.96287 16.597 8.01808 16.33 8.0184C16.063 8.01871 15.7988 7.96411 15.5538 7.858C15.3088 7.75189 15.0882 7.59653 14.9058 7.40157C14.1914 6.65438 13.5116 5.87381 12.825 5.10047C12.7666 5.03542 12.7218 4.95926 12.6934 4.87652C12.665 4.79379 12.6536 4.70619 12.6599 4.61895C12.6661 4.5317 12.6898 4.44661 12.7297 4.36875C12.7695 4.29089 12.8247 4.22187 12.8918 4.16579C12.9567 4.1075 13.0327 4.06281 13.1151 4.03433C13.1976 4.00586 13.2849 3.99418 13.372 3.99999C13.459 4.00579 13.5441 4.02897 13.622 4.06815C13.7 4.10732 13.7693 4.16171 13.8259 4.2281C14.3823 4.83676 14.9336 5.45209 15.4866 6.06742C15.5317 6.11304 15.5818 6.16367 15.663 6.25213Z" fill="#1A47A3"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1326_1880">
                                        <rect width="20" height="19.9955" fill="white" transform="translate(-0.00195312 0.000976562)"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                            Download All Folders`);
                $('.photo-btn').removeClass('col-md-8');
                $('.photo-btn').addClass('col-md-12');
                $('.photo-header').toggleClass('d-none');
                $('.photo-folders').toggleClass('d-none');
                $('.folder-photos').toggleClass('d-none');
                $('.photo-row').toggleClass('justify-content-end');
                $(".folder-photos").html(
                    `<section class="img-gallery-magnific"></section><div class="clear"></div>`);
                $('.close-btn').click();
                $('.upload__inputfile').val(null);
            });
            $(document).on('click', '.magnific__img-close2', function(e) {
                var imgId = $(this).attr('data-id');
                e.stopPropagation();
                e.preventDefault();
                htmlData();
                var canvas = new fabric.Canvas('canvas');

                $('#add-text-button').click(function() {
                    var text = "New Text Here";
                    if (text) {
                        var canvasWidth = canvas.getWidth();
                        var canvasHeight = canvas.getHeight();
                        var fontSizeM = Math.min(canvasWidth, canvasHeight) * 0.05;

                        // Create new text object
                        var newText = new fabric.IText(text, {
                            fontFamily: 'Arial', // Or use desired font family
                            fill: '#000',
                            editable: true,
                            fontSize: fontSizeM,
                            backgroundColor: 'rgba(222, 222, 222, 0.8)', // White background with 50% opacity
                            borderColor: '#1A47A3', // Border color
                        });

                        // Calculate text box dimensions
                        var textBoxWidth = newText.width * newText.scaleX;
                        var textBoxHeight = newText.height * newText.scaleY;

                        // Set text object position to center of canvas
                        newText.set({
                            left: (canvasWidth - textBoxWidth) / 2,
                            top: (canvasHeight - textBoxHeight) / 2
                        });

                        $('#font-size').val('0');
                        newText.hiddenTextareaContainer = canvas.lowerCanvasEl.parentNode;
                        canvas.add(newText);

                        canvas.renderAll();
                        $(window).scrollTop(0);
                    }
                });
                canvas.on('selection:created', function() {
                    $('#remove-text-button').parent().removeClass("d-none");
                    $('#font-size').parent().removeClass("d-none");
                    $('#font-color').parent().removeClass("d-none");
                    $('#remove-text-button').parent().addClass("d-flex");
                    $('#font-size').parent().addClass("d-flex");
                    $('#font-color').parent().addClass("d-flex");
                });
                canvas.on('selection:cleared', function() {
                    $('#remove-text-button').parent().addClass("d-none");
                    $('#font-size').parent().addClass("d-none");
                    $('#font-color').parent().addClass("d-none");
                    $('#remove-text-button').parent().removeClass("d-flex");
                    $('#font-size').parent().removeClass("d-flex");
                    $('#font-color').parent().removeClass("d-flex");
                });
                $('#font-size').change(function() {
                    var thisSize = $(this).val();
                    // Get the selected font size value
                    var selectedFontSizeIndex = parseInt(thisSize);
                    var selectedObject = canvas.getActiveObject();

                    if (selectedObject && selectedObject.type === 'i-text') {
                        var canvasWidth = canvas.getWidth();
                        var canvasHeight = canvas.getHeight();
                        var fontSizeM = Math.min(canvasWidth, canvasHeight) * 0.05;
                        var fontSizes = [fontSizeM + 4, fontSizeM + 8, fontSizeM + 12, fontSizeM +
                            16, fontSizeM + 20, fontSizeM + 24, fontSizeM + 28, fontSizeM + 32
                        ];
                        var fontSize = fontSizes[selectedFontSizeIndex];

                        if (selectedObject instanceof fabric.Text) {
                            selectedObject.set('fontSize', fontSize); // Set the font size directly
                            canvas.renderAll();
                            $(window).scrollTop(0);
                        }
                    }
                });

                // Font color change event listener
                document.getElementById('font-color').addEventListener('change', function() {
                    var selectedObject = canvas.getActiveObject();
                    if (selectedObject && selectedObject.type === 'i-text') {
                        var colors = ['#000000', '#FF0000', '#00FF00', '#0000FF', '#FFF'];

                        var color = colors[this.value];
                        if (selectedObject instanceof fabric.Text) {
                            selectedObject.set('fill', color);
                            canvas.renderAll();
                            $(window).scrollTop(0);
                        }
                    }
                });
                document.getElementById('remove-text-button').addEventListener('click', removeSelectedText);

                function removeSelectedText() {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject && activeObject.type === 'i-text') {
                        canvas.remove(activeObject);
                        canvas.discardActiveObject();
                        canvas.renderAll();
                        $(window).scrollTop(0);
                    }
                }

                $(document).on('click', '#saveBtn', function() {
                    // Get the edited image data from the canvas
                    var editedImageData = canvas.toDataURL({
                        format: 'png',
                        quality: 1,
                        multiplier: 3
                    });
                    // Find the corresponding .img-bg element and update its background image
                    var $selectedImage = $('.simgprev .file-set.selected');
                    var selectedFilename = $selectedImage.data('file');
                    var blob = dataURItoBlob(editedImageData);
                    var file = new File([blob], "singleimg.png");
                    var formData = new FormData();
                    formData.append('photo_img', file);
                    formData.append('folder_id', "edit");
                    formData.append('id', imgId);
                    $.ajax({
                        url: '{{ route('property.photo.store') }}',
                        type: 'POST',
                        data: formData,
                        processData: false, // Important: Don't process the data
                        contentType: false, // Important: Don't set contentType
                        success: function(response) {
                            if (response.success == true) {
                                window.location.reload();
                            } else {
                                alert('Image editation Failed')
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error response if needed
                            console.error('Upload error:', error);
                        }
                    });

                    if ($selectedImage.length > 0) {
                        $selectedImage.css('background-image', 'url(' + editedImageData + ')');
                        $selectedImage.removeClass('selected');
                    }
                    // Close the modal
                    $('#imageEditorModal').modal('hide');
                });
                $(document).on('click', '.closeBtn', function() {
                    // Close the modal
                    var $selectedImage = $('.simgprev .file-set.selected');
                    $selectedImage.removeClass('selected');
                    $('#imageEditorModal').modal('hide');
                });
                var imgSrc = $('.mfp-img').attr('src');
                if (imgSrc != "none") {
                    $(this).addClass('selected');
                    loadImageToCanvas(imgSrc, canvas);
                    $('#imageEditorModal').modal('show');
                }
            });
            const dt2 = new DataTransfer();

            $('#photo_img').on('change', function(e) {
                e.stopPropagation();
                e.preventDefault();
                readURL(this, $('.file-wrapper')); //Change the image
                if ($(this).get(0).files.length === 0) {
                    $('.file-wrapper-bg').show();
                } else {
                    $('.file-wrapper-bg').hide();
                }
                htmlData();
                var canvas = new fabric.Canvas('canvas');

                $('#add-text-button').click(function() {
                    var text = "New Text Here";
                    if (text) {
                        var canvasWidth = canvas.getWidth();
                        var canvasHeight = canvas.getHeight();
                        var fontSizeM = Math.min(canvasWidth, canvasHeight) * 0.05;

                        // Create new text object
                        var newText = new fabric.IText(text, {
                            fontFamily: 'Arial', // Or use desired font family
                            fill: '#000',
                            editable: true,
                            fontSize: fontSizeM,
                            backgroundColor: 'rgba(222, 222, 222, 0.8)', // White background with 50% opacity
                            borderColor: '#1A47A3', // Border color
                        });

                        // Calculate text box dimensions
                        var textBoxWidth = newText.width * newText.scaleX;
                        var textBoxHeight = newText.height * newText.scaleY;

                        // Set text object position to center of canvas
                        newText.set({
                            left: (canvasWidth - textBoxWidth) / 2,
                            top: (canvasHeight - textBoxHeight) / 2
                        });

                        $('#font-size').val('0');
                        newText.hiddenTextareaContainer = canvas.lowerCanvasEl.parentNode;
                        canvas.add(newText);

                        canvas.renderAll();
                        $(window).scrollTop(0);
                    }
                });
                canvas.on('selection:created', function() {
                    $('#remove-text-button').parent().removeClass("d-none");
                    $('#font-size').parent().removeClass("d-none");
                    $('#font-color').parent().removeClass("d-none");
                    $('#remove-text-button').parent().addClass("d-flex");
                    $('#font-size').parent().addClass("d-flex");
                    $('#font-color').parent().addClass("d-flex");
                });
                canvas.on('selection:cleared', function() {
                    $('#remove-text-button').parent().addClass("d-none");
                    $('#font-size').parent().addClass("d-none");
                    $('#font-color').parent().addClass("d-none");
                    $('#remove-text-button').parent().removeClass("d-flex");
                    $('#font-size').parent().removeClass("d-flex");
                    $('#font-color').parent().removeClass("d-flex");
                });
                $('#font-size').change(function() {
                    var thisSize = $(this).val();
                    // Get the selected font size value
                    var selectedFontSizeIndex = parseInt(thisSize);
                    var selectedObject = canvas.getActiveObject();

                    if (selectedObject && selectedObject.type === 'i-text') {
                        var canvasWidth = canvas.getWidth();
                        var canvasHeight = canvas.getHeight();
                        var fontSizeM = Math.min(canvasWidth, canvasHeight) * 0.05;
                        var fontSizes = [fontSizeM + 4, fontSizeM + 8, fontSizeM + 12, fontSizeM +
                            16, fontSizeM + 20, fontSizeM + 24, fontSizeM + 28, fontSizeM + 32
                        ];
                        var fontSize = fontSizes[selectedFontSizeIndex];

                        if (selectedObject instanceof fabric.Text) {
                            selectedObject.set('fontSize', fontSize); // Set the font size directly
                            canvas.renderAll();
                            $(window).scrollTop(0);
                        }
                    }
                });

                // Font color change event listener
                document.getElementById('font-color').addEventListener('change', function() {
                    var selectedObject = canvas.getActiveObject();
                    if (selectedObject && selectedObject.type === 'i-text') {
                        var colors = ['#000000', '#FF0000', '#00FF00', '#0000FF', '#FFF'];

                        var color = colors[this.value];
                        if (selectedObject instanceof fabric.Text) {
                            selectedObject.set('fill', color);
                            canvas.renderAll();
                            $(window).scrollTop(0);
                        }
                    }
                });
                document.getElementById('remove-text-button').addEventListener('click', removeSelectedText);

                function removeSelectedText() {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject && activeObject.type === 'i-text') {
                        canvas.remove(activeObject);
                        canvas.discardActiveObject();
                        canvas.renderAll();
                        $(window).scrollTop(0);
                    }
                }

                $(document).on('click', '.file-wrapper', function() {
                    var imgSrc = $(this).css('background-image').replace(/url\(['"]?(.*?)['"]?\)/i,
                        "$1");
                    if (imgSrc != "none") {
                        $(this).addClass('selected');
                        loadImageToCanvas(imgSrc, canvas);
                        $('#imageEditorModal').modal('show');
                    }

                });

                $(document).on('click', '#saveBtn', function() {
                    // Get the edited image data from the canvas
                    var editedImageData = canvas.toDataURL({
                        format: 'png',
                        quality: 1,
                        multiplier: 3
                    });
                    // Find the corresponding .img-bg element and update its background image
                    var $selectedImage = $('.simgprev .file-set.selected');
                    var selectedFilename = $selectedImage.data('file');
                    var blob = dataURItoBlob(editedImageData);
                    var file = new File([blob], "singleimg.png");
                    dt2.items.remove(0);
                    dt2.items.add(file);
                    document.getElementById('photo_img').files = dt2.files

                    if ($selectedImage.length > 0) {
                        $selectedImage.css('background-image', 'url(' + editedImageData + ')');
                        $selectedImage.removeClass('selected');
                    }
                    // Close the modal
                    $('#imageEditorModal').modal('hide');
                });
                $(document).on('click', '.closeBtn', function() {
                    // Close the modal
                    var $selectedImage = $('.simgprev .file-set.selected');
                    $selectedImage.removeClass('selected');
                    $('#imageEditorModal').modal('hide');
                });
            });

            $('.close-btn').on('click', function(e) { //Unset the image or video
                e.stopPropagation();
                e.preventDefault();
                var $selectedImage = $('.simgprev .file-set.selected');
                $selectedImage.removeClass('selected');
                var $selectedImage2 = $('.upload__img-wrap .img-bg.selected');
                $selectedImage2.removeClass('selected');
                var $selectedImage3 = $('.file-wrapper');
                $selectedImage3.removeClass('selected');
                let file = $('#photo_img');
                $('.file-wrapper').css('background-image', 'unset');
                $('.file-wrapper video').remove(); // Remove any existing video element
                $('.file-wrapper').removeClass('file-set');
                file.replaceWith(file = file.clone(true));
                $('.file-wrapper-bg').show();
                $("#photo_img").val(null);
            });

            function readURL(input, obj) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var file = input.files[0];
                        var fileType = file.type;
                        if (fileType.indexOf('image') !== -1) {
                            obj.css('background-image', 'url(' + e.target.result + ')');
                            obj.find('video').remove(); // Remove any existing video element
                        } else if (fileType.indexOf('video') !== -1) {
                            obj.css('background-image', ''); // Remove any existing background image
                            var video = $('<video controls>');
                            video.attr('src', e.target.result);
                            obj.append(video);
                        }
                        obj.addClass('file-set');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('.image-popup-vertical-fit').magnificPopup({
                type: 'image',
                mainClass: 'mfp-with-zoom',
                gallery: {
                    navigateByImgClick: false,
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300, // duration of the effect, in milliseconds
                    easing: 'ease-in-out', // CSS transition easing function
                    opener: function(openerElement) {
                        return openerElement.is('img') ? openerElement :
                            openerElement.find('img');
                    }
                },
                callbacks: {
                    elementParse: function(item) {
                        var type = item.el[0].getAttribute('data-type');
                        if (type == 'video') {
                            item.type = 'iframe';
                        } else {
                            item.type = 'image';
                        }
                    },
                    open: function() {
                        $('.mfp-wrap').children('div:eq(1)').remove();
                        var anchorElement = this.currItem.el[0];
                        var type = anchorElement.getAttribute('data-type');
                        var htmlContent = generateAdditionalDetails(anchorElement);
                        $('.mfp-wrap').append(htmlContent);
                    },
                    change: function() {
                        $('.mfp-wrap').children('div:eq(1)').remove();
                        var anchorElement = this.currItem.el[0];
                        var htmlContent = generateAdditionalDetails(anchorElement);
                        $('.mfp-wrap').append(htmlContent);
                    }
                }
            });

            var selectedfile = localStorage.getItem('selectedfilesec');
            // var sectionpanel = localStorage.getItem('selectedFilter');

            if (selectedfile) {

                var secId = localStorage.getItem('selectedfilesec');
                var proId = localStorage.getItem('selectedfilepro');
                var folder = localStorage.getItem('selectedfilename');

                if (selectedfile != 'false' && "{{ $property->id }}" == proId) {
                    var url = '/dashboard/assessor-contract/photo/get/' + proId + '/' + secId + '';
                    $.ajax({
                        type: 'GET',
                        url: url,
                        success: function(data) {
                            var imgs = data.data;
                            var groupedData = {};
                            $.each(imgs, function(index, item) {

                                var key = formatDate5(item.created_at, 'd/m/Y');
                                if (!groupedData[key]) {
                                    groupedData[key] = [];
                                }
                                groupedData[key].push(item);
                            });
                            $(".folder-photos").html('');
                            $.each(groupedData, function(b, v) {
                                $(".folder-photos").append('<h4>' + b +
                                    '</h4><section class="img-gallery-magnific img-gallery-magnific-' +
                                    b.replace(/\//g, "-") + '">');
                                v.forEach(function(f, i) {
                                    var dataType = differentiateURL(f.image_path);
                                    if (dataType === 'video') {
                                        mediaContent =
                                            `<video src="${f.image_path}" style="border-top-left-radius: 6px; border-top-right-radius: 6px;"></video>`;
                                    } else {
                                        mediaContent = `<img src="${f.image_path}"/>`;
                                    }
                                    var newCls = "img-gallery-magnific-" + b.replace(
                                        /\//g, "-");
                                    if (f.comment != "") {
                                        $("." + newCls).append(`<div class="magnific-img mb-3">
                                <a class="image-popup-vertical-fit m-1" data-id="${f.id}" href="${f.image_path}" data-type="${dataType}" username="${f.full_name}" comment="${f.comment}" created-date="${f.date_added}" created-date1="${f.date_created}">
                                    ${mediaContent}
                                </a>
                                <div class="magnific__img-close ${dataType === 'video' ? 'videoClose' : ''}" data-type="${dataType}" data-id="${f.id}">
                                </div>
                                <div class="overlay ${dataType === 'video' ? 'videoOverlay' : ''}">${f.date_created}</div>
                                ${dataType === 'video' ? '<svg class="play-icon" width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M21.409 9.35331C21.8893 9.60872 22.291 9.99 22.5712 10.4563C22.8514 10.9226 22.9994 11.4563 22.9994 12.0003C22.9994 12.5443 22.8514 13.078 22.5712 13.5443C22.291 14.0106 21.8893 14.3919 21.409 14.6473L8.597 21.6143C6.534 22.7373 4 21.2773 4 18.9683V5.03331C4 2.72331 6.534 1.26431 8.597 2.38531L21.409 9.35331Z" fill="white"/></svg>' : ''}
                                <div class="mouseHoverx" title="${f.comment}" ><svg title="${f.comment}" class="i-icon ${dataType === 'video' ? 'vi-icon' : ''}" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16 8C16 9.05058 15.7931 10.0909 15.391 11.0615C14.989 12.0321 14.3997 12.914 13.6569 13.6569C12.914 14.3997 12.0321 14.989 11.0615 15.391C10.0909 15.7931 9.05058 16 8 16C6.94943 16 5.90914 15.7931 4.93853 15.391C3.96793 14.989 3.08601 14.3997 2.34315 13.6569C1.60028 12.914 1.011 12.0321 0.608964 11.0615C0.206926 10.0909 -1.56548e-08 9.05058 0 8C3.16163e-08 5.87827 0.842855 3.84344 2.34315 2.34315C3.84344 0.842855 5.87827 0 8 0C10.1217 0 12.1566 0.842855 13.6569 2.34315C15.1571 3.84344 16 5.87827 16 8ZM9.11111 4.22222C9.11111 4.51691 8.99405 4.79952 8.78567 5.0079C8.5773 5.21627 8.29469 5.33333 8 5.33333C7.70532 5.33333 7.4227 5.21627 7.21433 5.0079C7.00595 4.79952 6.88889 4.51691 6.88889 4.22222C6.88889 3.92754 7.00595 3.64492 7.21433 3.43655C7.4227 3.22817 7.70532 3.11111 8 3.11111C8.29469 3.11111 8.5773 3.22817 8.78567 3.43655C8.99405 3.64492 9.11111 3.92754 9.11111 4.22222ZM8.88889 12.8889V6.66667H7.11111V12.8889H8.88889Z" fill="white"/>
                                </svg></div>
                                </div>`);
                                    } else {
                                        $("." + newCls).append(`<div class="magnific-img mb-3">
                                <a class="image-popup-vertical-fit m-1" data-id="${f.id}" href="${f.image_path}" data-type="${dataType}" username="${f.full_name}" comment="-" created-date="${f.date_added}" created-date1="${f.date_created}">
                                    ${mediaContent}
                                </a>
                                <div class="magnific__img-close ${dataType === 'video' ? 'videoClose' : ''}" data-type="${dataType}" data-id="${f.id}">
                                </div>
                                <div class="overlay ${dataType === 'video' ? 'videoOverlay' : ''}">${f.date_created}</div>
                                ${dataType === 'video' ? '<svg class="play-icon" width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M21.409 9.35331C21.8893 9.60872 22.291 9.99 22.5712 10.4563C22.8514 10.9226 22.9994 11.4563 22.9994 12.0003C22.9994 12.5443 22.8514 13.078 22.5712 13.5443C22.291 14.0106 21.8893 14.3919 21.409 14.6473L8.597 21.6143C6.534 22.7373 4 21.2773 4 18.9683V5.03331C4 2.72331 6.534 1.26431 8.597 2.38531L21.409 9.35331Z" fill="white"/></svg>' : ''}
                                </div>`);
                                    }
                                });
                                $(".folder-photos").append('</section>');
                            });
                            $('.image-popup-vertical-fit').magnificPopup({
                                type: 'image',
                                mainClass: 'mfp-with-zoom',
                                gallery: {
                                    navigateByImgClick: false,
                                    enabled: true
                                },
                                zoom: {
                                    enabled: true,
                                    duration: 300, // duration of the effect, in milliseconds
                                    easing: 'ease-in-out', // CSS transition easing function
                                    opener: function(openerElement) {
                                        return openerElement.is('img') ? openerElement :
                                            openerElement.find('img');
                                    }
                                },
                                callbacks: {
                                    elementParse: function(item) {
                                        var type = item.el[0].getAttribute('data-type');
                                        if (type == 'video') {
                                            item.type = 'iframe';
                                        } else {
                                            item.type = 'image';
                                        }
                                    },
                                    open: function() {
                                        $('.mfp-wrap').children('div:eq(1)').remove();
                                        var anchorElement = this.currItem.el[0];
                                        var type = anchorElement.getAttribute('data-type');
                                        var htmlContent = generateAdditionalDetails(
                                            anchorElement);
                                        $('.mfp-wrap').append(htmlContent);
                                    },
                                    change: function() {
                                        $('.mfp-wrap').children('div:eq(1)').remove();
                                        var anchorElement = this.currItem.el[0];
                                        var htmlContent = generateAdditionalDetails(
                                            anchorElement);
                                        $('.mfp-wrap').append(htmlContent);
                                    }
                                }
                            });
                            $(document).on('click', 'img.mfp-img', function() {
                                $(this).toggleClass('zoom150');
                            });
                            $(document).on('click', '.magnific__img-close', function(e) {
                                e.stopPropagation();
                                var pid = $(this).attr("data-id");
                                var dataType = $(this).attr("data-type");

                                $confirm = confirm(
                                    'Are you sure you want to delete this ' + dataType +
                                    ' ?');
                                if ($confirm == true) {
                                    $(this).parent().remove();
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ route('property.photo.delete') }}",
                                        data: {
                                            '_token': "{{ csrf_token() }}",
                                            id: pid,
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            if (response.success == true) {
                                                $('#liveToast').toast('show');
                                            } else {
                                                alert('Not deleted.');
                                                window.location.reload();
                                            }
                                        }
                                    });
                                }
                            });
                            $(document).on('click', '.magnific__img-close3', function(e) {
                                e.stopPropagation();
                                var pid = $(this).attr("data-id");
                                var dataType = $(this).attr("data-type");
                                $confirm = confirm(
                                    'Are you sure you want to delete this comment ?');
                                if ($confirm == true) {
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ route('property.photo.comment') }}",
                                        data: {
                                            '_token': "{{ csrf_token() }}",
                                            id: pid,
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            if (response.success == true) {
                                                window.location.reload();
                                            } else {
                                                alert('Not deleted.');
                                                window.location.reload();
                                            }
                                        }
                                    });
                                }
                            });
                            $(document).on('click', '.toast-cls', function() {
                                $('#liveToast').toast('hide');
                            });
                        },
                        error: function() {}
                    });
                    $('.signle-ubtn').parent().attr('href',
                        `{{ url('dashboard/property/photo/download-all/${proId}/${secId}') }}`)
                    $('.signle-ubtn').html(`
                            <svg class="download-svg me-1" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_1326_1880)">
                                    <path d="M1.38815 14.9729C1.42876 14.9105 1.47049 14.8488 1.51055 14.7859C2.04243 13.9514 2.5259 13.0762 3.11509 12.2823C4.84648 9.9456 8.28923 9.79371 10.2476 11.9418C10.8507 12.6028 11.411 13.3027 11.9912 13.9842C12.0224 14.0209 12.0552 14.0565 12.1025 14.1088C12.9076 12.9839 14.0008 12.3947 15.3745 12.3947C16.7481 12.3947 17.8402 12.9917 18.6653 14.1617V13.8896C18.6653 12.6056 18.6653 11.3215 18.6653 10.0374C18.6653 9.51998 19.1393 9.18617 19.5894 9.3859C19.8721 9.51053 19.9989 9.74253 19.9984 10.0535C19.9984 11.1779 20.0017 12.3023 19.9984 13.4267C19.995 14.0387 20.0106 14.6507 19.9566 15.2572C19.7536 17.5388 17.902 19.5211 15.6365 19.9016C15.3013 19.9581 14.9622 19.9875 14.6223 19.9895C11.54 19.9959 8.45762 19.9959 5.37502 19.9895C2.78684 19.9857 0.645967 18.2515 0.114644 15.7234C0.0405669 15.3633 0.00328468 14.9966 0.00337179 14.629C-0.00478814 11.5401 -0.00608672 8.45122 -0.000523132 5.36231C0.00392774 2.6712 1.90167 0.466353 4.56162 0.0540912C4.81579 0.0163525 5.07244 -0.00224513 5.3294 -0.00154466C7.47472 -0.00599553 9.61985 -0.00599553 11.7648 -0.00154466C12.2917 -0.00154466 12.6277 0.443542 12.4536 0.899756C12.3506 1.17015 12.107 1.32982 11.782 1.32982C10.4212 1.32982 9.06053 1.32982 7.70004 1.32982C6.92114 1.32982 6.14224 1.32982 5.36723 1.32982C3.10285 1.33761 1.33752 3.09682 1.33474 5.3573C1.33029 8.45326 1.33029 11.5492 1.33474 14.6452V14.9517L1.38815 14.9729Z" fill="#1A47A3"></path>
                                    <path d="M15.663 6.25213V3.97106C15.663 2.87392 15.663 1.77734 15.663 0.680197C15.6607 0.593218 15.6757 0.506644 15.707 0.425458C15.7383 0.344273 15.7853 0.27008 15.8454 0.207149C15.9055 0.144219 15.9774 0.0937934 16.0571 0.0587756C16.1367 0.0237577 16.2225 0.00483793 16.3095 0.00310738C16.6806 -0.00523801 16.9771 0.281287 16.9933 0.670738C16.996 0.733051 16.9933 0.795919 16.9933 0.858231V6.20317L17.0439 6.23544C17.0834 6.17981 17.1184 6.12417 17.1624 6.07521C17.7143 5.46062 18.2673 4.84695 18.8215 4.23422C19.0106 4.02614 19.2471 3.95214 19.5203 4.03615C19.7845 4.11794 19.9653 4.30488 19.9715 4.57416C19.9765 4.75219 19.9236 4.97696 19.8112 5.10659C19.1397 5.88549 18.4582 6.65382 17.7527 7.39823C17.5707 7.59362 17.3505 7.7495 17.1058 7.85618C16.861 7.96287 16.597 8.01808 16.33 8.0184C16.063 8.01871 15.7988 7.96411 15.5538 7.858C15.3088 7.75189 15.0882 7.59653 14.9058 7.40157C14.1914 6.65438 13.5116 5.87381 12.825 5.10047C12.7666 5.03542 12.7218 4.95926 12.6934 4.87652C12.665 4.79379 12.6536 4.70619 12.6599 4.61895C12.6661 4.5317 12.6898 4.44661 12.7297 4.36875C12.7695 4.29089 12.8247 4.22187 12.8918 4.16579C12.9567 4.1075 13.0327 4.06281 13.1151 4.03433C13.1976 4.00586 13.2849 3.99418 13.372 3.99999C13.459 4.00579 13.5441 4.02897 13.622 4.06815C13.7 4.10732 13.7693 4.16171 13.8259 4.2281C14.3823 4.83676 14.9336 5.45209 15.4866 6.06742C15.5317 6.11304 15.5818 6.16367 15.663 6.25213Z" fill="#1A47A3"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1326_1880">
                                        <rect width="20" height="19.9955" fill="white" transform="translate(-0.00195312 0.000976562)"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                            Download`);
                    $('.photo-btn').removeClass('col-md-12');
                    $('.photo-btn').addClass('col-md-8');
                    $('.folder-name').html('');
                    $('.folder-name').html('<h4>' + folder + '</h4>')
                    $('.photo-header').toggleClass('d-none');
                    $('.photo-folders').toggleClass('d-none');
                    $('.folder-photos').toggleClass('d-none');
                    $('.photo-row').toggleClass('justify-content-end');
                    $(".folder_select").val(secId).change();
                    $('.folder_select').attr('disabled', true);
                    $('.fid').val(secId);
                }
            }
        });
    </script>
@endsection
