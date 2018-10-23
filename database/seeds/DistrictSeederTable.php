<?php

use Illuminate\Database\Seeder;
use App\District;

class DistrictSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $district=new District();
        $district->province_id=1;
        $district->name='Rutsiro';
        $district->save();
        $district=new District();
        $district->province_id=1;
        $district->name='Rubavu';
        $district->save();
        $district=new District();
        $district->province_id=1;
        $district->name='Nyabihu';
        $district->save();
        $district=new District();
        $district->province_id=1;
        $district->name='Ngororero';
        
        $district->save();
        $district=new District();
        $district->province_id=1;
        $district->name='Rusizi';
        
        $district->save();
        $district=new District();
        $district->province_id=1;
        $district->name='Nyamasheke';
        
        $district->save();
        $district=new District();
        $district->province_id=1;
        $district->name='Karongi';
        
        $district->save();
        $district=new District();
        $district->province_id=2;
        $district->name='Kayonza';
        
        $district->save();
        $district=new District();
        $district->province_id=2;
        $district->name='Nyagatare';
        
        $district->save();
        $district=new District();
        $district->province_id=2;
        $district->name='Ngoma';
       
        $district->save();
        $district=new District();
        $district->province_id=2;
        $district->name='Rwamagana';
        
        $district->save();
        $district=new District();
        $district->province_id=2;
        $district->name='Bugesera';
        
        $district->save();
        $district=new District();
        $district->province_id=2;
        $district->name='Gatsibo';
        
        $district->save();
        $district=new District();
        $district->province_id=2;
        $district->name='Kirehe';
       
        $district->save();
        $district=new District();
        $district->province_id=3;
        $district->name='Nyamagabe';
        
        $district->save();
        $district=new District();
        $district->province_id=3;
        $district->name='Nyaruguru';
        
        $district->save();
        $district=new District();
        $district->province_id=3;
        $district->name='Huye';
        
        $district->save();
        $district=new District();
        $district->province_id=3;
        $district->name='Nyanza';
        
        $district->save();
        $district=new District();
        $district->province_id=3;
        $district->name='Ruhango';
        
        $district->save();
        $district=new District();
        $district->province_id=3;
        $district->name='Muhanga';
        
        $district->save();
        $district=new District();
        $district->province_id=3;
        $district->name='Kamonyi';
        
        $district->save();
        $district=new District();
        $district->province_id=3;
        $district->name='Gisagara';
        
        $district->save();
        $district=new District();
        $district->province_id=4;
        $district->name='Musanze';
        
        $district->save();
        $district=new District();
         $district->province_id=4;
        $district->name='Burera';
       
        $district->save();
        $district=new District();
        $district->province_id=4;
        $district->name='Gicumbi';
        
        $district->save();
        $district=new District();
        $district->province_id=4;
        $district->name='Gakenke';
        
        $district->save();
        $district=new District();
        $district->province_id=4;
        $district->name='Rulindo';
        
        $district->save();
        $district=new District();
        $district->province_id=5;
        $district->name='Kicukiro';       
        $district->save();
        $district=new District();
        $district->province_id=5;
        $district->name='Gasabo';
        
        $district->save();
        $district=new District();
        $district->province_id=5;
        $district->name='Nyarugenge';
        
        $district->save();
    }
}
