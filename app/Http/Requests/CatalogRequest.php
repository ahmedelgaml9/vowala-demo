<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CatalogRequest  extends Request {

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
                    'ar_name' => 'required|min:3',
                    'model' => 'required|min:3',
                    'sku' => 'required|min:3|unique:catalog',
                );
            }

            case 'PUT': {
                return array(
                );
            }
            
            case 'PATCH': {
                return array(
                    'name' => 'required|min:3',
                    'ar_name' => 'required|min:3',
                    'model' => 'min:3',
                    'sku' => 'required|min:3',
                );
            }
        }
    }

}
