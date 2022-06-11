<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <style>
      .table td{
          border:none !important;
          font-size:13px;
      }
      div{
        font-size:13px;
      }
    </style>
    <title>@foreach($products1 as $order)

@if($loop->first)
<center>{{$order->name}}'s Bill Data </center>
@endif
@endforeach
</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="card col-12" style="border:1px solid black; ">    
               @foreach($products1 as $order)
               @if($loop->first)
               <center>{{$order->name}}'s Bill </center>
              <hr>    
              <center><h3>Pyaas</h3> </center>
                    <table class="table " >
                            <tr>
                            <td style="width:350px">
                                <p>K-2/1,J/1-28 to 30
                                Bhagawati nagar Ind. society,
                                Udha-Navsari Road, Bhastan,
                                SURAT(gujrat),395023.</p>                    
                            </div>
                            </td>
                            <td></td>
                            </tr>
                            <tr>
                            <td style="text-align:left; width:200px;font-size:14px;">       
                            <b>Invoice No :</b> {{$order->order_id}}<br>
                            <b>Customer Name :</b> {{$order->name}}<br>    
                            <b>Contact Number :</b> {{$order->mobile}}<br>
                            <b>Customer Addresss:</b> {{$order->address}}<br>       
                            </td>
                            <td style="text-align:left; border:1px solid black;font-size:14px;">
                            <b>Invoice Date : </b>{{date('d-m-y', strtotime($order->time))}}<br>
                            <b>Payment Type :</b> {{$order->paymentType}}<br>
                            <b>  Copy Type :</b>Original Copy
                        </td>
                    </tr>
                    </table>
                        @endif
                        @endforeach  
                        <div class="card-body">
                                <table class="table" >
                                <tr style="border-top:1px solid black; border-bottom:1px solid black;" >
                                        <th>Sr no.</th>
                                        <th>Date</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th> 
                                        <th>Rate</th>  
                                        <th>Total </th>
                                        </tr>
                                    <?php $i=1; ?>
                                    @foreach($products as $data)
                                            <tr>
                                            <td> {{$i++}}</td>
                                                <td>{{date('d-m-y', strtotime($data->time))}}</td>
                                                <td>{{$data->product_name}}</td>
                                                <td>{{$data->p_qty}}</td>
                                                <td>{{$data->price}}</td>
                                                <td>{{$data->priceTotal}}</td>
                                            </tr>
                                            @endforeach
                                             <tr style="border-top:1px solid black; border-bottom:1px solid black;" >
                                                <td><b>Sub Total </b></td>
                                                <td></td>
                                                 <td></td>
                                                 <td>{{$products->sum('p_qty')}}</td>
                                                 <td></td>
                                                 <td> {{$products1->sum('Total')}}</td>
                                            </tr>
                                </table>
                                    <hr>
                    </div>
        </div>
    </div>

</div>







    
</body>
</html>