<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProvinceSeederTable::class);
        $this->call(DistrictSeederTable::class);
        $this->call(StationsTableSeeder::class);
        $this->call(RolesSeederTable::class);
        $this->call(UsersTableSeeder::class);
        
    }
}
