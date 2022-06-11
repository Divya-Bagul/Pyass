
@extends('user.main')

@section('template_title')
    {{ $user->name }}'s Profile
@endsection

@section('template_fastload_css')
    #map-canvas{
        min-height: 300px;
        height: 100%;
        width: 100%;
    }
@endsection

@php
    $currentUser = Auth::user()
@endphp


@section('main_content')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-3 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-12 text-center ">
                            <p class="display-6 text-white animated slideInLeft">Hey Your Profile is Here!!!!</p>
                        </div>
                        
                    </div>
                </div>
            </div>



            @include('sweetalert::alert')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-0">
                    <div class="card-body p-0">
                        @if ($user->profile)
                            @if (Auth::user()->id == $user->id)
                            <div class="container">
                                <div class="row">
                               
                               <h2> Edit Profile</h2>
                                    <div class="col-lg-12 col-sm-8 col-md-9">
                                        
                                    <form action="{{url('updateuser')}}" method="POST">
                                        @csrf
                                        <input type="text" hidden  name="id" value="{{$user->id}}">
                                        <div  class="row g-3">
                                            
                                           
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                 
                                                <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" placeholder="Enter First Name">
                                                <label>First Name</label>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                <input type="text"  class="form-control" name="last_name" value="{{$user->last_name}}"  placeholder="Enter Last Name">
                                                <label>Last Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                <input type="email"  class="form-control" name="email" placeholder="Enter Your Due" value="{{$user->email}}">
                                                <label>First Due</label>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                <input type="number" class="form-control" name="mobile" value="{{$user->mobile}}" placeholder="Enter Mobile Number">
                                                <label>Phone No.</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                <textarea class="form-control" name="address" placeholder="Enter Your Address">{{$user->address}}</textarea>
                                                <label>Enter Address</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                <input type="text"  class="form-control" name="balance" placeholder="Enter Your Balance" value="{{$user->balance}}">
                                                <label>Enter balance</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                <input type="text"  class="form-control" name="due" placeholder="Enter Your Due" value="{{$user->due}}">
                                                <label>First Due</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 ">
                                        <input type="submit" class="offset-5 mt-2 btn btn-primary" value="update profile">
                                      </div> <br>
                                      @if(Session::get('msg'))
                                       <h5 class="alert alert-success"> {{Session::get('msg')}}</h5>
                                        @endif
                                                                
                                    </form>                                 
                                </div>
                            </div>
                            @else
                                <p>{{ trans('profile.notYourProfile') }}</p>
                            @endif
                        @else
                            <p>{{ trans('profile.noProfileYet') }}</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @include('modals.modal-form')

@endsection

@section('footer_scripts')

    @include('scripts.form-modal-script')

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.gmaps-address-lookup-api3')
    @endif

    @include('scripts.user-avatar-dz')

    <script type="text/javascript">

        $('.dropdown-menu li a').click(function() {
            $('.dropdown-menu li').removeClass('active');
        });

        $('.profile-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-default');
        });

        $('.settings-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-info');
        });

        $('.admin-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-warning');
            $('.edit_account .nav-pills li, .edit_account .tab-pane').removeClass('active');
            $('#changepw')
                .addClass('active')
                .addClass('in');
            $('.change-pw').addClass('active');
        });

        $('.warning-pill-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-warning');
        });

        $('.danger-pill-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-danger');
        });

        $('#user_basics_form').on('keyup change', 'input, select, textarea', function(){
            $('#account_save_trigger').attr('disabled', false).removeClass('disabled').show();
        });

        $('#user_profile_form').on('keyup change', 'input, select, textarea', function(){
            $('#confirmFormSave').attr('disabled', false).removeClass('disabled').show();
        });

        $('#checkConfirmDelete').change(function() {
            var submitDelete = $('#delete_account_trigger');
            var self = $(this);

            if (self.is(':checked')) {
                submitDelete.attr('disabled', false);
            }
            else {
                submitDelete.attr('disabled', true);
            }
        });

        $("#password_confirmation").keyup(function() {
            checkPasswordMatch();
        });

        $("#password, #password_confirmation").keyup(function() {
            enableSubmitPWCheck();
        });

        $('#password, #password_confirmation').hidePassword(true);

        $('#password').password({
            shortPass: 'The password is too short',
            badPass: 'Weak - Try combining letters & numbers',
            goodPass: 'Medium - Try using special charecters',
            strongPass: 'Strong password',
            containsUsername: 'The password contains the username',
            enterPass: false,
            showPercent: false,
            showText: true,
            animate: true,
            animateSpeed: 50,
            username: false, // select the username field (selector or jQuery instance) for better password checks
            usernamePartialMatch: true,
            minimumLength: 6
        });

        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#password_confirmation").val();
            if (password != confirmPassword) {
                $("#pw_status").html("Passwords do not match!");
            }
            else {
                $("#pw_status").html("Passwords match.");
            }
        }

        function enableSubmitPWCheck() {
            var password = $("#password").val();
            var confirmPassword = $("#password_confirmation").val();
            var submitChange = $('#pw_save_trigger');
            if (password != confirmPassword) {
                submitChange.attr('disabled', true);
            }
            else {
                submitChange.attr('disabled', false);
            }
        }

    </script>

@endsection
