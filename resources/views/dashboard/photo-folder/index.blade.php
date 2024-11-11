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
    <h4 class="page-title">FOLDERS</h4>

    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <div class="d-flex justify-content-end pb-3">
                        <a href="javascript:void(0);" class="btn _btn-primary pull px-3 openModal" data-type="add">ADD FOLDER</a>
                    </div>
                    <table id="photo-datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th style="width: 100px">ID</th>
                            <th>NAME</th>
                            {{-- <th>STATUS</th> --}}
                            <th>DATE</th>
                            <th style="width: 100px">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($photoFolders as $photoFolder)
                            <tr>
                                <th>{{$photoFolder->id}}</th>
                                <th>{{$photoFolder->name}}</th>
                                {{-- <th>{{$photoFolder->status == 1 ? "Active" : "In-Active"}}</th> --}}
                                <th>{{date('d/m/Y',strtotime($photoFolder->created_at))}}</th>
                                <th>
                                    <a href="javascript:void(0);" class="btn-outline-sm _btn-primary px-2  action-icon rounded openModal" title="edit" data-type="edit" data-collection="{{ json_encode($photoFolder) }}"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>
                                    <a onClick="return confirm(`Are you sure you want to delete?`)" href="{{ url('/dashboard/lookup/deletePhotoFolder?id='.$photoFolder->id) }}" class="btn-outline-sm btn-danger  px-2 action-icon rounded ml-1" title="delete"> <i class="text-white mdi mdi-delete"></i></a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Modal title</h5>
              <a href="javascript:void(0);" class="closeEdit" style="font-size: 22px;">&times;</a>
            </div>
            <form action="{{ route('saveNewFolder') }}" id="folderForm" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" id="name" name="name" value="" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary closeEdit" >Close</button>
              <button type="submit" class="btn _btn-primary submitBtns">Save changes</button>
            </div>
        </form>
          </div>
        </div>
      </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).on('click','.openModal', function(){
        var dataType = $(this).attr('data-type');
        $("#name").val('');
        $("#id").val('');
        $('.submitBtns').text('Save');
        $('#editModalLabel').text("Add Folder");
        if(dataType == "edit"){
            $('.submitBtns').text('Update');
            $('#editModalLabel').text("Add Folder");
            var datacol = $(this).attr('data-collection');
            var data = JSON.parse(datacol);
            console.log(JSON.parse(datacol));
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#editModalLabel').text("Edit Folder");
        }
        $('#editModal').modal('show');
    });
    $(document).on('click','.closeEdit', function(){
        $('#editModal').modal('hide');
    });

</script>
@endsection
