<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class UserController extends Controller
{
    // Register page
    public function index()
    {
        return view("users.register");
    }

    // Store the user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "email" => "required|email:rfc,dns|unique:users,email",
            "name" => "required|min:3",
            'password' => 'required|min:3',
            'confirm_password' => 'required|same:password'
        ]);

        // Hash password
        $formFields["password"] = bcrypt($formFields["password"]);

        // Store the user
        $user = User::create($formFields);

        // Login the user
        auth()->login($user);

        return redirect("/")->with("success", "Register successfully");
    }

    // Login page
    public function login()
    {
        return view("users.login");
    }

    // Authenticate login user
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            "email" => "required|email:rfc,dns",
            'password' => 'required',
        ]);

        if (Auth::attempt($formFields)) {
            $request->session()->regenerate();
            return redirect("/");
        } else {
            return back()->withErrors(["invalid_credential" => "Invalid credential !"])->onlyInput("invalid_credential");
        }
    }

    // Logout user
    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('login')->with("success", "Logout successfully");
    }
}
