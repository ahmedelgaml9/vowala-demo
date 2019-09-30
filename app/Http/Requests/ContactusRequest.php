<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactusRequest extends Request {

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
                    //Contact Us Form
                    return array(
                        'name' => 'required|min:3',
                        'email' => 'required|email|min:3',
                        'message' => 'required|min:3',
                        'subject' => 'required|min:3',
                    );
                }
            case 'PUT': {
                    return array(
                        'first_name' => 'required|min:2',
                        'email' => 'required|email|min:3',
                        'phone' => 'required|min:3',
                        'address' => 'required|min:3',
                        'shipment_id' => 'required',
                        'promocode' => 'validcode|notexpire'
                    );
                }
            case 'PATCH': {
                    return array(
                        'f_name' => 'required|min:2',
                        'l_name' => 'required|min:2',
                        'email' => 'required|email|min:3',
                        'phone' => 'required|min:3',
                        'address' => 'required|min:3',
                        'gender' => 'required',
                        'country'=>'required'
                    );
                }
        }
    }

}
