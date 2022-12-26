<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoSeccion extends Model
{
    use HasFactory;

    protected $table = 'alumnos_secciones';

    protected $primaryKey = 'asec_id';

    protected $guarded = [''];

    public function alumnos()
    {
        return $this->hasOne('App\Models\Alumno', 'alum_id', 'alum_id');
    }

    public function aulas()
    {
        return $this->hasOne('App\Models\Aula', 'aula_id', 'aula_id');
    }

}