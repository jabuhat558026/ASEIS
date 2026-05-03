@extends('layouts.admin')
@section('title', 'Enrollments')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Enrollments</h1>
    <p class="text-gray-500 text-sm mt-1">Manage student course enrollments</p>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-4">
    <div class="px-5 py-4 border-b border-gray-100">
        <p class="font-semibold text-gray-900">All Enrollments ({{ $enrollments->count() }})</p>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Student</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Student ID</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Course</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Course Code</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Credits</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Enrollment Date</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($enrollments as $e)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 font-semibold text-gray-900">{{ $e->user->name }}</td>
                <td class="px-5 py-4 text-gray-500">{{ $e->user->student_id }}</td>
                <td class="px-5 py-4 text-blue-600">{{ $e->course->name }}</td>
                <td class="px-5 py-4 font-semibold text-gray-700">{{ $e->course->code }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $e->course->credits }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $e->enrollment_date->format('Y-m-d') }}</td>
                <td class="px-5 py-4">
                    @php $colors = ['active'=>'bg-green-100 text-green-700','completed'=>'bg-blue-100 text-blue-700','dropped'=>'bg-red-100 text-red-700']; @endphp
                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $colors[$e->status] ?? '' }}">
                        {{ ucfirst($e->status) }}
                    </span>
                </td>
                <td class="px-5 py-4">
                    <form method="POST" action="{{ route('admin.enrollments.destroy', $e) }}"
                          onsubmit="return confirm('Remove this enrollment?')">
                        @csrf @method('DELETE')
                        <button class="text-gray-400 hover:text-red-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="px-5 py-8 text-center text-gray-400">No enrollments.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-3 gap-4">
    <div class="bg-white rounded-xl border border-gray-200 p-5 text-center">
        <p class="text-gray-500 text-sm mb-1">Active Enrollments</p>
        <p class="text-3xl font-bold text-gray-900">{{ $active }}</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5 text-center">
        <p class="text-gray-500 text-sm mb-1">Completed</p>
        <p class="text-3xl font-bold text-gray-900">{{ $completed }}</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5 text-center">
        <p class="text-teal-500 text-sm mb-1">Dropped</p>
        <p class="text-3xl font-bold text-teal-500">{{ $dropped }}</p>
    </div>
</div>
@endsection