<?php

namespace App\Core\v1\Dashboard\Requests\Travel;

use App\Enums\Moods;
use Illuminate\Foundation\Http\FormRequest;

class PublishTravelRequest extends FormRequest
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
            'shouldPublish' => ['required', 'boolean'],
        ];
    }
}
