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
        // Create Appointment table according to ER diagram
        Schema::create('appointment', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->enum('appointment_status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('serial_no')->nullable();
            
            $table->foreign('doctor_id')->references('doctor_id')->on('doctor')->onDelete('cascade');
            $table->foreign('patient_id')->references('patient_id')->on('patient')->onDelete('cascade');
            $table->foreign('admin_id')->references('admin_id')->on('admin')->onDelete('set null');
            
            $table->timestamps();
        });

        // Create Health_Info table
        Schema::create('health_info', function (Blueprint $table) {
            $table->id('info_id');
            $table->date('date_of_recording');
            $table->time('time_of_recording');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('patient_id')->on('patient')->onDelete('cascade');
            $table->timestamps();
        });

        // Create Illness table
        Schema::create('illness', function (Blueprint $table) {
            $table->id('illness_id');
            $table->string('illness_name');
            $table->string('illness_type');
            $table->timestamps();
        });

        // Create has_illness table
        Schema::create('has_illness', function (Blueprint $table) {
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('illness_id');
            $table->date('diagnosis_date')->nullable();
        
            $table->foreign('patient_id')->references('patient_id')->on('patient')->onDelete('cascade');
            $table->foreign('illness_id')->references('illness_id')->on('illness')->onDelete('cascade');
        
            $table->primary(['patient_id', 'illness_id']);
        });


        // Create Medicine_Log table
        Schema::create('medicine_log', function (Blueprint $table) {
            $table->unsignedBigInteger('mlog_id');
            $table->unsignedBigInteger('medicine_id');
            $table->date('prescription_start_date');
            $table->date('prescription_end_date');
            
            $table->foreign('mlog_id')->references('info_id')->on('health_info')->onDelete('cascade');
            $table->foreign('medicine_id')->references('medicine_id')->on('medicine_catalogue')->onDelete('cascade');
            
            $table->primary(['mlog_id', 'medicine_id']);
            $table->timestamps();
        });

        // Create Blood_Sugar_Level table
        Schema::create('blood_sugar_level', function (Blueprint $table) {
            $table->unsignedBigInteger('b_sugar_id');
            $table->decimal('blood_sugar_level', 5, 2);
            
            $table->foreign('b_sugar_id')->references('info_id')->on('health_info')->onDelete('cascade');
            $table->primary('b_sugar_id');
            $table->timestamps();
        });

        // Create Blood_Pressure table
        Schema::create('blood_pressure', function (Blueprint $table) {
            $table->unsignedBigInteger('bp_id');
            $table->string('blood_pressure');
            
            $table->foreign('bp_id')->references('info_id')->on('health_info')->onDelete('cascade');
            $table->primary('bp_id');
            $table->timestamps();
        });

        // Create Body_Temperature table
        Schema::create('body_temperature', function (Blueprint $table) {
            $table->unsignedBigInteger('bt_id');
            $table->decimal('body_temperature', 5, 2);
            
            $table->foreign('bt_id')->references('info_id')->on('health_info')->onDelete('cascade');
            $table->primary('bt_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('body_temperature');
        Schema::dropIfExists('blood_pressure');
        Schema::dropIfExists('blood_sugar_level');
        Schema::dropIfExists('medicine_log');
        Schema::dropIfExists('illness');
        Schema::dropIfExists('health_info');
        Schema::dropIfExists('appointment');
    }
};
