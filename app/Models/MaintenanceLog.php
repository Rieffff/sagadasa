<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceLog extends Model
{
    /** @use HasFactory<\Database\Factories\MaintenanceLogFactory> */
    use HasFactory;
    protected $fillable = [
        'report_detail_id',
        'maintenance_item_id',
        'photos',
        'status',
        'description',
    ];

    // Relasi ke DailyActivityDetails
    public function activityDetail()
    {
        return $this->belongsTo(DailyActivityDetail::class, 'report_detail_id');
    }

    // Relasi ke MaintenanceItems
    public function maintenanceItem()
    {
        return $this->belongsTo(MaintenanceItem::class);
    }

    // Relasi ke MaintenanceLogAfter
    public function maintenanceAfter()
    {
        return $this->hasOne(MaintenanceLogAfter::class, 'maintenance_log_id');
    }
}
