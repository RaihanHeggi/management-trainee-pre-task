<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    private function isEarly($start_time, $end_time){
        if($start_time < $end_time){
            return '1';
        }
        return '0';
    }

    private function isLate($start_time, $curr_time){
        if($curr_time > $start_time){
            return '1';
        }
        return '0';
    }

    private function isOverwork($curr_time, $end_time){
        if($start_time > $end_time){
            return '1';
        }
        return '0';
    }

    private function isOntime($start_time, $end_time){
        if($start_time == $end_time){
            return '1';
        }
        return '0';
    }

    public function clock_in(Request $request){
        $start_time = new Carbon('08:00:00');
        $curr_time = Carbon::now()->format('H:i:m');
        dump($start_time);
        dump($curr_time);
        dd(self::isLate($start_time, $curr_time));
    }

    public function clock_out(){
        $close_time = new Carbon('17:00:00');
        $curr_time = Carbon::now()->format('H:i:m');
    }
}
