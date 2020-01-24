<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\MsiControllerTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use MsiControllerTrait;

    protected function data(Request $request)
    {
        return $this->msiData($request);
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
