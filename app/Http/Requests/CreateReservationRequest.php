<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
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
            'parking_place_id' => ['required', 'integer', 'exists:parking_places,id'],
            'start_time' => ['required', 'date_format:Y-m-d H:i', 'after:now'],
            'end_time' => ['required', 'date_format:Y-m-d H:i', 'after:start_time']
        ];
    }
}
