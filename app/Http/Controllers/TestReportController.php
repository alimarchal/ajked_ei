<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestReportRequest;
use App\Http\Requests\UpdateTestReportRequest;
use App\Models\DivisionSubDivision;
use App\Models\LoadDetail;
use App\Models\TestReportSubmit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Import the DB facade
use App\Models\TestReport;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TestReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
//
//        if ($user->hasRole('Wiring Contractor')) {
//            $test_reports = QueryBuilder::for(TestReport::with('phase', 'divisionSubDivision'))
//                ->allowedFilters(['consumer_name', 'father_husband_name', 'cnic', 'mobile_number', 'phase_id'])
//                ->where('user_id', $user->id)->orderBy('created_at','DESC')
//                ->when(request('status') === 'In-Process', function ($query) {
//                    $query->where('status', 'In-Process');
//                })
//                ->orderBy('created_at', 'desc')
//                ->get();
//            return view('test-reports.index', compact('test_reports', 'user'));
//
//        } elseif ($user->hasRole(['SDO', 'X-En'])) {
//            // sub division  -- for xen
//
//            $role_id = Role::findByName($user->getRoleNames()[0], 'web')->id;
//            $role_name = Role::findByName($user->getRoleNames()[0], 'web')->name;
//
//            $sub_division_access = [];
//            if ($role_name == "SDO") {
//                // get division or sub division
//                $sub_div_id = $user->division_sub_division_id;
//                if (!empty($sub_div_id)){
//                    $sub_division_access = DivisionSubDivision::where('id',DivisionSubDivision::find($sub_div_id)->id)->pluck('id')->toArray();
//                }
//
//            } elseif($role_name == "X-En") {
//                // get division or sub division
//                $sub_div_id = $user->division_sub_division_id;
//                if (!empty($sub_div_id)){
//                    $sub_division_access = DivisionSubDivision::where('division_code',DivisionSubDivision::find($sub_div_id)->division_code)->pluck('id')->toArray();
//                }
//            }
//
//            $test_reports =  QueryBuilder::for(TestReport::with('phase', 'divisionSubDivision', 'testReportSubmit', 'reviews'))
//                ->allowedFilters(['consumer_name', 'father_husband_name', 'cnic', 'mobile_number', 'phase_id'])
//                ->whereIn('division_sub_division_id', $sub_division_access)
//                ->when(request('status') === 'In-Process', function ($query) {
//                    $query->where('status', 'In-Process');
//                })
//                ->orderBy('created_at', 'desc')
//                ->get();
//
//            return view('test-reports.index', compact('test_reports', 'user', 'role_id'));
//
//
//        } elseif ($user->hasRole(['DEI', 'AEI'])) {
//
//            $circle_access = [];
//            $sub_div_id = $user->division_sub_division_id;
//            if (!empty($sub_div_id)){
//                $circle_access = DivisionSubDivision::where('circle',DivisionSubDivision::find($sub_div_id)->circle)->pluck('id')->toArray();
//            }
//
//
//            $role_id = Role::findByName($user->getRoleNames()[0], 'web')->id;
//
//
//            $test_reports =  QueryBuilder::for(TestReport::with('phase', 'divisionSubDivision', 'testReportSubmit', 'reviews'))
//                ->allowedFilters(['consumer_name', 'father_husband_name', 'cnic', 'mobile_number', 'phase_id'])
//                ->whereIn('division_sub_division_id', $circle_access)
//                ->when(request('status') === 'In-Process', function ($query) {
//                    $query->where('status', 'In-Process');
//                })
//                ->orderBy('created_at', 'desc')
//                ->get();
//
//
//            return view('test-reports.index', compact('test_reports', 'user', 'role_id'));
//
//        } elseif ($user->hasRole(['Electric Inspector'])) {
//            // all reports ajk all division
//            $test_reports =  QueryBuilder::for(TestReport::with('phase', 'divisionSubDivision', 'testReportSubmit', 'reviews'))
//                ->allowedFilters(['consumer_name', 'father_husband_name', 'cnic', 'mobile_number', 'phase_id'])
//                ->when(request('status') === 'In-Process', function ($query) {
//                    $query->where('status', 'In-Process');
//                })
//                ->orderBy('created_at', 'desc')
//                ->get();
//
//            return view('test-reports.index', compact('test_reports', 'user'));
//
//        } else {
//            $test_reports =  QueryBuilder::for(TestReport::with('phase', 'divisionSubDivision', 'testReportSubmit', 'reviews'))
//                ->allowedFilters(['consumer_name', 'father_husband_name', 'cnic', 'mobile_number', 'phase_id'])->get();
//            return view('test-reports.index', compact('test_reports', 'user'));
//        }

        $testReportsQuery = QueryBuilder::for(TestReport::with('phase', 'divisionSubDivision', 'testReportSubmit', 'reviews'))
            ->allowedFilters([
                AllowedFilter::exact('cnic'),
                AllowedFilter::exact('mobile_number'),
                AllowedFilter::exact('phase_id'),
                AllowedFilter::exact('xen_verified'),
                AllowedFilter::exact('sdo_verified'),
                AllowedFilter::exact('sdo_xen_status'),
                AllowedFilter::exact('dei_verified'),
                AllowedFilter::exact('aei_verified'),
                AllowedFilter::exact('ei_verified'),
                AllowedFilter::exact('status'),
                'consumer_name', 'father_husband_name'])
            ->when(request('status') === 'In-Process', function ($query) {
                $query->where('status', 'In-Process');
            })
            ->orderBy('created_at', 'desc');

        if ($user->hasRole('Wiring Contractor')) {
            $test_reports = $testReportsQuery->where('user_id', $user->id)->get();
        } elseif ($user->hasRole(['SDO', 'X-En'])) {
            $sub_division_id = $user->division_sub_division_id;
            if (!empty($sub_division_id)) {
                $sub_division_access = DivisionSubDivision::where('id', $sub_division_id)->pluck('id')->toArray();
                $test_reports = $testReportsQuery->whereIn('division_sub_division_id', $sub_division_access)->get();
            }
        } elseif ($user->hasRole(['DEI', 'AEI'])) {
            $sub_division_id = $user->division_sub_division_id;
            if (!empty($sub_division_id)) {
                $circle_access = DivisionSubDivision::where('circle', DivisionSubDivision::find($sub_division_id)->circle)->pluck('id')->toArray();
                $test_reports = $testReportsQuery->whereIn('division_sub_division_id', $circle_access)->get();
            }
        } elseif ($user->hasRole(['Electric Inspector'])) {
            $test_reports = $testReportsQuery->get();
        } else {
            $test_reports = $testReportsQuery->get();
        }

        $role_id = $user->roles->isEmpty() ? null : Role::findByName($user->roles[0]->name, 'web')->id;

        return view('test-reports.index', compact('test_reports', 'user', 'role_id'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $division_access = null;
        if ($user->hasRole('Wiring Contractor')) {
            $user_division_sub_division = DivisionSubDivision::find($user->division_sub_division_id);
            $division_access = DivisionSubDivision::where('division_code', $user_division_sub_division->division_code)->pluck('id')->toArray();
        }
        return view('test-reports.create', compact('user', 'division_access'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestReportRequest $request)
    {
        try {
            DB::beginTransaction(); // Start the database transaction

            $user = Auth::user();
            $request->merge(['user_id' => $user->id]);
            $request->merge(['date' => now()->format('Y-m-d')]);

            if ($request->phase_id == 1) {

                $test_report = TestReport::create([
                    'user_id' => $request->user_id,
                    'challan_id' => $request->challan_id,
                    'phase_id' => $request->phase_id,
                    'phase_type_id' => $request->phase_type_id,
                    'date' => $request->date,
                    'division_sub_division_id' => $request->division_sub_division_id,
                    'transformer_capacity' => $request->transformer_capacity,
                    'consumer_name' => $request->consumer_name,
                    'father_husband_name' => $request->father_husband_name,
                    'cnic' => $request->cnic,
                    'mobile_number' => $request->mobile_number,
                    'complete_address' => $request->complete_address,
                    'insulation' => $request->insulation,
                    'continuity' => $request->continuity,
                    'earthing' => $request->earthing,
                    'wc_test_report_fee' => $request->wc_test_report_fee,
                    'agreement' => 1,
                    'wc_verified' => 1,
                    'sdo_verified' => 1,
                    'xen_verified' => 1,
                    'sdo_xen_status' => 'Approved',
                    'status' => 'Approved',
                ]);

                // Get the dynamic input arrays from the request
                $types = $request->input('type', []);
                $watts = $request->input('watts', []);
                $nos = $request->input('nos', []);
                $totals = $request->input('total', []);
                $cableSizes = $request->input('cable_sizes', []);

                // Make sure all dynamic input arrays have the same count
                if (count($types) !== count($watts) || count($types) !== count($nos) || count($types) !== count($totals) || count($types) !== count($cableSizes)) {
                    // Handle the error, throw an exception, or redirect back with an error message.
                    return redirect()->back()->with('error', 'The dynamic input arrays must have the same count.');
                }

                // Combine the dynamic inputs into a single array
                $loadDetails = [];

                // Use count($types) as the loop limit to ensure consistency in array lengths
                $count = count($types);

                for ($i = 0; $i < $count; $i++) {
                    // Add a check to ensure that index exists before accessing it
                    if (isset($types[$i]) && isset($watts[$i]) && isset($nos[$i]) && isset($totals[$i]) && isset($cableSizes[$i])) {
                        $loadDetails[] = [
                            'user_id' => $user->id,
                            'test_report_id' => $test_report->id,
                            'type' => $types[$i],
                            'watts' => $watts[$i],
                            'nos' => $nos[$i],
                            'total' => $totals[$i],
                            'cable_sizes' => $cableSizes[$i],
                        ];
                    } else {
                        // Handle the error, throw an exception, or redirect back with an error message.
                        return redirect()->back()->with('error', 'Some dynamic input arrays are missing elements.');
                    }
                }

                // Assuming LoadDetails model has 'type', 'watts', 'nos', 'total', and 'cable_sizes' as fillable fields
                foreach ($loadDetails as $loadDetailData) {
                    LoadDetail::create($loadDetailData);
                }

                $test_report_submit = TestReportSubmit::create([
                    'user_id' => $user->id,
                    'test_report_id' => $test_report->id,
                    'division_sub_division_id' => $request->division_sub_division_id,
                    'phase_id' => $request->phase_id,
                    'submit_by_role' => 1,
                    'submit_to_role' => 4,
                ]);

            } elseif ($request->phase_id == 2) {
                // Code for phase_id == 2

                $test_report = TestReport::create([
                    'user_id' => $request->user_id,
                    'challan_id' => $request->challan_id,
                    'phase_id' => $request->phase_id,
                    'phase_type_id' => $request->phase_type_id,
                    'date' => $request->date,
                    'division_sub_division_id' => $request->division_sub_division_id,
                    'transformer_capacity' => $request->transformer_capacity,
                    'consumer_name' => $request->consumer_name,
                    'father_husband_name' => $request->father_husband_name,
                    'cnic' => $request->cnic,
                    'mobile_number' => $request->mobile_number,
                    'complete_address' => $request->complete_address,
                    'insulation' => $request->insulation,
                    'continuity' => $request->continuity,
                    'earthing' => $request->earthing,
                    'wc_test_report_fee' => $request->wc_test_report_fee,
                    'agreement' => 1,
                    'wc_verified' => 1,
                    'status' => 'In-Process',
                ]);

                // Get the dynamic input arrays from the request
                $types = $request->input('type', []);
                $watts = $request->input('watts', []);
                $nos = $request->input('nos', []);
                $totals = $request->input('total', []);
                $cableSizes = $request->input('cable_sizes', []);

                // Make sure all dynamic input arrays have the same count
                if (count($types) !== count($watts) || count($types) !== count($nos) || count($types) !== count($totals) || count($types) !== count($cableSizes)) {
                    // Handle the error, throw an exception, or redirect back with an error message.
                    return redirect()->back()->with('error', 'The dynamic input arrays must have the same count.');
                }

                // Combine the dynamic inputs into a single array
                $loadDetails = [];

                // Use count($types) as the loop limit to ensure consistency in array lengths
                $count = count($types);

                for ($i = 0; $i < $count; $i++) {
                    // Add a check to ensure that index exists before accessing it
                    if (isset($types[$i]) && isset($watts[$i]) && isset($nos[$i]) && isset($totals[$i]) && isset($cableSizes[$i])) {
                        $loadDetails[] = [
                            'user_id' => $user->id,
                            'test_report_id' => $test_report->id,
                            'type' => $types[$i],
                            'watts' => $watts[$i],
                            'nos' => $nos[$i],
                            'total' => $totals[$i],
                            'cable_sizes' => $cableSizes[$i],
                        ];
                    } else {
                        // Handle the error, throw an exception, or redirect back with an error message.
                        return redirect()->back()->with('error', 'Some dynamic input arrays are missing elements.');
                    }
                }

                // Assuming LoadDetails model has 'type', 'watts', 'nos', 'total', and 'cable_sizes' as fillable fields
                foreach ($loadDetails as $loadDetailData) {
                    LoadDetail::create($loadDetailData);
                }


                $test_report_submit_sdo = TestReportSubmit::create([
                    'user_id' => $user->id,
                    'test_report_id' => $test_report->id,
                    'division_sub_division_id' => $request->division_sub_division_id,
                    'phase_id' => $request->phase_id,
                    'submit_by_role' => 1,
                    'submit_to_role' => 4,
                ]);

                $test_report_submit_xen = TestReportSubmit::create([
                    'user_id' => $user->id,
                    'test_report_id' => $test_report->id,
                    'division_sub_division_id' => $request->division_sub_division_id,
                    'phase_id' => $request->phase_id,
                    'submit_by_role' => 1,
                    'submit_to_role' => 5,
                ]);

                $test_report_submit_dei = TestReportSubmit::create([
                    'user_id' => $user->id,
                    'test_report_id' => $test_report->id,
                    'division_sub_division_id' => $request->division_sub_division_id,
                    'phase_id' => $request->phase_id,
                    'submit_by_role' => 1,
                    'submit_to_role' => 2,
                ]);

                $test_report_submit_aei = TestReportSubmit::create([
                    'user_id' => $user->id,
                    'test_report_id' => $test_report->id,
                    'division_sub_division_id' => $request->division_sub_division_id,
                    'phase_id' => $request->phase_id,
                    'submit_by_role' => 1,
                    'submit_to_role' => 3,
                ]);

            }

            DB::commit(); // Commit the transaction if everything is successful

            // Redirect or return a response
            return redirect()->route('testReport.index')->with('success', 'Test report submitted successfully.');

        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            // Handle the exception or redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while creating the test report: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TestReport $testReport)
    {
        $user = Auth::user();

        return view('test-reports.show', compact('testReport', 'user'));

    }

    public function review_create(Request $request, TestReport $testReport)
    {
        $user = Auth::user();

        return view('reviews.create', compact('user', 'testReport'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestReport $testReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestReportRequest $request, TestReport $testReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestReport $testReport)
    {
        //
    }
}
