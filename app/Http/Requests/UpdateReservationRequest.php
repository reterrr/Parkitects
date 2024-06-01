<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->id == $this->reservation->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'parking_place_id' => ['integer', 'exists:parking_places,id'],
            'start_time' => ['sometimes', 'date_format:Y-m-d H:i', 'after:now'],
            'end_time' => ['required_with:start_time', 'date_format:Y-m-d H:i', 'after:start_time']
        ];
    }
}
