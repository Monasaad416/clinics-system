<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration {

	public function up()
	{
		Schema::create('services', function(Blueprint $table) {
			$table->id();
			$table->string('name_en');
            $table->string('name_ar');
            $table->string('slug');
			$table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            // $table->unsignedBigInteger('branch_id')->nullable();
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('specialist_id')->nullable();
            $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('services');
	}
}
