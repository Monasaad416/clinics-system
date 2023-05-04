<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalTitlesTable extends Migration {

	public function up()
	{
		Schema::create('professional_titles', function(Blueprint $table) {
			$table->id();
			$table->string('name_en');
            $table->string('name_ar');
			$table->string('slug');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('professional_titles');
	}
}
