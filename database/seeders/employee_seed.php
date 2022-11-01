<?php

namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Carbon\Carbon;
 
class employee_seed extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee')->insert([
            'name' => 'Sya Raihan Heggi',
            'department_id' => DB::table('department')->where('name','IT Department')->value('id'),
            'department_role' => 'Trainee',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('employee')->insert([
            'name' => 'Admin Test',
            'department_id' => DB::table('department')->where('name','IT Department')->value('id'),
            'department_role' => 'PM',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}