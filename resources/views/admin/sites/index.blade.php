{{-- Current Blade file should inherit from the admin layout --}}
@extends('layouts.admin')
{{-- Injects "Monitored Sites" into a @yield('title') placeholder in the admin layout --}}
@section('title', 'Monitored Sites')
{{-- Begins a content section that will be inserted where @yield('content') appears --}}
@section('content')


<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Monitored Sites</h1>
    <a href="{{ route('admin.sites.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add New Site
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse ($sites as $site)
        {{-- Site Card component --}}
        <div class="card bg-base-100 shadow-md">
            {{-- Card header --}}
            <div class="card-body">
                <div class="flex justify-between-items-start mb-2">
                    <h2 class="card-title">{{ $site->name }}</h2>
                    @if ($site->last_status === 'up')
                        <span class="badge badge-success badge-lg">UP</span>
                    @elseif ($site->last_status === 'down')
                        <span class="badge badge-error badge-lg">DOWN</span>
                    @else
                        <span class="badge badge-ghost badge-lg">Unknown</span>
                    @endif
                </div>

                {{-- URL --}}
                <div class="mb-3">
                    <a href="{{ $site->url }}" target="_blank" class="link link-primary text-sm">
                        {{ \Illuminate\Support\Str::limit($site->url, 50) }}
                    </a>
                </div>

                {{-- Stats Section --}}
                <div class="stats stats-vertical lg:stats-horizontal shadow mb-4">
                    <div class="stat p-3">
                        <div class="stat-title text-xs">Last Check</div>
                        <div class="stat-value text-sm">
                            @if ($site->last_checked_at)
                                {{ $site->last_checked_at }}
                            @else
                                <span class="text-gray-400">Never</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="stat p-3"></div>
                    <div class="stat p-3"></div>
                </div>
            </div>

        </div>
    @empty
        {{-- No SIte Message --}}
    @endforelse
</div>

@endsection
