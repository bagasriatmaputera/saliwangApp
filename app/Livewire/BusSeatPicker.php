<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Seat;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Mary\Traits\Toast;

class BusSeatPicker extends Component
{
    use Toast;
    public $selectedSeats = [];
    public $bus_id = 1;
    public $trip_id;
    public $feedback_nama;
    public $feedback_pesan;
    public $feedback_trip;

    #[Computed]
    public function trips()
    {
        return \App\Models\TripAvailable::orderBy('jadwal_trip', 'asc')->get();
    }

    public function mount()
    {
        // Set default trip ke yang pertama tersedia
        $this->trip_id = \App\Models\TripAvailable::first()?->id;
    }

    public function sendFeedback()
    {
        $this->validate([
            'feedback_nama' => 'required|min:3',
            'feedback_pesan' => 'required|min:5',
            'feedback_trip' => 'nullable',
        ]);

        // Simpan ke database (Pastikan sudah buat Model Feedback)
        \App\Models\Feedback::create([
            'nama' => $this->feedback_nama,
            'pesan' => $this->feedback_pesan,
            'tanggal_trip' => $this->feedback_trip,
        ]);

        $this->reset(['feedback_nama', 'feedback_pesan']);
        $this->success(
            title: 'Terima kasih!',
            description: 'Kritik dan saran Anda sangat berharga.',
            position: 'toast-top toast-end',
            icon: 'o-check-circle'
        );
    }

    #[Computed]
    public function seats()
    {
        return Seat::where('bus_id', $this->bus_id)
            ->withExists([
                'bookings' => function ($query) {
                    $query->where('trip_id', $this->trip_id)
                        ->where('status', 'booked');
                }
            ])
            ->orderBy('id', 'asc')
            ->get();
    }

    public function selectSeat($seatId)
    {
        $seat = $this->seats->find($seatId);

        if (!$seat || $seat->status === 'booked') {
            return;
        }

        if (($key = array_search($seatId, $this->selectedSeats)) !== false) {
            unset($this->selectedSeats[$key]);
            $this->selectedSeats = array_values($this->selectedSeats);
        } else {
            $this->selectedSeats[] = $seatId;
        }
    }

    public function render()
    {
        return view(
            'livewire.booking-seat',
            [
                'seats' => $this->seats,
                'trips' => $this->trips,
            ]
        )->layout('components.layouts.app');
    }
}