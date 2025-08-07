<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class HelperController extends Controller
{
    static function color($date){
        //dd($date);
        if($date->status <= 3){
            return 'status_work';
        }
        if($date->status == 4){
            return 'status_finish';
        }
        if($date->status >= 5){
            return 'status_close';
        }
        return null;
    }

    static function timer($date){
        if(!$date){return null;}

        $date = Carbon::parse($date)->diff(Carbon::now());

        return ($date->d ? $date->d.' дн. ' : null)
            .($date->h ? $date->h.' ч. ' : null)
            .(!$date->d && $date->i ? $date->i.' мин.' : null)
            ;
    }

    static function colorBorder($date){
        if($date->status <= 3){
            return 'border_work';
        }
        if($date->status == 4){
            return 'border_finish';
        }
        if($date->status >= 5){
            return 'border_close';
        }

        return null;
    }

    static function date($date){
        if($date == null){return null;}
        $datemonth = ['01' => 'января', '02' => 'февраля', '03' => 'марта',
            '04' => 'апреля', '05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
            '09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'];
        $month = date("m", strtotime($date));
        $day = date("d", strtotime($date));
        $year = date("Y", strtotime($date));
        return $day.' '.$datemonth[$month].' '.$year;
    }

    static function datetime($date){
        if($date == null){return null;}

        $date = Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateTimeString();

        $datemonth = ['01' => 'января', '02' => 'февраля', '03' => 'марта',
            '04' => 'апреля', '05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
            '09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'];
        $month = date("m", strtotime($date));
        $day = date("d", strtotime($date));
        $year = date("Y", strtotime($date));

        $hour = date("H", strtotime($date));
        $minute = date("i", strtotime($date));
        return $day.' '.$datemonth[$month].' '.$year.' в '.$hour.':'.$minute;
    }

    static function monthNum($date){
        if($date == null){return null;}

        $month = ['1' => 'января', '2' => 'февраля', '3' => 'марта',
            '4' => 'апреля', '5' => 'мая', '6' => 'июня', '7' => 'июля', '8' => 'августа',
            '9' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'];

        return ' '.$month[$date].' ';
    }

    static function monNum($date){
        if($date == null){return null;}

        $month = ['1' => 'янв', '2' => 'фев', '3' => 'март',
            '4' => 'апр', '5' => 'мая', '6' => 'июня', '7' => 'июля', '8' => 'авг',
            '9' => 'сен', '10' => 'окт', '11' => 'ноя', '12' => 'дек'];

        return ' '.$month[$date].' ';
    }

    static function datetime2($date){
        if($date == null){return null;}

        $date = Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateTimeString();

        $month = date("m", strtotime($date));
        $day = date("d", strtotime($date));
        $year = date("Y", strtotime($date));

        $hour = date("H", strtotime($date));
        $minute = date("i", strtotime($date));
        return $day.'.'.$month.'.'.$year.' в '.$hour.':'.$minute;
    }

    static function status($data){
        if($data == 1){return 'Обрабатывается';}
        if($data == 2){return 'Ожидает оплаты';}
        if($data == 3){return 'Передан в доставку';}
        if($data == 4){return 'Доставлен';}

        return null;
    }

    static function month($data)
    {
        if($data){
            return $data;
        }

        return Carbon::today()->month;
    }

    static function year($data)
    {
        if($data){
            return $data;
        }

        //dd(Carbon::today()->year);

        return Carbon::today()->year;
    }

    static function time($date){
        if($date == null){return null;}
        $h = date("H", strtotime($date));
        $i = date("i", strtotime($date));
        return $h.':'.$i;
    }

    static function phone($date){
        return '8 ХХХ ХХХ-'.substr($date, -4, 2).'-'.substr($date, -2);
    }

    static function dayOfWeek($data){
        if($data == 1){return 'Понедельник';}
        if($data == 2){return 'Вторник';}
        if($data == 3){return 'Среда';}
        if($data == 4){return 'Четверг';}
        if($data == 5){return 'Пятница';}
        if($data == 6){return 'Суббота';}
        if($data == 7){return 'Воскресенье';}

        return null;
    }

    static function rowTime($data){
        $start = '09:00';
        //$end = '12:30';

        $st = strtotime($start);
        $et = strtotime($data);

        $i = 0;
        while($st < $et) {
            $t = strtotime("+30 minute", $st);
            //echo date("H:i", $st)."-".date("H:i", $t).' - '.$i."<br>";
            $st = $t;
            $i++;
        }
        return $i + 2;
    }


}
