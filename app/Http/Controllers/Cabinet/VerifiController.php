<?php

namespace App\Http\Controllers\Cabinet;

use App\Models\Bonuses;
use App\Models\Orders;
use App\Models\User;
use App\Traits\VerificationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class VerifiController
{
    use VerificationTrait;

    public function index(){
        $user = Auth::user();

        if($user->phone && strlen($user->phone) == 11){
            $user->phone = mb_substr( $user->phone, 1);
        }

        return view('cabinet.verifi', ['user' => $user]);
    }

    public function phone(Request $request){

        $phone = preg_replace('/^\+7/', '8', $request->phone);
        $phone = preg_replace("#[^0-9]#", "", $phone);

        if(strlen($phone) != 11){
            return ['error' => 'Неправильно указан номер'];
        }

        $this->callSendTrait($phone);

        return view('cabinet.modals.verifi', [
            'phone' => $phone
        ]);
    }

    public function phoneConfirm(Request $request){
        $code = (int) $request->code;
        $user = Auth::user();
        if($code == $user->verification_code){
            User::where('id', $user->id)->update([
                'phone_verified_at' => date('Y-m-d H:i:s')
            ]);
            return 1;
        }
        return ['message' => 'Неправильный код'];
    }

    public function userConfirm(Request $request){
        $user = Auth::user();
        if(!$user->phone_verified_at){
            return redirect()->back()->with('success', 'Телефон не подтвержден!');
        }
        $name = $request->name;
        $name2 = $request->name2;
        $email = $request->email;
        $e_null = $request->email ? null : 1;
        if(!$name){
            return redirect()->back()->with('success', 'Имя не заполнено!');
        }

        User::where('id', $user->id)->update([
            'full_name' => $name.' '.$name2,
            'name' => $name,
            'name2' => $name2,
            'email' => $email,
            'dob' => $request->dob,
            'email_null' => $e_null
        ]);

        $users = User::where('phone', $user->phone)->where('id', '!=', $user->id)->get();
        foreach ($users ?? [] as $old){
            Orders::where('user_id', $old->id)->update([
                'user_id' => $user->id,
            ]);

            Bonuses::where('user_id',  $old->id)->update([
                'user_id' => $user->id,
            ]);

            User::where('id', $old->id)->delete();
        }

        User::where('id', $user->id)->update([
            'update_bonus' => 1,
            'update_lvl' => 1
        ]);

        $dr = Cookie::get('dr');
        //dd($dr);
        if($dr && !$user->dob_bonus){
            return redirect($dr);
        }

        return redirect()->route('cabinet');
    }

    public function vk(Request $request){
        if($request->dr){
            Cookie::queue('dr', '/dr-500', 14400);
        }
        return Socialite::driver('vkontakte')->redirect();
    }

    public function vkCallback(Request $request){
        $user = Socialite::driver('vkontakte')->user();

        //dd($user);

        $email = $user->getEmail();
        $name = $user->getName();
        $avatar = $user->getAvatar();
        $eNull = null;

        $password = Hash::make(rand(10000000,99999999));
        if(!$email){
            $email = $user->getId().'@ku-salon.ru';
            $eNull = 1;
        }


        $u = User::firstOrCreate([
            'vk_id' => $user->getId(),
        ],[
            'email' => $email,
            'full_name' => $name,
            'password' => $password,
            'name' => $user->user['first_name'],
            'name2' => $user->user['last_name'],
            'email_null' => $eNull
        ]);

        Auth::login($u);



        if(!$u->phone_verified_at){
            return redirect()->route('verifi');
        } else {
            $dr = Cookie::get('dr');
            //dd($dr);
            if($dr){
                return redirect($dr);
            } else {
                return redirect()->route('cabinet');
            }
        }




        //dd($user);
    }
}
