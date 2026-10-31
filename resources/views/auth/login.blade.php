@extends('layouts.auth')

@section('title', 'Masuk - Bloomcraft')

@section('content')

<section class="auth-section">

    <div class="auth-container">

        <div class="auth-header">

            <div class="auth-label">
                SELAMAT DATANG KEMBALI
            </div>

            <h1>
                Masuk ke Akun
            </h1>

            <p>
                Masuk untuk melihat akun dan pesanan Anda.
            </p>

        </div>


        @if(session('success'))

            <div class="alert success">
                {{ session('success') }}
            </div>

        @endif


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
            action="{{ route('login.store') }}"
            method="POST"
            class="auth-form"
        >

            @csrf


            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email Anda"
                    required
                    autofocus
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Kata sandi
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >

            </div>


            <div class="remember-row">

                <label>

                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    Ingat saya

                </label>

            </div>


            <button
                type="submit"
                class="auth-button"
            >
                Masuk ke Akun
            </button>

        </form>


        <div class="auth-footer">

            Belum memiliki akun?

            <a href="{{ route('register') }}">
                Buat akun
            </a>

        </div>

    </div>

</section>

@endsection
