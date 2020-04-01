<?php

namespace App\Models;

use App\Traits\MsiModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Application extends Model
{
    use SoftDeletes, MsiModel;

    public function msiCustomKey()
    {
        // $this->attributes[$this->primaryKey] = Carbon::now()->format('Ymdhms');
        $this->attributes['app_key'] = Hash::make(Str::random(40));
    }

    public function getLogoAttribute($value)
    {
        return $value ? $value : $this->msiSetting['logo'];
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->select('id', 'user_name');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'application_id')->select('id', 'application_id', 'name');
    }
}
