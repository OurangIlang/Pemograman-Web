<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBahanBakuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_bahan_baku' => ['required', 'string', 'max:10', 'unique:bahan_baku,id_bahan_baku'],
            'nama_bahan_baku' => ['required', 'string', 'max:100'],
            'harga_bahan_baku' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_bahan_baku' => 'ID Bahan Baku',
            'nama_bahan_baku' => 'Nama Bahan Baku',
            'harga_bahan_baku' => 'Harga Bahan Baku',
        ];
    }
}
