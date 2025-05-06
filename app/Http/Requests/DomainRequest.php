<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomainRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules()
    {
        $domainId = $this->route('domain') ? $this->route('domain')->id : null;

        return [
            'domain' => [
                'required',
                'string',
                'max:255',
                'regex:/^(?!-)(?:[a-zA-Z0-9-]{0,62}[a-zA-Z0-9]\.)+[a-zA-Z]{2,}$/',
                "unique:domains,domain,{$domainId}"
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'domain.required' => 'Domain name is required.',
            'domain.regex' => 'Please enter a valid domain name (e.g., example.com).',
            'domain.unique' => 'This domain is already registered in our system.',
        ];
    }
}
