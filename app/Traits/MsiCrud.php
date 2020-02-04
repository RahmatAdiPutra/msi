<?php

namespace App\Traits;

trait MsiCrud
{
    protected function msiCreate($request)
    {
        try {
            $this->msiValidRule($request->only(array_keys($this->msiRule())));
            $msiResult = $this->msiSave($request->only(array_keys($this->msiRule())), $request->{$this->msiSetup('name')});
            return $this->msiResponse($this->msiMessage(2), $msiResult);
        } catch (\Exception $e) {
            return $this->msiResponse($e->getMessage());
        }
    }

    protected function msiRead($request)
    {
        try {
            $msiResult = $this->msiClass()->name::with($this->msiValidRelation($request->relation))->find($request->{$this->msiSetup('name')});
            if ($msiResult) {
                return $this->msiResponse($this->msiMessage(0), $msiResult);
            }
            return $this->msiThrowMessage($this->msiMessage(1));
        } catch (\Exception $e) {
            return $this->msiResponse($e->getMessage());
        }
    }

    protected function msiUpdate($request)
    {
        try {
            // $this->msiValidRule($request->only(array_keys($this->msiRule())));
            $msiResult = $this->msiSave($request->only(array_keys($this->msiRule())), $request->{$this->msiSetup('name')});
            return $this->msiResponse($this->msiMessage(3), $msiResult);
        } catch (\Exception $e) {
            return $this->msiResponse($e->getMessage());
        }
    }

    protected function msiDelete($request)
    {
        try {
            $msiResult = $this->msiClass()->name::find($request->{$this->msiSetup('name')});
            if ($msiResult) {
                $msiResult->delete();
                return $this->msiResponse($this->msiMessage(4), $msiResult);
            }
            return $this->msiThrowMessage($this->msiMessage(1));
        } catch (\Exception $e) {
            return $this->msiResponse($e->getMessage());
        }
    }
}
