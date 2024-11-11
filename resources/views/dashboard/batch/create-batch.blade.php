@extends('layouts.dashboard.app')

@section('content')
<div class="d-flex align-items-center">
    <a href="{{route('batch')}}">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mdi mdi-menu cliclef mr-3">
        <rect width="32" height="32" rx="16" fill="#E2E8ED" />
        <path
            d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
            fill="black" />
    </svg>
    </a>
    @isset($batch)
        <h4 class="page-title">UPDATE BATCH</h4>
    @else
        <h4 class="page-title">NEW BATCH</h4>
    @endisset
</div>
    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST"
                          action="{{ isset($batch) ? route('batch.update') : route('batch.store')}}"
                    >
                        @csrf
                        <input type="hidden" name="id" value="{{ $batch->id ?? '' }}">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="our_ref" class="form-label">Our Ref <span class="text-danger"
                                                                                          title="Required field">*</span></label>
                                    <input value="{{  $batch->our_ref ?? old('our_ref') }}"
                                           type="text" id="our_ref" name="our_ref"
                                           class="form-control  @error('our_ref') is-invalid @enderror"
                                           placeholder="Enter your ref"
                                           required
                                    >
                                    @error('our_ref')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- @if($leadBatchExists == true && isset($batch) && $batch->scheme->scheme == "Leads")
                                        {{ dd($leadBatchExists,1) }}

                                        @elseif($leadBatchExists == true && isset($batch) && $batch->scheme->scheme != "Leads")
                                        {{ dd($leadBatchExists,2) }}

                                        @elseif($leadBatchExists != true && isset($batch) && $batch->scheme->scheme == "Leads")
                                        {{ dd($leadBatchExists,3) }}

                                        @elseif($leadBatchExists != true)
                                        {{ dd($leadBatchExists,4) }}

                                        @elseif($leadBatchExists == true)
                                        {{ dd($leadBatchExists,5) }}

                                        @else
                                        {{ dd($leadBatchExists,6) }}

                                        @endif --}}

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="scheme_id" class="form-label">Scheme <span class="text-danger"
                                                                                           title="Required field">*</span></label>
                                    <select name="scheme_id"
                                            class="form-select  @error('scheme') is-invalid @enderror"
                                            id="scheme"
                                            required
                                    >
                                        @if($leadBatchExists == true && isset($batch) && $batch->scheme->scheme == "Leads")
                                            @foreach($schemes as $scheme)
                                                <option
                                                    {{(isset($batch) ? ($batch->scheme_id == $scheme->id ? 'selected' : '') : '' ) ?? (old(scheme_id) == $scheme->id ? 'selected': '' ) }} value="{{$scheme->id }}">{{$scheme->scheme}}
                                                </option>
                                            @endforeach
                                        @elseif($leadBatchExists == true && isset($batch) && $batch->scheme->scheme != "Leads")
                                            @foreach($schemes as $scheme)
                                                @if($scheme->scheme != "Leads")
                                                    <option
                                                        {{(isset($batch) ? ($batch->scheme_id == $scheme->id ? 'selected' : '') : '' ) ?? (old(scheme_id) == $scheme->id ? 'selected': '' ) }} value="{{$scheme->id }}">{{$scheme->scheme}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @elseif($leadBatchExists != true && isset($batch) && $batch->scheme->scheme == "Leads")
                                            @foreach($schemes as $scheme)
                                                <option
                                                    {{(isset($batch) ? ($batch->scheme_id == $scheme->id ? 'selected' : '') : '' ) ?? (old(scheme_id) == $scheme->id ? 'selected': '' ) }} value="{{$scheme->id }}">{{$scheme->scheme}}
                                                </option>
                                            @endforeach
                                        @elseif($leadBatchExists != true)
                                            @foreach($schemes as $scheme)
                                                <option
                                                    {{(isset($batch) ? ($batch->scheme_id == $scheme->id ? 'selected' : '') : '' ) ?? (old(scheme_id) == $scheme->id ? 'selected': '' ) }} value="{{$scheme->id }}">{{$scheme->scheme}}
                                                </option>
                                            @endforeach
                                        @elseif($leadBatchExists == true)
                                            @foreach($schemes as $scheme)
                                                @if($scheme->scheme != "Leads")
                                                    <option
                                                        {{(isset($batch) ? ($batch->scheme_id == $scheme->id ? 'selected' : '') : '' ) ?? (old(scheme_id) == $scheme->id ? 'selected': '' ) }} value="{{$scheme->id }}">{{$scheme->scheme}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('scheme')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="quote" class="form-label">Quote <span class="text-danger"
                                                                                      title="Required field">*</span></label>
                                    <select name="quote"
                                            class="form-select  @error('quote') is-invalid @enderror"
                                            id="quote"
                                            required
                                    >
                                        @foreach($quote_types as $quote_type)
                                            <option
                                                {{ ( isset($batch) ? ($batch->quote == $quote_type ? 'selected' : '') : '' ) ?? (old(quote_type) == $quote_type ? 'selected': '' ) }} value="{{$quote_type}}">{{$quote_type}}</option>
                                        @endforeach
                                    </select>
                                    @error('quote')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="invoice" class="form-label">Invoice <span class="text-danger"
                                                                                          title="Required field">*</span></label>
                                    <select name="invoice"
                                            class="form-select  @error('invoice') is-invalid @enderror"
                                            id="invoice"
                                            required
                                    >
                                        @foreach($invoice_types as $key => $invoice_type)
                                            <option
                                                {{(isset($batch) ? ($batch->invoice == $key ? 'selected' : '') : '' ) ?? (old(invoice) == $key ? 'selected': '' ) }} value="{{$key}}">{{$invoice_type}}
                                            </option>

                                        @endforeach
                                    </select>
                                    @error('invoice')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date <span class="text-danger"
                                                                                                title="Required field">*</span></label>
                                    <input value="{{  $batch->start_date ?? old('start_date') }}"
                                           type="date" id="start_date" name="start_date"
                                           class="form-control  @error('start_date') is-invalid @enderror"
                                           placeholder="Enter start date"
                                           required
                                    >
                                    @error('start_date')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date <span class="text-danger"
                                                                                            title="Required field">*</span></label>
                                    <input value="{{  $batch->end_date ?? old('end_date') }}"
                                           type="date" id="end_date" name="end_date"
                                           class="form-control  @error('end_date') is-invalid @enderror"
                                           placeholder="Enter end date"
                                           required
                                    >
                                    @error('end_date')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                        </div>



                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger"
                                                                                        title="Required field">*</span></label>
                                    <select name="status"
                                            class="form-select  @error('status') is-invalid @enderror"
                                            id="batch_status"
                                            required
                                    >
                                        <option
                                            {{(isset($batch) ? ($batch->status == 'pending' ? 'selected' : '') : '' ) ?? (old(status) == 'pending' ? 'selected': '' ) }}
                                            value="pending">
                                            Pending
                                        </option>
                                        <option
                                            {{(isset($batch) ? ($batch->status == 'completed' ? 'selected' : '') : '' ) ?? (old(status) == 'completed' ? 'selected': '' ) }}
                                            value="completed">
                                            Completed
                                        </option>
                                    </select>

                                    @error('status')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control  @error('notes') is-invalid @enderror" name="notes"
                                              id="notes"
                                              rows="6">{{  $batch->notes ?? old('notes') }}</textarea>


                                    @error('notes')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>





                        {{--                        <div class="row">--}}
                        {{--                            <div class="col-lg-6">--}}
                        {{--                                <div class="mb-3">--}}
                        {{--                                    <label for="invoice" class="form-label">Invoice</label>--}}
                        {{--                                    <select name="invoice"--}}
                        {{--                                            class="form-select  @error('invoice') is-invalid @enderror"--}}
                        {{--                                            id="invoice"--}}
                        {{--                                            required--}}
                        {{--                                    >--}}
                        {{--                                        @foreach($invoice_types as $key => $invoice)--}}
                        {{--                                            <option--}}
                        {{--                                                {{ ( isset($batch) ? ($batch->invoice == $key ? 'selected' : '') : '' ) ?? (old(invoice) == $key ? 'selected': '' ) }} value="{{$key}}">{{$invoice}}</option>--}}
                        {{--                                        @endforeach--}}
                        {{--                                    </select>--}}
                        {{--                                    @error('invoice')--}}
                        {{--                                    <span class="text-danger" role="alert">--}}
                        {{--                                        <strong>{{ $message }}</strong>--}}
                        {{--                                    </span>--}}
                        {{--                                    @enderror--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('batch')}}" type="submit"
                                   class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                @isset($batch)
                                    <button type="submit" class="btn _btn-primary float-end">UPDATE BATCH</button>
                                @else
                                    <button type="submit" class="btn _btn-primary float-end">ADD BATCH</button>
                                @endisset

                            </div>
                        </div>
                    </form>


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
