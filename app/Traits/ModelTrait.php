<?php

namespace App\Traits;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait ModelTrait
{
    protected $setting;

    public function __construct(array $attributes = [])
    {
        $this->setting = Setting::get('setup')['app']['models'][Str::singular($this->getTable())];

        if ($this->setting['customKey']) {
            $this->setIdAttribute();
        }

        $this->connection = $this->setting['connection'];
        $this->table = $this->setting['table'];
        $this->primaryKey = $this->setting['primaryKey'];
        $this->keyType = $this->setting['keyType'];
        $this->timestamps = $this->setting['timestamps'];
        $this->incrementing = $this->setting['incrementing'];
        $this->fillable = $this->setting['fillable'];
        $this->hidden = $this->setting['hidden'];
        $this->casts = $this->setting['casts'];

        Model::__construct($attributes);
    }
}
