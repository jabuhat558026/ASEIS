{{-- resources/views/student/drop.blade.php --}}
@extends('layouts.student')
@section('title', 'Drop Course')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Drop Course</h1>
    <p class="text-gray-500 text-sm mt-1">Remove subjects from your current enrollment</p>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
        <p class="font-semibold text-gray-900">Enrolled Subjects ({{ $enrollments->count() }})</p>
    </div>

    @if ($enrollments->count())
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Course Code</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subject Name</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Instructor</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Schedule</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Credits</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Enrollment Date</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach ($enrollments as $e)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 font-mono text-blue-600">{{ $e->course->code }}</td>
                <td class="px-5 py-4 text-blue-600 font-medium">{{ $e->course->name }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $e->course->instructor }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $e->course->schedule }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $e->course->credits }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $e->enrollment_date->format('Y-m-d') }}</td>
                <td class="px-5 py-4">
                    <form method="POST" action="{{ route('student.drop.destroy', $e) }}"
                          onsubmit="return confirm('Are you sure you want to drop {{ $e->course->name }}?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-lg text-xs font-semibold transition flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                            </svg>
                            Drop
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <div class="px-5 py-12 text-center text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-sm">You have no active enrollments to drop.</p>
            <a href="{{ route('student.enroll.index') }}" class="text-blue-600 text-sm underline mt-1 inline-block">
                Enroll in a course
            </a>
        </div>
    @endif
</div>
@endsection