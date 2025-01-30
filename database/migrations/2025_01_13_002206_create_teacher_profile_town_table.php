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
        Schema::create('teacher_profile_town', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_profile_id')->constrained();
            $table->foreignId('town_id')->constrained();

            $table->unique(['teacher_profile_id', 'town_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_profile_town_table');
    }
};
