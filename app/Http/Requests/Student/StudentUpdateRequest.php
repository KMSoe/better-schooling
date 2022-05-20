<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
        $student_id = $this->route('student')->id;
        return [
            "name" => "required|string|max:40",
            "email" => "required|email|unique:students,email," . $student_id,
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            "state" => "required|string",
            "township" => "required|string",
            "type" => "required|string",
            "nrc_number" => "required|string",
            "birth_date" => "required|date",
            "courses" => "nullable|string",
        ];
    }
}
