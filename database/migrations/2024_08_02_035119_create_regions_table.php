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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['Kota', 'Kabupaten']);
            $table->integer('population')->nullable();
            $table->decimal('area', 10, 2)->nullable(); // in square kilometers
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['name', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
