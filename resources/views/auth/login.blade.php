<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sari-Sari Store</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-slate-100">
<div class="grid min-h-screen lg:grid-cols-2">
    <div class="hidden bg-emerald-900 p-14 text-emerald-50 lg:block">
        <h1 class="text-4xl font-extrabold leading-tight">Sari-Sari Store<br>Management System</h1>
        <p class="mt-4 max-w-md text-emerald-200">Track sales, customers, payments, and stock with one clean admin workspace.</p>
    </div>

    <div class="flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-8 shadow-lg">
            <h2 class="text-2xl font-bold text-slate-900">Admin Login</h2>
            <p class="mt-1 text-sm text-slate-500">Use your administrator credentials to continue.</p>

            <form action="{{ route('login.attempt') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:border-emerald-500 focus:outline-none">
                    @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" required
                           class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:border-emerald-500 focus:outline-none">
                    @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="inline-flex items-center gap-2 text-slate-600">
                        <input type="checkbox" name="remember" class="rounded border-slate-300">
                        Remember me
                    </label>
                </div>

                <button class="w-full rounded-lg bg-emerald-600 px-4 py-2.5 font-semibold text-white transition hover:bg-emerald-700">
                    Sign In
                </button>
            </form>

            <div class="mt-6 rounded-lg bg-emerald-50 p-3 text-sm text-emerald-900">
                <div><strong>Default Admin:</strong> admin@sarisari.local</div>
                <div><strong>Password:</strong> password123</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
