<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        try {

            $data = $request->validated();

            if (Auth::attempt($data)) {
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withErrors(['msg' => 'Email or Password is Incorrect']);
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error Occur')->withInput();
        }
    }

    /**
     * @return View
     * @return RedirectResponse
     */
    public function dashboard(): View|RedirectResponse
    {
        try {
            if (Auth::check()) {
                return view('admin.dashboard');
            } else {
                return redirect()->route('login');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error Occur')->withInput();
        }
    }

    /**
     * @return View
     * @return RedirectResponse
     */
     public function logout(): View|RedirectResponse
    {
        try {
            Auth::logout();
        return view('auth.login');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error Occur')->withInput();
        }
    }
}
