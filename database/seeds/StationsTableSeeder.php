<?php

use Illuminate\Database\Seeder;
use App\Station;
class StationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $station=new Station();
        $station->district_id=30;
        $station->name="Nyarugenge Police Station";
        $station->save();
    }
}
