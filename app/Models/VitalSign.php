<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalSign extends Model
{
    use HasFactory;
    protected $fillable = [
        'heart_rate',
        'blood_pressure',
        'respiratory_rate',
        'oxygen_saturation',
        'end_tidal_carbon',
        'temperature',
        'electrocardiogram',
    ];
}
