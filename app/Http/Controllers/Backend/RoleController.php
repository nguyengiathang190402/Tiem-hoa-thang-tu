<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use DB;
    
class RoleController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','ASC')->paginate(5);
        return view('Backend.roles.index',compact('roles'));
    }
    
    public function create()
    {
        $permission = Permission::get();
        return view('Backend.roles.create',compact('permission'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Vai trò được tạo ra thành công');
    }

    public function show($id)
    {
        return redirect()->route('roles.index');
    }
    
    public function edit($id)
    {
        $role = Role::find($id);
        if($role->name == 'Super-Admin'){
            toastr()->error('Bạn không có sự cho phép để chỉnh sửa vai trò này');
            return redirect()->route('roles.index');
        }

        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('Backend.roles.edit',compact('role','permission','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('roles','name')->ignore($id)
            ],
            'permission' => 'required'
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Vai trò được cập nhật thành công');
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (auth()->user()->roles->find($id)) {   
            toastr()->error('Bạn không có quyền xóa vai trò này');
            return redirect()->route('roles.index');
        }
        if ($role->name == "Super-Admin"){
            toastr()->error('Bạn không có sự cho phép cho vai trò Super-Admin');
            return redirect()->route('roles.index');
        }
        $role->delete();       
        toastr()->success('Vai trò đã bị xóa thành công');
        return redirect()->route('roles.index');
    }
}