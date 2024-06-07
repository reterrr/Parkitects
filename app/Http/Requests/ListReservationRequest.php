<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListReservationRequest extends FormRequest
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
            'filter.reservation_time.start_time' => ['sometimes', 'date_format:Y-m-d H:i'],
            'filter.reservation_time.end_time' => ['sometimes', 'date_format:Y-m-d H:i', 'after:start_time'],
            'filter.reservation_time.opposite' => ['bool'],
            'filter.status' => ['array']
        ];
    }
}
