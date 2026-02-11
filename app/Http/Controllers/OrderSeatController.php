<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class OrderSeatController
{
    public function index()
    {
        $bookData = App\Models\Booking::select()->get();
        return view('admin.booking.', [
            'data' => $bookData
        ]);
    }

    public function show(int $id)
    {
        $bookData = App\Models\Booking::findOrFail($id);
        return view('admin.booking.detail', [
            'data' => $bookData
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|min:3|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'tujuan' => 'required|string|min:5|max:500',
            'titik_jemput' => 'required|string|min:5|max:500',
        ], [
            'nama_pemesan.required' => 'Nama pemesan tidak boleh kosong.',
            'nama_pemesan.string' => 'Nama pemesan harus berupa teks.',
            'nama_pemesan.min' => 'Nama pemesan minimal 3 karakter.',

            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'no_hp.digits_between' => 'Nomor HP harus antara 10 sampai 15 digit.',

            'tujuan.required' => 'Alamat tujuan wajib diisi.',
            'tujuan.min' => 'Alamat tujuan terlalu pendek.',

            'titik_jemput.required' => 'Titik penjemputan wajib diisi.',
            'titik_jemput.min' => 'Titik penjemputan terlalu pendek.',
        ]);

        \App\Models\Booking::create($validated);

        $message = "Halo Pak Saliwang, saya mau booking kursi ..., apakah tersedia?";

        $url = "https://wa.me/6287703631260?text=" . urlencode($message);

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'status' => 'required',
        ]);

        \App\Models\Booking::updated($validated);

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }

    public function delete(int $id){
        $booking = \App\Models\Booking::findOrFail($id);
        $booking->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');

    }
}