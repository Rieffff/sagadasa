<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialReplacement extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialReplacementFactory> */
    use HasFactory;
    protected $fillable = [
        'maintenance_log_after_id',
        'material_name',
        'quantity',
        'description',
    ];

    // Relasi ke MaintenanceLogAfter
    public function maintenanceLogAfter()
    {
        return $this->belongsTo(MaintenanceLogAfter::class, 'maintenance_log_after_id');
    }

}
