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
            'dosage' => ['required', 'unique:' . Dosage::class . ',dosage'],
            'product_id' => ['required', 'exists:' . Product::class . ',id'],
            'culture_id' => ['required', 'exists:' . Culture::class . ',id'],
            'prague_id' => ['required', 'exists:' . Prague::class . ',id'],
        ];
    }
}
