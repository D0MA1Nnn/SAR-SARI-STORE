<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCashLogRequest extends FormRequest
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
            'start_cash' => ['nullable', 'numeric', 'min:0'],
            'end_cash' => ['nullable', 'numeric', 'min:0'],
            'log_date' => ['nullable', 'date'],
        ];
    }
}
