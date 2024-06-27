<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'gender',
        'age',
        'height',
        'weight',
        'heart_state',
        'hypertension',
        'diabetes',
        'full_half',
        'period_of_operation',
        'operations',
    ];
}
