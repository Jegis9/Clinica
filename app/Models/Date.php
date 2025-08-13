<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Date extends Model
{
    use HasFactory;


public function patient()
{
    return $this->belongsTo(Patient::class);
}

public function doctor()
{
    return $this->belongsTo(Doctor::class);
}


    protected $fillable = [
        'patient_id',          
        'doctor_id',
        'date',
        'reason',
        'status',
        'notes',

      
    ];
}
