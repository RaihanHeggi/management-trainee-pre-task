<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class DashboardController extends Controller
{
    private function getAttendance($id){
        return DB::table('absents')->where('user_id',$id)->get();
    }

    private function countStatisticEmployee($id){
        $isLate = DB::table('absents')->where('user_id',$id)->where('is_telat','1')->count();
        $isOntime = DB::table('absents')->where('user_id',$id)->where('is_ontime','1')->count();
        $isEarly = DB::table('absents')->where('user_id',$id)->where('is_early','1')->count();
        $isOverwork = DB::table('absents')->where('user_id',$id)->where('is_overwork','1')->count();
        $data = array(
            'count_telat' => $isLate,
            'count_ontime' => $isOntime,
            'count_early' => $isEarly,
            'count_overwork' => $isOverwork
        );
        return $data;
    }

    private function getTimeLate($id){
        $isLate = DB::table('absents')->where('user_id',$id)->where('is_telat','1')->get();
        $difference = 0 ;
        $start_time = new Carbon('08:00:00');
        foreach($isLate as $late){
            $end_time = new Carbon($late->clock_in);
            $time_difference_in_minutes = $end_time->diffInMinutes($start_time);
            $difference =+ $time_difference_in_minutes;
        }
        return $difference;
    }

    private function getTimeEarly($id){
        $isEarly = DB::table('absents')->where('user_id',$id)->where('is_early','1')->get();
        $difference = 0 ;
        $start_time = new Carbon('17:00:00');
        foreach($isEarly as $late){
            $end_time = new Carbon($late->clock_out);
            $time_difference_in_minutes = $end_time->diffInMinutes($start_time);
            $difference =+ $time_difference_in_minutes;
        }
        return $difference;
    }

    private function getTimeOverwork($id){
        $isEarly = DB::table('absents')->where('user_id',$id)->where('is_overwork','1')->get();
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
        $dataAttendances = self::getAttendance($userID);
        $statisticData = self::countStatisticEmployee($userID);
        $timeData = array(
            'isLate' => self::getTimeLate($userID),
            'isOverwork' => self::getTimeOverwork($userID),
            "isEarly" => self::getTimeEarly($userID)
        );
        return view('Dashboard.Home', compact('data', 'dataAttendances', 'statisticData', 'timeData'));
    }

    public function index_admin(){
        $userID = Auth::user()->employee_data_id;
        $data = DB::table('employee')->where('id', $userID)->first();
        $data_user = DB::table('users')->get();
        return view('Dashboard.dashboard-admin-management', compact('data','data_user'));
    }
}
