<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'customer_firstname' => ['required', 'string', 'max:255'],
            'customer_middlename' => ['nullable', 'string', 'max:255'],
            'customer_lastname' => ['required', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:20'],
            'collateral_type_id' => ['nullable', 'exists:collateral_type,id'],
        ];
    }
}
