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
    .overflowClass{
        max-width: 160px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
  </style>
    <h4 class="page-title text-uppercase">{{$title}}</h4>
    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body mybody">
                    <div class="row mb-1">
                        <div class="col-sm-8 col-md-10">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 col-lg-2">
                                    <div class="form-group">
                                        <div>
                                            <label for="leads_status_filter">Lead Stage</label>
                                        </div>
                                        <select id="leads_status_filter" class="form-control">
						                    <option value="">All Leads</option>
                                            @php
                                                $lead_statuss = [
                                                    'lead',
                                                    'appointment_booked',
                                                    'surveyed',
                                                    'confirmed',
                                                    'will-follow-up',
						                            'quoted',
                                                    'not_interested',
                                                    'lost'
                                                ];
                                            @endphp
                                            @foreach($property_status as $key => $value)
                                                    @if (in_array($key, $lead_statuss))
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endif
                                            @endforeach
					                    </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4 col-lg-2">
                                    <div class="form-group">
                                        <div>
                                            <label for="leads_start_date_filter">Created Date</label>

                                        </div>
                                        <input type="date" name="leads_start_date_filter"
                                               id="leads_start_date_filter" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4 col-lg-2">
                                    <div class="form-group">
                                        <div class="overflowClass">
                                            <label for="leads_end_date_filter">Expected Close Date</label>
                                        </div>
                                        <input type="date" name="leads_end_date_filter"
                                               id="leads_end_date_filter" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-2">
                                    <div class="pb-3">
                                    <a href="{{route('lead.create')}}" class="btn _btn-primary pull mt-3 d-block">ADD LEAD</a>
                                    <a href="{{route('property.import')}}" class="btn _btn-primary pull  mt-1 mr-1 d-none" title="IMPORT LEADS">
                                        IMPORT CSV
                                    </a>
                                    </div>
                                </div>
                    </div>
                    <table id="leads-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                                <th>ID</th>
                                <th>FULL NAME</th>
                                <th>EMAIL</th>
                                <th>ADDRESS</th>
                                <th>EIRCODE</th>
                                <th>LEAD TYPE</th>
                                <th>LEAD VALUE</th>
                                <th>STAGE</th>
                                <th>QUOTATION</th>
                                <th>CREATED DATE</th>
                                <th>EXPECTED CLOSE DATE</th>
                                <th>ACTIONS</th>
                        </tr>

                        </thead>
                    </table>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
