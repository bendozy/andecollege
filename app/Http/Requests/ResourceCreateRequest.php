<?php

namespace AndeCollege\Http\Requests;

use Illuminate\Support\Facades\Auth;
use AndeCollege\Http\Requests\Request;

class ResourceCreateRequest extends Request
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
            'title' => 'required|max:255|unique:resources,title|min:3',
            'url' =>  'required|unique:resources,link',
            'category' => 'required',
            'description' => 'required'
        ];
    }

    /**
     * Sanitize the Input.
     *
     */
    public function sanitizeInput()
    {
        $input = $this->all();
        $input['title'] = trim(filter_var($this->input('title'), FILTER_SANITIZE_STRING));
        $input['description'] = trim(filter_var($this->input('description'), FILTER_SANITIZE_STRING));
        $this->replace($input);
    }
}
