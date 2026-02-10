<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bus_id')
                  ->constrained('buses')
                  ->onDelete('cascade');

            $table->foreignId('seat_id')
                  ->constrained('seats')
                  ->onDelete('cascade');

            $table->string('nama_pemesan');
            $table->string('no_hp');
            $table->string('tujuan');
            $table->string('titik_jemput', 100)->nullable()->default(NULL);

            $table->enum('status', ['pending', 'booked'])
                  ->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
