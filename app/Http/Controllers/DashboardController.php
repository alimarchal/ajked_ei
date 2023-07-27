<?php

namespace App\Http\Controllers;

use DebugBar\DebugBar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // get user object
        $user = \Auth::user();

        // dashboard for wiring contractor
        if ($user->hasRole('Wiring Contractor')) {
            $wc_quota = $user->quota;
            return view('dashboard', compact('wc_quota', 'user'));
        }

        return view('dashboard', compact('user'));
    }
}
