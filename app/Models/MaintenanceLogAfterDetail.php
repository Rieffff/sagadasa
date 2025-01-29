<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceLogAfterDetail extends Model
{
    /** @use HasFactory<\Database\Factories\MaintenanceLogAfterDetailsFactory> */
    use HasFactory;
    protected $fillable = [
        'maintenance_log_after_id',
        'item_name',
        'status',
        'contact',
    ];

    // Relasi ke DailyReports
    public function maintenanceLogAfter()
    {
        return $this->belongsTo(maintenanceLogAfter::class, 'maintenance_log_after_id');
    }
}
