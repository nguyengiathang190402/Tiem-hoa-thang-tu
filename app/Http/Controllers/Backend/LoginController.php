<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('Backend.login');
    }
    public function postLogin(Request $request){
        dd(123);
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $message = [
            'email.required' => 'Email bắt buộc nhập!',
            'email.email' => 'Email không đúng định dạng!',
            'password.required' => 'Mật khẩu bắt buộc nhập!'

        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return redirect('admin/login')->withErrors($validator);
        } else {
            $email = $request->input('email');
            $password = $request->input('password');
            if (Auth::attempt(['email'=>$email, 'password'=>$password])){
                return redirect('admin');
            } else {
                Session::flash('error', 'Email hoặc mật khẩu không đúng');
                return redirect('admin/login');
            }
        }

    }
}
