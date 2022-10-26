<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

        // Generate verify token
        $formFields["verify_token"] = md5(rand(1, 10) . microtime());

        // Store the user
        $user = User::create($formFields);

        // Send mail to verify
        Mail::to($user)->send(new RegisterMail($user));

        return view("users.confirmation-email");
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

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'enabled' => 1])) {
            $request->session()->regenerate();
            return redirect("/")->with("success", "You are logged in");;
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

    // Verify user
    public function verifyAccount(Request $request)
    {
        // Get user by verify_token
        $code = $request->code;
        // Find user by this code
        $user = User::where("verify_token", "=", $code)->firstOrFail();

        // Set enabled to true
        if ($user) {
            $user->verify_token = null;
            $user->enabled = true;

            $user->save();
        }
        
        return redirect("/login")->with("success", "Verify account successfully!");
    }
}
