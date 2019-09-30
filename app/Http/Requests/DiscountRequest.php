<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DiscountRequest extends Request
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return array();
                }
            case 'POST': {
                    return array(
                        'product_id' => 'required|numeric|exists:products,id|unique:discounts',
                        'discount_percentage' => 'required|numeric',
                    );
                }
            case 'PUT': {
                    return array(
                    );
                }

            case 'PATCH': {
                    return array(
                        'product_id' => 'required|numeric|exists:products,id',
                        'discount_percentage' => 'required|numeric',
                    );
                }
        }
    }

}
