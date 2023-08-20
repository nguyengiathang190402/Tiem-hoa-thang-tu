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
         $this->middleware('permission:user-show', ['only' => ['show']]);
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

        $users = User::all();
        return view('Backend.users.create',compact('roles', 'users'));
    }
    

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm-password' => 'required|same:password',
            'phone' => ['required', 'regex:/^0\d{9,10}$/'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable',
            'gender' => 'nullable|in:0,1',
            'roles' => 'required'
        ]);
        // dd(1);
        $input = $request->all();
        // dd($input);
        $input['password'] = Hash::make($input['password']);
        
        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('avatars', 'public');
            $input['image'] = $imagePath;
        }
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

    
        toastr()->success('Thêm người dùng thành công');
        return redirect()->route('users.index');
    }
    
    public function show($id)
    {
        $users = User::find($id);
        return view('Backend.users.show', compact('users'));
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
            'phone' => ['required', 'regex:/^0\d{9,10}$/'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable',
            'gender' => 'nullable|in:0,1',
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
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('avatars', 'public');
            $input['image'] = $imagePath;
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
    public function ajaxChangeStatus(Request $request)
    {
        $userId = $request->input('user_id');
        $newStatus = $request->input('status');
        
        $user = User::findOrFail($userId);

        if (auth()->user()->hasRole('Super-Admin')) {
            $role = $user->roles->first();
            if ($role->name === 'Super-Admin') {
                // toastr()->error('Bạn không có quyền để chỉnh sửa trạng thái của Super-Admin.');
                return response()->json(['message' => 'Không thể thay đổi trạng thái của Super-Admin.'], 403);
            }

            $user->status = $newStatus;
            $user->save();

            return response()->json(['message' => 'Trạng thái của người dùng đã được cập nhật.']);
        }

        return response()->json(['message' => 'Bạn không có quyền thay đổi trạng thái.'], 403);
    }


}
