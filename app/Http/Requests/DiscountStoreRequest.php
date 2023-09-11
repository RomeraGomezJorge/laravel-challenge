<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DiscountStoreRequest extends DiscountBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge($this->commonRules(), [
            'name' => [
                'required',
                'alpha_num',
                'max:30',
                Rule::unique('discounts', 'name')->whereNull('deleted_at'),
            ],
        ]);
    }
}
