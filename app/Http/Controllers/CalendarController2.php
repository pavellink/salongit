<?php

namespace App\Http\Controllers;

use App\Filters\ItemFilter;
use App\Models\Calendar;
use App\Models\User;
use Carbon\Carbon;

class CalendarController2
{
    public function index(){

        $today = Carbon::today();

        echo '<h1 class="w3-text-teal"><center>' . $today->format('F Y') . '</center></h1>';

        //dd($today->year);

        $tempDate = Carbon::createFromDate(2023);

        echo '<table border="1" class = "w3-table w3-boarder w3-striped" style="width: 100%;">
           <thead><tr class="w3-theme">
           <th>Пн</th>
           <th>Вт</th>
           <th>Ср</th>
           <th>Чт</th>
           <th>Пт</th>
           <th>Сб</th>
           <th>Вс</th>
           </tr></thead>';

        $skip = $tempDate->dayOfWeek;

        for($i = 1; $i < $skip; $i++)
        {
            $tempDate->subDay();
        }


        //loops through month
        do
        {
            echo '<tr>';
            //loops through each week
            for($i=1; $i <= 7; $i++)
            {
                $day = Calendar::firstOrCreate(
                    [
                        'day' =>  $tempDate->day,
                        'month' =>  $tempDate->month,
                        'year' =>  $tempDate->year,
                        'day_of_week' => $tempDate->dayOfWeek == 0 ? 7 : $tempDate->dayOfWeek
                    ]
                );

                echo '<td><span class="date">';

                echo $tempDate->day.'('.$i.')';

                echo '</span></td>';

                $tempDate->addDay();
            }
            echo '</tr>';

        }while($tempDate->year);

        echo '</table>';

        return view('calendar.index',[

        ]);
    }
}
