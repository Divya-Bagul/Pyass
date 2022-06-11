<title>@hasSection('template_title')@yield('template_title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
@include('user.header')
{{-- @section('header') --}}

  @yield('main_content') 

   @include('user.footer')
{{-- @endsection --}}

