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
        Schema::create('wise_participants', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->index();
            $table->string('middle_name')->index()->nullable();
            $table->string('last_name')->index();
            $table->string('suffix')->index()->nullable();
            $table->string('email')->index()->unique()->nullable();
            $table->string('nickname')->index()->nullable();
            $table->string('gender')->index()->nullable();
            $table->integer('age')->index()->nullable();
            $table->string('phone_number')->index()->nullable();
            $table->string('position')->index();
            $table->string('type_of_business')->index()->nullable();
            $table->string('business_sector')->index()->nullable();
            $table->integer('is_business_registered')->index()->default(0);
            $table->string('registered_to')->index()->nullable();
            $table->integer('beneficiary_of_gov_project')->index()->default(0);
            $table->string('government_agency')->index()->nullable();
            $table->string('member_of')->index()->nullable();
            $table->longText('home_address')->nullable();
            $table->date('ilo_timestamp')->index()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wise_participants');
    }
};
