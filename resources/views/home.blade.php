@extends('layouts.app')

@section('content')

{{-- ================= HERO / CAROUSEL ================= --}}
<div class="relative w-full overflow-hidden">
    <div class="h-56 md:h-80 bg-cover bg-center"
         style="background-image: url('https://via.placeholder.com/1200x400?text=Mudik+Bareng+Saliwang')">
        <div class="h-full w-full bg-black/40 flex items-center justify-center">
            <div class="text-center text-white px-4">
                <h1 class="text-2xl md:text-4xl font-bold">
                    Mudik Bareng Saliwang
                </h1>
                <p class="mt-2 text-sm md:text-lg">
                    Aman • Nyaman • Terpercaya
                </p>
            </div>
        </div>
    </div>
</div>

{{-- ================= TEXT PROMO ================= --}}
<div class="max-w-4xl mx-auto mt-6 px-4 text-center">
    <h2 class="text-xl md:text-2xl font-semibold">
        Pilih Kursi Mudik Sekarang
    </h2>
    <p class="text-gray-600 mt-2">
        Pilih kursi, transfer DP ke admin, dan kursi langsung kami amankan
        untuk perjalanan mudik Anda.
    </p>
</div>

{{-- ================= KURSI ================= --}}
<div class="max-w-4xl mx-auto mt-6 px-4">
    <div class="bg-white rounded-xl shadow p-4">
        <h3 class="font-semibold mb-4">Nomor Kursi</h3>

        <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-2">
            @foreach ($seats as $seat)
                <button
                    class="
                        text-sm py-2 rounded font-semibold
                        {{ $seat->status == 'available' ? 'bg-green-500 text-white hover:bg-green-600' : '' }}
                        {{ $seat->status == 'pending' ? 'bg-yellow-400 text-white cursor-not-allowed' : '' }}
                        {{ $seat->status == 'booked' ? 'bg-red-500 text-white cursor-not-allowed' : '' }}
                    "
                    {{ $seat->status != 'available' ? 'disabled' : '' }}
                    onclick="openModal('{{ $seat->id }}', '{{ $seat->seat_number }}')"
                >
                    {{ $seat->seat_number }}
                </button>
            @endforeach
        </div>

        <div class="flex gap-4 text-sm text-gray-600 mt-4">
            <span>🟢 Tersedia</span>
            <span>🟡 Pending</span>
            <span>🔴 Terisi</span>
        </div>
    </div>
</div>

{{-- ================= MODAL ================= --}}
<div id="bookingModal"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-xl p-5 mx-4">
        <h3 class="text-lg font-semibold mb-2">
            Booking Kursi <span id="seatLabel" class="text-blue-600"></span>
        </h3>

        <form method="POST">
            @csrf
            <input type="hidden" name="seat_id" id="seatId">
            <input type="hidden" name="bus_id" value="{{ $bus->id }}">

            <input
                type="text"
                name="nama"
                placeholder="Nama Lengkap"
                class="w-full border rounded px-3 py-2 mb-2"
                required
            >

            <input
                type="text"
                name="hp"
                placeholder="No WhatsApp"
                class="w-full border rounded px-3 py-2 mb-3"
                required
            >

            <div class="bg-blue-50 text-blue-700 text-sm p-3 rounded mb-3">
                Setelah booking, silakan transfer DP dan konfirmasi
                ke admin via WhatsApp.
            </div>

            <div class="flex gap-2">
                <button type="button"
                        onclick="closeModal()"
                        class="w-1/2 border rounded py-2">
                    Batal
                </button>
                <button
                    class="w-1/2 bg-blue-600 text-white rounded py-2 hover:bg-blue-700">
                    Pesan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
function openModal(seatId, seatNumber) {
    document.getElementById('seatId').value = seatId;
    document.getElementById('seatLabel').innerText = seatNumber;
    document.getElementById('bookingModal').classList.remove('hidden');
    document.getElementById('bookingModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('bookingModal').classList.add('hidden');
    document.getElementById('bookingModal').classList.remove('flex');
}
</script>

@endsection
