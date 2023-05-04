<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('phone');
			$table->string('email')->unique()->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('address')->nullable();
			$table->tinyInteger('how_know_us')->nullable();
			$table->string('file_no');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
