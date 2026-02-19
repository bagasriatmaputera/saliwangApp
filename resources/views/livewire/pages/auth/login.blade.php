<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.app')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

{{-- @include('components.layouts.app') --}}
<div
    class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-red-700 via-red-600 to-red-800">

    {{-- Logo & Brand Section --}}
    <div class="mb-8 text-center animate__animated animate__fadeInDown">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-3xl shadow-2xl mb-4 rotate-3">
            <x-icon name="o-truck" class="w-12 h-12 text-red-600" />
        </div>
        <h2 class="text-3xl font-black text-white tracking-tighter uppercase">MBS Trans</h2>
        <p class="text-red-100 text-xs font-bold uppercase tracking-widest opacity-80">Admin Control Panel</p>
    </div>

    {{-- Login Card --}}
    <div
        class="w-full sm:max-w-md px-8 py-10 bg-white/95 backdrop-blur-md shadow-[0_20px_50px_rgba(0,0,0,0.3)] sm:rounded-[2rem] animate__animated animate__zoomIn">

        <div class="mb-8 text-center">
            <h3 class="text-xl font-bold text-gray-800">Selamat Datang Kembali</h3>
            <p class="text-sm text-gray-500">Silakan masuk untuk mengelola trip</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login" class="space-y-5">
            {{-- Email --}}
            <div>
                <x-input label="Email Address" wire:model="form.email" icon="o-envelope" inline
                    class="focus:ring-red-500 border-gray-200" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-1" />
            </div>

            {{-- Password --}}
            <div>
                <x-input label="Password" wire:model="form.password" type="password" icon="o-key" inline
                    class="focus:ring-red-500 border-gray-200" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-1" />
            </div>

            {{-- Remember & Forgot --}}
            {{-- <div class="flex items-center justify-between">
                <label for="remember" class="inline-flex items-center cursor-pointer">
                    <input wire:model="form.remember" id="remember" type="checkbox"
                        class="rounded-md border-gray-300 text-red-600 shadow-sm focus:ring-red-500">
                    <span class="ms-2 text-xs font-bold text-gray-600 uppercase tracking-tighter">Ingat Saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-blue-600 hover:text-red-600 transition-colors uppercase tracking-tighter"
                        href="{{ route('password.request') }}" wire:navigate>
                        Lupa Sandi?
                    </a>
                @endif
            </div> --}}

            {{-- Submit Button --}}
            <div class="pt-2">
                <x-button label="Masuk Sekarang" type="submit"
                    class="btn-primary w-full h-14 bg-red-600 border-none hover:bg-red-700 text-white font-black shadow-xl shadow-red-200 uppercase tracking-widest"
                    spinner="login" />
            </div>
        </form>
    </div>

    {{-- Footer Info --}}
    <p class="mt-8 text-red-100 text-[10px] font-medium uppercase tracking-[0.3em] opacity-60">
        &copy; 2026 MBS Trans - Mudik Bareng Saliwang
    </p>
</div>
