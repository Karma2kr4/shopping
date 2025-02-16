<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Permission extends Model
{
    protected $guarded = [];
    public function permissionChildrent()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }
}
