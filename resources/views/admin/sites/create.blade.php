{{-- Current Blade file should inherit from the admin layout --}}
@extends('layouts.admin')
{{-- Injects "Monitored Sites" into a @yield('title') placeholder in the admin layout --}}
@section('title', 'Create Site')
{{-- Begins a content section that will be inserted where @yield('content') appears --}}
@section('content')


<div class="max-w-2xl mx-auto">
    {{-- Page Header --}}
    <div class="flex items-center mb-6">
        <a href="{{ route('sites.index') }}" class="btn btn-ghost btn-sm mr-4">
            Back
        </a>
        <h1 class="text-3xl font-bold">Add New Site</h1>
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
            <form action="{{ route('sites.store') }}" method="POST">
                @csrf

                <div class="form-control w-full mb-4">
                    <label for="" class="label"><span class="label-text font-semibold">Site Name</span><span class="text-error">*</span></label>
                    <input
                        type="text" 
                        name="name" 
                        placeholder="Name of the site"
                        {{-- conditionally adds the input-error class if validation fails --}}
                        class="input input-bordered w-full @error('name') input-error @enderror"
                        {{-- repopulates the input field with the user's previous submission when validation fails --}}
                        value="{{ old('name') }}"
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
                        value="{{ old('url') }}"
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
                        value="{{ old('check_interval_minutes', 5) }}"
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
                            {{ old('is_active', 1) ? 'checked' : '' }}
                        >
                        <div>
                            <span class="label-text font-semibold">Start monitoring</span>
                            <p class="text-sm text-gray-500">Enable monitoring for this site</p>
                        </div>
                    </label>
                </div>

                <div class="divider"></div>

                <div class="card-actions justify-end">
                    <a href="{{ route('sites.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add site</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection