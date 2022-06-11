
<div class="container">
    <div class="row">
        <div class=" col-12">

            
                    
               @foreach($products1 as $order)

               @if($loop->first)

              <center> <p>Sai Goga Pani</p>
                    @if(isset($payment))
                         Pyament Type : {{$order->paymentType}} ledger Data
                    @else
                    {{$order->name}}'s ledger Data
                    @endif
                    </center>
               @endif
               @endforeach
               <hr>
               <div class="col-sm-12 table-responsive-sm">
                        
                         
                           
                        
                               
                                <table class="table bordered">
                                     <tr>
                                     <th style="padding-right:40x;padding-left:40px;">Date</th>
                                          <th style="padding-right:90x;padding-left:180px;text-align:center;">Order Description  </th>
                                  
                                            <th>Debit</th>
                                             <th>Credit</th> 
                                            <th>Amount to be paid</th>
                                        </tr>
                          
                          
                                   
                                       
                                        @foreach($products1 as $order)
                                      
                                            <tr>
                                            <td > {{date('d-m-y', strtotime($order->time))}}

                                            <br>
                                            @if($order->paymentType !='credit')
                                            {{date('d-m-y', strtotime($order->time))}}
                                                @endif
                                            </td>
                                            
                                            <td><span>Invoice No: {{$order->order_id}}| Payment Type: {{$order->paymentType}}<span>
                                           
                                            <br> 
                                                
                                                @if($order->paymentType !='credit')
                                                Again payment  invoice No:{{$order->order_id}} |
                                                 paymentType:{{$order->paymentType}}
                                                @endif
                                            
                                        
                                            </td>

                                                 <td >{{$order->Total}}</td>
                                                 <td><br>
                                                 {{$order->paidAmount}}</td>

                                                 <td></td>
                                            
                                            </tr>
                                           
                                       

                                           
                                           
                                    
                                          
                                    
                                        @endforeach
                                       
                                        <tr>
                                            <td ></td>
                                           
                                            <td><b>Grand Total</b> </td>
                                            <td><b> {{ $products1->sum('Total') }}</b> </td>
                                            <td><b> {{ $products1->sum('paidAmount') }}</b> </td>

                                            <td><b> {{ $products1->sum('AfterPaidAmount') }}</b></td>
                                        </tr>
                                </table>
                               

                         
                          
                                   
                                    
                    </div>
              
                                    <form action="{{url('/getPdf')}}">
                                        @csrf 
                                        @foreach($products as $order)
                                        @if($loop->first)
                                        <input hidden value="{{$order->id}}" id="userpdf" name="userId">
                                         <input type="submit"  class="btn  btn-danger float-right " id="user" name="userPdf" value="Generate PDF">
                                        @endif
                                    @endforeach
                                    </form>

                                    <br>
                        
                        
        </div>
    </div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
      
    $('#user').click(function(e){
        e.preventDefault();
        var data = $('#userpdf').val();
        console.log(data);
        if(data != 0 ){
            $.ajax({


                type:'get',
                
                url:"{{url('/getPdf')}}",
                data: {
                    // "_token": "{{ csrf_token() }}",
                        "userId": data,
                    },
                success:function(data){
                    console.log(data);
                    
                    
                }, 

            });    
        }else{
            e.preventDefault(); // cancel click
            window.location.reload();
        }

    });
    
    
    


});
</script>

