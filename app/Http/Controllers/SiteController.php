<?php

namespace App\Http\Controllers;

use App\Models\Bonuses;
use App\Models\Calendar;
use App\Models\OrderPre;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SiteController
{
    public function index(){

        return view('site.index', []);
    }

    public function great(Request $request){
        $item = OrderPre::where('id', $request->pre_id)->firstOrFail();

        return view('site.great', [
            'item' => $item
        ]);
    }

    public function dr500(){
        $services = Services::whereNull('parent_id')->whereNotNull('published')->orderBy('title')->get();

        $user = Auth::user();
        $dates = [];
        $now = Carbon::now();

        //dd($from);
        if($user && $user->dob){
            $dob = Carbon::parse($user->dob);
            $dob = Carbon::parse($dob->day.'-'.$dob->month.'-'.$now->year);
            $from = Carbon::parse($dob)->subDays(3)->format('Y-m-d');
            $to = Carbon::parse($dob)->addDays(10)->format('Y-m-d');

            $period = CarbonPeriod::create($from, $to);
            $dates = $period->toArray();
        }

        //dd($dates);

        return view('site.dr_500', [
            'services' => $services,
            'dates' => $dates,
            'now' => $now
        ]);
    }

    public function getDr500(){
        $user = Auth::user();

        if(!$user){
            return redirect()->back()->with('success', 'Требуется авторизоваться на сайте!');
        }
        if(!$user->dob){
            return redirect()->back()->with('success', 'Не указана дата рождения!');
        }

        $now = Carbon::now();
        $dob = Carbon::parse($user->dob);
        //dd($dob->day);
        $dob = Carbon::parse($dob->day.'-'.$dob->month.'-'.$now->year);

        //dd($fu);
        $diff = $dob->diffInDays($now);

        if($diff <= 7 && $now >= $dob || $diff <= 7 && $now <= $dob){
            if($user->dob_bonus){
                return redirect()->back()->with('success', 'Бонусы уже получены, теперь выберите услугу и запишитесь!');
            } else {
                User::where('id', $user->id)->update([
                    'dob_bonus' => 1,
                    'dob_bonus_at' => date('Y-m-d'),
                    'update_bonus' => 1
                ]);

                Bonuses::insert([
                    'user_id' => $user->id,
                    'title' => '500 бонусов на День Рождения!',
                    'count' => 500,
                    'status_id' => 1,
                    'finish_at' => $dob->addDays(10),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        } else {
            return redirect()->back()->with('success', 'Ваша дата дня рождения не попадает в указанный диапазон акции! Если вы считаете что произошла ошибка - напишите в ватсап +79097340208');
        }

        return redirect()->back()->with('success', 'Бонусы получены, теперь выберите услугу и запишитесь!');


        //dd($diff);

    }

    public function preOrder(Request $request){
        $user = Auth::user();
        if(!$user){
            return redirect()->back()->with('success', 'Ошибка авторизации!');
        }
        $phone = $user->phone;
        $services = $request->service_id;
        $date = $request->date_at;

        $id = OrderPre::insertGetId([
            'user_id' => $user->id,
            'title' => 'Запись через акцию - День Рождения',
            'service_id' => (int) $request->service_id,
            'date_at' => $date,
            'status_id' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('great', [
            'pre_id' => $id,

        ]);
    }


    public function toggleAside(){

        //Cookie::queue('key2', '123');

        $item = Cookie::get('aside');
        //return $item;

        if($item){
            // если есть скрываем
            Cookie::queue('aside', null, 262800);
            return 1;
        } else {
            Cookie::queue('aside', 1, 262800);
            return 2;
        }
    }
}
