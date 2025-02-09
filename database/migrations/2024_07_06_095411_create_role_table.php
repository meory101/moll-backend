<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 

    public function up(): void
    {
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('name');   
            $table->timestamps();
        });
        DB::table('role')->insert([
            ['name' => 'admin'],
            ['name' => 'user'],
            ['name' => 'manager'],
            ['name' => 'store'],
        ]);
    }


    public function down(): void
    {
        Schema::dropIfExists('manager');
    }
};
