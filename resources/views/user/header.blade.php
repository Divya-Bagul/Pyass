<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pyass - Packaged Drinking Water -saigoga.com </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('usertheme/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('usertheme/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('usertheme/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('usertheme/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('usertheme/css/style.css')}}" rel="stylesheet">


    
</head>

<div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
    </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
       
            <nav class="navbar navbar-expand-lg  bg-dark ">
                <a href="{{url('user')}}" class="navbar-brand p-0">
                    <h1 class=" m-0" style="color:#e1dcd4;"><i class="fa fa-bottel me-3"></i>PYAAS</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse ml-4" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-7 me-5">
                    <a href="{{url('user')}}" class="nav-item nav-link {{ request()->is('user') ? 'active' : ''}}">Home</a>
                    <a href="{{url('Ledger')}}" class="nav-item nav-link  {{ request()->is('Ledger') ? 'active' : ''}}">Ledger</a>
                    
                    <ul class="navbar-nav ml-auto">
                {{-- Authentication Links --}}
                @guest
               

                    <li><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">{{ trans('titles.login') }}</a></li>
                    @if (Route::has('register'))
                        <li><a class="nav-link" href="{{ route('register') }}" data-bs-toggle="modal" data-bs-target="#exampleModalregister">{{ trans('titles.register') }}</a></li>
                    @endif
                @else
                <li>
                <a href="{{url('buy')}}" class="nav-item nav-link {{ request()->is('buy') ? 'active' : ''}}">Generate Invoice</a>
                </li>
                    <li class="nav-item dropdown  pe-3">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                            @else
                                <div class="user-avatar-nav"></div>
                            @endif
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}" href="{{ url('/profile/'.Auth::user()->name) }}">
                                {!! trans('titles.profile') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            @if(Auth::user()->isAdmin())
                            <a class="dropdown-item {{ Request::is('dashboard/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}" href="{{ url('dashboard') }}">
                               Dashboard
                            </a>
                            <div class="dropdown-divider"></div>
                            @endif
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        
                       
                           
                        
                    </li>
                   
                @endguest
            </ul>
                       
                    </div>
                    
                </div>
            </nav>

            
       
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                        <label for="email" class=" col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                
                                <input id="email" type="text"  placeholder="Enter Email Id" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <br>
                        <div class="form-group row">
                        <label for="password" class=" col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6 ">

                                <input id="password" type="password" placeholder="Enter Your Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            <br>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn " style="background:#FEA116 !important;">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ url('forget-password') }}">
                                    {{ __('auth.forgot') }}
                                </a>
                            </div>
                        </div>

                        

                    </form>
      </div>
      
    </div>
  </div>
</div>



<div class="modal fade" id="exampleModalregister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
     
      <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row ">
                           
 
                            <div class="col-md-6  ">
                                 <label for="name" class=" col-form-label text-md-right">{{ __('Username') }}</label>
                                 <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter UserName">

                                 @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                        
                            <div class="col-md-6 ">
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

                        
                            <div class="col-md-6 ">
                                <label for="last_name" class=" col-form-label text-md-right">{{ __('Last Name') }}</label>
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus placeholder="Enter Last Name">

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 ">
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

                            <div class="col-md-6  ">
                                <label for="number" class=" col-form-label text-md-right"> Phone no.</label>
                                <input id="number" type="number" class="form-control{{ $errors->has('phoneno') ? ' is-invalid' : '' }}" name="phoneno" value="{{ old('phoneno') }}" required placeholder="Enter Your Phone number">

                                @if ($errors->has('phoneno'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phoneno') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 ">
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

                            <div class="col-md-6   ">
                                <label for="due" class=" col-form-label text-md-right">Due</label>

                                <input id="number" type="number" class="form-control{{ $errors->has('due') ? ' is-invalid' : '' }}" name="due" value="{{ old('due') }}" required placeholder="Enter Your Due">

                                @if ($errors->has('due'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('due') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 ">
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

                            <div class="col-md-6 ">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Enter Your Password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 ">
                                <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                
                                
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Enter Confirm Password">
                            </div>
                        </div>

                       

                        


                        <br>
                        <br>

                        <div class="form-group row mb-4 ">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn"  style="background:#FEA116 !important;">
                                    {{ __('Register') }} 
                                </button>
                            </div>
                        </div>

                        

                    </form>
      </div>
      
    </div>
  </div>
</div>