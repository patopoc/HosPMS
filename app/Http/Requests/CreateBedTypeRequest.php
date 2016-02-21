<?php

namespace Hotpms\Http\Requests;

use Hotpms\Http\Requests\Request;

class CreateBedTypeRequest extends Request
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
        		'type' => 'required | unique:rates,name',       		
        ];
    }
}
