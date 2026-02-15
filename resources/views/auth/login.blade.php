<x-guest-layout>
    <div class="mb-4 text-center">
        <h1 class="text-2xl font-bold text-gray-800">MBS Trans</h1>
        <p class="text-sm text-gray-600">Admin Login Portal</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700">
                Masuk ke Panel Admin
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>