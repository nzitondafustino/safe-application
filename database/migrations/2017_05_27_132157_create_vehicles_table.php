<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accident_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('type')->nullable();
            $table->string('mark')->nullable();
            $table->string('plate')->nullable();
            $table->string('shasis')->nullable();
            $table->string('owner')->nullable();
            $table->string('ownerId')->nullable();
            $table->string('ownerLicence')->nullable();

            $table->integer('status')->default(1)->comment('1.hold 2.released 3.transfered');
            
            $table->string('amande')->nullable();

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
        Schema::dropIfExists('vehicles');
    }
}
