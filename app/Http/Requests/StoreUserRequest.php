<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
           'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'phoneNumber' => 'required|string|max:15|unique:users',
        'type' => 'required|string|in:assistant,admin',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        ];
    }
}
