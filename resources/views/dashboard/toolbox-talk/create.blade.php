@extends('layouts.dashboard.app')

@section('content')
<div class="col-md-12 mt-3 d-flex align-items-center justify-content-start">
    <a href="{{ url('/dashboard/toolbox-talk') }}">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
            class="mdi mdi-menu cliclef mr-3">
            <rect width="32" height="32" rx="16" fill="#E2E8ED" />
            <path
                d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
                fill="black" />
        </svg>
    </a>

    @isset($toolbox_talk)
        <h4 class="page-title">UPDATE TOOLBOX TALK</h4>
    @else
        <h4 class="page-title">NEW TOOLBOX TALK</h4>
    @endisset
</div>
    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST"
                          action="{{ isset($toolbox_talk) ? route('toolboxTalk.update', $toolbox_talk->id) : route('toolboxTalk.store')}}"
                    >
                        @csrf

                        @if(isset($toolbox_talk))
                            @method('put')
                        @else
                            @method('post')
                        @endif

                        <input type="hidden" name="id" value="{{ $toolbox_talk->id ?? '' }}">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="talk_title" class="form-label">Title <span class="text-danger"
                                                                                      title="Required field">*</span></label>
                                    <input value="{{  $toolbox_talk->talk_title ?? old('talk_title') }}"
                                           type="text" id="talk_title" name="talk_title"
                                           class="form-control  @error('talk_title') is-invalid @enderror"
                                           placeholder="Enter title"
                                           required
                                    >
                                    @error('talk_title')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type <span class="text-danger"
                                                                                    title="Required field">*</span></label>
                                    <select name="type"
                                            class="form-select  @error('type') is-invalid @enderror"
                                            id="_type"
                                            required
                                    >
                                        @foreach($types as $key => $type)
                                            <option
                                                {{(isset($toolbox_talk) ? ($toolbox_talk->status == $key ? 'selected' : '') : '' ) ?? (old(status) == $key ? 'selected': '' ) }} value="{{$key}}">{{$type}}
                                            </option>

                                        @endforeach
                                    </select>
                                    @error('type')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('toolboxTalk')}}" type="submit"
                                   class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                @isset($toolbox_talk)
                                    <button type="submit" class="btn _btn-primary float-end">UPDATE TOOLBOX TALK</button>
                                @else
                                    <button type="submit" class="btn _btn-primary float-end">ADD TOOLBOX TALK</button>
                                @endisset

                            </div>
                        </div>
                    </form>


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->


    @isset($toolbox_talk)
        <h4 class="page-title">TOOLBOX TALK ITEMS</h4>
        <div class="row">
            <div class="col-12">
                <div class="card _shadow-1">
                    <div class="card-body">

                        <form method="POST" action="{{route('toolboxTalk.storeToolboxTalkItems', $toolbox_talk->id)}}">
                            @csrf
                            <div class="form">
                                <div class="" id="toolbox_talk_items_input_fields_container">
                                    <div class="form-group">
                                        <input value=""
                                               type="text"
                                               name="toolbox_talk_items[]"
                                               class="form-control my-1"
                                               placeholder="Title"
                                               id="first"
                                               required
                                        >
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="btn _btn-primary me-1" id="add_more_button">Add
                                    </button>
                                    <button type="submit" class="btn _btn-primary float-end">Save Items
                                    </button>
                                </div>
                            </div>

                        </form>


                        <div class="mt-3">
                            <table id="toolbox-talk-items-datatable"
                                   class="table table-bordered dt-responsive nowrap w-100 mt-2">
                                <thead>
                                <tr>
                                    <th style="width: 100px">ID</th>
                                    <th>TITLE</th>
                                    <th style="width: 100px">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal editItemModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
            <form action="{{route('toolboxTalk.item.update')}}" method="POST">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Item</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="hidId" id="hidId" value="">
                    <div class="form-group">
                        <input type="text" name="item_name" id="item_name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn _btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary modelClose" data-dismiss="modal">Close</button>
                </div>
                </div>
            </form>
            </div>
          </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).on('click','.modelClose', function(){
                $('.editItemModal').modal('hide');
                $('#hidId').val('');
                $('#item_name').val('');
            });
            $(document).on('click','.edit-items', function(){
                $('.editItemModal').modal('show');
                var id = $(this).attr('data-id');
                var text = $(this).parent().parent().find("td:eq(1)").text();
                if(text.trim() != ""){
                    $('#hidId').val(id);
                    $('#item_name').val(text);
                }else{
                    $('#hidId').val('');
                    $('#item_name').val('');
                $('.editItemModal').modal('hide');
                }
                console.log(text);
            });
            const inputFieldHtml = `<div class="form-group d-flex justify-content-end" id="doucment_lookup_field_%id%">
                                    <input value=""
                                           type="text" name="toolbox_talk_items[]"
                                           class="form-control my-1"
                                           placeholder="Title"
                                           required
                                    >
                                    <button type="button" onclick="removeField('doucment_lookup_field_%id%')" class="btn btn-sm btn-danger mt-1 ml-1 py-1 remove_document_lookup_button" style="height: 36px">Remove</button></div>`;

            const addMoreButton = document.getElementById('add_more_button');
            const documentLookupInputFieldsContainer = document.getElementById('toolbox_talk_items_input_fields_container');

            addMoreButton.addEventListener('click', (e) => {
                documentLookupInputFieldsContainer.insertAdjacentHTML('beforeend', inputFieldHtml.replaceAll('%id%', Date.now));
            });

            const removeField = (id) => {
                document.getElementById(id).remove();
            }

        </script>

    @endif

@endsection