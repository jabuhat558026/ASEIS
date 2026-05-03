@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-500 text-sm mt-1">Welcome to the Student Enrollment System</p>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-4 gap-4 mb-6">
    @php
        $stats = [
            ['label' => 'Total Students',    'value' => $totalStudents,       'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0'],
            ['label' => 'Total Courses',     'value' => $totalCourses,        'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
            ['label' => 'Active Enrollment', 'value' => $activeEnrollments,   'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            ['label' => 'Avg. Courses/Student','value'=> $avgCoursesPerStudent,'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
        ];
    @endphp
    @foreach ($stats as $s)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs text-gray-500 font-medium">{{ $s['label'] }}</p>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"/>
            </svg>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $s['value'] }}</p>
    </div>
    @endforeach
</div>

{{-- Recent Enrollments + Popular Courses --}}
<div class="grid grid-cols-2 gap-4">
    {{-- Recent Enrollments --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h2 class="font-semibold text-gray-900 mb-4">Recent Enrollments</h2>
        @forelse ($recentEnrollments as $e)
        <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
            <div>
                <p class="text-sm font-semibold text-gray-900">{{ $e->user->name }}</p>
                <p class="text-xs text-gray-400">{{ $e->course->name }}</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-400">{{ $e->enrollment_date }}</p>
                <span class="inline-block text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-medium mt-0.5">Active</span>
            </div>
        </div>
        @empty
            <p class="text-gray-400 text-sm">No recent enrollments.</p>
        @endforelse
    </div>

    {{-- Popular Courses --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h2 class="font-semibold text-gray-900 mb-4">Popular Courses</h2>
        @forelse ($popularCourses as $c)
        <div class="mb-4">
            <div class="flex justify-between mb-1">
                <div>
                    <p class="text-sm font-semibold text-gray-900">{{ $c->code }}</p>
                    <p class="text-xs text-gray-400">{{ $c->name }}</p>
                </div>
                <p class="text-xs text-gray-500">{{ $c->active_count }}/{{ $c->max_students }}</p>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-1.5">
                <div class="bg-blue-500 h-1.5 rounded-full"
                     style="width: {{ $c->max_students > 0 ? round($c->active_count / $c->max_students * 100) : 0 }}%"></div>
            </div>
        </div>
        @empty
            <p class="text-gray-400 text-sm">No courses yet.</p>
        @endforelse
    </div>
</div>
@endsection