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
        Schema::create('doctors', function(Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->index('doctor_id');
            $table->foreign('doctor_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->string('specialization');
        });

        Schema::create('doctor_schedule', function(Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->index('doctor_id');
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors')->onDelete('cascade');
            $table->string('day');
            $table->time('start_time');
            $table->index('start_time');
            $table->time('end_time');
        });

        Schema::create('hospital', function (Blueprint $table) {
            $table->id('hospital_id');
            $table->string('hospital_name');
            $table->text('hospital_address');
        });

        Schema::create('works_at', function(Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->index('doctor_id');
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors')->onDelete('cascade');
            $table->unsignedBigInteger('hospital_id');
            $table->index('hospital_id');
            $table->foreign('hospital_id')->references('hospital_id')->on('hospital')->onDelete('restrict');
        });

        Schema::create('has_access', function(Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->index('doctor_id');
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors')->onDelete('cascade');
            $table->unsignedBigInteger('info_id');
            $table->index('info_id');
            $table->foreign('info_id')->references('info_id')->on('health_info');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('doctor_schedule');
        Schema::dropIfExists('hospital');
        Schema::dropIfExists('works_at');
        Schema::dropIfExists('has_access');
    }
};
