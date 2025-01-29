<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceLogAfter extends Model
{
    /** @use HasFactory<\Database\Factories\MaintenanceLogAfterFactory> */
    use HasFactory;
    protected $fillable = [
        'maintenance_log_id',
        'photos',
        'status',
        'description',
    ];

    // Relasi ke MaintenanceLogs
    public function maintenanceLog()
    {
        return $this->belongsTo(MaintenanceLog::class);
    }

    // Relasi ke MaterialReplacements
    public function materialReplacements()
    {
        return $this->hasMany(MaterialReplacement::class, 'maintenance_log_after_id');
    }
}
