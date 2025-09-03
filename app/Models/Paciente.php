<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';

    protected $fillable = [
        'registro_no',
        'nombre',
        'apellido',
        'birth_date',
        'pueblo',
        'escolaridad',
        'ocupacion',
        'nombre_esposo',
        'pueblo_esposo',
        'escolaridad_esposo',
        'ocupacion_esposo',
        'estado_civil',
        'distancia_servicio_salud_km',
        'tiempo_servicio_salud_hrs',
        'nombre_comunidad',
        'telefono_emergencia',
        'fecha_ultima_regla',
        'fpp',
        'no_embarazos',
        'no_partos',
        'no_cesareas',
        'no_abortos',
    ];

   public function antobs()
    {
        return $this->hasOne(Antobs::class, 'paciente_id', 'id');
    }
    
}
