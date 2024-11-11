@extends('layouts.dashboard.app')
<style>
   .color-scheme-picker {
  
  .selected-color-scheme {
    display: inline-block;
    width: 95%;
    margin-right: 2%;
    height:35px;
  }
  
  .color-scheme-panel {
    width: 100%;
    
    .color-block { display: block; }
  }
}
button.dropdown-toggle{
    border: 1px solid #e7e7e7;
    padding: 0px !important;
}
.color-block{
    height: 30px;
}
.dropdown-toggle::after{
    vertical-align: -4px !important;
}
div.mm-dropdown {
  border: 1px solid #ddd;
  width: 100%;
  border-radius: 3px;
}

div.mm-dropdown ul {
  list-style: none;
  padding: 0;
  margin: 0;
  border: 0;
}

div.mm-dropdown ul li,
div.mm-dropdown div.textfirst {
  padding: 0;
  color: #333;
  border-bottom: 1px solid #ddd;
  padding: 5px 15px;
}

div.mm-dropdown div.textfirst img.down {
  float: right;
  margin-top: 5px
}

div.mm-dropdown ul li:last-child {
  border-bottom: 0;
}

div.mm-dropdown ul li {
  display: none;
  padding-left: 25px;
}

div.mm-dropdown ul li.main {
  display: block;
}

div.mm-dropdown ul li img {
  width: 20px;
  height: 20px;
}
</style>
@section('content')
<div class="d-flex align-items-center">
    <a href="{{ route('lookup.scheme') }}">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mdi mdi-menu cliclef mr-3">
        <rect width="32" height="32" rx="16" fill="#E2E8ED" />
        <path
        d="M17.5287 20.4712L13.286 16.2286C13.0257 15.9683 13.0257 15.5461 13.286 15.2858L17.5287 11.0432C17.789 10.7828 18.2111 10.7828 18.4715 11.0432C18.7318 11.3035 18.7318 11.7256 18.4715 11.986L15.3669 15.0905L14.7572 15.7572L15.3669 16.4239L18.4715 19.5284C18.7318 19.7888 18.7318 20.2109 18.4715 20.4712C18.2111 20.7316 17.789 20.7316 17.5287 20.4712Z"
        fill="black" />
    </svg>
