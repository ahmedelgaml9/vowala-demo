<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return array();
                }
            case 'POST': {
                    return array(
                        'name' => 'required|min:3',
                        //'model' => 'required|min:3',
                        'ar_name' => 'required|min:3',
                        'sku' => 'unique:products',
                        'photo' => 'required|image|max:4000',
                        'price' => 'required|numeric',
                        'custom_url' => 'required|unique:products',
                        'ar_custom_url' => 'required|unique:products',
                        'offer' => 'min:0|max:100'
                    );
                }
            case 'PUT': {
                    return array(
                        'price' => 'required|numeric',
                        'custom_url' => 'unique:products',
                        'ar_custom_url' => 'unique:products',
                        'offer' => 'min:0|max:100'
                    );
                }
            case 'PATCH': {
                    return array(
                        'custom_url' => 'unique:products,custom_url,' . $this->route('products'),
                        'ar_custom_url' => 'unique:products,ar_custom_url,' . $this->route('products'),
                        'photo' => 'image|max:200',
                        'price' => 'required|numeric',
                        'offer' => 'min:0|max:100'
                    );
                }
        }
    }

}
