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
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')
                ->constrained('owner_pets')
                ->onDelete('cascade');
            $table->string('name_pet', 30);
            $table->string('specie');
            $table->string('breed', 15);
            $table->enum('gener', ['M', 'F'])->nullable();
            $table->date('date_birth')->nullable();
            $table->text('medical_history')->nullable();
            $table->string('imagen', 70)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
