<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BlogRequest extends Request {

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
                        'title' => 'required|min:3',
                        'blog' => 'required',
                        'photo' => 'image',
                        'custom_url' => 'required|unique:blog',
                        'ar_custom_url' => 'required|unique:blog',
                    );
                }
            case 'PUT': {
                    return array(
                    );
                }

            case 'PATCH': {
                    return array(
                        'title' => 'required|min:3',
                        'blog' => 'required',
                        'photo' => 'image',
                        'custom_url' => 'required|unique:blog,custom_url,' . $this->route('blogs'),
                        'ar_custom_url' => 'required|unique:blog,ar_custom_url,' . $this->route('blogs'),
                    );
                }
        }
    }

}
