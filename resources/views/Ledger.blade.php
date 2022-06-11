@extends('user.main')

@section('template_title')
About page
@endsection
@section('main_content')

<div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-12 text-center ">
                            <h3 class="display-3 text-white animated slideInLeft">Watch your History here</h3>
                            <p class="animated slideInRight text-primary"> Packged Drinking Water</p>

                        </div>
                        
                    </div>
                </div>
            </div>



            
                <div class="container">
    <div class="row">
             @include('sweetalert::alert')
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                           Check Your Ledger
                       </div>
                </div> 
               
                    
               @foreach($products1 as $order)
                    <div class="card-body">
                        <!-- <h4>Date:-  {{$order->time}}</h4> -->
                     <!--{{$order->order_id}}-->
                     <h4>Products</h4>
                      <table class="table bordered">
                          <tr>
                              
                                <th>Date</th>
                              <th>Product Name</th>
                               <th>Product quantity</th> 
                                <th>Product Total Price</th>
                          </tr>
                          
                          
                        @foreach($products as $data)
                                 @if($order->order_id == $data->order_id)
                                 
                                      
                                      <tr style="border:1px solid black;">
                                      <td style="border:1px solid black;">{{$data->time}}</td>
                                          
                                          <td style="border:1px solid black;">{{$data->product_name}}</td>
                                          <td  style="border:1px solid black;">{{$data->p_qty}}</td>
                                          <td  style="border:1px solid black;">{{$data->priceTotal}}</td>
                                          
                                      </tr>
                                           
                                           
                                    
                                     @endif
                         @endforeach
                         
                         
                         </table>
                          <b>Payment Type:- </b>{{$order->paymentType}}
                          
                          
                          <br>
                           <b>Total:- </b>{{$order->Total}}
                             @if($order->paymentType == 'credit')
                             <br>
                                <b>Paid Amount:- </b>{{$order->paidAmount}}</b>
                                 <br>
                                <b>After Paid Amount:- </b>{{$order->AfterPaidAmount}}</b>
                             @endif
                        
                         
                          
                            <hr>
                    </div>
                    @endforeach
                        
                        
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection