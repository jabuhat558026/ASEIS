@extends('layouts.student')
@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Welcome, {{ $student->name }}</h1>
    <p class="text-blue-600 text-sm mt-1">
        Student ID: {{ $student->student_id }} | Course: {{ $student->major ?? 'N/A' }}
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

{{-- Schedule --}}
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
        <p class="text-gray-400 text-sm">No active enrollments. <a href="{{ route('student.enroll.index') }}" class="text-blue-600 underline">Enroll now</a>.</p>
    @endif
</div>
@endsection