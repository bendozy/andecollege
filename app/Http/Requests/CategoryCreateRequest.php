<?php

namespace AndeCollege\Http\Requests;

use Illuminate\Support\Facades\Auth;
use AndeCollege\Http\Requests\Request;

class CategoryCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->sanitizeInput();

	    return [
		    'name' => 'required|max:255|unique:categories,name|min:2',
        ];
    }

	/**
	 * Sanitize the Input.
	 *
	 */
	public function sanitizeInput()
	{
		$input = $this->all();
		$input['name'] = trim(filter_var($this->input('name'), FILTER_SANITIZE_STRING));
		$this->replace($input);
	}
}
