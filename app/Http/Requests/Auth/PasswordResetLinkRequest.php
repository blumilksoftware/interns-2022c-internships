<?php

declare(strict_types=1);

namespace Internships\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => "required|email",
        ];
    }
}
