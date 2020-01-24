<?php

namespace App\Traits;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait MsiModelTrait
{
    protected $msiSetting;

    public function __construct(array $attributes = [])
    {
        $this->msiSetting = Setting::get('setup')['app']['models'][Str::singular($this->getTable())];

        if ($this->msiSetting['customKey']) {
            $this->setIdAttribute();
        }

        $this->connection = $this->msiSetting['connection'];
        $this->table = $this->msiSetting['table'];
        $this->primaryKey = $this->msiSetting['primaryKey'];
        $this->keyType = $this->msiSetting['keyType'];
        $this->timestamps = $this->msiSetting['timestamps'];
        $this->incrementing = $this->msiSetting['incrementing'];
        $this->fillable = $this->msiSetting['fillable'];
        $this->hidden = $this->msiSetting['hidden'];
        $this->casts = $this->msiSetting['casts'];

        Model::__construct($attributes);
    }
}
