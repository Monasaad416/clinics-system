<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration {

	public function up()
	{
		Schema::create('images', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->morphs('imagable');
			$table->string('uploads');
		});
	}

	public function down()
	{
		Schema::drop('images');
	}
}
