<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_barang' => ['required', 'string', 'max:100'],
            'harga_barang' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_barang' => 'Nama Barang',
            'harga_barang' => 'Harga Barang',
        ];
    }
}
