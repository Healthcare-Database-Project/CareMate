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
        Schema::create('health_info', function (Blueprint $table) {
            $table->id('info_id');
            $table->date('date_of_recording');
            $table->time('time_of_recording');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('patient_id')->on('patient');
        });

        Schema::create('medicine_log', function(Blueprint $table) {
            $table->unsignedBigInteger('mlog_id');
            $table->index('mlog_id');
            $table->foreign('mlog_id')->references('info_id')->on('health_info');
            $table->unsignedBigInteger('medicine_id');
            $table->foreign('medicine_id')->references('medicine_id')->on('medicine_catalogue');
            $table->date('prescription_start_date');
            $table->date('prescription_end_date');
        });

        Schema::create('blood_sugar_level', function(Blueprint $table){
            $table->unsignedBigInteger('b_sugar_id');
            $table->index('b_sugar_id');
            $table->foreign('b_sugar_id')->references('info_id')->on('health_info');
            $table->decimal('blood_sugar_level', total: 5, places:2);
        });

        Schema::create('blood_pressure', function(Blueprint $table){
            $table->unsignedBigInteger('bp_id');
            $table->index('bp_id');
            $table->foreign('bp_id')->references('info_id')->on('health_info');
            $table->string('blood_pressure');
        });

        Schema::create('body_temperature', function(Blueprint $table) {
            $table->unsignedBigInteger('bt_id');
            $table->index('bt_id');
            $table->foreign('bt_id')->references('info_id')->on('health_info');
            $table->decimal('blood_temperature', total:5, places:2);
        });

        Schema::create('illness', function(Blueprint $table) {
            $table->unsignedBigInteger('illness_id');
            $table->index('illness_id');
            $table->foreign('illness_id')->references('info_id')->on('health_info');
            $table->string('illness_name');
            $table->string('illness_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_log');
        Schema::dropIfExists('blood_pressure');
        Schema::dropIfExists('body_temperature');
        Schema::dropIfExists('illness');
        Schema::dropIfExists('blood_sugar_level');
        Schema::dropIfExists('health_info');
    }
};
