<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteSeccion extends Model
{
    use HasFactory;

    protected $table = 'docentes_secciones';

    protected $primaryKey = 'dsec_id';

    protected $guarded = [''];

    public function docentes()
    {
        return $this->hasOne('App\Models\Docente', 'doce_id', 'doce_id');
    }

    public function aulas()
    {
        return $this->hasOne('App\Models\Aula', 'aula_id', 'aula_id');
    }

}