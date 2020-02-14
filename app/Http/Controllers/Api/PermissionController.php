<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\MsiController;
use App\Traits\MsiCrud;
use App\Traits\MsiData;
use App\Traits\MsiRelation;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use MsiController, MsiData, MsiCrud, MsiRelation;

    protected function data(Request $request)
    {
        return $this->msiData($request);
    }

    protected function relation(Request $request)
    {
        return $this->msiRelation($request);
    }

    protected function create(Request $request)
    {
        return $this->msiCreate($request);
    }

    protected function read(Request $request)
    {
        return $this->msiRead($request);
    }

    protected function update(Request $request)
    {
        return $this->msiUpdate($request);
    }

    protected function delete(Request $request)
    {
        return $this->msiDelete($request);
    }
}
