<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- CSRF Token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@hasSection('template_title')@yield('template_title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
  <meta name="description" content="">
  <meta name="author" content="Jeremy Kenedy">
  <link rel="shortcut icon" href="/favicon.ico">



  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
<style>
.main-sidebar{

    overflow-y: auto;
    top: 0;
    bottom: 0;
}
  </style>



<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
    <!-- Brand Logo -->
    <a href="{{url('/buy')}}" class="brand-link">
            <span class="brand-text font-weight-light">Pyass</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      

      <!-- SidebarSearch Form -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                  <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  <a href="{{url('/buy')}}" class="d-block">{{ Auth::user()->name }}</a>
                </div>
              </div>
        </li>
          
            
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('roles') || Request::is('permissions')) ? 'active' : null }}" href="{{ route('laravelroles::roles.index') }}">
              <i class="fas fa-users-cog"></i>  
               {{-- {!! trans('titles.laravelroles') !!}  --}}
              Roles Administration
          </a>
                 
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('/users') }}">
              <i class="fa fa-user" aria-hidden="true"></i>  
               {{-- {!! trans('titles.adminUserList') !!} --}}
               Users Administration
          </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('users/create') ? 'active' : null }}" href="{{ url('/users/create') }}">
              <i class="fa fa-users" aria-hidden="true"></i> 
              Add New Customer
          </a>  
          </li>

          <!-- <li class="nav-item">
            <a class="dropdown-item {{ Request::is('themes','themes/create') ? 'active' : null }}" href="{{ url('/themes') }}">
              {!! trans('titles.adminThemesList') !!}
          </a>    
          </li>
         <li class="nav-item">
            <a class="dropdown-item {{ Request::is('logs') ? 'active' : null }}" href="{{ url('/logs') }}">
              {!! trans('titles.adminLogs') !!}
          </a>
          </li>
          <li class="nav-item">
            <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/activity') }}">
              {!! trans('titles.adminActivity') !!}
          </a>    
          </li> -->
          <!-- <li class="nav-item">
            <a class="dropdown-item {{ Request::is('phpinfo') ? 'active' : null }}" href="{{ url('/phpinfo') }}">
              {!! trans('titles.adminPHP') !!}
          </a>   
          </li>
          <li class="nav-item">
            <a class="dropdown-item {{ Request::is('routes') ? 'active' : null }}" href="{{ url('/routes') }}">
              {!! trans('titles.adminRoutes') !!}
          </a>   
          </li>
          <li class="nav-item">
            <a class="dropdown-item {{ Request::is('active-users') ? 'active' : null }}" href="{{ url('/active-users') }}">
              {!! trans('titles.activeUsers') !!}
          </a>   
          </li>
          <li class="nav-item">
            <a class="dropdown-item {{ Request::is('blocker') ? 'active' : null }}" href="{{ route('laravelblocker::blocker.index') }}">
              {!! trans('titles.laravelBlocker') !!}
          </a>   
          </li>  -->
          <li class="nav-items">
            
            <a href="{{url('showproduct')}}" class="nav-link {{request()->is('showproduct') ?'active':''}}  ">
              <i class="fab fa-product-hunt"></i> Show Products</a>
          
          </li>

          <li class="nav-items">
            
            <a href="{{url('getform')}}" class="nav-link {{request()->is('getform') ?'active':''}}  ">
              <i class="fab fa-cart"></i> Show Orders Form</a>
          
          </li>
          <li class="nav-items">
            
            <a href="{{url('getuserdetails')}}" class="nav-link {{request()->is('getuserdetails') ?'active':''}}  ">
              <i class="fab fa-cart"></i> Show users  Ledger</a>
          
          </li>

          <li class="nav-items">
            
            <a href="{{url('getBilling')}}" class="nav-link {{request()->is('getBilling') ?'active':''}}  ">
              <i class="fab fa-cart"></i> Show users  Bill</a>
          
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>
  <div class="content-wrapper">
@yield('admin_content')

  </div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="{{url('user')}}">Pyass</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('lugins/bootstrap/js/bootstrap.bundle.min.js')}}p"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.j')}}s"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>




</body>
</html>
