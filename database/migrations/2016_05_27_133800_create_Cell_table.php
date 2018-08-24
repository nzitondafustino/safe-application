<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cell', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sectorId')->unsigned();
            $table->string('name');
            $table->timestamps();

            
            $table->foreign('sectorId')   ->  references('id')    ->  on('Sector')
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
        Schema::dropIfExists('Cell');
    }
}
