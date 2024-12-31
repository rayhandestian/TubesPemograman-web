<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function signin()
    {
        return view('auth.signin');
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function signinPost(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('name','password');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }
        return redirect()->intended(route('signin'))-> with("error","login gagal");
    }

    public function signupPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'age' => 'required|integer|max:255',
            'password' => 'required|string|min:4|confirmed',
        ]);
        $data['name'] =  $request->name;
        $data['mother_name'] =  $request->mother_name;
        $data['age'] =  $request->age;
        $data['password'] =  Hash::make($request->password);
        $user = User::create($data);

        if(!$user){
            return redirect()->intended(route('signup'))-> with("error","registrasi gagal");
        }

        return redirect(route('signin'))->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
