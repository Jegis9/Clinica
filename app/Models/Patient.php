<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'dpi',          // <- Agrega este campo
        'first_name',
        'last_name',
        'birth_date',
        'gender',
        'direction',
        'phone',
        'email',
        'type_of_blood',
        'allergy',
        'status',
      
    ];
}
