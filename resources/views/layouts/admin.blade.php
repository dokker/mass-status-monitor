<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Monitor')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="drawer lg:drawer-open">
        <!-- Drawer toggle for mobile -->
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        
        <!-- Main content area -->
        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div class="navbar bg-base-300 w-full">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer" class="btn btn-square btn-ghost">
                        <!-- Hamburger icon -->
                        <svg xmlns="..." class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2">Website Monitor</div>
            </div>
            
            <!-- Flash messages section -->
            <div class="container mx-auto p-4">
                @if(session('success'))
                    <div class="alert alert-success mb-4">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-error mb-4">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
            </div>
            
            <!-- Page content -->
            <main class="container mx-auto p-4">
                @yield('content')
            </main>
        </div>
        
        <!-- Sidebar -->
        <div class="drawer-side">
            <label for="my-drawer" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content">
                <li><a href="#">Dashboard</a></li>
                <li><a href="{{ route('sites.index') }}" class="{{ request()->routeIs('sites.*') ? 'active' : '' }}">Monitored Sites</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
