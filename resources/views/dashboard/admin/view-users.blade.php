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
        background-color: #e2e8ed !important;
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
  </style>
    <h4 class="page-title">ADMIN USERS</h4>

    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body mybody">
                    <div class="d-flex justify-content-end pb-3">
                        <a href="{{route('user.create')}}" class="btn _btn-primary pull px-3">ADD ADMIN</a>
                    </div>
                    <table id="admin-users-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>FIRST NAME</th>
                            <th>LAST NAME</th>
                            <th>EMAIL</th>
                            <th>TYPE</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                    </table>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->



@endsection