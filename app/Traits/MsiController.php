<?php

namespace App\Traits;

use ReflectionClass;
use ReflectionMethod;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

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
            'model' => $this->msiSetting->get('setup')['app']['models'],
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

    protected function msiPrimaryKey()
    {
        return $this->msiSetup('model')[$this->msiSetup('name')]['primaryKey'];
    }

    protected function msiForeignKey()
    {
        return $this->msiSetup('name').'_'.$this->msiPrimaryKey();
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

    protected function msiRule()
    {
        return $this->msiSetup('model')[Str::singular($this->msiSetup('name'))]['rules'];
    }

    protected function msiTableRelation($relation)
    {
        $classname = $this->msiClass()->name;
        return empty($relation) ? '' : (new $classname())->{$relation}()->getTable();
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

    protected function msiColumnRelation($relation)
    {
        return Schema::getColumnListing($relation);
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

    protected function msiValidRelation($relation, $multiple = true)
    {
        if ($multiple) {
            return $this->msiValidArray(explode(',', $relation), 'msiIsMethod');
        } else {
            return $this->msiIsMethod($relation) ? $relation : '';
        }
    }

    protected function msiValidColumn($column, $multiple = true)
    {
        if ($multiple) {
            return $this->msiValidArray(explode(',', $column), 'msiIsColumn');
        } else {
            return $this->msiIsColumn($column) ? $column : '';
        }
    }

    protected function msiValidColumnRelation($relation)
    {
        return $this->msiColumnRelation($this->msiTableRelation($this->msiValidRelation($relation, false)));
    }

    protected function msiValidRule($rule)
    {
        $validator = Validator::make($rule, $this->msiRule());

        if ($validator->fails()) {
            $this->msiThrowMessage(collect($validator->errors())->flatten()->first());
        }
    }

    protected function msiSave($data, $id = null)
    {
        if ($id) {
            $msiData = $this->msiClass()->name::find($id);
        } else {
            $classname = $this->msiClass()->name;
            $msiData = new $classname();
        }

        foreach ($data as $field => $value) {
            $msiData->$field = $value;
        }

        $msiData->save();

        return $msiData;
    }

    protected function msiSync($data, $relation, $id)
    {
        if (empty($id)) {
            return false;
        } else {
            $msiData = $this->msiClass()->name::find($id);
            $counter = empty($data) ? 0 : count(collect($data)->first());

            for ($i=0; $i < $counter; $i++) {
                foreach ($data as $dKey => $dVal) {
                    $tmp[$dKey] = $dVal[$i];
                }
                $msiSync[] = isset($tmp) ? $tmp : Array();
            }

            $msiSync = isset($msiSync) ? $msiSync : Array();
            $msiData->{$relation}()->sync($msiSync);
            return empty($relation) ? 0 : $msiData->load($relation);
        }
    }

    protected function msiMessage($message)
    {
        return $this->msiSetting->get('setup')['message'][$message];
    }

    protected function msiThrowMessage($message = null)
    {
        throw new \Exception($message);
    }

    protected function msiResponse($message, $payloads = null)
    {
        $response = [
            'error' => $payloads == null ? true : false,
            'message' => Str::words($message),
            'payloads' => $payloads,
        ];

        return response($response);
    }
}
