@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-4 col-6">

            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>
                        <?php
                        $user = Auth::user()->id;
                        $data = DB::table('users')->get();
                        echo count($data);
                    ?> </h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class=" fa fa-users"></i>
                </div>
                <a href="{{url('users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

         <div class="col-lg-4 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>
                <?php
                        $user = Auth::user()->id;
                        $data = DB::table('orders')->get();
                        echo count($data);
                    ?> </h3>
                    <p>Total Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{url('getform')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>  
</div>





@endsection