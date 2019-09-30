<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SliderRequest extends Request {

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
            
                        'photo' => 'required|mimes:jpeg,bmp,png',
                        'link' => 'url',
                        'status' => 'required',
                    );
                }
            case 'PUT': {
                    
                }
            case 'PATCH': {
                    return array(
            
                        'photo' => 'mimes:jpeg,bmp,png',
                        'link' => 'url',
                        'status' => 'required',
                    );
                }
        }
    }

}
