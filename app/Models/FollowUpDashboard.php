<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUpDashboard extends Model
{
    protected $table = 'vista_pacientes_antecedentes';
    
    // Esto es importante para vistas de BD
    public $incrementing = false;
    
    protected $keyType = 'string';
}
