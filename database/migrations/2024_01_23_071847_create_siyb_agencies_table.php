<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('siyb_agencies', function (Blueprint $table) {
            $table->id();
            $table->string('batch_code')->unique()->index();
            $table->string('name');
            $table->string('agency_location')->index();
            $table->string('agency')->index();
            $table->unsignedInteger('no_of_planned_toe')->index()->default(0);
            $table->unsignedInteger('estimated_msme_to_be_trained')->index()->default(0);
            $table->unsignedInteger('no_of_toe_conducted_activity_report')->index()->default(0);
            $table->unsignedInteger('no_msme_trained')->index()->default(0);
            $table->longText("remarks")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siyb_agencies');
    }
};
