<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Hash;

class StatisticsController extends Controller
{
    private function getAttendance(){ 
        $data_absen = DB::table('absents')->get();

        $data = array();
        foreach($data_absen as $da){
            array_push($data, array(
                    'username' => DB::table('users')->where('id', $da->user_id)->value('username'),
                    'absents_note' => $da->absents_note,
                    'clock_in' => $da->clock_in,
                    'clock_out' => $da->clock_out,
                    'is_telat' => $da->is_telat,
                    'is_early' => $da->is_early,
                    'is_overwork' => $da->is_overwork,
                    'is_ontime' => $da->is_ontime,
                    'absents_date' => $da->absents_date 
                )
            );
        }
       
        return $data;
    }

    private function countStatisticEmployee(){
        $isLate = DB::table('absents')->where('is_telat','1')->count();
        $isOntime = DB::table('absents')->where('is_ontime','1')->count();
        $isEarly = DB::table('absents')->where('is_early','1')->count();
        $isOverwork = DB::table('absents')->where('is_overwork','1')->count();
        $data = array(
            'count_telat' => $isLate,
            'count_ontime' => $isOntime,
            'count_early' => $isEarly,
            'count_overwork' => $isOverwork
        );
        return $data;
    }

    private function getTimeLate(){
        $isLate = DB::table('absents')->where('is_telat','1')->get();
        $difference = 0 ;
        $start_time = Carbon::parse('08:00:00')->format('H:i:s');
        foreach($isLate as $late){
            $end_time = new Carbon($late->clock_in);
            $time_difference_in_minutes = $end_time->diffInMinutes($start_time);
            $difference =+ $time_difference_in_minutes;
        }
        return $difference;
    }

    private function getTimeEarly(){
        $isEarly = DB::table('absents')->where('is_early','1')->get();
        $difference = 0 ;
        $start_time = new Carbon('17:00:00');
        foreach($isEarly as $late){
            $end_time = new Carbon($late->clock_out);
            $time_difference_in_minutes = $end_time->diffInMinutes($start_time);
            $difference =+ $time_difference_in_minutes;
        }
        return $difference;
    }

    private function getTimeOverwork(){
        $isEarly = DB::table('absents')->where('is_overwork','1')->get();
        $difference = 0 ;
        $start_time = new Carbon('17:00:00');
        foreach($isEarly as $late){
            $end_time = new Carbon($late->clock_out);
            $time_difference_in_minutes = $end_time->diffInMinutes($start_time);
            $difference =+ $time_difference_in_minutes;
        }
        return $difference;
    }

    public function index(){
        $userID = Auth::user()->employee_data_id;
        $data = DB::table('employee')->where('id', $userID)->first(); 
        $dataAttendances = self::getAttendance();
        $statisticData = self::countStatisticEmployee();
        $timeData = array(
            'isLate' => self::getTimeLate(),
            'isOverwork' => self::getTimeOverwork(),
            "isEarly" => self::getTimeEarly()
        );
        $dataLabel = json_encode($statisticData);
        return view('Dashboard.statistics-ui', compact('data', 'dataAttendances', 'statisticData', 'timeData', 'dataLabel'));
    }
}
