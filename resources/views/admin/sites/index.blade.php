{{-- Current Blade file should inherit from the admin layout --}}
@extends('layouts.admin')
{{-- Injects "Monitored Sites" into a @yield('title') placeholder in the admin layout --}}
@section('title', 'Monitored Sites')
{{-- Begins a content section that will be inserted where @yield('content') appears --}}
@section('content')


<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Monitored Sites</h1>
    <a href="{{ route('sites.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add New Site
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse ($sites as $site)
        {{-- Site Card component --}}
        <div class="card bg-base-100 shadow-md hover:shadow-xl transition-shadow duration-300">
            {{-- Card header --}}
            <div class="card-body">
                <div class="flex justify-between items-start mb-2">
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
                    
                    <div class="stat p-3">
                        <div class="stat-title text-xs">Interval</div>
                        <div class="stat-value text-sm">{{ $site->check_interval_minutes }} minutes</div>
                    </div>

                    @if ($site->last_response_time_ms)
                        <div class="stat p-3">
                            <div class="stat-title text-xs">Response</div>
                            <div class="stat-value text-sm">{{ $site->last_response_time_ms }} ms</div>
                        </div>
                    @endif
                </div>

                {{-- Active indicator --}}
                <div class="mb-4">
                    @if ($site->is_active)
                        <div class="flex items-center text-sm">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                            <span class="text-success">Monitoring active</span>
                        </div>
                    @else
                        <div class="flex items-center text-sm">
                            <div class="w-2 h-2 bg-gray-400 rounded-full mr-2"></div>
                            <span class="text-gray-500">Monitoring Paused</span>
                        </div>
                    @endif
                </div>

                {{-- Action buttons --}}
                <div class="card-actions justify-end">
                    <a href="{{ route('sites.edit', $site) }}" class="btn btn-sm btn-primary btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit                        
                    </a>
                    <form action="{{ route('sites.destroy', $site) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-error btn-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete                            
                        </button>
                    </form>
                </div>
            </div>

        </div>
    @empty
        {{-- No Site Message --}}
        <div class="card bg-base-100 shadow-md">
            <h2 class="text-2xl font-bold mb-1">No Sites Yet</h2>
        </div>
    @endforelse
</div>

@endsection
