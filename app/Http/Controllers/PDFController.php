<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\User;
use App\Models\companymaster;
use App\Models\order_detail;
use App\Models\contact;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use Auth;
use PDF;





use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\email_log;
use RealRashid\SweetAlert\Facades\Alert;
class PDFController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Welcome to Tutsmake.com',
            'date' => date('m/d/Y')
        ];
        $demo = 'abc';   
        $pdf = PDF::loadView('PDF',[ 'data'=>$data,'demo'=> $demo]);
     
        return $pdf->download('tutsmake.pdf');
    }
    function getPdf(Request $req){
        $user = $req->userId;
        $company = companymaster::all();
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->get();
        
    
        $products1 = DB::table('orders')
        ->join('users','orders.CustomerID',"=","users.id")->where('orders.CustomerID',$user)->get();
       
        $pdf = PDF::loadView('PDF',[ 'products'=>$products,'products1'=> $products1,'company'=> $company]);
        return $pdf->download('Ledger.pdf');
    }
    function getBillPdf($id){
        $id = $id;
        $company = companymaster::all();
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.order_id',$id)->get();
        
    
        $products1 = DB::table('orders')
        ->join('users','orders.CustomerID',"=","users.id")->where('orders.order_id',$id)->get();
       
        $pdf = PDF::loadView('BillPdf',[ 'products'=>$products,'products1'=> $products1,'company'=> $company])->setPaper('a4');;
        return $pdf->download('BillPdf.pdf');
    }



    public function mailindex()
    {
        
        $user = 1;
        $company = companymaster::all();
        $products = DB::table('orders')
          
        ->join('users','orders.CustomerID',"=","users.id")
        ->join('order_detail','orders.order_id',"=","order_detail.orders_id")
        ->join('products','order_detail.products_id',"=","products.product_id")->where('orders.CustomerID',$user)->get();
        
    
        $products1= DB::table('orders')
        ->join('users','orders.CustomerID',"=","users.id")->where('orders.user_id',$user)->get();
       
            $data["email"] = "divyapbagul@gmail.com";
    
            $data["title"] = "From ItSolutionStuff.com";
    
            $data["body"] = "This is Demo";
    
      
    
            // $pdf1 = PDF::loadView('emails.myTestMail', $data);
    
            $pdf = PDF::loadView('BillPdf',[ 'products'=>$products,'products1'=> $products1,'company'=> $company])->setPaper('a4');
    
            Mail::send('emails.myTestMail', $data, function($message)use($data, $pdf) {
    
                $message->to($data["email"], $data["email"])
    
                        ->subject($data["title"])
    
                        ->attachData($pdf->output(), "text.pdf");
    
            });
    
      
    
            dd('Mail sent successfully');
    
       
  

    }

}
