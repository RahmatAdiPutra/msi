<?php

namespace App\Models;

use App\Traits\MsiModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Department extends Model
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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->select('id', 'name');
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'department_id')->select('id', 'department_id', 'name');
    }
}
