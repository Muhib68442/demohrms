<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // INDEX
    public function index()
    {
        $permissions = Permission::latest()->paginate(10);
        return view('pages.permission.index', compact('permissions'));
    }

    // CREATE
    public function create()
    {
        return view('pages.permission.create');
    }

    // STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:permissions,name|max:100',
        ]);

        Permission::create($data);
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
    }

    // EDIT
    public function edit(Permission $permission)
    {
        return view('pages.permission.edit', compact('permission'));
    }

    // UPDATE
    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id . '|max:100',
        ]);

        $permission->update($data);
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
    }

    // DELETE
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('danger', 'Permission deleted successfully');
    }
}