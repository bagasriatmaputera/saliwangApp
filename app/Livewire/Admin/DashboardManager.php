<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Seat;
use App\Models\Feedback;
use function PHPUnit\Framework\isEmpty;

class DashboardManager extends Component
{
    public $showBookingModal = false;

    // public $feedbacks = [];

    // public function mount()
    // {
    //     $this->feedbacks = [
    //         [
    //             'id' => 1,
    //             'name' => 'Budi Santoso',
    //             'email' => 'budi@example.com',
    //             'message' => 'Kursinya sangat nyaman, tapi AC-nya tadi agak kurang dingin di bagian belakang.',
    //             'created_at' => '2026-02-16 10:00:00', // Gunakan format string atau Carbon
    //         ],
    //         [
    //             'id' => 2,
    //             'name' => 'Siti Aminah',
    //             'email' => 'siti@example.com',
    //             'message' => 'Driver-nya sangat sopan dan berangkat tepat waktu. Sukses terus MBS Trans!',
    //             'created_at' => '2026-02-17 08:00:00',
    //         ],
    //         [
    //             'id' => 3,
    //             'name' => 'Rian Ardianto',
    //             'email' => 'rian@example.com',
    //             'message' => 'Mohon tambahkan fitur pembayaran via QRIS di website agar lebih mudah.',
    //             'created_at' => '2026-02-17 18:30:00',
    //         ],
    //     ];
    // }


    public function deleteBooking($id)
    {
        Booking::find($id)->delete();
        session()->flash('message', 'Booking berhasil dihapus.');
    }

    public function toggleSeatStatus($id)
    {
        $seat = Seat::find($id);
        $seat->status = ($seat->status == 'available') ? 'booked' : 'available';
        $seat->save();
    }

    public function render()
    {
        return view('livewire.admin.dashboard-manager', [
            'bookings' => Booking::latest()->get(),
            'seats' => Seat::get(),
            'feedbacks' => Feedback::get(),
        ]);
    }
}