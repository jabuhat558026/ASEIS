{{-- resources/views/student/my-subjects.blade.php --}}
@extends('layouts.student')
@section('title', 'My Subjects')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">My Subjects</h1>
    <p class="text-gray-500 text-sm mt-1">View all your enrolled courses and schedule</p>
</div>

{{-- Student Info Card --}}
<div class="bg-white rounded-xl border border-gray-200 p-5 mb-6 flex items-center gap-4">
    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
    </div>
    <div>
        <p class="font-bold text-gray-900">{{ $user->name }}</p>
        <p class="text-xs text-gray-500">
            Student ID: {{ $user->student_id }} &nbsp;|&nbsp;
            Course: {{ $user->major ?? 'N/A' }} &nbsp;|&nbsp;
            Total Credits: {{ $totalCredits }}
        </p>
    </div>
</div>

{{-- Active Subjects --}}
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-gray-100">
        <p class="font-semibold text-gray-900">Active Subjects ({{ $active->count() }})</p>
    </div>
    @if ($active->count())
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Course Code</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subject Name</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Instructor</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Schedule</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Credits</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Enrollment Date</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach ($active as $e)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 font-mono text-gray-700">{{ $e->course->code }}</td>
                <td class="px-5 py-4 text-blue-600 font-medium">{{ $e->course->name }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $e->course->instructor }}</td>
                <td class="px-5 py-4 text-blue-600">{{ $e->course->schedule }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $e->course->credits }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $e->enrollment_date->format('Y-m-d') }}</td>
                <td class="px-5 py-4">
                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-medium">active</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <div class="px-5 py-8 text-center text-gray-400">
            <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
            </svg>
            <p class="text-sm">No active subjects.</p>
        </div>
    @endif
</div>

{{-- Completed Subjects --}}
<div class="mb-6">
    <p class="font-semibold text-gray-700 mb-3">Completed Subjects ({{ $completed->count() }})</p>
    @if ($completed->count())
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Course Code</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subject Name</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Instructor</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Credits</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($completed as $e)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-4 font-mono text-gray-700">{{ $e->course->code }}</td>
                    <td class="px-5 py-4 font-medium text-gray-900">{{ $e->course->name }}</td>
                    <td class="px-5 py-4 text-gray-600">{{ $e->course->instructor }}</td>
                    <td class="px-5 py-4 text-gray-600">{{ $e->course->credits }}</td>
                    <td class="px-5 py-4">
                        <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs font-medium">completed</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="bg-white rounded-xl border border-gray-200 px-5 py-8 text-center text-gray-400">
            <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
            </svg>
            <p class="text-sm">No subjects in this category</p>
        </div>
    @endif
</div>

{{-- Dropped Subjects --}}
<div>
    <p class="font-semibold text-red-500 mb-3">Dropped Subjects ({{ $dropped->count() }})</p>
    @if ($dropped->count())
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Course Code</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subject Name</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Credits</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($dropped as $e)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-4 font-mono text-gray-700">{{ $e->course->code }}</td>
                    <td class="px-5 py-4 text-gray-500 line-through">{{ $e->course->name }}</td>
                    <td class="px-5 py-4 text-gray-500">{{ $e->course->credits }}</td>
                    <td class="px-5 py-4">
                        <span class="bg-red-100 text-red-600 px-2 py-0.5 rounded-full text-xs font-medium">dropped</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="bg-white rounded-xl border border-gray-200 px-5 py-8 text-center text-gray-400">
            <p class="text-sm">No dropped subjects</p>
        </div>
    @endif
</div>
@endsection