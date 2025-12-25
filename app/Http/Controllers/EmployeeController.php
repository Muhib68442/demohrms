<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // VIEW EMPLOYEES INDEX
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('pages.employee.index', compact('employees'));
    }

    // CREATE EMPLOYEE (FORM)
    public function create()
    {
        return view('pages.employee.create');
    }

    // STORE EMPLOYEE
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:32',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|numeric|unique:employees,phone',
            'address' => 'required',
            'gender' => 'required|in:male,female',
            'status' => 'required|in:active,inactive|default:active',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // STORE IMAGE 
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('employees', $filename, 'public');
            $data['image'] = $filename;
        }

        // STORE EMPLOYEE DATA
        Employee::create($data);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    // SHOW EMPLOYEE
    public function show(Employee $employee)
    {   
        return view('pages.employee.show', compact('employee'));
    }

    // EDIT EMPLOYEE (FORM)
    public function edit(Employee $employee)
    {
        return view('pages.employee.edit', compact('employee'));
    }

    // UPDATE EMPLOYEE
    public function update(Request $request, string $id, Employee $employee)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:32',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone' => 'required|numeric|unique:employees,phone,' . $id,
            'address' => 'required',
            'gender' => 'required|in:male,female',
            'status' => 'required|in:active,inactive|default:active',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image')){ 
            $file = $request->file('image');
            $filename = $employee->image;
            $file->storeAs('employees', $filename, 'public');
            $data['image'] = $filename;
        }


        // UPDATE EMPLOYEE DATA
        $employee = Employee::findOrFail($id);
        $employee->update($data);
        return redirect()->route('employees.show', $employee->id)->with('success', 'Employee updated successfully.');
    }

    
    // SOFT DELETE
    public function destroy(string $id)
    {
        // SOFTDELETE THE EMPLOYEE 
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('danger', 'Employee deleted successfully.');
    }

    // VIEW TRASH INDEX
    public function trash()
    {
        $employees = Employee::onlyTrashed()->paginate(10);
        return view('pages.employee.trash', compact('employees'));
    }

    // RESTORE EMPLOYEE
    public function restore($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->restore();
        return redirect()->route('employees.trash')->with('success', 'Employee restored successfully.');
    }

    // PERMANENT DELETE
    public function permanentDelete($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->forceDelete();
        return redirect()->route('employees.trash')->with('danger', 'Employee permanently deleted.');
    }

    // TOOGLE STATUS 
    public function toogleStatus(Employee $employee){
        $newStatus = $employee->status == 'active' ? 'inactive' : 'active';
        $employee->update(['status' => $newStatus]);
        // return redirect()->route('employees.index')->with('success', 'Employee status updated successfully.');
        return redirect()->back()->with('success', 'Employee status updated successfully.');
    }

}
