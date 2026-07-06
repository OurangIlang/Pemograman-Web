<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBahanBakuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // The original edit form keeps the ID read-only, so only the
        // editable fields are validated here.
        return [
            'nama_bahan_baku' => ['required', 'string', 'max:100'],
            'harga_bahan_baku' => ['required', 'numeric', 'min:0'],
            'satuan' => ['nullable', 'string', 'max:20'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_bahan_baku' => 'Nama Bahan Baku',
            'harga_bahan_baku' => 'Harga Bahan Baku',
            'satuan' => 'Satuan',
        ];
    }
}
