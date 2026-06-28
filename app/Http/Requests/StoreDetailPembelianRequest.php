<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetailPembelianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_nota' => ['required', 'string', 'exists:nota_pembelian,kode_nota'],
            'id_bahan_baku' => ['required', 'string', 'exists:bahan_baku,id_bahan_baku'],
            'keterangan' => ['nullable', 'string'],
            'qty' => ['required', 'numeric', 'min:0'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
            'sub_total' => ['nullable', 'numeric', 'min:0'],
            'total_harga' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_bahan_baku' => 'Bahan Baku',
            'qty' => 'Qty',
            'harga_satuan' => 'Harga Satuan',
            'total_harga' => 'Total Harga',
        ];
    }
}
