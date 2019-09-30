<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CurrencyRequest extends Request {

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
                        'key' => 'required|min:0|max:3|unique:currencies',
                        'name' => 'required',
                        'ar_name' => 'required',
                        'value' => 'required|numeric',
                        'button_url' => 'url'
                    );
                }
            case 'PUT': {
                    return array(
                    );
                }

            case 'PATCH': {
                    return array(
                        'key' => 'required|min:0|max:3|unique:currencies,key,' . $this->route('currencies'),
                        'name' => 'required',
                        'ar_name' => 'required',
                        'value' => 'required|numeric',
                        'button_url' => 'url'
                    );
                }
        }
    }

}
