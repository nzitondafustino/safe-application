<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=new Role();
        $role->name='DistrictAdmin';
        $role->save();
        $role=new Role();
        $role->name='ProvinceAdmin';
        $role->save();
        $role=new Role();
        $role->name='OverallAdmin';
        $role->save();


    }
}
