<?php

namespace App\Http\Requests\Officer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        // TODO: connect with policy/role authorization.
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|string',
        'note' => 'nullable|string',
        ];
    }
}
