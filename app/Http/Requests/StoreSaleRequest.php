<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'customer_id' => ['nullable', 'exists:customer,id'],
            'sales_date' => ['required', 'date'],
            'details' => ['required', 'array', 'min:1'],
            'details.*.product_id' => ['required', 'exists:product,id'],
            'details.*.quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}
