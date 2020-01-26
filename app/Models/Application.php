<?php

namespace App\Models;

use App\Traits\MsiModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Application extends Model
{
    use SoftDeletes, MsiModel;

    public function setIdAttribute()
    {
        $this->attributes[$this->primaryKey] = Carbon::now()->format('Ymdhms');
    }

    public function getLogoAttribute($value)
    {
        return $value ? $value : $this->msiSetting['logo'];
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'application_id');
    }
}
