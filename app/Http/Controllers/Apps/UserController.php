<?php

namespace App\Http\Controllers\Apps;
use App\Models\User;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //get Users
        $users = User::when(request()->q,function($users){
            $users = $users->where('name','like','%'.request()->q.'%');
        })->with('roles')->latest()->paginate(config('config.paginate'));

        return Inertia::render('Apps/Users/Index',[
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return Inertia::render('Apps/Users/Create',[
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);

        /**
         * create users
         *
         */
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        //assign roles to user
        $user->assignRole($request->roles);
        return redirect()->route('apps.users.index');
    }

    public function edit($edit)
    {
        $user = User::with('roles')->findOrFail($id);

        $roles = Role::all();

        return Inertia::render('Apps/Users/Edit',[
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request,User $user)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|confirmed'
        ]);

        //check password if empty
        if ($request->password == '') {
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        }

        //assign role to user
        $user->syncRoles($request->roles);
        return redirect()->route('apps.users.index');
    }

    public function destroy($id)
    {
        $user = User->findOrFail($id);
        $user->delete();
        return redirect()->route('apps.users.index');
    }
}
