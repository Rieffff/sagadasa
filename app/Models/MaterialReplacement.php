<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialReplacement extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialReplacementFactory> */
    use HasFactory;
    protected $fillable = [
        'maintenance_log_id',
        'material_id',
        'quantity',
        'description',
    ];

    public function maintenanceLog()
    {
        return $this->belongsTo(MaintenanceLog::class, 'maintenance_log_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
