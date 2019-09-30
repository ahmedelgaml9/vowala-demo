<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SectionRequest extends Request {

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
                        'photo' => 'image',
                        'custom_url' => 'required|unique:sections',
                        'ar_custom_url' => 'required|unique:sections',
                    );
                }
            case 'PUT': {
                    return array(
                    );
                }

            case 'PATCH': {
                    return array(
                        'name' => 'required|min:3',
                        'photo' => 'image',
                        'custom_url' => 'required|unique:sections,custom_url,' . $this->route('sections'),
                        'ar_custom_url' => 'required|unique:sections,ar_custom_url,' . $this->route('sections'),
                    );
                }
        }
    }

}
