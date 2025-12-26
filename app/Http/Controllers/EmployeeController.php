<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    // VIEW EMPLOYEES INDEX
    // public function index()
    // {
    //     $employees = Employee::paginate(10);
    //     return view('pages.employee.index', compact('employees'));
    // }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Employee::select('id','name','email','phone','address','gender','status','image_url');

            if($request->filterStatus){
                $query->where('status', $request->filterStatus);
            }
            if($request->filterGender){
                $query->where('gender', $request->filterGender);
            }

            return DataTables::of($query)
                ->addIndexColumn(true)
                ->addColumn('image', function($row){
                    return '<img src="' . asset('images/demo.jpg') . '" width="50" height="50" class="img-thumbnail rounded-full" />';
                })
                ->addColumn('action', function($row){
                    $btn = '';
                    if(auth()->user()->can('view employee')){
                        $btn .= '<a class="px-2 py-2 text-blue-500 hover:bg-blue-500 hover:text-white rounded-md transition" href="'.route('employees.show', $row->id).'">View</a>';
                    } 

                    if(auth()->user()->can('edit employee')){
                        $btn .= '<a class="px-2 py-2 text-yellow-500 hover:bg-yellow-500 hover:text-white rounded-md transition" href="'.route('employees.edit', $row->id).'">Edit</a>';
                    }

                    if(auth()->user()->can('delete employee')){
                        $btn .= '<form action="'.route('employees.destroy', $row->id).'" method="POST" class="inline-block">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button type="submit" class="px-2 py-2 text-red-500 hover:bg-red-500 hover:text-white rounded-md transition">Delete</button>
                        </form>';
                    }

                    return $btn;
                })
                ->addColumn('status', function($row){
                    $bg = $row->status == 'active' ? 'bg-green-500 text-green-100' : 'bg-red-500 text-red-100';
                    return '<span class="px-2 py-1 '.$bg.' rounded-lg">'.ucfirst($row->status).'</span>';
                })
                ->rawColumns(['image', 'action', 'status'])
                ->make(true);
        }

        return view('pages.employee.index');
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
