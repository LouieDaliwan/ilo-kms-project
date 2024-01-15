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
        Schema::create('score_indicator_three', function (Blueprint $table) {
            $table->id();
            $table->integer('is_read_privacy_statement')->index()->default(0);
            $table->string('gender')->index();
            $table->string('type_of_sector')->index()->nullable();
            $table->string('years_current_workplace')->index()->nullable();
            $table->string('job_function')->index()->nullable();
            $table->dateTime('ilo_timestamp')->index()->nullable();
            $table->longText('questions_answer')->nullable();
            $table->longText('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_indicator_three');
    }
};
