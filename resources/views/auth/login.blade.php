<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sari-Sari Store</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-100 to-slate-200">
<div class="grid min-h-screen lg:grid-cols-2">
    <!-- Left Side - Brand Section -->
    <div class="hidden relative overflow-hidden bg-gradient-to-br from-emerald-800 to-emerald-900 p-14 text-emerald-50 lg:flex lg:flex-col lg:justify-between">
        <div class="relative z-10">
            <div class="mb-8 flex items-center gap-3">
                <!-- Store Logo Icon -->
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/10 backdrop-blur-sm shadow-lg">
                    <i class="fa-solid fa-store text-2xl text-emerald-400"></i>
                </div>
                <div>
                    <span class="text-xl font-bold tracking-tight">SariSariPOS</span>
                    <p class="text-xs text-emerald-300/70">Point of Sale System</p>
                </div>
            </div>
            <h1 class="text-4xl font-extrabold leading-tight">Sari-Sari Store<br>Management System</h1>
            <div class="mt-6 h-1 w-20 bg-emerald-500 rounded-full"></div>
            <p class="mt-6 max-w-md text-emerald-200 leading-relaxed">Track sales, customers, payments, and stock with one clean admin workspace.</p>
        </div>
        
        <!-- Decorative Elements -->
        <div class="relative z-10 mt-auto pt-20">
            <div class="flex gap-3 text-emerald-300/40">
                <i class="fa-solid fa-chart-line text-xl"></i>
                <i class="fa-solid fa-users text-xl"></i>
                <i class="fa-solid fa-credit-card text-xl"></i>
                <i class="fa-solid fa-box text-xl"></i>
                <i class="fa-solid fa-receipt text-xl"></i>
                <i class="fa-solid fa-coins text-xl"></i>
            </div>
            <p class="mt-4 text-sm text-emerald-300/60">Secure & Reliable Dashboard</p>
        </div>
        
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 24px 24px;"></div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">
            <!-- Logo for mobile -->
            <div class="mb-8 text-center lg:hidden">
                <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-600 to-emerald-700 shadow-lg">
                    <i class="fa-solid fa-store text-2xl text-white"></i>
                </div>
                <h2 class="mt-3 text-2xl font-bold text-slate-900">SariSariPOS</h2>
                <p class="text-xs text-slate-400">Point of Sale System</p>
            </div>

            <!-- Login Card -->
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-xl">
                <div class="mb-6 text-center lg:text-left">
                    <!-- Small logo for desktop -->
                    <div class="hidden lg:flex lg:items-center lg:gap-2 lg:mb-4">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100">
                            <i class="fa-solid fa-store text-sm text-emerald-600"></i>
                        </div>
                        <span class="text-sm font-semibold text-slate-600">SariSariPOS</span>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Welcome Back</h2>
                    <p class="mt-1 text-sm text-slate-500">Please sign in to your account</p>
                </div>

                <form action="{{ route('login.attempt') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <!-- Email Field -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                            <i class="fa-regular fa-envelope mr-1.5 text-slate-400"></i>
                            Email Address
                        </label>
                        <input type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="admin@example.com"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition">
                        @error('email')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                            <i class="fa-solid fa-lock mr-1.5 text-slate-400"></i>
                            Password
                        </label>
                        <input type="password"
                                name="password"
                                required
                                placeholder="••••••••"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition">
                        @error('password')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center gap-2 text-sm text-slate-600 cursor-pointer">
                            <input type="checkbox"
                                    name="remember"
                                    class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-emerald-600 hover:text-emerald-700 transition">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="mt-2 w-full rounded-lg bg-emerald-600 px-4 py-2.5 font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <i class="fa-solid fa-arrow-right-to-bracket mr-2 text-sm"></i>
                        Sign In
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-8 pt-6 text-center border-t border-slate-100">
                    <p class="text-xs text-slate-400">
                        &copy; {{ date('Y') }} Sari-Sari Store. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>