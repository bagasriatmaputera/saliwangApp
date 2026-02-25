<div class="p-4 md:p-6 space-y-6 md:space-y-8 bg-gray-50 min-h-screen">
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <div>
            <h1 class="text-xl md:text-2xl font-black text-gray-800 uppercase tracking-tight">Manajemen MBS Trans</h1>
            <p class="text-sm text-gray-500 font-medium">Panel Kendali Operasional Mudik Bareng Saliwang</p>
        </div>

        <x-button label="Tambah Booking Manual" @click="$wire.bookingModal = true" icon="o-plus"
            class="btn-primary w-full md:w-auto shadow-lg shadow-blue-200" />
    </div>
    <div class="flex items-center gap-3">
        {{-- Tombol Logout  --}}
        <x-button label="Keluar" icon="o-power" wire:click="logout"
            wire:confirm="Yakin ingin keluar dari Manajemen MBS Trans?" spinner="logout"
            class="btn-ghost text-red-600 hover:bg-red-50 border-none font-black uppercase text-[10px] tracking-widest" />
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-4 border-b bg-gray-50/50 flex justify-between items-center">
            <h3 class="font-bold text-gray-700 flex items-center gap-2">
                <x-icon name="o-ticket" class="w-5 h-5 text-blue-600" />
                Daftar Booking Aktif
            </h3>
            <span
                class="bg-blue-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase">{{ count($bookings) }}
                Penumpang</span>
        </div>

        <div class="overflow-y-auto max-h-[600px] scrollbar-thin scrollbar-thumb-gray-300">
            <table class="w-full text-left border-collapse">
                <thead class="sticky top-0 z-20 bg-gray-50 shadow-sm">
                    <tr class="text-[10px] uppercase font-black text-gray-400 tracking-widest">
                        <th class="p-4">Nama Pelanggan</th>
                        <th class="p-4">Jadwal Dan Trip</th>
                        <th class="p-4">Kursi</th>
                        <th class="p-4">Tujuan</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            {{-- ... isi row tetap sama ... --}}
                            <td class="p-4">
                                <p class="font-bold text-gray-800">{{ $booking->nama_pemesan }}</p>
                                <p class="text-[10px] text-gray-500">{{ $booking->no_hp }}</p>
                            </td>
                            <td class="p-4 text-xs font-medium">{{ $booking->trip->jadwal_trip ?? '-' }}</td>
                            <td class="p-4">
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-md font-black text-xs">
                                    {{ $booking->seat->seat_number ?? $booking->seat_id }}
                                </span>
                            </td>
                            <td class="p-4 text-xs font-medium text-gray-600 uppercase">{{ $booking->tujuan }}</td>
                            <td class="p-4 text-center">
                                <x-button icon="o-trash" wire:click="deleteBooking({{ $booking->id }})"
                                    wire:confirm="Hapus data booking ini?"
                                    class="btn-ghost btn-sm text-red-500 hover:bg-red-50" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-gray-400 italic font-medium">
                                Belum ada booking aktif untuk saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Section 2: Pemilihan Jadwal & Visual Bus --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        {{-- Sisi Kiri: Visual Bus --}}
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <h3 class="font-bold text-gray-800 uppercase tracking-tighter text-lg">Visual Kursi Bus</h3>

                    {{-- Toggle Trip --}}
                    <div class="flex flex-wrap gap-2">
                        @foreach ($this->trips as $trip)
                            <button wire:click="$set('trip_id', {{ $trip->id }})" @class([
                                'px-4 py-2 rounded-xl text-[10px] font-black uppercase transition-all border-2',
                                'bg-blue-600 border-blue-600 text-white shadow-md' => $trip_id == $trip->id,
                                'bg-white border-gray-100 text-gray-400 hover:border-blue-200' =>
                                    $trip_id != $trip->id,
                            ])>
                                {{ $trip->jadwal_trip }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Denah Bus --}}
                <div
                    class="max-w-xs mx-auto bg-slate-100 p-6 rounded-[40px] border-4 border-slate-200 relative shadow-inner">
                    {{-- Area Dashboard/Sopir --}}
                    <div class="h-12 bg-slate-300 rounded-t-3xl mb-8 flex items-center justify-center">
                        <div class="w-10 h-10 border-4 border-slate-400 rounded-full flex items-center justify-center">
                            <div class="w-1 h-6 bg-slate-400 rotate-45"></div>
                        </div>
                    </div>

                    {{-- Baris Utama (1-44) --}}
                    <div class="space-y-4">
                        @foreach (range(1, 44, 4) as $rowStart)
                            <div class="grid grid-cols-5 gap-2 items-center">
                                {{-- Kiri 2 Kursi --}}
                                <div class="col-span-2 grid grid-cols-2 gap-2">
                                    @for ($i = $rowStart; $i < $rowStart + 2; $i++)
                                        @php $seat = $this->seats->firstWhere('seat_number', '#' . $i); @endphp
                                        @if ($seat)
                                            <button wire:click="openBookingModal({{ $seat->id }})"
                                                @class([
                                                    'aspect-square rounded-lg flex flex-col items-center justify-center border-2 transition-all active:scale-90',
                                                    'bg-red-500 border-red-700 text-white shadow-inner' =>
                                                        $seat->bookings_exists,
                                                    'bg-green-500 border-green-700 text-white shadow-sm' => !$seat->bookings_exists,
                                                ])>
                                                <span
                                                    class="text-[10px] font-black uppercase tracking-tighter">#{{ $i }}</span>
                                            </button>
                                        @endif
                                    @endfor
                                </div>

                                {{-- Lorong --}}
                                <div class="col-span-1 flex justify-center">
                                    <div class="w-1 h-8 bg-slate-200 rounded-full"></div>
                                </div>

                                {{-- Kanan 2 Kursi --}}
                                <div class="col-span-2 grid grid-cols-2 gap-2">
                                    @for ($i = $rowStart + 2; $i < $rowStart + 4; $i++)
                                        @php $seat = $this->seats->firstWhere('seat_number', '#' . $i); @endphp
                                        @if ($seat)
                                            <button wire:click="openBookingModal({{ $seat->id }})"
                                                @class([
                                                    'aspect-square rounded-lg flex flex-col items-center justify-center border-2 transition-all active:scale-90',
                                                    'bg-red-500 border-red-700 text-white shadow-inner' =>
                                                        $seat->bookings_exists,
                                                    'bg-green-500 border-green-700 text-white shadow-sm' => !$seat->bookings_exists,
                                                ])>
                                                <span
                                                    class="text-[10px] font-black uppercase tracking-tighter">#{{ $i }}</span>
                                            </button>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        @endforeach

                        {{-- Baris Belakang (6 Kursi) --}}
                        <div class="grid grid-cols-6 gap-1 pt-4 border-t-2 border-slate-200">
                            @foreach (range(45, 50) as $i)
                                @php $seat = $this->seats->firstWhere('seat_number', '#' . $i); @endphp
                                @if ($seat)
                                    <button wire:click="openBookingModal({{ $seat->id }})"
                                        @class([
                                            'aspect-square rounded-md flex items-center justify-center border-2 transition-all',
                                            'bg-red-500 border-red-700 text-white' => $seat->bookings_exists,
                                            'bg-green-500 border-green-700 text-white' => !$seat->bookings_exists,
                                        ])>
                                        <span class="text-[9px] font-black italic">#{{ $i }}</span>
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sisi Kanan: Feedback & Modal --}}
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b bg-orange-50/50">
                    <h3 class="font-bold text-orange-800 uppercase text-sm">Kritik & Saran Masuk</h3>
                </div>
                <div class="divide-y divide-gray-50 max-h-[500px] overflow-y-auto">
                    @forelse($feedbacks as $item)
                        <div class="p-4 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-black text-gray-800 uppercase">{{ $item->nama }}</span>
                                <span
                                    class="text-[9px] text-gray-400 font-bold uppercase">{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-gray-600 leading-relaxed italic">"{{ $item->pesan }}"</p>
                        </div>
                    @empty
                        <div class="p-10 text-center text-gray-300 italic text-sm font-medium">Belum ada saran dari
                            pelanggan.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL BOOKING --}}
    <x-modal wire:model="bookingModal" title="Booking Manual MBS Trans"
        subtitle="Pilih jadwal keberangkatan yang sesuai" separator>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-input label="Nama Pemesan" wire:model="nama_pemesan" icon="o-user" />
            <x-input label="No. WhatsApp" wire:model="no_hp" icon="o-phone" />
            <x-input label="Tujuan" wire:model="tujuan" icon="o-map-pin" />
            <x-input label="Titik Jemput" wire:model="titik_jemput" icon="o-home" />
            <x-select label="Pilih Trip" wire:model.live="trip_id" :options="$this->trips" option-label="jadwal_trip"
                option-value="id" icon="o-calendar" />
            <x-select label="Pilih Nomor Kursi" wire:model="seat_id" :options="$this->availableSeats()" option-label="name"
                option-value="id" placeholder="Pilih kursi tersedia..." icon="o-stop" :disabled="empty($trip_id)" />
        </div>
        <x-slot:actions>
            <x-button label="Batal" @click="$wire.bookingModal = false" />
            <x-button label="Simpan Reservasi" wire:click="save" class="btn-primary" spinner="save" />
        </x-slot:actions>
    </x-modal>

    {{-- MODAL SHOW PENUMPANG --}}
    <x-modal wire:model="showPassengerModal" title="Detail Penumpang" subtitle="Informasi reservasi kursi" separator>
        @if ($selectedBooking)
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-[10px] uppercase font-black text-gray-400">Nama Pelanggan</p>
                        <x-input wire:model.defer="selectedBooking.nama_pemesan" :value="data_get($selectedBooking, 'nama_pemesan')" />
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-[10px] uppercase font-black text-gray-400">Nomor Kursi</p>
                        <x-input wire:model.defer="selectedBooking.seat.seat_number" :value="data_get($selectedBooking, 'seat.seat_number')" disabled />
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-[10px] uppercase font-black text-gray-400">WhatsApp</p>
                        <x-input wire:model.defer="selectedBooking.no_hp" :value="data_get($selectedBooking, 'no_hp')" />
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-[10px] uppercase font-black text-gray-400">Tujuan</p>
                        <x-input wire:model.defer="selectedBooking.tujuan" :value="data_get($selectedBooking, 'tujuan')" />
                    </div>
                </div>

                <div class="bg-blue-50 p-3 rounded-lg border border-blue-100">
                    <p class="text-[10px] uppercase font-black text-blue-400">Titik Jemput</p>
                    <x-input wire:model.defer="selectedBooking.titik_jemput" :value="data_get($selectedBooking, 'titik_jemput')" />
                    </p>
                </div>
            </div>
        @endif

        <x-slot:actions>
            {{-- Tombol Hapus --}}

            <x-button label="Hapus Booking" icon="o-trash"
                wire:click="deleteBooking({{ data_get($selectedBooking, 'id', 0) }})"
                wire:confirm="Yakin ingin membatalkan booking ini?" class="btn-ghost text-red-500" />

            {{-- <x-button label="Tutup" @click="$wire.showPassengerModal = false" /> --}}
            @if ($selectedBooking)
            <x-button label="Update Nama" wire:click="updateBooking({{ data_get($selectedBooking, 'id', 0) }})" class="btn-primary" />
            @endif
        </x-slot:actions>
    </x-modal>
</div>
