<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccidentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Accident', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('addressId')->unsigned();
            $table->integer('userId')->unsigned();
            $table->string('comment');

            $table->integer('status')->default(1)->comment('1.active 2.transmitted 3.closed');
            $table->integer('date');

            $table->integer('dead');
            $table->integer('injury');

            $table->timestamps();

            $table->unique(array("addressId", "userId","comment", "date", "dead", "injury"));

            $table->foreign('addressId')   ->  references('id') ->  on('Address')
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
        Schema::dropIfExists('Accident');
    }
}