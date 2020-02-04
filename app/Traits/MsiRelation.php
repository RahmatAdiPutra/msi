<?php

namespace App\Traits;

trait MsiRelation
{
    protected function msiRelation($request)
    {
        try {
            $relations = $this->msiValidRelation($request->relation, false);
            $msiResult = $this->msiSync($request->only($this->msiValidColumnRelation($relations)), $relations, $request->id);
            if ($msiResult) {
                return $this->msiResponse($this->msiMessage(0), $msiResult->$relations);
            }
            return $this->msiThrowMessage($this->msiMessage(1));
        } catch (\Exception $e) {
            return $this->msiResponse($e->getMessage());
        }
    }
}
