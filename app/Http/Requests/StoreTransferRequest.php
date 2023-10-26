<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransferRequest extends FormRequest
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
            'transfer_date' => 'required',
            'from_id' => 'required|integer|exists:accounts,id',
            'to_id' => 'required|integer|exists:accounts,id',
            'description' => 'required|string',
            'amount' => 'required|numeric',
        ];
    }
}
