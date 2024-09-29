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
        Schema::create('subject_teacher_profile', function (Blueprint $table) {
            $table->foreignId('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreignId('teacher_profile_id')->references('id')->on('teacher_profiles')->onDelete('cascade');

            $table->unique(['subject_id', 'teacher_profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_teacher_profile_table');
    }
};
