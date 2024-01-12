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
        Schema::create('score_indicator_two', function (Blueprint $table) {
            $table->id();
            $table->integer('is_read_privacy_statement')->index()->default(0);
            $table->string('gender')->index();
            $table->string('type_of_organization')->index()->nullable();
            $table->string('years_of_subject_training')->index()->nullable();
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
        Schema::dropIfExists('score_indicator_two');
    }
};
