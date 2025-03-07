<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceItem extends Model
{
    /** @use HasFactory<\Database\Factories\MaintenanceItemFactory> */
    use HasFactory;
    protected $fillable = ['item_name', 'description'];

    
}