</a>
@isset($scheme)
<h4 class="page-title">UPDATE SCHEME</h4>
@else
<h4 class="page-title">NEW SCHEME</h4>
@endisset
</div>
<div class="row">
    <div class="col-12">
        <div class="card _shadow-1">
            <div class="card-body">
                <form method="POST" id="scheme-form"
                action="{{ isset($scheme) ? route('lookup.scheme.update', $scheme->id) : route('lookup.scheme.save') }}">
                @csrf
                
                @if (isset($scheme))
                @method('put')
                @else
                @method('post')
                @endif
                
                <input type="hidden" name="id" value="{{ $scheme->id ?? '' }}">
                <div class="row">
                    
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Scheme <span class="text-danger"
                                title="Required field">*</span></label>
                                <input value="{{ $scheme->scheme ?? old('scheme') }}" type="text" id="scheme"
                                name="scheme" class="form-control  @error('scheme') is-invalid @enderror"
                                placeholder="Enter scheme" required>
                                @error('scheme')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Status <span class="text-danger"
                                    title="Required field">*</span></label>
                                    <select name="is_active" class="form-select  @error('status') is-invalid @enderror"
                                    id="_status" required>
                                    <option
                                    {{ (isset($scheme) ? ($scheme->is_active == 1 ? 'selected' : '') : '') ?? (old(scheme) == 1 ? 'selected' : '') }}
                                    value="1">
                                    Active
                                </option>
                                <option
                                {{ (isset($scheme) ? ($scheme->is_active == 0 ? 'selected' : '') : '') ?? (old(scheme) == 0 ? 'selected' : '') }}
                                value="0">
                                Archive
                            </option>
                        </select>
                        @error('status')
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
                        <label for="type" class="form-label">Color Scheme <span class="text-danger" title="Required field">*</span></label>
                            <div class="dropdown color-scheme-picker">
                                <button class="btn btn-default btn-block dropdown-toggle form-control" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                  <span class="selected-color-scheme" style="background-image: linear-gradient(to right, #F10000, #F10000, #F10000, #F10000, #F10000,#F10000)">&nbsp;</span>
                                  <span class="caret"></span>
                                </button>
                        
                                <ul class="dropdown-menu color-scheme-panel" aria-labelledby="dropdown-color-picker">
                                  <li class="dropdown-header text-uppercase">Choose Color Scheme</li>
                                  <li role="separator" class="divider"></li>
                                  <li class="color-scheme" data-attr="#F10000">
                                    <a href="#" data-type="3-colors">
                                      <span class="color-block" style="background-image: linear-gradient(to right, #F10000, #F10000, #F10000, #F10000, #F10000,#F10000)">&nbsp;</span>
                                    </a>
                                  </li>
                                  <li role="separator" class="divider"></li>
                                  <li class="color-scheme" data-attr="#1A47A3">
                                    <a href="#" data-type="2-colors">
                                      <span class="color-block" style="background-image: linear-gradient(to right, #1A47A3, #1A47A3, #1A47A3, #1A47A3, #1A47A3,#1A47A3)">&nbsp;</span>
                                    </a>
                                  </li>
                                  <li role="separator" class="divider"></li>
                                  <li class="color-scheme" data-attr="#008ADF">
                                    <a href="#" data-type="2-colors">
                                      <span class="color-block" style="background-image: linear-gradient(to right, #008ADF, #008ADF, #008ADF, #008ADF, #008ADF,#008ADF)">&nbsp;</span>
                                    </a>
                                  </li>
                                  <li role="separator" class="divider"></li>
                                  <li class="color-scheme" data-attr="#F2AD00">
                                    <a href="#" data-type="2-colors">
                                      <span class="color-block" style="background-image: linear-gradient(to right, #F2AD00, #F2AD00, #F2AD00, #F2AD00, #F2AD00,#F2AD00)">&nbsp;</span>
                                    </a>
                                  </li>
                                  <li role="separator" class="divider"></li>
                                  <li class="color-scheme" data-attr="#00C49E">
                                    <a href="#" data-type="2-colors">
                                      <span class="color-block" style="background-image: linear-gradient(to right, #00C49E, #00C49E, #00C49E, #00C49E, #00C49E,#00C49E)">&nbsp;</span>
                                    </a>
                                  </li>
                                  <li role="separator" class="divider"></li>
                                  <li class="color-scheme" data-attr="#C200E2">
                                    <a href="#" data-type="2-colors">
                                      <span class="color-block" style="background-image: linear-gradient(to right, #C200E2, #C200E2, #C200E2, #C200E2, #C200E2,#C200E2)">&nbsp;</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                    <input type="hidden" id="clrscheme" name="clrscheme" value="" required />

                        @error('clrscheme')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                    
                    
                <div class="col-lg-6">
                  <label for="type" class="form-label">Logo <span class="text-danger" title="Required field">*</span></label>
                  <div class="mm-dropdown">
                    <div class="textfirst">Select<img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-arrow-down-b-128.png" width="10" height="10" class="down" /></div>
                    <ul>
                      @for($i = 1; $i <= 7; $i++)
                      <li class="input-option" data-value="{{$i}}.svg">
                        <img src="{{asset('assets/images/schemes/'.$i.'.svg')}}"alt="" width="24" height="24" />
                      </li>
                      @endfor
                    </ul>
                    <input type="hidden" class="option" name="namesubmit" value="" required/>
                  </div>  
                  @error('namesubmit')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror      
                </div>
            
        </div>
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('lookup.scheme') }}" type="submit"
                class="btn btn-secondary px-2 float-end ml-1">CANCEL</a>
                @isset($scheme)
                <button type="submit" class="btn _btn-primary float-end">UPDATE SCHEME</button>
                @else
                <button type="submit" class="btn _btn-primary float-end">ADD SCHEME</button>
                @endisset
                
            </div>
        </div>
    </form>
    
    @php
          $jsonScheme = isset($scheme) ?  htmlspecialchars_decode(json_encode($scheme)) : '""';
    @endphp
