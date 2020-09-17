<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
        switch($this->method()) {
            case 'POST':
                return [       
                    'name' => 'required|string|max:25|unique:courses',
                ];
            case 'PUT':
            case 'PATCH':
                return [       
                    'name' => 'required|string|max:25|unique:courses,'.$this->id,
                ];
            default:break;
        }
    }
    public function messages()
    {
        return [
            'required' => 'This Field Was Required',
            'in' => 'Wrong Date (in)',
            'string' => 'Wrong Date (string)',
            'image' => 'Upload Image File',
            'max'=> 'Maximum Size'
        ];
    }
}
