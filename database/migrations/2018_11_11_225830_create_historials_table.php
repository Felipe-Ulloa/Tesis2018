<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sesion_id')->unsigned();
            $table->integer('asistencia_id')->unsigned();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->integer('institute_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('asistencia_id')->references('id')->on('asistences');
            $table->foreign('institute_id')->references('id')->on('institutions');
            $table->foreign('sesion_id')->references('id')->on('sessions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historials');
    }
}
