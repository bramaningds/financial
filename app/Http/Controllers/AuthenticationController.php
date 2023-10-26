<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\PostLoginRequest;
use App\Http\Requests\PostRegisterRequest;

class AuthenticationController extends Controller
{
    public function getLogin()
    {
        return view('auth.login', [
            'user' => User::find(1)
        ]);
    }

    public function postLogin(PostLoginRequest $request)
    {
        if (!auth()->attempt($request->only('email', 'password'), $request->input('remember', false)))
            return back()->onlyInput('email')->withErrors([
                'authentication' => 'The provided credentials do not match our records.',
            ]);

        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    public function getLogout()
    {
        auth()->logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->intended('/');
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(PostRegisterRequest $request)
    {
        return $request->all();
    }
}
