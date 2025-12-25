<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // INDEX
    public function index()
    {
        $roles = Role::with('permissions')->latest()->paginate(10);
        return view('pages.role.index', compact('roles'));
    }

    // CREATE
    public function create()
    {
        $permissions = Permission::all();
        return view('pages.role.create', compact('permissions'));
    }

    // STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles,name|max:100',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create(['name' => $data['name']]);
        
        if(isset($data['permissions'])) {
            // ID থেকে permission names নাও
            $permissionNames = Permission::whereIn('id', $data['permissions'])->pluck('name');
            $role->syncPermissions($permissionNames);
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    

    // EDIT
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('pages.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    // UPDATE
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id . '|max:100',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update(['name' => $data['name']]);
        
        if(isset($data['permissions'])) {
            // ID থেকে permission names নাও
            $permissionNames = Permission::whereIn('id', $data['permissions'])->pluck('name');
            $role->syncPermissions($permissionNames);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }


    // DELETE
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('danger', 'Role deleted successfully');
    }

    // SHOW
    public function show(Role $role)
    {
        $permissions = $role->permissions;
        return view('pages.role.show', compact('role', 'permissions'));
    }
}