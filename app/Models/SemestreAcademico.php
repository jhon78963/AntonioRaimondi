<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemestreAcademico extends Model
{
    use HasFactory;

    protected $table = "semestres_academicos";

    protected $primaryKey = 'seme_id';

    protected $guarded = [''];
}