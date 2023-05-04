<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->id();
			$table->string('title_en');
            $table->string('title_ar');
            $table->string('slug');
			$table->text('description_en');
            $table->text('description_ar');
			$table->string('image');
			$table->date('from_date');
			$table->date('to_date');
			$table->decimal('price');
			$table->decimal('discount_price')->default(0);
			$table->integer('discount_percentage')->default(0);
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}
