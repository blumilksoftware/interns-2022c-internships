<?php

declare(strict_types=1);

namespace Internships\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class NewPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "token" => "required",
            "email" => "required|email",
            "password" => ["required", "confirmed", Rules\Password::defaults()],
        ];
    }
}
