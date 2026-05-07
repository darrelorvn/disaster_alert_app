<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreDisasterReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        // TODO: connect with policy/role authorization.
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|string',
        'occurred_at' => 'required|date',
        'description' => 'required|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        ];
    }
}
