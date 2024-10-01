<!-- resources/views/admin/login.blade.php -->

@extends('layouts.layout')

@section('content')
    <!-- Main Content -->
    <div
        class="flex flex-col w-full  overflow-hidden relative min-h-screen radial-gradient items-center justify-center g-0 px-4">
        <div class="justify-center items-center w-full card lg:flex max-w-md ">
            <div class="w-full card-body">
                <a href="/" class="py-4 block">
                    <img src="{{ asset('assets/images/logos/logopgri2.png') }}" alt="" class="mx-auto max-w-64" />
                </a>
                <p class="mb-4 text-gray-500 text-sm text-center">Your Social Campaigns</p>

                <!-- form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Username -->
                    <div class="mb-4">
                        <label for="forUsername" class="block text-sm font-semibold mb-2 text-gray-600">Username</label>
                        <input type="email" id="forUsername" name="email"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            aria-describedby="hs-input-helper-text" required autofocus>
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="forPassword" class="block text-sm font-semibold mb-2 text-gray-600">Password</label>
                        <input type="password" id="forPassword" name="password"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            aria-describedby="hs-input-helper-text" required>
                    </div>

                    <!-- Checkbox -->
                    <div class="flex justify-between mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember"
                                class="shrink-0 mt-0.5 border-gray-200 rounded-[4px] text-blue-600 focus:ring-blue-500">
                            <label for="remember" class="text-sm text-gray-600 ms-3">Remember this device</label>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="grid my-6">
                        <button type="submit"
                            class="btn bg-blue-600 hover:bg-blue-700 py-[10px] text-base text-white font-medium">Sign
                            In</button>
                    </div>

                    <!-- Optional Info for Admin -->
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Removed Register Link for Admin-Only Signup -->
                </form>
            </div>
        </div>
    </div>
@endsection
