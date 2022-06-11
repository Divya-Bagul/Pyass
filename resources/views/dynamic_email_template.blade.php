Hello <b>{{$data['name']}}</b><br>

<br>
Your Product information is here,<br>
<table style="border:1px solid black;" >
    <tr > 
        <th style="border:1px solid black;">product</th>
        <th style="border:1px solid black;">qty</th>
    </tr>
    <tr >
            <td style="border:1px solid black;">{{$data['product']}}</td>
            <td style="border:1px solid black;">{{$data['qty1']}} and {{$data['qty2']}}</td>
            
        </tr>
</table>
 Your Bill : {{$data['total']}}
    <br>
<?php
 if($data['paymentType'] == 'credit'){

    echo "<br>";
    echo 'Your Piad Amount ',$data['paidAmount'];
    echo "<br>"; 
    echo  'Your Total Amount ',$data['AfterPaidAmount'];
}
?>

<br>
<h5 style="color:green;">Thank you for Submitting Form.</h5>