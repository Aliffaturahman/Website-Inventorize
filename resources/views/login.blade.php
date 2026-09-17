@extends('template')

@section('content')
<div class="login-page">

    <div class="login-shape shape-one"></div>
    <div class="login-shape shape-two"></div>

    <div class="login-container">

        <!-- BRANDING -->
        <div class="login-brand">

            <div class="brand-logo">
                <img src="{{ asset('img/logo/husker.png') }}" alt="Husker Logo">
            </div>

            <div class="brand-info">
                <span class="brand-label">INVENTORY MANAGEMENT SYSTEM</span>
                <h1>HUSKER</h1>
                <div class="brand-accent"></div>
                <p>Smart inventory management for a more efficient workflow.</p>
            </div>

        </div>

        <!-- LOGIN -->
        <div class="login-panel">

            <div class="login-top">
                <span class="login-overline">ADMIN PORTAL</span>

                <h2>Welcome back.</h2>

                <p>
                    Sign in to manage your inventory and
                    keep everything running smoothly.
                </p>
            </div>

            <form action="{{ route('admin.login') }}" method="post">
                @csrf

                <div class="login-field">
                    <label for="email">EMAIL ADDRESS</label>

                    <div class="field-box">
                        <i class="fas fa-envelope"></i>

                        <input type="email"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            class="{{ $errors->has('email') ? 'has-error' : '' }}"
                            required>
                    </div>

                    @error('email')
                        <small class="login-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="login-field">
                    <label for="password">PASSWORD</label>

                    <div class="field-box">
                        <i class="fas fa-lock"></i>

                        <input type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            class="{{ $errors->has('password') ? 'has-error' : '' }}"
                            required>
                    </div>

                    @error('password')
                        <small class="login-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="login-options">
                    <label>
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                </div>

                <button type="submit" class="login-button">
                    <span>Sign In</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

            </form>

            <div class="login-security">
                <i class="fas fa-lock"></i>
                Authorized personnel only
            </div>

        </div>

    </div>
</div>
@endsection