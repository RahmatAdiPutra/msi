<?php

namespace App\Models;

use App\Traits\MsiModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, MsiModel;

    public function msiCustomKey()
    {
        $this->attributes[$this->primaryKey] = Carbon::now()->format('Ymdhms');
    }

    public function getPhotoAttribute($value)
    {
        return $value ? $value : $this->msiSetting['photo'];
    }

    public function getOnlineAttribute($value)
    {
        return $value ? $this->msiSetting['online'][$value] : $this->msiSetting['online'][$value];
    }

    public function getStatusAttribute($value)
    {
        return $value ? $this->msiSetting['status'][$value] : $this->msiSetting['status'][$value];
    }

    public function updatedUsers()
    {
        return $this->hasMany(self::class, 'updated_by');
    }

    public function updatedRoles()
    {
        return $this->hasMany(Role::class, 'updated_by');
    }

    public function updatedPermissions()
    {
        return $this->hasMany(Permission::class, 'updated_by');
    }

    public function updatedApplications()
    {
        return $this->hasMany(Application::class, 'updated_by');
    }

    public function updatedCompanies()
    {
        return $this->hasMany(Company::class, 'updated_by');
    }

    public function updatedDepartments()
    {
        return $this->hasMany(Department::class, 'updated_by');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_has_roles', 'user_id', 'role_id')->select('id', 'name')->with('permissions')->withPivot('application_id', 'company_id', 'department_id');
    }
}
