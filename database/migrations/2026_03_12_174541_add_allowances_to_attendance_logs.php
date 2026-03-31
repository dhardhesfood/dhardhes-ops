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
        Schema::table('attendance_logs', function (Blueprint $table) {

        $table->integer('extra_job_salary')->default(0)->after('daily_salary');

        $table->integer('meal_allowance')->default(0)->after('extra_job_salary');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_logs', function (Blueprint $table) {

        $table->dropColumn('extra_job_salary');
        $table->dropColumn('meal_allowance');
            //
        });
    }
};
