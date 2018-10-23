<?php

use Illuminate\Database\Seeder;
use App\Province;

class ProvinceSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $province=new Province();
        $province->name="West";
        $province->save();
        $province=new Province();
        $province->name="East";
        $province->save();
        $province=new Province();
        $province->name="South";
        $province->save();
        $province=new Province();
        $province->name="North";
        $province->save();
        $province=new Province();
        $province->name="Kigali city";
        $province->save();

    }
}
