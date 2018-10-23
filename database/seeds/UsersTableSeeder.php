<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new User();
        $user->district_id=30;
        $user->province_id=5;
        $user->station_id=1;
        $user->name='Admin';
        $user->email='Admin@app.com';
        $user->phone='+250781153772';
        $user->title='Private';
        $user->password= bcrypt('secret');
        $user->save();
        $user->roles()->attach(4);

    }
}
