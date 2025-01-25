<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    /** @use HasFactory<\Database\Factories\DailyReportFactory> */
    use HasFactory;
    protected $fillable = [
        'report_date',
        'contractor_id',
        'company_id',
        'device_id',
        'technician_id',
        'activity_details',
        'status',
    ];

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class, 'report_id');
    }
}
