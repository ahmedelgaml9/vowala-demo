<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddRequest extends Request {

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
                        'title' => 'min:3|max:70',
                        'subtitle' => 'min:3|max:70',
                        'photo' => 'image',
                        'desc' => 'min:3|max:150',
                        'button_url' => 'url'
                    );
                }
            case 'PUT': {
                    return array(
                    );
                }

            case 'PATCH': {
                    return array(
                        'title' => 'required|min:3|max:70',
                        'subtitle' => 'required|min:3|max:70',
                        'photo' => 'image',
                        'desc' => 'min:3|max:150',
                        'button_url' => 'url'
                    );
                }
        }
    }

}
