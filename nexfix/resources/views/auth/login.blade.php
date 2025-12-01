<x-guest-layout>
    {{-- Add Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg p-4" style="width: 420px; border-radius: 12px;">

            <h3 class="text-center mb-4 fw-bold"
                style="
        background: linear-gradient(135deg, #FFB524, #81C408);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    ">
                Login
            </h3>


            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autofocus>

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required>

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">
                        {{ __('Remember me') }}
                    </label>
                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-100 py-2 border-0 text-white fw-semibold"
                    style="
        background: linear-gradient(135deg, #FFB524, #81C408);
        border-radius: 6px;
        transition: 0.3s ease-in-out;
    "
                    onmouseover="this.style.background='linear-gradient(135deg, #e49f20, #6aac06)'"
                    onmouseout="this.style.background='linear-gradient(135deg, #FFB524, #81C408)'">
                    {{ __('Log in') }}
                </button>

            </form>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</x-guest-layout>
