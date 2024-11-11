<div class="row">
    @if(Auth::user()->role == 'admin')
        <div class="form-group mb-2">
            <label for="select_type" class="mr-1">User Type</label>
            <select class="form-control" name="select_type" id="select_type" required>
                <option value=""></option>
                <option value="contractor">Contractor</option>
                <option value="accessor">HEA/BER Assessors</option>
            </select>
        </div>
    @endif

    @if(Auth::user()->role == 'contractor' || Auth::user()->role == 'hea/ber-assessor')
        <div class="form-group mb-2">
            <label for="to_user" class="mr-1">Admin</label>
            <select class="form-control" name="to_user" id="to_user" required>
                <option value=""></option>
                @foreach($admins as $admin)
                    <option value="{{$admin->id}}">{{$admin->firstname}} {{$admin->lastname}}</option>
                @endforeach
            </select>
        </div>
    @endif
    
    @if(Auth::user()->role == 'admin')
    <div class="form-group mb-2 d-none" id="admin-user-select">
        <label for="to_user" class="mr-1"></label>
        <select class="form-control" name="to_user" id="to_user" required>
            <option value=""></option>
            
            @foreach($contractors as $contractor)
                <option user_type = "contractor" value="{{$contractor->id}}">{{$contractor->firstname}} {{$contractor->lastname}}</option>
            @endforeach
          

            @foreach($accessors as $accessor)
                <option user_type = "accessor" value="{{$accessor->id}}">{{$accessor->firstname}} {{$accessor->lastname}}</option>
            @endforeach
           
        </select>
    </div>
    @endif


    <div class="form-group">
        <label for="content" class="mr-1">Message</label>
        <textarea rows="2" class="form-control" id="content" name="content" required placeholder="Enter a message"></textarea>
    </div>
    <input type="hidden" name="from_user" id="from_user" value=" {{ auth()->user()->id }}">
</div>
