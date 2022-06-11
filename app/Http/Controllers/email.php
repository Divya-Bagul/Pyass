<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\sendmail;

class email extends Controller
{
    //


    function email(Request $req){

//dd($req->email);

        $data = DB::table('email')->insert([
            "sub_email"=>$req->email
        ]);
        if($data){
            return 'success';
        }else{
            return "failed";
        }
    }
    function send(Request $req){
        $data = array(
            'name'      =>  'divya',
            'message'   =>   'hello world'
        );

      Mail::to('divyapbagul@gmail.com')->send(new SendMail($data));
     return 'success';

    }
}
