@extends('layouts.admin')
@section('title', 'Reports')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Generate Enrollment Report</h1>
    <p class="text-gray-500 text-sm mt-1">Create and export enrollment reports by semester or course</p>
</div>

<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <p class="text-gray-500 text-sm mb-1">Total Enrollments</p>
        <p class="text-3xl font-bold text-gray-900">{{ $totalEnrollments }}</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <p class="text-gray-500 text-sm mb-1">Active Enrollments</p>
        <p class="text-3xl font-bold text-gray-900">{{ $activeEnrollments }}</p>
        <p class="text-xs text-gray-400 mt-1">Total Credits</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <p class="text-gray-500 text-sm mb-1">Total Credits</p>
        <p class="text-3xl font-bold text-gray-900">{{ $totalCredits }}</p>
    </div>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
        <p class="font-semibold text-gray-900">Enrollment Report</p>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Student</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Student ID</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Course</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Code</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Course Name</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Instructor</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Schedule</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Credits</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($enrollments as $e)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-900">{{ $e->user->name }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $e->user->student_id }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $e->course->name }}</td>
                <td class="px-4 py-3 font-bold text-gray-900">{{ $e->course->code }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $e->course->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $e->course->instructor }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $e->course->schedule }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $e->course->credits }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $e->enrollment_date->format('Y-m-d') }}</td>
                <td class="px-4 py-3">
                    @php $colors = ['active'=>'bg-gray-100 text-gray-700','completed'=>'bg-blue-100 text-blue-700','dropped'=>'bg-red-100 text-red-700']; @endphp
                    <span class="px-2 py-0.5 rounded text-xs font-medium {{ $colors[$e->status] ?? '' }}">
                        {{ ucfirst($e->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="10" class="px-5 py-8 text-center text-gray-400">No enrollment data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection