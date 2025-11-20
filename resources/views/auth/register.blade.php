@extends('layouts.app')

@section('content')
<div class="login-container">
    <div style="text-align: center; margin-bottom: 20px;">
        <h2>{{ __('Login') }}</h2>
    </div>

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        {{-- Email Address --}}
        <label for="email">{{ __('Email Address') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="alert" role="alert" style="margin-top: 5px;">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        {{-- Password --}}
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">
        @error('password')
            <span class="alert" role="alert" style="margin-top: 5px;">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        {{-- Remember Me & Forgot Password (Opsional) --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
            <label style="font-weight: normal; text-align: left;">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                {{ __('Remember Me') }}
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size: 0.9em; text-decoration: none; color: #0066cc;">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>

        {{-- Submit Button --}}
        <button type="submit">
            {{ __('Login') }}
        </button>
    </form>
</div>
@endsection