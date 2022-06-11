<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\User;

use App\Models\order_detail;
use App\Models\contact;
use App\Models\ledger;
use App\Models\companymaster;



use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use Auth;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\email_log;
use RealRashid\SweetAlert\Facades\Alert;


class order extends Controller
{
    //
    function set_order(Request $req){

      

        $products = product::where("product_id",'=',1)->get();
        
        $data1=[];
        $userEmail;
        $nameofProduct=[];
      
        $date = date('Y-m-d H:i'); 
        $order = new orders;
        $order->CustomerID = $req->user;
        $order->paymentType = $req->paymentType;

        if($order->paymentType == 'cash' ||  $order->paymentType == 'Bank'){
             $order->paidAmount = $req->Total;
           
        }else{
            $order->paidAmount = $req->paidAmount;
        }
       
        $order->AfterPaidAmount = $req->AfterPaidAmount;
        $order->Total = $req->Total;
        $order->time  =  $req->date;
        $order->save();



        $ledger = new ledger;
        $ledger->customer_id = $req->user;
        $ledger->paymentDate = $req->date;
        $ledger->credit =  $req->paidAmount;
        $ledger->debit =  $req->Total;
        $ledger->remark = 'null';
        $ledger->save();

    //order detail
        $orderdata = DB::table('orders')->orderBy('order_id','desc')->first();
        $id =$orderdata->order_id;

       
            foreach($req->product as $data ) {  
                $orderDetail = new order_detail;
                $orderDetail->user_id = $req->user;
                $orderDetail->orders_id =$id;
                $orderDetail->products_id = $data;
                
                foreach($products as $product){
                    $productId = $product->product_id;
                    if($data == $productId){
                                $orderDetail->p_qty =$req->qty1;
                                $orderDetail->priceTotal =$req->product1Total;

                            }else{
                                $orderDetail->p_qty =$req->qty2;
                                $orderDetail->priceTotal =$req->product2Total;
                            
                            }
                }
                 $orderDetail->save();
                
            }
        //for mail
        $productname = [];
        $userData = DB::table('users')->where('id',$req->user)->select('name','email')->get();
        $products = DB::table('order_detail')
        ->join('products' ,'order_detail.products_id',"=","products.product_id")
        ->where('orders_id',$id)->get();
        foreach($products as $productName ){
           
            $productname[] = $productName->product_name;
        }
        foreach($userData as $dataname ){

         $data1 = array(
             'name'      => $dataname->name,
             'product' => implode(',',$productname),
             'qty1' =>$req->qty1,
             'qty2'=>$req->qty2,
             'paymentType'=>$req->paymentType,
             'total'=>$req->Total,
             'paidAmount'=>$req->paidAmount,
             'AfterPaidAmount'=>$req->AfterPaidAmount,
             
          );
          $userEmail = $dataname->email;

        }
       // Mail::to($userEmail)->send(new SendMail($data1));
   
     Alert::success('Success',"Your invoice Id is $id");
       return back();
        // return response()->json([
        //     'data' => $id
        // ]);
     //return back()->with('Success',"Your Data Successfully");
    }

