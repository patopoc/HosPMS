<?php

namespace Hotpms\Http\Requests;

use Hotpms\Http\Requests\Request;

class CreatePersonRequest extends Request
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
        		'ci' => 'required | unique:people,ci',
        		'email'=> 'required | unique:people,email',
        ];
    }
}
