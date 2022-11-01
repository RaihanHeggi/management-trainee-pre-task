<?php

namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Carbon\Carbon;
 
class users_seed extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'employee_data_id' => DB::table('employee')->where('name',"Sya Raihan Heggi")->value('id'),
            'user_role' => 'Karyawan',
            'password' => Hash::make('123456'),
            'account_status' => 'active',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('users')->insert([
            'employee_data_id' => DB::table('employee')->where('name',"Admin Test")->value('id'),
            'user_role' => 'Admin',
            'password' => Hash::make('123456'),
            'account_status' => 'active',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}