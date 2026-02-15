<button 
    wire:click="selectSeat({{ $number }})"
    @disabled(in_array($number, $bookedSeats))
    class="aspect-square border-2 rounded flex items-center justify-center text-sm font-bold transition
    {{ in_array($number, $bookedSeats) ? 'bg-gray-300 border-gray-400 text-gray-500 cursor-not-allowed' : 
       (in_array($number, $selectedSeats) ? 'bg-blue-500 border-blue-600 text-white' : 'bg-white border-gray-300 text-gray-700 active:bg-blue-100') }}"
>
    {{ $number }}
</button>