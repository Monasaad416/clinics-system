<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubServiceTable extends Migration {

	public function up()
	{
		Schema::create('sub_service', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
			$table->string('name_en');
            $table->string('name_ar');
            $table->string('slug');
			$table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
			$table->decimal('price');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('sub_service');
	}
}
