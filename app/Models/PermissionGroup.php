<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    protected $guarded = [];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'permission_group_id', 'id');
    }
}
