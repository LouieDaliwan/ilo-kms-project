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
        Schema::create('wise_plus_activity_report', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wise_participant_id')->index()->nullable();
            $table->string('company_name')->index()->nullable();
            $table->string('representation')->index()->nullable();
            $table->string('venue')->index()->nullable();
            $table->string('action_checklist_type')->index()->nullable();
            $table->longText('good_points_identified')->nullable();
            $table->longText('points_to_be_improved')->nullable();
            $table->longText('action_item_1')->nullable();
            $table->longText('action_item_2')->nullable();
            $table->longText('action_item_3')->nullable();
            $table->longText('link_pictures')->nullable();
            $table->datetime('date_of_training')->nullable()->index();
            $table->date('ilo_timestamp')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wise_plus_activity_report');
    }
};
