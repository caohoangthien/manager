<?php

namespace App\Http\Frontend\Controllers;

use App\Http\Frontend\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        return view('frontend.dashboard.index');
    }
}
