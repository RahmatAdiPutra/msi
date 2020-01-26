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
            'namesapce' => $this->msiSetting->get('setup')['namespace']['model'],
            'name' => Str::before(Str::snake(class_basename($this)), '_'),
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
        return $this->msiClass()->getMethods();
    }

    protected function msiColumn()
    {
        return Schema::getColumnListing(Str::plural($this->msiSetup('name')));
    }

    protected function msiIsMethod($method)
    {
        return collect($this->msiMethod())->contains('name', $method);
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

    protected function msiValidArray($array, $method)
    {
        $data = [];
        foreach ($array as $arr) {
            if ($this->{$method}($arr)) {
                $data[] = $arr;
            }
        }
        return $data;
    }
}
