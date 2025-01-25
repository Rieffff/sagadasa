<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /** @use HasFactory<\Database\Factories\PhotoFactory> */
    use HasFactory;

    protected $fillable = [
        'maintenance_log_id',
        'photo_url',
    ];

    public function maintenanceLog()
    {
        return $this->belongsTo(MaintenanceLog::class, 'maintenance_log_id');
    }
}
