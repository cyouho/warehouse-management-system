<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegisterPage()
    {
        return view('register');
    }

    public function showLoginPage()
    {
        return view('login');
    }
}
