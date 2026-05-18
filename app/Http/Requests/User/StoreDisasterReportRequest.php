<?php

namespace App\Http\Requests\User;

use App\Enums\DisasterType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDisasterReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'disaster_event_id' => ['nullable', 'integer', 'exists:disaster_events,id'],
            'type' => ['required', 'string', Rule::in(array_column(DisasterType::cases(), 'value'))],
            'location_name' => ['nullable', 'string', 'max:255'],
            'occurred_at' => ['required', 'date'],
            'description' => ['required', 'string'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'reporter_name' => ['nullable', 'string', 'max:255'],
            'reporter_phone' => ['nullable', 'string', 'max:30'],
            'photos' => ['nullable', 'array', 'max:3'],
            'photos.*' => ['file', 'image', 'max:5120'],
            'photo_captions' => ['nullable', 'array'],
            'photo_captions.*' => ['nullable', 'string', 'max:255'],
        ];
    }
}
