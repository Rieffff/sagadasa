<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;
    protected $fillable = [
        'company_name',
        'contact',
        'address',
    ];

    protected $attributes = [
        'default' => 0, // Nilai default otomatis 0
    ];

    // Nonaktifkan update atribut 'default'
    public function setDefaultAttribute($value)
    {
        // Prevent overriding
    }
}
