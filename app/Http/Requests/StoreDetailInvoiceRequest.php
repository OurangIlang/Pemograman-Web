<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetailInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_invoice' => ['required', 'string', 'exists:invoice_penjualan,no_invoice'],
            'id_barang' => ['required', 'string', 'exists:barang,id_barang'],
            'deskripsi' => ['nullable', 'string'],
            'qty' => ['required', 'numeric', 'min:0'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'sub_total' => ['nullable', 'numeric', 'min:0'],
            'total_price' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_barang' => 'Barang',
            'qty' => 'Qty',
            'unit_price' => 'Unit Price',
            'total_price' => 'Total Price',
        ];
    }
}
