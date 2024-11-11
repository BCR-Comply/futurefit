@extends('layouts.dashboard.app')

@section('content')

    @isset($contract)
        <h4 class="page-title">UPDATE ASSIGNMENT</h4>
    @else
        <h4 class="page-title">ASSIGN ASSESSOR</h4>
    @endisset

    <div class="row">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <form method="POST"
                          action="{{ isset($contract) ? route('property.updateAssessor', [
                        'back_url'=> 'property.show']) : route('property.storeAssessor', ['back_url'=> 'property.show'])}}">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property_id }}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="hidden" name="contract_id" value="{{$contract ? $contract->id : ''}}">
                                    <label for="assessor_id" class="form-label">Assessor
                                        <span
                                            class="text-danger"
                                            title="Required field">*</span>
                                    </label>
                                    <select name="assessor_id"
                                            class="form-select  @error('assessor_id') is-invalid @enderror"
                                            id="assessor_id"
                                            required
                                    >
                                        @foreach($assessors as $assessor)
                                            <option
                                                {{ ( isset($contract) ? ($assessor->id == $contract->assessor_id ? 'selected' : '') : '' ) ?? (old(assessor_id) == $assessor->id ? 'selected': '' ) }} value="{{$assessor->id}}">{{$assessor->firstname.' ('.$assessor->email.')'}}</option>

                                        @endforeach
                                    </select>
                                    @error('assessor_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="job_id" class="form-label">Job
                                        <span
                                            class="text-danger"
                                            title="Required field">*</span>
                                    </label>
                                    <select name="job_id"
                                            class="form-select  @error('job_id') is-invalid @enderror"
                                            id="job_id"
                                            required
                                    >
                                        @foreach($assessor_jobs as $id => $job)
                                            <option
                                                {{ ( isset($contract) ? ($id == $contract->job_id ? 'selected' : '') : '' ) ?? (old(job_id) == $id ? 'selected': '' ) }} value="{{$id}}">{{$job['title']}}</option>

                                        @endforeach
                                    </select>
                                    @error('job_id')
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
                                    <label for="start_date" class="form-label">Start Date
                                        <span
                                            class="text-danger"
                                            title="Required field">*</span>
                                    </label>
                                    <input value="{{  $contract->start_date ?? old('start_date') }}"
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
                                    <label for="end_date" class="form-label">End Date
                                        <span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <input value="{{  $contract->end_date ?? old('end_date') }}"
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
                                    <label for="cost" class="form-label">Cost</label>
                                    <input value="{{  ($contract->cost ?? old('cost')) ?? 0 }}"
                                           type="number" step="any" min="0" id="cost" name="cost"
                                           class="form-control  @error('cost') is-invalid @enderror"
                                           placeholder="Enter cost"
                                    >
                                    @error('cost')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="paid" class="form-label">Paid</label>
                                    <input value="{{  ($contract->paid ?? old('paid')) ?? 0 }}"
                                           type="number" step="any" min="0" id="paid" name="paid"
                                           class="form-control  @error('paid') is-invalid @enderror"
                                           placeholder="Enter paid to date amount"
                                    >
                                    @error('paid')
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
                                    <label for="paid" class="form-label">Our Price</label>
                                    <input value="{{  ($contract->our_price ?? old('our_price')) ?? 0 }}"
                                           type="number" step="any" min="0" id="our_price" name="our_price"
                                           class="form-control  @error('our_price') is-invalid @enderror"
                                           placeholder="Enter our price"
                                    >
                                    @error('our_price')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="status" class="form-label">Status<span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <select name="status"
                                            class="form-select  @error('status') is-invalid @enderror"
                                            required>

                                        @foreach($contract_status as $status)
                                            <option
                                                value="{{$status}}" {{isset($contract) ? ($contract->status == $status ? 'selected' : '') : ''}}>
                                                {{$status}}
                                            </option>
                                        @endforeach

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
                                    <textarea
                                        type="text" id="notes" name="notes"
                                        class="form-control  @error('notes') is-invalid @enderror"
                                        placeholder="Enter notes"
                                        rows="5"
                                    >{{  $contract->notes ?? old('notes') }}</textarea>
                                    @error('notes')
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
                                    <label for="surveyor_id" class="form-label">QA Surveyor <span
                                            class="text-danger"
                                            title="Required field">*</span></label>
                                    <select name="surveyor_id"
                                            class="form-select  @error('surveyor_id') is-invalid @enderror"
                                            id="surveyor_id"
                                            required
                                    >
                                        <option value="" selected></option>
                                        @foreach($surveyors as $surveyor)
                                            <option
                                                {{ ( isset($contract) ? ($surveyor->user_id == $contract->surveyor_id ? 'selected' : '') : '' ) ?? (old(surveyor_id) == $surveyor->user_id ? 'selected': '' ) }} value="{{$surveyor->user_id}}">{{$surveyor->full_name.' ('.$surveyor->email.')'}}</option>

                                        @endforeach
                                    </select>
                                    @error('surveyor_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('property.show', \Illuminate\Support\Facades\Crypt::encrypt($property_id))}}"
                                   type="submit"
                                   class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                                @isset($contract)
                                    <button type="submit" class="btn _btn-primary float-end">UPDATE CONTRACT</button>
                                @else
                                    <button type="submit" class="btn _btn-primary float-end">ASSIGN</button>
                                @endisset

                            </div>
                        </div>

                    </form>


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
