<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        $users = User::orderBy('id','ASC')->paginate(5);

        return view('Backend.users.index',compact('users'));

    }
    public function impersonate($id){
        $user = User::find($id);
        if($user){
            Session::put('impersonate', $user->id);
        }
        return redirect()->route('users.index');
    }
    

    public function create()
    {
        if(auth()->user()->hasRole('Super-Admin')){
            $roles = Role::pluck('name','name')->all();
        }else{
            $roles = Role::pluck('name','name')->except(['name', 'Super-Admin']);
        }
        
        return view('Backend.users.create',compact('roles'));
    }
    

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm-password' => 'required|same:password',
            'roles' => 'required'
        ]);
        // dd(1);
        $input = $request->all();
        // dd($input);
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        toastr()->success('Thêm người dùng thành công');
        return redirect()->route('users.index');
    }
    
    public function show($id)
    {
        return redirect()->route('users.index');
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        if($user->hasRole('Super-Admin')){
            toastr()->error('Bạn không có quyền để chỉnh sửa người dùng này');
            
            return redirect()->route('users.index');
        }
        if(auth()->user()->hasRole('Super-Admin')){
            $roles = Role::pluck('name','name')->all();
        }else{
            $roles = Role::pluck('name','name')->except(['name', 'Super-Admin']);
        }
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('Backend.users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            // 'password' => 'same:confirm-password',            
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
        toastr()->success('Người dùng cập nhật thành công');
        return redirect()->route('users.index');
    }
    
    public function destroy($id)
    {
        $user = User::find($id);
        if(auth()->id() == $id){
            toastr()->error('Bạn không thể xóa bản thân');
            return redirect()->route('users.index');
        }
        if($user->hasRole('Super-Admin')){
            toastr()->error('Bạn không thể xoá người dùng này!');
            return redirect()->route('users.index');
        }
        $user->delete();
        toastr()->success('Người dùng đã xóa thành công');
        return redirect()->route('users.index');
    }
}
