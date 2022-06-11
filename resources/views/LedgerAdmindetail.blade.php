
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
                              <th>Invoice No.</td>
                              <th>Invoice Date</td>
                              <th>Customer Name</td>
                              <th>Product Name</td>
                              <th>Product Qty</td>
                              <th>Rate</td>
                              <th>Amount</td>
                              <th>Action</td>
                              
                              







                                        @foreach($products as $order)
                                      
                                            <tr>

                                            <td>{{$order->order_id}}</td>
                                            
                                            <td> {{date('d-m-y', strtotime($order->time))}}
                                            <td>{{$order->name}}</td>

                                      
                                            <td>
                                            @foreach($products as $product)
                                                @if($product->orders_id == $order->order_id )
                                                        {{$product->product_name}}
                                            @endif
                                            @endforeach 
                                            </td>
                                            <td>
                                            @foreach($products as $product)
                                                @if($product->orders_id == $order->order_id )
                                            
                                                {{$product->p_qty}}<br>
                                                @endif
                                            @endforeach 
                                            
                                            </td>
                                            
                                            <td>
                                            @foreach($products as $product)
                                                @if($product->orders_id == $order->order_id )
                                            
                                                {{$product->priceTotal}}
                                                @endif
                                            @endforeach 
                                            
                                            </td>
                                            <td>{{$order->Total}}</td>
                                            <td>
                                                
                                            <form action="{{url('/getPdf')}}">
                                        @csrf 
                                        @foreach($products as $order)
                                        @if($loop->first)
                                        <input hidden value="{{$order->id}}" id="userpdf" name="userId">
                                         <input type="submit"  class="btn  btn-danger float-right " id="user" name="userPdf" value="Generate PDF">
                                        @endif
                                    @endforeach
                                    </form>
                                        
                                        
                                        
                                        </td>
                                            </tr>
                                           
                                           
                                       

                                           
                                           
                                    
                                          
                                    
                                        @endforeach
                                       
                                        <tr>
                                           
                                        </tr>
                                </table>
                               

                         
                          
                                   
                                    
                    </div>
              
                                    

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

