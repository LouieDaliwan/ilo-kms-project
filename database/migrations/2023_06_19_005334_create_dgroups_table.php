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
        Schema::create('dgroups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leader_id')->index();
            $table->string('day_group')->index();
            $table->datetime('start_datetime')->index();
            $table->datetime('end_datetime')->index();
            $table->string('life_stage_type')->index();
            $table->string('status')->index();
            $table->string('accept_new_member')->index()->default(1);
            $table->longText('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dgroups');
    }
};
