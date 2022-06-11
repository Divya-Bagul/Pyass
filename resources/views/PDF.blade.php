
<!DOCTYPE html>
<html>
<head>


  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  
   <style>
      .table td{
          border: none !important;

      }
    </style>
    <title>@foreach($products1 as $order)

@if($loop->first)
<center>{{$order->name}}'s ledger Data </center>
@endif
@endforeach
</title>
</head>
<body>

  

<div class="container-fluid">
    <div class="row">
        <div class="card col-12">

            
                    
               @foreach($products1 as $order)

               @if($loop->first)

              <center> <p>Sai Goga Pani</p>
               {{$order->name}}'s ledger Data </center>
               @endif
               @endforeach
               <hr>
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
                                    <td style="width:80px;font-size:13px; " ><span> {{date('d-m-y', strtotime($order->time))}}</span>
                                    <br> 
                                   
                                            @if($order->paymentType !='credit')
                                           <span> {{date('d-m-y', strtotime($order->time))}}</span>
                                                @endif
                                            </td>
                                    </td>
                                    
                                    <td style="width:300px; font-size:13px;"><span style="font-size:13px;">Invoice No: {{$order->order_id}} | Payment Type: {{$order->paymentType}}</span>
                                     
                                
                                    <br> 
                                   
                                                
                                                @if($order->paymentType !='credit')
                                                Again payment  invoice No:{{$order->order_id}} |
                                                paymentType:{{$order->paymentType}}
                                                @endif
                                            
                                        
                                    </td>

                                         <td style="font-size:13px;"> {{$order->Total}}</td>
                                         <td style="font-size:13px;"> <br>
                                        <span> {{$order->paidAmount}} </span></td>

                                         <td></td>
                                    
                                    </tr>
                                    

                                   
                                   
                            
                                  
                            
                                @endforeach
                               
                                <tr>
                                    <td ></td>
                                   
                                    <td><b>Grand Total</b> </td>
                                    <td><b> {{ $products1->sum('Total') }}</b> </td>
                                    <td><b> {{ $products1->sum('paidAmount') }}</b> </td>

                                    <td ><b> {{ $products1->sum('AfterPaidAmount') }}</b></td>
                                </tr>
                        </table>
                       

                 
                  
                           
                            
            </div>
               
                                    
                        
                        
        </div>
    </div>

</div>







    
</body>
</html>