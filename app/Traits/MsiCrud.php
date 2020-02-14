<?php

namespace App\Traits;

trait MsiCrud
{
    protected function msiCreate($request)
    {
        try {
            $this->msiValidRule($request->only(array_keys($this->msiRule())), $this->msiRule());
            $msiResult = $this->msiSave($request->only(array_keys($this->msiRule())));
            return $this->msiResponse($this->msiMessage(2), $msiResult);
        } catch (\Exception $e) {
            return $this->msiResponse($e->getMessage());
        }
    }

    protected function msiRead($request)
    {
        try {
            $msiResult = $this->msiFind($request->{$this->msiSetup('name')});
            return $this->msiResponse($this->msiMessage(0), $msiResult->load($this->msiValidRelation($request->relation)));
        } catch (\Exception $e) {
            return $this->msiResponse($e->getMessage());
        }
    }

    protected function msiUpdate($request)
    {
        try {
            $this->msiValidRule($request->only(array_keys($this->msiRule())), $this->msiRuleUpdate($request->{$this->msiSetup('name')}));
            $msiResult = $this->msiSave($request->only(array_keys($this->msiRule())), $request->{$this->msiSetup('name')});
            return $this->msiResponse($this->msiMessage(3), $msiResult);
        } catch (\Exception $e) {
            return $this->msiResponse($e->getMessage());
        }
    }

    protected function msiDelete($request)
    {
        try {
            $msiResult = $this->msiFind($request->{$this->msiSetup('name')});
            $msiResult->delete();
            return $this->msiResponse($this->msiMessage(4), $msiResult);
        } catch (\Exception $e) {
            return $this->msiResponse($e->getMessage());
        }
    }
}
