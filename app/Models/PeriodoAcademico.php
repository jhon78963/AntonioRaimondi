<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodoAcademico extends Model
{
    use HasFactory;

    protected $table = "periodos_academicos";

    protected $primaryKey = 'peri_id';

    protected $guarded = [''];

}