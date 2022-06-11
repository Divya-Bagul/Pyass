<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
class products extends Controller
{
    //
    function set_product(Request $req){

        $req->validate(
                [

                'name'=>'required',
                ],[

                'name.required'=>'please add product name'
                ]
            );
        $product = new product;
        $product->product_name= $req->name;
        $product->save();
        return back()->with('msg',"product added succesfully");
    }

function get_product(){
    $products = product::all();
    return view('show_products',compact('products'));
}
function edit_product($product_id){
   
   $products = product::where('product_id','=',$product_id)->get();
    //dd($products);
    return view('editproduct',compact('products'));
}
function update_product(Request $req)
{

    $req->validate(
        [

        'name'=>'required',
        ],[

        'name.required'=>'please add product name'
        ]
    );
    $product = product::where('product_id','=',$req->id)->update([
    
        'product_name'=>$req->input('name'),
        'price'=>$req->input('price'),

    ]);
    //return $product;
    return redirect("showproduct");
}

function delete($id){
    $product = product::where("product_id","=",$id)->delete();
    return redirect('showproduct');
}


public function sendMessage(Request $request)
    {
      
        $workingkey = env("SMS_KEY","A23cf3edc7679fcdb0d8e74eeacc320fa");
        $senderID = env("SMS_SENDER_ID","BEEPIT");
        $country_code = "+91";

        $mobilenumber = str_replace(" ", "", $request->input('mobile_number'));
        $msg = $request->input('message');

        $sendData = [
            "status" => true,
            "api_response" => [],
        ];
      
        $client = new Client();
        $res = $client->request('POST', 'http://180.151.98.11/api/sms/SendSMS.aspx', [
                'form_params' => [
                    "workingkey" => $workingkey,
                    "to" => $country_code.$mobilenumber,
                    "sender" => $senderID,
                    "message" => $msg
                ]
            ]);  
            $code = $res->getStatusCode();
            $data = $res->getBody()->getContents();
            $sendData = [
                "status" => true,
                "api_response" => $data,
            ];
    
        
        return $this->createSuccessResponse(trans("messages.success"),$sendData);
    }


}
