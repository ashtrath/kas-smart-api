<?php

namespace App\Http\Requests\PaymentMethod;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePaymentMethodRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes', 'required', 'string', 'max:50',
                Rule::unique('payment_methods')->ignore($this->payment_method->id)
            ],
            'description' => ['sometimes', 'nullable', 'string'],
            'icon' => ['sometimes', 'required', 'string'],
            'details' => ['sometimes', 'required', 'array'],
        ];
    }
}
