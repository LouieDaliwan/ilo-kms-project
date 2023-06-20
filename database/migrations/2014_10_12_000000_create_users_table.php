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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->index();
            $table->string('middle_name')->index()->nullable();
            $table->string('last_name')->index();
            $table->string('email')->unique()->index();
            $table->string('username')->unique()->index();
            $table->string('status')->index()->nullable();
            $table->string('gender')->index()->nullable();
            $table->longText('metadata')->nullable();
            $table->longText('remarks')->nullable();
            $table->integer('is_temporary_password')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->index()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
