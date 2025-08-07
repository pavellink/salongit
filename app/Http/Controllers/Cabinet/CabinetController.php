<?php

namespace App\Http\Controllers\Cabinet;

use App\Models\BonusLvl;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use GreenSMS\GreenSMS;

class CabinetController
{
    public function index()
    {
        $user = Auth::user();

        //dd();
        if(strlen($user->phone) == 11){
            $user->phone = mb_substr( $user->phone, 1);
        }
        //dd($user);

        $lvl = BonusLvl::where('id', $user->bonus_lvl_id ?? 1)->first();

        return view('cabinet.index', [
            'user' => $user,
            'lvl' => $lvl
        ]);

    }

    public function call(){



    }

}
