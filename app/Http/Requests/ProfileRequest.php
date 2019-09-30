<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfileRequest extends Request {

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
                        'oldpassword' => 'required|passpassword',
                        'password' => 'required|confirmed|min:4',
                     );
                }
            case 'PUT': {
                    return array(
                        'name' => 'required|min:3',
                        'phone' => 'numeric|digits_between:5,15|min:0',
                    );
                }
            case 'PATCH': {
                    
                }
        }
    }

}
