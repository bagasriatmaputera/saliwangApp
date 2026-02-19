<div>
    <x-button label="Tambah Booking Manual" @click="$wire.bookingModal = true" icon="o-plus" class="btn-primary" />

    <x-modal wire:model="myModal" title="Form Reservasi MBS Trans" subtitle="Input data sesuai identitas pemesan" separator>
        <div class="grid gap-4">
            {{-- Input Hidden atau Select untuk ID --}}
            <div class="grid grid-cols-2 gap-4">
                <x-input label="Bus ID" wire:model="bus_id" type="number" readonly />
                <x-input label="Nomor Kursi" wire:model="seat_id" readonly />
            </div>

            <x-input label="Nama Pemesan" wire:model="nama_pemesan" icon="o-user" placeholder="Nama lengkap..." />
            
            <x-input label="Nomor WhatsApp" wire:model="no_hp" icon="o-phone" placeholder="0812..." />

            <x-input label="Kota Tujuan" wire:model="tujuan" icon="o-map-pin" placeholder="Contoh: Jakarta" />

            <x-textarea label="Titik Penjemputan" wire:model="titik_jemput" placeholder="Detail lokasi jemput..." rows="3" inline />
        </div>

        <x-slot:actions>
            <x-button label="Batal" @click="$wire.myModal = false" />
            <x-button label="Simpan Booking" class="btn-primary" icon="o-paper-plane" wire:click="save" spinner="save" />
        </x-slot:actions>
    </x-modal>
</div>