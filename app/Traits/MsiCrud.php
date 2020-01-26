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

            return $this->responseSuccess(['message' => 'test']);
        } catch (\Exception $e) {
            return $this->responseSuccess(['message' => $e->getMessage()]);
        }
    }

    protected function msiRead($request)
    {
        try {
            $relations = $this->msiValidArray(explode(',', $request->relation), 'msiMethod');
            $msiRead = $this->msiClass()->name::with($relations)->find($request->{$this->msiSetup('name')});
            if ($msiRead) {
                return response($msiRead);
            }
            return response(['message' => Str::title($this->msiSetup('name')).' not found']);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()]);
        }
    }

    protected function msiUpdate($request)
    {

    }

    protected function msiDelete($request)
    {

    }
}
