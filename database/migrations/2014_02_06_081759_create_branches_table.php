<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration {

	public function up()
	{
		Schema::create('branches', function(Blueprint $table) {
			$table->id();
			$table->string('name_en');
            $table->string('name_ar');
            $table->string('slug')->unique( );
			$table->string('address_en');
            $table->string('address_ar');
			$table->decimal('lattitude', 10,8)->nullable();
			$table->decimal('longitude', 10,8)->nullable();
			$table->string('phones');
			$table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('branches');
	}
}
