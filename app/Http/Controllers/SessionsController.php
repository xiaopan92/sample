<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function create(){
        return view('sessions.create');
    }
    public function store(Request $request){
        $credentials=$this->validate($request,[
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials,$request->has('remember'))){
           if (Auth::user()->activated){
               session()->flash('success','欢迎回来');
               return redirect()->intended(route('users.show',[Auth::user()]));
           }
           else{
                Auth::logout();
                session()->flash('warning','账号未验证，请验证后重新登陆');
                return redirect('/');
           }
        }else{
            session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }
    public function destroy(){
        Auth::logout();
        session()->flash('success','欢迎下次回来');
        return redirect('login');
//        return redirect()->route('sessions.login');
    }

}
