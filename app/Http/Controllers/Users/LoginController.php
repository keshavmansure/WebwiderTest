<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('users.login');
    }
    public function login(LoginRequest $request)
    {

        try {
            $credentials = $request->only(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return back()->with('error', 'Invalid email and password');
            }
            return redirect(route('branches.index'));
        } catch (\Throwable $th) {
            info($th->getMessage());
            return back()->with('error', "something went wrong");
        }
    }
    public function logout()
    {
        try {
            Auth::logout();
            return redirect(route('users.index'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong');
        }
    }
}
