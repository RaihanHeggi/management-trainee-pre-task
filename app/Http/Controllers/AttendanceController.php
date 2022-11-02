<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{   
    //Function to check check-out early or not
    private function isEarly($start_time, $end_time){
        if($start_time < $end_time){
            return '1';
        }
        return '0';
    }

    //Function to check check-in late or not
    private function isLate($start_time, $curr_time){
        if($curr_time > $start_time){
            return '1';
        }
        return '0';
    }

    //Function to check check-out late
    private function isOverwork($curr_time, $end_time){
        if($curr_time > $end_time){
            return '1';
        }
        return '0';
    }

    //Function to check check-out ontime
    private function isOntime($start_time, $end_time){
        if($start_time == $end_time){
            return '1';
        }
        return '0';
    }

    public function clock_in(Request $request){
        $start_time = Carbon::parse('08:00:00')->format('H:i:s');
        $curr_time = Carbon::now()->timezone('Asia/Jakarta')->format('H:i:s');
        $curr_date = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $user_id = Auth::user()->id;

        if(DB::table('absents')->where('user_id',$user_id)->where('absents_date',$curr_date)->exists()){
            return back()->with('error', 'Error Data Exist');
        }

        $data = array(
            'user_id' => $user_id,
            'absents_note' => $request->position,
            'clock_in' => $curr_time,
            'is_telat' => self::isLate($start_time, $curr_time),
            'is_early' => '0',
            'is_overwork' => '0',
            'is_ontime' => '0',
            'absents_date' => $curr_date
        );
        
        DB::table('absents')->insert($data);
        return redirect('attendance-clock');
    }

    public function clock_out(){
        $close_time =Carbon::parse('17:00:00')->format('H:i:s');
        $curr_time = Carbon::now()->timezone('Asia/Jakarta')->format('H:i:s');
        $curr_date = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $user_id = Auth::user()->id;

        $data_absen = DB::table('absents')->where('user_id',$user_id)->where('absents_date',$curr_date)->first();

        $data = array(
            'user_id' => $data_absen->user_id,
            'absents_note' => $data_absen->absents_note,
            'clock_in' => $data_absen->clock_in,
            'clock_out' => $curr_time,
            'is_telat' => $data_absen->is_telat,
            'is_early' => self::isEarly($curr_time, $close_time),
            'is_overwork' => self::isOverwork($curr_time, $close_time),
            'is_ontime' => self::isOntime($curr_time, $close_time),
            'absents_date' => $data_absen->absents_date
        );

        DB::table('absents')->where('id',$data_absen->id)->update($data);
        return redirect('attendance-clock');
    }
}
