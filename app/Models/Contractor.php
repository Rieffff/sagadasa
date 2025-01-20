<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    /** @use HasFactory<\Database\Factories\ContractorFactory> */
    use HasFactory;
    protected $fillable = [
        'contractor_name',
        'contract_ref',
        'address',
        'contact_information',
    ];
}
