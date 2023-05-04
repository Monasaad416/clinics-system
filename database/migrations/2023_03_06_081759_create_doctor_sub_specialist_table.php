<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorSubSpecialistTable extends Migration {

	public function up()
	{
		Schema::create('doctor_sub_specialist', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->unsignedBigInteger('doctor_id');
			$table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('sub_specialist_id');
			$table->foreign('sub_specialist_id')->references('id')->on('sub_specialists')->onDelete('cascade')->onUpdate('cascade');


		});
	}

	public function down()
	{
		Schema::drop('doctor_sub_specialist');
	}
}
