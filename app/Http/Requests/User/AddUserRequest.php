<?php

namespace App\Http\Requests\User;

use App\Enums\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class AddUserRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'lowercase', 'max:50', 'unique:users,username'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required',  Rule::enum(RoleEnum::class)],
        ];
    }

    public function messages()
    {
        return [
            'role.enum' => 'The selected role is invalid.',
        ];
    }
}
