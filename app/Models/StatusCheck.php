<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MonitoredSite;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'monitored_site_id',
        'status',
        'response_time',
        'http_status_code', 
        'error_message', 
        'checked_at',
    ];

    protected $casts = [
        'response_time_ms' => 'integer',
        'http_status_code' => 'integer',
    ];

    public function monitoredSite() {
        return $this->belongsTo(MonitoredSite::class);
    }
}
