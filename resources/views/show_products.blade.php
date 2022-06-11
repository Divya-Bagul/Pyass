@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="card col-12">
            <div class="card-header bg-success">
                Show Prducts
                <div class="float-right ">
                    <a href="{{url('product')}}" class="btn btn-dark mb-1" > Add Products</a>

                </div>
              
            
            </div>
            <div class="card-body">

               
                   
                
                <div class="float-right"> 
                    <input type="text" name="serach" id="serach" placeholder="Search"  />
                    {{-- <form >
                    @csrf
                   
                    <input type="text" name="search" placeholder="Search" id="search"/>
                    <button type="button" name="submit" id="close" class="  btn btn-sm bg-danger"><i class="fa fa-close" aria-hidden="true"></i></button>
                     </form> --}}
                </div>
                <table class="table text-center table-striped">


                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Product name</th>
                           
                            <th>Price</th>
                            <th>update</th>
                            <th>Delete</th>


                
                        </tr>
                    </thead>
                       <tbody  id="tbody">  
                          
                           
                    @foreach($products as $product)
                 
                        
                
                        <tr>
                          
                            <td>{{$product['product_id']}}</td>
                            <td>   {{$product['product_name']}}  </td>
                            <td>   {{$product['price']}}  </td>
                            <!--<td><a href="{{url('display_product/'.$product['id'])}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true">  </i></a></td>-->
                            <td><a href="{{url('editproduct/'.$product['product_id'])}}"  class="btn btn-primary"><i class="fa fa-pen" aria-hidden="true"> </i></a></td>
                            <td><a href="{{url('delete/'.$product['product_id'])}}"  class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true">  </i></a></td>
                        </tr>
                        @endforeach  
                                             
                    </tbody>

                    <tr>

                        
                </table>
               
            </div>
        </div>
    </div>

</div>







    @endsection