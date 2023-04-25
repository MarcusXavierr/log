<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataFilterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'productName' => 'nullable|string',
            'regions' => 'array',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
            'minPrice' => 'string',
            'maxPrice' => 'string',
        ];
    }
}
