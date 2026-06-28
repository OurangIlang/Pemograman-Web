<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_barang' => ['required', 'string', 'max:10', 'unique:barang,id_barang'],
            'nama_barang' => ['required', 'string', 'max:100'],
            'harga_barang' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_barang' => 'ID Barang',
            'nama_barang' => 'Nama Barang',
            'harga_barang' => 'Harga Barang',
        ];
    }
}
