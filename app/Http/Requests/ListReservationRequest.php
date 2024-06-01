<?php

namespace App\Http\Requests;

use App\Rules\ValidFormatReservationRule;
use App\Rules\ValidPeriodReservationRule;
use App\Rules\ValidStartReservationRule;
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
            'filter.start_time' => ['sometimes', 'date_format:Y-m-d H:i'],
            'filter.end_time' => ['required_with:start_time', 'date_format:Y-m-d H:i', 'after:start_time']
        ];
    }
}
