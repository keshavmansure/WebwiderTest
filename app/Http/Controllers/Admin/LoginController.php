<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect(route('branch-histories.index'));
            } else {
                return back()->with('error', 'Invalid email and password');
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function logout()
    {
        try {
            Auth::guard('admin')->logout();
            return redirect(route('users.index'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong');
        }
    }
}
