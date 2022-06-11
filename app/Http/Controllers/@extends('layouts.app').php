@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<style>
      .table td{
          border: none !important;

      }
    </style>
<div class="container">
    <div class="row">
        <div class="card col-12">
            <div class="card-header bg-success">
                Show User Order Details
            </div>
            <div class="card-body">

                <div class="form-group row">
                            <label  class="col-sm-3 col-form-label "><h6>Select Customer</h6> </label>
                 
                            <div class="col-sm-7">
                                <div class="form-floating ">
                      
                                   <select class="form-control selectpicker"   data-live-search="true" id="user" style="width: 100%;" name ="user" data-select2-id="17" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="41" selected="selected"   value="0"> Select Customer</option>
                                         @foreach($user as $data)
                                       
                                         <option data-select2-id="41"   value="{{$data['id']}}">{{$data['name']}}</option>
                                         @endforeach  
                                    </select>
                                

                                </div>
                            </div>

                            <label  class="col-sm-3 col-form-label "><h6>Select Payment Mode</h6> </label>
                            <div class="col-sm-7">
                                <div class="form-floating ">
                      
                                    <select class="form-select" id="paymentmode" style="width: 100%;" name ="user" data-select2-id="17" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="41" selected="selected"   value="0"> Select payment Mode</option>
                                         
                                    <option data-select2-id="41"   value="cash">Cash</option>
                                    <option data-select2-id="41"   value="Bank">Bank</option>
                                    <option data-select2-id="41"   value="credit">credit</option>
                                       
                                    </select>
                                

                                </div>
                            </div>
                            <label  class="col-sm-3 col-form-label "><h6>Select Invoice date</h6> </label>
                            <div class="col-sm-7">
                                <input type="date" id="from" name ="from"/> 
                                <input type="date" id="to" name="to"/>
                            </div>
                              <br>

                            <div class="col-sm-12 col-lg-5 offset-lg-3">
                                    <button class="btn btn-primary" id="btn">Search</buuton>
                              </div>
                              <div class="col-sm-12 col-lg-4 ">
                                 <button class="btn btn-primary" id="close" style="display:none;">close</buuton>
                              </div>
                              
                              <!-- Search Bill: <input type="text" name="search" id="search" placeholder="Search"  /> -->
                            </div>
                </div>
                 
                <div id="data" >
                    <hr>
                        <center>last Transactions</center>
                  
                        <div class="row">

                        
                           
                        
                               
                        <div class="col-12" >
               
                        <div class=" table-responsive-sm">
                         
                           
                    
                               
                        <table class="table">
                             <tr>
                             <th>Customer Name</th>
                             <th style="padding-right:40x;padding-left:40px;"> Date</th>
                                  <th style="padding-right:90x;padding-left:180px;text-align:center;">Order Description  </th>
                                   
                                    <th>Debit</th>
                                     <th>Credit</th> 
                                     <th>Amount to be paid</th>
                                </tr>
                  
                  
                           
                               
                                @foreach($products1 as $order)
                                  
                                    <tr>
                                    <td>{{$order->name}}</td>
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
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
      
    $('#btn').click(function(e){
        $('#close').css({"display": "block"});
        var data = $('#user').val();
        console.log(data);

        var from = $('#from').val();
        var to = $('#to').val();
        var data1 = $('#paymentmode').val();
      
            $.ajax({


                type:'get',
                
                url:"{{url('/getledger')}}",
                data: {
                    // "_token": "{{ csrf_token() }}",
                        "userId": data,
                        "payment":data1,
                        "from":from,
                        "to":to,
                    },
                success:function(data){
                    console.log(data);
                    $('#data').html(data);
                    
                }, 

            });    
       

    });

    $('#close').click(function(e)
    {
        e.preventDefault(); // cancel click
            window.location.reload();
    }); 
    
    
    


});
</script>





    @endsection