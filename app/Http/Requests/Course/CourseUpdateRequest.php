<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
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
        $course_code = $this->route('course')->id;
        return [
            "code" => "required|unique:courses,code," . $course_code,
            "name" => "required|string|max:40",
            "teacher_id" => "required|exists:teachers,id",
        ];
    }
}
