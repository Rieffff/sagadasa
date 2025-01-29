<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyProblem extends Model
{
    /** @use HasFactory<\Database\Factories\DailyProblemsFactory> */
    use HasFactory;
    protected $fillable = [
        'problem',
        'solution',
        'activity_id',
        'reported_by',
    ];

    // Relasi ke DailyActivities
    public function dailyActivity()
    {
        return $this->belongsTo(DailyActivity::class, 'activity_id');
    }
}
