<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMonitoredSiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the site being edited from the route
        $siteId = $this->route('site')->id;
    
        return [
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'unique:monitored_sites,url,' . $siteId, 'max:500'],
            'check_interval_minutes' => ['required', 'integer', 'min:1', 'max:1440'],
            'is_active' => ['boolean'],
        ];
    }
}
