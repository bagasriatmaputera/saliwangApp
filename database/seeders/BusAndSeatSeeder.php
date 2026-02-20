<?php

namespace Database\Seeders;

use App\Models\Seat;
use App\Models\Bus;
use App\Models\TripAvailable;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class BusAndSeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@mbs.com'],
            [
                'name' => 'Bagas MBS',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $bus = Bus::create([
            'nama_bus' => 'Mudik Bareng Saliwang (MBS Trans)',
            'tanggal' => '2026-03-17',
            'jam' => '19:00',
            'owner_phone' => '6281234567890'
        ]);

        $seatCount = 50;

        for ($i = 1; $i <= $seatCount; $i++) {
            dump("Membuat kursi ke-" . $i);
            Seat::create([
                'bus_id' => $bus->id,
                'seat_number' => '#' . $i,
            ]);
        }
        ;

        $jadwalTrip = [
            ['tanggal' => '2026-03-17', 'rute' => 'Jakarta - Wonogiri'],
            ['tanggal' => '2026-03-24', 'rute' => 'Wonogiri - Jakarta']


        ];

        foreach ($jadwalTrip as $trip) {
            TripAvailable::create([
                'bus_id' => 1,
                'jadwal_trip' => $trip['tanggal'],
                'rute' => $trip['rute']
            ]);
        }
    }
}
