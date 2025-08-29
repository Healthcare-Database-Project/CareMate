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
        Schema::create('medicine_catalogue', function (Blueprint $table) {
            $table->id('medicine_id');
            $table->string('common_name')->unique();
            $table->string('generic_name');
            $table->string('med_type');
            $table->string('dosage');
            $table->decimal('price', total: 10, places: 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_catalogue');
    }
};
