<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drugs extends Model
{
    use HasFactory;
    protected $fillable=[
        "name",
        "desc",
        "image",
    ];
     public function patients()
    {
        return $this->belongsToMany(Patient::class);
    }
}
