@extends('layouts.dashboard.app')

@section('content')

    <h4 class="page-title">CONTRACTS</h4>

    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <table id="contract-datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>Address</th>
                            <th>Batch</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>End Date</th>
                            <th style="width: 70px">ACTION</th>
                        </tr>
                        </thead>
                    </table>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->


@endsection
