<?php

namespace App\Http\Frontend\Controllers;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function logout() {
        Auth::logout();

        return redirect()->route('login');
    }
}
