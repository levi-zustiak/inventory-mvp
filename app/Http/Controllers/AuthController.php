<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {
        return Inertia::render('Auth/Login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->input())) {
            $request->session()->regenerate();

            return to_route('home');
        }

        dd('failed to login');
    }
}
