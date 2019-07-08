<?php

namespace App\Http\Frontend\Controllers;

use App\Http\Frontend\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        if (Auth::check()) {
            return redirect()->route('client.dashboard');
        }

        return view('frontend.auth.login');
    }

    public function post(LoginRequest $request) {
        try {
            $data = $request->only([
                'email',
                'password',
            ]);

            if(Auth::attempt($data)){
                return redirect()->route('client.dashboard');
            }else{
                dd(2);
            }
        } catch (\Exception $ex) {dd($ex->getMessage());
//            flash(trans('messages.slide.create_error'), 'error');
        }

//        return redirect()->route('slide-managements.index');
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('login');
    }
}
