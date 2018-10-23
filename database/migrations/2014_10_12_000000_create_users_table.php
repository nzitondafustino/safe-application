<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('province_id')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('title');
            $table->string('password');

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('station_id')    ->  references('id')   ->  on('station')
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
        Schema::dropIfExists('users');
    }
}
