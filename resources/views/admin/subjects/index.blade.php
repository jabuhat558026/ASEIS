@extends('layouts.admin')
@section('title', 'Subjects')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Subjects</h1>
        <p class="text-gray-500 text-sm mt-1">Manage subject catalog and information</p>
    </div>
    <a href="{{ route('admin.subjects.create') }}"
       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 transition">
        <span class="text-lg leading-none">+</span> Add Subject
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
        <p class="font-semibold text-gray-900">All Subjects ({{ $subjects->count() }})</p>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Code</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subject Name</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Description</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Department</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Credits</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($subjects as $s)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 font-bold text-gray-900">{{ $s->code }}</td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $s->name }}</td>
                <td class="px-5 py-4 text-blue-600 text-xs max-w-xs truncate">{{ $s->description }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $s->department }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $s->credits }}</td>
                <td class="px-5 py-4 flex items-center gap-2">
                    <a href="{{ route('admin.subjects.edit', $s) }}" class="text-gray-400 hover:text-blue-600 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('admin.subjects.destroy', $s) }}"
                          onsubmit="return confirm('Delete this subject?')">
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
            <tr><td colspan="6" class="px-5 py-8 text-center text-gray-400">No subjects found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection