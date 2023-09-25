<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use URL;
use Illuminate\Support\Str;

class CheckoutURLController extends Controller
{
    private $base_url;

    public function __construct()
    {
        // Sandbox
        // $this->base_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta';
        // Live
        $this->base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta';  
    }

    public function authHeaders(){
        return array(
            'Content-Type:application/json',
            'Authorization:' .$this->grant(),
            'X-APP-Key:'.env('4f6o0cjiki2rfm34kfdadl1eqq')
        );
    }
         
    public function curlWithBody($url,$header,$method,$body_data_json){
        $curl = curl_init($this->base_url.$url);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_POSTFIELDS, $body_data_json);
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function grant()
    {
        $header = array(
                'Content-Type:application/json',
                'username:'.env('01982846648'),
                'password:'.env('U#,snm7c6xM')
                );
        $header_data_json=json_encode($header);

        $body_data = array('app_key'=> env('InMzXZ8aF3ysxyQ698dg6JKztc'), 'app_secret'=>env('q8Hb8BNjynOJsk0bVxo6Mb5na8KOAnk5htVj9E3ZCbrUxkIY6ojb'));
        $body_data_json=json_encode($body_data);
    
        $response = $this->curlWithBody('/tokenized/checkout/token/grant',$header,'POST',$body_data_json);

        $token = json_decode($response)->id_token;

        return $token;
    }

    public function create(Request $request)
    {
        $header =$this->authHeaders();

        $website_url = URL::to("https://phplaravel-1028157-3625290.cloudwaysapps.com");

        $body_data = array(
            'mode' => '0011',
            'payerReference' => ' ',
            'callbackURL' => $website_url.'/api/bkash/callback',
            'amount' => $request->amount ? $request->amount : 10,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => "Inv".Str::random(8) // you can pass here OrderID 
        );
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/create',$header,'POST',$body_data_json);

        return $response;
    }

    public function execute($paymentID)
    {

        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID
        );
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/execute',$header,'POST',$body_data_json);

        $res_array = json_decode($response,true);

        return $response;
    }

    public function query($paymentID)
    {

        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID,
        );
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/payment/status',$header,'POST',$body_data_json);
        
        $res_array = json_decode($response,true);

         return $response;
    }

    public function callback(Request $request)
    {
        $allRequest = $request->all();

        if(isset($allRequest['status']) && $allRequest['status'] == 'success'){
                
            $response = $this->execute($allRequest['paymentID']);

            $arr = json_decode($response,true);
            
            if(array_key_exists("message",$arr)){
                // if execute api failed to response
                sleep(1);
                $response = $this->query($allRequest['paymentID']);
                $arr = json_decode($response,true);
            }

            if(array_key_exists("statusCode",$arr) && $arr['statusCode'] != '0000'){
                // your frontend failed route
                return redirect('https://phplaravel-1028157-3625290.cloudwaysapps.com/fail?data='.$arr['statusMessage']);
            }else{
                // response save to your db
                // your frontend success route
                return redirect('https://phplaravel-1028157-3625290.cloudwaysapps.com/success?data='.$arr['statusMessage']);
            }

        }else{
            // your frontend failed route
            return redirect('https://phplaravel-1028157-3625290.cloudwaysapps.com/fail');

        }

    }

    public function refund(Request $request)
    {
        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $request->paymentID,
            'amount' => $request->amount,
            'trxID' => $request->trxID,
            'sku' => 'sku',
            'reason' => 'Quality issue'
        );
     
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/payment/refund',$header,'POST',$body_data_json);
        
        // your database operation
        // save $response
        
        return $response;
    }        
    
}
