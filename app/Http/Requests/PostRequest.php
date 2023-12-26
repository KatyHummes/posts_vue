<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'image' => ['required', 'max:255'],
            'user_id' => ['required', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatorio!',
            'max' => 'Este campo deve ter no maximo 255 caracteres!',
        ];
       
    }

    public function openModal()
{
    return inertia('Modal/Index');
}

}
