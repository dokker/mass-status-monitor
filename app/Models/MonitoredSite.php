<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StatusCheck;
use App\Models\Incident;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonitoredSite extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'url',
        'check_interval_minutes',
        'is_active',
    ];

    protected $casts = [
            'last_chacked_at' => 'datetime',
            'is_active' => 'boolean',
            'last_status' => 'string',
            'check_interval_minutes' => 'integer',
    ];

    public function statusChecks() {
        return $this->hasMany(StatusCheck::class);
    }

    public function Incidents() {
        return $this->hasMany(Incident::class);
    }
}
