@extends('layouts.dashboard.app')

@section('content')
<style>
    .change-profile {
        background-color: #fff;
        color: #1A47A3;
        border: 2px solid #1A47A3;
        border-radius: 36px;
        padding: 8px 20px;
        font-weight: 600;
        cursor: pointer;
    }
    .remove-profile {
        background-color: #fff;
        color: #df3e5f;
        border: 2px solid #df3e5f;
        border-radius: 36px;
        padding: 8px 20px;
        font-weight: 600;
        cursor: pointer;
    }
    @media (min-width: 992px) {
        .b-right {
            border-right: 1px solid #000000;
        }
    }
    .link-input,.link-input::before,.link-input::after,.link-input:focus-visible {
        border: 0 !important;
        outline: unset !important;
        color: #6C757D !important;
    }
    tr td:not(:last-child),
    tr th:not(:last-child) {
        border-right: 1px solid #e6e6e6 !important;
    }
    #work-desc-datatable> :not(caption)>*>* {
        padding: 0.5rem 0.5rem !important;
    }
    .cke_button__image,
    .cke_button__source,
    .cke_button__table {
        display: none !important;
    }
</style>
<h4 class="page-title">REPORT CONFIG</h4>

<div class="row">
    <div class="col-12">
        <div class="card _shadow-1">
            <div class="card-body">
                <form method="POST" action="{{ route('report-config.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-xs-6 col-sm-6">
                            <label for="company_logo">Company Logo*</label>
                            <div class="col-md-12 mt-2 mb-2 d-flex justify-content-center">
                              @if($config->company_logo == null)
                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" id="img-prev" class="rounded-circle" style="height: 200px;width: 200px;">
                              @else
                                <img src="{{ asset('assets/images/report_company_logo/'.$config->company_logo) }}" alt="user-image" id="img-prev" class="rounded-circle" style="height: 200px;width: 200px;">
                              @endif
                            </div>
                            <div class="col-md-12 mt-2 mb-2 d-flex justify-content-around">
                              <input type="hidden" name="company_logo_filename" id="company_logo_filename" value="{{ $config->company_logo }}">
                              <input type="file" name="company_logo" id="company_logo" style="display: none;" accept="image/*">
                              <label for="company_logo" class="change-profile">Change</label>
                              <a href="#" class="remove-profile">Remove</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Company Name*</label>
                                        <input value="{{  $config->name ?? old('name') }}" type="text" name="name"
                                            id="name" class="form-control  @error('name') is-invalid @enderror"
                                            placeholder="Enter Company Name" required>
                                        @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address*</label>
                                        <input value="{{  $config->address ?? old('address') }}" type="text" name="address"
                                            id="address" class="form-control  @error('address') is-invalid @enderror"
                                            placeholder="Enter address" required>
                                        @error('address')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone*</label>
                                        <input value="{{  $config->phone ?? old('phone') }}" type="text" name="phone"
                                            id="phone" class="form-control  @error('phone') is-invalid @enderror"
                                            pattern="^\d+$"
                                            placeholder="Enter Phone Number" required>
                                        @error('phone')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="website" class="form-label">Website</label>
                                        <input value="{{  $config->website ?? old('website') }}" type="tel" name="website"
                                            id="website" class="form-control  @error('website') is-invalid @enderror"
                                            placeholder="Enter Website">
                                        @error('website')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn _btn-primary float-end">UPDATE CONFIG</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row my-3">
                    <label for="name" class="form-label">Description of Works</label>
                    <div class="col-12">
                        <button type="button" class="btn _btn-primary float-end addDescBtn" data-bs-toggle="modal" data-bs-target="#descModal">Add Description</button>
                    </div>
                    <div class="col-12 mt-3">
                        <table id="work-desc-datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width: 6%">ID</th>
                                    <th>NAME</th>
                                    {{-- <th>DESCRIPTION</th> --}}
                                    <th style="width: 10%">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quotWorkDesc as $desc)
                                <tr>
                                    <td>{{ $desc->id }}</td>
                                    <td>{{ $desc->name }}</td>
                                    {{-- <td>{!! $desc->description !!}</td> --}}
                                    <td>
                                        <button title="View Description" class="btn btn-outline-sm _btn-primary px-2 action-icon rounded viewDescBtn"
                                            data-bs-toggle="modal" data-bs-target="#viewDescModal" data-id="{{ $desc->id }}">
                                                <i class="text-white mdi mdi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-sm _btn-primary px-2 action-icon rounded editDescBtn" title="Edit Description"
                                            data-bs-toggle="modal" data-bs-target="#editDescModal" data-id="{{ $desc->id }}">
                                                <i class="text-white mdi mdi-circle-edit-outline"></i>
                                        </button>
                                        <a href="{{ route('desc-work.delete',[$desc->id]) }}" class="btn btn-outline-sm btn-danger px-2 my-1 action-icon rounded"
                                            title="View Description">
                                            <i class="text-white mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end row-->

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->

