@extends('layouts.auth')

@section('title', 'Create Account - Maison')

@section('content')

<section class="auth-section">

    <div class="auth-container">

        <div class="auth-header">

            <div class="auth-label">
                New Customer
            </div>

            <h1>
                Create Account
            </h1>

            <p>
                Create an account to manage your orders
                and checkout faster.
            </p>

        </div>


        @if($errors->any())

            <div class="alert error">

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif


        <form
            action="{{ route('register.store') }}"
            method="POST"
            class="auth-form"
        >

            @csrf


            <div class="form-group">

                <label for="name">
                    Full Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter your name"
                    required
                    autofocus
                >

            </div>


            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimum 8 characters"
                    required
                >

            </div>


            <div class="form-group">

                <label for="password_confirmation">
                    Confirm Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Repeat your password"
                    required
                >

            </div>


            <button
                type="submit"
                class="auth-button"
            >
                Create Account
            </button>

        </form>


        <div class="auth-footer">

            Already have an account?

            <a href="{{ route('login') }}">
                Sign in
            </a>

        </div>

    </div>

</section>

@endsection
