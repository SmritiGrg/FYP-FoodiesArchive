<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s\-\'\.]+$/'],
            'username' => ['required', 'string', 'max:20', 'regex:/^(?=.*[a-zA-Z])[\w\-.]*$/', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => [
                'required', 
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
