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
            $table->string('day')->index()->nullable();
            $table->datetime('start_date')->index()->nullable();
            $table->datetime('deactivate_at')->index()->nullable();
            $table->time('start_time')->index()->nullable();
            $table->time('end_time')->index()->nullable();
            $table->string('life_stage_type')->index()->nullable();
            $table->string('status')->index()->nullable();
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
