<?php

namespace Hotpms\Http\Requests;

use Hotpms\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditRateRequest extends Request
{
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
        		'name' => 'required | unique:rates,name,'. $this->route->getParameter('rate'),
        		'weekday_price'=>'required',        		
        		'weekend_price' => 'required',
        ];
    }
}
