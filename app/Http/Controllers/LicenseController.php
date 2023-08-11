<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLicenseRequest;
use App\Http\Requests\UpdateLicenseRequest;
use App\Models\Challan;
use App\Models\DivisionSubDivision;
use App\Models\License;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get user object
        $user = Auth::user();

        $query = QueryBuilder::for(License::with('challan', 'user', 'recommendedBy', 'renewedBy', 'divisionSubDivision'))
            ->allowedFilters([
                AllowedFilter::exact('user_id'),
                AllowedFilter::exact('challan_id'),
                AllowedFilter::exact('division_sub_division_id'),
                AllowedFilter::exact('old_license_number'),
                AllowedFilter::exact('new_license_number'),
                AllowedFilter::exact('recommended_by'),
                AllowedFilter::exact('renewed_by'),
                AllowedFilter::exact('status'),
            ])->orderBy('created_at', 'desc');

        if ($user->hasRole('Wiring Contractor')) {
            $licenses = $query->where('user_id', $user->id)->get();
        } elseif ($user->hasRole(['SDO', 'X-En'])) {
            $sub_division_id = $user->division_sub_division_id;
            if (!empty($sub_division_id)) {
                $sub_division_access = DivisionSubDivision::where('id', $sub_division_id)->pluck('id')->toArray();
                $licenses = $query->whereIn('division_sub_division_id', $sub_division_access)->get();
            }
        } elseif ($user->hasRole(['DEI', 'AEI'])) {
            $sub_division_id = $user->division_sub_division_id;
            if (!empty($sub_division_id)) {
                $circle_access = DivisionSubDivision::where('circle', DivisionSubDivision::find($sub_division_id)->circle)->pluck('id')->toArray();
                $licenses = $query->whereIn('division_sub_division_id', $circle_access)->get();
            }
        } elseif ($user->hasRole(['Electric Inspector'])) {
            $licenses = $query->get();
        } else {
            $licenses = $query->get();
        }

        return view('licenses.index', compact('licenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = \Auth::user();
        return view('licenses.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLicenseRequest $request)
    {
        $user = \Auth::user();

        // Check if the user has already used this challan_id
        $existingQuota = License::where('user_id', $user->id)
            ->where('challan_id', $request->challan_id)
            ->first();

        if ($existingQuota) {
            // Challan_id already used by the user, show an error or handle as needed
            return back()->withErrors(['challan_id' => 'You have already used this challan.']);
        }

        // Example code to move the uploaded file to a storage location
        if ($request->hasFile('challan_receipt_paths')) {
            $file = $request->file('challan_receipt_paths');
            $path = $file->store('renewal_license_receipts', 'public'); // Adjust the storage path as needed
        }


        $request->merge(['challan_receipt_path' => $path]);

        $license = License::create([
            'user_id' => $user->id,
            'division_sub_division_id' => $user->division_sub_division_id,
            'challan_id' => $request->challan_id,
            'old_license_number' => $user->license_number,
            'status' => 'In-Process',
        ]);

        $challan = Challan::find($request->challan_id);
        $challan->challan_receipt_path = $request->challan_receipt_path;
        $challan->date = now();
        $challan->status = "Paid";
        $challan->save();

        session()->flash('status', 'Challan has been uploaded successfully. Please Wait or Contact Inspectorate of Electricity');
        return to_route('license.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $license = License::with('challan', 'user', 'recommendedBy', 'renewedBy', 'divisionSubDivision')->find(decrypt($id));
        $user = Auth::user();
        return view('licenses.show', compact('license', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(License $license)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLicenseRequest $request, $id)
    {

        $license = License::with('challan', 'user', 'recommendedBy', 'renewedBy', 'divisionSubDivision')->find(decrypt($id));
        $user = Auth::user();
        if ($user->hasRole(['DEI', 'AEI'])) {
            $license->recommended_by = Auth::user()->id;
            $license->recommended_by_remarks = $request->recommended_by_remarks;
            $license->save();
            session()->flash('status', 'Your recommendation has been successfully updated against the Quota request.');
            return to_route('license.show', encrypt($license->id));
        } elseif ($user->hasRole(['Electric Inspector'])) {

            if ($request->status == "Approved") {
                $license->renewed_by = Auth::user()->id;
                $license->renewed_by_remarks = $request->renewed_by_remarks;
                $license->new_license_number = "LN-" . $license->id;
                $license->renewal_date = now();
                $license->license_expiry = $request->license_expiry;
                $license->status = $request->status;
                $license->save();

                $user_license_update = User::find($license->user_id);
                $user_license_update->license_number = "LN-" . $license->id;
                $user_license_update->license_number_expiry = $request->license_expiry;
                $user_license_update->save();
            } else {
                $license->status = $request->status;
                $license->save();
            }
            session()->flash('status', 'Your recommendation has been successfully updated against the license request.');
            return to_route('license.show', encrypt($license->id));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(License $license)
    {
        //
    }
}
