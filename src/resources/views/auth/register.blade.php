@extends('layouts.app')

@section('title', 'Register')

@section('content')
<body class="font-inter overflow-hidden">
    <section class="flex justify-center relative">
        <img src="https://pagedone.io/asset/uploads/1702362010.png" alt="gradient background image" class="w-full h-full object-cover fixed">

        <div class="mx-auto max-w-lg  absolute ">
            <div class="text-gray-900 text-center font-manrope text-3xl font-bold leading-10 m-8 "><img src="{{ asset('assets/logo.png') }}" alt="Local Mind Logo" class="mx-auto w-16 h-16 inline pb-1">Local Mind</div>

            <div class="rounded-2xl bg-white shadow-xl">
                <form method="POST" action="{{ route('register') }}" class="lg:p-11 p-7 mx-auto">
                    @csrf

                    <div class="mb-11">
                        <h1 class="text-gray-900 text-center font-manrope text-3xl font-bold leading-10 mb-2">Create Account</h1>
                    </div>

                    <div class="mb-6">
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full h-12 text-gray-900 placeholder:text-gray-400 text-lg font-normal leading-7 rounded-full border-gray-300 border shadow-sm focus:outline-none px-4"
                            placeholder="Full Name">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full h-12 text-gray-900 placeholder:text-gray-400 text-lg font-normal leading-7 rounded-full border-gray-300 border shadow-sm focus:outline-none px-4"
                            placeholder="Email">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <input type="password" name="password"
                            class="w-full h-12 text-gray-900 placeholder:text-gray-400 text-lg font-normal leading-7 rounded-full border-gray-300 border shadow-sm focus:outline-none px-4"
                            placeholder="Password">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="password" name="password_confirmation"
                        class="w-full h-12 text-gray-900 placeholder:text-gray-400 text-lg font-normal leading-7 rounded-full border-gray-300 border shadow-sm focus:outline-none px-4 mb-6"
                        placeholder="Confirm Password">

                    <button type="submit"
                        class="w-full h-12 text-white text-center text-base font-semibold leading-6 rounded-full hover:bg-indigo-800 transition-all duration-700 bg-indigo-600 shadow-sm mb-11">
                        Register
                    </button>

                    <a href="{{ route('login') }}" class="flex justify-center text-gray-900 text-base font-medium leading-6">
                        Already have an account? <span class="text-indigo-600 font-semibold pl-3">Login</span>
                    </a>
                </form>
            </div>
        </div>
    </section>
</body>
@endsection
