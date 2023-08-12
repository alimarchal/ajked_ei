<?php

namespace App\Http\Controllers;

use App\Models\DivisionSubDivision;
use App\Models\TestReport;
use App\Models\User;
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
            return view('dashboard', compact('wc_quota', 'user', 'total_wc_test_reports'));
        } elseif ($user->hasRole(['SDO', 'X-En'])) {

            $sub_division_id = $user->division_sub_division_id;
            if (!empty($sub_division_id)) {
                if ($user->hasRole(['SDO'])) {
                    $sub_division_access = DivisionSubDivision::where('id', $sub_division_id)->pluck('id')->toArray();
                } elseif ($user->hasRole(['X-En'])) {
                    $sub_division_access = DivisionSubDivision::where('division_code', DivisionSubDivision::find($sub_division_id)->division_code)->pluck('id')->toArray();
                }
            }
            $approved_test_reports = TestReport::where('noc_issued', 1)->whereIn('division_sub_division_id', $sub_division_access)->count();
            $objection_test_reports = TestReport::where('status', 'Objection')->where('phase_id', 2)->whereIn('division_sub_division_id', $sub_division_access)->count();
            $seen_test_reports_1p = TestReport::where('status', 'Approved')->where('phase_id', 1)->whereIn('division_sub_division_id', $sub_division_access)->count();

            $pending_test_reports = TestReport::where('sdo_verified', 0)->where('xen_verified', 0)->where('phase_id', 2)->whereIn('division_sub_division_id', $sub_division_access)->count();

            $wiring_contractor_users = User::whereIn('division_sub_division_id', $sub_division_access)
                ->role('Wiring Contractor')
                ->count();

            return view('dashboard', compact('user', 'approved_test_reports', 'objection_test_reports', 'seen_test_reports_1p', 'pending_test_reports', 'wiring_contractor_users'));

        } elseif ($user->hasRole(['DEI', 'AEI'])) {

            $sub_division_id = $user->division_sub_division_id;
            if (!empty($sub_division_id)) {
                $circle_access = DivisionSubDivision::where('circle', DivisionSubDivision::find($sub_division_id)->circle)->pluck('id')->toArray();
            }

            $noc_issued = TestReport::where('noc_issued', 1)->where('status', 'Approved')->whereIn('division_sub_division_id', $circle_access)->count();
            $pending_test_reports_approval = TestReport::where('dei_verified', 0)->where('aei_verified', 0)->where('phase_id', 2)->whereIn('division_sub_division_id', $circle_access)->count();
            $submit_to_electric_inspector = TestReport::where('dei_verified', 1)->where('aei_verified', 1)->where('ei_verified', 0)->where('phase_id', 2)->whereIn('division_sub_division_id', $circle_access)->count();
            $noc_objection = TestReport::where('status', 'Objection')->whereIn('division_sub_division_id', $circle_access)->count();

            $seen_test_reports_1p = TestReport::where('status', 'Approved')->where('phase_id', 1)->whereIn('division_sub_division_id', $circle_access)->count();


            return view('dashboard', compact('user', 'noc_issued', 'noc_objection', 'submit_to_electric_inspector', 'seen_test_reports_1p', 'pending_test_reports_approval'));


        } elseif ($user->hasRole(['Electric Inspector'])) {
            $noc_issued = TestReport::where('noc_issued', 1)->where('status', 'Approved')->count();
            $submit_to_electric_inspector = TestReport::where('dei_verified', 1)->where('aei_verified', 1)->where('ei_verified', 0)->where('phase_id', 2)->count();
            $noc_objection = TestReport::where('status', 'Objection')->count();

            return view('dashboard', compact('user', 'noc_issued', 'submit_to_electric_inspector', 'noc_objection'));

        } else {
            $noc_issued = TestReport::where('noc_issued', 1)->where('status', 'Approved')->count();
            $submit_to_electric_inspector = TestReport::where('dei_verified', 1)->where('aei_verified', 1)->where('ei_verified', 0)->where('phase_id', 2)->count();
            $noc_objection = TestReport::where('status', 'Objection')->count();

            return view('dashboard', compact('user', 'noc_issued', 'submit_to_electric_inspector', 'noc_objection'));

        }


        return view('dashboard', compact('user'));
    }
}
