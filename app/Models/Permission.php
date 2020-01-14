<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function __construct(array $attributes = [])
    {
        $this->connection = Setting::get('setup')['app']['models'][$this->getTable()]['connection'];
        $this->table = Setting::get('setup')['app']['models'][$this->getTable()]['table'];
        $this->primaryKey = Setting::get('setup')['app']['models'][$this->getTable()]['primaryKey'];
        $this->keyType = Setting::get('setup')['app']['models'][$this->getTable()]['keyType'];
        $this->timestamps = Setting::get('setup')['app']['models'][$this->getTable()]['timestamps'];
        $this->incrementing = Setting::get('setup')['app']['models'][$this->getTable()]['incrementing'];
        $this->fillable = Setting::get('setup')['app']['models'][$this->getTable()]['fillable'];
        $this->hidden = Setting::get('setup')['app']['models'][$this->getTable()]['hidden'];
        $this->casts = Setting::get('setup')['app']['models'][$this->getTable()]['casts'];
        Model::__construct($attributes);
    }
}
