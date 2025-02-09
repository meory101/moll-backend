<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * nour othman
     */
    public function up(): void
    {
        Schema::create('cash_account', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->double('balance');
            $table->foreignId('userId')->nullable()->constrained('user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waity_account');
    }
};
