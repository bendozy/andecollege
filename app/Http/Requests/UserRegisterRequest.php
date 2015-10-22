<?php

namespace AndeCollege\Http\Requests;

use AndeCollege\Http\Requests\Request;

class UserRegisterRequest extends Request
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
	    $this->sanitizeInputs();

	    return [
	        'username' => 'required|max:255|unique:users,username|min:3',
	        'email' => 'required|email|max:255|unique:users',
	        'firstname' => 'required|min:2',
	        'lastname' => 'required|min:2',
	        'password' => 'required|confirmed|min:8'
        ];
    }

	/**
	 * Sanitize the Inputs.
	 *
	 */
	public function sanitizeInputs()
	{
		$input = $this->all();
		$input['username'] = trim(filter_var($this->input('username'), FILTER_SANITIZE_STRING));
		$input['firstrname'] = trim(filter_var($this->input('firstname'), FILTER_SANITIZE_STRING));
		$input['lastname'] = trim(filter_var($this->input('lastname'), FILTER_SANITIZE_STRING));
		$input['email'] = trim(filter_var($this->input('email'), FILTER_SANITIZE_EMAIL));

		$this->replace($input);
	}
}
