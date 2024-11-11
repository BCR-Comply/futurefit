@extends('layouts.dashboard.app')

@section('content')
<style>
    /* .btn-outline-sm.btn-danger.px-2.action-icon.rounded.ml-1{
      display: none !important;
    } */
    table td,table th {
      outline: 1px solid #e6e6e6 !important;
    }
    .table > :not(caption) > * > *{
        padding: 0.5rem 0.5rem !important;
    }
</style>
    <h4 class="page-title">TOOLBOX TALK</h4>

    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <div class="d-flex justify-content-end pb-3">
                        <a href="{{route('toolboxTalk.create')}}" class="btn _btn-primary pull px-3">ADD TOOLBOX TALK</a>
                    </div>
                    <table id="toolbox-talk-datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th style="width: 100px">ID</th>
                            <th>TITLE</th>
                            <th>STATUS</th>
                            <th style="width: 100px">ACTION</th>
                        </tr>
                        </thead>
                    </table>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
