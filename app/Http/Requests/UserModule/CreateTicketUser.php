<?php

namespace App\Http\Requests\UserModule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTicketUser extends FormRequest
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
	    $rules = [];

	    if ( $this->isMethod('post') ) {
		    $rules['username'] = [
			    'required',
			    Rule::unique('users', 'name'),
		    ];
	    }

	    return $rules;
    }
}
