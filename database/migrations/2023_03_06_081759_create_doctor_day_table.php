<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorDayTable extends Migration {

	public function up()
	{
		Schema::create('doctor_day', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('day_id');
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade')->onUpdate('cascade');
			$table->time('from');
			$table->time('to');
			$table->tinyInteger('no_of_reservations');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('doctor_day');
	}
}
