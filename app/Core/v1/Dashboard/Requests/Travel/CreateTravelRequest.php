<?php

namespace App\Core\v1\Dashboard\Requests\Travel;

use App\Enums\Moods;
use Illuminate\Foundation\Http\FormRequest;

class CreateTravelRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'numberOfDays' => ['required', 'integer', 'min:1', 'max:30'],
            'shouldPublish' => ['required', 'boolean'],
            'moods' => ['required', 'array'],
            ...$this->generateMoodsRules(),
        ];
    }

    /**
     * Generate validation rules for moods.
     *
     * @return array<string, array>
     */
    private function generateMoodsRules(): array
    {
        $moods = Moods::valuesToArray();

        $rules = [];

        foreach ($moods as $mood) {
            $rules["moods.{$mood}"] = [
                'required',
                'integer',
                'between:10,100'
            ];
        }

        return $rules;
    }
}
