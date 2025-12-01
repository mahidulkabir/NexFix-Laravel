<x-guest-layout>

    <!-- Wrapper Card -->
    <div class="bg-white backdrop-blur-sm p-5 rounded-2xl shadow-xl w-full max-w-md mx-auto">

        <!-- Page Title -->
        <h2 class="text-3xl font-extrabold text-center mb-6 bg-clip-text text-transparent p-5" 
            style="background-image: linear-gradient(90deg, #ffb524, #81c408);">
            Forgot Password
        </h2>

        <p class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just enter your email and we will send a reset link.') }}
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" 
                              type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <button type="submit"
                    class="px-5 py-2 rounded-lg font-semibold text-white shadow-md transition 
                           hover:opacity-90"
                    style="background: linear-gradient(90deg, #ffb524, #81c408);">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>

    </div>

</x-guest-layout>
