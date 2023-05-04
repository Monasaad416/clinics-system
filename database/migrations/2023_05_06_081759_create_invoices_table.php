<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration {

	public function up()
	{
		Schema::create('invoices', function(Blueprint $table) {
			$table->id();
			$table->string('invoice_no');
			$table->unsignedBigInteger('reservation_id');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('price');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('invoices');
	}
}
