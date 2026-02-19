<button 
    wire:click="selectSeat({{ $seat->id }})"
    @disabled($seat->bookings_exists)
    @class([
        'aspect-square border-2 rounded flex flex-col items-center justify-center text-sm font-bold transition active:scale-95',
        // Kondisi jika kursi sudah dipesan (Database)
        'bg-red-500 border-red-600 text-white cursor-not-allowed opacity-90' => $seat->bookings_exists,
        
        // Kondisi jika kursi sedang dipilih oleh user saat ini
        'bg-blue-600 border-blue-800 text-white shadow-lg' => !$seat->bookings_exists && in_array($seat->id, $selectedSeats),
        
        // Kondisi jika kursi masih kosong dan belum dipilih
        'bg-green-500 border-green-600 text-white hover:bg-green-600 shadow-sm' => !$seat->bookings_exists && !in_array($seat->id, $selectedSeats),
    ])
>
    <span class="text-[10px] opacity-75 leading-none mb-0.5">SEAT</span>
    {{ $seat->seat_number }}
</button>