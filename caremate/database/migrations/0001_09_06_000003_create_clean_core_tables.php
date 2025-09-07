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
        // Create User table according to ER diagram
        Schema::create('users', function (Blueprint $table) {
            $table->id('users_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['patient', 'doctor', 'admin'])->default('patient');
            $table->rememberToken();
            $table->timestamps();
        });

        // Create Admin table according to ER diagram
        Schema::create('admin', function (Blueprint $table) {
            $table->id('admin_id');
            $table->unsignedBigInteger('users_id');
            $table->string('admin_level');
            $table->string('department');
            
            $table->foreign('users_id')->references('users_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Create Patient table according to ER diagram
        Schema::create('patient', function (Blueprint $table) {
            $table->id('patient_id');
            $table->unsignedBigInteger('users_id');
            $table->string('phone');
            $table->integer('age');
            $table->enum('sex', ['Male', 'Female', 'Other']);
            $table->text('address');
            $table->text('medical_history')->nullable();
            $table->string('blood_group');
            $table->string('emergency_contact');
            
            $table->foreign('users_id')->references('users_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Create Hospital table according to ER diagram
        Schema::create('hospital', function (Blueprint $table) {
            $table->id('hospital_id');
            $table->string('hospital_name');
            $table->string('location');
            $table->string('phone');
            $table->string('email');
            $table->string('type');
            $table->timestamps();
        });

        // Create Doctor table according to ER diagram
        Schema::create('doctor', function (Blueprint $table) {
            $table->id('doctor_id');
            $table->unsignedBigInteger('users_id');
            $table->string('bmdc_reg_no')->unique();
            $table->string('specialization');
            $table->integer('years_of_experience');
            $table->decimal('consultation_fee', 10, 2);
            $table->string('education');
            $table->string('phone');
            
            $table->foreign('users_id')->references('users_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Create Doctor Schedule table according to ER diagram
        Schema::create('doctor_schedule', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->unsignedBigInteger('doctor_id');
            $table->enum('day_of_week', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('max_appointments');
            
            $table->foreign('doctor_id')->references('doctor_id')->on('doctor')->onDelete('cascade');
            $table->timestamps();
        });

        // Create Works_At relationship table (Doctor works at Hospital)
        Schema::create('works_at', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('hospital_id');
            
            $table->foreign('doctor_id')->references('doctor_id')->on('doctor')->onDelete('cascade');
            $table->foreign('hospital_id')->references('hospital_id')->on('hospital')->onDelete('cascade');
            
            $table->primary(['doctor_id', 'hospital_id']);
            $table->timestamps();
        });

        // Create Has_Access relationship table (Admin has access to Hospital)
        Schema::create('has_access', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('hospital_id');
            
            $table->foreign('admin_id')->references('admin_id')->on('admin')->onDelete('cascade');
            $table->foreign('hospital_id')->references('hospital_id')->on('hospital')->onDelete('cascade');
            
            $table->primary(['admin_id', 'hospital_id']);
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('has_access');
        Schema::dropIfExists('works_at');
        Schema::dropIfExists('doctor_schedule');
        Schema::dropIfExists('doctor');
        Schema::dropIfExists('hospital');
        Schema::dropIfExists('patient');
        Schema::dropIfExists('admin');
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
