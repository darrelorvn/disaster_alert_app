<?php

namespace App\Http\Requests\Officer;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvacuationRouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        // TODO: connect with policy/role authorization.
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        'disaster_type' => 'required|string',
        'area' => 'required|string',
        ];
    }
}
