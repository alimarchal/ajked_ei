<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLicenseRequest;
use App\Http\Requests\UpdateLicenseRequest;
use App\Models\Challan;
use App\Models\License;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get user object
        $user = \Auth::user();

        $license = License::where('user_id', $user->id)->get();
        return view('licenses.index', compact('license'));
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
            'challan_id' => $request->challan_id,
            'old_license_number' => $user->license_number,
            'status' => 'In-Process',
        ]);

        $challan = Challan::find($request->challan_id);
        $challan->challan_receipt_path = $request->challan_receipt_path;
        $challan->status = "Paid";
        $challan->save();

        session()->flash('status', 'Challan has been uploaded successfully. Please Wait or Contact Inspectorate of Electricity');
        return to_route('license.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(License $license)
    {
        //
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
    public function update(UpdateLicenseRequest $request, License $license)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(License $license)
    {
        //
    }
}