</div>
<!--Add Desc Modal -->
<div class="modal fade" id="descModal" tabindex="-1" aria-labelledby="descModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title" id="descModalLabel">Add Description</h1>
                <svg class="modal-cls-btn" data-bs-dismiss="modal" aria-label="Close" width="18"
                    height="17" viewBox="0 0 18 17" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path id="Arrow Left" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.99335 14.6187C8.38758 15.0511 8.39331 15.7459 8.00006 16.1773C7.60954 16.6056 6.98129 16.611 6.58171 16.1727L0.29715 9.27933C-0.0956605 8.84846 -0.102425 8.15731 0.29715 7.71902L6.58171 0.825611C6.97453 0.394745 7.60682 0.389723 8.00006 0.821065C8.39059 1.24942 8.39192 1.94245 7.99335 2.37964L3.41431 7.4023L16.9975 7.4023C17.5512 7.4023 18 7.88916 18 8.49917C18 9.10496 17.5475 9.59605 16.9975 9.59605L3.41431 9.59605L7.99335 14.6187Z"
                        fill="#2A2D34" />
                </svg>
            </div>
            <form id="descWorkForm" action="{{ route('desc-work.create') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="mb-2">
                        <select class="form-select" id="measure" name="measure" required>
                            <option value="">-- Select --</option>
                            @foreach ($contractor_jobs as $measure)
                                <option value="{{ trim($measure->measure_name) }}">{{ trim($measure->measure_name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <textarea name="ckeditor" id="ckeditor" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="save-btn" class="btn _btn-primary w-100 mt-0 mb-0">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Edit Desc Modal -->
<div class="modal fade" id="editDescModal" tabindex="-1" aria-labelledby="editDescModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title" id="editDescModalLabel">Edit Description</h1>
                <svg class="modal-cls-btn" data-bs-dismiss="modal" aria-label="Close" width="18"
                    height="17" viewBox="0 0 18 17" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path id="Arrow Left" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.99335 14.6187C8.38758 15.0511 8.39331 15.7459 8.00006 16.1773C7.60954 16.6056 6.98129 16.611 6.58171 16.1727L0.29715 9.27933C-0.0956605 8.84846 -0.102425 8.15731 0.29715 7.71902L6.58171 0.825611C6.97453 0.394745 7.60682 0.389723 8.00006 0.821065C8.39059 1.24942 8.39192 1.94245 7.99335 2.37964L3.41431 7.4023L16.9975 7.4023C17.5512 7.4023 18 7.88916 18 8.49917C18 9.10496 17.5475 9.59605 16.9975 9.59605L3.41431 9.59605L7.99335 14.6187Z"
                        fill="#2A2D34" />
                </svg>
            </div>
            <form id="descWorkForm" action="{{ route('desc-work.update') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="desc_id" name="desc_id">
                    <div class="mb-2">
                        <select class="form-select" id="editmeasure" name="editmeasure" required>
                            <option value="">-- Select --</option>
                            @foreach ($contractor_jobs as $measure)
                                <option value="{{ trim($measure->measure_name) }}">{{ trim($measure->measure_name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <textarea name="editCkeditor" id="editCkeditor" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="update-btn" data-name="" class="btn _btn-primary w-100 mt-0 mb-0">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--View Desc Modal -->
<div class="modal fade" id="viewDescModal" tabindex="-1" aria-labelledby="viewDescModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title" id="viewDescModalLabel">View Description</h1>
                <svg class="modal-cls-btn" data-bs-dismiss="modal" aria-label="Close" width="18"
                    height="17" viewBox="0 0 18 17" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path id="Arrow Left" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.99335 14.6187C8.38758 15.0511 8.39331 15.7459 8.00006 16.1773C7.60954 16.6056 6.98129 16.611 6.58171 16.1727L0.29715 9.27933C-0.0956605 8.84846 -0.102425 8.15731 0.29715 7.71902L6.58171 0.825611C6.97453 0.394745 7.60682 0.389723 8.00006 0.821065C8.39059 1.24942 8.39192 1.94245 7.99335 2.37964L3.41431 7.4023L16.9975 7.4023C17.5512 7.4023 18 7.88916 18 8.49917C18 9.10496 17.5475 9.59605 16.9975 9.59605L3.41431 9.59605L7.99335 14.6187Z"
                        fill="#2A2D34" />
                </svg>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <select class="form-select" id="viewmeasure" name="viewmeasure" disabled>
                        <option value="">-- Select --</option>
                        @foreach ($contractor_jobs as $measure)
                            <option value="{{ trim($measure->measure_name) }}">{{ trim($measure->measure_name) }}</option>
                        @endforeach
                    </select>
                </div>
                <textarea name="viewCkeditor" id="viewCkeditor" style="width: 100%;" disabled></textarea>
            </div>
        </div>
    </div>
</div>
<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 85px; right: 0;z-index:1;border:unset;">
    <div class="toast-header" style="background-color:#fee5e5;border-bottom:unset;border-radius:8px;">
      <strong class="mr-auto" id="toast-err" style="color: #F10000;"></strong>
      <button type="button" class="close toast-cls" data-dismiss="toast" aria-label="Close" style="border: unset;background:unset;">
        <span aria-hidden="true" style="font-size: 18px;">&times;</span>
      </button>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
       $(document).ready(function() {
        CKEDITOR.replace( 'ckeditor' );
        CKEDITOR.replace( 'editCkeditor' );
        CKEDITOR.replace( 'viewCkeditor' );

        if ("{{ $errors->has('ckeditor') }}"){
            $('#liveToast').toast('show');
            $('#toast-err').html("The Description field is required.")
        }
        if ("{{ $errors->has('measure') }}"){
            $('#liveToast').toast('show');
            $('#toast-err').html("{{ $errors->first('measure') }}")
        }

        $(document).on('click','.addDescBtn', function() {
            var v_token = "{{ csrf_token() }}";
            $('input[name="_token"]').val(v_token);
        });

        $(document).on('click','.editDescBtn', function() {
            var v_token = "{{ csrf_token() }}";
            $('input[name="_token"]').val(v_token);
            $('#editmeasure').attr('disabled', true);

            var id = $(this).attr('data-id');
            $('#desc_id').val(id);
            $.ajax({
                type: 'GET',
                url: '/dashboard/config/view-description-work/'+ id,
                success: function(res) {
                    if(res.success == true){
                        $('#editmeasure option')
                            .removeAttr('selected')
                            .filter('[value="'+res.data.name+'"]')
                            .attr('selected', true);


                        CKEDITOR.instances.editCkeditor.setData(res.data.description);
                    }else{
                        $('#liveToast').toast('show');
                        $('#toast-err').html("Something went wrong!.")
                    }
                }
            });
        });

        $(document).on('click','.viewDescBtn', function() {
            var id = $(this).attr('data-id');
            $('#desc_id').val(id);
            $.ajax({
                type: 'GET',
                url: '/dashboard/config/view-description-work/'+ id,
                success: function(res) {
                    if(res.success == true){
                        $('#viewmeasure option')
                            .removeAttr('selected')
                            .filter('[value="'+res.data.name+'"]')
                            .attr('selected', true);

                        CKEDITOR.instances.viewCkeditor.setData(res.data.description);
                    }else{
                        $('#liveToast').toast('show');
                        $('#toast-err').html("Something went wrong!.")
                    }
                }
            });
        });

        $('#descModal').on('hidden.bs.modal', function() {
            $(this)
                .find("input,textarea")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            CKEDITOR.instances.ckeditor.setData('');
        });

        $('#editDescModal').on('hidden.bs.modal', function() {
            $(this)
                .find("input,textarea")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            CKEDITOR.instances.editCkeditor.setData('');
        });

        $('#company_logo').change(function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img-prev').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        $('.remove-profile').click(function(e) {
            e.preventDefault();
            $('#img-prev').attr('src', '{{ asset('assets/images/users/avatar-1.jpg') }}');
            $('#company_logo').val('');
            $('#company_logo_filename').val('');
        });

        $('.change-profile').click(function(e) {
            e.preventDefault();
            $('#company_logo').click();
        });
    });
    </script>
@endsection
