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
        Schema::create('grade_teacher_profile', function (Blueprint $table) {
            $table->foreignId('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreignId('teacher_profile_id')->references('id')->on('teacher_profiles')->onDelete('cascade');

            $table->unique(['grade_id', 'teacher_profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_teacher_profile');
    }
};
