<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoSeccion extends Model
{
    use HasFactory;

    protected $table = 'cursos_secciones';

    protected $primaryKey = 'csec_id';

    protected $guarded = [''];

    public function cursos()
    {
        return $this->hasOne('App\Models\Curso', 'curs_id', 'curs_id');
    }

    public function aulas()
    {
        return $this->hasOne('App\Models\Aula', 'aula_id', 'aula_id');
    }
}