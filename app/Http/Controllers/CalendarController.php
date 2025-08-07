<?php

namespace App\Http\Controllers;

use App\Filters\ItemFilter;
use App\Models\Calendar;
use App\Models\Orders;
use App\Models\Shifts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController
{

    public function week(Request $request){

        if(!$request->master_id){
            return redirect()->route('calendar');
        } else {
            $master_id = $request->master_id;
        }

        if($request->date){
            $date = Carbon::parse($request->date);
            $prev = Carbon::parse($request->date);
            $next = Carbon::parse($request->date);
        } else {
            $date = Carbon::today();
            $prev = Carbon::today();
            $next = Carbon::today();
        }
        $week = $date->startOfWeek();
        $prevWeek = $prev->startOfWeek()->subWeek()->format('Y-m-d');
        //dd($prevWeek);
        $nextWeek = $next->startOfWeek()->addDays(7)->format('Y-m-d');
        //dd($nextWeek);
        //dd($week->format('Y-m-d'));

        $day = $request->day ? $request->day : $week->day;
        $month = $request->month ? $request->month : $week->month;
        $year = $request->year ? $request->year : $week->year;
        $day = Calendar::where('day', $day)->where('month', $month)->where('year', $year)->first();
        $master = $request->master_id;
        //dd($day);
        for($i = 0, $a = 0; $i < 23; $i++){
            $times[] = date("H:i", strtotime("today 9 hours 00 minutes + $a minutes"));
            $a += 30;
        }

        //echo $day->id;

        $minus = $day->id - ($day->day_of_week - 1);
        $plus = $day->id + (7 - $day->day_of_week);

        $days = Calendar::with(['shifts' => function ($q) use($master_id) {$q->with(['orders' => function ($q) {
            $q->whereNotNull('status');
        }, 'user'])->where('master_id', $master_id);}])
            ->whereBetween('id', [$minus, $plus])->get();

        $users = User::where('role', 20)->get();

        return view('calendar.week',[
            'times' => $times,
            'today_id' => null,
            'days' => $days,
            'prevWeek' => $prevWeek,
            'nextWeek' => $nextWeek,
            'week' => $week->format('Y-m-d'),
            'year' => $year,
            'users' => $users
        ]);
    }

    public function days(Request $request)
    {
        $today = Carbon::today();
        $dayOfMonth = $request->day ? $request->day : 1;
        $month = $request->month ? $request->month : $today->month;
        $year = $request->year ? $request->year : $today->year;

        //dd($year);

        $day = Calendar::where('day', $dayOfMonth)->where('month', $month)->where('year', $year)->first();


        $times = [];

        for($i = 0, $a = 0; $i < 23; $i++){
            $times[] = date("H:i", strtotime("today 9 hours 00 minutes + $a minutes"));
            $a += 30;
        }

        $days = Calendar::where('month', $month)->where('year', $year)->orderBy('day')->get();
        $shifts = Shifts::with(['orders' => function ($query) {
                $query->whereNotNull('status');
            }, 'user'])
            ->whereHas('user')
            ->where('day_id', $day->id)->get();
        //dd($days);
        //dd($orders);
       // dd($times);


        return view('calendar.day',[
            'dayOfMonth' => $dayOfMonth,
            'times' => $times,
            'days' => $days,
            'shifts' => $shifts
        ]);
    }

    public function index(Request $request)
    {
        $today = Carbon::today();
        $month = $request->month ? $request->month : $today->month;
        $year = $request->year ? $request->year : $today->year;

        //dd($month);
        $tempDate = Carbon::createFromDate($year, $month, 1);
        //dd($tempDate);
        $skip = $tempDate->copy()->startOfMonth()->dayOfWeek;
        //dd($skip);

        $next = [];
        $previous = [];

        $previous_day = $skip == 0 ? 6 : ($skip == 1 ? 0 : $skip - 1); // Учитываем начало недели с понедельника
        $skip = $previous_day;

        //dd($previous_day);
        //dd($skip);
        for($i = 0; $i < $skip; $i++)
        {
            $previous[] = [
                'day' => Carbon::create()->month($month)->year($year)->startOfMonth()->subDay($previous_day)->day,
                'month' => Carbon::create()->month($month)->year($year)->startOfMonth()->subDay($previous_day)->month

            ];

            $previous_day--;
        }

        //dd($previous);

        $collection = collect($previous);
        $previous = $collection->sort();
        $previous = $previous->toArray();

        $nextday = 1;
        for($i = (Carbon::create()->month($month)->year($year)->endOfMonth()->dayOfWeek == 0 ? 7 : Carbon::create()->month($month)->year($year)->endOfMonth()->dayOfWeek); $i < 7; $i++)
        {
            //dd(Carbon::create()->month($month)->year($year)->endOfMonth()->addDay()->day);
            $next[] = [
                'day' => Carbon::create()->month($month)->year($year)->endOfMonth()->addDay($nextday)->day,
                'month' => Carbon::create()->month($month)->year($year)->endOfMonth()->addDay($nextday)->month,
                'year' => Carbon::create()->month($month)->year($year)->endOfMonth()->addDay($nextday)->year
            ];
            $nextday++;
        }




        $days = Calendar::with('shifts.user')->where('month', $month)->where('year', $year)->orderBy('day')->get();

        //dd($days);

        return view('calendar.index',[
            'previous' => $previous,
            'days' => $days,
            'next' => $next,
        ]);
    }
}
