<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // INDEX
    // public function index()
    // {
    //     $users = User::latest()->paginate(10);
    //     return view('pages.user.index', compact('users'));
    // }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::select('id','name','email','status');

            if($request->filterStatus){
                $query->where('status', $request->filterStatus);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = ''; 
                    if(auth()->user()->can('view user')){
                        $btn .= '<a class="px-2 py-2 text-blue-500 hover:bg-blue-500 hover:text-white rounded-md transition" href="'.route('users.show', $row->id).'">View</a>';
                    }
                    if(auth()->user()->can('edit user')){
                        $btn .= '<a class="px-2 py-2 text-yellow-500 hover:bg-yellow-500 hover:text-white rounded-md transition" href="'.route('users.edit', $row->id).'">Edit</a>';
                    }
                    if(auth()->user()->can('delete user')){
                        $btn .= '<form action="'.route('users.destroy', $row->id).'" method="POST" class="inline-block">
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
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('pages.user.index');
    }

    // CREATE
    public function create()
    {
        $roles = Role::all();
        return view('pages.user.create', compact('roles'));
    }

    // STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'status' => 'required',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        // Hash password
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        $user = User::latest()->first();

        // Assign role to user
        if($request->has('roles')) {
            $roleNames = Role::whereIn('id', $request->roles)->pluck('name');
            $user->syncRoles($roleNames);
        }
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // EDIT
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();  
        return view('pages.user.edit', compact('user', 'roles', 'userRoles'));
    }


    // UPDATE
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'status' => 'required',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id'
        ]);

        // Update password if provided
        if($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if($request->has('roles')) {
            $roleNames = Role::whereIn('id', $request->roles)->pluck('name');
            $user->syncRoles($roleNames);
        } else {
            $user->syncRoles([]); // Remove all roles
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // DELETE
    public function destroy(User $user)
    {   
        $user->delete();
        return redirect()->route('users.index')->with('danger', 'User deleted successfully');
    }

    // SHOW
    public function show(User $user)
    {
        $user = User::with('roles')->findOrFail($user->id); 
        return view('pages.user.show', compact('user'));
    }

    // TRASH
    public function trash()
    {
        $users = User::onlyTrashed()->paginate(10);
        return view('pages.user.trash', compact('users'));
    }

    // RESTORE
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.trash')->with('success', 'User restored successfully');
    }

    // PERMANENT DELETE
    public function permanentDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('users.trash')->with('danger', 'User permanently deleted');
    }

    // TOOGLE STATUS
    public function toogleStatus($id)
    {
        $user = User::findOrFail($id);
        $status = $user->status == 'active' ? 'inactive' : 'active';
        $user->update(['status' => $status]);
        return redirect()->back()->with('success', 'User status updated successfully');
    }
}