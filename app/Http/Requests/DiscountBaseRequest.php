<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountBaseRequest extends FormRequest
{
    protected function commonRules()
    {
        $rules = [
            'active'           => [
                'required',
                'in:0,1',
            ],
            'brand_id'         => [
                'required',
                'integer',
                Rule::exists('brands', 'id')->where('active', 1),
            ],
            'access_type_code' => [
                'required',
                'string',
                Rule::exists('access_types', 'code'),
            ],
            'priority'         => [
                'required',
                'integer',
                'min:1',
                'max:1000',
            ],
            'region_id'        => [
                'required',
                'integer',
                Rule::exists('regions', 'id'),
            ],
            'start_date'       => 'required|date',
            'end_date'         => 'required|date|after:start_date',
        ];

        $rules = $this->addDiscountRangeRules($rules, 0);

        if ($this->hasDiscountRange(1)) {
            $rules = $this->addDiscountRangeRules($rules, 1);
        }
        if ($this->hasDiscountRange(2)) {
            $rules = $this->addDiscountRangeRules($rules, 2);
        }

        return $rules;

    }

    private function addDiscountRangeRules($rules, $index)
    {
        $prefix = "discount_ranges.$index";

        $discount_ranges_rules = [
            "$prefix.from_days" => [
                'required',
                'integer',
                'min:1',
            ],
            "$prefix.to_days"   => [
                'required',
                'integer',
                "gt:$prefix.from_days",
            ],
            "$prefix.code"      => [
                'sometimes',
                'nullable',
                "required_if:$prefix.discount,null",
                'alpha_num',
            ],
            "$prefix.discount"  => [
                'sometimes',
                'nullable',
                "required_if:$prefix.code,null",
                'numeric',
                'min:0.1',
            ],
        ];

        return array_merge($rules, $discount_ranges_rules);
    }

    private function hasDiscountRange($index)
    {
        if (!isset($this->discount_ranges[$index])) {
            return false;
        }

        $range = $this->discount_ranges[$index];
        return !(
            is_null($range['from_days']) &&
            is_null($range['to_days']) &&
            is_null($range['discount']) &&
            is_null($range['code'])
        );
    }
}
