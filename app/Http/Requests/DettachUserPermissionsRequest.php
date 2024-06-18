<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DettachUserPermissionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('permissions.detach')
            && $this->user()->mainPriority() < $this->user->mainPriority();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'permissions' => ['array'],
            'permissions.*' => ['string']
        ];
    }
}