</div> <!-- end card-body -->
</div> <!-- end card -->
</div><!-- end col -->
</div><!-- end row -->
<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 85px; right: 0;z-index:1;border:unset;">
  <div class="toast-header" style="background-color:#fee5e5;border-bottom:unset;border-radius:8px;">
    <strong class="mr-auto" style="color: #F10000;">Logo Required</strong>
    <button type="button" class="close toast-cls" data-dismiss="toast" aria-label="Close" style="border: unset;background:unset;">
      <span aria-hidden="true" style="font-size: 18px;">&times;</span>
    </button>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
        $('#scheme-form').on('submit',function(){
            var input = $('input[name=namesubmit]').val();
            if(input == '' || input == null){
                $('#liveToast').toast('show');
                return false;
            }
        });
        $(document).on('click','.toast-cls', function() {
            $('#liveToast').toast('hide');
        });
    });
    $(function() {
      var scheme = <?php echo $jsonScheme; ?>;
      if(scheme != ""){
        var selectedColor = scheme.color;
      }else{
        var selectedColor = "";
      }
      
    if (selectedColor !== "") {
      $('#clrscheme').val(selectedColor);
        // Set the background of the selected-color-scheme element
        $('.selected-color-scheme').css('background-image', 'linear-gradient(to right, ' + selectedColor + ', ' + selectedColor + ', ' + selectedColor + ', ' + selectedColor + ', ' + selectedColor + ',' + selectedColor + ')');

        // Find the color-scheme element with the corresponding data-attr value and trigger the click event
        $('.color-scheme[data-attr="' + selectedColor + '"]').click();
    }
  var defaultColorScheme = $('.selected-color-scheme'),
    colorScheme = $('.color-scheme');

  colorScheme.click(function() {
    /**
      When one of the color scheme in the list is clicked, 
      update selected color scheme
    */
   var clr = $(this).attr('data-attr');
    var colorList = $(this),
      colorListAnchor = colorList.children(),
      colorSchemeType = colorListAnchor.attr('data-type'),
      newColorScheme = colorListAnchor.children('.color-block').css('background-image');
      $('#clrscheme').val(clr);
    updateColorScheme(colorSchemeType, newColorScheme);
  });

  var updateColorScheme = function(colorSchemeType, newColorScheme) {
    /**
      Update default color scheme with the new color scheme.
      Return new color scheme type 'colorSchemeType' (data-type=[two-colors|three-colors]) 
      and new color scheme (background-image color).
    */
   
    defaultColorScheme.css('background-image', newColorScheme);
  };
});
$(function() {
  // Set
  var main = $('div.mm-dropdown .textfirst')
  var li = $('div.mm-dropdown > ul > li.input-option')
  var inputoption = $("div.mm-dropdown .option")
  var default_text = 'Select<img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-arrow-down-b-128.png" width="10" height="10" class="down" />';

  // Animation
  main.click(function() {
    main.html(default_text);
    li.toggle('fast');
  });
  function selectOption(option) {
        var livalue = option.data('value');
        var lihtml = option.html();
        main.html(lihtml);
        inputoption.val(livalue);
    }
  // Insert Data
  li.click(function() {
    // hide
    li.toggle('fast');
        selectOption($(this));
  });
  var scheme = <?php echo $jsonScheme; ?>;
  if(scheme != ""){
        var selectedLogo = scheme.logo;
      }else{
        var selectedLogo = "";
      }
    if (selectedLogo !== "") {
  // var selectedLogo = "2.svg"; // Replace with your actual variable
    var preselectedOption = li.filter('[data-value="' + selectedLogo + '"]');
    if (preselectedOption.length) {
        // If the option exists, trigger the click event to preselect it
        selectOption(preselectedOption);
    }
  }
});
</script>
@endsection
