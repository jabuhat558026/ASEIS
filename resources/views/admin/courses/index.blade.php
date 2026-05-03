@extends('layouts.admin')
@section('title', 'Courses')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Courses</h1>
        <p class="text-gray-500 text-sm mt-1">Manage course catalog and availability</p>
    </div>
    <a href="{{ route('admin.courses.create') }}"
       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 transition">
        <span class="text-lg leading-none">+</span> Add Course
    </a>
</div>

{{-- Course Cards --}}
<div class="grid grid-cols-2 gap-4 mb-6">
    @foreach ($courses->take(4) as $c)
    <div class="bg-white rounded-xl border border-gray-200 p-5 relative">
        <div class="flex justify-between items-start mb-2">
            <div>
                <p class="font-bold text-gray-900">{{ $c->name }}</p>
                <p class="text-xs text-gray-400">{{ $c->code }}</p>
            </div>
            <form method="POST" action="{{ route('admin.courses.destroy', $c) }}"
                  onsubmit="return confirm('Delete this course?')">
                @csrf @method('DELETE')
                <button class="text-gray-300 hover:text-red-500 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </form>
        </div>
        <p class="text-xs text-gray-500 flex items-center gap-1 mb-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            {{ $c->instructor }}
        </p>
        <p class="text-xs text-gray-500 flex items-center gap-1 mb-3">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ $c->schedule }}
        </p>
        <div class="flex gap-2 mb-3">
            <span class="text-xs bg-gray-900 text-white px-2 py-0.5 rounded-full">{{ $c->enrolled_count }}/{{ $c->max_students }} Students</span>
            <span class="text-xs bg-gray-900 text-white px-2 py-0.5 rounded-full">{{ $c->credits }} Credits</span>
        </div>
        <div class="w-full bg-gray-100 rounded-full h-1">
            <div class="bg-blue-500 h-1 rounded-full"
                 style="width: {{ $c->max_students > 0 ? round($c->enrolled_count/$c->max_students*100) : 0 }}%"></div>
        </div>
    </div>
    @endforeach
</div>

{{-- Course Table --}}
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
        <p class="font-semibold text-gray-900">Course List</p>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Code</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Course Name</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Instructor</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Schedule</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Credits</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Enrollment</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($courses as $c)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 font-bold text-gray-900">{{ $c->code }}</td>
                <td class="px-5 py-4 text-blue-600">{{ $c->name }}</td>
                <td class="px-5 py-4 text-blue-600">{{ $c->instructor }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $c->schedule }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $c->credits }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $c->enrolled_count }}/{{ $c->max_students }} Students</td>
                <td class="px-5 py-4 flex items-center gap-2">
                    <a href="{{ route('admin.courses.edit', $c) }}" class="text-gray-400 hover:text-blue-600 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('admin.courses.destroy', $c) }}"
                          onsubmit="return confirm('Delete this course?')">
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
            <tr><td colspan="7" class="px-5 py-8 text-center text-gray-400">No courses found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection