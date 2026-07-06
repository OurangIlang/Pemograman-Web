<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * The ID is auto-generated server-side (App\Traits\GeneratesId) and
     * must never be accepted from client input.
     */
    public function rules(): array
    {
        return [
            'nama_barang' => ['required', 'string', 'max:100'],
            'harga_barang' => ['required', 'numeric', 'min:0'],
            'satuan' => ['nullable', 'string', 'max:20'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_barang' => 'Nama Barang',
            'harga_barang' => 'Harga Barang',
            'satuan' => 'Satuan',
        ];
    }
}
