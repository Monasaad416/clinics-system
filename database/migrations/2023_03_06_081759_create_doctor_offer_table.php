<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorOfferTable extends Migration {

	public function up()
	{
		Schema::create('doctor_offer', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('doctor_offer');
	}
}
