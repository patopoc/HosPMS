<?php

namespace Hospms\Http\Requests;

use Hospms\Http\Requests\Request;

class CreateServicePlanRequest extends Request
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
        		'name' => 'required | unique:service_plan,name',        		
        		
        ];
    }
}
