<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActivityRequest extends FormRequest
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
            'activity_date' => 'required',
            'activity_type' => 'required|in:income,expense',
            'account_id' => 'required|numeric|exists:accounts,id,deleted_at,NULL',
            'category_id' => 'required|numeric|exists:categories,id,deleted_at,NULL',
            'description' => 'required|string',
            'debit' => 'numeric',
            'credit' => 'numeric',
        ];
    }
}
