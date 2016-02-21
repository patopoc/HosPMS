<?php namespace Hotpms\Http\Requests;

use Hotpms\Http\Requests\Request;

class CreateUserRequest extends Request {

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
			'username'=> 'required|unique:users,username',
			'password' => 'required| confirmed',
			'property0' => 'required',
			'id_role' => 'required',
			
		];
	}

}
