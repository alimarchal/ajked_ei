<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'agreement' => 'accepted',
            'division_sub_division_id' => 'required',
            'transformer_capacity' => 'required',
            'consumer_name' => 'required',
            'father_husband_name' => 'required',
            'cnic' => 'required|size:15', // Assuming the CNIC should be exactly 15 characters long.
            'mobile_number' => 'required',
            'complete_address' => 'required',
            'insulation' => 'required',
            'continuity' => 'required',
            'earthing' => 'required',
            'wc_test_report_fee' => 'required|numeric|min:0',
            'phase_id' => 'required',
            'phase_type_id' => 'required',
            'type.*' => 'required',
            'watts.*' => 'required|numeric|min:0',
            'nos.*' => 'required|numeric|min:0',
            'total.*' => 'required',
            'cable_sizes.*' => 'required',
        ];
    }
}
