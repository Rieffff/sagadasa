<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyActivity extends Model
{
    /** @use HasFactory<\Database\Factories\DailyActivitiesFactory> */
    use HasFactory;

    protected $fillable = [
        'activity',
        'note',
        'user_name',
        'report_id',
    ];

    // Relasi ke DailyReports
    public function dailyReport()
    {
        return $this->belongsTo(DailyReport::class, 'report_id');
    }

    // Relasi ke ProblemToday
    public function problems()
    {
        return $this->hasMany(DailyProblems::class, 'activity_id');
    }
}
