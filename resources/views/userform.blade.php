@extends('user.main')

@section('template_title')
        Form
@endsection
@section('main_content')



<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<style>
body{
    overflow-x:hidden  !important;
}
    .form-control {
    display: inline;
    width: 50%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #666565;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    appearance: none;
    border-radius: 2px;
    transition: border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out;
}
</style>

<?php
use App\Http\Controllers\order;                          
$lastId = order::lastId();                          
// dd($lastId->order_id + 1);                      
?>

            {{-- Authentication Links --}}
                @guest
                <script type="text/javascript">
                    window.location = "{{ url('login') }}";//here double curly bracket
                </script>
                @else
                
                <div class="container mt-4">
    <div class="row">
             @include('sweetalert::alert')
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                        Generate Invoice
                       </div>
                </div> 
                <div class="card-body">
                    <form method="POST" action="addform" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                         
                        <input type="text" id="serch12" name="search" value="{{$lastId->order_id + 1}}" placeholder="serch Invoice Number">
                        <div class="form-group row">
                            <div class="form-group row">
                            <label  class="col-sm-3 col-form-label "><h6>Select Customer</h6> </label>
                 
                            <div class="col-sm-7">
                                <div class=" ">
                                <select class="form-control selectpicker" name="user" data-live-search="true" required>
                                   
                                    <option value="Select Part" selected>Select Customer</option>
                                   
                                    @foreach($users as $user)
                                    
                                    <option data-select2-id="41" selected="" value="{{$user->id}}">{{$user->name}}</option>
                                    
                                     @endforeach
                                    </select>
                                    <br>
                                </div>
                            </div>
                        </div>


                        
                        <div class="form-group row">
                                <div class="col-sm-3">
                                 <h6>Invoice Date</h6>
                                </div>

                                <div class="col-sm-7">
                                    <input type="date" id="date" name="date" placeholder="MM/DD/YYYY" type="text" value="<?php echo date("Y-m-d"); ?>"/>
                                </div>
                            </div>
                               <br>
                               <br>
                            <label  class="col-sm-3 col-form-label "><h6>Select Product</h6></label>
                                 <div class="col-sm-9">

                                            @foreach($products as $product)
                                                @if($loop->first)
                                               
                                               
                                                    <div class="icheck-success ">    
                                                        <input type="checkbox"  id="checkboxSuccess3" value="{{$product->product_id}}" name ="product[]">
                                                        <label for="checkboxSuccess3" >
                                                        <b> {{$product->product_name}} </b>
                                                        </label>
                                                        
                                                    </div>
                                                  
                                            <div>
                                             
                                             </div>

                                           
                                             <div id="textbox1" style="display:none;">
                                           
                                                <div class="form-group">
                                                Product Qty <input type="number" class="form-control"  id="qty1" autocomplete="off"  name="qty1"  placeholder="Enter Qty"/>
                                                 Total Price <span id="product1Total"> </span>

                                                </div>
                                                <br> 
                                             </div> 
                                             Product Rate <input  value="{{$product->price}}" id="product1Price"  />
                                                    <input  value="" id="product1TotalPrice" name = "product1Total" hidden />
                                                    
                                             
                                             
                                             <hr>
                                                    @endif
                                             @endforeach

                           
                                             @foreach($products as $product)
                                            @if($loop->last)
                                                <div class="icheck-success ">    
                                                <input type="checkbox"  id="checkboxSuccess4" value="{{$product->product_id}}" name="product[]">
                                                    <label for="checkboxSuccess4">
                                                    <b>{{$product->product_name}} </b>
                                                    </label>    
                                                </div>
                                                
                                           
                                            <div id="textbox2" style="display:none;">
                                            <div class="form-group" >
                                            <input type="number" class="form-control"  id="qty2" autocomplete="off" name="qty2" placeholder="Enter Qty"/>
                                            Total Price <span id="product2Total"> </span>
                                             </div>
                                             <br>
                                            </div>
                                            Product Rate  <input  value="{{$product->price}}" id="product2Price"  />
                                                <input  value="" id="product2TotalPrice" name = "product2Total" hidden />
                                                
                                                @endif
                                            @endforeach
                                   
                                  
                                 </div>
                            </div>

                            <br>
                           
                            <div class="form-group row">
                            <label  class="col-sm-3 col-form-label "><h6>Payment Type</h6> </label>
                 
                            <div class="col-sm-7">
                                
                      
                                    <select class="form-select" id="payment" style="width: 100%;" name ="paymentType" data-select2-id="17" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="41" selected="selected" value="cash">Cash</option>
                                    <option data-select2-id="41"  value="Bank">Bank</option>
                                    <option data-select2-id="41"  value="credit">Credit</option>
                                       
                                    </select>
                                    <br>
                                   
                                    <span  style="display:none;"    id="credit">Amount paid <input type="number"   autocomplete="off" name="paidAmount" placeholder="Enter Amount paid"/></span>

                               
                            </div>
                        </div>
                        <br>
                            <div class="form-group row">
                            <label  class="col-sm-3 col-form-label"><h6>Total Price</h6> </label>
                 
                            <div class="col-sm-7 text-center">
                                <div class="form-floating">
                               <h3> Total Bill :- <span id="Total"></span></h3>
                               <input name="Total" id="TotalDb" hidden>
                               <h3 style="display:none;"id="paidrs">0</span></h3>
                               <input type="text" hidden id="paidrsDb" name ="paidAmount">
                               <h3 style="display:none;"id="afeterPaidrs"> <span >0</span></h3>
                               <input type="text" hidden id="afeterPaidrsDb" name="AfterPaidAmount">
                               
                            </div>
                        </div>
                        <br>
                        
                            <div class="form-group row justify-item-center">
                                <div class="col-6 offset-sm-5">
                                    <button class="btn btn-primary " id="btn">Save</button>
                                </div>
                        </div>
                    <form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div>

