<?php

namespace App\Models;

use App\Traits\MsiModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Permission extends Model
{
    use SoftDeletes, MsiModel;

    public function msiCustomKey()
    {
        $this->attributes[$this->primaryKey] = Carbon::now()->format('Ymdhms');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->select('id', 'user_name');
    }

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id')->select('id', 'name');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions', 'permission_id', 'role_id');
    }
}
