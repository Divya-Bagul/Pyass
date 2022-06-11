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
                Show User Bill Details
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
                                    <option data-select2-id="41" selected="selected"   value="0"> Select Payment Mode</option>
                                         
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
                              
                                    <button class="btn btn-success ml-2 " id="detail">Detail</buuton>
                                  
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
                    
             

                        
                                <table class="table" >
                                <tr style="border-top:1px solid black; border-bottom:1px solid black;" >
                                         <th>Sr No.</th>
                                         <th>Invoice Date</th>
                                          <th>Customer Name</th>
                                            <th>GSTIN</th> 
                                           
                                            <th>Amount</th> 
                                            

                                            <th>Payment Mode </th>
                                            <th>Action </th>
                                        </tr>
                          
                                    <?php $i=1; ?>
                                  
                                    @foreach($products1 as $data)
                                 
                                   
                                   
                                            <tr>
                                            <td > {{$i++}}</td>
                                            
                                                    <td>{{date('d-m-y', strtotime($data->time))}}</td>
                                                 <td>{{$data->name}}</td>
                                                <td>{{$data->gstin}}</td>
                                               
                                                <td>{{$data->Total}}</td>
                                                <td>{{$data->paymentType}}</td>
                                                <td><a href="{{url('Billdetail/'.$data->order_id)}}" class="btn btn-success">Show Bill</a></td>
                                            </tr>
                                    

                                           
                                           
                                             
                                          
                                           
                                            @endforeach
                                            
                                    </table>
                               
                                
                                
                 
                           
                                    
                               </div>
                       
                            <br>
                 
                   
                                
                        
                       <br> 
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
         console.log(data1);
       
            $.ajax({


                type:'get',
                
                url:"{{url('/getuserBill')}}",
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


    $('#detail').click(function(e){
         
         $('#close').css({"display": "block"});
         var data = $('#user').val();
         console.log(data);
 
         var from = $('#from').val();
         var to = $('#to').val();
         var data1 = $('#paymentmode').val();
       
             $.ajax({
 
 
                 type:'get',
                 
                 url:"{{url('/getuserBillDetail')}}",
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