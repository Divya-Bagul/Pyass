
<div class="container">
    <div class="row">
        <hr>
        <div class="card col-12" style="border:1px solid black; ">

            
                    
               @foreach($products1 as $order)

              <br>
              @if($loop->first)
               <center>{{$order->name}}'s Bill </center>
              @endif

                
                    <div class="row"  >
                    <div class="col-sm-8">
                        <h3>Pyaas</h3>
                        <p>K-2/1,J/1-28 to 30
                                Bhagawati nagar Ind. society,
                                Udha-Navsari Road, Bhastan,
                                SURAT(gujrat),395023.</p>
                                                    
                     </div>
                     <div class="col-sm-4">
                            <!-- PYASS -->
                     </div>

                    </div>
                    
                    <div class="card-body row">
                        <div class="col-sm-8">

                        <b>Invoice No :</b> {{$order->order_id}}<br>
                        <b> Customer Name :</b> {{$order->name}}<br>
                          <b>Contact Number :</b> {{$order->mobile}}<br>
                          <b>Customer Addresss:</b> {{$order->address}}<br>
                          
                        </div>
                        <div class="col-sm-4">
                        <b>Invoice Date :</b> {{date('d-m-y', strtotime($order->time))}}<br>
                          <b> Pyament Type :</b> {{$order->paymentType}}<br>
                          <b> Copy Type :</b> Original Copy
                        </div>

                       
                      

                            
                           
                               
                                <table class="table" >
                                <tr style="border-top:1px solid black; border-bottom:1px solid black;" >
                                         <th>Sr no.</th>
                                         <th>Date</th>
                                          <th>Product Name</th>
                                            <th>Quantity</th> 
                                            <th>Unit</th> 
                                            <th>Rate</th> 
                                            

                                            <th>Total </th>
                                        </tr>
                          
                                    <?php $i=1; ?>
                                  
                                    @foreach($products as $data)
                                 
                                    @if($order->order_id == $data->order_id)
                                   
                                            <tr>
                                            <td > {{$i++}}</td>
                                            
                                                    <td>{{date('d-m-y', strtotime($data->time))}}</td>
                                                 <td>{{$data->product_name}}</td>
                                                <td>{{$data->p_qty}}</td>
                                                <td>Nos</td>
                                                <td>{{$data->price}}</td>
                                                <td>{{$data->priceTotal}}</td>
                                          
                                            </tr>
                                    

                                           
                                           
                                             
                                            @endif
                                           
                                            @endforeach
                                            <tr style="border-top:1px solid black; border-bottom:1px solid black;" >
                                                <td><b>Sub Total </b></td>
                                                <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 
                                                 <td></td>

                                                 <td>{{$products1->sum('p_qty')}}</td>
                                                 
                                                
                                                 <td> {{$order->Total}}</td>
                                            </tr>
                                    </table>
                               
                                
                                    <hr>
                            
                                    <div class="col-sm-3 ">
                                   
                                    <a  href="{{url('billupdate/'.$order->order_id)}}" class="btn btn-primary mt-2" id="update">Update Bill</a></div>            
                                    <!-- <input type="button" value="{{$order->order_id}}" id="updateid"> -->
                                    <!-- <a href="#" data-id="{{ $order->order_id }}" class="waves-effect waves-light btn-small red btn-hapus"><i class="material-icons">clear</i></a> -->
                                    <div class="col-sm-6 ">
                                   
                                        <a href="{{url('getBillPdf/'.$order->order_id)}}" class="btn btn-danger mt-2">Generate PDF</a></div>
                                
                     @endforeach     
                   
                                
                        
                       <br> 
        </div>
    </div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
      
    $('.btn-hapus').click(function(e){
       
        var updateid1= $('#updateid').val();
        alert($(this).attr('data-id'));
        console.log(updateid);
        // if(data != 0 ){
        //     $.ajax({


        //         type:'get',
                
        //         url:"{{url('/getPdf')}}",
        //         data: {
        //             // "_token": "{{ csrf_token() }}",
        //                 "userId": data,
        //             },
        //         success:function(data){
        //             console.log(data);
                    
                    
        //         }, 

        //     });    
        // }else{
        //     e.preventDefault(); // cancel click
        //     window.location.reload();
        // }

    });
    
    
    


});
</script>

