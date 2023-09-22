<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function hasPermission($permission) {
        $model_has_role = \DB::table('model_has_roles')->where('model_id', Auth::user()->id)->first();
        $role = Role::find($model_has_role->role_id);
        $has_permission = false;

        foreach ($role->permissions as $key => $value) {
            if ($value->name == $permission) {
                $has_permission = true;
                break;
            }
        }

        return $has_permission;
    }
}
