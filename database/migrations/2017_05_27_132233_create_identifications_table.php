<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accident_id')->unsigned()->unique();
            $table->integer('user_id')->unsigned();
            $table->string('type')->unique();
            
            $table->string('number')->unique();
            $table->string('owner');
            $table->string('category')->nullable();
            
            $table->integer('status')->default(1)->comment('1.hold 2.releases');
            
            $table->double('amande');

            $table->timestamps();
            $table->foreign('accident_id')  ->  references('id') ->  on('accidents')
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
        Schema::dropIfExists('identifications');
    }
}
