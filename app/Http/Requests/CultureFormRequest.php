<?php

namespace App\Http\Requests;

use App\Models\Culture;
use Illuminate\Foundation\Http\FormRequest;

class CultureFormRequest extends FormRequest
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
            'name' => ['required', 'unique:' . Culture::class . ',name']
        ];
    }
}
