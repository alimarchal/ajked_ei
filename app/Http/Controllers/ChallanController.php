<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChallanRequest;
use App\Http\Requests\UpdateChallanRequest;
use App\Models\Challan;
use App\Models\ChallanType;
use Illuminate\Support\Facades\Auth;
use TNkemdilim\MoneyToWords\Converter;
use TNkemdilim\MoneyToWords\Languages as Language;


class ChallanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $challans = Challan::with('user')->get();
        return view('challans.index', compact('challans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        return view('challans.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChallanRequest $request)
    {
        $user = Auth::user();

        $challan_type = ChallanType::find($request->challan_type_id);


        if ($user->hasRole(['DEI', 'AEI'])) {
            $challan = Challan::create([
                'user_id' => $user->id,
                'challan_type_id' => $challan_type->id,
                'amount' => $request->amount,
                'test_report_id' => $request->test_report_id,
            ]);

        } else {
            $challan = Challan::create([
                'user_id' => $user->id,
                'challan_type_id' => $challan_type->id,
                'amount' => $challan_type->amount,
            ]);

        }

        session()->flash('status', 'Challan has been generated successfully.');

        return to_route('challan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Challan $challan)
    {
        $converter = new Converter("rupees", "paisa");
        $amount_in_words = $converter->convert($challan->amount);



        return view('challans.print', compact('challan', 'amount_in_words'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Challan $challan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChallanRequest $request, Challan $challan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Challan $challan)
    {
        //
    }
}
