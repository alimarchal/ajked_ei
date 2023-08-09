<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWiringContractorRequest;
use App\Http\Requests\UpdateWiringContractorRequest;
use App\Models\DivisionSubDivision;
use App\Models\User;
use App\Models\WiringContractor;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class WiringContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole(['SDO', 'X-En'])) {
            $sub_division_id = $user->division_sub_division_id;
            if (!empty($sub_division_id)) {
                $sub_division_access = DivisionSubDivision::where('id', $sub_division_id)->pluck('id')->toArray();

                $users = User::whereIn('division_sub_division_id', $sub_division_access)
                    ->role('Wiring Contractor')
                    ->get();

                return view('wiring-contractors.index', compact('users'));
            }
        } elseif ($user->hasRole(['DEI', 'AEI'])) {
            $sub_division_id = $user->division_sub_division_id;
            if (!empty($sub_division_id)) {
                $circle_access = DivisionSubDivision::where('circle', DivisionSubDivision::find($sub_division_id)->circle)->pluck('id')->toArray();

            }
        } elseif ($user->hasRole(['Electric Inspector'])) {

        } else {

        }
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
    public function store(StoreWiringContractorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WiringContractor $wiringContractor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WiringContractor $wiringContractor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWiringContractorRequest $request, WiringContractor $wiringContractor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WiringContractor $wiringContractor)
    {
        //
    }
}
