<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManPower extends Model
{
    /** @use HasFactory<\Database\Factories\ManPowerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'contact',
        'report_id',
        'user_id',
    ];

    // Relasi ke DailyReports
    public function dailyReport()
    {
        return $this->belongsTo(DailyReport::class, 'report_id');
    }
}

