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
        Schema::create('trip_availables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')
                  ->constrained('buses')
                  ->onDelete('restrict');
            $table->date('jadwal_trip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_availables');
    }
};
