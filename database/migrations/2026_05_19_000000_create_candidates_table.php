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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_number');
            $table->string('name');
            $table->enum('gender', ['putra', 'putri']);
            $table->string('faculty');
            $table->string('photo_path');
            $table->text('bio')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable(); // stored as JSON or text
            $table->integer('current_votes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
