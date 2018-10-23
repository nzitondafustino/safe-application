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
            $table->integer('user_id')->unsigned();
            $table->integer('province_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('sector_id')->unsigned();

            
            $table->foreign('province_id')   ->  references('id') ->  on('provinces')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->foreign('district_id')   ->  references('id')->  on('districts')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->foreign('sector_id')   ->  references('id')  ->  on('sectors')
                                                                ->  onDelete('restrict')
                                                                ->  onUpdate('cascade');
            $table->string('comment');

            $table->integer('status')->default(1)->comment('1.active 2.transmitted 3.closed');
            $table->integer('date');

            $table->integer('dead');
            $table->integer('injury');

            $table->timestamps();

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
