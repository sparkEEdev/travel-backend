<?php

namespace App\Core\v1\Public\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

class GetToursRequest extends FormRequest
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
            'travel' => ['nullable', 'string', 'exists:travels,slug'],
            'priceFrom' => ['nullable', 'integer'],
            'priceTo' => ['nullable', 'integer'],
            'startDate' => ['nullable', 'date'],
            'endDate' => ['nullable', 'date', 'after_or_equal:startDate'],
            'sort' => ['nullable', 'string', 'in:price'],
            'order' => ['nullable', 'string', 'in:asc,desc'],
        ];
    }
}
