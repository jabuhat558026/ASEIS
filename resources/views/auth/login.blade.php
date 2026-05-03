<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Student Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md">
        {{-- Logo --}}
        <div class="flex items-center gap-3 mb-8">
            <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5zm0 7V9m0 12l-9-5m9 5l9-5"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-gray-900 leading-tight">Student Portal</p>
                <p class="text-xs text-gray-500">Enrollment system</p>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-gray-900 mb-1">Welcome back</h1>
        <p class="text-gray-500 mb-6 text-sm">Sign in to your account to continue</p>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                    placeholder="you@example.com">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                    placeholder="••••••••">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember" class="rounded">
                <label for="remember" class="text-sm text-gray-600">Remember me</label>
            </div>
            <button type="submit"
                class="w-full bg-gray-900 text-white rounded-lg py-2.5 text-sm font-semibold hover:bg-gray-700 transition">
                Sign in
            </button>
        </form>

        <p class="mt-6 text-xs text-gray-400 text-center">
            Admin: admin@seis.edu · Student: michael@seis.edu / jane@seis.edu · Password: <strong>password</strong>
        </p>
    </div>
</body>
</html>