@extends('layouts.admin')
@section('title', 'Add Student')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Register Student Account</h1>
    <p class="text-gray-500 text-sm mt-1">Create a new student account</p>
</div>

<div class="bg-white rounded-xl border border-gray-200 p-6 max-w-2xl">
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-4 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.students.store') }}" class="space-y-4">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Student ID</label>
                <input type="text" name="student_id" value="{{ old('student_id') }}" required placeholder="e.g. STU003"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Major / Course</label>
            <input type="text" name="major" value="{{ old('major') }}" placeholder="e.g. Computer Science"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Enrollment Date</label>
            <input type="date" name="enrollment_date" value="{{ old('enrollment_date', now()->toDateString()) }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-gray-900 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-gray-700 transition">
                Save Student
            </button>
            <a href="{{ route('admin.students.index') }}"
                class="border border-gray-300 text-gray-700 px-5 py-2 rounded-lg text-sm font-semibold hover:bg-gray-50 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection