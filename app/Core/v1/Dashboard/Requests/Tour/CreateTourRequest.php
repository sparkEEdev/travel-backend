<?php

namespace App\Core\v1\Dashboard\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

class CreateTourRequest extends FormRequest
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
            'travelId' => ['required', 'string', 'exists:travels,id'],
            'name' => ['required', 'string'],
            'startDate' => ['required', 'date'],
            'endDate' => ['required', 'date', 'after_or_equal:startDate'],
            'numberOfPeople' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ];
    }
}
