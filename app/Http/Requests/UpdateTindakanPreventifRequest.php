<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTindakanPreventifRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'aktivitas'       => ['required', 'string', 'max:255'],
                'deskripsi'       => ['required', 'string'],
                'waktu_tindakan'  => ['required', 'date', 'before_or_equal:now'],
                'lokasi'          => ['nullable', 'string', 'max:255'],
                'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            ];
    }
}
