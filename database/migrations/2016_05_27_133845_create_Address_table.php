<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proviceId')->unsigned();
            $table->integer('districtId')->unsigned();
            $table->integer('sectorId')->unsigned();
            $table->integer('cellId')->unsigned();
            $table->integer('villageId')->unsigned();
            $table->timestamps();

            
            $table->foreign('proviceId')   ->  references('id') ->  on('Province')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->foreign('districtId')   ->  references('id')->  on('District')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->foreign('sectorId')   ->  references('id')  ->  on('Sector')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->foreign('cellId')   ->  references('id')    ->  on('Cell')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->foreign('villageId')   ->  references('id')    ->  on('Village')
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
        Schema::dropIfExists('Address');
    }
}
