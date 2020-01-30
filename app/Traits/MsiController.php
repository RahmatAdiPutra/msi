<?php

namespace App\Traits;

use ReflectionClass;
use ReflectionMethod;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

trait MsiController
{
    protected $msiSetting;

    public function __construct()
    {
        $this->msiSetting = new Setting();
    }

    protected function msiSetup($setup)
    {
        $msiSetup = [
            'name' => Str::before(Str::snake(class_basename($this)), '_'),
            'namesapce' => $this->msiSetting->get('setup')['namespace']['model'],
            'clause' => $this->msiSetting->get('setup')['search']['clause'],
            'direction' => $this->msiSetting->get('setup')['search']['direction'],
        ];

        return $msiSetup[$setup];
    }

    protected function msiDefault($default)
    {
        $msiDefault = [
            'clause' => $this->msiSetup('clause')[0],
            'column' => $this->msiColumn()[0],
            'order' => $this->msiColumn()[count($this->msiColumn()) - 1],
            'direction' => $this->msiSetup('direction')[1],
        ];

        return $msiDefault[$default];
    }

    protected function msiClass()
    {
        return new ReflectionClass($this->msiSetup('namesapce').Str::title($this->msiSetup('name')));
    }

    protected function msiMethod()
    {
        return collect($this->msiClass()->getMethods(ReflectionMethod::IS_PUBLIC))->filter(function ($value, $key) {
            return $value->class == $this->msiClass()->name;
        })->pluck('name')->toArray();
    }

    protected function msiColumn()
    {
        return Schema::getColumnListing(Str::plural($this->msiSetup('name')));
    }

    protected function msiIsMethod($method)
    {
        return collect($this->msiMethod())->contains($method);
    }

    protected function msiIsColumn($column)
    {
        return collect($this->msiColumn())->contains($column);
    }

    protected function msiIsSetupClause($clause)
    {
        return collect($this->msiSetup('clause'))->contains($clause);
    }

    protected function msiIsSetupDirection($direction)
    {
        return collect($this->msiSetup('direction'))->contains($direction);
    }

    protected function msiValidArray(Array $array, $method)
    {
        foreach ($array as $arr) {
            if ($this->{$method}($arr)) {
                $data[] = $arr;
            }
        }
        return isset($data) ? $data : Array();
    }

    protected function msiResponse($payloads, $error = false)
    {
        $response = [
            'error' => $error,
            'payloads' => $payloads,
        ];

        return response($response);
    }
}
