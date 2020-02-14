<?php

namespace App\Models;

use App\Traits\MsiModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Company extends Model
{
    use SoftDeletes, MsiModel;

    public function msiCustomKey()
    {
        $this->attributes[$this->primaryKey] = Carbon::now()->format('Ymdhms');
    }

    public function getLogoAttribute($value)
    {
        return $value ? $value : $this->setting['logo'];
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->select('id', 'user_name');
    }

    public function departments()
    {
        return $this->hasMany(Department::class, 'company_id')->select('id', 'company_id', 'name');
    }
}
