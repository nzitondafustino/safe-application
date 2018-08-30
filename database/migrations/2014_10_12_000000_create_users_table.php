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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('title');
            $table->integer('type')->default(2)->comment('1.admin 2. user');
            $table->string('password');

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('station_id')    ->  references('id')    ->  on('Station')
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
