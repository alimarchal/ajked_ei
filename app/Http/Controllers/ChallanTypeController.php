<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChallanTypeRequest;
use App\Http\Requests\UpdateChallanTypeRequest;
use App\Models\Challan;
use App\Models\ChallanType;

class ChallanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $challan_types = ChallanType::with('user')->get();
        return view('challan-types.index', compact('challan_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('challan-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChallanTypeRequest $request)
    {
        // get user object
        $user = \Auth::user();

        $request->merge(['user_id' => $user->id]);
        $challan_type = ChallanType::create($request->all());

        session()->flash('status', 'Challan type created successfully.');

        return to_route('challanType.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ChallanType $challanType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChallanType $challanType)
    {
        return view('challan-types.edit', compact('challanType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChallanTypeRequest $request, ChallanType $challanType)
    {

        $challanType->update([
            'name' => $request->input('name'),
            'amount' => $request->input('amount'),
            'type' => $request->input('type'),
            'user_id' => auth()->user()->id,
            // Add other fields as needed
        ]);

        session()->flash('status', 'Challan type updated successfully.');

        return to_route('challanType.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChallanType $challanType)
    {
        //
    }
}
