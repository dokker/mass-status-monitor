@extends('layouts.admin')
@section('title', 'Edit Site')
@section('content')

<div class="max-w-2xl mx-auto">
    {{-- Page Header --}}
    <div class="flex items-center mb-6">
        <a href="{{ route('sites.index') }}" class="btn btn-ghost btn-sm mr-4">
            Back
        </a>
        <h1 class="text-3xl font-bold">Edit Site</h1>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-error mb-6">
            <h3 class="font-bold">Please fix the following errors:</h3>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('sites.update', $site) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-control w-full mb-4">
                    <label for="" class="label"><span class="label-text font-semibold">Site Name</span><span class="text-error">*</span></label>
                    <input
                        type="text" 
                        name="name" 
                        placeholder="Name of the site"
                        {{-- conditionally adds the input-error class if validation fails --}}
                        class="input input-bordered w-full @error('name') input-error @enderror"
                        {{-- repopulates the input field with the user's previous submission when validation fails --}}
                        value="{{ old('name', $site->name) }}"
                        required
                    >
                    @error('name')
                        <label for="" class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                    <label for="" class="label">
                        <span class="label-text-alt">A name to identify this site</span>
                    </label>
                </div>

                <div class="form-control w-full mb-4">
                    <label for="" class="label">
                        <span class="label-text font-semibold">URL</span><span class="text-error">*</span>
                    </label>
                    <input 
                        type="text"
                        name="url"
                        placeholder="https://name.of.site"
                        class="input input-bordered w-full @error('url') input-error @enderror"
                        value="{{ old('url', $site->url) }}"
                        required
                        >
                    @error('url')
                        <label for="" class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                    <label for="" class="label">
                        <span class="label-text-alt">Full url including https://</span>
                    </label>
                </div>

                {{-- Check Interval Field --}}
                <div class="form-control w-full mb-4">
                    <label for="" class="label">
                        <span class="label-text font-semibold">Check Interval (minutes)</span>
                    </label>
                    <input 
                        type="number"
                        name="check_interval_minutes"
                        placeholder="0"
                        class="input input-bordered w-full @error('check_interval_minutes') input-error @enderror"
                        value="{{ old('check_interval_minutes', $site->check_interval_minutes) }}"
                        min="1"
                        max="1440"
                        required
                    />
                    @error('check_interval_minutes')
                        <label for="" class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                    <label for="" class="label">
                        <span class="label-text-alt">Site check interval (1-1440 minutes)</span>
                    </label>
                </div>

                {{-- Is active toggle --}}
                <div class="form-control mb-6">
                    <label for="" class="label">
                        <input 
                            type="checkbox"
                            name="is_active"
                            value="1"
                            class="toggle toggle-success"
                            {{ old('is_active', $site->is_active) ? 'checked' : '' }}
                        >
                        <div>
                            <span class="label-text font-semibold">Start monitoring</span>
                            <p class="text-sm text-gray-500">Enable monitoring for this site</p>
                        </div>
                    </label>
                </div>


                {{-- Site Info Box --}}
                <div class="alert alert-info mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-sm">
                        <p><strong>Created:</strong>{{ $site->created_at->format('M d, Y H:i') }}</p>
                        @if ($site->last_checked_at)
                            <p><strong>Last Checked:</strong> {{ $site->last_checked_at->diffForHumans() }}</p>
                        @endif
                    </div>
                </div>

                <div class="divider"></div>

                <div class="card-actions justify-end">
                    <a href="{{ route('sites.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update site</button>
                </div>
            </form>
        </div>
    </div>

</div>


@endsection
