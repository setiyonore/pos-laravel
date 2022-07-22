<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index() {
        //get roles
        $roles = Role::when(request()->q,function($roles){
            $roles = $roles->where('name','like','%'.request()->q.'%');
        })->with('permissions')->latest()->paginate(5);

        return inertia('Apps/Roles/Index',[
            'roles'=>$roles,
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();
        return inertia('Apps/Roles/Create',[
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
       /**
         * Validate request
         */
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required',
        ]);

        //create role
        $role = Role::create(['name' => $request->name]);

        //assign permissions to role
        $role->givePermissionTo($request->permissions);

        //redirect
        return redirect()->route('apps.roles.index');
    }

    public function edit($edit)
    {
        //get role
        $role = Role::with('permissions')->findOrFail($id);

        //get permission all
        $permissions = Permission::all();

        return inertia('Apps/Roles/Edit',[
            'role' => $role,
            'permissions' =>$permissions,
        ]);
    }

    public function update(Request $request,Role $role)
    {
        $this->validate($request,[
            'name' => 'required',
            'permissions' => 'required',
        ]);
        //update
        $role->update(['name' => $request->name]);
        //sysnc permissions
        $role->syncPermissions($request->permissions);
        return redirect()->route('apps.roles.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('apps.roles.index');
    }
}
