<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    protected $table = 'ficha';
    
    // Para vistas, generalmente no necesitas primary key
    // o puedes usar una columna única como primary key
    public $incrementing = false;
    
    // Si no tienes una primary key definida, desactiva esto
    protected $primaryKey = null;
    
    public $timestamps = false;
    
    // Relación con Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
