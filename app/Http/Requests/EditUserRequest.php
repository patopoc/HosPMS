<?php namespace Hotpms\Http\Requests;

use Hotpms\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditUserRequest extends Request {

	private $route;
	
	public function __construct(Route $route){
		$this->route= $route;
	}
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
			'username'=> 'required|unique:users,username,' . $this->route->getParameter('users'),
			'password' => '',
			'property0' => 'required',
			'id_role' => 'required',
			
		];
	}

}
