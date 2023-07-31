<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Challan;
use App\Models\Review;
use App\Models\TestReport;
use App\Models\TestReportSubmit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $user = Auth::user();
        $test_report = TestReport::find($request->test_report_id);
        $remarks = $request->remarks;
        $details = $request->details;
        $role_id = Role::findByName($user->getRoleNames()[0], 'web')->id;

        $status = null;
        if ($request->remarks == "1") {
            $status = "Approved";
        } elseif ($request->remarks == "0") {
            $status = "Objection";
        }

        if ($user->hasRole(['SDO', 'X-En'])) {
            $test_report_submits = TestReportSubmit::where('test_report_id', $test_report->id)->whereIn('submit_to_role', [4, 5])->get();
            foreach ($test_report_submits as $trs) {
                $trs->remarks = 1;
                $trs->save();
            }

            $review_obj = Review::create([
                'user_id' => $user->id,
                'division_sub_division_id' => $test_report->division_sub_division_id,
                'test_report_id' => $test_report->id,
                'remarks' => $details,
                'status' => $status,
            ]);

            $test_report->sdo_verified = 1;
            $test_report->xen_verified = 1;
            $test_report->sdo_xen_status = $status;
            $test_report->save();

            return redirect()->route('testReport.index')->with('success', 'Your review has been submitted successfully no need further action.');
        }
        elseif ($user->hasRole(['AEI', 'DEI'])) {

            $test_report_submits = TestReportSubmit::where('test_report_id', $test_report->id)->whereIn('submit_to_role', [2, 3])->get();

            foreach ($test_report_submits as $trs) {
                $trs->remarks = 1;
                $trs->save();
            }

            // find challan and update it

            $challan = Challan::find($request->challan_id);
            $challan->amount = $request->amount;
            $challan->status = 'Paid';
            $challan->date = $request->date;
            $challan->test_report_id = $request->test_report_id;
            $challan->save();

            $review_obj = Review::create([
                'user_id' => $user->id,
                'division_sub_division_id' => $test_report->division_sub_division_id,
                'test_report_id' => $test_report->id,
                'remarks' => $details,
                'status' => $status,
            ]);

            $test_report_submit_to_ei = TestReportSubmit::create([
                'user_id' => $user->id,
                'test_report_id' => $test_report->id,
                'division_sub_division_id' => $test_report->division_sub_division_id,
                'phase_id' => $test_report->phase_id,
                'submit_by_role' => $role_id,
                'submit_to_role' => 6,
            ]);

            $test_report->challan_id = $request->challan_id;
            $test_report->dei_verified = 1;
            $test_report->aei_verified = 1;
            $test_report->dei_aei_status = $status;
            $test_report->save();




            return redirect()->route('testReport.index')->with('success', 'Your review has been submitted successfully no need further action.');

        }
        elseif ($user->hasRole(['Electric Inspector'])) {

            $test_report_submits = TestReportSubmit::where('test_report_id', $test_report->id)->whereIn('submit_to_role', [6])->get();

            foreach ($test_report_submits as $trs) {
                $trs->remarks = 1;
                $trs->save();
            }

            $review_obj = Review::create([
                'user_id' => $user->id,
                'division_sub_division_id' => $test_report->division_sub_division_id,
                'test_report_id' => $test_report->id,
                'remarks' => $details,
                'status' => $status,
            ]);


            $test_report->ei_verified = 1;
            $test_report->noc_issued = 1;
            $test_report->status = 1;
            $test_report->save();

            return redirect()->route('testReport.index')->with('success', 'Your review has been submitted successfully no need further action.');

        }
    }

    /**
     * Display the specified resource.
     */
    public
    function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(Review $review)
    {
        //
    }
}
