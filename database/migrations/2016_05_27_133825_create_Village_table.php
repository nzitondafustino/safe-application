<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Village', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cellId')->unsigned();
            $table->string('name');
            $table->timestamps();

            
            $table->foreign('cellId')   ->  references('id')    ->  on('Cell')
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
        Schema::dropIfExists('Village');
    }
}
