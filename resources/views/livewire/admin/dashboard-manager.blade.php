<div class="p-4 md:p-6 space-y-6 md:space-y-8 bg-gray-50 min-h-screen">
    
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-gray-800">Manajemen MBS Trans</h1>
            <p class="text-sm text-gray-500">Panel kendali operasional bus</p>
        </div>
        <button class="w-full md:w-auto bg-blue-600 text-white px-6 py-3 md:py-2 rounded-lg hover:bg-blue-700 transition shadow-md active:scale-95">
            + <span class="md:inline">Tambah Booking</span>
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-4 border-b bg-gray-50 flex justify-between items-center">
            <h3 class="font-semibold text-gray-700">Daftar Booking Aktif</h3>
            <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">{{ count($bookings) }} Total</span>
        </div>

        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-xs uppercase text-gray-600">
                        <th class="p-4">Nama Pelanggan</th>
                        <th class="p-4">Kursi</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-medium">{{ $booking->customer_name }}</td>
                            <td class="p-4"><span class="font-bold text-blue-600">#{{ $booking->seat_number }}</span></td>
                            <td class="p-4">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Lunas</span>
                            </td>
                            <td class="p-4 text-center">
                                <button wire:click="deleteBooking({{ $booking->id }})" wire:confirm="Yakin ingin menghapus?" class="text-red-600 hover:text-red-800 text-sm font-semibold">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="p-10 text-center text-gray-400 italic">Belum ada booking aktif.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="md:hidden divide-y">
            @forelse ($bookings as $booking)
                <div class="p-4 flex justify-between items-center bg-white">
                    <div>
                        <p class="font-bold text-gray-800">{{ $booking->customer_name }}</p>
                        <p class="text-sm text-blue-600 font-semibold">Kursi #{{ $booking->seat_number }}</p>
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        <span class="px-2 py-1 text-[10px] rounded-full bg-green-100 text-green-700 uppercase font-bold">Lunas</span>
                        <button wire:click="deleteBooking({{ $booking->id }})" class="text-red-500 text-xs font-bold uppercase tracking-wider">Hapus</button>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-400 italic">Belum ada booking aktif.</div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-4 border-b bg-gray-50 text-blue-700">
            <h3 class="font-semibold text-gray-700">Status Kursi Bus</h3>
        </div>
        <div class="p-4 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-10 gap-2 md:gap-3">
            @foreach ($seats as $seat)
                <div class="relative group">
                    <div wire:click="toggleSeatStatus({{ $seat->id }})" 
                        class="cursor-pointer aspect-square rounded-lg flex flex-col items-center justify-center border-2 transition-all active:scale-90
                        {{ $seat->status == 'booked' ? 'bg-red-500 border-red-600 text-white shadow-inner' : 'bg-green-500 border-green-600 text-white shadow-md' }}">
                        <span class="text-xs md:text-sm font-black">{{ $seat->seat_number }}</span>
                        <span class="text-[8px] md:text-[10px] uppercase opacity-80 font-bold leading-none">{{ $seat->status == 'booked' ? 'Isi' : 'Kosong' }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-4 border-b bg-gray-50 text-orange-700">
            <h3 class="font-semibold text-gray-700">Kritik & Saran Pelanggan</h3>
        </div>
        <div class="divide-y max-h-80 overflow-y-auto">
            @forelse($feedbacks as $item)
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start mb-1">
                        <p class="text-sm font-bold text-gray-800">{{ $item->name }}</p>
                        <p class="text-[10px] text-gray-400">{{ $item->created_at->format('d M, H:i') }}</p>
                    </div>
                    <p class="text-sm text-gray-600 italic">"{{ $item->message }}"</p>
                </div>
            @empty
                <div class="p-8 text-center text-gray-400 italic">Belum ada saran masuk.</div>
            @endforelse
        </div>
    </div>
</div>