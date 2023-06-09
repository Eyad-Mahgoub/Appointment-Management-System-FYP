<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Patient;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('Auth.Login');
    }

    public function login(LoginRequest $request)
    {

        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('frontend.home');
        }
        return redirect()->back()->withInput()->with('error_message', "Email or Password  Incorrect");
    }

    public function register(RegisterRequest $request)
    {
        $credentials = $request->validated();

        $password = Hash::make($credentials['reg_password']);
        $user = new User();

        $user->first_name = $credentials['reg_first_name'];
        $user->last_name = $credentials['reg_last_name'];
        $user->email = $credentials['reg_email'];
        $user->role_as = 1;
        $user->password = $password;

        $user->save();

        $pat = new Patient();
        $pat->name = $credentials['reg_first_name'] . ' ' . $credentials['reg_last_name'];
        $pat->user_id = $user->id;
        $pat->age = $credentials['reg_age'];
        $pat->address = $credentials['reg_address'];

        $pat->save();

        Auth::loginUsingId($user->id);

        if (Auth::check())
        {
            return redirect()->route('frontend.home');
        }

        return redirect()->back()->withInput()->with('error_message', 'Something Went Wrong');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontend.home');
    }
}
