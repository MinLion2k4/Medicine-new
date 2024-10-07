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
          if (!Schema::hasTable('accounts'))
        Schema::create('accounts', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('fullName', 100);
            $table->string('email', 100)->nullable();
            $table->string('password', 100)->nullable();
            $table->string('token', 30)->default('tokentestabcxyz');
            $table->string('phone', 10)->nullable();
            $table->string('role_id', 10)->nullable();
            $table->string('status', 25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
