<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class absents_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('absents')->insert([
            'user_id' => DB::table('users')->where('id', 1)->value('id'),
            'absents_note' => 'WFH',
            'clock_in' => '08:00:00',
            'clock_out' => '17:00:00',
            'is_telat' => '0',
            'is_overwork' => '0',
            'is_early' => '0',
            'is_ontime' => '1',
            'absents_date' => '2022-11-01'
        ]);

        DB::table('absents')->insert([
            'user_id' => DB::table('users')->where('id', 1)->value('id'),
            'absents_note' => 'WFO',
            'clock_in' => '09:00:00',
            'clock_out' => '17:00:00',
            'is_telat' => '1',
            'is_overwork' => '0',
            'is_early' => '0',
            'is_ontime' => '0',
            'absents_date' => "2022-11-03"
        ]);

        DB::table('absents')->insert([
            'user_id' => DB::table('users')->where('id', 1)->value('id'),
            'absents_note' => 'WFH',
            'clock_in' => '08:00:00',
            'clock_out' => '18:00:00',
            'is_telat' => '0',
            'is_overwork' => '1',
            'is_early' => '0',
            'is_ontime' => '0',
            'absents_date' => "2022-11-02"
        ]);

    }
}
