<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // get user object
        $user = Auth::user();

        // dashboard for wiring contractor
        if ($user->hasRole('Wiring Contractor')) {
            $wc_quota = $user->quota;
            return view('dashboard', compact('wc_quota', 'user'));
        }

        return view('dashboard', compact('user'));
    }
}
