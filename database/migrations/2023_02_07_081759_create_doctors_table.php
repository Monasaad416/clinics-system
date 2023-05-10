<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;


class CreateDoctorsTable extends Migration {

	public function up()
	{
		Schema::create('doctors', function(Blueprint $table) {
			$table->id();
			$table->string('name_en')->nullable();
            $table->string('name_ar');
			$table->string('phone');
			$table->string('email')->unique()->nullable();
			$table->tinyInteger('gender');
			$table->string('image')->nullable();
			$table->text('about_en')->nullable();
            $table->text('about_ar');
			$table->string('professional_image')->nullable();
			$table->string('title_image')->nullable();
			$table->unsignedBigInteger('branch_id')->nullable();
		    $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('specialist_id')->nullable();
		    $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('professional_title_id')->nullable();
            $table->foreign('professional_title_id')->references('id')->on('professional_titles')->onDelete('set null')->onUpdate('set null');
			$table->unsignedBigInteger('doctor_title_id')->nullable();
            $table->foreign('doctor_title_id')->references('id')->on('doctor_titles')->onDelete('set null')->onUpdate('set null');
			$table->decimal('fees');
			$table->decimal('salary');
			$table->decimal('discount_fees')->nullable();
			$table->enum('first_come',['yes','no']);
			$table->enum('stop_reservations',['yes','no']);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('doctors');
	}
}
