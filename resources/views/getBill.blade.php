@extends('layouts.app')

@section('content')
<style>
      .table td{
          border: none !important;

      }
    </style>
<div class="container">
    <div class="row">
        <div class="card col-12">
            <div class="card-header bg-success">
                Show User Bill Details
            </div>
            <div class="card-body">

                <div class="form-group row">
                            <label  class="col-sm-3 col-form-label "><h6>User Name</h6> </label>
                 
                            <div class="col-sm-7">
                                <div class="form-floating ">
                      
                                    <select class="form-select" id="user" style="width: 100%;" name ="user" data-select2-id="17" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="41" selected="selected"   value="0"> Select user</option>
                                         @foreach($user as $data)
                                       
                                         <option data-select2-id="41"   value="{{$data['id']}}">{{$data['name']}}</option>
                                         @endforeach  
                                    </select>
                                

                                </div>
                            </div>
                </div>
                 
                <div id="data" >
                    <hr>
                        <center>last Transactions</center>
                    
                        <div class="card-body">
                        
                         
                           
                        
                               
                        <table class="table">
                             <tr>
                                 <th>Date</th>
                                  <th>Description</th>
                                   
                                    <th>Debit</th>
                                     <th>Credit</th> 
                                     <th>Amount to be paid</th>
                                </tr>
                  
                  
                           
                               
                                @foreach($products1 as $order)
                              
                                    <tr>
                                    <td >{{date('d-m-y', strtotime($order->time))}} 
                                    
                                    <br>
                                            @if($order->paymentType !='credit')
                                            {{date('d-m-y', strtotime($order->time))}}
                                            @endif
                                            </td>
                                            
                                            <td><span>Invoice No: {{$order->order_id}} | Payment Type: {{$order->paymentType}}<span>
                                           
                                            <br> 
                                                
                                                @if($order->paymentType !='credit')
                                                Again payment  invoice No:{{$order->order_id}} |
                                                 paymentType:{{$order->paymentType}}
                                                @endif
                                            
                                        
                                            </td>

                                         <td >{{$order->Total}}</td>
                                         
                                         <td><p></p><br>
                                         {{$order->paidAmount}}</td>

                                         <td></td>
                                    
                                    </tr>
                                  
                                    <tr style="border-bottom:1px solid black;">
                                    
                                    <td></td>
                                  
                                    <td ><b>Total Amount</b></td>
                                    <td >{{$order->Total}}</td>
                                    <td> {{$order->paidAmount}} </td>
                                    <td><b>{{$order->AfterPaidAmount}} </b></td>
                                </tr>
                              
                                   
                                   
                            
                                  
                            
                                @endforeach
                                <!-- {{ $products1->sum('AfterPaidAmount') }} -->
                 
                        </table>
                       
                 
                  
                           
                            
            </div>
                
                </div>  

                
              

            </div>
        </div>
    </div>

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
      
    $('#user').change(function(e){

        var data = $('#user').val();
        console.log(data);
        if(data != 0 ){
            $.ajax({


                type:'get',
                
                url:"{{url('/getuserBill')}}",
                data: {
                    // "_token": "{{ csrf_token() }}",
                        "userId": data,
                    },
                success:function(data){
                    console.log(data);
                    $('#data').html(data);
                    
                }, 

            });    
        }else{
            e.preventDefault(); // cancel click
            window.location.reload();
        }

    });
    
    
    


});
</script>





    @endsection