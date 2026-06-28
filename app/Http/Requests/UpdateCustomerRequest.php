<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_customer' => ['required', 'string', 'max:100'],
            'nama_pt' => ['nullable', 'string', 'max:100'],
            'alamat_pt' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_customer' => 'Nama Customer',
            'nama_pt' => 'Nama PT',
            'alamat_pt' => 'Alamat PT',
        ];
    }
}
