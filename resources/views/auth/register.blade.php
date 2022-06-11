<style>
.form-floating>.form-control, .form-floating>.form-select{
    height: calc(3.5rem + 2px);
    padding: 1rem 0.75rem;
}
/* .form-floating {
    position: relative;
} */


/* .form-floating>label {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    padding: 1rem 0.75rem;
    pointer-events: none;
    border: 1px solid transparent;
    transform-origin: 0 0;
    transition: opacity 0.1s ease-in-out,transform 0.1s ease-in-out;
}
.label {
     display: inline-block; 
}
.form-floating {
    position: relative;
} */


</style>
@extends('layouts.masteradmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center display-5 " style="background:#FEA116 !important;">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row ">
                           
 
                            <div class="col-md-6  form-floating">
                                 <label for="name" class=" col-form-label text-md-right">{{ __('Username') }}</label>
                                 <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter UserName">

                                 @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                        
                            <div class="col-md-6 form-floating">
                            <label for="first_name" class=" col-form-label text-md-right">{{ __('First Name') }}</label>
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus placeholder="Enter Frist Name">

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">

                        
                            <div class="col-md-6 form-floating">
                                <label for="last_name" class=" col-form-label text-md-right">{{ __('Last Name') }}</label>
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus placeholder="Enter Last Name">

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-floating">
                                <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Enter Email Id">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group row">

                            <div class="col-md-6 form-floating ">
                                <label for="number" class=" col-form-label text-md-right"> Phone no.</label>
                                <input id="number" type="number" class="form-control{{ $errors->has('phoneno') ? ' is-invalid' : '' }}" name="phoneno" value="{{ old('phoneno') }}" required placeholder="Enter Your Phone number">

                                @if ($errors->has('phoneno'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phoneno') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-floating">
                                 <label for="balaance" class=" col-form-label text-md-right">Balance</label>
                                
                                <input id="number" type="number" class="form-control{{ $errors->has('balance') ? ' is-invalid' : '' }}" name="balance" value="{{ old('balance') }}" required placeholder="Enter Your Balance">

                                @if ($errors->has('balance'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('balance') }}</strong>
                                    </span>
                                @endif
                            </div>


                        </div>
                     
                        <div class="form-group row">

                            <div class="col-md-6  form-floating ">
                                <label for="due" class=" col-form-label text-md-right">Due</label>

                                <input id="number" type="number" class="form-control{{ $errors->has('due') ? ' is-invalid' : '' }}" name="due" value="{{ old('due') }}" required placeholder="Enter Your Due">

                                @if ($errors->has('due'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('due') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-floating">
                                <label for="address" class="col-form-label text-md-right">Address</label>

                                <textarea  class="form-control{{ $errors->has('due') ? ' is-invalid' : '' }}" name="address" value="{{ old('due') }}" rows="3"  required  placeholder="Enter Your Address"></textarea>

                                @if ($errors->has('due'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('due') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                     

                        <div class="form-group row">

                            <div class="col-md-6 form-floating">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Enter Your Password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-floating">
                                <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                
                                
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Enter Confirm Password">
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6">
                                <!-- <label for="shopkeeepar" class="col-form-label text-md-right"></label> -->

                                shopkeeepar<input id="shopkeepar" type="radio" value="shopkeepar" name="usertype" >
                                User<input id="user" type="radio"  value="user"  name="usertype" >

                    
                            </div>

                            <div class="col-md-6 form-floating" id="shopname"style="display:none;">
                                <label  class="col-form-label text-md-right">ShopName</label>
                                
                                
                                <input  type="text" class="form-control" name="shopname" required placeholder="Enter Confirm Password">
                            </div>
                        </div>

                        


                        {{-- @if(config('settings.reCaptchStatus'))
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4">
                                    <div class="g-recaptcha" data-sitekey="{{ config('settings.reCaptchSite') }}"></div>
                                </div>
                            </div>
                        @endif --}}

                        <div class="form-group row mb-4">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn"  style="background:#FEA116 !important;">
                                    {{ __('Register') }} 
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                                <p class="text-center mb-4">
                                    Or Use Social Logins to Register
                                </p>
                                @include('partials.socials')
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
    @if(config('settings.reCaptchStatus'))
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    {{-- toastr js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
 
 $(document).ready(function(){
    $('#shopname').hide();
    $("input[id='shopkeepar']").change(function(){
       
        $('#shopname').css({"display": "block"});
    });
    $("input[id='user']").change(function(){
        
        $('#shopname').css({"display": "none"});
    });

  
    


});

</script>