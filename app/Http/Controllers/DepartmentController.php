<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // INDEX
    public function index()
    {
        $departments = Department::latest()->paginate(10);
        return view('pages.department.index', compact('departments'));
    }

    // CREATE
    public function create()
    {
        return view('pages.department.create');
    }

    // STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:100|unique:departments,name',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);

        Department::create($data);
        return redirect()->route('departments.index')->with('success', 'Department created successfully');
    }

    // EDIT
    public function edit(Department $department)
    {
        return view('pages.department.edit', compact('department'));
    }

    // UPDATE
    public function update(Request $request, Department $department)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:100|unique:departments,name,' . $department->id,
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);

        $department->update($data);
        return redirect()->route('departments.index')->with('success', 'Department updated successfully');
    }

    // DELETE
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('danger', 'Department deleted successfully');
    }

    // TRASH
    public function trash()
    {
        $departments = Department::onlyTrashed()->paginate(10);
        return view('pages.department.trash', compact('departments'));
    }

    // RESTORE
    public function restore($id)
    {
        $department = Department::withTrashed()->findOrFail($id);
        $department->restore();
        return redirect()->route('departments.trash')->with('success', 'Department restored successfully');
    }

    // PERMANENT DELETE
    public function permanentDelete($id)
    {
        $department = Department::withTrashed()->findOrFail($id);
        $department->forceDelete();
        return redirect()->route('departments.trash')->with('danger', 'Department permanently deleted');
    }
}