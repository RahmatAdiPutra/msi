<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    // protected $fillable, $hidden, $casts;

    public function __construct()
    {
        $this->setFillable();
    }
    public function setFillable()
    {
        $fields = Schema::getColumnListing($this->getTable());

        $this->fillable[] = $fields;
    }

    // public function __construct()
    // {
    //     $this->fillable = Setting::get('tables')['app']['models']['user']['fillable'];
    //     $this->hidden = Setting::get('tables')['app']['models']['user']['hidden'];
    //     $this->casts = Setting::get('tables')['app']['models']['user']['casts'];

    //     return parent::__construct();
    // }

    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
