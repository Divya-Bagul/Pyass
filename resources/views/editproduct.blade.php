@extends('layouts.app')
@section('content')




<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                 @if(Session::get('msg'))
                <div class="alert alert-success " role="alert">
                    
                        <h4>{{Session::get('msg')}}</h3>
                        </div> 
               @endif
                <div class="card-header bg-success">
                    <div style="display: flex; justify-content: space-between; align-items: center;" >
                            Add product
                            <div class="float-right ">
                            <a href="{{url('showproduct')}}" class="btn btn-dark mb-1" > show Products</a>

                </div>
                    </div>
                </div> 
                @foreach($products as $product)
                <div class="card-body">
                    <form method="POST" action="{{url('update')}}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group row">
                            <label for="product_name" class="col-sm-3 col-form-label">Product Name</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="name" name="name" value="{{$product->product_name}}" placeholder="Enter Product Name"  value="{{old('p_name')}}"/>
                            <input type="text" class="form-control" name="id" hidden value="{{$product->product_id}}" placeholder="Enter Product Name"  value="{{old('p_name')}}"/>
                           
                                
                            </div>
                             <span class="text-danger offset-3">@error('name'){{$message}}@enderror</span>
                        </div> 
                        <div class="form-group row">
                            <label for="product_name" class="col-sm-3 col-form-label">Product Name</label>
                            <div class="col-sm-7">
                            <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}" placeholder="Enter Product Name"  value="{{old('pprice')}}"/>
                                                      
                            </div>
                          
                        </div> 
                        <div class="form-group row justify-item-center">
                              <div class="col-6 offset-sm-5">
                                    <button class="btn btn-success">Edit Product</button>
                              </div>
                        </div>
                                 
                    </form>
                    
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection