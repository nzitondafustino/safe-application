<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Sector', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('districtId')->unsigned();
            $table->string('name');
            $table->timestamps();
            
            $table->foreign('districtId')   ->  references('id')    ->  on('District')
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
        Schema::dropIfExists('Sectors');
    }
}
