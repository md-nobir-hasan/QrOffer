<?php

namespace App\Http\Controllers;

use App\Models\OfferCode;
use App\Models\User;
use Illuminate\Http\Request;
use Xenon\LaravelBDSms\Facades\SMS;
use Twilio\Rest\Client;
class GetOfferController extends Controller
{
    public function qr(){
        $rn = rand(1,999999);
        OfferCode::create([
            'code'=>$rn,
        ]);
        $app_url = env('APP_URL');
        $n['url'] = "$app_url/public/qroffer/$rn";
        return view('pages.qr',$n);
    }
    public function infoCollect($ofrcode){
        if(OfferCode::where('code',$ofrcode)->first()){
            $n['ofrcode'] = $ofrcode;
            return view('pages.info',$n);
        }else{
             return abort(404);
        }

    }
    public function infoStore(Request $req){
        // dd($req->all());
        if(OfferCode::where('code',$req->offercode)->first()){
            $otp = rand(1,9999);
           $user =  User::create([
                'name'=>$req->name,
                'phone'=>$req->phone,
                'otp'=> $otp,
            ]);
            return redirect()->route('otpcheck',[$user->id]);
        }else{
             return abort(404);
        }

    }

    public function otpcheck($user_id){
        $n['user'] = User::findorFail($user_id);
        if($n['user']){
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_NUMBER");

            $client = new Client($account_sid, $auth_token);
           $sms =  $client->messages->create($n['user']->phone, ['from' => $twilio_number, 'body' => "OTP from  QROffer ".$n['user']->otp]);
           return view('pages.otp',$n);
        }else{
            return abort(404,"You don't login again");
        }
    }

    public function otpMatch(Request $req){
        $user = User::findorFail($req->user_id);
        // dd($user);
        if($user){
            if($user->otp == $req->otp){
                return redirect()->route('offer',[$user->id]);
            }
        }
        return abort(404);
    }
    public function offer($user_id){
        $user = User::findorFail($user_id);
        if($user){
           return view('pages.offer',['user'=>$user]);
        }
        return abort(404);
    }
}
