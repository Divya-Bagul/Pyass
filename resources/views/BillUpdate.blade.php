@extends('user.main')

@section('template_title')
        Form
@endsection
@section('main_content')
<div class="container">
    <div class="row">
        <hr>
        <div class="card   ">
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
                                    <form method="POST" action="{{url('updatebill')}}">
                                        @csrf
                                    @foreach($products as $data)
                                 
                                        @if($loop->first)
                                   
                                            <tr>
                                            <td > {{$i++}}</td>
                                          

                                            <input type="hidden" value="{{$data->order_id}}" name="orderId">
                                            <input type="hidden" value="{{$data->orderdetail }}" name="orderdetail1">
                                            <input type="hidden" value="{{$data->product_id }}" name="product_id1">

                                                <td> {{date('d-m-y', strtotime($data->time))}}</td>
                                                 <td><input type="text" value="{{$data->product_name}}" name="product_name"></td>
                                                 <td><input type="text" id ="qty" name="product_qty1" value="{{$data->p_qty}}" style="width:50px;"
                                                ></td>
                                                <td><input type="text" id="price1" name="product_price" value="{{$data->price}}" style="width:50px;"></td>
                                              <td><input type="text"  id="total1" name="priceTotal" value="{{$data->priceTotal}}" readonly style="border:none;"></td>
                                                        


                                              
                                            </tr>
                                            @endif

                                           
                                    @endforeach
                               <?php $length = count($products);?>

                               @if(count($products)==2)
                                   
                              
                                      @foreach($products as $data)
                                 
                                        @if($loop->last)
                                   
                                            <tr>
                                            <td > {{$i++}}</td>
                                          

                                            <input type="hidden" value="{{$data->order_id}}" name="orderId2">
                                            <input type="hidden" value="{{$data->orderdetail }}" name="orderdetail2">
                                            <input type="hidden" value="{{$data->product_id }}" name="product_id2">
                                                <td> {{date('d-m-y', strtotime($data->time))}}</td>
                                                 <td><input type="text" value="{{$data->product_name}}" name="product_name"></td>
                                            <td><input type="text" id ="qty2" name="product_qty2" value="{{$data->p_qty}}" style="width:50px;"
                                                ></td>
                                               
                                                <td><input type="text" id="price2"  name="product_price" value="{{$data->price}}" style="width:50px;"></td>
                                                <td><input type="text"  id="total2" name="priceTotal2" value="{{$data->priceTotal}}" readonly style="border:none; "></td>

                                            </tr>
                                            @endif



                                    @endforeach
                                    @endif

                                
                                   
                               
                                    </table>
                                    <td> <b>SubTotal:</b><p id="subtotaltext"> {{$products->sum('priceTotal')}}</p></td>
                                    <input type="text" hiiden id="subtotal" name="subtotal" value="{{$products->sum('priceTotal')}}"  style="border:none;"></b>
                                    @foreach($products as $data)
                                    @if($loop->first)
                                            @if($data->paymentType == 'credit')

                                            <b>paidAmount:  <input type="text"  id="paidAmount" name="paidAmount" value="{{$data->paidAmount}}"  style="border:none;"></b>
                                            <b>AfterPaidAmount:   <input type="text"  id="AfterPaidAmount" name="AfterPaidAmount" value="{{$data->AfterPaidAmount}}"  style="border:none;"></b>
                                            @endif


                                            @endif
                                            @endforeach
                                    <div class="col-sm-4">
                                    <button class="btn btn-success">Update bill</button>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <a href="{{url('buy')}}" class="btn btn-danger mt-2">Go Back</a>
                                    </div>      
                                       
                             
                                   

</form>
</div>
        </div>
    </div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
 
 $(document).ready(function(){  
     
    var total =   $('#total1').val(); 
    var total2 =  $('#total2').val();
var subtotal = eval(total) + eval(total2);
    console.log( subtotal);
    $('#qty').on('keyup',function() {
        var qty = $('#qty').val();
        var price = $('#price1').val();
        total = qty * price;
        console.log(qty * price);
        $('#total1').val(total); 
        $('#paidAmount').val(0); 
        $('#AfterPaidAmount').val(0);
        $('#subtotal').val(eval(total) + eval(total2) );  
        $('#subtotaltext').text(eval(total) + eval(total2));     
    });
    $('#qty2').on('keyup',function() {
        var qty = $('#qty2').val();
        var price = $('#price2').val();
        total2 = qty * price;
        console.log(total2);
        $('#total2').val(total2);
        $('#paidAmount').val(0); 
        $('#AfterPaidAmount').val(0); 
        $('#subtotal').val(total + total2);  
        $('#subtotaltext').text(total + total2 ); 
              
    });


    $('#price1').on('keyup',function() {
        var qty = $('#qty').val();
        var price = $('#price1').val();
        var total = qty * price;
        console.log(qty * price);
        $('#total1').val(total);
        $('#paidAmount').val(0); 
        $('#AfterPaidAmount').val(0);        
    });
    $('#price2').on('keyup',function() {
        var qty = $('#qty2').val();
        var price = $('#price2').val();
        var total = qty * price;
        console.log(qty * price);
        $('#total2').val(total);
        $('#paidAmount').val(0);
        $('#AfterPaidAmount').val(0);         
    });

    $('#paidAmount').on('keyup',function() {
        var paidAmount = $('#paidAmount').val();
        var Amount =$('#subtotal').val();
        var totaldata = Amount - paidAmount;
        $('#AfterPaidAmount').val(totaldata);
       // console.log(totaldata);
    });
 });
</script>