<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_bookings', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('branch_id');
			$table->string('number');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
			$table->time('time')->nullable();
			$table->date('date')->nullable();
			$table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('sub_specialist_id')->nullable();
            $table->foreign('sub_specialist_id')->references('id')->on('sub_specialists')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('specialist_id');
            $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
			$table->enum('status', array('pending', 'completed', 'canceled','absent'));
			$table->text('notes')->nullable();
			$table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('set null')->onUpdate('set null');
			$table->string('insurance')->nullable();
            $table->decimal('insurance_discount')->nullable()->default(0);
            $table->decimal('insurance_percentage')->nullable()->default(0);
			$table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('service_price');
            $table->decimal('final_price');
			$table->string('appointment_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_bookings');
    }
};
