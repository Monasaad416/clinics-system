<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->id();
			$table->string('logo')->nullable();
			$table->string('favicon')->nullable();
			$table->string('phones')->nullable();
			$table->string('email')->nullable();
			$table->string('facebook')->nullable();
			$table->string('instagram')->nullable();
			$table->string('linkedin')->nullable();
			$table->string('twitter')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->text('address_en')->nullable();
            $table->text('address_ar')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
