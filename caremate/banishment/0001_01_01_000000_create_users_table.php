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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique()->default('01700000000');
            $table->string('gender')->default('Female');
            $table->date('birth_date')->default('1990-01-01');
            $table->string('password');
            $table->enum('role', ['patient', 'doctor'])->default('patient');
            
            // Doctor-specific fields (nullable for patients)
            $table->string('specialization')->nullable();
            $table->integer('experience_years')->nullable();
            $table->string('location')->nullable();
            $table->decimal('consultation_fee', 8, 2)->nullable();
            $table->json('availability')->nullable();
            $table->text('bio')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('patients', function(Blueprint $table){
            $table->unsignedBigInteger('patient_id');
            $table->index('patient_id');
            $table->foreign('patient_id')->references('user_id')->on('users')->onDelete('cascade');
        });


        Schema::create('admins', function(Blueprint $table) {
            $table->unsignedBigInteger('admin_id');
            $table->index('admin_id');
            $table->foreign('admin_id')->references('user_id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
