<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonitoredSite extends Model
{
    use SoftDeletes;

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
}
