<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestReportRequest;
use App\Http\Requests\UpdateTestReportRequest;
use App\Models\LoadDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Import the DB facade
use App\Models\TestReport;

class TestReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $test_reports = TestReport::with('phase', 'divisionSubDivision')->get();

        return view('test-reports.index', compact('test_reports', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        return view('test-reports.create', compact('user'));
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
