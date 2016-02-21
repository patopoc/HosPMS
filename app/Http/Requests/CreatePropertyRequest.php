<?php

namespace Hotpms\Http\Requests;

use Hotpms\Http\Requests\Request;

class CreatePropertyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        		'name' => 'required | unique:property_settings,name',
        		'info'=> '',
        		'address'=>'required',
        		'checkin_time' => '',
        		'checkout_time' => 'required',
        		'cancelation_policy' => 'required',
        		'timezone'=>'', 
        		'conditions' => '', 
        		'pet_rules' => ''
        ];
    }
}
