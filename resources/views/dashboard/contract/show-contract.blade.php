@extends('layouts.dashboard.app')
@push('styles')
<style>
    .accept-text{
        color: #72e48c !important;
    }

    .reject-text{
        color: #fc717d !important;
    }
</style>
@endpush

@section('content')

    <?php
    $status_color = [
        'Pending' => 'text-secondary',
        'Accepted' => 'text-info',
        'Rejected' => 'text-danger',
        'Complete' => 'text-success',
        'Variation' => 'text-warning'
    ];
    ?>

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
                                                {{$property->wh_fname.' '.$property->wh_lname}}
                                                <br>
                                                {{$property->phone1}}
                                                <br>
                                                {{$property->email}}
                                            </b>
                                        </p>
                                    </div>
                                </td>
                                <td class="py-0" style="border-right: 1px #808080 solid">
                                    <div>
                                        <h5>Address</h5>
                                        <p>
                                            <b>
                                                {{format_address(
                                                            $property->house_num,
                                                            $property->address1,
                                                            $property->address2,
                                                            $property->address3,
                                                            $property->county,
                                                            $property->eircode
                                                )}}
                                            </b>
                                        </p>
                                    </div>
                                </td>
                                <td class="py-0" style="border-right: 1px #808080 solid">

                                    <div>
                                        <h5 class="mb-0">Start Date:</h5>
                                        <p>{{date('d/m/Y', strtotime($property['start_date']))}}</p>
                                    </div>

                                    <div>
                                        <h5 class="my-0">End Date:</h5>
                                        <p>{{date('d/m/Y', strtotime($property['end_date']))}}</p>
                                    </div>

                                </td>

                                <td class="py-0" style="border-right: 1px #808080 solid">
                                    <div>
                                        <h5>MPRN</h5>
                                        <p><b>{{$property['wh_mprn']}}</b></p>
                                    </div>
                                </td>
                                <!-- <td class="py-0" style="border-right: 1px #808080 solid">
                                    <div>
                                        <h5>Scheme</h5>
                                        <p><b>{{isset($property->batch) ? $property->batch->scheme->scheme : ''}}</b>
                                        </p>
                                    </div>
                                </td> -->
                                <td class="py-0" style="border-right: 1px #808080 solid">
                                    <div>
                                        <h5>Client</h5>
                                        <p><b>{{isset($property['client']) ? $property['client']['name'] : ''}}</b></p>
                                    </div>
                                </td>
                                <td class="py-0">
                                    <div>
                                        <h5>Batch</h5>

                                        <p><b>{{isset($property->batch) ? $property->batch->our_ref : ''}}</b>
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

                    @php
                        $status_color = [
                            'Pending' => 'text-warning',
                            'Accepted' => 'text-success',
                            'Rejected' => 'text-danger',
                            'Complete' => 'text-success',
                            'Variation' => 'text-info',
                            'In-Progress' => 'text-secondary'
                        ];
                    @endphp 
                    @foreach($contacts as $contract)
                        <div class="border my-4 px-3 py-2">

                            <div class="px-2">
                                <h4><u>Cost: €{{$contract->cost}}</u> 
                                    @if($contract->status == 'Pending')
                                        <div style="float: right;"><a href="{{ route('contractor.accept.contract', $contract['id']) }}" class="btn _btn-primary">Accept</a>  <a href="{{ route('contractor.reject.contract', $contract['id']) }}" class="btn btn-danger">Reject</a></div></h4>
                                    @else
                                     <div style="float: right;"> <p class="alert-link {{ $status_color[$contract->status] }} ">{{ $contract->status }} </p></div>
                                    
                                    @endif
                                    
                            </div>

                            <form method="POST"
                                  action="{{ route('contract.uploadFile') }}"
                                  enctype="multipart/form-data"
                            >
                                @csrf

                                <input type="hidden" name="id" value="{{$contract['id']}}">
                                <div class="card-body my-1 p-2">

                                    <h5>Document(s) upload for: <span class="text-danger">{{$contract->job_lookup->title ?? ''}}</span></h5>
                                    <p class="bg-secondary text-white p-2"><b>Note: </b>{{$contract->notes}}</p>
                                    <div class="row mt-2">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="document" class="form-label">Job</label>
                                                <select name="document"
                                                        class="form-select  @error('document') is-invalid @enderror"
                                                        id="document"
                                                        required
                                                >

                                                {{json_encode($contractor_jobs)}}

                                                @if(isset($contractor_jobs[$contract['job_id']]['documents']))

                                                    @foreach($contractor_jobs[$contract['job_id']]['documents'] as $document)
                                                        <option
                                                            value="{{$document}}">{{$document}}</option>
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

                                            @if(isset($contract['document']))
                                                <ul>
                                                    @foreach($contract['document'] as $document)
                                                        <li>
                                                            <b>{{$document['document']}}:</b>
                                                            <a target="_blank"
                                                               href="/files/{{$document['file']}}">{{$document['file']}} {{$document['author'] ? '| '.$document['author'] : ''}}</a>
                                                            @if($contract['status'] != 'Complete')

                                                                <a
                                                                    class="text-danger ml-2"
                                                                    href="{{route('contract.deleteDocument', $document['id'])}}"
                                                                    onClick="return confirm(`Are you sure you want to delete this document?`)"
                                                                    title="Delete document"
                                                                >
                                                                    X
                                                                </a>

                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mt-2">
                                                <label for="document" class="form-label text-danger">Documents remaining
                                                    to
                                                    be uploaded: </label>

                                                <span
                                                    class="text-black">{{join(", ", $contract['remaining_documents'])}}</span>

                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </form>

                            <hr>

                            <div class="p-2 mt-1">
                                <form action="{{route('contract.updateStatus')}}" method="POST">
                                    <div class="row">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$contract['id']}}">
                                        <input type="hidden" name="property_id" value="{{$contract['property_id']}}">
                                        <input type="hidden" name="current_status" value="{{$contract->status}}">

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="contractor_notes" class="form-label">Contractor
                                                    Notes</label>
                                                <textarea
                                                    type="text" id="contractor_notes" name="contractor_notes"
                                                    class="form-control  @error('contractor_notes') is-invalid @enderror"
                                                    placeholder="Enter contractor_notes"
                                                    rows="5"
                                                >{{  $contract->contractor_notes ?? old('contractor_notes') }}</textarea>
                                                @error('contractor_notes')
                                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="mb-3">

                                                <label for="status" class="form-label">Status</label>

                                                <select name="status"
                                                        class="form-select  @error('status') is-invalid @enderror"
                                                        required>

                                                    @foreach($contact_status as $status)
                                                        <option
                                                            value="{{$status}}" {{isset($contract) ? ($contract->status == $status ? 'selected' : '') : ''}}>
                                                            {{$status}}
                                                        </option>
                                                    @endforeach

                                                </select>

                                                @error('status')
                                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>


                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-13">
                                            <button class="btn _btn-primary float-end">Update Status</button>
                                        </div>
                                    </div>


                                </form>

                                <hr>

                                <div class="my-3">
                                    <h5 class="m-0">Work Orders</h5>
                                    @if($contract['word_orders'])
                                        <ol class="mt-2">
                                            @foreach($contract['word_orders'] as $file)
                                                <li>
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <a class="{{$file['status'] != 'Active' ? 'text-secondary' : ''}}"
                                                               target="_blank"
                                                               href="/files/{{$file['status'] == 'Active' ?  $file['file_path'] : ''}}">{{$file['file_name']}}</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ol>
                                    @endif
                                </div>

                                <hr>

                                <div class="mt-3">
                                    <h5>Variation(s)</h5>


                                    <form action="{{route('contract.createVariation')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="contractor_property_id"
                                                   value="{{$contract['id']}}">
                                            <div class="col-sm-6 col-md-4 pl-1">
                                            <textarea class="form-control" name="notes" id="" cols="30" rows="3"
                                                      placeholder="Notes" required></textarea>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <input class="form-control" type="number" step=".01"
                                                       name="additional_cost"
                                                       min="0"
                                                       placeholder="Additional Cost" required>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <button
                                                    onClick="return confirm(`Are you sure you want to add variation?`)"
                                                    class="btn _btn-primary">Add Variation
                                                </button>
                                            </div>
                                        </div>
                                    </form>


                                    @if(sizeof($contract['variation']))
                                        <tr>
                                            <td colspan="9">

                                                <div class="row col-sm-12">
                                                    <table class="table table-bordered mt-2 ml-1">
                                                        <tr>
                                                            <th>Notes</th>
                                                            <th>Cost</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>File</th>
                                                            <th>Upload File</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        @foreach($contract['variation'] as $variation)
                                                            <tr>
                                                                <td style="max-width: 250px">{{$variation['notes']}}</td>
                                                                <td>{{number_format((float)$variation['additional_cost'], 2, '.', '')}}</td>
                                                                <td>{{date('d/m/Y', strtotime($variation['date']))}}</td>
                                                                <td>{{$variation['status']}}</td>
                                                                <td class="d-flex flex-column">
                                                                    @foreach($variation['documents'] as $document)
                                                                        <a target="_blank"
                                                                           href="/files/{{$document['file_path']}}">{{$document['file_path']}}</a>
                                                                        @if($contract['status'] != 'Complete')

                                                                            <a
                                                                                class="text-danger ml-2"
                                                                                href="{{route('contract.deleteVariationDocument', $document['id'])}}"
                                                                                onClick="return confirm(`Are you sure you want to delete this document?`)"
                                                                                title="Delete document"
                                                                            >
                                                                                X
                                                                            </a>

                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td>

                                                                    <form
                                                                        action="{{route('contract.uploadVariationDocument')}}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input
                                                                            type="hidden"
                                                                            class="hidden"
                                                                            name="variation_id"
                                                                            value="{{$variation['id']}}"
                                                                        >
                                                                        <div class="d-flex">
                                                                            <input type="file" name="document"
                                                                                   class="mx-0 px-0"
                                                                                   required
                                                                            >
                                                                            <button
                                                                                class="btn btn-sm _btn-primary mx-0">
                                                                                UPLOAD
                                                                            </button>
                                                                        </div>

                                                                    </form>

                                                                </td>
                                                                <td>

                                                                    <a onClick="return confirm(`Are you sure you want to delete?`)"
                                                                       href="{{route('contract.deleteVariation', \Illuminate\Support\Facades\Crypt::encrypt($variation['id']))}}"
                                                                       class="btn-outline-sm btn-danger  px-2 action-icon rounded ml-1"
                                                                       title="delete"> <i
                                                                            class="text-white mdi mdi-delete"></i></a>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>

                                                </div>

                                            </td>
                                        </tr>

                                    @endif
                                </div>


                            </div>

                        </div>
                    @endforeach


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->


    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">

                    <h3>HEA / BER Documents</h3>

                    <div class="table-responsive mt-2">

                        <table class="table table-bordered border-light-grey">
                            <tbody>

                            @foreach($assessors as $assessor)
                                @if(sizeof($assessor['document']))
                                    <tr class="bg-lighter">

                                        <td colspan="10">
                                            <ul class="list-unstyled">
                                                @foreach($assessor['document'] as $document)
                                                    <li>
                                                        <b>{{$document['document']}}:</b>
                                                        <a target="_blank"
                                                           href="/files/{{$document['file']}}">{{$document['file']}}</a>
                                                    </li>

                                                @endforeach
                                            </ul>

                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="9" class="p-0">
                                        <div class="d-flex p-2 py-1">
                                            &nbsp;
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
