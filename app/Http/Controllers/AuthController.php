<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     public function showRegister()
    {
        return view('admin.auth.register');
    }

    // Handle Admin Registration
    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
            'phone_number' => 'required|digits_between:10,15',
        ]);

        User::create([
            'role_id' => 1, // Admin
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'status' => 'active',
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin account created successfully!');
    }

    // Show Admin Login Form
    public function showLogin()
    {

          if(Auth::check()){
            return redirect('/admin/dashboard');
        }
        return view('admin.auth.login');
    }

    // Handle Admin Login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:4',
        ]);

        if(Auth::attempt($request->only('email','password'))){

            // Sirf admin ko allow
            if(Auth::user()->role_id != 1){
                Auth::logout();
                return back()->with('error','Only admin can login here.');
            }

            return redirect('/admin/dashboard');
        }

        return back()->with('error','Invalid Email or Password');
    }

    // =======================
    // Show Dashboard
    // =======================
    public function showDash()
    {
        return view('admin.dashboard');
    }
    // Admin Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.products.index');
    }

     // Admin login logic


 public function redirectAfterLogin()
{
    $user = auth()->user();

    if ($user->role_id == 1) {
        // Admin
        return view('/admin.layouts.sidebar');
    } elseif ($user->role_id == 2) {
        // Customer
        return redirect('/'); // Home page
    } else {
        auth()->logout();
        return redirect('/login')->with('error', 'Role not recognized.');
    }
}


   public function showUserLogin()
    {
        if (Auth::check()) {
            return redirect('/product');
        }
        return view('user.auth.login');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:4',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            if (Auth::user()->role_id != 2) {
                Auth::logout();
                return back()->with('error', 'Only users can login here.');
            }

            return redirect('/product');
        }

        return back()->with('error', 'Invalid Email or Password');
    }

    /* =====================
       LOGOUT
    ======================*/
    public function logoutUser()
    {
        Auth::logout();
        return redirect('/');
    }

}


  

