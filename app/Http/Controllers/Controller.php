<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responseSuccess($payloads = null, $code = 200)
    {
        $response = [
            'error' => false
        ];
        
        if (is_null($payloads) === false) {
            $response['payloads'] = $payloads;
        }
        
        return response($response, $code);
    }
}
