<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotaRequest;
use App\Http\Requests\UpdateQuotaRequest;
use App\Models\Challan;
use App\Models\DivisionSubDivision;
use App\Models\Quota;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class QuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get user object
        $user = Auth::user();

        $query = QueryBuilder::for(Quota::with('user', 'challan', 'phase_type'))
            ->allowedFilters([
                AllowedFilter::exact('user_id'),
                AllowedFilter::exact('challan_id'),
                AllowedFilter::exact('phase_type_id'),
                AllowedFilter::exact('type'),
                AllowedFilter::exact('quantity'),
                AllowedFilter::exact('outstanding_balance'),
                AllowedFilter::exact('approved_by'),
                AllowedFilter::exact('status'),
            ])->orderBy('created_at', 'desc');

        if ($user->hasRole('Wiring Contractor')) {
            $quotas = $query->where('user_id', $user->id)->get();
        } elseif ($user->hasRole(['SDO', 'X-En'])) {
            $sub_division_id = $user->division_sub_division_id;
            if (!empty($sub_division_id)) {
                $sub_division_access = DivisionSubDivision::where('id', $sub_division_id)->pluck('id')->toArray();
                $quotas = $query->whereIn('division_sub_division_id', $sub_division_access)->get();
            }
        } elseif ($user->hasRole(['DEI', 'AEI'])) {
            $sub_division_id = $user->division_sub_division_id;
            if (!empty($sub_division_id)) {
                $circle_access = DivisionSubDivision::where('circle', DivisionSubDivision::find($sub_division_id)->circle)->pluck('id')->toArray();
                $quotas = $query->whereIn('division_sub_division_id', $circle_access)->get();
            }
        } elseif ($user->hasRole(['Electric Inspector'])) {
            $quotas = $query->get();
        } else {
            $quotas = $query->get();
        }

        return view('quotas.index', compact('quotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        return view('quotas.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuotaRequest $request)
    {
        $user = Auth::user();

        // Check if the user has already used this challan_id
        $existingQuota = Quota::where('user_id', $user->id)
            ->where('challan_id', $request->challan_id)
            ->first();

        if ($existingQuota) {
            // Challan_id already used by the user, show an error or handle as needed
            return back()->withErrors(['challan_id' => 'You have already used this challan.']);
        }

        // Example code to move the uploaded file to a storage location
        if ($request->hasFile('challan_receipt_paths')) {
            $file = $request->file('challan_receipt_paths');
            $path = $file->store('challan_receipts', 'public'); // Adjust the storage path as needed
        }


        $request->merge(['challan_receipt_path' => $path]);

        $quantity = 0;
        if ($request->phase_type_id == 1) {
            $quantity = 100;
        } elseif ($request->phase_type_id == 2) {
            $quantity = 50;
        } elseif ($request->phase_type_id == 3) {
            $quantity = 50;
        }

        $request->merge(['quantity' => $quantity]);

        $quota = Quota::create([
            'user_id' => $user->id,
            'phase_type_id' => $request->phase_type_id,
            'challan_id' => $request->challan_id,
            'division_sub_division_id' => $user->division_sub_division_id,
            'type' => 'Credit',
            'quantity' => $request->quantity,
            'outstanding_balance' => $user->quota,
            'status' => 'In-Process',
        ]);

        $challan = Challan::find($request->challan_id);
        $challan->challan_receipt_path = $request->challan_receipt_path;
        $challan->status = "Paid";
        $challan->save();

        session()->flash('status', 'Challan has been uploaded successfully. Please wait or contact Inspectorate of Electricity');
        return to_route('quota.index');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $quota = Quota::with('challan', 'user', 'phase_type', 'testReport', 'recommendedBy', 'approvedBy', 'divisionSubDivision')->find(decrypt($id));
        $user = Auth::user();
        return view('quotas.show', compact('quota', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quota $quota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuotaRequest $request, $id)
    {

        $quota = Quota::with('challan', 'user', 'phase_type', 'testReport', 'recommendedBy', 'approvedBy', 'divisionSubDivision')->find(decrypt($id));
        $user = Auth::user();
        if ($user->hasRole(['DEI', 'AEI'])) {
            $quota->recommended_by = Auth::user()->id;
            $quota->recommended_by_remarks = $request->recommended_by_remarks;
            $quota->save();
            session()->flash('status', 'Your recommendation has been successfully updated against the Quota request.');
            return to_route('quota.show', encrypt($quota->id));
        } elseif ($user->hasRole(['Electric Inspector'])) {

            if ($request->status == "Approved") {
                $quota->approved_by = Auth::user()->id;
                $quota->approved_by_remarks = $request->approved_by_remarks;
                $quota->outstanding_balance = ($quota->user->quota + $quota->quantity);
                $quota->status = $request->status;
                $quota->save();

                $get_quota_request_user = User::find($quota->user_id);
                if ($quota->phase_type_id == 1) {
                    $get_quota_request_user->domestic = ($get_quota_request_user->domestic + $quota->quantity);
                    $get_quota_request_user->quota += $quota->quantity;
                    $get_quota_request_user->save();
                } elseif ($quota->phase_type_id == 2) {
                    $get_quota_request_user->commercial = ($get_quota_request_user->commercial + $quota->quantity);
                    $get_quota_request_user->quota += $quota->quantity;
                    $get_quota_request_user->save();
                } elseif ($quota->phase_type_id == 3) {
                    $get_quota_request_user->industrial = ($get_quota_request_user->industrial + $quota->quantity);
                    $get_quota_request_user->quota += $quota->quantity;
                    $get_quota_request_user->save();
                }
            } else {
                $quota->approved_by = Auth::user()->id;
                $quota->approved_by_remarks = $request->approved_by_remarks;
                $quota->status = $request->status;
                $quota->save();
            }

            session()->flash('status', 'Your recommendation has been successfully updated against the Quota request.');
            return to_route('quota.show', encrypt($quota->id));
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quota $quota)
    {
        //
    }
}
