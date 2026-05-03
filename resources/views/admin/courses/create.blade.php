@extends('layouts.admin')
@section('title', 'Add Course')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Add Course</h1>
</div>
<div class="bg-white rounded-xl border border-gray-200 p-6 max-w-2xl">
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-4 text-sm">
            @foreach ($errors->all() as $e)<p>{{ $e }}</p>@endforeach
        </div>
    @endif
    <form method="POST" action="{{ route('admin.courses.store') }}" class="space-y-4">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Course Code</label>
                <input type="text" name="code" value="{{ old('code') }}" required placeholder="e.g. CS101"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                <select name="subject_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                    <option value="">— Select Subject —</option>
                    @foreach ($subjects as $s)
                        <option value="{{ $s->id }}" @selected(old('subject_id') == $s->id)>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Course Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Instructor</label>
            <input type="text" name="instructor" value="{{ old('instructor') }}" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Schedule</label>
            <input type="text" name="schedule" value="{{ old('schedule') }}" required placeholder="e.g. Mon/Wed 10:00-11:30"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Credits</label>
                <input type="number" name="credits" value="{{ old('credits', 3) }}" required min="1"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Max Students</label>
                <input type="number" name="max_students" value="{{ old('max_students', 30) }}" required min="1"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-gray-900 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-gray-700 transition">
                Save Changes
            </button>
            <a href="{{ route('admin.courses.index') }}"
                class="border border-gray-300 text-gray-700 px-5 py-2 rounded-lg text-sm font-semibold hover:bg-gray-50 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection