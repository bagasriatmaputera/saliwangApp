<div class="bg-gray-50 min-h-screen">
    {{-- Profile Section (Full Width di Laptop) --}}
    <div class="font-sans">
        {{-- Hero & Carousel Section --}}
        <section class="bg-red-700 text-white relative">
            <div class="max-w-7xl mx-auto px-4 py-8 md:py-16 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="space-y-8 order-2 lg:order-1 text-center lg:text-left relative z-10">
                    {{-- Badge --}}
                    <div class="flex items-center justify-center lg:justify-start gap-2">
                        <div
                            class="px-4 py-1.5 bg-blue-600 rounded-full text-[10px] md:text-xs font-black uppercase tracking-[0.2em] shadow-lg shadow-blue-900/20">
                            Terpercaya Sejak 2000
                        </div>
                        <div class="h-1 w-12 bg-blue-400 rounded-full hidden md:block"></div>
                    </div>

                    {{-- Main Heading --}}
                    <div class="space-y-2">
                        <h2 class="text-blue-300 font-bold text-lg md:text-xl tracking-tight leading-none uppercase">
                            Mudik Bareng Saliwang
                        </h2>
                        <h1 class="text-5xl md:text-7xl font-black leading-[1.1] tracking-tighter">
                            MBS Trans: Solusi <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-200">
                                Mudik Hemat
                            </span>
                            & Nyaman
                        </h1>
                    </div>

                    {{-- Description --}}
                    <p
                        class="text-lg md:text-xl text-red-50/80 max-w-xl mx-auto lg:mx-0 font-medium leading-relaxed italic border-l-4 border-blue-500 pl-4 lg:pl-6 py-2">
                        "Menghadirkan transportasi relevan dengan harga <span
                            class="text-white font-bold underline decoration-blue-500">lebih terjangkau</span> dibanding
                        PO lain tanpa mengurangi kualitas pelayanan."
                    </p>

                    {{-- Action Buttons --}}
                    <div class="flex flex-wrap gap-5 justify-center lg:justify-start pt-4">
                        <x-button label="Pesan Tiket Sekarang" icon="o-ticket"
                            @click="document.getElementById('booking-area').scrollIntoView({ behavior: 'smooth' })"
                            class="btn-primary bg-blue-600 border-none hover:bg-blue-700 shadow-[0_10px_20px_rgba(37,99,235,0.3)] hover:translate-y-[-2px] transition-all px-10 h-14 text-lg font-bold" />

                        <div class="flex items-center gap-3 px-4">
                            <div class="flex -space-x-2">
                                @for ($i = 0; $i < 3; $i++)
                                    <div class="w-8 h-8 rounded-full border-2 border-red-700 bg-gray-300"></div>
                                @endfor
                            </div>
                            <p class="text-xs text-red-100 font-medium">
                                <span class="font-black text-white">5000+</span> Penumpang Puas
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Carousel --}}
                <div class="order-1 lg:order-2 rounded-2xl overflow-hidden shadow-2xl border-4 border-white/20">
                    @php
                        $slides = [
                            ['image' => '/storage/img/bus.jpeg', 'title' => 'Armada Nyaman'],
                            ['image' => '/storage/img/bus-1.jpeg', 'title' => 'Armada Aman'],
                            ['image' => '/storage/img/interior.jpeg', 'title' => 'Interior Luas'],
                            ['image' => '/storage/img/suasana.jpeg', 'title' => 'Suasana Nyaman'],
                        ];
                    @endphp
                    <x-carousel :slides="$slides" autoplay interval="8000"
                        class="h-64 md:h-96 rounded-2xl shadow-2xl" />
                </div>
            </div>
        </section>

        {{-- Stats Section --}}
        {{-- Stats Section --}}
        <section class="max-w-6xl mx-auto px-4 -mt-10 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                {{-- Stat 1: Penumpang --}}
                <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-blue-600 text-center transform transition hover:scale-105"
                    x-data="{ count: 0, target: 5000 }" x-init="let interval = setInterval(() => { if (count < target) { count += 50 } else { count = target;
                            clearInterval(interval); } }, 20)">
                    <p class="text-3xl md:text-4xl font-black text-red-700">
                        <span x-text="count">0</span>++
                    </p>
                    <p class="text-gray-500 text-sm font-bold uppercase">Total Penumpang</p>
                </div>

                {{-- Stat 2: Trip --}}
                <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-blue-600 text-center transform transition hover:scale-105"
                    x-data="{ count: 0, target: 50 }" x-init="let interval = setInterval(() => { if (count < target) { count += 1 } else { count = target;
                            clearInterval(interval); } }, 30)">
                    <p class="text-3xl md:text-4xl font-black text-red-700">
                        <span x-text="count">0</span>++
                    </p>
                    <p class="text-gray-500 text-sm font-bold uppercase">Total Trip Aman</p>
                </div>

                {{-- Stat 3: Pengalaman --}}
                <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-blue-600 text-center col-span-2 md:col-span-1 transform transition hover:scale-105"
                    x-data="{ count: 0, target: 26 }" x-init="let interval = setInterval(() => { if (count < target) { count += 1 } else { count = target;
                            clearInterval(interval); } }, 50)">
                    <p class="text-3xl md:text-4xl font-black text-red-700">
                        <span x-text="count">0</span> Thn
                    </p>
                    <p class="text-gray-500 text-sm font-bold uppercase">Beroperasi</p>
                </div>
            </div>
        </section>
    </div>

    {{-- Main Booking Content (Support Mobile & Laptop) --}}
    <div id="booking-area" class="max-w-7xl mx-auto px-4 py-16 grid grid-cols-1 lg:grid-cols-12 gap-12">

        {{-- Kiri: Trip & Kursi (Desktop: 7-8 cols) --}}
        <div class="lg:col-span-7 space-y-8">
            <div class="text-center lg:text-left">
                <h2 id="pilih-kursi" class="text-3xl font-bold text-gray-800">Pilih Jadwal & Kursi</h2>
                <div class="w-20 h-1 bg-red-600 mt-4 rounded-full mx-auto lg:mx-0"></div>
            </div>

            {{-- Toggle Trip --}}
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-sm font-bold text-gray-500 mb-3 uppercase tracking-wider">Pilih Jadwal Keberangkatan:</p>
                <div class="flex flex-wrap gap-3">
                    @foreach ($trips as $trip)
                        <button wire:click="$set('trip_id', {{ $trip->id }})" @class([
                            'px-4 py-2 rounded-xl border-2 transition-all font-bold text-sm',
                            'border-red-600 bg-red-600 text-white' => $trip_id == $trip->id,
                            'border-gray-200 bg-white text-gray-600 hover:border-red-300' =>
                                $trip_id != $trip->id,
                        ])>
                            {{ $trip->jadwal_trip }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Denah Kursi BUS --}}
            {{-- Kursi BUS --}}
            {{-- Container Utama: Body Bus MBS Trans --}}
            <div
                class="max-w-md mx-auto bg-slate-900 rounded-t-[60px] rounded-b-2xl shadow-2xl p-1 border-x-4 border-slate-800">

                {{-- Area Depan / Dashboard & Kaca (Tanpa Kursi) --}}
                <div
                    class="h-24 bg-gradient-to-b from-slate-950 to-slate-800 rounded-t-[55px] relative overflow-hidden border-b-4 border-red-700">
                    {{-- Simulasi Wiper / Dashboard --}}
                    <div
                        class="absolute bottom-2 left-1/2 -translate-x-1/2 w-32 h-1 bg-slate-700 rounded-full opacity-50">
                    </div>
                    {{-- Nama Bus di Kaca Depan --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-slate-600 font-black text-xl tracking-[0.2em] opacity-20 uppercase">MBS
                            Trans</span>
                    </div>
                </div>

                {{-- Area Kabin Penumpang --}}
                <div class="bg-slate-200 p-4 shadow-inner relative">

                    {{-- Visual Lorong Tengah --}}
                    <div class="absolute inset-y-0 left-1/2 -translate-x-1/2 w-10 bg-slate-300/50 shadow-inner -z-0">
                    </div>

                    {{-- Grid Kursi Utama 2-1-2 --}}
                    <div class="grid grid-cols-5 gap-3 mb-4 relative z-10">
                        @foreach (range(1, 44, 4) as $rowStart)
                            {{-- Sisi Kiri (2 Kursi) --}}
                            <div class="col-span-2 grid grid-cols-2 gap-2">
                                @for ($i = $rowStart; $i < $rowStart + 2; $i++)
                                    @php
                                        // Mencari data seat berdasarkan nomor format #1, #2, dst
                                        $seat = $seats->firstWhere('seat_number', '#' . $i);
                                    @endphp
                                    @if ($seat)
                                        @include('livewire.partials.seat-button', ['seat' => $seat])
                                    @endif
                                @endfor
                            </div>

                            {{-- Jalan Tengah --}}
                            <div class="col-span-1"></div>

                            {{-- Sisi Kanan (2 Kursi) --}}
                            <div class="col-span-2 grid grid-cols-2 gap-2">
                                @for ($i = $rowStart + 2; $i < $rowStart + 4; $i++)
                                    @php
                                        $seat = $seats->firstWhere('seat_number', '#' . $i);
                                    @endphp
                                    @if ($seat)
                                        @include('livewire.partials.seat-button', ['seat' => $seat])
                                    @endif
                                @endfor
                            </div>
                        @endforeach
                    </div>

                    {{-- Baris Paling Belakang (6 Kursi Full) --}}
                    <div class="mt-8 pt-6 border-t-4 border-double border-slate-400">
                        <div class="grid grid-cols-6 gap-1.5 relative z-10">
                            @foreach (range(45, 50) as $i)
                                @php
                                    $seat = $seats->firstWhere('seat_number', '#' . $i);
                                @endphp
                                @if ($seat)
                                    @include('livewire.partials.seat-button', ['seat' => $seat])
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Bagian Belakang & Lampu --}}
                <div
                    class="h-8 bg-slate-900 rounded-b-xl flex justify-between px-8 items-center border-t border-slate-800">
                    <div class="w-10 h-3 bg-red-600 rounded-sm shadow-[0_0_10px_rgba(220,38,38,0.5)]"></div>
                    <div class="w-10 h-3 bg-red-600 rounded-sm shadow-[0_0_10px_rgba(220,38,38,0.5)]"></div>
                </div>
            </div>

            {{-- Legend --}}
            <div class="flex justify-center gap-8 mt-6 pb-8">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-green-500 rounded-sm"></div>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Tersedia</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-red-500 rounded-sm"></div>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Terisi</span>
                </div>
            </div>

            {{-- //Kursi BUS --}}
        </div>

        {{-- Kanan: Kritik Saran & Rute (Desktop: 4-5 cols) --}}
        <div class="lg:col-span-5 space-y-8">
            {{-- Kritik & Saran Form --}}
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
                <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                    <x-icon name="o-chat-bubble-left-right" class="w-6 h-6 text-red-600" />
                    Kritik & Saran
                </h3>
                <form wire:submit.prevent="sendFeedback" class="space-y-4">
                    <x-input label="Nama Anda" wire:model="feedback_nama" placeholder="Contoh: Budi" icon="o-user" />
                    <x-textarea label="Pesan" wire:model="feedback_pesan"
                        placeholder="Berikan masukan untuk MBS Trans..." rows="4" />
                    <x-button type="submit" label="Kirim Masukan" class="btn-primary bg-red-600 w-full text-white" />
                </form>
            </div>

            {{-- Informasi Rute (Copy dari section rute) --}}
            <div class="bg-blue-600 p-8 rounded-3xl text-white shadow-xl">
                <h3 class="text-xl font-bold mb-4">Layanan Pantura</h3>
                <p class="text-blue-100 text-sm mb-4">Anda bisa turun di kota-kota searah jalan Pantura:</p>
                <div class="flex flex-wrap gap-2">
                    @foreach (['Tegal', 'Pemalang', 'Pekalongan', 'Semarang'] as $kota)
                        <span class="px-2 py-1 bg-white/20 rounded-md text-xs font-bold">{{ $kota }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if (count($selectedSeats) > 0)
        @php
            $selectedNumbers = $this->seats->whereIn('id', $selectedSeats)->pluck('seat_number')->toArray();
            $seatList = implode(', ', $selectedNumbers);

            $currentTrip = $this->trips->firstWhere('id', $this->trip_id);
            $jadwalTrip = $currentTrip ? $currentTrip->jadwal_trip : '-';
            $tujuan = $currentTrip ? $currentTrip->rute : '-';

            $pesanWa = "Halo Pak Saliwang, saya mau booking MBS Trans untuk jadwal $jadwalTrip tujuan $tujuan. Kursi nomor: $seatList. Apakah masih tersedia?";
        @endphp

        <div
            class="z-[99] fixed bottom-0 left-0 right-0 p-4 bg-white/90 backdrop-blur-md border-t shadow-lg flex justify-between items-center max-w-md mx-auto rounded-t-2xl">
            <div class="flex flex-col">
                <span class="text-[10px] text-gray-500 uppercase font-black tracking-wider">Kursi Terpilih</span>
                <span class="text-sm font-bold text-blue-600">
                    {{ $seatList }}
                </span>
            </div>

            <a href="https://wa.me/6287703631260?text={{ urlencode($pesanWa) }}" target="_blank"
                class="bg-green-500 text-white px-6 py-2 rounded-xl font-bold active:scale-95 transition shadow-md flex items-center gap-2">
                <x-icon name="o-paper-airplane" class="w-4 h-4" />
                Booking ({{ count($selectedSeats) }})
            </a>
        </div>
    @endif
</div>
