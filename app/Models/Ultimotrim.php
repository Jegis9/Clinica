<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ultimotrim extends Model
{





    protected $table = 'vista_pacientes_control_9';

    // Indicar que la PK es `id`
    protected $primaryKey = 'telefono_emergencia';

    public $incrementing = false;
    public $timestamps = false;
}
