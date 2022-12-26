<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';

    protected $primaryKey = 'matr_id';

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