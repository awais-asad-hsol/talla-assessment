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
        Schema::connection('countries_db')->create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('capital')->nullable();
            $table->float('area')->nullable();
            $table->json('currencies')->nullable();
            $table->json('languages')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
