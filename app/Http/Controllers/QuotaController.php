<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotaRequest;
use App\Http\Requests\UpdateQuotaRequest;
use App\Models\Challan;
use App\Models\Quota;
use Illuminate\Support\Facades\Auth;

class QuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get user object
        $user = Auth::user();

        $quotas = Quota::where('user_id', $user->id)->get();
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

        $quota = Quota::create([
            'user_id' => $user->id,
            'challan_id' => $request->challan_id,
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
    public function show(Quota $quota)
    {
        //
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
    public function update(UpdateQuotaRequest $request, Quota $quota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quota $quota)
    {
        //
    }
}
