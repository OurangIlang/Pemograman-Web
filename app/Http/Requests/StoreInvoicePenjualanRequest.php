<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoicePenjualanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_invoice' => ['required', 'string', 'max:20', 'unique:invoice_penjualan,no_invoice'],
            'tanggal' => ['required', 'date'],
            'no_faktur' => ['nullable', 'string', 'max:20'],
            'no_preorder' => ['nullable', 'string', 'max:20'],
            'id_customer' => ['required', 'string', 'exists:customer,id_customer'],
            'id_pegawai' => ['required', 'string', 'exists:pegawai,id_pegawai'],
        ];
    }

    public function attributes(): array
    {
        return [
            'no_invoice' => 'No Invoice',
            'tanggal' => 'Tanggal',
            'no_faktur' => 'No Faktur',
            'no_preorder' => 'No Preorder',
            'id_customer' => 'Customer',
            'id_pegawai' => 'Pegawai',
        ];
    }
}
