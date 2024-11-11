@extends('layouts.dashboard.app')

@section('content')
<style>
    
    th:first-child {
      border-top-left-radius: 12px; /* Adjust the pixel value as needed */
    }
    th:last-child {
      border-top-right-radius: 12px; /* Adjust the pixel value as needed */
    }
    tr:last-child td:first-child {
      border-bottom-left-radius: 12px; /* Adjust the pixel value as needed */
    }
    tr:last-child td:last-child {
      border-bottom-right-radius: 12px; /* Adjust the pixel value as needed */
    }
    .mybody{
        background-color: #e2e8ed;
        border-radius: 5px !important;
    }
    table{
        background-color: #fff;
        border-radius: 12px !important;
    }
    table {
      margin: 0 auto;
      outline: 1px solid white;
      outline-offset: -2px;
    }
    table td,table th {
      outline: 1px solid #e6e6e6 !important;
    }
    .table > :not(caption) > * > *{
        padding: 0.5rem 0.5rem !important;
    }

    #properties-datatable {
        margin-top: unset !important;
    }
  </style>
    <h4 class="page-title text-uppercase">{{$title}}</h4>

    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body mybody">
                    <div class="row @if($scheme_id == 0) mb-1 @else cs-mrgn @endif">
                        <div class="col-sm-8 @if($scheme_id == 0) col-md-10 @else col-md-12 @endif">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 col-lg-2 pe-lg-0">
                                    <div class="form-group">
                                        <div>
                                            <label for="property_scheme_filter" style="color: transparent;">Scheme</label>
                                        </div>
                                        <select id="property_scheme_filter" class="form-control">
                                            <option value="">All Schemes</option>
                                            @foreach($schemes as $scheme)
                                                <option value="{{$scheme->scheme}}">{{$scheme->scheme}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 pe-lg-0">
                                    <div class="form-group">
                                        <div>
                                            <label for="property_batch_filter" style="color: transparent;">Batch</label>
                                        </div>
                                        <select id="property_batch_filter" class="form-control">
                                            <option value="">All Batches</option>
                                            @foreach($batches as $batch)
                                                <option value="{{$batch->our_ref}}">{{$batch->our_ref}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="form-group">
                                        <div>
                                            <label for="property_status_filter" style="color: transparent;">Property Status</label>
                                        </div>
                                        <select id="property_status_filter" class="form-control">
                                            <option value="">All Statuses</option>
                                            @foreach($property_status as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4 col-lg-2 ps-lg-0">
                                    <div class="form-group">
                                        <div>
                                            <label for="property_start_date_filter">Start Date</label>
                                        </div>
                                        <input type="date" name="property_start_date_filter"
                                               id="property_start_date_filter" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4 col-lg-2 ps-lg-0 @if($scheme_id == 0) pe-lg-0 @endif">
                                    <div class="form-group">
                                        <div>
                                            <label for="property_end_date_filter">End Date</label>
                                        </div>
                                        <input type="date" name="property_end_date_filter"
                                               id="property_end_date_filter" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($scheme_id == 0)
                            <div class="col-sm-6 col-md-4 col-lg-2">
                                <div class="pb-2">
                                    {{-- @if($scheme_id == 0) --}}
                                        <a href="{{route('property.create')}}" class="btn _btn-primary pull mt-3 d-block">ADD PROPERTY</a>
                                        <a href="{{route('property.import')}}" class="btn _btn-primary pull  mt-1 d-block" title="IMPORT PROPERTIES">
                                            IMPORT CSV
                                        </a>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        @endif
                    </div>
                    <table id="properties-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>SCHEME</th>
                            <th>BATCH</th>
                            <th>CLIENT</th>
                            <th>ADDRESS</th>
                            <th>START DATE</th>
                            <th>END DATE</th>
                            <th>HEA STATUS</th>
                            <th>EIRCODE</th>
                            <th>CONTRACTOR STATUS</th>
                            <th>PROPERTY STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>
                    </table>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
