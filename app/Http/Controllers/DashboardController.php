<?php

namespace App\Http\Controllers;

use App\Models\TestReport;
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
            $total_wc_test_reports = TestReport::where('user_id', $user->id)->count();
            return view('dashboard', compact('wc_quota', 'user','total_wc_test_reports'));
        }

        return view('dashboard', compact('user'));
    }
}
