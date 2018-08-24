<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Vehicle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accidentId')->unsigned();
            $table->integer('userId')->unsigned();
            $table->string('type')->nullable();
            $table->string('mark')->nullable();
            $table->string('category')->nullable();
            $table->string('plate')->nullable();
            $table->string('shasis')->nullable();
            $table->string('owner')->nullable();

            $table->integer('status')->default(1)->comment('1.hold 2.released 3.transfered');
            
            $table->string('amande')->nullable();

            $table->timestamps();
            $table->foreign('accidentId')  ->  references('id') ->  on('Accident')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->foreign('userId')   ->  references('id')    ->  on('User')
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
        Schema::dropIfExists('Vehicle');
    }
}
