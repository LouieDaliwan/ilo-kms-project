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
        Schema::create('dgroup_members', function (Blueprint $table) {
            $table->unsignedBigInteger('dgroup_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('status')->index();
            $table->date('start_date')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dgroup_members');
    }
};
