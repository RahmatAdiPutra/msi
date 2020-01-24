<?php

namespace App\Traits;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

trait MsiControllerTrait
{
    protected $msiSetting, $msiClass;

    public function __construct()
    {
        $this->msiClass = Str::before(Str::snake(class_basename($this)), '_');
        $this->msiSetting = new Setting();
    }

    protected function msiClass()
    {
        return $this->msiSetting->get('setup')['namespace']['model'].Str::title($this->msiClass);
    }

    protected function msiColumn()
    {
        return Schema::getColumnListing(Str::plural($this->msiClass));
    }

    protected function msiCount()
    {
        return $this->msiClass()::all()->count();
    }

    protected function msiData($request)
    {
        $start = $request->get('start', 0);
        $limit = $request->get('limit', 10);
        $query = $this->msiClass()::select('*');

        // $query->with('roles');

        $paginate = $query->paginate($limit)->toArray();
        if (empty($request->get('page'))) {
            $paginate['from'] = $start;
            $paginate['to'] = $limit + ($start - 1);
            $paginate['data'] = $query->skip($start)->take($limit)->get();
        }

        return response($paginate);
    }

    protected function msiCreate($request)
    {

    }

    protected function msiRead($request)
    {

    }

    protected function msiUpdate($request)
    {

    }

    protected function msiDelete($request)
    {

    }
}
