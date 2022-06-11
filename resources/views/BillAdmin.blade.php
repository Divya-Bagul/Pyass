<style>
.card-body {
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
     /* padding: 1.25rem;  */
}

</style>
    <div class="container-fluid">
        <div class="row">
                <hr>
           

            
                    
            @foreach($products1 as $order)
    
              <br>
              @if($loop->first)
              <div class="col-sm-12 col-lg-12"><center> <p>Sai Goga Pani</p>
                    @if(isset($payment))
                         Pyament Type : {{$order->paymentType}} Bill
                    @else
                    {{$order->name}}'s Bill
                    @endif
                    </center></div>
              @endif
                    <div class="col-sm-12 col-lg-12">
                    @foreach($company as $companydata)

                        <h3>{{$companydata->CompanyName}}</h3>
                        <p>{{$companydata->CompanyAddress}}</p>
                    @endforeach                           
                    </div>
                   
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
                    <div class="col-sm-12 table-responsive-sm">
                               
                            <table class="table" >
                                    <tr style="border-top:1px solid black; border-bottom:1px solid black;" >
                                        <th>Sr no.</th>
                                        <th style="padding-right:40x;padding-left:40px;">Date</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th> 
                                        <th>Rate</th> 
                                        <th>Total</th>
                                    </tr>
                          
                                    <?php $i=1; ?>
                                  
                                    @foreach($products as $data)
                                 
                                     @if($order->order_id == $data->order_id)

                                   
                                            <tr>
                                            <td> {{$i++}}</td>
                                            
                                                <td>{{date('d-m-y', strtotime($data->time))}}</td>
                                                <td>{{$data->product_name}}</td>
                                                <td>{{$data->p_qty}}</td>
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

                                                
                                                <td> {{$order->Total}}</td>
                                            </tr>
                                   
                                            </table>
                                    
                                    </div>
                                    
                                        <div class="col-sm-12 ">
                                   
                                        <a  href="{{url('billupdate/'.$order->order_id)}}" class="btn btn-primary mt-2" id="update">Update Bill</a>
                                        </div>            
                                    
                                  
                                    <div class="col-sm-12 ">
                                        <a href="{{url('getBillPdf/'.$order->order_id)}}" class="btn btn-danger mt-2">Generate PDF</a>
                                    </div>      
                                       
                            

                             @endforeach            
                  
                   
                
           
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

