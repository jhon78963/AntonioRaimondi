<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    use HasFactory;

    protected $table = "roles_permissions";

    protected $primaryKey = 'perm_id';

    protected $guarded = [''];

}