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
        Schema::create('wise_participants_evaluation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wise_participant_id')->index()->nullable();
            $table->datetime('ilo_timestamp')->nullable()->index();
            $table->string('employer_or_worker')->index()->nullable();
            $table->longText('location')->nullable();
            $table->datetime('date_of_training')->nullable()->index();
            $table->longText('evaluation_answers')->nullable();
            $table->longText('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wise_participants_evaluation');
    }
};
