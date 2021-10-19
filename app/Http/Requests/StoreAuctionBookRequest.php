<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuctionBookRequest extends FormRequest
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
            'title' => 'required|min:3|max:30',
            'description' => 'required|min:3|max:600',
            'publish_date' => 'nullable|date',
            'book_condition_id' => 'exists:book_conditions,id',
            'category_id' => 'exists:categories,id',
            'price' => 'numeric|between:1.00,9999.00',
            'user_id' => 'required',
            'images' => 'max:5',
            'images.*' => 'required|image|max:2000'
        ];
    }
}
