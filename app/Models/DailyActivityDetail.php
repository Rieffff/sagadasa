<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyActivityDetail extends Model
{
    /** @use HasFactory<\Database\Factories\DailyActivityDetailsFactory> */
    use HasFactory;

    protected $fillable = [
        'report_id',
        'device_id',
        'activity_description',
        'status',
    ];

    // Relasi ke DailyReports
    public function dailyReport()
    {
        return $this->belongsTo(DailyReport::class, 'report_id');
    }

    // Relasi ke Devices
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    // Relasi ke MaintenanceLogs
    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class, 'report_detail_id');
    }
}
