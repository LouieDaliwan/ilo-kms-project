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
        Schema::create('siyb_clients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agency_id')->unsigned()->index();
            $table->string('first_name')->index();
            $table->string('middle_name')->index()->nullable();
            $table->string('last_name')->index();
            $table->string('suffix')->index()->nullable();
            $table->string('email')->unique()->index();
            $table->string('gender')->index()->nullable();
            $table->string('socmed')->index()->nullable();
            $table->string('age')->index()->nullable();
            $table->string('mobile_number')->index()->nullable();
            $table->string('high_education')->index()->nullable();
            $table->longText('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
