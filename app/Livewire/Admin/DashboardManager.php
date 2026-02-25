<?php

namespace App\Livewire\Admin;

// use DB;
use Livewire\Component;
use App\Models\Booking;
use App\Models\Seat;
use App\Models\Feedback;
use App\Models\TripAvailable;
use Illuminate\Support\Facades\DB;
use Mary\Traits\Toast;
use Livewire\Attributes\Computed;

class DashboardManager extends Component
{
    use Toast;

    public bool $bookingModal = false;

    public $bus_id = 1;
    public $seat_id;
    public $nama_pemesan;
    public $no_hp;
    public $tujuan;
    public $titik_jemput;
    public $trip_id;

    public $availableSeat;

    public function mount()
    {
        $this->trip_id = TripAvailable::first()?->id;
    }

    #[Computed]
    public function trips()
    {
        return TripAvailable::orderBy('jadwal_trip', 'asc')->get();
    }
    #[Computed]
    public function availableSeats()
    {
        if (!$this->trip_id)
            return [];
        return Seat::where('bus_id', $this->bus_id)
            ->whereDoesntHave('bookings', function ($query) {
                $query->where('trip_id', $this->trip_id)
                    ->where('status', 'booked');
            })
            ->get()
            ->map(function ($seat) {
                return [
                    'id' => $seat->id,
                    'name' => "Kursi " . $seat->seat_number
                ];
            });
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

    public $showPassengerModal = false;
    public $selectedBooking;

    public function openBookingModal($seatId)
    {
        $seat = Seat::find($seatId);

        // Cek apakah kursi sudah di-booking pada trip ini
        $booking = Booking::with('seat')->where('seat_id', $seatId)
            ->where('trip_id', $this->trip_id)
            ->first();

        if ($booking) {
            // Jika sudah ada isinya, tampilkan modal detail
            $this->selectedBooking = $booking->toArray(); // ubah ke array agar Livewire bisa binding
            $this->showPassengerModal = true;
        } else {
            // Jika kosong, buka modal booking manual seperti biasa
            $this->seat_id = $seatId;
            $this->bookingModal = true;
        }
    }

    public function save()
    {
        $this->validate([
            'nama_pemesan' => 'required|min:3',
            'no_hp' => 'required',
            'tujuan' => 'required',
            'titik_jemput' => 'required',
            'trip_id' => 'required',
            'seat_id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            Booking::create([
                'bus_id' => $this->bus_id,
                'seat_id' => $this->seat_id,
                'trip_id' => $this->trip_id,
                'nama_pemesan' => $this->nama_pemesan,
                'no_hp' => $this->no_hp,
                'tujuan' => $this->tujuan,
                'titik_jemput' => $this->titik_jemput,
                'status' => 'booked',
            ]);

            DB::commit();

            $this->success('Booking Berhasil terbuat!');
            $this->bookingModal = false;
            $this->reset(['nama_pemesan', 'no_hp', 'tujuan', 'titik_jemput']);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Gagal simpan: ' . $e->getMessage());
        }
    }

    public function updateBooking($id)
    {
        $this->validate([
            'selectedBooking.nama_pemesan' => 'required|min:3',
            'selectedBooking.no_hp' => 'nullable|numeric',
            'selectedBooking.tujuan' => 'required',
            'selectedBooking.titik_jemput' => 'nullable',
            // tambahkan validasi lain jika perlu
        ]);

        try {
            $booking = Booking::findOrFail($id);
            $booking->nama_pemesan = $this->selectedBooking['nama_pemesan'] ?? $booking->nama_pemesan;
            $booking->no_hp = $this->selectedBooking['no_hp'] ?? $booking->no_hp;
            $booking->tujuan = $this->selectedBooking['tujuan'] ?? $booking->tujuan;
            $booking->titik_jemput = $this->selectedBooking['titik_jemput'] ?? $booking->titik_jemput;
            $booking->save();

            $this->success('Data booking berhasil diupdate!');
            $this->showPassengerModal = false;
        } catch (\Exception $e) {
            $this->error('Gagal update: ' . $e->getMessage());
        }
    }

    public function deleteBooking($id)
    {
        Booking::findOrFail($id)->delete();
        $this->success('Booking dihapus.');
    }
    public function logout(\App\Livewire\Actions\Logout $logout)
    {
        $logout();

        return $this->redirect(route('login'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.dashboard-manager', [
            'availableSeats' => $this->availableSeats(),
            'bookings' => Booking::with('seat')->latest()->get(),
            'feedbacks' => Feedback::latest()->get(),
        ])->layout('components.layouts.app');
    }
}
