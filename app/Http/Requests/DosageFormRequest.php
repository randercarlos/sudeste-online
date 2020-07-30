<?php

namespace App\Http\Requests;

use App\Models\Culture;
use App\Models\Dosage;
use App\Models\Prague;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class DosageFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dosage' => ['required', 'unique:dosages,dosage'],
            'product_id' => ['required', 'exists:products,id'],
            'culture_id' => ['required', 'exists:cultures,id'],
            'prague_id' => ['required', 'exists:pragues,id'],
        ];
    }
}
