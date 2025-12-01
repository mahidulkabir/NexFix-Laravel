<x-guest-layout>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        

        .register-card {
            width: 480px;
            border-radius: 16px;
            background: #fff;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            animation: fadeIn 0.6s ease;
        }

        .btn-theme {
            background: linear-gradient(135deg, #FFB524, #81C408);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 6px;
            transition: 0.3s ease-in-out;
        }

        .btn-theme:hover {
            background: linear-gradient(135deg, #e49f20, #6aac06);
            color: #fff;
        }

        .title-text {
            background: linear-gradient(135deg, #FFB524, #81C408);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
        }

        a.theme-link {
            color: #FFB524;
            font-weight: 500;
        }

        a.theme-link:hover {
            color: #e49f20;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>

    <div class="register-card mt-5 mb-5">
        <h3 class="text-center mb-4 title-text">Create Account</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autofocus>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">{{ __('Email') }}</label>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label class="form-label">{{ __('Phone') }}</label>
                <input id="phone" type="text"
                    class="form-control @error('phone') is-invalid @enderror"
                    name="phone" value="{{ old('phone') }}" required>
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="role" class="form-label">Register as:</label>
                <select name="role" id="role" class="form-select">
                    <option value="user">User</option>
                    <option value="vendor">Vendor</option>
                </select>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation" required>
                @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Login Link -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('login') }}" class="theme-link">
                    {{ __('Already registered?') }}
                </a>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-theme w-100 py-2">
                {{ __('Register') }}
            </button>
        </form>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</x-guest-layout>
