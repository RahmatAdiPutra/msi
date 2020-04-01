<?php

namespace App\Http\Middleware;

use App\Traits\MsiController;
use App\Traits\MsiRolePermission;
use Closure;

class UserRolePermission
{
    use MsiController, MsiRolePermission;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!($this->msiRolePermission($request) === true)) {
            return $this->msiRolePermission($request);
        }

        return $next($request);
    }
}
