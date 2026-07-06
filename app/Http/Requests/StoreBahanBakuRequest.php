<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBahanBakuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * The ID is auto-generated server-side (App\Traits\GeneratesId) and
     * must never be accepted from client input, so it is intentionally
     * not part of the validated/fillable data here.
     */
    public function rules(): array
    {
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
