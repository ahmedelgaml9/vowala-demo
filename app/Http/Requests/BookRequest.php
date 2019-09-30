<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BookRequest extends Request {

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
                        'size' => 'required',
                        'qu' => 'numeric|min:0',
            
                    );
                }
            case 'PUT': {
                    return array(
                        'spec' => 'required',
                        'ar_spec' => 'required',
                        'value' => 'required',
                        'ar_value' => 'required',
                    );
                }

            case 'PATCH': {
                    return array(
            
                    );
                }
        }
    }

}
