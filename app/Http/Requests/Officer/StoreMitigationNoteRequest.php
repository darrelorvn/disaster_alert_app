<?php

namespace App\Http\Requests\Officer;

use Illuminate\Foundation\Http\FormRequest;

class StoreMitigationNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        // TODO: connect with policy/role authorization.
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
        'disaster_type' => 'required|string',
        'affected_area' => 'required|string',
        'description' => 'required|string',
        ];
    }
}
