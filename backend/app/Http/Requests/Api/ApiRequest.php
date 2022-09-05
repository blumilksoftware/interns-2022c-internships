<?php

namespace Internships\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        ];
    }
}
