<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5" >
        @csrf

        <!-- Name -->
        <div class="space-y-1">
            <x-input-label class="text-sm font-semibold text-gray-900" for="name" :value="__('Name')" />
            <x-text-input id="name" class="w-full h-10 px-4 border border-gray-300 rounded-lg bg-white
    focus:outline-none focus:ring-2 focus:ring-[#14422d]
    focus:border-[#14422d] transition" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </>

        <!-- Email Address -->
        <div class="space-y-1">
            <x-input-label class="text-sm font-semibold text-gray-900" for="email" :value="__('Email')" />
            <x-text-input id="email" class="w-full h-10 px-4 border border-gray-300 rounded-lg bg-white
    focus:outline-none focus:ring-2 focus:ring-[#14422d]
    focus:border-[#14422d] transition" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <x-input-label class="text-sm font-semibold text-gray-900" for="password" :value="__('Password')" />

            <x-text-input class="w-full h-10 px-4 border border-gray-300 rounded-lg bg-white
    focus:outline-none focus:ring-2 focus:ring-[#14422d]
    focus:border-[#14422d] transition" id="password" 
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1">
            <x-input-label class="text-sm font-semibold text-gray-900" for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="w-full h-10 px-4 border border-gray-300 rounded-lg bg-white
    focus:outline-none focus:ring-2 focus:ring-[#14422d]
    focus:border-[#14422d] transition"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 " />
        </div>

        <div class="flex items-center justify-center gap-6 mt-6 pt-4">
            <a class="text-[#14422d] font-semibold hover:underline" href="{{ route('login') }}">
                {{ __('Já Possui Uma Conta?') }}
            </a>

            <x-primary-button class="ms-4  h-10 bg-[#14422d] hover:bg-[#2d5a43]
text-white font-semibold rounded-lg shadow-md
transition active:scale-95 justify-center">
                {{ __('Registrar') }}
            </x-primary-button>
        </>
    </form>
</x-guest-layout>
