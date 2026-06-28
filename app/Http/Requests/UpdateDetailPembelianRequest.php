<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailPembelianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'keterangan' => ['nullable', 'string'],
            'qty' => ['required', 'numeric', 'min:0'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'qty' => 'Qty',
            'harga_satuan' => 'Harga Satuan',
        ];
    }
}
