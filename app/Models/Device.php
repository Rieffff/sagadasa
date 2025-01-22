<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /** @use HasFactory<\Database\Factories\DeviceFactory> */
    use HasFactory;
    protected $fillable = ['device_name', 'status', 'description','id_location'];

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location');
    }
}