    static function lastId(){
        $id = DB::table('orders')->orderBy('order_id', 'DESC')->first();
        return $id;
    }
    
function get_product(){
    $products = product::all();
    $users = user::all();
    
    
    return view('userform',compact('products','users'));
}
function get_form(){
    $product = product::all();
    $order = orders::paginate(4);
    $order_detail = order_detail::all();
    $user = user::all();

    // $products = DB::table('order_detail')
    //     ->join('products','order_detail.product_id',"=","products.product_id")
    //     ->join('orders','order_detail.order_id',"=","orders.order_id")->get();

    //     return $products;
    return view('showForm',compact('product','order','order_detail','user'));

}
function form($order_id){
    $products = DB::table('order_detail')
        ->join('products','order_detail.products_id',"=","products.product_id")
        ->join('users','order_detail.user_id',"=","users.id")
        ->join('orders','order_detail.orders_id',"=","orders.order_id")->where('order_id',$order_id)->get();
   // dd($products);
   $productData = DB::table('order_detail')
   ->join('products','order_detail.products_id',"=","products.product_id")->where('orders_id',$order_id)->get();
   //dd($product);   
   //dd($productData);  
   return view('display_form',compact('products', 'productData'));
}


function getdata(Request $req){
    
     $data = $req->search;
    
    $user = user::all();
    $search = DB::table('orders')
    ->join('users','orders.CustomerID','=','users.id')
    ->where('order_id','like',"%$data%")
    ->orwhere('name','like',"%$data%")
    ->select('order_id','user_id')
    ->get();

//    print_r($search);
    return view('serachOrder',compact('search','user'));

}
function serchBill(Request $req){
    
    $data = $req->search;
   
   $user = user::all();
   $company = companymaster::all();


   $products = DB::table('orders')
      
   ->join('users','orders.CustomerID',"=","users.id")
   ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
   ->join('products','order_detail.products_id',"=","products.product_id")
   ->where('order_id','like',"%$data%")
   ->orwhere('name','like',"%$data%")->get();
   

   $products1 = DB::table('orders')
   ->join('users','orders.CustomerID',"=","users.id")->orderBy('order_id','desc')
   ->where('order_id','like',"%$data%")
   ->orwhere('name','like',"%$data%")->get();
   //return view('getBilling',compact('user','products','products1'));




   //return response()->json(['name' => $products, 'order' => $products1 ]);
   return view('serachBill',compact('products','products1','user','company'));

}

function Ledger(){
    $user = Auth::user()->id;
    $company = companymaster::all();
   
     $products = DB::table('orders')
      
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->get();
        

        $products1 = DB::table('orders')
        ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
        return view('Ledger',compact('products','products1','company'));
    
}



function getuserdetails(){
    $user = user::all();
    $company = companymaster::all();


    $products = DB::table('orders')
      
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->get();
        
    
        $products1 = DB::table('orders')
        ->join('users','orders.CustomerID',"=","users.id")->orderBy('order_id','desc')->take(50)->get();
        return view('getuserdetails',compact('user','products','products1','company'));

}
//foe ajax view show ledger
function getuserdetailsId($id){
    $user = $id;
    $company = companymaster::all();
    $products = DB::table('orders')
      
    ->join('users','orders.CustomerID',"=","users.id")
    ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
    ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->get();
    

    $products1 = DB::table('orders')
    ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
   
    return view('LedgerAdmin',compact('products','products1','company'));
}
// show ledger  below deopdown in admin side
function getledger(Request $req){
    $user = $req->userId;
    $company = companymaster::all();
   
    
       
    if(empty($user)){
    
    if(!empty($req->from) && !empty($req->to)){
        
       
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->where('orders.paymentType',$req->payment)->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmin',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
        }else{
          
            $products = DB::table('orders')
      
            ->join('users','orders.CustomerID',"=","users.id")
            ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
            ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.paymentType',$req->payment)->get();
             
             $products1 = DB::table('orders')
               ->join('users','orders.CustomerID',"=","users.id")
             ->where('orders.paymentType',$req->payment)->get();
                $payment = 1;
           
            if(!empty($products1)){
                return view('LedgerAdmin',compact('products','products1','company','payment'));
            }else{
                    echo'<center>data not avalible</center>';
                }
        }
  
   
   }elseif(empty($req->payment)){
       
   
    if(!empty($req->from) && !empty($req->to)){
        
        
       
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->where('orders.CustomerID',$user)->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmin',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
        }else{
            
         
            $products = DB::table('orders')
      
            ->join('users','orders.CustomerID',"=","users.id")
            ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
            ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->get();
          
            $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmin',compact('products','products1','company'));
            }else{
            echo'<center>data not avalible</center>';
            }


        }

       
   }elseif(!empty($user) && !empty($req->payment)){


    if(!empty($req->from) && !empty($req->to)){
           
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmin',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    }else{
       
        $products = DB::table('orders')
            
            ->join('users','orders.CustomerID',"=","users.id")
            ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
            ->join('products','order_detail.products_id',"=","products.product_id")->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
 
             $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmin',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    }

            
            

    }elseif(!empty($req->from) && !empty($req->to)){
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->whereBetween('orders.time',[$req->from,$req->to])->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmin',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    
    }else{
        $products = DB::table('orders')
                
                ->join('users','orders.CustomerID',"=","users.id")
                ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
                ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->orwhere('orders.paymentType',$req->payment)->get();
                
                $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmin',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    }
    
       
      
       
       
          
        
        
    
        // $products = DB::table('orders')
      
        // ->join('users','orders.CustomerID',"=","users.id")
        // ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        // ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->get();
        
    
        // $products1 = DB::table('orders')
        // ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
        
        // if(count($products1) == 0){
        //     return '<center>Data Not Availble</center> ';
        // }else{
        //     return view('LedgerAdmin',compact('products','products1','company'));
        // }

   
}
function getledgerdetail(Request $req){
    $user = $req->userId;
    $company = companymaster::all();
   
    
       
    if(empty($user)){
    
    if(!empty($req->from) && !empty($req->to)){
        
       
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->where('orders.paymentType',$req->payment)->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmindetail',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
        }else{
          
            $products = DB::table('orders')
      
            ->join('users','orders.CustomerID',"=","users.id")
            ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
            ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.paymentType',$req->payment)->get();
             
             $products1 = DB::table('orders')
               ->join('users','orders.CustomerID',"=","users.id")
             ->where('orders.paymentType',$req->payment)->get();
                $payment = 1;
          
            if(!empty($products1)){
                return view('LedgerAdmindetail',compact('products','products1','company','payment'));
            }else{
                    echo'<center>data not avalible</center>';
                }
        }
  
   
   }elseif(empty($req->payment)){
       
   
    if(!empty($req->from) && !empty($req->to)){
        
        
       
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->where('orders.CustomerID',$user)->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmindetail',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
        }else{
            
         
            $products = DB::table('orders')
      
            ->join('users','orders.CustomerID',"=","users.id")
            ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
            ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->get();
          
            $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmindetail',compact('products','products1','company'));
            }else{
            echo'<center>data not avalible</center>';
            }


        }

       
   }elseif(!empty($user) && !empty($req->payment)){


    if(!empty($req->from) && !empty($req->to)){
           
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmindetail',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    }else{
       
        $products = DB::table('orders')
            
            ->join('users','orders.CustomerID',"=","users.id")
            ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
            ->join('products','order_detail.products_id',"=","products.product_id")->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
 
             $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmindetail',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    }

            
            

    }elseif(!empty($req->from) && !empty($req->to)){
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->whereBetween('orders.time',[$req->from,$req->to])->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmindetail',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    
    }else{
        $products = DB::table('orders')
                
                ->join('users','orders.CustomerID',"=","users.id")
                ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
                ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->orwhere('orders.paymentType',$req->payment)->get();
                
                $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('LedgerAdmindetail',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    }
    
       
      
       
       
          
        
        
    
        // $products = DB::table('orders')
      
        // ->join('users','orders.CustomerID',"=","users.id")
        // ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        // ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->get();
        
    
        // $products1 = DB::table('orders')
        // ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
        
        // if(count($products1) == 0){
        //     return '<center>Data Not Availble</center> ';
        // }else{
        //     return view('LedgerAdmin',compact('products','products1','company'));
        // }

   
}

public function Billdetail($id){
   // $user = user::all();
     $user = Auth::user()->id;
    $company = companymaster::all();

    $products = DB::table('orders')
    ->join('users','orders.CustomerID',"=","users.id")
    ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
    ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.order_id',$id)->get();

     $products1 = DB::table('orders')
        ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
    return view('Billdetail',compact('user','products','products1','company'));

}


public function getBilling(){
    $user = user::all();
    $company = companymaster::all();


    $products = DB::table('orders')
      
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->get();
        
    
        $products1 = DB::table('orders')
        ->join('users','orders.CustomerID',"=","users.id")->orderBy('order_id','desc')->take(50)->get();
        return view('getBilling',compact('user','products','products1','company'));

}
function getuserBill(Request $req){
    $user = $req->userId;
    $company = companymaster::all();
    
   if(empty($user)){
    
    if(!empty($req->from) && !empty($req->to)){
        
      
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->where('orders.paymentType',$req->payment)->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
      
           
            if(!empty($products1)){
                return view('BillAdmin',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
        }else{
          
            $products = DB::table('orders')
      
            ->join('users','orders.CustomerID',"=","users.id")
            ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
            ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.paymentType',$req->payment)->get();
             
             $products1 = DB::table('orders')
               ->join('users','orders.CustomerID',"=","users.id")
             ->where('orders.paymentType',$req->payment)->get();
            $payment = 1;
           
            if(!empty($products1)){
                return view('BillAdmin',compact('products','products1','company','payment'));
            }else{
                    echo'<center>data not avalible</center>';
                }
        }
  
   
   }elseif(empty($req->payment)){
       
   
    if(!empty($req->from) && !empty($req->to)){
        
        
       
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->where('orders.CustomerID',$user)->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('BillAdmin',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
        }else{
            
         
            $products = DB::table('orders')
      
            ->join('users','orders.CustomerID',"=","users.id")
            ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
            ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->get();
          
            $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('BillAdmin',compact('products','products1','company'));
            }else{
            echo'<center>data not avalible</center>';
            }


        }

       
   }elseif(!empty($user) && !empty($req->payment)){


    if(!empty($req->from) && !empty($req->to)){
           
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('BillAdmin',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    }else{
       
        $products = DB::table('orders')
            
            ->join('users','orders.CustomerID',"=","users.id")
            ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
            ->join('products','order_detail.products_id',"=","products.product_id")->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
 
             $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
       
           
            if(!empty($products1)){
                return view('BillAdmin',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    }

            
            

    }elseif(!empty($req->from) && !empty($req->to)){
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->whereBetween('orders.time',[$req->from,$req->to])->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
       
           
            if(!empty($products1)){
                return view('BillAdmin',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    
    }else{
        $products = DB::table('orders')
                
                ->join('users','orders.CustomerID',"=","users.id")
                ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
                ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->orwhere('orders.paymentType',$req->payment)->get();
                
                $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('BillAdmin',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    }
    
    

   
}

function getuserBilldetail(Request $req){
    $user = $req->userId;
    $company = companymaster::all();
    
   if(empty($user)){
    
    if(!empty($req->from) && !empty($req->to)){
        
       
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->where('orders.paymentType',$req->payment)->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('billAdmindetail',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
        }else{
          
            $products = DB::table('orders')
      
            ->join('users','orders.CustomerID',"=","users.id")
            ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
            ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.paymentType',$req->payment)->get();
             
             $products1 = DB::table('orders')
               ->join('users','orders.CustomerID',"=","users.id")
             ->where('orders.paymentType',$req->payment)->get();
            $payment = 1;
           
            if(!empty($products1)){
                return view('billAdmindetail',compact('products','products1','company','payment'));
            }else{
                    echo'<center>data not avalible</center>';
                }
        }
  
   
   }elseif(empty($req->payment)){
       
   
    if(!empty($req->from) && !empty($req->to)){
        
        
       
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->where('orders.CustomerID',$user)->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('billAdmindetail',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
        }else{
            
         
            $products = DB::table('orders')
      
            ->join('users','orders.CustomerID',"=","users.id")
            ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
            ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->get();
          
            $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('billAdmindetail',compact('products','products1','company'));
            }else{
            echo'<center>data not avalible</center>';
            }


        }

       
   }elseif(!empty($user) && !empty($req->payment)){


    if(!empty($req->from) && !empty($req->to)){
           
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('billAdmindetail',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    }else{
       
        $products = DB::table('orders')
            
            ->join('users','orders.CustomerID',"=","users.id")
            ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
            ->join('products','order_detail.products_id',"=","products.product_id")->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
 
             $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
       
           
            if(!empty($products1)){
                return view('billAdmindetail',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    }

            
            

    }elseif(!empty($req->from) && !empty($req->to)){
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->whereBetween('orders.time',[$req->from,$req->to])->get();
    
        $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->whereBetween('orders.time',[$req->from,$req->to])->where([['orders.CustomerID','=',$user],['orders.paymentType','=',$req->payment]])->get();
       
           
            if(!empty($products1)){
                return view('billAdmindetail',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    
    }else{
        $products = DB::table('orders')
                
                ->join('users','orders.CustomerID',"=","users.id")
                ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
                ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->orwhere('orders.paymentType',$req->payment)->get();
                
                $products1 = DB::table('orders')
            ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
           
            if(!empty($products1)){
                return view('billAdmindetail',compact('products','products1','company'));
            }else{
                    echo'<center>data not avalible</center>';
                }
    }
    
    

   
}

// show ledger  below deopdown in admin side
function getBill(Request $req){
    $user = user::all();
    $company = companymaster::all();


    $products = DB::table('orders')
      
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->get();
        
    
        $products1 = DB::table('orders')
        ->join('users','orders.CustomerID',"=","users.id")->orderBy('order_id','desc')->take(50)->get();
        return view('getBill',compact('user','products','products1','company'));

}
function BillUpdate($id){
        
        $products = DB::table('orders')
      
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.order_id',$id)->get();
        
    
        $products1 = DB::table('orders')
        ->join('users','orders.CustomerID',"=","users.id")->where('orders.order_id',$id)->get();

        return view('BillUpdate',compact('products','products1'));

 


}
function updatebill(Request $req){
       print_r($req->orderdetail1);

    $orderdetails = order_detail::where('orderdetail','=',$req->orderdetail1)->update([
    
        'products_id'=>$req->input('product_id1'),
        'p_qty'=>$req->input('product_qty1'),
        'priceTotal'=>$req->input('priceTotal'),
    ]);
   
    
    
    $orderdetails2 = order_detail::where('orderdetail','=',$req->orderdetail2)->update([
    
        'products_id'=>$req->input('product_id2'),
        'p_qty'=>$req->input('product_qty2'),
        'priceTotal'=>$req->input('priceTotal2'),
    ]);
    $Total =  $req->input('priceTotal') + $req->input('priceTotal2');


    $orderTotal = orders::where('order_id','=',$req->orderId)->update([
    
        'Total'=> $Total, 
    ]);

    $cash = 'cash';
    $Bank = 'Bank';
    
    $orderTotal = orders::where('order_id','=',$req->orderId)->where('paymentType','=',$cash)->update([
    
        'Total'=> $Total,
         'paidAmount'=>$Total,
    ]);
    $orderTotalBank = orders::where('order_id','=',$req->orderId)->where('paymentType','=',$Bank)->update([
    
        'Total'=> $Total,
         'paidAmount'=>$Total,
    ]);
    $orderTotalCredit = orders::where('order_id','=',$req->orderId)->where('paymentType','=','credit')->update([
    
        'Total'=> $Total,
         'paidAmount'=>$req->input('paidAmount'),
         'AfterPaidAmount'=>$req->input('AfterPaidAmount'),

    ]);
        
return back();

      
}

function contact(Request $req){



    $contactdata = new contact;
    $contactdata->name  = $req->name;
    $contactdata->email  = $req->email;

    $contactdata->subject  = $req->subject;

    $contactdata->message  = $req->message;
    $contactdata->save();
    Alert::success('Success', 'Thank you for your Message.');
    
    return back();


}


}