@endguest
<div class="row">
    
    <div class="col-sm-12 offset-lg-5">
    <h5>Update bill</h5>         
<input type="text" id="serch" name="search" placeholder="serch Invoice Number">
<a href = "javascript:void(0);" id="btn1" class="btn btn-primary">  
Search 
</a> 
</div>
<div  id="data"></div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    {{-- toastr js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
 
 $(document).ready(function(){
    $('#textbox1').hide();
    var total1, total2,t;
    $('#checkboxSuccess3').on('change',function() {

        if ($('#checkboxSuccess3').is(":checked")) {
            console.log('clik1');
            $('#textbox1').css({"display": "block"});
            $('#textbox1').on('keyup',function() {
                var qty = $('#qty1').val();
                var product1Price = $('#product1Price').val();
                total1= qty * product1Price;
                $('#product1Total').text(total1);
                $('#product1TotalPrice').val(total1);
                total2 = 0;
                $('#Total').text(total1+total2);
                $('#TotalDb').val(total1+total2);

               

            });
           
        }else{
            console.log('not click');
            $('#textbox1').css({"display": "none"});
            var qty = $('#qty1').val(null);
            $('#product1TotalPrice').val(0);
            $('#product1Total').text(0);
          
        }
    

    });
    
     $('#checkboxSuccess4').on('change',function() {

        if ($('#checkboxSuccess4').is(":checked")) {
            console.log('clik1');
            $('#textbox2').css({"display": "block"});
            $('#textbox2').on('keyup',function() {
                var qty2 = $('#qty2').val();
                var product2Price = $('#product2Price').val();
                total2 = qty2 * product2Price;
                $('#product2Total').text(total2);
                $('#product2TotalPrice').val(total2);
                
                $('#Total').text(total1+total2);
                $('#TotalDb').val(total1+total2);

            });
           
        }else{
            console.log('not click');
            $('#textbox2').css({"display": "none"});
            var qty2 = $('#qty2').val(null);
            $('#product2TotalPrice').val(0);
            $('#product2Total').text(0);
           
            
        }
    });
    $("#qty1,#qty2").on('change',function() {
        
        var p1 = $('#product1TotalPrice').val();
        var p2 = $('#product2TotalPrice').val();
        
         var t =    eval(p1) +  eval(p2);

         if(p2 == 0){
            $('#Total').text(p1);
            $('#TotalDb').val(p1);

        }else if(p1 == 0) {
            $('#Total').text(p2);
            $('#TotalDb').val(p2);

        }
        else{
            $('#Total').text(t);
            $('#TotalDb').val(t);

        }
        
       

    });
    $("#checkboxSuccess3,#checkboxSuccess4").on('change',function() {
        
        var p1 = $('#product1TotalPrice').val();
        var p2 = $('#product2TotalPrice').val();
        
         var t =    eval(p1) +  eval(p2);

         if(p2 == 0){
            $('#Total').text(p1);
            $('#TotalDb').val(p1);

        }else if(p1 == 0) {
            $('#Total').text(p2);
           $('#TotalDb').val(p2);

        }
        else{
            $('#Total').text(t);
            $('#TotalDb').val(t);


        }
        
       

    });

    $("#payment").on('change',function() {
            
        var type = $("#payment").val();
        if(type == 'credit'){
            $('#credit').css({"display": "block"}); 
            $("#credit").on('change',function() { 
                 var credit = $("input[name=paidAmount]").val();
                 $('#paidrs').css({"display": "block"});
                 $('#afeterPaidrs').css({"display": "block"}); 
                  

                 var c = $('#TotalDb').val() - credit;
                 $('#paidrs').text('Paid Amount :'+credit);
                 $('#paidrsDb').val(credit);
                 $('#afeterPaidrs').text('Total Amount :'+c);
                 $('#afeterPaidrsDb').val(c);

                 
            });
               
        }else{ 
            $('#credit').css({"display": "none"});   
            var p1 = $('#product1TotalPrice').val();
                var p2 = $('#product2TotalPrice').val();
                $('#paidrs').text(null);
                $('#paidrsDb').val(null);
                $('#afeterPaidrs').text(null);
                $('#afeterPaidrsDb').val(null);
                var credit = $("input[name=paidAmount]").val(null);
              

        }

    });


    $('#btn1').on('click',function(e){
       var data = $('#serch').val();
        console.log($('#serch').val());

            $.ajax({


            type:'get',
            
            url:"{{url('/searchBill')}}",
            data: {
                // "_token": "{{ csrf_token() }}",
                    "search": data,
                },
            success:function(data){
            //     console.log(data.order);
            //     console.log(data.name);
                
            //    // console.log(data.name[0]['order_id']);
            //     $('#Total').text(data.name[0]['Total']);
            //     $('#spantag').text(data.name[0]['product_id']);
            //     $('#qty1').val(data.name[0]['p_qty']);
                $('#data').html(data);
                
            }, 
            });
        
    });
});

</script>