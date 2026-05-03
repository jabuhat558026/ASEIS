<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student') — Student Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex">
 
    {{-- SIDEBAR --}}
    <aside class="w-60 bg-white border-r border-gray-200 flex flex-col min-h-screen fixed top-0 left-0">
        <div class="flex items-center gap-3 px-5 py-5 border-b border-gray-100">
            <div class="w-9 h-9 bg-gray-900 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5zm0 7V9m0 12l-9-5m9 5l9-5"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-gray-900 text-sm leading-tight">Student Portal</p>
                <p class="text-xs text-gray-400">Enrollment system</p>
            </div>
        </div>
 
        <nav class="flex-1 px-3 py-4 space-y-1">
            @php
                $links = [
                    ['route' => 'student.dashboard', 'label' => 'Dashboard',        'prefix' => '⊞',
                     'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['route' => 'student.enroll.index', 'label' => 'Enroll course', 'prefix' => '+',
                     'icon' => 'M12 4v16m8-8H4'],
                    ['route' => 'student.subjects',     'label' => 'My subject',    'prefix' => '👁',
                     'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
                    ['route' => 'student.drop.index',   'label' => 'Drop course',   'prefix' => '×',
                     'icon' => 'M6 18L18 6M6 6l12 12'],
                    ['route' => 'student.account',      'label' => 'Account Settings', 'prefix' => '👤',
                     'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ];
            @endphp
 
            @foreach ($links as $link)
                @php $active = request()->routeIs($link['route'].'*'); @endphp
                <a href="{{ route($link['route']) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                          {{ $active ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}"/>
                    </svg>
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>
 
        <div class="px-3 py-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>
 
    <main class="ml-60 flex-1 p-8">
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-6 text-sm">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html> 