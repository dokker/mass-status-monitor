<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMonitoredSiteRequest;
use App\Http\Requests\UpdateMonitoredSiteRequest;
use App\Models\MonitoredSite;
use Illuminate\Http\Request;

class MonitoredSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$sites = MonitoredSite::orderBy('created_at', 'desc')->get();
        $sites = MonitoredSite::latest()->get();
        return view('admin.sites.index', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMonitoredSiteRequest $request)
    {
        // Validations run before any code in here

        $validated = $request->validated();

        // Handle checkbox when its missing
        $validated['is_active'] = $request->boolean('is_active');
        
        // Create site
        $site = MonitoredSite::create($validated);

        // Success message
        session()->flash('success', 'Site has been added successfully');

        return redirect()->route('sites.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MonitoredSite $site)
    {
        return view('admin.sites.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMonitoredSiteRequest $request, MonitoredSite $site)
    {
        // Get validated data
        $validated = $request->validated();


        // Handle checkbox when its missing
        $validated['is_active'] = $request->boolean('is_active');
        
        // Create site
        $site->update($validated);

        // Success message
        session()->flash('success', 'Site updated successfully');

        return redirect()->route('sites.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MonitoredSite $site)
    {
        
    }
}
