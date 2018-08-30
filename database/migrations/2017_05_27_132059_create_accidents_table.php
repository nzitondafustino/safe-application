<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accidents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('address_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('comment');

            $table->integer('status')->default(1)->comment('1.active 2.transmitted 3.closed');
            $table->integer('date');

            $table->integer('dead');
            $table->integer('injury');

            $table->timestamps();

            $table->foreign('address_id')   ->  references('id') ->  on('addresses')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->foreign('user_id')   ->  references('id')    ->  on('users')
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
        Schema::dropIfExists('accidents');
    }
}
