<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceLog extends Model
{
    /** @use HasFactory<\Database\Factories\MaintenanceLogFactory> */
    use HasFactory;
    protected $fillable = [
        'report_id',
        'maintenance_item_id',
        'status_before',
        'status_after',
    ];

    public function dailyReport()
    {
        return $this->belongsTo(DailyReport::class, 'report_id');
    }

    public function maintenanceItem()
    {
        return $this->belongsTo(MaintenanceItem::class);
    }
    public function materialReplacements()
    {
        return $this->hasMany(MaterialReplacement::class, 'maintenance_log_id');
    }
    public function photos()
    {
        return $this->hasMany(Photo::class, 'maintenance_log_id');
    }
}
