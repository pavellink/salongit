<?php


namespace App\Http\Controllers;


use App\Models\Calendar;
use App\Models\Orders;
use App\Models\Shifts;
use Illuminate\Http\Request;

class ShiftController
{

    public function delete(Request $request){

        $check = Orders::where('shift_id', $request->shift_id)->where('master_id', $request->master_id)->whereNotNull('status')->first();

        if($check){
            return redirect()->back()->with('success', 'Для удаления мастара из смены - требуется перенести запись '.$check->title);
        }

        Shifts::where('id', $request->shift_id)->delete();

        return redirect()->back()->with('success', 'Мастер удален!');
    }

    public function times(Request $request){
        $times = Orders::where('shift_id', $request->shift_id)->orderBy('time_start')->whereNull('in_progress')->whereNotNull('status')->get();

        return view('orders.components.times', [
            'times' => $times
        ]);
    }

    public function whoWorks(Request $request){

        $m = date("m", strtotime($request->date));
        $d = date("d", strtotime($request->date));
        $y = date("Y", strtotime($request->date));

        $day = Calendar::where('day', $d)->where('month', $m)->where('year', $y)->first();
        //return $day;
        $users = Shifts::with('user')->where('day_id', $day->id)->get();
        //return $users;

        return view('modals.components.masters', [
           'users' => $users
        ]);
    }

    public function store(Request $request){

        Shifts::updateOrCreate([
            'day_id' => $request->day_id,
            'master_id' => $request->master_id,
        ]);

        return redirect()->back()->with('success', 'Мастер успешно добавлен!');
    }


}
