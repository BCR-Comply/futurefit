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
    .btn-outline-sm.btn-danger.px-2.mr-1.action-icon.rounded{
        display: none !important;
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
    <h4 class="page-title">DOCUMENTS</h4>

    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body mybody">
                    <div class="d-flex justify-content-end pb-3">
                        <a href="{{route('document.create')}}" class="btn _btn-primary pull px-3">ADD DOCUMENT</a>
                    </div>
                    <table id="document-datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>JOB LOOKUP</th>
                            <th>DOCUMENT TYPE</th>
                            <th>DOCUMENT</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                    </table>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

@endsection

@push('scripts')
    <script>
    $('#document-datatable').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, 250, 500],
            [10, 25, 50, 100, 250, 500],
        ],
        dom: 'fBrtlp',
            buttons: [
                    {
                        extend: 'collection',
                        text: 'Export',
                        buttons: [
                            'copy',
                            'excel',
                            'csv',
                            'pdf',
                            'print'
                        ]
                    }
                ],
        serverSide: true,
        pageLength: 25,
        responsive: true,
        select: true,
        "processing": true,
        "language": {
            "paginate": {
                        "previous": "<",
                        "next": ">"
                    },
            processing: '<i class="text-primary mdi mdi-spin mdi-loading mr-3 mdi-20px"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('document.index')}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'job_look.title', name: 'job_look.title', defaultContent: 'N/A'},
            {data: 'job_document_type.title', name: 'job_document_type.title', defaultContent: 'N/A'},
            {data: 'document', name: 'document', defaultContent: 'N/A'},
            {data: 'status', name: 'status', defaultContent: 'N/A'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function() {
                var table = this.api();
                if (table.rows().count() === 0) {
                    $('.buttons-collection').addClass('disabled');
                }
            }
    });
    </script>
@endpush