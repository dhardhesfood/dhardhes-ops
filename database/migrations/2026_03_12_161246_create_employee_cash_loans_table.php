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
        Schema::create('employee_cash_loans', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('employee_id');

            $table->date('loan_date');

            $table->integer('amount');

            $table->integer('paid_amount')->default(0);

            $table->integer('remaining_amount');

            $table->text('note')->nullable();

            $table->string('status')->default('active');

            $table->timestamps();

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_cash_loans');
    }
};