<?php

namespace Hotpms\Http\Requests;

use Hotpms\Http\Requests\Request;

class CreateRoomTypeRequest extends Request
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
        		'name' => 'required | unique:room_types,name',        		    
        		//'pictures' => 'required | mimes:jpeg,jpg,bmp,png'
        ];
    }
}
