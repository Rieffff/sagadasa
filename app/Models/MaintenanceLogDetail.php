<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceLogDetail extends Model
{
    /** @use HasFactory<\Database\Factories\MaintenanceLogDetailFactory> */
    use HasFactory;
    protected $fillable = [
        'maintenance_log_id',
        'item_name',
        'status',
        'contact',
        'maintenance_item_id',
    ];

    // Relasi ke DailyReports
    public function maintenanceLog()
    {
        return $this->belongsTo(maintenanceLog::class, 'maintenance_log_id');
    }

    public function maintenanceItem()
    {
        return $this->belongsTo(MaintenanceItem::class, 'maintenance_item_id');
    }
    
}
