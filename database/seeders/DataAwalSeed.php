<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Seat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataAwalSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $busId = 1; // ID bus sesuai seeder sebelumnya

        $dataOrder = [
            ['nama' => 'Nur', 'seats' => [1, 2, 5, 6, 9, 10, 13, 14, 17, 18], 'trip_id' => 1, 'tujuan' => 'Wonogiri', 'jemput' => 'One Bellpark'],
            ['nama' => 'Endang', 'seats' => [3, 4], 'trip_id' => 1, 'tujuan' => 'Wonogiri', 'jemput' => 'One Bellpark'],
            ['nama' => 'Sarwini', 'seats' => [21, 22, 25, 26, 29], 'trip_id' => 1, 'tujuan' => 'Wonogiri', 'jemput' => 'One Bellpark'],
            ['nama' => 'Febi', 'seats' => [50], 'trip_id' => 1, 'tujuan' => 'Wonogiri', 'jemput' => 'Gabus'],
            ['nama' => 'Basuki', 'seats' => [35, 36, 39, 40, 41, 42, 43, 44], 'trip_id' => 1, 'tujuan' => 'Bawen', 'jemput' => 'Polsek Cipayung'],
            ['nama' => 'Yani', 'seats' => [31, 32], 'trip_id' => 1, 'tujuan' => 'Wonogiri', 'jemput' => 'One Bellpark'],
            ['nama' => 'Dori', 'seats' => [19, 20, 23, 24, 27, 28], 'trip_id' => 1, 'tujuan' => 'Wonogiri', 'jemput' => 'Gabus'],
            ['nama' => 'Krakal', 'seats' => [16], 'trip_id' => 1, 'tujuan' => 'Wonogiri', 'jemput' => 'One Bellpark'],
            ['nama' => 'Wiwid', 'seats' => [33, 34], 'trip_id' => 1, 'tujuan' => 'Wonogiri', 'jemput' => 'One Bellpark'],
            ['nama' => 'Tiyem', 'seats' => [7], 'trip_id' => 1, 'tujuan' => 'Wonogiri', 'jemput' => 'One Bellpark'],
            ['nama' => 'Bude Mur', 'seats' => [8], 'trip_id' => 1, 'tujuan' => 'Wonogiri', 'jemput' => 'One Bellpark'],
            ['nama' => 'Sumadi', 'seats' => [11, 15, 12], 'trip_id' => 1, 'tujuan' => 'Wonogiri', 'jemput' => 'One Bellpark'],
            ['nama' => 'Nur', 'seats' => [1, 2, 5, 6, 9, 10, 13, 14, 17, 18], 'trip_id' => 2, 'tujuan' => 'Jakarta', 'jemput' => ''],
            ['nama' => 'Basuki', 'seats' => [11, 12, 15, 16, 19, 20, 23, 24, 27, 28], 'trip_id' => 2, 'tujuan' => 'Jakarta', 'jemput' => ''],
            ['nama' => 'Wiwid', 'seats' => [21, 22], 'trip_id' => 2, 'tujuan' => 'Jakarta', 'jemput' => ''],
            ['nama' => 'Endang', 'seats' => [3, 4], 'trip_id' => 2, 'tujuan' => 'Jakarta', 'jemput' => ''],
            ['nama' => 'Sarwini', 'seats' => [7, 8], 'trip_id' => 2, 'tujuan' => 'Jakarta', 'jemput' => ''],

        ];

        foreach ($dataOrder as $order) {
            foreach ($order['seats'] as $num) {
                $seat = Seat::where('bus_id', $busId)
                    ->where('seat_number', '#' . $num)
                    ->first();

                if ($seat) {
                    Booking::create([
                        'bus_id' => $busId,
                        'seat_id' => $seat->id,
                        'trip_id' => $order['trip_id'],
                        'nama_pemesan' => $order['nama'],
                        'no_hp' => NULL,
                        'tujuan' => $order['tujuan'],
                        'titik_jemput' => $order['jemput'],
                        'status' => 'booked'
                    ]);
                }
            }
        }
    }
}
