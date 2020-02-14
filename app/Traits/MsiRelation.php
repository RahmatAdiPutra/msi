<?php

namespace App\Traits;

trait MsiRelation
{
    protected function msiRelation($request)
    {
        try {
            $relation = $this->msiValidRelation($request->relation, false);
            $validColumnRelation = $this->msiValidColumnRelation($relation);
            $requestOnly = $request->only($validColumnRelation);
            $ruleRelation = $this->msiRuleRelation($validColumnRelation);
            $this->msiValidRule($requestOnly, $ruleRelation);
            $msiResult = $this->msiSync($requestOnly, $relation, $request->id);
            return $this->msiResponse($this->msiMessage(0), $msiResult->load($relation));
        } catch (\Exception $e) {
            return $this->msiResponse($e->getMessage());
        }
    }
}
