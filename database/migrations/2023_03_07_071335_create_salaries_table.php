<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration {

	public function up()
	{
		Schema::create('salaries', function(Blueprint $table) {
			$table->id();
			$table->morphs('salariable');
			$table->decimal('amount');
			$table->string('details');
			$table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('salaries');
	}
}
