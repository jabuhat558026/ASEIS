{{-- resources/views/student/account.blade.php --}}
@extends('layouts.student')
@section('title', 'Account Settings')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Account Settings</h1>
    <p class="text-gray-500 text-sm mt-1">Update your account information</p>
</div>

{{-- Profile Card --}}
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6 flex items-center gap-4">
    <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
    </div>
    <div>
        <p class="text-xl font-bold text-gray-900">{{ $user->name }}</p>
        <p class="text-sm text-gray-500">Student ID: {{ $user->student_id }}</p>
        <p class="text-xs text-gray-400">Member since {{ optional($user->enrollment_date)->format('Y-m-d') ?? $user->created_at->format('Y-m-d') }}</p>
    </div>
</div>

{{-- Edit Form --}}
<div class="bg-white rounded-xl border border-gray-200 p-6 max-w-lg">
    <div class="flex items-center justify-between mb-5">
        <p class="font-semibold text-gray-900">Personal Information</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-4 text-sm">
            @foreach ($errors->all() as $err)<p>{{ $err }}</p>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('student.account.update') }}" class="space-y-5">
        @csrf @method('PUT')

        {{-- Full Name --}}
        <div class="border-b border-gray-100 pb-4">
            <div class="flex items-center gap-2 mb-1">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <label class="text-xs text-gray-500">Full Name</label>
            </div>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
        </div>

        {{-- Email --}}
        <div class="border-b border-gray-100 pb-4">
            <div class="flex items-center gap-2 mb-1">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <label class="text-xs text-gray-500">Email Address</label>
            </div>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
        </div>

        {{-- Major --}}
        <div class="border-b border-gray-100 pb-4">
            <div class="flex items-center gap-2 mb-1">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
                </svg>
                <label class="text-xs text-gray-500">Major</label>
            </div>
            <input type="text" name="major" value="{{ old('major', $user->major) }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
        </div>

        {{-- Student ID (read-only) --}}
        <div class="pb-4">
            <div class="flex items-center gap-2 mb-1">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2"/>
                </svg>
                <label class="text-xs text-gray-500">Student ID</label>
            </div>
            <input type="text" value="{{ $user->student_id }}" disabled
                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 text-gray-500 font-mono">
            <p class="text-xs text-gray-400 mt-1">Cannot be changed</p>
        </div>

        {{-- Change Password (optional) --}}
        <div class="border-t border-gray-100 pt-4">
            <p class="text-sm font-medium text-gray-700 mb-3">Change Password <span class="text-gray-400 font-normal">(leave blank to keep current)</span></p>
            <div class="space-y-3">
                <div>
                    <label class="text-xs text-gray-500 mb-1 block">Current Password</label>
                    <input type="password" name="current_password"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                <div>
                    <label class="text-xs text-gray-500 mb-1 block">New Password</label>
                    <input type="password" name="password"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                <div>
                    <label class="text-xs text-gray-500 mb-1 block">Confirm New Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2.5 text-sm font-semibold transition">
            Edit Profile
        </button>
    </form>
</div>
@endsection