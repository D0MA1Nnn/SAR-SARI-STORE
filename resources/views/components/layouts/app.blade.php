@props(['title' => 'Dashboard'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} | Sari-Sari Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Custom scrollbar for a more professional look */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Focus styles for accessibility */
        *:focus-visible {
            outline: 2px solid #0f766e;
            outline-offset: 2px;
            border-radius: 4px;
        }
        
        /* Smooth transitions */
        .transition-smooth {
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased">
    @php
        $navItems = [
            ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'fa-chart-line', 'pattern' => 'dashboard*'],
            ['route' => 'categories.index', 'label' => 'Categories', 'icon' => 'fa-tags', 'pattern' => 'categories*'],
            ['route' => 'products.index', 'label' => 'Products', 'icon' => 'fa-boxes-stacked', 'pattern' => 'products*'],
            ['route' => 'customers.index', 'label' => 'Customers', 'icon' => 'fa-users', 'pattern' => 'customers*'],
            ['route' => 'sales.index', 'label' => 'Sales', 'icon' => 'fa-cart-shopping', 'pattern' => 'sales*'],
            ['route' => 'payments.index', 'label' => 'Payments', 'icon' => 'fa-credit-card', 'pattern' => 'payments*'],
            ['route' => 'block-list.index', 'label' => 'Block List', 'icon' => 'fa-ban', 'pattern' => 'block-list*'],
            ['route' => 'logs.index', 'label' => 'Cash Logs', 'icon' => 'fa-clock-rotate-left', 'pattern' => 'logs*'],
        ];
    @endphp

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar - Fixed width, always visible -->
        <aside class="w-72 flex-shrink-0 bg-white border-r border-slate-200 shadow-sm flex flex-col overflow-y-auto">
            <!-- Logo Area -->
            <div class="border-b border-slate-200 px-6 py-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-teal-600 text-white">
                        <i class="fa-solid fa-store text-sm"></i>
                    </div>
                    <div>
                        <h1 class="text-base font-semibold text-slate-800 tracking-tight">Sari-Sari Store</h1>
                        <p class="text-[11px] text-slate-400 font-medium tracking-wide">Management System</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1">
                @foreach($navItems as $item)
                    @php
                        $isActive = request()->routeIs($item['pattern']);
                    @endphp
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-smooth {{ $isActive ? 'bg-teal-50 text-teal-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <i class="fa-solid {{ $item['icon'] }} w-4 text-center {{ $isActive ? 'text-teal-600' : 'text-slate-400' }}"></i>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <!-- User Profile & Logout Section - Below Cash Logs -->
            <div class="border-t border-slate-200 p-5 space-y-4">
                <!-- User Profile Card -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-teal-100 flex items-center justify-center">
                        <i class="fa-regular fa-user text-teal-700 text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-700 truncate">{{ auth()->user()->name ?? 'Guest User' }}</p>
                        <p class="text-[11px] text-slate-400 font-medium">Administrator</p>
                    </div>
                </div>

                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-red-600 transition-smooth">
                        <i class="fa-solid fa-right-from-bracket text-xs"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-slate-200 px-8 py-4 flex-shrink-0">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-slate-800 tracking-tight">{{ $title }}</h2>
                        <p class="text-sm text-slate-400 mt-0.5">{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-sm font-medium text-slate-700">{{ auth()->user()->name ?? 'Guest' }}</p>
                            <p class="text-xs text-slate-400">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center">
                            <i class="fa-regular fa-user text-slate-500 text-sm"></i>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Content -->
            <main class="flex-1 overflow-y-auto bg-slate-50 px-8 py-6">
                <div class="max-w-7xl mx-auto">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 rounded-md p-4">
                            <div class="flex items-center">
                                <i class="fa-solid fa-check-circle text-emerald-500 mr-3"></i>
                                <p class="text-sm text-emerald-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-md p-4">
                            <div class="flex items-start">
                                <i class="fa-solid fa-exclamation-circle text-red-500 mr-3 mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-medium text-red-800">Please fix the following errors:</p>
                                    <ul class="mt-2 space-y-1 list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                            <li class="text-sm text-red-700">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-slate-200 px-8 py-3 text-center text-xs text-slate-400 flex-shrink-0">
                {{ date('Y') }} Sari-Sari Store Management System. All rights reserved.
            </footer>
        </div>
    </div>
</body>
</html>