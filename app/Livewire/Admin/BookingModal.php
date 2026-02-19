<?php 
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking; // Sesuaikan dengan nama modelmu
use Mary\Traits\Toast;

class BookingModal extends Component
{
    use Toast;

    public bool $bookingModal = false;

    // Properti form sesuai gambar database
    public $bus_id;
    public $seat_id;
    public $nama_pemesan;
    public $no_hp;
    public $tujuan;
    public $titik_jemput;

    protected $rules = [
        'bus_id' => 'required',
        'seat_id' => 'required',
        'nama_pemesan' => 'required|min:3',
        'no_hp' => 'required',
        'tujuan' => 'required',
        'titik_jemput' => 'required',
    ];

    public function save()
    {
        $this->validate();

        Booking::create([
            'bus_id' => 1,
            'seat_id' => $this->seat_id,
            'nama_pemesan' => $this->nama_pemesan,
            'no_hp' => $this->no_hp,
            'tujuan' => $this->tujuan,
            'titik_jemput' => $this->titik_jemput,
            'status' => 'booked', 
        ]);

        $this->reset(['bookingModal', 'nama_pemesan', 'no_hp', 'tujuan', 'titik_jemput']);
        $this->success('Booking berhasil disimpan!');
        $this->dispatch('booking-updated'); 
    }

    public function render()
    {
        return view('livewire.admin.booking-modal');
    }
}