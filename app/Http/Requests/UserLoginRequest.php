<?php

namespace AndeCollege\Http\Requests;

use AndeCollege\Http\Requests\Request;

class UserLoginRequest extends Request
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
	        'username' => 'required|max:255|unique:users,username|min:3',
	        'email' => 'required|email|max:255|unique:users',
	        'firstname' => 'required|min:2',
	        'lastname' => 'required|min:2',
	        'password' => 'required|confirmed|min:8'
        ];
    }
}
