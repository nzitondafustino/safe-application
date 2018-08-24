<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('District', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provinceId')->unsigned();
            $table->string('name')->unique();
            $table->timestamps();

            
            $table->foreign('provinceId')    ->  references('id')    ->  on('Province')
                                                                    ->  onDelete('restrict')
                                                                    ->  onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('District');
    }
}
