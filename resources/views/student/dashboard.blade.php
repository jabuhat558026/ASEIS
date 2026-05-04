{{-- resources/views/student/dashboard.blade.php --}}
@extends('layouts.student')
@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Welcome, {{ $student->name }}</h1>
    <p class="text-blue-600 text-sm mt-1">
        Student ID: {{ $student->student_id ?? 'N/A' }} &nbsp;|&nbsp;
        Course: {{ $student->major ?? 'N/A' }}
    </p>
</div>

{{-- Stats --}}
<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <p class="text-gray-500 text-sm mb-1">Active Subjects</p>
        <p class="text-3xl font-bold text-gray-900">{{ $active->count() }}</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <p class="text-gray-500 text-sm mb-1">Total Credits</p>
        <p class="text-3xl font-bold text-gray-900">{{ $totalCredits }}</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <p class="text-gray-500 text-sm mb-1">Completed</p>
        <p class="text-3xl font-bold text-gray-900">{{ $completed->count() }}</p>
    </div>
</div>

{{-- Schedule Table --}}
<div class="bg-white rounded-xl border border-gray-200 p-5">
    <h2 class="font-semibold text-gray-900 mb-4">Current Semester Schedule</h2>
    @if ($active->count())
    <table class="w-full text-sm">
        <thead class="bg-gray-50 rounded-lg">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Course Code</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subject Name</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Instructor</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Schedule</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Credits</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach ($active as $e)
            <tr>
                <td class="px-4 py-3 font-mono text-gray-700">{{ $e->course->code }}</td>
                <td class="px-4 py-3 text-blue-600 font-medium">{{ $e->course->name }}</td>
                <td class="px-4 py-3 text-blue-600">{{ $e->course->instructor }}</td>
                <td class="px-4 py-3 text-blue-600">{{ $e->course->schedule }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $e->course->credits }}</td>
                <td class="px-4 py-3">
                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-medium">active</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <div class="text-center py-8 text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
            </svg>
            <p class="text-sm">No active enrollments yet.</p>
            <a href="{{ route('student.enroll.index') }}"
               class="inline-block mt-2 text-blue-600 text-sm underline">Browse available courses</a>
        </div>
    @endif
</div>
@endsection