<?php

namespace App\Traits;

use App\Models\User;
use GreenSMS\GreenSMS;
use Illuminate\Support\Facades\Auth;

trait VerificationTrait
{
    public function callSendTrait($phone){
        $user = User::where('id', Auth::id())->whereNull('phone_verified_at')->first();
        if($user){
            $now = \Carbon\Carbon::now();
            $totalDuration = $now->diffInSeconds(\Carbon\Carbon::parse($user->call_at));

            if(!$user->verification_code || $user->call_at && $totalDuration >= 60){

                $client = new GreenSMS([
                    'user' => 'pavellin',
                    'pass' => '12345678'
                ]);

                $response = $client->call->send([
                    'to' => $phone,
                ]);

                User::where('id', Auth::id())->update([
                    'verification_code' => $response->code,
                    'phone_verified_at' => null,
                    'phone' => $phone,
                    'call_at' => date('Y-m-d H:i:s')
                ]);

                return true;
            }
        }

        return false;
    }

    public function checkCodeTrait($code){
        $user = Auth::user();
        if($user && $user->verification_code == $code){
            User::where('id', $user->id)->update([
                'phone_verified_at' => date('Y-m-d H:i:s')
            ]);

            return ['check' => true];
        }
        return ['check' => false];
    }
}
