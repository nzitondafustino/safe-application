<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provice_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('sector_id')->unsigned();
            $table->integer('cell_id')->unsigned();
            $table->integer('village_id')->unsigned();
            $table->timestamps();

            
            $table->foreign('provice_id')   ->  references('id') ->  on('provinces')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->foreign('district_id')   ->  references('id')->  on('districts')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->foreign('sector_id')   ->  references('id')  ->  on('sectors')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->foreign('cell_id')   ->  references('id')    ->  on('cells')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->foreign('village_id')   ->  references('id')    ->  on('villages')
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
        Schema::dropIfExists('addresses');
    }
}
