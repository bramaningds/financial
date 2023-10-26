<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\MergeWithGlobalRequest;
use Illuminate\Foundation\Http\FormRequest;

class BrowseRequest extends FormRequest
{
    use MergeWithGlobalRequest;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }

    protected function passedValidation(): void
    {
        $this->mergeIfMissing([
            'keyword' => null,
            'group_by' => null,
            'order_by' => null,
            'per_page' => null
        ]);
    }

}
