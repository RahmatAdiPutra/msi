<?php

namespace App\Traits;

use App\Models\Application;
use Illuminate\Support\Str;

trait MsiRolePermission
{
    protected function msiRolePermission($request)
    {
        try {
            $app = Application::where('ip', $request->ip())->where('app_key', env('MSI_KEY'))->first();

            if (empty($app)) {
                $this->msiThrowMessage('Application not found');
            }

            $token = $request->header('token') ? $request->header('token') : $request->get('token');

            if (empty($token)) {
                $this->msiThrowMessage('Token empty');
            }

            $user = $this->msiClass()->name::with(['roles' => function($query) use ($app){
                $query->wherePivot('application_id', $app->id);
            }])->where('token', $token)->first();

            if (empty($user)) {
                $this->msiThrowMessage('Token not valid');
            }

            $permission = data_get($user->roles->toArray(), '*.permissions');
            $permission = data_get($permission, '*.*');
            $permission = collect($permission)->pluck('name')->unique();

            $allow = $app->alias.'.'.$request->route()->getName();
            $allowAll = Str::replaceLast(Str::afterLast($allow, '.'), '*', $allow);

            if (!($permission->contains($allow) || $permission->contains($allowAll))){
                $this->msiThrowMessage('Access denied');
            }

            $request->merge(['updated_by' => $user->id]);

            return true;
        } catch (\Exception $e) {
            return $this->msiResponse($e->getMessage());
        }
    }
}
