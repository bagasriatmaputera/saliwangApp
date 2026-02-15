
<div class="max-w-md mx-auto bg-gray-50 min-h-screen p-4 pb-24">
    <h2 class="text-xl font-bold text-center mb-6">Pilih Kursi Bus</h2>

    {{-- Kursi BUS --}}
    <div class="grid grid-cols-5 gap-3 mb-4">
        @foreach(range(1, 44, 4) as $rowStart)
            <div class="col-span-2 grid grid-cols-2 gap-2">
                @for($i = $rowStart; $i < $rowStart + 2; $i++)
                    @include('partials.seat-button', ['number' => $i])
                @endfor
            </div>

            <div class="col-span-1"></div>

            <div class="col-span-2 grid grid-cols-2 gap-2">
                @for($i = $rowStart + 2; $i < $rowStart + 4; $i++)
                    @include('partials.seat-button', ['number' => $i])
                @endfor
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-6 gap-2 mt-2">
        @foreach(range(45, 50) as $i)
            @include('partials.seat-button', ['number' => $i])
        @endforeach
    </div>

    {{-- //Kursi BUS --}}

    @if(count($selectedSeats) > 0)
    <div class="fixed bottom-0 left-0 right-0 p-4 bg-white border-t shadow-lg flex justify-between items-center max-w-md mx-auto">
        <div class="flex flex-col">
            <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Kursi Terpilih</span>
            <span class="text-sm font-bold text-blue-600">
                {{ implode(', ', $selectedSeats) }}
            </span>
        </div>
        
        @php
            $seatList = implode(', ', $selectedSeats);
            $waMessage = "Halo Pak Saliwang, saya mau booking kursi nomor: $seatList. Apakah tersedia?";
        @endphp

        <a href="https://wa.me/6287703631260?text={{ urlencode($waMessage) }}" 
           target="_blank"
           class="bg-green-500 text-white px-6 py-2 rounded-lg font-semibold active:scale-95 transition shadow-md">
            Booking ({{ count($selectedSeats) }})
        </a>
    </div>
@endif
</div>