<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait MsiCrud
{
    protected function msiCreate($request)
    {
        try {
            // if ($request->id) {
            //     $message = 'Customer has been updated';
            // } else {
            //     $message = 'Customer has been created';
            // }
            // $request->save($request->only(array_keys($request->rules())), $request->id);

            return $this->msiResponse(['message' => Str::title($this->msiSetup('name')).' has been created']);
        } catch (\Exception $e) {
            return $this->msiResponse(['message' => $e->getMessage()], true);
        }
    }

    protected function msiRead($request)
    {
        try {
            $relations = $this->msiValidArray(explode(',', $request->relation), 'msiIsMethod');
            $msiRead = $this->msiClass()->name::with($relations)->find($request->{$this->msiSetup('name')});
            if ($msiRead) {
                return $this->msiResponse($msiRead);
            }
            return $this->msiResponse(['message' => Str::title($this->msiSetup('name')).' not found']);
        } catch (\Exception $e) {
            return $this->msiResponse(['message' => $e->getMessage()], true);
        }
    }

    protected function msiUpdate($request)
    {

    }

    protected function msiDelete($request)
    {
        try {
            $msiDelete = $this->msiClass()->name::find($request->{$this->msiSetup('name')});
            if ($msiDelete) {
                $msiDelete->delete();
                return $this->msiResponse(['message' => Str::title($this->msiSetup('name')).' has been deleted']);
            }
            return $this->msiResponse(['message' => Str::title($this->msiSetup('name')).' not found']);
        } catch (\Exception $e) {
            return $this->msiResponse(['message' => $e->getMessage()], true);
        }
    }
}
