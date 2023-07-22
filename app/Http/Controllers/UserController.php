<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:Super-Admin')->only(['create', 'index', 'store', 'edit', 'update']);
    }

    public function index()
    {
        $users = QueryBuilder::for(User::with('roles', 'permissions'))
            ->allowedFilters(['name', 'email', 'mobile_no', 'license_number', 'cnic'])
            ->get();
        return view('users.index', compact('users'));
    }

    //
    public function create()
    {
        $roles = Role::pluck('name', 'id');

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::find($request->role);
        $user->assignRole($role);

        session()->flash('status', 'User has been successfully added into database.');

        return to_route('users.index');
    }

    public function edit(User $user, Request $request)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $user->update($request->all());
        $user->syncPermissions($request->input('permissions', []));

        session()->flash('status', 'User has been updated successfully.');
        return to_route('users.edit', compact('user'));
//        $this->validate($request, [
//            'name' => 'required|string|max:255',
//            'email' => 'required|email|unique:users,email,' . $user->id,
//            'permissions' => 'array',
//            'permissions.*' => 'exists:permissions,id',
//        ]);
//
//        $user->update($request->all());
//
//        // Get the user's current roles
//        $currentRoles = $user->roles->pluck('name')->toArray();
//
//        // Get the roles and permissions from the request
//        $roles = $request->input('roles', []);
//        $permissions = $request->input('permissions', []);
//
//        // Remove indirect permissions from the user's roles
//        foreach ($currentRoles as $roleName) {
//            $role = Role::where('name', $roleName)->first();
//
//            foreach ($permissions as $permissionId) {
//                $permission = Permission::find($permissionId);
//
//                // If the role doesn't have the direct permission, revoke the indirect permission
//                if (!$role->hasPermissionTo($permission)) {
//                    $role->revokePermissionTo($permission);
//                }
//            }
//        }
//
//        // Synchronize the roles and permissions
//        $user->syncRoles($roles);
//        $user->syncPermissions($permissions);
//
//        session()->flash('status', 'User has been updated successfully.');
//        return redirect()->route('users.edit', compact('user'));


    }
}
