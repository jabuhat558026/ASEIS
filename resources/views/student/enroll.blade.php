{{-- resources/views/student/enroll.blade.php --}}
@extends('layouts.student')
@section('title', 'Enroll Course')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Course Enrollment</h1>
    <p class="text-blue-600 text-sm mt-1">Select subjects to enroll for the current semester</p>
</div>

@if (session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 mb-4 text-sm">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-4 text-sm">
        {{ session('error') }}
    </div>
@endif

@if ($courses->isEmpty())
    <div class="bg-white rounded-xl border border-gray-200 p-12 text-center text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        <p class="text-sm font-medium">No available courses to enroll in.</p>
        <p class="text-xs mt-1">You may already be enrolled in all available courses.</p>
    </div>
@else
<div class="grid grid-cols-2 gap-4">
    @foreach ($courses as $c)
    <div class="bg-white rounded-xl border border-gray-200 p-5">

        {{-- Course Header --}}
        <div class="flex justify-between items-start mb-3">
            <div>
                <p class="font-bold text-gray-900">{{ $c->name }}</p>
                <p class="text-xs text-gray-400">{{ $c->code }}</p>
            </div>
            <span class="text-xs bg-gray-100 text-gray-700 px-2 py-0.5 rounded-full font-medium whitespace-nowrap">
                {{ $c->credits }} Credits
            </span>
        </div>

        {{-- Instructor --}}
        <p class="text-xs text-blue-600 flex items-center gap-1 mb-1">
            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            {{ $c->instructor }}
        </p>

        {{-- Schedule --}}
        <p class="text-xs text-gray-500 flex items-center gap-1 mb-1">
            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ $c->schedule }}
        </p>

        {{-- Slots Available --}}
        <p class="text-xs text-gray-500 flex items-center gap-1 mb-3">
            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
            </svg>
            Available: {{ $c->slots }}/{{ $c->max_students }}
        </p>

        {{-- Progress Bar --}}
        <div class="w-full bg-gray-100 rounded-full h-1 mb-4">
            @php $pct = $c->max_students > 0 ? round($c->enrolled_count / $c->max_students * 100) : 0; @endphp
            <div class="bg-blue-500 h-1 rounded-full" style="width: {{ $pct }}%"></div>
        </div>

        {{-- Enroll Button --}}
        <form method="POST" action="{{ route('student.enroll.store') }}">
            @csrf
            <input type="hidden" name="course_id" value="{{ $c->id }}">
            <button type="submit"
                @if($c->slots <= 0) disabled @endif
                class="w-full rounded-lg py-2 text-sm font-semibold transition flex items-center justify-center gap-2
                       {{ $c->slots <= 0
                           ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
                           : 'bg-gray-900 hover:bg-gray-700 text-white' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4"/>
                </svg>
                {{ $c->slots <= 0 ? 'Class Full' : 'Enroll in Subject' }}
            </button>
        </form>

    </div>
    @endforeach
</div>
@endif
@endsection