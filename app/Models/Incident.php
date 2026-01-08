<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MonitoredSite;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'monitored_site_id', 
        'started_at', 
        'ended_at', 
        'total_downtime_seconds', 
        'notification_sent',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'notification_sent' => 'boolean',
        'total_downtime_seconds' => 'integer',
    ];

    public function monitoredSite() {
        return $this->belongsTo(MonitoredSite::class);
    }
}
