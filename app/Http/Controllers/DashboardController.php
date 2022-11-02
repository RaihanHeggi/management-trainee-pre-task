<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Hash;



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
        $start_time = Carbon::parse('08:00:00')->format('H:i:s');
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

    public function delete_data($id){
        // DB::table('users')->where('id',$id)->delete();

        // implement soft-deletions 
        $data = array(
            'account_status' => 'inactive'
        );
        DB::table('users')->where('id', $id)->update($data);
        return redirect('dashboard-admin')->with('success', 'Account Has Been Deactivated');
    }


    //Function Related To Index

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

    public function index_tambah_user(){
        $userID = Auth::user()->employee_data_id;
        $data = DB::table('employee')->where('id', $userID)->first();
        $data_department = DB::table('department')->get();
        return view('Dashboard.adminManagement.tambah-ui', compact('data', 'data_department'));
    }

    public function index_edit($id){
        $userID = Auth::user()->employee_data_id;
        $data = DB::table('employee')->where('id', $userID)->first();
        $dataUser = DB::table('users')->where('id',$id)->first();
        $data_employee = DB::table('employee')->where('id', DB::table('users')->where('id', $id)->value('employee_data_id'))->first();
        $data_department = DB::table('department')->get();
        return view('Dashboard.adminManagement.edit-ui', compact('data','dataUser','data_employee', 'data_department'));
    }

    public function index_attendance(){
        $userID = Auth::user()->employee_data_id;
        $data = DB::table('employee')->where('id', $userID)->first();
        $curr_time =  Carbon::parse(Carbon::now()->timezone('Asia/Jakarta'))->format('Y-m-d');
        $clock_in_data = DB::table('absents')->where('user_id',Auth::user()->id)->whereDate('absents_date','=', $curr_time)->value('clock_in') ?? "No Data Recorded";
        $clock_out_data = DB::table('absents')->where('user_id',Auth::user()->id)->whereDate('absents_date','=', $curr_time)->value('clock_out') ?? "No Data Recorded";
        
        return view('Dashboard.attendance-ui', compact('data','clock_in_data','clock_out_data'));
    }


    //Add or Modify Users Data
    public function insert_data_user(Request $request){
        if( DB::table('employee')->where('name', $request->nama)->exists() || DB::table('users')->where('username', $request->username)->exists()){
            return back()->with('error', 'Error Data Exist');
        }

        $employeeData = array(
            'name' => $request->nama,
            'department_id' => $request->department,
            'department_role' => $request->position,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );

        DB::table('employee')->insert($employeeData); 

        $userData = array(
            'employee_data_id' => DB::table('employee')->where('name', $request->nama)->value('id'),
            'username' => $request->username,
            'password' => $request->password,
            'user_role' => $request->role_user,
            'account_status' => 'active',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        );

        DB::table('users')->insert($userData);
        return redirect('add-user')->with('success', 'User Created');
    }

    public function update_data(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $employee_id = DB::table('users')->where('username', $request->username)->value('employee_data_id');
        $employeeData = array(
            'name' => $request->nama,
        );

        DB::table('employee')->where('id',$employee_id)->update($employeeData); 

        $userData = array(
            'employee_data_id' =>  $employee_id ,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'user_role' => $request->role_user,
            'account_status' => $request->account_status,
            'updated_at' => Carbon::now(),

        );

        DB::table('users')->where('username',$request->username)->update($userData);
        return redirect('dashboard-admin')->with('success', 'User Updated');
    }
}