@extends('layouts.app')
@section('content')


<div class="container">
<h3 class=" ml-4">Order Details</h3>
<hr>
    <div class="row ml-4 ">
        
        <br>
        @foreach ($products as $item)
                
        @if($loop->first)
        <div class="col-3">

            <p><b>Order ID :</b>{{$item->order_id}}<p>
            <p><b>Customer Name:{{$item->name}}</b>
        </div>

        

        @endif
  @endforeach


</div>
    
    <div class="row ml-4">
<h3>Product Details</h3>
       
            <div class="col-12  ">
                <table class="table table-bordered ">
                    <tr class="bg-dark">
                        <th>Product Name</th>
                        <th>Order Qunatity</th>
                        <th>Product Total Price</th>
                        
                    </tr>
                    @foreach ($productData as $product)
                    <tr>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->p_qty}}</td>
                    <td>{{$product->priceTotal}}</td>
                    </tr>       
                    @endforeach  
                </table>
                
            </div>

            
    </div>

    <div class="row justify-content-end">
        <div class="col-md-12 col-lg-6 mr-2">
        @foreach ($products as $total)
                    @if($loop->first)
            <div class="order-box">
               <h4>Billing</h4>
                   <hr>
                   
                </div>
                <div class="d-flex">
                    <div class="font-weight-bold">Product</div>
                    <div class="ml-auto font-weight-bold">Total</div>
                </div>
                <hr class="my-1">
                <div class="d-flex">
                    <h5>Sub Total</h5>
                   
                    <div class="ml-auto font-weight-bold">{{$total->Total}}</div>
                   
                </div>
               
                <hr class="my-1">
               
              
                <div class="d-flex">
                    <h5>After Credit Payment</h5>
                    <div class="ml-auto font-weight-bold"> {{$total->paidAmount}}</div>
                </div>
                
                <hr>
                <div class="d-flex gr-total">
                    <h5>Grand Total</h5>
                    <div class="ml-auto h5">{{$total->AfterPaidAmount}} </div>
                </div>
                <hr> </div>
        </div>
        @endif
                    @endforeach
    </div>
                             
   
    
</div>


                            





@endsection