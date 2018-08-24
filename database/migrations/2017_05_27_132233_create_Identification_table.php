<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Identification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accidentId')->unsigned()->unique();
            $table->integer('userId')->unsigned();
            $table->string('type')->unique();
            
            $table->string('number')->unique();
            $table->string('owner');
            $table->string('category')->nullable();
            
            $table->integer('status')->default(1)->comment('1.hold 2.releases');
            
            $table->double('amande');

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
        Schema::dropIfExists('Identification');
    }
}
