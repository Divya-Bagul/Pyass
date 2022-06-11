
@extends('partials.admin.sidebar')

@section('admin_content') 
    
 

   
    

<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          
            <ul class="navbar-nav ">
                    {{-- Authentication Links --}}
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ trans('titles.login') }}</a></li>
                        @if (Route::has('register'))
                            <li><a class="nav-link" href="{{ route('register') }}">{{ trans('titles.register') }}</a></li>
                        @endif
                    @else


                <li>Welcome  {{ Auth::user()->name }}</li>
                    <li><a class="dropdown-item  {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }} " href="{{ url('/profile/'.Auth::user()->name) }}">
                                    {!! trans('titles.profile') !!}
                                </a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                    </li>
                       
                               
                    
                    @endguest
                </ul>
        </div>
    </div>
</nav>
<br>


@yield('content') 
@endsection
