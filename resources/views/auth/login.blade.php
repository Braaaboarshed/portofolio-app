@extends('layout')

@section('title', 'Login')

<div class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f4f4f9;">
    <div class="login-container" style="width: 100%; max-width: 400px; padding: 2rem; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h2 class="text-center">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                @error('password')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
