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
            $table->unsignedBigInteger('wise_plus_activity_id')->index()->nullable();
            $table->string('company_name')->index();
            $table->string('representation')->index();
            $table->string('venue')->index();
            $table->string('action_checklist_type')->index();
            $table->longText('good_points_identified')->nullable();
            $table->longText('points_to_be_improved')->nullable();
            $table->longText('action_item_1')->nullable();
            $table->longText('action_item_2')->nullable();
            $table->longText('action_item_3')->nullable();
            $table->longText('link_pictures')->nullable();
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
