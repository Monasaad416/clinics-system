<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialistsTable extends Migration {

	public function up()
	{
		Schema::create('specialists', function(Blueprint $table) {
			$table->id();
			$table->string('name_en');
            $table->string('name_ar');
            $table->string('slug');
			$table->string('image')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('specialists');
	}
}
