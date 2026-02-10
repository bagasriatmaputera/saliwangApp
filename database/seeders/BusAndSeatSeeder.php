<?php

namespace Database\Seeders;

use App\Models\Seat;
use App\Models\Bus;
use Illuminate\Database\Seeder;

class BusAndSeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $bus = Bus::create([
            'nama_bus'    => 'Mudik Bareng Saliwang (MBS Trans)',
            'tanggal'     => '2026-03-17',
            'jam'         => '19:00',
            'owner_phone' => '6281234567890'
        ]);

        $rows = range('A', 'Z');
        $seatCount = 0;

        foreach ($rows as $row) {
            for ($number = 1; $number <= 2; $number++) {
                $seatCount++;

                if ($seatCount > 55) {
                    break 2;
                }

                Seat::create([
                    'bus_id'      => $bus->id,
                    'seat_number' => $row . $number,
                    'status'      => 'available'
                ]);
            }
        }
    }
}
