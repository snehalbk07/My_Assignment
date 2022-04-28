<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class prod_update_request extends FormRequest
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
            'product_sku'   => 'required|unique:products,product_sku,'.$this->id,
            'product_name'  => 'required|unique:products,product_name,'.$this->id,
            'category'      => 'required|exists:categories,id',
            'status'        => 'required|in:0,1',
        ];
    }
}
