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
        'work_start',
        'work_break',
        'work_stop',
        'service_data',
        'detail_activity',
        'location',
        'work_reason',
        'approved_by',
        'contractor_id',
        'company_id',
    ];

    // Relasi ke Contractors
    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    // Relasi ke Companies
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Relasi ke DailyActivityDetails
    public function activityDetails()
    {
        return $this->hasMany(DailyActivityDetail::class, 'report_id');
    }

    // Relasi ke ManPowers
    public function manPowers()
    {
        return $this->hasMany(ManPower::class, 'report_id');
    }

    // Relasi ke DailyActivities
    public function dailyActivities()
    {
        return $this->hasMany(DailyActivity::class, 'report_id');
    }
}
