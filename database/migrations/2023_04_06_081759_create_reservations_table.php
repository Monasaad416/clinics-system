<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration {

	public function up()
	{
		Schema::create('reservations', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('branch_id');
			$table->string('number');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
			$table->time('time')->nullable();
			$table->date('date')->nullable();
			$table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('sub_specialist_id')->nullable();
            $table->foreign('sub_specialist_id')->references('id')->on('sub_specialists')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('specialist_id');
            $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('cascade')->onUpdate('cascade');
			$table->enum('status', array('pending', 'completed', 'canceled','absent'));
			$table->enum('type', array('first_visit', 'sec_visit'));
			$table->text('notes')->nullable();
			$table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('set null')->onUpdate('set null');
			$table->string('insurance')->nullable();
            $table->decimal('insurance_discount')->nullable()->default(0);
            $table->decimal('insurance_percentage')->nullable()->default(0);
			$table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('reservation_price')->nullable()->default(0);
            $table->decimal('services_price')->nullable()->default(0);
            $table->decimal('final_price')->nullable()->default(0);
			$table->string('appointment_notes')->nullable();
			$table->timestamps();
            });
	}

	public function down()
	{
		Schema::drop('reservations');
	}
}
