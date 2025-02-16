<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|unique:sliders|max:255',
            'description' => 'required',
            'image_path' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Tên không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'image_path.required' => 'Ảnh không được để trống'
        ];
    }
}
