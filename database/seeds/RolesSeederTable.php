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
        $role->name='user';
        $role->description="Normal User ";
        $role->save();
        $role=new Role();
        $role->name='district-admin';
        $role->description="District Admin ";
        $role->save();
        $role=new Role();
        $role->name='province-admin';
        $role->description="Province Admin ";
        $role->save();
        $role=new Role();
        $role->name='overall-admin';
        $role->description="Overall Admin ";
        $role->save();

    }
}
