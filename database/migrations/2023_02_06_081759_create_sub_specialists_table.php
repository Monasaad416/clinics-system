<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubSpecialistsTable extends Migration {

	public function up()
	{
		Schema::create('sub_specialists', function(Blueprint $table) {
			$table->id();
			$table->string('name_en');
            $table->string('name_ar');
            $table->string('slug');
			$table->unsignedBigInteger('specialist_id');
            $table->foreign('specialist_id')->references('id')->on('specialists')
            ->cascadeOnDelete()
            ->cascadeOnDelete();
			$table->string('image')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('sub_specialists');
	}
}
